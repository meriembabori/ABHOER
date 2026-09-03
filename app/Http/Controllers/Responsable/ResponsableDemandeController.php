<?php

namespace App\Http\Controllers\Responsable;

use App\Http\Controllers\Controller;
use App\Models\Affectation;
use App\Models\Candidat;
use App\Models\DemandeStage;
use App\Models\Document;
use App\Models\Historique;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResponsableDemandeController extends Controller
{
    /**
     * --------------------------------------------------------------------------
     * Liste de toutes les demandes
     * avec recherche et filtres.
     * --------------------------------------------------------------------------
     */
    public function index(Request $request)
    {
        $query = DemandeStage::with([
            'candidat',
            'service',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Recherche
        |--------------------------------------------------------------------------
        */
        if ($request->filled('recherche')) {
            $recherche = trim($request->recherche);

            $query->where(function ($q) use ($recherche) {
                $q->where('numeroDemande', 'like', "%{$recherche}%")
                    ->orWhereHas('candidat', function ($qc) use ($recherche) {
                        $qc->where('nom', 'like', "%{$recherche}%")
                            ->orWhere('prenom', 'like', "%{$recherche}%")
                            ->orWhere('cin', 'like', "%{$recherche}%")
                            ->orWhere('email', 'like', "%{$recherche}%");
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre par statut
        |--------------------------------------------------------------------------
        */
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre par service
        |--------------------------------------------------------------------------
        */
        if ($request->filled('service')) {
            $query->where('idService', $request->service);
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre par type de dépôt
        |--------------------------------------------------------------------------
        */
        if ($request->filled('typeDepot')) {
            $query->where('typeDepot', $request->typeDepot);
        }

        /*
        |--------------------------------------------------------------------------
        | Résultats
        |--------------------------------------------------------------------------
        */
        $demandes = $query
            ->orderBy('dateDepot', 'desc')
            ->paginate(12)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Services pour le filtre
        |--------------------------------------------------------------------------
        */
        $services = Service::orderBy('nomService')->get();

        return view(
            'responsable.demandes.index',
            compact('demandes', 'services')
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Afficher les détails d'une demande.
     * --------------------------------------------------------------------------
     */
    public function show(int $id)
    {
        $demande = DemandeStage::with([
            'candidat',
            'service.departement',
            'documents',
            'affectation.service',
            'historiques.utilisateur',
        ])->findOrFail($id);

        $services = Service::with('departement')
            ->orderBy('nomService')
            ->get();

        return view(
            'responsable.demandes.show',
            compact('demande', 'services')
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Accepter une demande.
     * --------------------------------------------------------------------------
     */
    public function accepter(int $id)
    {
        $demande = DemandeStage::findOrFail($id);

        $ancienStatut = $demande->statut;

        $demande->statut = 'ACCEPTEE';
        $demande->save();

        $this->logHistorique(
            $demande->idDemande,
            'ACCEPTATION',
            $ancienStatut,
            'ACCEPTEE'
        );

        return back()->with(
            'success',
            "La demande {$demande->numeroDemande} a été acceptée."
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Refuser une demande.
     * --------------------------------------------------------------------------
     */
    public function refuser(Request $request, int $id)
    {
        $validated = $request->validate([
            'motif' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $demande = DemandeStage::findOrFail($id);

        $ancienStatut = $demande->statut;

        $demande->statut = 'REFUSEE';

        if (!empty($validated['motif'])) {
            $demande->observation = $validated['motif'];
        }

        $demande->save();

        $this->logHistorique(
            $demande->idDemande,
            'REFUS',
            $ancienStatut,
            'REFUSEE',
            $validated['motif'] ?? null
        );

        return back()->with(
            'success',
            "La demande {$demande->numeroDemande} a été refusée."
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Demander des informations complémentaires.
     * --------------------------------------------------------------------------
     */
    public function demanderInfos(Request $request, int $id)
    {
        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        $demande = DemandeStage::findOrFail($id);

        $ancienStatut = $demande->statut;

        $demande->statut = 'INFOS_DEMANDEES';
        $demande->observation = $validated['message'];

        $demande->save();

        $this->logHistorique(
            $demande->idDemande,
            'DEMANDE_INFOS',
            $ancienStatut,
            'INFOS_DEMANDEES',
            $validated['message']
        );

        return back()->with(
            'success',
            "Une demande d'informations complémentaires a été enregistrée pour {$demande->numeroDemande}."
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Affecter une demande à un service.
     * --------------------------------------------------------------------------
     */
    public function affecter(Request $request, int $id)
    {
        $validated = $request->validate([
            'idService' => [
                'required',
                'integer',
                'exists:service,idService',
            ],

            'dateDebut' => [
                'required',
                'date',
            ],

            'dateFin' => [
                'required',
                'date',
                'after_or_equal:dateDebut',
            ],

            'observation' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $demande = DemandeStage::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Création ou modification de l'affectation
        |--------------------------------------------------------------------------
        */
        Affectation::updateOrCreate(
            [
                'idDemande' => $demande->idDemande,
            ],
            [
                'idService' => $validated['idService'],
                'dateAffectation' => now()->toDateString(),
                'dateDebut' => $validated['dateDebut'],
                'dateFin' => $validated['dateFin'],
                'observation' => $validated['observation'] ?? null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Mettre à jour le service de la demande
        |--------------------------------------------------------------------------
        */
        $demande->idService = $validated['idService'];

        /*
        |--------------------------------------------------------------------------
        | Si la demande était acceptée, elle passe au stage en cours.
        |--------------------------------------------------------------------------
        */
        if ($demande->statut === 'ACCEPTEE') {
            $ancienStatut = $demande->statut;
            $demande->statut = 'STAGE_EN_COURS';
        } else {
            $ancienStatut = $demande->statut;
        }

        $demande->dateDebut = $validated['dateDebut'];
        $demande->dateFin = $validated['dateFin'];

        $demande->save();

        /*
        |--------------------------------------------------------------------------
        | Historique
        |--------------------------------------------------------------------------
        */
        $this->logHistorique(
            $demande->idDemande,
            'AFFECTATION',
            $ancienStatut,
            'Affectée au service #' . $validated['idService'],
            $validated['observation'] ?? null
        );

        return back()->with(
            'success',
            "La demande {$demande->numeroDemande} a été affectée avec succès."
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Formulaire de création d'une demande physique.
     * --------------------------------------------------------------------------
     */
    public function create()
    {
        $services = Service::with('departement')
            ->orderBy('nomService')
            ->get();

        return view(
            'responsable.demandes.create',
            compact('services')
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Enregistrer une demande déposée physiquement.
     * --------------------------------------------------------------------------
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | Informations candidat
            |--------------------------------------------------------------------------
            */
            'nom' => [
                'required',
                'string',
                'max:100',
            ],

            'prenom' => [
                'required',
                'string',
                'max:100',
            ],

            'cin' => [
                'required',
                'string',
                'max:20',
                'unique:candidat,cin',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:candidat,email',
            ],

            'etablissement' => [
                'nullable',
                'string',
                'max:200',
            ],

            'formation' => [
                'nullable',
                'string',
                'max:200',
            ],

            'niveauEtude' => [
                'nullable',
                'string',
                'max:50',
            ],

            /*
            |--------------------------------------------------------------------------
            | Informations demande
            |--------------------------------------------------------------------------
            */
            'idService' => [
                'required',
                'integer',
                'exists:service,idService',
            ],

            'typeStage' => [
                'required',
                'string',
                'max:100',
            ],

            'theme' => [
                'nullable',
                'string',
                'max:255',
            ],

            'motivation' => [
                'nullable',
                'string',
            ],

            'dateDebut' => [
                'nullable',
                'date',
            ],

            'dateFin' => [
                'nullable',
                'date',
                'after_or_equal:dateDebut',
            ],

            'observation' => [
                'nullable',
                'string',
                'max:1000',
            ],

            /*
            |--------------------------------------------------------------------------
            | Documents
            |--------------------------------------------------------------------------
            */
            'documents' => [
                'nullable',
                'array',
            ],

            'documents.*' => [
                'nullable',
                'file',
                'max:10240',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Transaction
        |--------------------------------------------------------------------------
        */
        $demande = DB::transaction(function () use ($validated, $request) {

            /*
            |--------------------------------------------------------------------------
            | Création du candidat
            |--------------------------------------------------------------------------
            */
            $candidat = Candidat::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'cin' => $validated['cin'],
                'telephone' => $validated['telephone'] ?? null,
                'email' => $validated['email'],
                'etablissement' => $validated['etablissement'] ?? null,
                'formation' => $validated['formation'] ?? null,
                'niveauEtude' => $validated['niveauEtude'] ?? null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Création de la demande
            |--------------------------------------------------------------------------
            */
            $demande = DemandeStage::create([
                'idCandidat' => $candidat->idCandidat,
                'idService' => $validated['idService'],
                'numeroDemande' => $this->genererNumeroDemande(),
                'dateDepot' => now(),
                'dateDebut' => $validated['dateDebut'] ?? null,
                'dateFin' => $validated['dateFin'] ?? null,
                'theme' => $validated['theme'] ?? null,
                'motivation' => $validated['motivation'] ?? null,

                /*
                |--------------------------------------------------------------------------
                | Important :
                | La base contient BROUILLON par défaut mais une demande
                | enregistrée par le responsable est directement EN_ATTENTE.
                |--------------------------------------------------------------------------
                */
                'statut' => 'EN_ATTENTE',

                'typeDepot' => 'PHYSIQUE',
                'typeStage' => $validated['typeStage'],
                'observation' => $validated['observation'] ?? null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Documents
            |--------------------------------------------------------------------------
            */
            if (
                $request->hasFile('documents') &&
                is_array($request->file('documents'))
            ) {
                foreach ($request->file('documents') as $fichier) {

                    if (!$fichier->isValid()) {
                        continue;
                    }

                    $chemin = $fichier->store(
                        'documents/' . $demande->idDemande,
                        'public'
                    );

                    Document::create([
                        'idDemande' => $demande->idDemande,
                        'nomFichier' => $fichier->getClientOriginalName(),
                        'typeDocument' => $fichier->getClientOriginalExtension(),
                        'cheminFichier' => $chemin,
                        'dateAjout' => now(),
                    ]);
                }
            }

            return $demande;
        });

        /*
        |--------------------------------------------------------------------------
        | Historique
        |--------------------------------------------------------------------------
        */
        $this->logHistorique(
            $demande->idDemande,
            'CREATION_PHYSIQUE',
            null,
            'EN_ATTENTE'
        );

        /*
        |--------------------------------------------------------------------------
        | Redirection
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route(
                'responsable.demandes.show',
                $demande->idDemande
            )
            ->with(
                'success',
                "La demande {$demande->numeroDemande} a été enregistrée avec succès."
            );
    }

    /**
     * --------------------------------------------------------------------------
     * Ouvrir / afficher un document dans le navigateur.
     * --------------------------------------------------------------------------
     */
    public function voirDocument(int $id, int $idDocument)
    {
        $document = Document::where(
            'idDocument',
            $idDocument
        )
            ->where(
                'idDemande',
                $id
            )
            ->firstOrFail();

        /**
         * Vérifier le fichier.
         */
        if (
            !$document->cheminFichier ||
            !Storage::disk('public')->exists(
                $document->cheminFichier
            )
        ) {
            abort(
                404,
                'Fichier introuvable.'
            );
        }

        /**
         * Chemin physique.
         */
        $path = Storage::disk('public')->path(
            $document->cheminFichier
        );

        /**
         * Type MIME.
         */
        $mimeType = mime_content_type($path);

        if (!$mimeType) {
            $mimeType = 'application/octet-stream';
        }

        /**
         * Afficher le document dans le navigateur.
         */
        return response()->file(
            $path,
            [
                'Content-Type' => $mimeType,
                'Content-Disposition' =>
                    'inline; filename="' .
                    addslashes(
                        $document->nomFichier
                    ) .
                    '"',
            ]
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Ajouter des documents à une demande existante.
     * --------------------------------------------------------------------------
     */
    public function storeDocument(Request $request, int $id)
    {
        $request->validate([
            'documents' => [
                'required',
                'array',
                'min:1',
            ],

            'documents.*' => [
                'file',
                'max:10240',
            ],
        ]);

        $demande = DemandeStage::findOrFail($id);

        $nombreDocuments = 0;

        foreach ($request->file('documents') as $fichier) {

            if (!$fichier->isValid()) {
                continue;
            }

            $chemin = $fichier->store(
                'documents/' . $demande->idDemande,
                'public'
            );

            Document::create([
                'idDemande' => $demande->idDemande,
                'nomFichier' => $fichier->getClientOriginalName(),
                'typeDocument' => $fichier->getClientOriginalExtension(),
                'cheminFichier' => $chemin,
                'dateAjout' => now(),
            ]);

            $nombreDocuments++;
        }

        /*
        |--------------------------------------------------------------------------
        | Historique
        |--------------------------------------------------------------------------
        */
        $this->logHistorique(
            $demande->idDemande,
            'AJOUT_DOCUMENT',
            null,
            $nombreDocuments . ' document(s) ajouté(s)'
        );

        return back()->with(
            'success',
            'Document(s) ajouté(s) avec succès.'
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Générer un numéro de demande unique.
     *
     * Exemple :
     * STG-2026-000123
     * --------------------------------------------------------------------------
     */
    private function genererNumeroDemande(): string
    {
        $annee = now()->format('Y');

        $sequence = DemandeStage::whereYear(
            'dateDepot',
            $annee
        )->count() + 1;

        do {
            $numero = sprintf(
                'STG-%s-%06d',
                $annee,
                $sequence
            );

            $existe = DemandeStage::where(
                'numeroDemande',
                $numero
            )->exists();

            if ($existe) {
                $sequence++;
            }

        } while ($existe);

        return $numero;
    }

    /**
     * --------------------------------------------------------------------------
     * Enregistrer une action dans l'historique.
     * --------------------------------------------------------------------------
     */
    private function logHistorique(
        int $idDemande,
        string $action,
        ?string $ancienneValeur,
        string $nouvelleValeur,
        ?string $detail = null
    ): void {

        Historique::create([
            'idUtilisateur' => Auth::id(),
            'idDemande' => $idDemande,
            'action' => $action,
            'dateAction' => now(),
            'ancienneValeur' => $ancienneValeur,
            'nouvelleValeur' => $detail
                ? "{$nouvelleValeur} — {$detail}"
                : $nouvelleValeur,
        ]);
    }
}
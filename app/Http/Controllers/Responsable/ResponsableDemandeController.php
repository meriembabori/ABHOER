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
     * 2.1 Liste de toutes les demandes + recherche et filtres.
     */
    public function index(Request $request)
    {
        $query = DemandeStage::with(['candidat', 'service']);

        if ($request->filled('recherche')) {
            $recherche = $request->recherche;

            $query->where(function ($q) use ($recherche) {
                $q->where('numeroDemande', 'like', "%{$recherche}%")
                    ->orWhereHas('candidat', function ($qc) use ($recherche) {
                        $qc->where('nom', 'like', "%{$recherche}%")
                            ->orWhere('prenom', 'like', "%{$recherche}%")
                            ->orWhere('cin', 'like', "%{$recherche}%");
                    });
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('service')) {
            $query->where('idService', $request->service);
        }

        if ($request->filled('typeDepot')) {
            $query->where('typeDepot', $request->typeDepot);
        }

        $demandes = $query->orderBy('dateDepot', 'desc')->paginate(12)->withQueryString();

        $services = Service::orderBy('nomService')->get();

        return view('responsable.demandes.index', compact('demandes', 'services'));
    }

    /**
     * 2.2 Détails du candidat et de la demande + documents.
     */
    public function show($id)
    {
        $demande = DemandeStage::with([
            'candidat',
            'service.departement',
            'documents',
            'affectation.service',
            'historiques.utilisateur',
        ])->findOrFail($id);

        $services = Service::orderBy('nomService')->get();

        return view('responsable.demandes.show', compact('demande', 'services'));
    }

    /**
     * 2.3 Accepter la demande.
     */
    public function accepter(Request $request, $id)
    {
        $demande = DemandeStage::findOrFail($id);
        $ancienStatut = $demande->statut;

        $demande->statut = 'ACCEPTEE';
        $demande->save();

        $this->logHistorique($demande->idDemande, 'ACCEPTATION', $ancienStatut, 'ACCEPTEE');

        return back()->with('success', "La demande {$demande->numeroDemande} a été acceptée.");
    }

    /**
     * 2.3 Refuser la demande.
     */
    public function refuser(Request $request, $id)
    {
        $request->validate([
            'motif' => ['nullable', 'string', 'max:1000'],
        ]);

        $demande = DemandeStage::findOrFail($id);
        $ancienStatut = $demande->statut;

        $demande->statut = 'REFUSEE';

        if ($request->filled('motif')) {
            $demande->observation = $request->motif;
        }

        $demande->save();

        $this->logHistorique($demande->idDemande, 'REFUS', $ancienStatut, 'REFUSEE', $request->motif);

        return back()->with('success', "La demande {$demande->numeroDemande} a été refusée.");
    }

    /**
     * 2.3 Demander des informations supplémentaires.
     */
    public function demanderInfos(Request $request, $id)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $demande = DemandeStage::findOrFail($id);
        $ancienStatut = $demande->statut;

        $demande->statut = 'INFOS_DEMANDEES';
        $demande->observation = $request->message;
        $demande->save();

        $this->logHistorique($demande->idDemande, 'DEMANDE_INFOS', $ancienStatut, 'INFOS_DEMANDEES', $request->message);

        return back()->with('success', "Une demande d'informations complémentaires a été enregistrée pour {$demande->numeroDemande}.");
    }

    /**
     * 2.3 Affecter la demande à un service / encadrant.
     */
    public function affecter(Request $request, $id)
    {
        $request->validate([
            'idService' => ['required', 'exists:service,idService'],
            'dateDebut' => ['required', 'date'],
            'dateFin' => ['required', 'date', 'after_or_equal:dateDebut'],
            'observation' => ['nullable', 'string', 'max:1000'],
        ]);

        $demande = DemandeStage::findOrFail($id);

        Affectation::updateOrCreate(
            ['idDemande' => $demande->idDemande],
            [
                'idService' => $request->idService,
                'dateAffectation' => now(),
                'dateDebut' => $request->dateDebut,
                'dateFin' => $request->dateFin,
                'observation' => $request->observation,
            ]
        );

        // La demande suit son service d'affectation.
        $demande->idService = $request->idService;
        $demande->save();

        $this->logHistorique(
            $demande->idDemande,
            'AFFECTATION',
            null,
            'Affectée au service #' . $request->idService
        );

        return back()->with('success', "La demande {$demande->numeroDemande} a été affectée.");
    }

    /**
     * Tâche Agent : formulaire d'enregistrement d'une demande déposée physiquement au bureau.
     */
    public function create()
    {
        $services = Service::with('departement')->orderBy('nomService')->get();

        return view('responsable.demandes.create', compact('services'));
    }

    /**
     * Tâche Agent : enregistrer la demande physique (candidat + demande).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Candidat
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'cin' => ['required', 'string', 'max:20', 'unique:candidat,cin'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:150', 'unique:candidat,email'],
            'etablissement' => ['nullable', 'string', 'max:200'],
            'formation' => ['nullable', 'string', 'max:200'],
            'niveauEtude' => ['nullable', 'string', 'max:50'],
            // Demande
            'idService' => ['required', 'exists:service,idService'],
            'typeStage' => ['required', 'string', 'max:100'],
            'theme' => ['nullable', 'string', 'max:255'],
            'dateDebut' => ['nullable', 'date'],
            'dateFin' => ['nullable', 'date', 'after_or_equal:dateDebut'],
            'observation' => ['nullable', 'string', 'max:1000'],
            // Documents (optionnel à ce stade)
            'documents.*' => ['nullable', 'file', 'max:10240'],
        ]);

        $demande = DB::transaction(function () use ($validated, $request) {
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

            $demande = DemandeStage::create([
                'idCandidat' => $candidat->idCandidat,
                'idService' => $validated['idService'],
                'numeroDemande' => $this->genererNumeroDemande(),
                'dateDepot' => now(),
                'dateDebut' => $validated['dateDebut'] ?? null,
                'dateFin' => $validated['dateFin'] ?? null,
                'statut' => 'EN_ATTENTE',
                'typeDepot' => 'PHYSIQUE',
                'typeStage' => $validated['typeStage'],
                'theme' => $validated['theme'] ?? null,
                'observation' => $validated['observation'] ?? null,
            ]);

            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $fichier) {
                    $chemin = $fichier->store('documents/' . $demande->idDemande, 'public');

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

        $this->logHistorique($demande->idDemande, 'CREATION_PHYSIQUE', null, 'EN_ATTENTE');

        return redirect()
            ->route('responsable.demandes.show', $demande->idDemande)
            ->with('success', "La demande {$demande->numeroDemande} a été enregistrée.");
    }

    /**
     * Tâche Agent : ajouter un ou plusieurs documents à une demande existante (déposée au bureau).
     */
    public function storeDocument(Request $request, $id)
    {
        $request->validate([
            'documents' => ['required', 'array', 'min:1'],
            'documents.*' => ['file', 'max:10240'],
        ]);

        $demande = DemandeStage::findOrFail($id);

        foreach ($request->file('documents') as $fichier) {
            $chemin = $fichier->store('documents/' . $demande->idDemande, 'public');

            Document::create([
                'idDemande' => $demande->idDemande,
                'nomFichier' => $fichier->getClientOriginalName(),
                'typeDocument' => $fichier->getClientOriginalExtension(),
                'cheminFichier' => $chemin,
                'dateAjout' => now(),
            ]);
        }

        $this->logHistorique($demande->idDemande, 'AJOUT_DOCUMENT', null, count($request->file('documents')) . ' document(s) ajouté(s)');

        return back()->with('success', 'Document(s) ajouté(s) avec succès.');
    }

    /**
     * Génère un numéro de demande unique du type STG-2026-000123.
     */
    private function genererNumeroDemande(): string
    {
        $annee = now()->format('Y');
        $sequence = DemandeStage::whereYear('dateDepot', $annee)->count() + 1;

        return sprintf('STG-%s-%06d', $annee, $sequence);
    }

    /**
     * Enregistre une action dans l'historique.
     */
    private function logHistorique(int $idDemande, string $action, ?string $ancienneValeur, string $nouvelleValeur, ?string $detail = null): void
    {
        Historique::create([
            'idUtilisateur' => Auth::id(),
            'idDemande' => $idDemande,
            'action' => $action,
            'dateAction' => now(),
            'ancienneValeur' => $ancienneValeur,
            'nouvelleValeur' => $detail ? "{$nouvelleValeur} — {$detail}" : $nouvelleValeur,
        ]);
    }
}

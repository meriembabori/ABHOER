<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\DemandeStage;
use App\Models\Document;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EtudiantDemandeStageController extends Controller
{
    /**
     * ============================================================
     * RÉCUPÉRER LE CANDIDAT CONNECTÉ
     * ============================================================
     */
    private function getCandidatConnecte()
    {
        $utilisateur = Auth::user();

        if (!$utilisateur) {
            return null;
        }

        /*
         * Dans la table utilisateur, nous avons :
         * idUtilisateur
         * nom
         * prenom
         * login
         * motDePasse
         * role
         * actif
         *
         * Il n'y a pas de idCandidat.
         *
         * On recherche donc le candidat avec son email
         * correspondant au login de l'utilisateur.
         */
        return Candidat::where('email', $utilisateur->login)->first();
    }


    /**
     * ============================================================
     * LISTE DES DEMANDES DE L'ÉTUDIANT
     * ============================================================
     */
    public function index()
    {
        $utilisateur = Auth::user();

        if (!$utilisateur) {
            return redirect()
                ->route('login')
                ->with('error', 'Vous devez être connecté.');
        }

        $candidat = $this->getCandidatConnecte();

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Aucun profil étudiant n\'est associé à votre compte.'
                );
        }

        /*
         * Récupérer uniquement les demandes
         * de l'étudiant connecté.
         */
        $demandes = DemandeStage::with([
            'service',
            'documents'
        ])
            ->where('idCandidat', $candidat->idCandidat)
            ->orderByDesc('idDemande')
            ->get();

        return view(
            'etudiant.demande-stage.index',
            compact(
                'utilisateur',
                'candidat',
                'demandes'
            )
        );
    }


    /**
     * ============================================================
     * ÉTAPE 1 : AFFICHER LE FORMULAIRE
     * ============================================================
     */
    public function create()
    {
        $utilisateur = Auth::user();

        if (!$utilisateur) {
            return redirect()
                ->route('login')
                ->with('error', 'Vous devez être connecté.');
        }

        $candidat = $this->getCandidatConnecte();

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Aucun profil étudiant n\'est associé à votre compte.'
                );
        }

        /*
         * Récupérer les services.
         */
        $services = Service::orderBy(
            'nomService',
            'asc'
        )->get();

        return view(
            'etudiant.demande-stage.create',
            compact(
                'utilisateur',
                'candidat',
                'services'
            )
        );
    }


    /**
     * ============================================================
     * ÉTAPE 1 : ENREGISTRER LES INFORMATIONS
     * ============================================================
     */
    public function store(Request $request)
    {
        $utilisateur = Auth::user();

        if (!$utilisateur) {
            return redirect()
                ->route('login')
                ->with('error', 'Vous devez être connecté.');
        }

        $candidat = $this->getCandidatConnecte();

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Aucun profil étudiant n\'est associé à votre compte.'
                );
        }

        /*
         * ========================================================
         * VALIDATION
         * ========================================================
         */
        $validated = $request->validate(
            [
                'idService' => [
                    'required',
                    'integer',
                    'exists:service,idService',
                ],

                'typeDepot' => [
                    'required',
                    'string',
                    'max:50',
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

                'theme' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'motivation' => [
                    'required',
                    'string',
                    'min:10',
                ],
            ],
            [
                'idService.required' =>
                    'Veuillez sélectionner un service.',

                'idService.exists' =>
                    'Le service sélectionné est invalide.',

                'typeDepot.required' =>
                    'Veuillez sélectionner le type de stage.',

                'dateDebut.required' =>
                    'La date de début est obligatoire.',

                'dateDebut.date' =>
                    'La date de début est invalide.',

                'dateFin.required' =>
                    'La date de fin est obligatoire.',

                'dateFin.date' =>
                    'La date de fin est invalide.',

                'dateFin.after_or_equal' =>
                    'La date de fin doit être supérieure ou égale à la date de début.',

                'theme.required' =>
                    'Le thème du stage est obligatoire.',

                'motivation.required' =>
                    'La motivation est obligatoire.',

                'motivation.min' =>
                    'La motivation doit contenir au moins 10 caractères.',
            ]
        );


        /*
         * ========================================================
         * GÉNÉRER UN NUMÉRO UNIQUE
         * ========================================================
         */
        do {

            $numeroDemande =
                'DEM-' .
                date('Y') .
                '-' .
                strtoupper(Str::random(6));

        } while (
            DemandeStage::where(
                'numeroDemande',
                $numeroDemande
            )->exists()
        );


        /*
         * ========================================================
         * CRÉER LA DEMANDE
         * ========================================================
         */
        $demande = DemandeStage::create([
            'idCandidat' =>
                $candidat->idCandidat,

            'idService' =>
                $validated['idService'],

            'numeroDemande' =>
                $numeroDemande,

            'dateDepot' =>
                now()->format('Y-m-d'),

            'dateDebut' =>
                $validated['dateDebut'],

            'dateFin' =>
                $validated['dateFin'],

            'theme' =>
                $validated['theme'],

            'motivation' =>
                $validated['motivation'],

            'statut' =>
                'EN_ATTENTE',

            'typeDepot' =>
                $validated['typeDepot'],

            'observation' =>
                null,
        ]);


        /*
         * Aller vers l'étape 2
         */
        return redirect()
            ->route(
                'etudiant.demande.documents',
                $demande->idDemande
            )
            ->with(
                'success',
                'Les informations de votre demande ont été enregistrées avec succès.'
            );
    }


    /**
     * ============================================================
     * ÉTAPE 2 : AFFICHER LES DOCUMENTS
     * ============================================================
     */
    public function documents(int $idDemande)
    {
        $utilisateur = Auth::user();

        if (!$utilisateur) {
            return redirect()
                ->route('login');
        }

        $candidat = $this->getCandidatConnecte();

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Profil étudiant introuvable.'
                );
        }

        /*
         * Vérifier que la demande appartient
         * bien à l'étudiant connecté.
         */
        $demande = DemandeStage::with([
            'service',
            'documents'
        ])
            ->where(
                'idDemande',
                $idDemande
            )
            ->where(
                'idCandidat',
                $candidat->idCandidat
            )
            ->firstOrFail();

        $documents = $demande->documents;

        return view(
            'etudiant.demande-stage.documents',
            compact(
                'demande',
                'candidat',
                'utilisateur',
                'documents'
            )
        );
    }


    /**
     * ============================================================
     * ÉTAPE 2 : ENREGISTRER LES DOCUMENTS
     * ============================================================
     */
    public function storeDocuments(
        Request $request,
        int $idDemande
    ) {
        $utilisateur = Auth::user();

        if (!$utilisateur) {
            return redirect()
                ->route('login');
        }

        $candidat = $this->getCandidatConnecte();

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Profil étudiant introuvable.'
                );
        }

        /*
         * Vérifier la demande.
         */
        $demande = DemandeStage::where(
            'idDemande',
            $idDemande
        )
            ->where(
                'idCandidat',
                $candidat->idCandidat
            )
            ->firstOrFail();


        /*
         * ========================================================
         * VALIDATION
         * ========================================================
         */
        $request->validate(
            [
                'documents' => [
                    'required',
                    'array',
                    'min:1',
                ],

                'documents.*' => [
                    'required',
                    'file',
                    'mimes:pdf,doc,docx,jpg,jpeg,png',
                    'max:5120',
                ],

                'types' => [
                    'required',
                    'array',
                ],

                'types.*' => [
                    'required',
                    'string',
                    'max:100',
                ],
            ],
            [
                'documents.required' =>
                    'Veuillez ajouter au moins un document.',

                'documents.min' =>
                    'Veuillez ajouter au moins un document.',

                'documents.*.required' =>
                    'Veuillez sélectionner un fichier.',

                'documents.*.mimes' =>
                    'Les formats autorisés sont PDF, DOC, DOCX, JPG, JPEG et PNG.',

                'documents.*.max' =>
                    'Chaque fichier ne doit pas dépasser 5 Mo.',

                'types.required' =>
                    'Veuillez préciser le type de document.',

                'types.*.required' =>
                    'Le type du document est obligatoire.',
            ]
        );


        /*
         * ========================================================
         * ENREGISTRER LES FICHIERS
         * ========================================================
         */
        foreach (
            $request->file('documents') as $index => $file
        ) {

            $chemin = $file->store(
                'documents/demandes/' . $demande->idDemande,
                'public'
            );

            Document::create([
                'idDemande' =>
                    $demande->idDemande,

                'nomFichier' =>
                    $file->getClientOriginalName(),

                'typeDocument' =>
                    $request->types[$index] ?? 'Autre',

                'cheminFichier' =>
                    $chemin,

                'dateAjout' =>
                    now(),
            ]);
        }


        /*
         * Aller à l'étape 3.
         */
        return redirect()
            ->route(
                'etudiant.demande.confirmation',
                $demande->idDemande
            )
            ->with(
                'success',
                'Les documents ont été enregistrés avec succès.'
            );
    }


    /**
     * ============================================================
     * ÉTAPE 3 : CONFIRMATION
     * ============================================================
     */
    public function confirmation(int $idDemande)
    {
        $utilisateur = Auth::user();

        if (!$utilisateur) {
            return redirect()
                ->route('login');
        }

        $candidat = $this->getCandidatConnecte();

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Profil étudiant introuvable.'
                );
        }

        $demande = DemandeStage::with([
            'candidat',
            'service',
            'documents'
        ])
            ->where(
                'idDemande',
                $idDemande
            )
            ->where(
                'idCandidat',
                $candidat->idCandidat
            )
            ->firstOrFail();

        $documents = $demande->documents;

        return view(
            'etudiant.demande-stage.confirmation',
            compact(
                'demande',
                'candidat',
                'utilisateur',
                'documents'
            )
        );
    }


    /**
     * ============================================================
     * CONFIRMATION DÉFINITIVE
     * ============================================================
     */
    public function confirmer(int $idDemande)
    {
        $utilisateur = Auth::user();

        if (!$utilisateur) {
            return redirect()
                ->route('login');
        }

        $candidat = $this->getCandidatConnecte();

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Profil étudiant introuvable.'
                );
        }

        $demande = DemandeStage::where(
            'idDemande',
            $idDemande
        )
            ->where(
                'idCandidat',
                $candidat->idCandidat
            )
            ->firstOrFail();


        /*
         * Vérifier qu'il existe au moins
         * un document.
         */
        $nombreDocuments = Document::where(
            'idDemande',
            $demande->idDemande
        )->count();


        if ($nombreDocuments === 0) {

            return redirect()
                ->route(
                    'etudiant.demande.documents',
                    $demande->idDemande
                )
                ->with(
                    'error',
                    'Vous devez ajouter au moins un document avant de confirmer votre demande.'
                );
        }


        /*
         * La demande reste EN_ATTENTE.
         */
        $demande->update([
            'statut' => 'EN_ATTENTE',
        ]);


        return redirect()
            ->route(
                'etudiant.demande.index'
            )
            ->with(
                'success',
                'Votre demande de stage a été envoyée avec succès.'
            );
    }
}
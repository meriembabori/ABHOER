<?php

namespace App\Http\Controllers;

use App\Models\DemandeStage;
use Illuminate\Http\Request;

class AdminDemandeController extends Controller
{
    /**
     * --------------------------------------------------------------------------
     * Liste de toutes les demandes de stage
     * avec recherche, filtres et statistiques.
     * --------------------------------------------------------------------------
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Requête principale
        |--------------------------------------------------------------------------
        */

        $query = DemandeStage::with([
            'candidat',
            'service.departement',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Recherche
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {

                $q->where(
                    'numeroDemande',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'theme',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('candidat', function ($candidateQuery) use ($search) {

                    $candidateQuery
                        ->where(
                            'nom',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'prenom',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'email',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'cin',
                            'like',
                            '%' . $search . '%'
                        );
                })

                ->orWhereHas('service', function ($serviceQuery) use ($search) {

                    $serviceQuery->where(
                        'nomService',
                        'like',
                        '%' . $search . '%'
                    );
                });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre par statut
        |--------------------------------------------------------------------------
        */

        if ($request->filled('statut')) {

            $statut = $request->input('statut');

            $query->where('statut', $statut);
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre par type de stage
        |--------------------------------------------------------------------------
        */

        if ($request->filled('typeStage')) {

            $query->where(
                'typeStage',
                $request->input('typeStage')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Liste des demandes
        |--------------------------------------------------------------------------
        */

        $demandes = $query
            ->orderByDesc('dateDepot')
            ->orderByDesc('idDemande')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Total
        |--------------------------------------------------------------------------
        */

        $totalDemandes = DemandeStage::count();

        /*
        |--------------------------------------------------------------------------
        | En attente
        |--------------------------------------------------------------------------
        */

        $demandesEnAttente = DemandeStage::whereIn(
            'statut',
            [
                'EN_ATTENTE',
                'en_attente',
            ]
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Acceptées
        |
        | Une demande peut être :
        |
        | ACCEPTEE
        | STAGE_EN_COURS
        | TERMINEE
        |
        | Ces trois statuts correspondent à une demande
        | qui a été acceptée.
        |--------------------------------------------------------------------------
        */

        $demandesAcceptees = DemandeStage::whereIn(
            'statut',
            [
                'ACCEPTEE',
                'ACCEPTE',
                'STAGE_EN_COURS',
                'TERMINEE',
            ]
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Refusées
        |--------------------------------------------------------------------------
        */

        $demandesRefusees = DemandeStage::whereIn(
            'statut',
            [
                'REFUSEE',
                'REFUSE',
            ]
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Retour vers la vue
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.demandes.index',
            compact(
                'demandes',
                'totalDemandes',
                'demandesEnAttente',
                'demandesAcceptees',
                'demandesRefusees'
            )
        );
    }

    /**
     * --------------------------------------------------------------------------
     * Afficher le détail d'une demande.
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

        return view(
            'admin.demandes.show',
            compact('demande')
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\DemandeStage;
use Illuminate\Support\Facades\Auth;

class EtudiantDashboardController extends Controller
{
    /**
     * Afficher le tableau de bord étudiant.
     */
    public function index()
    {
        $utilisateur = Auth::user();
        $idCandidat = $utilisateur->idCandidat ?? null;

        $mesDemandes = $idCandidat
            ? DemandeStage::with('service')->where('idCandidat', $idCandidat)->orderByDesc('dateDepot')->get()
            : collect();

        $totalDemandes = $mesDemandes->count();
        $enCours = $mesDemandes->whereIn('statut', ['EN_ATTENTE', 'INFOS_DEMANDEES'])->count();
        $acceptees = $mesDemandes->where('statut', 'ACCEPTEE')->count();
        $refusees = $mesDemandes->where('statut', 'REFUSEE')->count();

        $derniereDemande = $mesDemandes->first();

        return view('etudiant.dashboard', compact(
            'utilisateur',
            'mesDemandes',
            'totalDemandes',
            'enCours',
            'acceptees',
            'refusees',
            'derniereDemande'
        ));
    }
}

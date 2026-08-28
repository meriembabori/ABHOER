<?php

namespace App\Http\Controllers\Responsable;

use App\Http\Controllers\Controller;
use App\Models\Affectation;
use App\Models\DemandeStage;
use Illuminate\Support\Facades\Auth;

class ResponsableDashboardController extends Controller
{
    public function index()
    {
        $totalDemandes = DemandeStage::count();

        $demandesEnAttente = DemandeStage::where('statut', 'EN_ATTENTE')->count();

        $demandesInfosDemandees = DemandeStage::where('statut', 'INFOS_DEMANDEES')->count();

        $demandesAcceptees = DemandeStage::where('statut', 'ACCEPTEE')->count();

        $demandesRefusees = DemandeStage::where('statut', 'REFUSEE')->count();

        $stagesEnCours = Affectation::whereDate('dateDebut', '<=', now())
            ->whereDate('dateFin', '>=', now())
            ->count();

        $dernieresDemandes = DemandeStage::with(['candidat', 'service'])
            ->orderBy('dateDepot', 'desc')
            ->limit(6)
            ->get();

        return view('responsable.dashboard', compact(
            'totalDemandes',
            'demandesEnAttente',
            'demandesInfosDemandees',
            'demandesAcceptees',
            'demandesRefusees',
            'stagesEnCours',
            'dernieresDemandes'
        ));
    }
}

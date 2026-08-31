<?php

namespace App\Http\Controllers\Responsable;

use App\Http\Controllers\Controller;
use App\Models\Affectation;
use App\Models\Attestation;
use App\Models\DemandeStage;
use App\Models\Service;
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

        $attestationsEnPreparation = Attestation::where('statut', 'EN_PREPARATION')->count();
        $attestationsPretes = Attestation::where('statut', 'PRETE')->count();
        $attestationsRemises = Attestation::where('statut', 'REMISE')->count();

        // Répartition des demandes par service (pour le graphique du dashboard)
        $demandesParService = Service::withCount('demandes')
            ->orderByDesc('demandes_count')
            ->limit(6)
            ->get()
            ->filter(fn ($service) => $service->demandes_count > 0);

        $maxParService = $demandesParService->max('demandes_count') ?: 1;

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
            'attestationsEnPreparation',
            'attestationsPretes',
            'attestationsRemises',
            'demandesParService',
            'maxParService',
            'dernieresDemandes'
        ));
    }
}

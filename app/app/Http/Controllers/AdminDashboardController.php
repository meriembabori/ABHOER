<?php

namespace App\Http\Controllers;

use App\Models\DemandeStage;
use App\Models\Utilisateur;
use App\Models\Service;
use App\Models\Candidat;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalDemandes = DemandeStage::count();

        $demandesEnAttente = DemandeStage::where(
            'statut',
            'EN_ATTENTE'
        )->count();

        $demandesAcceptees = DemandeStage::where(
            'statut',
            'ACCEPTEE'
        )->count();

        $demandesRefusees = DemandeStage::where(
            'statut',
            'REFUSEE'
        )->count();

        $totalUtilisateurs = Utilisateur::count();

        $totalServices = Service::count();

        $totalCandidats = Candidat::count();

        return view('admin.dashboard', compact(
            'totalDemandes',
            'demandesEnAttente',
            'demandesAcceptees',
            'demandesRefusees',
            'totalUtilisateurs',
            'totalServices',
            'totalCandidats'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class EtudiantDashboardController extends Controller
{
    /**
     * Afficher le tableau de bord étudiant.
     */
    public function index()
    {
        $utilisateur = Auth::user();

        return view('etudiant.dashboard', compact('utilisateur'));
    }
}
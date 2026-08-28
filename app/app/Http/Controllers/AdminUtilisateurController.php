<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUtilisateurController extends Controller
{
    /**
     * Afficher la liste des utilisateurs.
     */
    public function index()
    {
        $utilisateurs = Utilisateur::orderBy('idUtilisateur', 'desc')->get();

        return view('admin.utilisateurs.index', compact('utilisateurs'));
    }

    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        return view('admin.utilisateurs.create');
    }

    /**
     * Enregistrer un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'login' => ['required', 'string', 'max:100', 'unique:utilisateur,login'],
            'motDePasse' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:ADMINISTRATEUR,AGENT,RESPONSABLE'],
        ]);

        Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'login' => $request->login,
            'motDePasse' => Hash::make($request->motDePasse),
            'role' => $request->role,
            'actif' => 1,
        ]);

        return redirect()
            ->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Activer ou désactiver un utilisateur.
     */
    public function toggle($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $utilisateur->actif = !$utilisateur->actif;
        $utilisateur->save();

        return redirect()
            ->route('admin.utilisateurs.index')
           ->with('success', "Statut de l'utilisateur modifié.");
    }
}
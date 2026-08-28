<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantProfilController extends Controller
{
    /**
     * Afficher le profil de l'étudiant.
     */
    public function index()
    {
        $utilisateur = Auth::user();

        $candidat = $utilisateur->candidat;

        return view(
            'etudiant.profil',
            compact('utilisateur', 'candidat')
        );
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit()
    {
        $utilisateur = Auth::user();

        $candidat = $utilisateur->candidat;

        return view(
            'etudiant.modifier-profil',
            compact('utilisateur', 'candidat')
        );
    }

    /**
     * Enregistrer les modifications du profil.
     */
    public function update(Request $request)
    {
        $utilisateur = Auth::user();

        $candidat = $utilisateur->candidat;

        // Vérifier que le candidat existe
        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with('error', 'Profil candidat introuvable.');
        }

        // Validation des données
        $validated = $request->validate([
            'cin' => 'required|string|max:20',
            'telephone' => 'nullable|string|max:20',
            'email' => 'required|email|max:100',
            'etablissement' => 'nullable|string|max:150',
            'formation' => 'nullable|string|max:150',
            'niveauEtude' => 'nullable|string|max:100',
        ], [
            'cin.required' => 'La CIN est obligatoire.',
            'cin.max' => 'La CIN ne doit pas dépasser 20 caractères.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
        ]);

        // Mise à jour du candidat
        $candidat->cin = $validated['cin'];
        $candidat->telephone = $validated['telephone'] ?? null;
        $candidat->email = $validated['email'];
        $candidat->etablissement = $validated['etablissement'] ?? null;
        $candidat->formation = $validated['formation'] ?? null;
        $candidat->niveauEtude = $validated['niveauEtude'] ?? null;

        $candidat->save();

        // Retour au profil avec message de succès
        return redirect()
            ->route('etudiant.profil')
            ->with('success', 'Votre profil a été modifié avec succès.');
    }
}
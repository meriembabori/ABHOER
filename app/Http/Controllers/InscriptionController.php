<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InscriptionController extends Controller
{
    /**
     * Afficher le formulaire d'inscription
     */
    public function showRegistrationForm()
    {
        return view('auth.inscription');
    }

    /**
     * Enregistrer un nouvel étudiant
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'cin' => 'required|string|max:20|unique:candidat,cin',
            'cne' => 'nullable|string|max:50|unique:candidat,cne',
            'dateNaissance' => 'nullable|date',
            'telephone' => 'nullable|string|max:20',
            'email' => 'required|email|max:150|unique:candidat,email',
            'adresse' => 'nullable|string|max:255',
            'etablissement' => 'nullable|string|max:200',
            'formation' => 'nullable|string|max:200',
            'niveauEtude' => 'nullable|string|max:50',
            'anneeUniversitaire' => 'nullable|string|max:20',
            'login' => 'required|string|max:100|unique:utilisateur,login',
            'motDePasse' => 'required|string|min:6|confirmed',
        ], [
            'nom.required' => 'Veuillez saisir votre nom.',
            'prenom.required' => 'Veuillez saisir votre prénom.',
            'cin.required' => 'Veuillez saisir votre CIN.',
            'cin.unique' => 'Cette CIN existe déjà.',
            'cne.unique' => 'Ce CNE existe déjà.',
            'email.required' => 'Veuillez saisir votre adresse email.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
            'email.unique' => 'Cette adresse email existe déjà.',
            'login.required' => 'Veuillez choisir un identifiant.',
            'login.unique' => 'Cet identifiant existe déjà.',
            'motDePasse.required' => 'Veuillez saisir un mot de passe.',
            'motDePasse.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            'motDePasse.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        // Création du candidat
        $candidat = Candidat::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'cin' => $validated['cin'],
            'cne' => $validated['cne'] ?? null,
            'dateNaissance' => $validated['dateNaissance'] ?? null,
            'telephone' => $validated['telephone'] ?? null,
            'adresse' => $validated['adresse'] ?? null,
            'email' => $validated['email'],
            'etablissement' => $validated['etablissement'] ?? null,
            'formation' => $validated['formation'] ?? null,
            'niveauEtude' => $validated['niveauEtude'] ?? null,
            'anneeUniversitaire' => $validated['anneeUniversitaire'] ?? null,
        ]);

        // Création du compte utilisateur
        Utilisateur::create([
            'idCandidat' => $candidat->idCandidat,
            'nom' => $candidat->nom,
            'prenom' => $candidat->prenom,
            'login' => $validated['login'],
            'email' => $validated['email'],
            'motDePasse' => Hash::make($validated['motDePasse']),
            'role' => 'ETUDIANT',
            'actif' => true,
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.'
            );
    }
}

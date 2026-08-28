<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InscriptionController extends Controller
{
    /**
     * Afficher le formulaire d'inscription.
     */
    public function showForm()
    {
        return view('auth.inscription');
    }

    /**
     * Enregistrer un nouvel étudiant.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'cin' => ['required', 'string', 'max:50', 'unique:candidat,cin'],
            'telephone' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150', 'unique:candidat,email'],
            'etablissement' => ['nullable', 'string', 'max:255'],
            'formation' => ['nullable', 'string', 'max:255'],
            'niveauEtude' => ['nullable', 'string', 'max:100'],

            'login' => ['required', 'string', 'max:100', 'unique:utilisateur,login'],

            'motDePasse' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'cin.required' => 'La CIN est obligatoire.',
            'cin.unique' => 'Cette CIN est déjà utilisée.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email n\'est pas valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'login.required' => 'Le login est obligatoire.',
            'login.unique' => 'Ce login est déjà utilisé.',
            'motDePasse.required' => 'Le mot de passe est obligatoire.',
            'motDePasse.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            'motDePasse.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        DB::transaction(function () use ($validated) {

            /*
             * 1. Création du candidat
             */
            $candidat = Candidat::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'cin' => $validated['cin'],
                'telephone' => $validated['telephone'] ?? null,
                'email' => $validated['email'],
                'etablissement' => $validated['etablissement'] ?? null,
                'formation' => $validated['formation'] ?? null,
                'niveauEtude' => $validated['niveauEtude'] ?? null,
            ]);

            /*
             * 2. Création du compte utilisateur
             */
            Utilisateur::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'login' => $validated['login'],
                'motDePasse' => Hash::make($validated['motDePasse']),
                'role' => 'ETUDIANT',
                'actif' => true,
                'idCandidat' => $candidat->idCandidat,
            ]);
        });

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Votre compte étudiant a été créé avec succès. Vous pouvez maintenant vous connecter.'
            );
    }
}
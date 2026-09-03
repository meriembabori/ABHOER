<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class EtudiantProfilController extends Controller
{
    /**
     * Afficher le profil de l'étudiant connecté.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user instanceof Utilisateur) {
            return redirect()->route('login');
        }

        $candidat = Candidat::find($user->idCandidat);

        if (!$candidat) {
            return redirect()
                ->route('etudiant.dashboard')
                ->with('error', 'Profil étudiant introuvable.');
        }

        return view('etudiant.profil', [
            'user' => $user,
            'candidat' => $candidat,
        ]);
    }

    /**
     * Afficher le formulaire de modification du profil.
     */
    public function edit()
    {
        $user = Auth::user();

        if (!$user instanceof Utilisateur) {
            return redirect()->route('login');
        }

        $candidat = Candidat::find($user->idCandidat);

        if (!$candidat) {
            return redirect()
                ->route('etudiant.dashboard')
                ->with('error', 'Profil étudiant introuvable.');
        }

        return view('etudiant.modifier-profil', [
            'user' => $user,
            'candidat' => $candidat,
        ]);
    }

    /**
     * Mettre à jour le profil.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user instanceof Utilisateur) {
            return redirect()->route('login');
        }

        $candidat = Candidat::find($user->idCandidat);

        if (!$candidat) {
            return redirect()
                ->route('etudiant.dashboard')
                ->with('error', 'Profil étudiant introuvable.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'nom' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'prenom' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'cin' => [
                    'required',
                    'string',
                    'max:30',
                ],

                'cne' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'dateNaissance' => [
                    'nullable',
                    'date',
                ],

                'telephone' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'email' => [
                    'required',
                    'email',
                    'max:150',
                ],

                'adresse' => [
                    'nullable',
                    'string',
                    'max:500',
                ],

                'etablissement' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'formation' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'niveauEtude' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'anneeUniversitaire' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'photo' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],
            ],
            [
                'nom.required' =>
                    'Le nom est obligatoire.',

                'prenom.required' =>
                    'Le prénom est obligatoire.',

                'cin.required' =>
                    'La CIN est obligatoire.',

                'email.required' =>
                    'L’adresse email est obligatoire.',

                'email.email' =>
                    'Veuillez saisir une adresse email valide.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Mise à jour du candidat
        |--------------------------------------------------------------------------
        */

        $candidat->nom = $validated['nom'];
        $candidat->prenom = $validated['prenom'];
        $candidat->cin = $validated['cin'];
        $candidat->cne = $validated['cne'] ?? null;
        $candidat->dateNaissance = $validated['dateNaissance'] ?? null;
        $candidat->telephone = $validated['telephone'] ?? null;
        $candidat->email = $validated['email'];
        $candidat->adresse = $validated['adresse'] ?? null;
        $candidat->etablissement = $validated['etablissement'] ?? null;
        $candidat->formation = $validated['formation'] ?? null;
        $candidat->niveauEtude = $validated['niveauEtude'] ?? null;
        $candidat->anneeUniversitaire =
            $validated['anneeUniversitaire'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Photo de profil
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            // Supprimer l'ancienne photo si elle existe.
            if ($candidat->photo && Storage::disk('public')->exists($candidat->photo)) {
                Storage::disk('public')->delete($candidat->photo);
            }

            $chemin = $request->file('photo')->store('photos-profil', 'public');
            $candidat->photo = $chemin;
        }

        $candidat->save();

        /*
        |--------------------------------------------------------------------------
        | Synchronisation avec la table utilisateur
        |--------------------------------------------------------------------------
        |
        | Dans ta base, certaines informations peuvent également
        | être présentes dans la table utilisateur.
        |
        */

        $utilisateurModifie = false;

        if (Schema::hasColumn('utilisateur', 'nom')) {
            $user->nom = $validated['nom'];
            $utilisateurModifie = true;
        }

        if (Schema::hasColumn('utilisateur', 'prenom')) {
            $user->prenom = $validated['prenom'];
            $utilisateurModifie = true;
        }

        if (Schema::hasColumn('utilisateur', 'email')) {
            $user->email = $validated['email'];
            $utilisateurModifie = true;
        }

        if ($utilisateurModifie) {
            $user->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Retour
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('etudiant.profil')
            ->with(
                'success',
                'Votre profil a été mis à jour avec succès.'
            );
    }
}
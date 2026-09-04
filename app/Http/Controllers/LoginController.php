<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Afficher le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traiter la connexion.
     */
    public function login(Request $request)
    {
        /**
         * Validation.
         */
        $validated = $request->validate(
            [
                'login' => [
                    'required',
                    'string',
                ],

                'motDePasse' => [
                    'required',
                    'string',
                ],
            ],
            [
                'login.required' => 'Veuillez saisir votre login.',
                'motDePasse.required' => 'Veuillez saisir votre mot de passe.',
            ]
        );

        /**
         * Rechercher l'utilisateur par login OU par email,
         * pour permettre la connexion avec les deux.
         */
        $utilisateur = Utilisateur::where(
            'login',
            $validated['login']
        )
        ->orWhere(
            'email',
            $validated['login']
        )
        ->first();

        /**
         * Vérifier que l'utilisateur existe.
         */
        if ($utilisateur === null) {
            return back()
                ->withInput(
                    $request->only('login')
                )
                ->withErrors([
                    'login' => 'Login ou mot de passe incorrect.',
                ]);
        }

        /**
         * Vérifier le mot de passe.
         */
        if (
            !Hash::check(
                $validated['motDePasse'],
                $utilisateur->motDePasse
            )
        ) {
            return back()
                ->withInput(
                    $request->only('login')
                )
                ->withErrors([
                    'login' => 'Login ou mot de passe incorrect.',
                ]);
        }

        /**
         * Vérifier si le compte est actif.
         */
        if (!$utilisateur->actif) {
            return back()
                ->withInput(
                    $request->only('login')
                )
                ->withErrors([
                    'login' => 'Votre compte est désactivé. Veuillez contacter l’administrateur.',
                ]);
        }

        /**
         * Vérifier que le rôle est valide.
         *
         * Les seuls rôles autorisés sont :
         * - ETUDIANT
         * - RESPONSABLE
         * - ADMINISTRATEUR
         */
        $rolesAutorises = [
            'ETUDIANT',
            'RESPONSABLE',
            'ADMINISTRATEUR',
        ];

        if (!in_array($utilisateur->role, $rolesAutorises, true)) {
            return back()
                ->withInput(
                    $request->only('login')
                )
                ->withErrors([
                    'login' => 'Le rôle de votre compte n’est pas reconnu.',
                ]);
        }

        /**
         * Connexion.
         */
        Auth::login($utilisateur);

        /**
         * Régénérer la session pour la sécurité.
         */
        $request->session()->regenerate();

        /**
         * Redirection selon le rôle.
         */
        switch ($utilisateur->role) {

            /**
             * Étudiant.
             */
            case 'ETUDIANT':

                return redirect()
                    ->route('etudiant.dashboard')
                    ->with(
                        'success',
                        'Bienvenue dans votre espace étudiant.'
                    );

            /**
             * Responsable.
             */
            case 'RESPONSABLE':

                return redirect()
                    ->route('responsable.dashboard')
                    ->with(
                        'success',
                        'Bienvenue dans votre espace responsable.'
                    );

            /**
             * Administrateur.
             */
            case 'ADMINISTRATEUR':

                return redirect()
                    ->route('admin.dashboard')
                    ->with(
                        'success',
                        'Bienvenue dans votre espace administrateur.'
                    );

            /**
             * Sécurité supplémentaire.
             */
            default:

                Auth::logout();

                return redirect()
                    ->route('login')
                    ->withErrors([
                        'login' => 'Le rôle de votre compte n’est pas reconnu.',
                    ]);
        }
    }

    /**
     * Déconnexion.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Vous êtes déconnecté avec succès.'
            );
    }
}
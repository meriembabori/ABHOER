<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUtilisateurController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\EtudiantDashboardController;
use App\Http\Controllers\EtudiantProfilController;
use App\Http\Controllers\EtudiantDemandeStageController;
use App\Http\Controllers\Responsable\ResponsableDashboardController;
use App\Http\Controllers\Responsable\ResponsableDemandeController;
use App\Http\Controllers\Responsable\ResponsableHistoriqueController;
use App\Http\Controllers\Responsable\ResponsableStageController;
use App\Http\Controllers\Responsable\ResponsableAttestationController;
use App\Http\Controllers\AccueilController;

/*
|--------------------------------------------------------------------------
| Page d'accueil publique
|--------------------------------------------------------------------------
*/
Route::get('/', [AccueilController::class, 'index'])
    ->name('accueil');


/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/

// Afficher la page de connexion
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

// Traiter la connexion
Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

// Déconnexion
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Inscription étudiant
|--------------------------------------------------------------------------
*/

Route::get('/inscription', [InscriptionController::class, 'showForm'])
    ->name('inscription');

Route::post('/inscription', [InscriptionController::class, 'register'])
    ->name('inscription.register');


/*
|--------------------------------------------------------------------------
| Administration
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/admin/utilisateurs', [AdminUtilisateurController::class, 'index'])
    ->name('admin.utilisateurs.index');

Route::get('/admin/utilisateurs/create', [AdminUtilisateurController::class, 'create'])
    ->name('admin.utilisateurs.create');

Route::post('/admin/utilisateurs', [AdminUtilisateurController::class, 'store'])
    ->name('admin.utilisateurs.store');

Route::put('/admin/utilisateurs/{id}/toggle', [AdminUtilisateurController::class, 'toggle'])
    ->name('admin.utilisateurs.toggle');


/*
|--------------------------------------------------------------------------
| Espace Responsable (fusionné avec l'espace Agent)
|--------------------------------------------------------------------------
*/
Route::prefix('responsable')
    ->name('responsable.')
    ->middleware(['auth', 'role:RESPONSABLE,AGENT'])
    ->group(function () {

        Route::get('/dashboard', [ResponsableDashboardController::class, 'index'])
            ->name('dashboard');

        // Liste des demandes (recherche, filtres)
        Route::get('/demandes', [ResponsableDemandeController::class, 'index'])
            ->name('demandes.index');

        // Enregistrement d'une demande déposée physiquement au bureau (tâche Agent)
        Route::get('/demandes/create', [ResponsableDemandeController::class, 'create'])
            ->name('demandes.create');
        Route::post('/demandes', [ResponsableDemandeController::class, 'store'])
            ->name('demandes.store');

        // Détail d'une demande
        Route::get('/demandes/{id}', [ResponsableDemandeController::class, 'show'])
            ->name('demandes.show');

        // Actions de traitement
        Route::post('/demandes/{id}/accepter', [ResponsableDemandeController::class, 'accepter'])
            ->name('demandes.accepter');
        Route::post('/demandes/{id}/refuser', [ResponsableDemandeController::class, 'refuser'])
            ->name('demandes.refuser');
        Route::post('/demandes/{id}/demander-infos', [ResponsableDemandeController::class, 'demanderInfos'])
            ->name('demandes.demander-infos');
        Route::post('/demandes/{id}/affecter', [ResponsableDemandeController::class, 'affecter'])
            ->name('demandes.affecter');

        // Ajout de documents à une demande existante (tâche Agent)
        Route::post('/demandes/{id}/documents', [ResponsableDemandeController::class, 'storeDocument'])
            ->name('demandes.documents.store');

        // Suivi des stages (à venir, en cours, terminés)
        Route::get('/stages', [ResponsableStageController::class, 'index'])
            ->name('stages.index');

        // Historique complet des actions
        Route::get('/historique', [ResponsableHistoriqueController::class, 'index'])
            ->name('historique.index');

        // Gestion des attestations de stage
        Route::get('/attestations', [ResponsableAttestationController::class, 'index'])
            ->name('attestations.index');
        Route::post('/attestations/demarrer/{idDemande}', [ResponsableAttestationController::class, 'demarrer'])
            ->name('attestations.demarrer');
        Route::post('/attestations/{id}/prete', [ResponsableAttestationController::class, 'marquerPrete'])
            ->name('attestations.prete');
        Route::post('/attestations/{id}/remise', [ResponsableAttestationController::class, 'marquerRemise'])
            ->name('attestations.remise');
    });


/*
|--------------------------------------------------------------------------
| Espace étudiant
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/etudiant/dashboard', [EtudiantDashboardController::class, 'index'])
        ->name('etudiant.dashboard');

    // Profil étudiant
    Route::get('/etudiant/profil', [EtudiantProfilController::class, 'index'])
        ->name('etudiant.profil');

    Route::get('/etudiant/profil/modifier', [EtudiantProfilController::class, 'edit'])
        ->name('etudiant.profil.edit');

    Route::put('/etudiant/profil', [EtudiantProfilController::class, 'update'])
        ->name('etudiant.profil.update');

    // Demandes de stage
    Route::get('/etudiant/demandes', [EtudiantDemandeStageController::class, 'index'])
        ->name('etudiant.demande.index');

    Route::get('/etudiant/demande-stage/nouvelle', [EtudiantDemandeStageController::class, 'create'])
        ->name('etudiant.demande.create');

    Route::post('/etudiant/demande-stage', [EtudiantDemandeStageController::class, 'store'])
        ->name('etudiant.demande.store');

    Route::get('/etudiant/demande-stage/{idDemande}/documents', [EtudiantDemandeStageController::class, 'documents'])
        ->name('etudiant.demande.documents');

    Route::post('/etudiant/demande-stage/{idDemande}/documents', [EtudiantDemandeStageController::class, 'storeDocuments'])
        ->name('etudiant.demande.documents.store');

    Route::get('/etudiant/demande-stage/{idDemande}/confirmation', [EtudiantDemandeStageController::class, 'confirmation'])
        ->name('etudiant.demande.confirmation');

    Route::post('/etudiant/demande-stage/{idDemande}/confirmer', [EtudiantDemandeStageController::class, 'confirmer'])
        ->name('etudiant.demande.confirmer');
});

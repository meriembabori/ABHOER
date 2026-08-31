<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AccueilController;

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUtilisateurController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminDepartementController;
use App\Http\Controllers\AdminDemandeController;
use App\Http\Controllers\AdminStageController;

/*
|--------------------------------------------------------------------------
| RESPONSABLE
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Responsable\ResponsableDashboardController;
use App\Http\Controllers\Responsable\ResponsableDemandeController;
use App\Http\Controllers\Responsable\ResponsableHistoriqueController;
use App\Http\Controllers\Responsable\ResponsableStageController;
use App\Http\Controllers\Responsable\ResponsableAttestationController;

/*
|--------------------------------------------------------------------------
| ETUDIANT
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\EtudiantDashboardController;
use App\Http\Controllers\EtudiantDemandeStageController;
use App\Http\Controllers\EtudiantProfilController;
use App\Http\Controllers\EtudiantNotificationController;


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| ACCUEIL
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::get('/', [AccueilController::class, 'index'])
    ->name('accueil');

Route::get('/services', [AccueilController::class, 'services'])
    ->name('accueil.services');

Route::get('/localisation', [AccueilController::class, 'localisation'])
    ->name('accueil.localisation');


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    LoginController::class,
    'showLoginForm'
])->name('login');

Route::post('/login', [
    LoginController::class,
    'login'
])->name('login.submit');

Route::post('/logout', [
    LoginController::class,
    'logout'
])->name('logout');


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| INSCRIPTION
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::get('/inscription', [
    InscriptionController::class,
    'showRegistrationForm'
])->name('inscription');

Route::post('/inscription', [
    InscriptionController::class,
    'register'
])->name('inscription.store');


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| ESPACE ETUDIANT
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::prefix('etudiant')
    ->name('etudiant.')
    ->middleware(['auth', 'role:ETUDIANT'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | TABLEAU DE BORD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            EtudiantDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | DEMANDES
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes', [
            EtudiantDemandeStageController::class,
            'index'
        ])->name('demandes.index');


        /*
        |--------------------------------------------------------------------------
        | NOUVELLE DEMANDE
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/nouvelle', [
            EtudiantDemandeStageController::class,
            'create'
        ])->name('demandes.create');


        /*
        |--------------------------------------------------------------------------
        | ETAPE 1 : INFORMATIONS
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/informations', [
            EtudiantDemandeStageController::class,
            'informations'
        ])->name('demandes.informations');

        Route::post('/demandes/informations', [
            EtudiantDemandeStageController::class,
            'storeInformations'
        ])->name('demandes.informations.store');


        /*
        |--------------------------------------------------------------------------
        | DEMANDE SPECIFIQUE
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/{idDemande}', [
            EtudiantDemandeStageController::class,
            'show'
        ])->name('demandes.show');


        /*
        |--------------------------------------------------------------------------
        | DOCUMENTS D'UNE DEMANDE
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/demandes/{idDemande}/documents',
            [
                EtudiantDemandeStageController::class,
                'documents'
            ]
        )->name('demandes.documents');


        /*
        |--------------------------------------------------------------------------
        | ENREGISTRER LES DOCUMENTS
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/demandes/{idDemande}/documents',
            [
                EtudiantDemandeStageController::class,
                'storeDocuments'
            ]
        )->name('demandes.documents.store');


        /*
        |--------------------------------------------------------------------------
        | VOIR UN DOCUMENT
        |--------------------------------------------------------------------------
        |
        | IMPORTANT :
        | Cette route est nommée :
        |
        | etudiant.documents.voir
        |
        | Elle correspond exactement au Blade :
        |
        | route('etudiant.documents.voir', ...)
        |
        */

        Route::get(
            '/demandes/{idDemande}/documents/{idDocument}/voir',
            [
                EtudiantDemandeStageController::class,
                'voirDocument'
            ]
        )->name('documents.voir');


        /*
        |--------------------------------------------------------------------------
        | TELECHARGER UN DOCUMENT
        |--------------------------------------------------------------------------
        |
        | Nom :
        |
        | etudiant.documents.telecharger
        |
        */

        Route::get(
            '/demandes/{idDemande}/documents/{idDocument}/telecharger',
            [
                EtudiantDemandeStageController::class,
                'telechargerDocument'
            ]
        )->name('documents.telecharger');


        /*
        |--------------------------------------------------------------------------
        | SUPPRIMER UN DOCUMENT
        |--------------------------------------------------------------------------
        |
        | Nom :
        |
        | etudiant.documents.destroy
        |
        */

        Route::delete(
            '/demandes/{idDemande}/documents/{idDocument}',
            [
                EtudiantDemandeStageController::class,
                'destroyDocument'
            ]
        )->name('documents.destroy');


        /*
        |--------------------------------------------------------------------------
        | ETAPE 3 : CONFIRMATION
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/demandes/{idDemande}/confirmation',
            [
                EtudiantDemandeStageController::class,
                'confirmation'
            ]
        )->name('demandes.confirmation');


        /*
        |--------------------------------------------------------------------------
        | CONFIRMATION DEFINITIVE
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/demandes/{idDemande}/confirmer',
            [
                EtudiantDemandeStageController::class,
                'confirmer'
            ]
        )->name('demandes.confirmer');


        /*
        |--------------------------------------------------------------------------
        | SUPPRIMER UNE DEMANDE
        |--------------------------------------------------------------------------
        */

        Route::delete('/demandes/{idDemande}', [
            EtudiantDemandeStageController::class,
            'destroy'
        ])->name('demandes.destroy');


        /*
        |--------------------------------------------------------------------------
        | MES DOCUMENTS
        |--------------------------------------------------------------------------
        |
        | URL :
        | /etudiant/documents
        |
        | Nom :
        | etudiant.documents.index
        |
        */

        Route::get('/documents', [
            EtudiantDemandeStageController::class,
            'documentsIndex'
        ])->name('documents.index');


        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */

        Route::get('/notifications', [
            EtudiantNotificationController::class,
            'index'
        ])->name('notifications');

        Route::post(
            '/notifications/{idNotification}/lire',
            [
                EtudiantNotificationController::class,
                'lire'
            ]
        )->name('notifications.lire');

        Route::post(
            '/notifications/lire-toutes',
            [
                EtudiantNotificationController::class,
                'lireToutes'
            ]
        )->name('notifications.lire-toutes');


        /*
        |--------------------------------------------------------------------------
        | PROFIL
        |--------------------------------------------------------------------------
        */

        Route::get('/profil', [
            EtudiantProfilController::class,
            'index'
        ])->name('profil');

        Route::get('/profil/modifier', [
            EtudiantProfilController::class,
            'edit'
        ])->name('profil.edit');

        Route::put('/profil', [
            EtudiantProfilController::class,
            'update'
        ])->name('profil.update');

    });


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| ESPACE ADMINISTRATEUR
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:ADMINISTRATEUR'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | TABLEAU DE BORD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | UTILISATEURS
        |--------------------------------------------------------------------------
        */

        Route::get('/utilisateurs', [
            AdminUtilisateurController::class,
            'index'
        ])->name('utilisateurs.index');

        Route::get('/utilisateurs/create', [
            AdminUtilisateurController::class,
            'create'
        ])->name('utilisateurs.create');

        Route::post('/utilisateurs', [
            AdminUtilisateurController::class,
            'store'
        ])->name('utilisateurs.store');

        Route::get(
            '/utilisateurs/{idUtilisateur}/edit',
            [
                AdminUtilisateurController::class,
                'edit'
            ]
        )->name('utilisateurs.edit');

        Route::put(
            '/utilisateurs/{idUtilisateur}',
            [
                AdminUtilisateurController::class,
                'update'
            ]
        )->name('utilisateurs.update');

        Route::patch(
            '/utilisateurs/{idUtilisateur}/toggle',
            [
                AdminUtilisateurController::class,
                'toggle'
            ]
        )->name('utilisateurs.toggle');

        Route::delete(
            '/utilisateurs/{idUtilisateur}',
            [
                AdminUtilisateurController::class,
                'destroy'
            ]
        )->name('utilisateurs.destroy');


        /*
        |--------------------------------------------------------------------------
        | DEPARTEMENTS
        |--------------------------------------------------------------------------
        */

        Route::get('/departements', [
            AdminDepartementController::class,
            'index'
        ])->name('departements.index');

        Route::get('/departements/create', [
            AdminDepartementController::class,
            'create'
        ])->name('departements.create');

        Route::post('/departements', [
            AdminDepartementController::class,
            'store'
        ])->name('departements.store');

        Route::get(
            '/departements/{id}/edit',
            [
                AdminDepartementController::class,
                'edit'
            ]
        )->name('departements.edit');

        Route::put(
            '/departements/{id}',
            [
                AdminDepartementController::class,
                'update'
            ]
        )->name('departements.update');

        Route::delete(
            '/departements/{id}',
            [
                AdminDepartementController::class,
                'destroy'
            ]
        )->name('departements.destroy');


        /*
        |--------------------------------------------------------------------------
        | SERVICES
        |--------------------------------------------------------------------------
        */

        Route::get('/services', [
            AdminServiceController::class,
            'index'
        ])->name('services.index');

        Route::get('/services/create', [
            AdminServiceController::class,
            'create'
        ])->name('services.create');

        Route::post('/services', [
            AdminServiceController::class,
            'store'
        ])->name('services.store');

        Route::get(
            '/services/{id}/edit',
            [
                AdminServiceController::class,
                'edit'
            ]
        )->name('services.edit');

        Route::put(
            '/services/{id}',
            [
                AdminServiceController::class,
                'update'
            ]
        )->name('services.update');

        Route::delete(
            '/services/{id}',
            [
                AdminServiceController::class,
                'destroy'
            ]
        )->name('services.destroy');


        /*
        |--------------------------------------------------------------------------
        | DEMANDES DE STAGE
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes', [
            AdminDemandeController::class,
            'index'
        ])->name('demandes.index');

        Route::get('/demandes/{id}', [
            AdminDemandeController::class,
            'show'
        ])->name('demandes.show');


        /*
        |--------------------------------------------------------------------------
        | STAGES
        |--------------------------------------------------------------------------
        */

        Route::get('/stages', [
            AdminStageController::class,
            'index'
        ])->name('stages.index');

        Route::get('/stages/{idDemande}', [
            AdminStageController::class,
            'show'
        ])->name('stages.show');

    });


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| ESPACE RESPONSABLE
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::prefix('responsable')
    ->name('responsable.')
    ->middleware(['auth', 'role:RESPONSABLE'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | TABLEAU DE BORD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            ResponsableDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | DEMANDES
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes', [
            ResponsableDemandeController::class,
            'index'
        ])->name('demandes.index');

        Route::get('/demandes/create', [
            ResponsableDemandeController::class,
            'create'
        ])->name('demandes.create');

        Route::post('/demandes', [
            ResponsableDemandeController::class,
            'store'
        ])->name('demandes.store');

        Route::get('/demandes/{id}', [
            ResponsableDemandeController::class,
            'show'
        ])->name('demandes.show');

        Route::post(
            '/demandes/{id}/accepter',
            [
                ResponsableDemandeController::class,
                'accepter'
            ]
        )->name('demandes.accepter');

        Route::post(
            '/demandes/{id}/refuser',
            [
                ResponsableDemandeController::class,
                'refuser'
            ]
        )->name('demandes.refuser');

        Route::post(
            '/demandes/{id}/demander-infos',
            [
                ResponsableDemandeController::class,
                'demanderInfos'
            ]
        )->name('demandes.demander-infos');

        Route::post(
            '/demandes/{id}/affecter',
            [
                ResponsableDemandeController::class,
                'affecter'
            ]
        )->name('demandes.affecter');

        Route::post(
            '/demandes/{id}/documents',
            [
                ResponsableDemandeController::class,
                'storeDocument'
            ]
        )->name('demandes.documents.store');


        /*
        |--------------------------------------------------------------------------
        | STAGES
        |--------------------------------------------------------------------------
        */

        Route::get('/stages', [
            ResponsableStageController::class,
            'index'
        ])->name('stages.index');


        /*
        |--------------------------------------------------------------------------
        | HISTORIQUE
        |--------------------------------------------------------------------------
        */

        Route::get('/historique', [
            ResponsableHistoriqueController::class,
            'index'
        ])->name('historique.index');


        /*
        |--------------------------------------------------------------------------
        | ATTESTATIONS
        |--------------------------------------------------------------------------
        */

        Route::get('/attestations', [
            ResponsableAttestationController::class,
            'index'
        ])->name('attestations.index');

        Route::post('/attestations/demarrer/{idDemande}', [
            ResponsableAttestationController::class,
            'demarrer'
        ])->name('attestations.demarrer');

        Route::post('/attestations/{id}/prete', [
            ResponsableAttestationController::class,
            'marquerPrete'
        ])->name('attestations.prete');

        Route::post('/attestations/{id}/remise', [
            ResponsableAttestationController::class,
            'marquerRemise'
        ])->name('attestations.remise');

    });

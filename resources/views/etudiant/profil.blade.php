<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mon profil - ABHOER</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        /* =========================================================
           PROFIL ÉTUDIANT — PREMIUM
        ========================================================= */

        :root {

            --navy: #102f52;
            --blue: #2563eb;
            --blue-light: #eff6ff;
            --bg: #f3f6fa;
            --text: #172033;
            --muted: #718096;
            --border: #e4eaf1;

        }


        /* =========================================================
           BODY
        ========================================================= */

        body {

            background:
                radial-gradient(
                    circle at top right,
                    rgba(37, 99, 235, .07),
                    transparent 32%
                ),
                var(--bg);

            color: var(--text);

            font-family:
                Inter,
                "Segoe UI",
                Arial,
                sans-serif;

        }


        /* =========================================================
           TOPBAR
        ========================================================= */

        .topbar {

            background:
                rgba(255, 255, 255, .94);

            backdrop-filter:
                blur(14px);

            border-bottom:
                1px solid var(--border);

            padding:
                17px 30px;

            box-shadow:
                0 4px 20px rgba(15, 35, 65, .04);

        }


        /* =========================================================
           BRAND
        ========================================================= */

        .brand {

            color:
                var(--navy);

            font-size:
                21px;

            font-weight:
                800;

            text-decoration:
                none;

            letter-spacing:
                .4px;

        }

        .brand small {

            color:
                var(--muted);

            font-size:
                11px;

            margin-left:
                4px;

        }


        /* =========================================================
           CONTENT
        ========================================================= */

        .content {

            max-width:
                1150px;

            margin:
                0 auto;

            padding:
                42px 25px;

        }


        /* =========================================================
           TITLE
        ========================================================= */

        .page-title {

            color:
                var(--navy);

            font-size:
                28px;

            font-weight:
                800;

            letter-spacing:
                -.5px;

        }

        .page-subtitle {

            color:
                var(--muted);

        }


        /* =========================================================
           PROFILE CARD
        ========================================================= */

        .profile-card {

            background:
                #ffffff;

            border:
                1px solid var(--border);

            border-radius:
                18px;

            box-shadow:
                0 10px 35px rgba(15, 35, 65, .07);

            overflow:
                hidden;

        }


        /* =========================================================
           HEADER
        ========================================================= */

        .profile-header {

            position:
                relative;

            background:
                linear-gradient(
                    135deg,
                    #102f52,
                    #174a78
                );

            padding:
                30px 34px;

            color:
                #ffffff;

        }

        .profile-header::after {

            content:
                "";

            position:
                absolute;

            width:
                180px;

            height:
                180px;

            right:
                -60px;

            top:
                -80px;

            border-radius:
                50%;

            background:
                rgba(255, 255, 255, .05);

        }

        .profile-header h4 {

            font-size:
                20px;

            margin-bottom:
                5px;

        }

        .profile-header p {

            color:
                rgba(255, 255, 255, .65);

            margin-bottom:
                0;

        }


        /* =========================================================
           BODY
        ========================================================= */

        .profile-body {

            padding:
                34px;

        }


        /* =========================================================
           SECTIONS
        ========================================================= */

        .section-title {

            color:
                var(--navy);

            font-size:
                15px;

            font-weight:
                750;

            padding-bottom:
                12px;

            border-bottom:
                1px solid var(--border);

            margin-bottom:
                20px;

        }


        /* =========================================================
           INFO
        ========================================================= */

        .info-item {

            position:
                relative;

            padding:
                18px 20px;

            background:
                #f8fafc;

            border:
                1px solid var(--border);

            border-radius:
                12px;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease;

        }

        .info-item:hover {

            background:
                #ffffff;

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px rgba(15, 35, 65, .06);

        }

        .info-label {

            color:
                #8290a3;

            font-size:
                10px;

            font-weight:
                750;

            letter-spacing:
                .8px;

            text-transform:
                uppercase;

            margin-bottom:
                5px;

        }

        .info-value {

            color:
                #1e293b;

            font-size:
                15px;

            font-weight:
                650;

            word-break:
                break-word;

        }


        /* =========================================================
           BUTTONS
        ========================================================= */

        .btn {

            border-radius:
                10px;

            font-weight:
                650;

            padding:
                10px 17px;

        }

        .btn-primary {

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #174ea6
                );

            border:
                none;

            box-shadow:
                0 5px 15px rgba(37, 99, 235, .20);

        }

        .btn-primary:hover {

            background:
                linear-gradient(
                    135deg,
                    #1d4ed8,
                    #123d86
                );

        }

        .btn-light-custom {

            background:
                #f8fafc;

            border:
                1px solid var(--border);

            color:
                #475569;

        }

        .btn-light-custom:hover {

            background:
                #eef2f7;

            color:
                var(--navy);

        }


        /* =========================================================
           LOGOUT
        ========================================================= */

        .logout-btn {

            border:
                none;

            background:
                transparent;

            color:
                #64748b;

            font-weight:
                600;

        }

        .logout-btn:hover {

            color:
                #dc2626;

        }


        /* =========================================================
           ALERTS
        ========================================================= */

        .success-message {

            background:
                #ecfdf3;

            border:
                1px solid #bbf7d0;

            color:
                #166534;

            border-radius:
                12px;

            padding:
                14px 17px;

            margin-bottom:
                20px;

        }

        .error-message {

            background:
                #fff1f2;

            border:
                1px solid #fecdd3;

            color:
                #be123c;

            border-radius:
                12px;

            padding:
                14px 17px;

            margin-bottom:
                20px;

        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 767px) {

            .content {

                padding:
                    25px 15px;

            }

            .profile-body {

                padding:
                    22px;

            }

            .profile-header {

                padding:
                    24px;

            }

            .topbar {

                padding:
                    15px;

            }

            .brand small {

                display:
                    block;

                margin-left:
                    0;

            }

        }

    </style>

</head>


<body>

<div class="page-wrapper">


    {{-- =========================================================
         BARRE SUPERIEURE
    ========================================================= --}}

    <div class="topbar">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center">

                <a
                    href="{{ route('etudiant.dashboard') }}"
                    class="brand"
                >

                    ABHOER

                    <small>
                        Gestion des stages
                    </small>

                </a>


                <div class="d-flex align-items-center gap-3">

                    <span class="text-secondary small">

                        {{ $user->prenom ?? '' }}
                        {{ $user->nom ?? '' }}

                    </span>


                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="logout-btn"
                        >

                            <i class="bi bi-box-arrow-right me-1"></i>

                            Déconnexion

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         CONTENU
    ========================================================= --}}

    <main class="content">


        {{-- TITRE --}}

        <div class="mb-4">

            <h2 class="page-title">

                Mon profil

            </h2>

            <p class="page-subtitle">

                Consultez et gérez vos informations personnelles et universitaires.

            </p>

        </div>


        {{-- =====================================================
             MESSAGE SUCCÈS
        ====================================================== --}}

        @if(session('success'))

            <div class="success-message">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- =====================================================
             MESSAGE ERREUR
        ====================================================== --}}

        @if(session('error'))

            <div class="error-message">

                <i class="bi bi-exclamation-circle me-2"></i>

                {{ session('error') }}

            </div>

        @endif


        {{-- =====================================================
             CARTE PROFIL
        ====================================================== --}}

        <div class="profile-card">


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div class="profile-header">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h4>
                            Informations du candidat
                        </h4>

                        <p>
                            Vos informations enregistrées dans ABHOER
                        </p>

                    </div>


                    @if ($candidat->photo)
                        <img
                            src="{{ asset('storage/' . $candidat->photo) }}"
                            alt="Photo de profil"
                            style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:2px solid #e5e7eb;"
                        >
                    @else
                        <i
                            class="bi bi-person-circle"
                            style="font-size: 42px;"
                        ></i>
                    @endif

                </div>

            </div>


            {{-- =================================================
                 BODY
            ================================================== --}}

            <div class="profile-body">


                {{-- =================================================
                     INFORMATIONS PERSONNELLES
                ================================================== --}}

                <div class="section-title">

                    <i class="bi bi-person me-2"></i>

                    Informations personnelles

                </div>


                <div class="row g-3 mb-4">


                    {{-- NOM --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Nom
                            </div>

                            <div class="info-value">

                                {{ $candidat->nom ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- PRENOM --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Prénom
                            </div>

                            <div class="info-value">

                                {{ $candidat->prenom ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- CIN --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                CIN
                            </div>

                            <div class="info-value">

                                {{ $candidat->cin ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- CNE --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                CNE
                            </div>

                            <div class="info-value">

                                {{ $candidat->cne ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         DATE DE NAISSANCE
                         CORRECTION : DATE SEULEMENT
                    ================================================== --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Date de naissance
                            </div>

                            <div class="info-value">

                                @if(!empty($candidat->dateNaissance))

                                    {{ \Carbon\Carbon::parse($candidat->dateNaissance)->format('d/m/Y') }}

                                @else

                                    -

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- TELEPHONE --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Téléphone
                            </div>

                            <div class="info-value">

                                {{ $candidat->telephone ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- EMAIL --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Adresse email
                            </div>

                            <div class="info-value">

                                {{ $candidat->email ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- ADRESSE --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Adresse
                            </div>

                            <div class="info-value">

                                {{ $candidat->adresse ?? '-' }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     INFORMATIONS UNIVERSITAIRES
                ================================================== --}}

                <div class="section-title">

                    <i class="bi bi-mortarboard me-2"></i>

                    Informations universitaires

                </div>


                <div class="row g-3 mb-4">


                    {{-- ETABLISSEMENT --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Établissement
                            </div>

                            <div class="info-value">

                                {{ $candidat->etablissement ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- FORMATION --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Formation
                            </div>

                            <div class="info-value">

                                {{ $candidat->formation ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- NIVEAU --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Niveau d'étude
                            </div>

                            <div class="info-value">

                                {{ $candidat->niveauEtude ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- ANNEE UNIVERSITAIRE --}}

                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Année universitaire
                            </div>

                            <div class="info-value">

                                {{ $candidat->anneeUniversitaire ?? '-' }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     BOUTONS
                ================================================== --}}

                <div class="d-flex justify-content-end gap-2">


                    <a
                        href="{{ route('etudiant.dashboard') }}"
                        class="btn btn-light-custom"
                    >

                        <i class="bi bi-arrow-left me-2"></i>

                        Retour

                    </a>


                    <a
                        href="{{ route('etudiant.profil.edit') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-pencil me-2"></i>

                        Modifier mon profil

                    </a>

                </div>


            </div>

        </div>

    </main>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>
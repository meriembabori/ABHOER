<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mon profil - ABHOER</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .header {
            background: linear-gradient(135deg, #0d6e6e, #25a6a6);
            color: white;
            padding: 18px 35px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout button {
            background: white;
            color: #0d6e6e;
            border: none;

            padding: 10px 20px;

            border-radius: 6px;

            font-weight: bold;
            cursor: pointer;
        }

        .logout button:hover {
            background: #e2e8f0;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 35px auto;
        }

        .card {
            background: white;
            padding: 30px;

            border-radius: 10px;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #0d6e6e;
            margin-top: 0;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 30px;
        }

        .section-title {
            color: #0d6e6e;

            border-bottom:
                2px solid #e2e8f0;

            padding-bottom: 8px;

            margin-top: 25px;
        }

        .grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 20px;

            margin-top: 20px;
        }

        .info {
            background: #f8fafc;

            padding: 15px;

            border-radius: 6px;
        }

        .info strong {
            display: block;

            margin-bottom: 7px;

            color: #334155;
        }

        .info span {
            color: #475569;
        }

        /* Message de succès */

        .success {
            background: #dcfce7;
            color: #166534;

            padding: 15px;

            border-radius: 6px;

            margin-bottom: 20px;

            border: 1px solid #bbf7d0;
        }

        /* Message d'erreur */

        .error {
            background: #fee2e2;
            color: #991b1b;

            padding: 15px;

            border-radius: 6px;

            margin-bottom: 20px;

            border: 1px solid #fecaca;
        }

        .actions {
            margin-top: 30px;

            display: flex;

            gap: 15px;
        }

        .button {
            display: inline-block;

            padding: 11px 20px;

            border-radius: 6px;

            background: #0d6e6e;

            color: white;

            text-decoration: none;

            font-weight: bold;
        }

        .button:hover {
            background: #14606a;
        }

        .button.secondary {
            background: #64748b;
        }

        .button.secondary:hover {
            background: #475569;
        }

        @media (max-width: 700px) {

            .grid {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 15px 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .container {
                width: 95%;
            }

            .card {
                padding: 20px;
            }

        }
    </style>

</head>


<body>

    <!-- ================================= -->
    <!-- EN-TÊTE -->
    <!-- ================================= -->

    <header class="header">

        <h1>
            ABHOER - Gestion des stages
        </h1>

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="logout"
        >

            @csrf

            <button type="submit">
                Se déconnecter
            </button>

        </form>

    </header>


    <!-- ================================= -->
    <!-- CONTENU PRINCIPAL -->
    <!-- ================================= -->

    <main class="container">

        <div class="card">


            <!-- ================================= -->
            <!-- MESSAGES -->
            <!-- ================================= -->

            @if (session('success'))

                <div class="success">
                    {{ session('success') }}
                </div>

            @endif


            @if (session('error'))

                <div class="error">
                    {{ session('error') }}
                </div>

            @endif


            <!-- ================================= -->
            <!-- TITRE -->
            <!-- ================================= -->

            <h2>
                Mon profil
            </h2>

            <p class="subtitle">
                Consultez vos informations personnelles et académiques.
            </p>


            <!-- ================================= -->
            <!-- INFORMATIONS PERSONNELLES -->
            <!-- ================================= -->

            <h3 class="section-title">
                Informations personnelles
            </h3>


            <div class="grid">


                <!-- Nom -->

                <div class="info">

                    <strong>
                        Nom
                    </strong>

                    <span>
                        {{ $candidat->nom ?? $utilisateur->nom }}
                    </span>

                </div>


                <!-- Prénom -->

                <div class="info">

                    <strong>
                        Prénom
                    </strong>

                    <span>
                        {{ $candidat->prenom ?? $utilisateur->prenom }}
                    </span>

                </div>


                <!-- CIN -->

                <div class="info">

                    <strong>
                        CIN
                    </strong>

                    <span>
                        {{ $candidat->cin ?? 'Non renseignée' }}
                    </span>

                </div>


                <!-- Téléphone -->

                <div class="info">

                    <strong>
                        Téléphone
                    </strong>

                    <span>
                        {{ $candidat->telephone ?? 'Non renseigné' }}
                    </span>

                </div>


                <!-- Email -->

                <div class="info">

                    <strong>
                        Email
                    </strong>

                    <span>
                        {{ $candidat->email ?? 'Non renseigné' }}
                    </span>

                </div>

            </div>


            <!-- ================================= -->
            <!-- INFORMATIONS ACADÉMIQUES -->
            <!-- ================================= -->

            <h3 class="section-title">
                Informations académiques
            </h3>


            <div class="grid">


                <!-- Établissement -->

                <div class="info">

                    <strong>
                        Établissement
                    </strong>

                    <span>
                        {{ $candidat->etablissement ?? 'Non renseigné' }}
                    </span>

                </div>


                <!-- Formation -->

                <div class="info">

                    <strong>
                        Formation
                    </strong>

                    <span>
                        {{ $candidat->formation ?? 'Non renseignée' }}
                    </span>

                </div>


                <!-- Niveau d'étude -->

                <div class="info">

                    <strong>
                        Niveau d'étude
                    </strong>

                    <span>
                        {{ $candidat->niveauEtude ?? 'Non renseigné' }}
                    </span>

                </div>

            </div>


            <!-- ================================= -->
            <!-- INFORMATIONS DU COMPTE -->
            <!-- ================================= -->

            <h3 class="section-title">
                Informations du compte
            </h3>


            <div class="grid">


                <!-- Login -->

                <div class="info">

                    <strong>
                        Login
                    </strong>

                    <span>
                        {{ $utilisateur->login }}
                    </span>

                </div>


                <!-- Rôle -->

                <div class="info">

                    <strong>
                        Rôle
                    </strong>

                    <span>
                        {{ $utilisateur->role }}
                    </span>

                </div>

            </div>


            <!-- ================================= -->
            <!-- BOUTONS -->
            <!-- ================================= -->

            <div class="actions">

                <a
                    href="{{ route('etudiant.dashboard') }}"
                    class="button secondary"
                >
                    ← Retour
                </a>


                <a
                    href="{{ route('etudiant.profil.edit') }}"
                    class="button"
                >
                    Modifier mon profil
                </a>

            </div>


        </div>

    </main>


</body>

</html>
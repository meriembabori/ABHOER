<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modifier mon profil - ABHOER</title>

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

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;

            margin-bottom: 8px;

            color: #334155;
        }

        .form-group input {
            padding: 11px;

            border: 1px solid #cbd5e1;

            border-radius: 6px;

            font-size: 15px;

            outline: none;
        }

        .form-group input:focus {
            border-color: #0d6e6e;

            box-shadow:
                0 0 0 2px
                rgba(8, 96, 140, 0.1);
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

            border: none;

            cursor: pointer;

            font-size: 15px;
        }

        .button.secondary {
            background: #64748b;
        }

        .button:hover {
            opacity: 0.9;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;

            padding: 15px;

            border-radius: 6px;

            margin-bottom: 20px;
        }

        .error ul {
            margin: 0;
            padding-left: 20px;
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

    <!-- En-tête -->

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


    <!-- Contenu -->

    <main class="container">

        <div class="card">

            <h2>
                Modifier mon profil
            </h2>

            <p class="subtitle">
                Modifiez vos informations personnelles et académiques.
            </p>


            <!-- Messages d'erreur -->

            @if ($errors->any())

                <div class="error">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- FORMULAIRE -->

            <form
                method="POST"
                action="{{ route('etudiant.profil.update') }}"
            >

                @csrf

                @method('PUT')


                <!-- Informations personnelles -->

                <h3 class="section-title">
                    Informations personnelles
                </h3>

                <div class="grid">

                    <div class="form-group">

                        <label for="cin">
                            CIN
                        </label>

                        <input
                            type="text"
                            id="cin"
                            name="cin"
                            value="{{ old('cin', $candidat->cin ?? '') }}"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="telephone">
                            Téléphone
                        </label>

                        <input
                            type="text"
                            id="telephone"
                            name="telephone"
                            value="{{ old('telephone', $candidat->telephone ?? '') }}"
                        >

                    </div>


                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $candidat->email ?? '') }}"
                            required
                        >

                    </div>

                </div>


                <!-- Informations académiques -->

                <h3 class="section-title">
                    Informations académiques
                </h3>

                <div class="grid">

                    <div class="form-group">

                        <label for="etablissement">
                            Établissement
                        </label>

                        <input
                            type="text"
                            id="etablissement"
                            name="etablissement"
                            value="{{ old('etablissement', $candidat->etablissement ?? '') }}"
                        >

                    </div>


                    <div class="form-group">

                        <label for="formation">
                            Formation
                        </label>

                        <input
                            type="text"
                            id="formation"
                            name="formation"
                            value="{{ old('formation', $candidat->formation ?? '') }}"
                        >

                    </div>


                    <div class="form-group">

                        <label for="niveauEtude">
                            Niveau d'étude
                        </label>

                        <input
                            type="text"
                            id="niveauEtude"
                            name="niveauEtude"
                            value="{{ old('niveauEtude', $candidat->niveauEtude ?? '') }}"
                        >

                    </div>

                </div>


                <!-- Boutons -->

                <div class="actions">

                    <a
                        href="{{ route('etudiant.profil') }}"
                        class="button secondary"
                    >
                        ← Annuler
                    </a>

                    <button
                        type="submit"
                        class="button"
                    >
                        Enregistrer
                    </button>

                </div>

            </form>

        </div>

    </main>

</body>

</html>
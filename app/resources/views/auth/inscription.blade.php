<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inscription étudiant - ABHOER</title>

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
            background: #1a7a86;
            color: white;
            padding: 18px 35px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 35px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .title h2 {
            color: #1a7a86;
            margin-bottom: 8px;
        }

        .title p {
            color: #64748b;
        }

        .section-title {
            color: #1a7a86;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 8px;
            margin-top: 25px;
            margin-bottom: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / 3;
        }

        label {
            font-weight: bold;
            margin-bottom: 7px;
        }

        input {
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #1a7a86;
        }

        .button-container {
            margin-top: 30px;
            text-align: center;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 6px;
            background: #1a7a86;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #064d72;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #1a7a86;
            text-decoration: none;
            font-weight: bold;
        }

        .errors {
            background: #fee2e2;
            color: #b91c1c;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        @media (max-width: 700px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: 1;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>ABHOER - Gestion des stages</h1>
    </div>

    <div class="container">

        <div class="card">

            <div class="title">
                <h2>Créer un compte étudiant</h2>
                <p>Inscription à la plateforme de gestion des demandes de stage</p>
            </div>

            @if ($errors->any())
                <div class="errors">
                    <strong>Veuillez corriger les erreurs suivantes :</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('inscription.register') }}">
                @csrf

                <h3 class="section-title">Informations personnelles</h3>

                <div class="form-grid">

                    <div class="form-group">
                        <label for="nom">Nom *</label>

                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            value="{{ old('nom') }}"
                            placeholder="Votre nom"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom *</label>

                        <input
                            type="text"
                            id="prenom"
                            name="prenom"
                            value="{{ old('prenom') }}"
                            placeholder="Votre prénom"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="cin">CIN *</label>

                        <input
                            type="text"
                            id="cin"
                            name="cin"
                            value="{{ old('cin') }}"
                            placeholder="Ex : AB123456"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="telephone">Téléphone</label>

                        <input
                            type="text"
                            id="telephone"
                            name="telephone"
                            value="{{ old('telephone') }}"
                            placeholder="06XXXXXXXX"
                        >
                    </div>

                    <div class="form-group full">
                        <label for="email">Email *</label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="exemple@email.com"
                            required
                        >
                    </div>

                </div>


                <h3 class="section-title">Informations académiques</h3>

                <div class="form-grid">

                    <div class="form-group full">
                        <label for="etablissement">Établissement</label>

                        <input
                            type="text"
                            id="etablissement"
                            name="etablissement"
                            value="{{ old('etablissement') }}"
                            placeholder="Nom de votre établissement"
                        >
                    </div>

                    <div class="form-group">
                        <label for="formation">Formation</label>

                        <input
                            type="text"
                            id="formation"
                            name="formation"
                            value="{{ old('formation') }}"
                            placeholder="Ex : MIACSD"
                        >
                    </div>

                    <div class="form-group">
                        <label for="niveauEtude">Niveau d'étude</label>

                        <input
                            type="text"
                            id="niveauEtude"
                            name="niveauEtude"
                            value="{{ old('niveauEtude') }}"
                            placeholder="Ex : Licence / Bac+3"
                        >
                    </div>

                </div>


                <h3 class="section-title">Informations de connexion</h3>

                <div class="form-grid">

                    <div class="form-group full">
                        <label for="login">Login *</label>

                        <input
                            type="text"
                            id="login"
                            name="login"
                            value="{{ old('login') }}"
                            placeholder="Choisissez votre login"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="motDePasse">Mot de passe *</label>

                        <input
                            type="password"
                            id="motDePasse"
                            name="motDePasse"
                            placeholder="Votre mot de passe"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="motDePasse_confirmation">
                            Confirmer le mot de passe *
                        </label>

                        <input
                            type="password"
                            id="motDePasse_confirmation"
                            name="motDePasse_confirmation"
                            placeholder="Confirmez votre mot de passe"
                            required
                        >
                    </div>

                </div>


                <div class="button-container">
                    <button type="submit">
                        Créer mon compte
                    </button>
                </div>

            </form>

            <div class="login-link">
                Déjà inscrit ?
                <a href="{{ route('login') }}">
                    Se connecter
                </a>
            </div>

        </div>

    </div>

</body>
</html>
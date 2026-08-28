<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion - ABHOER</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --abh-teal-dark: #1a7a86;
            --abh-teal: #2fa9b0;
            --abh-teal-light: #9bd9d6;
            --abh-teal-pale: #e6f7f6;
            --abh-blue-accent: #519fad;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(160deg, var(--abh-teal-pale) 0%, #ffffff 55%, var(--abh-teal-pale) 100%);
        }

        /* Vagues animées en fond */
        .wave-bg {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            line-height: 0;
            z-index: 0;
        }

        .wave-bg svg {
            width: 100%;
            height: 180px;
            display: block;
        }

        .wave-bg .wave-path-1 {
            animation: waveShift 14s ease-in-out infinite;
        }

        .wave-bg .wave-path-2 {
            animation: waveShift 18s ease-in-out infinite reverse;
        }

        @keyframes waveShift {
            0%   { transform: translateX(0); }
            50%  { transform: translateX(-40px); }
            100% { transform: translateX(0); }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 420px;
            background: white;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 15px 45px rgba(26, 122, 134, 0.18);
            border-top: 5px solid var(--abh-teal);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 220px;
            margin-bottom: 12px;
        }

        .logo p {
            color: #6b8b8d;
            font-size: 13px;
            letter-spacing: 0.3px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #2d4a4d;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cfe6e5;
            border-radius: 8px;
            font-size: 15px;
            background: #fafffe;
        }

        input:focus {
            outline: none;
            border-color: var(--abh-teal);
            box-shadow: 0 0 0 3px rgba(47, 169, 176, 0.15);
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--abh-teal-dark), var(--abh-teal));
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        button:hover {
            opacity: 0.9;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="wave-bg">
        <svg viewBox="0 0 1440 180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path class="wave-path-1" fill="#9bd9d6" fill-opacity="0.55"
                d="M0,90 C240,150 480,30 720,80 C960,130 1200,50 1440,100 L1440,180 L0,180 Z"></path>
            <path class="wave-path-2" fill="#2fa9b0" fill-opacity="0.35"
                d="M0,120 C300,60 600,160 900,100 C1150,55 1300,110 1440,90 L1440,180 L0,180 Z"></path>
        </svg>
    </div>

    <div class="login-container">

        <div class="logo">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="ABHOER - Agence du Bassin Hydraulique de l'Oum Er-Rbia">
            <p>Plateforme de gestion des demandes de stage</p>
        </div>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="form-group">
                <label for="login">Login</label>

                <input
                    type="text"
                    id="login"
                    name="login"
                    value="{{ old('login') }}"
                    placeholder="Entrez votre login"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="motDePasse">Mot de passe</label>

                <input
                    type="password"
                    id="motDePasse"
                    name="motDePasse"
                    placeholder="Entrez votre mot de passe"
                    required
                >
            </div>

            <button type="submit">
                Se connecter
            </button>
        </form>

        <p style="text-align:center;margin-top:18px;font-size:13px;color:#6b8b8d;">
            Pas encore de compte ? <a href="{{ route('inscription') }}" style="color:var(--abh-teal-dark);font-weight:bold;">S'inscrire</a>
        </p>
        <p style="text-align:center;margin-top:8px;font-size:13px;">
            <a href="{{ route('accueil') }}" style="color:#6b8b8d;">&larr; Retour à l'accueil</a>
        </p>

    </div>

</body>
</html>

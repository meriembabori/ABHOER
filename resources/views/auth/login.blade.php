<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ABHOER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --c-teal-dark: #0d6e6e;
            --c-teal: #25a6a6;
            --c-teal-pale: #e6f4f4;
            --c-navy: #0f172a;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        a { text-decoration: none; }

        /* -------- Left panel -------- */
        .side-panel {
            position: relative;
            background: url('{{ asset("images/bassin/barrage-1.jpeg") }}') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 46px;
            color: white;
            overflow: hidden;
        }
        .side-panel::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(180deg, rgba(15,23,42,0.55) 0%, rgba(13,110,110,0.75) 100%);
        }
        .side-panel > * { position: relative; z-index: 1; }

        .side-brand { display: flex; align-items: center; gap: 12px; }
        .side-brand .logo-badge {
            width: 44px; height: 44px; border-radius: 12px; background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; font-size: 21px;
        }
        .side-brand div div:first-child { font-weight: 700; font-size: 17px; }
        .side-brand div div:last-child { font-size: 11px; opacity: 0.85; margin-top: 2px; }

        .side-message h2 { font-size: 28px; line-height: 1.3; margin-bottom: 14px; animation: fadeUp 1s ease both; }
        .side-message p { font-size: 14px; opacity: 0.9; max-width: 380px; line-height: 1.6; animation: fadeUp 1.2s ease both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px);} to {opacity:1; transform: translateY(0);} }

        /* -------- Right panel (form) -------- */
        .form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #fbfdfd;
        }

        .form-box { width: 100%; max-width: 380px; }

        .form-box h1 { font-size: 24px; color: var(--c-navy); margin-bottom: 6px; }
        .form-box p.subtitle { font-size: 13.5px; color: #64748b; margin-bottom: 30px; }

        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 7px; font-size: 12.5px; font-weight: 600; color: #334155; }

        input {
            width: 100%; padding: 12px 14px; border: 1px solid #e2e8f0; border-radius: 10px;
            font-size: 14px; background: white;
        }
        input:focus { outline: none; border-color: var(--c-teal); box-shadow: 0 0 0 3px rgba(37,166,166,0.12); }

        button[type="submit"] {
            width: 100%; padding: 13px; border: none; border-radius: 10px;
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark)); color: white;
            font-size: 15px; font-weight: 700; cursor: pointer; margin-top: 6px;
            box-shadow: 0 10px 22px rgba(13,110,110,0.25); transition: transform 0.15s;
        }
        button[type="submit"]:hover { transform: translateY(-2px); }

        .error {
            background: #fef2f2; color: #991b1b; padding: 11px 14px; border-radius: 10px;
            margin-bottom: 20px; font-size: 13px; border-left: 3px solid #ef4444;
        }

        .form-footer { text-align: center; margin-top: 22px; font-size: 13px; color: #64748b; }
        .form-footer a { color: var(--c-teal-dark); font-weight: 700; }
        .back-link { display: inline-flex; align-items: center; gap: 5px; font-size: 12.5px; color: #94a3b8; margin-top: 12px; }

        @media (max-width: 860px) {
            body { grid-template-columns: 1fr; }
            .side-panel { min-height: 220px; padding: 30px; }
            .side-message h2 { font-size: 22px; }
        }
    
        .side-brand .logo-badge-img {
            width: 46px; height: 46px; object-fit: contain; border-radius: 12px; background: rgba(255,255,255,0.9); padding: 4px;
        }
</style>
</head>

<body>

    <div class="side-panel">
        <div class="side-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="logo-badge-img">
            <div>
                <div>ABHOER</div>
                <div>Bassin Hydraulique de l'Oum Er-Rbia</div>
            </div>
        </div>

        <div class="side-message">
            <h2>Bienvenue !</h2>
            <p>Connectez-vous pour accéder à votre espace personnel et suivre le traitement de vos demandes en toute simplicité.</p>
        </div>
    </div>

    <div class="form-panel">
        <div class="form-box">
            <h1>Connexion</h1>
            <p class="subtitle">Accédez à votre espace ABHOER.</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Votre login" required autofocus>
                </div>

                <div class="form-group">
                    <label for="motDePasse">Mot de passe</label>
                    <input type="password" id="motDePasse" name="motDePasse" placeholder="••••••••" required>
                </div>

                <button type="submit"><i class="bi bi-box-arrow-in-right"></i> Se connecter</button>
            </form>

            <p class="form-footer">Pas encore de compte ? <a href="{{ route('inscription') }}">S'inscrire</a></p>
            <div style="text-align:center;">
                <a href="{{ route('accueil') }}" class="back-link"><i class="bi bi-arrow-left"></i> Retour à l'accueil</a>
            </div>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ABHOER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/aqua-theme.css') }}">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        a { text-decoration: none; }

        /* -------- Left panel (photo) -------- */
        .side-panel {
            position: relative;
            background: url('{{ asset("images/bassin/barrage-1.jpeg") }}') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px;
            color: white;
            overflow: hidden;
        }
        .side-panel::before {
            content: '';
            position: absolute; inset: 0;
            background:
                linear-gradient(180deg, rgba(1,17,29,0.35) 0%, rgba(1,17,29,0.15) 40%, rgba(1,17,29,0.85) 100%),
                linear-gradient(90deg, rgba(1,17,29,0.25) 0%, transparent 40%);
        }
        .side-panel > * { position: relative; z-index: 1; }

        .side-brand { display: flex; align-items: center; gap: 12px; }
        .side-brand .logo-badge-img {
            width: 46px; height: 46px; object-fit: contain; border-radius: 12px;
            background: rgba(255,255,255,0.95); padding: 4px;
        }
        .side-brand .brand-name { font-weight: 700; font-size: 18px; }
        .side-brand .brand-sub { font-size: 11.5px; opacity: 0.85; margin-top: 2px; }

        .side-welcome-card {
            background: rgba(4, 15, 24, 0.6); backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.14); border-radius: 18px;
            padding: 26px; animation: aquaFadeUp .9s ease both;
        }
        .side-welcome-card__title { display: flex; align-items: center; gap: 10px; font-size: 21px; font-weight: 700; margin-bottom: 10px; }
        .side-welcome-card__title i { color: var(--aqua-cyan); font-size: 20px; }
        .side-welcome-card p { font-size: 13.5px; opacity: 0.92; line-height: 1.6; margin-bottom: 22px; }

        .side-features { display: flex; gap: 22px; flex-wrap: wrap; }
        .side-feature { display: flex; align-items: center; gap: 10px; }
        .side-feature .ico {
            width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
            background: rgba(0,217,208,0.18); color: var(--aqua-cyan);
            display: flex; align-items: center; justify-content: center; font-size: 14px;
        }
        .side-feature strong { display: block; font-size: 12.5px; font-weight: 700; }
        .side-feature span { display: block; font-size: 11px; opacity: 0.8; line-height: 1.3; margin-top: 1px; }

        /* -------- Right panel (form) -------- */
        .form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #fbfdfd;
            position: relative;
            overflow: hidden;
        }

        .form-splash { position: absolute; top: 26px; right: 26px; width: 150px; opacity: 0.9; pointer-events: none; }

        .form-box { width: 100%; max-width: 380px; position: relative; z-index: 1; }

        .form-box h1 { font-size: 26px; color: var(--aqua-bg-deep-1); margin-bottom: 8px; font-weight: 800; }
        .form-underline { width: 46px; height: 3px; border-radius: 3px; background: linear-gradient(90deg, var(--aqua-cyan), transparent); margin-bottom: 14px; }
        .form-box p.subtitle { font-size: 13.5px; color: #64748b; margin-bottom: 28px; }

        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 7px; font-size: 12.5px; font-weight: 600; color: #334155; }

        .input-wrap { position: relative; }
        .input-wrap .field-ico {
            position: absolute; left: 4px; top: 4px; bottom: 4px; width: 36px; border-radius: 8px;
            background: linear-gradient(135deg, var(--aqua-turquoise), var(--aqua-blue-deep));
            color: white; display: flex; align-items: center; justify-content: center; font-size: 14px;
        }
        .input-wrap input {
            width: 100%; padding: 12px 14px 12px 50px; border: 1px solid #e2e8f0; border-radius: 10px;
            font-size: 14px; background: white;
        }
        .input-wrap input:focus { outline: none; border-color: var(--aqua-cyan); box-shadow: 0 0 0 3px rgba(0,217,208,0.14); }
        .input-wrap .toggle-pass {
            position: absolute; right: 4px; top: 4px; bottom: 4px; width: 36px; border: none; background: transparent;
            color: #94a3b8; cursor: pointer; font-size: 15px;
        }

        .form-options { display: flex; align-items: center; justify-content: space-between; margin: -4px 0 20px; font-size: 12.5px; }
        .remember-me { display: flex; align-items: center; gap: 7px; color: #475569; }
        .remember-me input { width: 15px; height: 15px; accent-color: var(--aqua-cyan-bright); }
        .form-options a.forgot { color: #64748b; font-weight: 600; }

        button[type="submit"] {
            width: 100%; padding: 14px; border: none; border-radius: 12px;
            background: linear-gradient(135deg, #11C9C0, #1AD6C5); color: #012027;
            font-size: 15px; font-weight: 700; cursor: pointer; margin-top: 4px;
            box-shadow: 0 10px 26px rgba(0,220,210,0.3); transition: transform 0.15s, box-shadow .2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        button[type="submit"]:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(0,220,210,0.4); }

        .divider { display: flex; align-items: center; gap: 12px; margin: 22px 0; font-size: 12px; color: #94a3b8; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }

        .btn-sso {
            width: 100%; padding: 13px; border-radius: 12px; border: 1.5px solid #e2e8f0; background: white;
            color: #334155; font-size: 14px; font-weight: 600; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 9px; transition: border-color .2s;
        }
        .btn-sso:hover { border-color: var(--aqua-cyan); }
        .btn-sso i { color: var(--aqua-cyan-bright); }

        .error {
            background: #fef2f2; color: #991b1b; padding: 11px 14px; border-radius: 10px;
            margin-bottom: 20px; font-size: 13px; border-left: 3px solid #ef4444;
        }

        .form-footer { text-align: center; margin-top: 22px; font-size: 13px; color: #64748b; }
        .form-footer a { color: var(--aqua-blue-deep); font-weight: 700; }
        .back-link { display: inline-flex; align-items: center; gap: 5px; font-size: 12.5px; color: #94a3b8; margin-top: 12px; }

        @media (max-width: 860px) {
            body { grid-template-columns: 1fr; }
            .side-panel { min-height: 260px; padding: 28px; }
            .form-splash { display: none; }
        }
    </style>
</head>

<body>

    <div class="side-panel">
        <div class="side-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="logo-badge-img">
            <div>
                <div class="brand-name">ABHOER</div>
                <div class="brand-sub">Bassin Hydraulique de l'Oum Er-Rbia</div>
            </div>
        </div>

        <div class="side-welcome-card">
            <div class="side-welcome-card__title"><i class="bi bi-water"></i> Bienvenue !</div>
            <p>Connectez-vous pour accéder à votre espace personnel et suivre le traitement de vos demandes en toute simplicité.</p>

            <div class="side-features">
                <div class="side-feature">
                    <div class="ico"><i class="bi bi-shield-lock-fill"></i></div>
                    <div><strong>Sécurisé</strong><span>Vos données sont protégées</span></div>
                </div>
                <div class="side-feature">
                    <div class="ico"><i class="bi bi-lightning-charge-fill"></i></div>
                    <div><strong>Rapide</strong><span>Accédez à vos services en un clic</span></div>
                </div>
                <div class="side-feature">
                    <div class="ico"><i class="bi bi-people-fill"></i></div>
                    <div><strong>Accessible</strong><span>Disponible à tout moment</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-panel">

        <svg class="form-splash" viewBox="0 0 150 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 60 C 40 20, 70 90, 100 40 S 150 10, 145 15" stroke="#00D9D0" stroke-width="2.5" stroke-linecap="round" opacity="0.55"/>
            <circle cx="128" cy="26" r="10" fill="#00D9D0" opacity="0.35"/>
            <circle cx="108" cy="52" r="5" fill="#12CFC5" opacity="0.5"/>
        </svg>

        <div class="form-box">
            <h1>Connexion</h1>
            <div class="form-underline"></div>
            <p class="subtitle">Accédez à votre espace ABHOER</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="form-group">
                    <label for="login">Adresse e-mail ou identifiant</label>
                    <div class="input-wrap">
                        <span class="field-ico"><i class="bi bi-person-fill"></i></span>
                        <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="votre login" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="motDePasse">Mot de passe</label>
                    <div class="input-wrap">
                        <span class="field-ico"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" id="motDePasse" name="motDePasse" placeholder="••••••••" required>
                        <button type="button" class="toggle-pass" onclick="const i=document.getElementById('motDePasse'); i.type = i.type === 'password' ? 'text' : 'password'; this.querySelector('i').classList.toggle('bi-eye-fill'); this.querySelector('i').classList.toggle('bi-eye-slash-fill');">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                    <a href="#" class="forgot">Mot de passe oublié ?</a>
                </div>

                <button type="submit"><i class="bi bi-box-arrow-in-right"></i> Se connecter</button>
            </form>

            <div class="divider">ou</div>

            <button type="button" class="btn-sso" disabled title="Bientôt disponible">
                <i class="bi bi-shield-check"></i> Se connecter avec SSO
            </button>

            <p class="form-footer">Pas encore de compte ? <a href="{{ route('inscription') }}">S'inscrire</a></p>
            <div style="text-align:center;">
                <a href="{{ route('accueil') }}" class="back-link"><i class="bi bi-arrow-left"></i> Retour à l'accueil</a>
            </div>
        </div>
    </div>

</body>
</html>

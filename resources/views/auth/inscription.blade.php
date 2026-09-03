<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - ABHOER</title>
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
            grid-template-columns: 0.8fr 1.2fr;
        }

        a { text-decoration: none; }

        /* -------- Left panel (photo) -------- */
        .side-panel {
            position: relative;
            background: url('{{ asset("images/bassin/barrage-2.jpeg") }}') center/cover no-repeat;
            display: flex; flex-direction: column; justify-content: space-between;
            padding: 40px; color: white; overflow: hidden;
        }
        .side-panel::before {
            content: '';
            position: absolute; inset: 0;
            background:
                linear-gradient(180deg, rgba(1,17,29,0.35) 0%, rgba(1,17,29,0.2) 35%, rgba(1,17,29,0.88) 100%),
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

        .side-perks { display: flex; flex-direction: column; gap: 14px; }
        .side-perk { display: flex; align-items: center; gap: 12px; font-size: 13px; }
        .side-perk .ico {
            width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
            background: rgba(0,217,208,0.18); color: var(--aqua-cyan);
            display: flex; align-items: center; justify-content: center; font-size: 14px;
        }

        /* -------- Right panel (form) -------- */
        .form-panel { display: flex; align-items: center; justify-content: center; padding: 44px 20px; background: #fbfdfd; position: relative; overflow: hidden; }
        .form-splash { position: absolute; top: 26px; right: 26px; width: 150px; opacity: 0.9; pointer-events: none; }
        .form-box { width: 100%; max-width: 600px; position: relative; z-index: 1; }

        .form-box h1 { font-size: 26px; color: var(--aqua-bg-deep-1); margin-bottom: 8px; font-weight: 800; }
        .form-underline { width: 46px; height: 3px; border-radius: 3px; background: linear-gradient(90deg, var(--aqua-cyan), transparent); margin-bottom: 14px; }
        .form-box p.subtitle { font-size: 13.5px; color: #64748b; margin-bottom: 28px; }

        .form-section-title {
            display: flex; align-items: center; gap: 9px;
            font-size: 12px; text-transform: uppercase; letter-spacing: 0.8px; color: var(--aqua-blue-deep);
            font-weight: 700; margin: 26px 0 14px; padding-bottom: 10px; border-bottom: 1px solid #eef2f5;
        }
        .form-section-title:first-of-type { margin-top: 0; }
        .form-section-title .num {
            width: 20px; height: 20px; border-radius: 6px; flex-shrink: 0;
            background: linear-gradient(135deg, var(--aqua-turquoise), var(--aqua-blue-deep));
            color: white; display: flex; align-items: center; justify-content: center; font-size: 11px;
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-size: 12.5px; font-weight: 600; color: #334155; }

        input {
            width: 100%; padding: 11px 13px; border: 1px solid #e2e8f0; border-radius: 10px;
            font-size: 13.5px; background: white;
        }
        input:focus { outline: none; border-color: var(--aqua-cyan); box-shadow: 0 0 0 3px rgba(0,217,208,0.14); }

        .error-text { color: #ef4444; font-size: 11.5px; margin-top: 4px; }

        .error-box {
            background: #fef2f2; color: #991b1b; padding: 11px 14px; border-radius: 10px;
            margin-bottom: 20px; font-size: 13px; border-left: 3px solid #ef4444;
        }
        .error-box ul { margin-left: 18px; margin-top: 4px; }

        button[type="submit"] {
            width: 100%; padding: 14px; border: none; border-radius: 12px;
            background: linear-gradient(135deg, #11C9C0, #1AD6C5); color: #012027;
            font-size: 15px; font-weight: 700; cursor: pointer; margin-top: 8px;
            box-shadow: 0 10px 26px rgba(0,220,210,0.3); transition: transform 0.15s, box-shadow .2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        button[type="submit"]:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(0,220,210,0.4); }

        .form-footer { text-align: center; margin-top: 20px; font-size: 13px; color: #64748b; }
        .form-footer a { color: var(--aqua-blue-deep); font-weight: 700; }
        .back-link { display: block; text-align: center; font-size: 12.5px; color: #94a3b8; margin-top: 10px; }

        @media (max-width: 900px) {
            body { grid-template-columns: 1fr; }
            .side-panel { min-height: 220px; padding: 28px; }
            .form-row { grid-template-columns: 1fr; }
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
            <div class="side-welcome-card__title"><i class="bi bi-droplet-fill"></i> Rejoignez-nous</div>
            <p>Créez votre compte étudiant pour déposer votre demande de stage et suivre son traitement en temps réel.</p>

            <div class="side-perks">
                <div class="side-perk"><div class="ico"><i class="bi bi-file-earmark-plus-fill"></i></div> Dépôt de demande 100% en ligne</div>
                <div class="side-perk"><div class="ico"><i class="bi bi-bell-fill"></i></div> Suivi en temps réel du statut</div>
                <div class="side-perk"><div class="ico"><i class="bi bi-award-fill"></i></div> Attestation dématérialisée</div>
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
            <h1>Créer votre compte</h1>
            <div class="form-underline"></div>
            <p class="subtitle">Renseignez vos informations pour accéder à l'espace étudiant.</p>

            @if ($errors->any())
                <div class="error-box">
                    Merci de corriger les champs suivants :
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('inscription.store') }}">
                @csrf

                <p class="form-section-title"><span class="num">1</span> Informations personnelles</p>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nom *</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Prénom *</label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}" required>
                        @error('prenom')<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>CIN *</label>
                        <input type="text" name="cin" value="{{ old('cin') }}" required>
                        @error('cin')<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" value="{{ old('telephone') }}">
                        @error('telephone')<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <p class="form-section-title"><span class="num">2</span> Parcours académique</p>

                <div class="form-row">
                    <div class="form-group">
                        <label>Établissement</label>
                        <input type="text" name="etablissement" value="{{ old('etablissement') }}">
                    </div>
                    <div class="form-group">
                        <label>Formation</label>
                        <input type="text" name="formation" value="{{ old('formation') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Niveau d'étude</label>
                    <input type="text" name="niveauEtude" value="{{ old('niveauEtude') }}">
                </div>

                <p class="form-section-title"><span class="num">3</span> Identifiants de connexion</p>

                <div class="form-group">
                    <label>Login *</label>
                    <input type="text" name="login" value="{{ old('login') }}" required>
                    @error('login')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Mot de passe *</label>
                        <input type="password" name="motDePasse" required>
                        @error('motDePasse')<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Confirmer le mot de passe *</label>
                        <input type="password" name="motDePasse_confirmation" required>
                    </div>
                </div>

                <button type="submit"><i class="bi bi-person-plus-fill"></i> Créer mon compte</button>
            </form>

            <p class="form-footer">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
            <a href="{{ route('accueil') }}" class="back-link"><i class="bi bi-arrow-left"></i> Retour à l'accueil</a>
        </div>
    </div>

</body>
</html>

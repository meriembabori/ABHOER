<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - ABHOER</title>
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
            grid-template-columns: 0.85fr 1.15fr;
        }

        a { text-decoration: none; }

        .side-panel {
            position: relative;
            background: url('{{ asset("images/bassin/carte-bassin.png") }}') center/cover no-repeat, url('{{ asset("images/bassin/barrage-2.jpeg") }}') center/cover no-repeat;
            display: flex; flex-direction: column; justify-content: space-between;
            padding: 46px; color: white; overflow: hidden;
        }
        .side-panel::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(180deg, rgba(15,23,42,0.6) 0%, rgba(13,110,110,0.8) 100%);
        }
        .side-panel > * { position: relative; z-index: 1; }

        .side-brand { display: flex; align-items: center; gap: 12px; }
        .side-brand .logo-badge {
            width: 44px; height: 44px; border-radius: 12px; background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; font-size: 21px;
        }
        .side-brand div div:first-child { font-weight: 700; font-size: 17px; }
        .side-brand div div:last-child { font-size: 11px; opacity: 0.85; margin-top: 2px; }

        .side-message h2 { font-size: 26px; line-height: 1.3; margin-bottom: 14px; }
        .side-message p { font-size: 13.5px; opacity: 0.9; max-width: 340px; line-height: 1.65; margin-bottom: 20px; }

        .side-perks { display: flex; flex-direction: column; gap: 12px; }
        .side-perk { display: flex; align-items: center; gap: 10px; font-size: 13px; }
        .side-perk .ico {
            width: 28px; height: 28px; border-radius: 8px; background: rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }

        .form-panel { display: flex; align-items: center; justify-content: center; padding: 40px 20px; background: #fbfdfd; }
        .form-box { width: 100%; max-width: 560px; }

        .form-box h1 { font-size: 24px; color: var(--c-navy); margin-bottom: 6px; }
        .form-box p.subtitle { font-size: 13.5px; color: #64748b; margin-bottom: 26px; }

        .form-section-title {
            font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--c-teal-dark);
            font-weight: 700; margin: 22px 0 12px; padding-bottom: 8px; border-bottom: 1px solid #f1f5f9;
        }
        .form-section-title:first-of-type { margin-top: 0; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 6px; font-size: 12.5px; font-weight: 600; color: #334155; }

        input {
            width: 100%; padding: 11px 13px; border: 1px solid #e2e8f0; border-radius: 9px;
            font-size: 13.5px; background: white;
        }
        input:focus { outline: none; border-color: var(--c-teal); box-shadow: 0 0 0 3px rgba(37,166,166,0.12); }

        .error-text { color: #ef4444; font-size: 11.5px; margin-top: 4px; }

        .error-box {
            background: #fef2f2; color: #991b1b; padding: 11px 14px; border-radius: 10px;
            margin-bottom: 20px; font-size: 13px; border-left: 3px solid #ef4444;
        }
        .error-box ul { margin-left: 18px; margin-top: 4px; }

        button[type="submit"] {
            width: 100%; padding: 13px; border: none; border-radius: 10px;
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark)); color: white;
            font-size: 15px; font-weight: 700; cursor: pointer; margin-top: 10px;
            box-shadow: 0 10px 22px rgba(13,110,110,0.25); transition: transform 0.15s;
        }
        button[type="submit"]:hover { transform: translateY(-2px); }

        .form-footer { text-align: center; margin-top: 20px; font-size: 13px; color: #64748b; }
        .form-footer a { color: var(--c-teal-dark); font-weight: 700; }

        @media (max-width: 900px) {
            body { grid-template-columns: 1fr; }
            .side-panel { min-height: 200px; padding: 28px; }
            .form-row { grid-template-columns: 1fr; }
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
            <h2>Rejoignez-nous</h2>
            <p>Créez votre compte étudiant pour déposer votre demande de stage et suivre son traitement en temps réel.</p>

            <div class="side-perks">
                <div class="side-perk"><div class="ico"><i class="bi bi-file-earmark-plus-fill"></i></div> Dépôt de demande 100% en ligne</div>
                <div class="side-perk"><div class="ico"><i class="bi bi-bell-fill"></i></div> Suivi en temps réel du statut</div>
                <div class="side-perk"><div class="ico"><i class="bi bi-award-fill"></i></div> Attestation dématérialisée</div>
            </div>
        </div>
    </div>

    <div class="form-panel">
        <div class="form-box">
            <h1>Créer votre compte</h1>
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

                <p class="form-section-title">Informations personnelles</p>

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

                <p class="form-section-title">Parcours académique</p>

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

                <p class="form-section-title">Identifiants de connexion</p>

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
        </div>
    </div>

</body>
</html>

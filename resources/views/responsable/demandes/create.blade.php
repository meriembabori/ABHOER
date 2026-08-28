<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nouvelle demande physique - ABHOER</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body { font-family: Arial, sans-serif; background: #f4f7fb; color: #333; }

        .navbar {
            background: linear-gradient(135deg, #1a7a86, #2fa9b0);
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 { font-size: 22px; }
        .navbar-right { display: flex; align-items: center; }

        .navbar nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-size: 14px;
            opacity: 0.9;
        }
        .navbar nav a:hover { opacity: 1; text-decoration: underline; }

        .logout button {
            background: white; color: #1a7a86; border: none;
            padding: 9px 16px; border-radius: 6px; cursor: pointer; font-weight: bold;
        }

        .container { padding: 30px; max-width: 800px; margin: 0 auto; }

        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            color: #1a7a86;
            text-decoration: none;
            font-size: 14px;
        }

        h2 { color: #1a7a86; margin-bottom: 5px; }
        .subtitle { color: #666; margin-bottom: 25px; font-size: 14px; }

        .panel {
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            padding: 30px;
        }

        .panel h3 {
            color: #1a7a86;
            margin-bottom: 15px;
            font-size: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-top: 25px;
        }

        .panel h3:first-child { margin-top: 0; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group { margin-bottom: 15px; }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            font-size: 13px;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }

        .error-text { color: #dc2626; font-size: 12px; margin-top: 4px; }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: #1a7a86;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            margin-top: 15px;
        }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
        }
            /* --- Identité visuelle ABHOER (logo + vagues) --- */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-logo {
            height: 42px;
            width: auto;
            background: white;
            border-radius: 8px;
            padding: 3px 6px;
        }

        .navbar-brand h1 {
            font-size: 19px;
            line-height: 1.1;
        }

        .navbar-subtitle {
            display: block;
            font-size: 11px;
            opacity: 0.85;
            letter-spacing: 0.3px;
            margin-top: 2px;
        }

        .wave-divider {
            line-height: 0;
            margin-top: -1px;
        }

        .wave-divider svg {
            width: 100%;
            height: 26px;
            display: block;
        }

    </style>
</head>

<body>

    <div class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="navbar-logo">
            <div>
                <h1>ABHOER</h1>
                <span class="navbar-subtitle">Espace Responsable</span>
            </div>
        </div>

        <div class="navbar-right">
            <nav>
                <a href="{{ route('responsable.dashboard') }}">Tableau de bord</a>
                <a href="{{ route('responsable.demandes.index') }}">Demandes</a>
                <a href="{{ route('responsable.stages.index') }}">Suivi des stages</a>
                <a href="{{ route('responsable.historique.index') }}">Historique</a>
                <a href="{{ route('responsable.demandes.create') }}">Nouvelle demande (physique)</a>
            </nav>

            <div class="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Se déconnecter</button>
                </form>
            </div>
        </div>
    </div>

    <div class="wave-divider">
        <svg viewBox="0 0 1440 40" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path fill="#9bd9d6" d="M0,20 C240,40 480,0 720,15 C960,30 1200,5 1440,20 L1440,40 L0,40 Z"></path>
        </svg>
    </div>

    <div class="container">

        <a href="{{ route('responsable.demandes.index') }}" class="back-link">&larr; Retour à la liste</a>

        <h2>Enregistrer une demande déposée au bureau</h2>
        <p class="subtitle">À utiliser lorsqu'un candidat dépose son dossier physiquement (hors formulaire en ligne).</p>

        <div class="panel">

            <form method="POST" action="{{ route('responsable.demandes.store') }}" enctype="multipart/form-data">
                @csrf

                <h3>Informations du candidat</h3>

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
                    </div>
                </div>

                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<div class="error-text">{{ $message }}</div>@enderror
                </div>

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

                <h3>Détails de la demande</h3>

                <div class="form-group">
                    <label>Service demandé *</label>
                    <select name="idService" required>
                        <option value="">-- Choisir un service --</option>
                        @foreach ($services->groupBy(fn($s) => optional($s->departement)->nomDepartement ?? 'Autres') as $nomDepartement => $servicesDuDepartement)
                            <optgroup label="{{ $nomDepartement }}">
                                @foreach ($servicesDuDepartement as $service)
                                    <option value="{{ $service->idService }}" @selected(old('idService') == $service->idService)>
                                        {{ $service->nomService }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('idService')<div class="error-text">{{ $message }}</div>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Type de stage *</label>
                        <select name="typeStage" required>
                            <option value="">-- Choisir --</option>
                            <option value="Stage d'observation" @selected(old('typeStage') === "Stage d'observation")>Stage d'observation</option>
                            <option value="Stage d'initiation" @selected(old('typeStage') === "Stage d'initiation")>Stage d'initiation</option>
                            <option value="Stage technique" @selected(old('typeStage') === 'Stage technique')>Stage technique</option>
                            <option value="Stage de fin d'études (PFE)" @selected(old('typeStage') === "Stage de fin d'études (PFE)")>Stage de fin d'études (PFE)</option>
                        </select>
                        @error('typeStage')<div class="error-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Thème / Sujet du stage</label>
                        <input type="text" name="theme" value="{{ old('theme') }}" placeholder="Ex: Suivi des ressources en eau">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Date de début souhaitée</label>
                        <input type="date" name="dateDebut" value="{{ old('dateDebut') }}">
                    </div>
                    <div class="form-group">
                        <label>Date de fin souhaitée</label>
                        <input type="date" name="dateFin" value="{{ old('dateFin') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Observation</label>
                    <textarea name="observation" rows="3">{{ old('observation') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Documents (CV, lettre, convention, assurance...)</label>
                    <input type="file" name="documents[]" multiple>
                </div>

                <button type="submit" class="btn-submit">Enregistrer la demande</button>

            </form>

        </div>

    </div>

</body>

</html>

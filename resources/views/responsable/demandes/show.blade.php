<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Demande {{ $demande->numeroDemande }} - ABHOER</title>

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

        .container { padding: 30px; max-width: 1100px; margin: 0 auto; }

        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            color: #1a7a86;
            text-decoration: none;
            font-size: 14px;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .header-row h2 { color: #1a7a86; }

        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }
        .badge-EN_ATTENTE { background: #fef3c7; color: #92400e; }
        .badge-INFOS_DEMANDEES { background: #ede9fe; color: #5b21b6; }
        .badge-ACCEPTEE { background: #dcfce7; color: #166534; }
        .badge-REFUSEE { background: #fee2e2; color: #991b1b; }

        .grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .panel {
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 20px;
        }

        .panel h3 {
            color: #1a7a86;
            margin-bottom: 15px;
            font-size: 16px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .info-line {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f4f4f4;
            font-size: 14px;
        }

        .info-line span:first-child { color: #666; }
        .info-line span:last-child { font-weight: bold; text-align: right; }

        .doc-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f4f4f4;
            font-size: 14px;
        }

        .doc-item a { color: #1a7a86; text-decoration: none; font-weight: bold; }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
            text-align: center;
        }

        .btn-accept { background: #16a34a; color: white; }
        .btn-refuse { background: #dc2626; color: white; }
        .btn-infos { background: #d97706; color: white; }
        .btn-affect { background: #1a7a86; color: white; }
        .btn-secondary { background: #f4f7fb; color: #333; border: 1px solid #ddd; }

        textarea, input, select {
            width: 100%;
            padding: 9px 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 10px;
            font-family: inherit;
        }

        .action-block {
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        .action-block summary {
            cursor: pointer;
            font-weight: bold;
            color: #1a7a86;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .timeline-item {
            padding: 10px 0;
            border-bottom: 1px solid #f4f4f4;
            font-size: 13px;
        }

        .timeline-item .action-name { font-weight: bold; color: #1a7a86; }
        .timeline-item .action-meta { color: #999; font-size: 12px; margin-top: 2px; }

        .upload-form {
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        @media (max-width: 900px) {
            .grid { grid-template-columns: 1fr; }
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

        @if (session('success'))
            <div style="background:#dcfce7;color:#166534;padding:12px 18px;border-radius:8px;margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#fee2e2;color:#991b1b;padding:12px 18px;border-radius:8px;margin-bottom:20px;">
                <ul style="margin-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="header-row">
            <h2>Demande {{ $demande->numeroDemande }}</h2>
            <span class="badge badge-{{ $demande->statut }}">{{ $demande->statut }}</span>
        </div>

        <div class="grid">

            <div>
                <div class="panel">
                    <h3>Informations du candidat</h3>

                    <div class="info-line"><span>Nom complet</span><span>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</span></div>
                    <div class="info-line"><span>CIN</span><span>{{ $demande->candidat->cin ?? '—' }}</span></div>
                    <div class="info-line"><span>Email</span><span>{{ $demande->candidat->email ?? '—' }}</span></div>
                    <div class="info-line"><span>Téléphone</span><span>{{ $demande->candidat->telephone ?? '—' }}</span></div>
                    <div class="info-line"><span>Établissement</span><span>{{ $demande->candidat->etablissement ?? '—' }}</span></div>
                    <div class="info-line"><span>Formation</span><span>{{ $demande->candidat->formation ?? '—' }}</span></div>
                    <div class="info-line"><span>Niveau d'étude</span><span>{{ $demande->candidat->niveauEtude ?? '—' }}</span></div>
                </div>

                <div class="panel">
                    <h3>Détails de la demande</h3>

                    <div class="info-line"><span>Service demandé</span><span>{{ $demande->service->nomService ?? '—' }}</span></div>
                    <div class="info-line"><span>Type de dépôt</span><span>{{ $demande->typeDepot ?? '—' }}</span></div>
                    <div class="info-line"><span>Type de stage</span><span>{{ $demande->typeStage ?? '—' }}</span></div>
                    <div class="info-line"><span>Thème / Sujet</span><span>{{ $demande->theme ?? '—' }}</span></div>
                    <div class="info-line"><span>Date de dépôt</span><span>{{ optional($demande->dateDepot)->format('d/m/Y') }}</span></div>
                    <div class="info-line"><span>Période souhaitée</span><span>
                        {{ $demande->dateDebut ? $demande->dateDebut->format('d/m/Y') : '—' }}
                        &rarr;
                        {{ $demande->dateFin ? $demande->dateFin->format('d/m/Y') : '—' }}
                    </span></div>

                    @if ($demande->observation)
                        <div class="info-line" style="flex-direction:column;align-items:flex-start;">
                            <span>Observation</span>
                            <span style="font-weight:normal;text-align:left;margin-top:6px;">{{ $demande->observation }}</span>
                        </div>
                    @endif

                    @if ($demande->affectation)
                        <div class="info-line"><span>Affectée à</span><span>{{ $demande->affectation->service->nomService ?? '—' }}</span></div>
                        <div class="info-line"><span>Période d'affectation</span><span>
                            {{ optional($demande->affectation->dateDebut)->format('d/m/Y') }}
                            &rarr;
                            {{ optional($demande->affectation->dateFin)->format('d/m/Y') }}
                        </span></div>
                    @endif
                </div>

                <div class="panel">
                    <h3>Documents ({{ $demande->documents->count() }})</h3>

                    @forelse ($demande->documents as $document)
                        <div class="doc-item">
                            <span>{{ $document->nomFichier }} <span style="color:#999;">({{ $document->typeDocument }})</span></span>
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($document->cheminFichier) }}" target="_blank">Ouvrir</a>
                        </div>
                    @empty
                        <p style="color:#999;font-size:14px;">Aucun document pour cette demande.</p>
                    @endforelse

                    <form class="upload-form" method="POST" action="{{ route('responsable.demandes.documents.store', $demande->idDemande) }}" enctype="multipart/form-data">
                        @csrf
                        <label style="font-size:13px;color:#666;display:block;margin-bottom:6px;">Ajouter un ou plusieurs documents (déposés au bureau)</label>
                        <input type="file" name="documents[]" multiple>
                        <button type="submit" class="btn btn-secondary">Ajouter les documents</button>
                    </form>
                </div>

                <div class="panel">
                    <h3>Historique des actions</h3>

                    @forelse ($demande->historiques->sortByDesc('dateAction') as $item)
                        <div class="timeline-item">
                            <div class="action-name">{{ $item->action }}</div>
                            <div>{{ $item->nouvelleValeur }}</div>
                            <div class="action-meta">
                                {{ optional($item->utilisateur)->prenom }} {{ optional($item->utilisateur)->nom }}
                                — {{ optional($item->dateAction)->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    @empty
                        <p style="color:#999;font-size:14px;">Aucune action enregistrée.</p>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="panel">
                    <h3>Actions</h3>

                    @if (in_array($demande->statut, ['EN_ATTENTE', 'INFOS_DEMANDEES']))
                        <form method="POST" action="{{ route('responsable.demandes.accepter', $demande->idDemande) }}">
                            @csrf
                            <button type="submit" class="btn btn-accept">✓ Accepter la demande</button>
                        </form>

                        <details class="action-block">
                            <summary>✕ Refuser la demande</summary>
                            <form method="POST" action="{{ route('responsable.demandes.refuser', $demande->idDemande) }}">
                                @csrf
                                <textarea name="motif" rows="3" placeholder="Motif du refus (optionnel)"></textarea>
                                <button type="submit" class="btn btn-refuse">Confirmer le refus</button>
                            </form>
                        </details>

                        <details class="action-block">
                            <summary>! Demander des informations supplémentaires</summary>
                            <form method="POST" action="{{ route('responsable.demandes.demander-infos', $demande->idDemande) }}">
                                @csrf
                                <textarea name="message" rows="3" placeholder="Précisez les informations manquantes" required></textarea>
                                <button type="submit" class="btn btn-infos">Envoyer la demande</button>
                            </form>
                        </details>
                    @endif

                    <details class="action-block" @if($demande->statut === 'ACCEPTEE') open @endif>
                        <summary>&rarr; Affecter à un service / encadrant</summary>
                        <form method="POST" action="{{ route('responsable.demandes.affecter', $demande->idDemande) }}">
                            @csrf
                            <select name="idService" required>
                                <option value="">-- Choisir un service --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->idService }}" @selected(optional($demande->affectation)->idService === $service->idService)>
                                        {{ $service->nomService }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="date" name="dateDebut" value="{{ optional(optional($demande->affectation)->dateDebut)->format('Y-m-d') }}" required>
                            <input type="date" name="dateFin" value="{{ optional(optional($demande->affectation)->dateFin)->format('Y-m-d') }}" required>
                            <textarea name="observation" rows="2" placeholder="Observation (optionnel)">{{ optional($demande->affectation)->observation }}</textarea>
                            <button type="submit" class="btn btn-affect">Affecter</button>
                        </form>
                    </details>
                </div>
            </div>

        </div>

    </div>

</body>

</html>

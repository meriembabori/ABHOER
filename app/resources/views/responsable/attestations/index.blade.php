<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Attestations - ABHOER</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f4f7fb; color: #333; }

        .navbar {
            background: linear-gradient(135deg, #1a7a86, #2fa9b0); color: white; padding: 18px 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .navbar-right { display: flex; align-items: center; }
        .navbar nav a { color: white; text-decoration: none; margin-right: 20px; font-size: 14px; opacity: 0.9; }
        .navbar nav a:hover { opacity: 1; text-decoration: underline; }
        .logout button {
            background: white; color: #1a7a86; border: none;
            padding: 9px 16px; border-radius: 6px; cursor: pointer; font-weight: bold;
        }

        .navbar-brand { display: flex; align-items: center; gap: 12px; }
        .navbar-logo { height: 42px; width: auto; background: white; border-radius: 8px; padding: 3px 6px; }
        .navbar-brand h1 { font-size: 19px; line-height: 1.1; }
        .navbar-subtitle { display: block; font-size: 11px; opacity: 0.85; letter-spacing: 0.3px; margin-top: 2px; }

        .wave-divider { line-height: 0; margin-top: -1px; }
        .wave-divider svg { width: 100%; height: 26px; display: block; }

        .container { padding: 30px; }

        h2 { color: #1a7a86; margin-bottom: 20px; }

        .filters {
            background: white; padding: 20px; border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08); margin-bottom: 25px;
        }

        .filters form {
            display: grid;
            grid-template-columns: 2fr 1.5fr auto;
            gap: 12px;
            align-items: end;
        }

        .filters label { font-size: 12px; color: #666; display: block; margin-bottom: 5px; }
        .filters input, .filters select {
            width: 100%; padding: 9px 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 9px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
            text-decoration: none;
        }

        .btn-primary { background: #1a7a86; color: white; }
        .btn-start { background: #519fad; color: white; }
        .btn-ready { background: #d97706; color: white; }
        .btn-done { background: #16a34a; color: white; }

        .table-section {
            background: white; border-radius: 10px; box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            padding: 25px; overflow-x: auto;
        }

        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px 8px; border-bottom: 1px solid #eee; font-size: 14px; }
        th { color: #666; font-size: 12px; text-transform: uppercase; }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        .badge-NON_DEMANDEE { background: #f1f5f9; color: #64748b; }
        .badge-EN_PREPARATION { background: #fef3c7; color: #92400e; }
        .badge-PRETE { background: #dbeafe; color: #1e40af; }
        .badge-REMISE { background: #dcfce7; color: #166534; }

        .link-detail { color: #1a7a86; font-weight: bold; text-decoration: none; }

        .pagination-wrap { margin-top: 20px; }

        .abhoer-pagination { display: flex; flex-direction: column; align-items: center; gap: 10px; }
        .abhoer-pagination-list { display: flex; list-style: none; gap: 6px; flex-wrap: wrap; }
        .abhoer-page-item .abhoer-page-link {
            display: inline-block; padding: 8px 13px; border: 1px solid #ddd; border-radius: 6px;
            color: #1a7a86; text-decoration: none; font-size: 13px; background: white;
        }
        .abhoer-page-item .abhoer-page-link:hover { background: #f4f7fb; }
        .abhoer-page-item.active .abhoer-page-link { background: #1a7a86; color: white; border-color: #1a7a86; font-weight: bold; }
        .abhoer-page-item.disabled .abhoer-page-link { color: #bbb; cursor: default; }
        .abhoer-pagination-info { font-size: 12px; color: #999; }

        @media (max-width: 700px) {
            .filters form { grid-template-columns: 1fr; }
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
                <a href="{{ route('responsable.attestations.index') }}">Attestations</a>
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

        @if (session('success'))
            <div style="background:#dcfce7;color:#166534;padding:12px 18px;border-radius:8px;margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <h2>Gestion des attestations de stage</h2>

        <div class="filters">
            <form method="GET" action="{{ route('responsable.attestations.index') }}">

                <div>
                    <label>Recherche</label>
                    <input type="text" name="recherche" placeholder="N° demande, nom..." value="{{ request('recherche') }}">
                </div>

                <div>
                    <label>État de l'attestation</label>
                    <select name="statut">
                        <option value="">Tous</option>
                        <option value="NON_DEMANDEE" @selected(request('statut') === 'NON_DEMANDEE')>Non demandée</option>
                        <option value="EN_PREPARATION" @selected(request('statut') === 'EN_PREPARATION')>En préparation</option>
                        <option value="PRETE" @selected(request('statut') === 'PRETE')>Prête à récupérer</option>
                        <option value="REMISE" @selected(request('statut') === 'REMISE')>Remise</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </div>

            </form>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>N° Demande</th>
                        <th>Stagiaire</th>
                        <th>Service</th>
                        <th>Période de stage</th>
                        <th>État attestation</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($demandes as $demande)
                        @php
                            $etatAttestation = optional($demande->attestation)->statut ?? 'NON_DEMANDEE';
                        @endphp
                        <tr>
                            <td>{{ $demande->numeroDemande }}</td>
                            <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                            <td>{{ $demande->service->nomService ?? '—' }}</td>
                            <td>
                                {{ $demande->dateDebut ? $demande->dateDebut->format('d/m/Y') : '—' }}
                                &rarr;
                                {{ $demande->dateFin ? $demande->dateFin->format('d/m/Y') : '—' }}
                            </td>
                            <td><span class="badge badge-{{ $etatAttestation }}">{{ $etatAttestation }}</span></td>
                            <td>
                                @if ($etatAttestation === 'NON_DEMANDEE')
                                    <form method="POST" action="{{ route('responsable.attestations.demarrer', $demande->idDemande) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-start">Démarrer la préparation</button>
                                    </form>
                                @elseif ($etatAttestation === 'EN_PREPARATION')
                                    <form method="POST" action="{{ route('responsable.attestations.prete', $demande->attestation->idAttestation) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-ready">Marquer comme prête</button>
                                    </form>
                                @elseif ($etatAttestation === 'PRETE')
                                    <form method="POST" action="{{ route('responsable.attestations.remise', $demande->attestation->idAttestation) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-done">Marquer comme remise</button>
                                    </form>
                                @else
                                    <span style="color:#999;font-size:13px;">
                                        Remise le {{ optional($demande->attestation->dateRemise)->format('d/m/Y') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#999;padding:25px;">
                                Aucune demande acceptée pour le moment (les attestations concernent uniquement les demandes acceptées).
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-wrap">
                {{ $demandes->links('vendor.pagination.abhoer') }}
            </div>
        </div>

    </div>

</body>

</html>

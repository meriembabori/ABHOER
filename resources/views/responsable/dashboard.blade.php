<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Responsable - ABHOER</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, #1a7a86, #2fa9b0);
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 22px;
        }

        .navbar nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-size: 14px;
            opacity: 0.9;
        }

        .navbar nav a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }

        .logout button {
            background: white;
            color: #1a7a86;
            border: none;
            padding: 9px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .container {
            padding: 30px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            margin-bottom: 8px;
        }

        .welcome p {
            color: #666;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 12px;
        }

        .card .number {
            font-size: 30px;
            font-weight: bold;
            color: #1a7a86;
        }

        .card.pending .number { color: #d97706; }
        .card.infos .number { color: #6d28d9; }
        .card.accepted .number { color: #16a34a; }
        .card.refused .number { color: #dc2626; }
        .card.ongoing .number { color: #0891b2; }

        .actions-rapides {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-primary {
            background: #1a7a86;
            color: white;
        }

        .btn-secondary {
            background: white;
            color: #1a7a86;
            border: 1px solid #1a7a86;
        }

        .table-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            padding: 25px;
        }

        .table-section h3 {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        th {
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-EN_ATTENTE { background: #fef3c7; color: #92400e; }
        .badge-INFOS_DEMANDEES { background: #ede9fe; color: #5b21b6; }
        .badge-ACCEPTEE { background: #dcfce7; color: #166534; }
        .badge-REFUSEE { background: #fee2e2; color: #991b1b; }

        @media (max-width: 1000px) {
            .cards { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 600px) {
            .cards { grid-template-columns: 1fr; }
            .container { padding: 15px; }
            .actions-rapides { flex-direction: column; }
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

        @if (session('success'))
            <div style="background:#dcfce7;color:#166534;padding:12px 18px;border-radius:8px;margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="welcome">
            <h2>Tableau de bord</h2>
            <p>Vue d'ensemble des demandes de stage et des affectations.</p>
        </div>

        <div class="cards">

            <div class="card">
                <h3>Total demandes</h3>
                <div class="number">{{ $totalDemandes }}</div>
            </div>

            <div class="card pending">
                <h3>En attente</h3>
                <div class="number">{{ $demandesEnAttente }}</div>
            </div>

            <div class="card infos">
                <h3>Infos demandées</h3>
                <div class="number">{{ $demandesInfosDemandees }}</div>
            </div>

            <div class="card accepted">
                <h3>Acceptées</h3>
                <div class="number">{{ $demandesAcceptees }}</div>
            </div>

            <div class="card refused">
                <h3>Refusées</h3>
                <div class="number">{{ $demandesRefusees }}</div>
            </div>

        </div>

        <div class="actions-rapides">
            <a href="{{ route('responsable.demandes.index') }}" class="btn btn-secondary">Voir toutes les demandes</a>
            <a href="{{ route('responsable.demandes.create') }}" class="btn btn-primary">+ Enregistrer une demande physique</a>
        </div>

        <div class="table-section">
            <h3>Dernières demandes déposées</h3>

            <table>
                <thead>
                    <tr>
                        <th>N° Demande</th>
                        <th>Candidat</th>
                        <th>Service</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Date dépôt</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dernieresDemandes as $demande)
                        <tr>
                            <td>
                                <a href="{{ route('responsable.demandes.show', $demande->idDemande) }}" style="color:#1a7a86;text-decoration:none;font-weight:bold;">
                                    {{ $demande->numeroDemande }}
                                </a>
                            </td>
                            <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                            <td>{{ $demande->service->nomService ?? '—' }}</td>
                            <td>{{ $demande->typeDepot ?? '—' }}</td>
                            <td><span class="badge badge-{{ $demande->statut }}">{{ $demande->statut }}</span></td>
                            <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#999;padding:20px;">Aucune demande pour le moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>

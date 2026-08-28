<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Historique - ABHOER</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f4f7fb; color: #333; }

        .navbar {
            background: linear-gradient(135deg, #1a7a86, #2fa9b0); color: white; padding: 18px 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .navbar h1 { font-size: 22px; }
        .navbar-right { display: flex; align-items: center; }
        .navbar nav a { color: white; text-decoration: none; margin-right: 20px; font-size: 14px; opacity: 0.9; }
        .navbar nav a:hover { opacity: 1; text-decoration: underline; }
        .logout button {
            background: white; color: #1a7a86; border: none;
            padding: 9px 16px; border-radius: 6px; cursor: pointer; font-weight: bold;
        }

        .container { padding: 30px; }

        h2 { color: #1a7a86; margin-bottom: 20px; }

        .filters {
            background: white; padding: 20px; border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08); margin-bottom: 25px;
        }

        .filters form {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .filters label { font-size: 12px; color: #666; display: block; margin-bottom: 5px; }
        .filters input, .filters select {
            width: 100%; padding: 9px 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;
        }

        .btn { padding: 10px 18px; border-radius: 8px; border: none; background: #1a7a86; color: white; font-weight: bold; cursor: pointer; }

        .table-section {
            background: white; border-radius: 10px; box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            padding: 25px; overflow-x: auto;
        }

        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px 8px; border-bottom: 1px solid #eee; font-size: 14px; }
        th { color: #666; font-size: 12px; text-transform: uppercase; }

        .action-tag {
            padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;
            background: #e0f2fe; color: #1a7a86;
        }

        .pagination-wrap { margin-top: 20px; }

        .abhoer-pagination {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .abhoer-pagination-list {
            display: flex;
            list-style: none;
            gap: 6px;
            flex-wrap: wrap;
        }

        .abhoer-page-item .abhoer-page-link {
            display: inline-block;
            padding: 8px 13px;
            border: 1px solid #ddd;
            border-radius: 6px;
            color: #1a7a86;
            text-decoration: none;
            font-size: 13px;
            background: white;
        }

        .abhoer-page-item .abhoer-page-link:hover {
            background: #f4f7fb;
        }

        .abhoer-page-item.active .abhoer-page-link {
            background: #1a7a86;
            color: white;
            border-color: #1a7a86;
            font-weight: bold;
        }

        .abhoer-page-item.disabled .abhoer-page-link {
            color: #bbb;
            cursor: default;
        }

        .abhoer-pagination-info {
            font-size: 12px;
            color: #999;
        }

        @media (max-width: 1000px) {
            .filters form { grid-template-columns: 1fr 1fr; }
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

        <h2>Historique des actions</h2>

        <div class="filters">
            <form method="GET" action="{{ route('responsable.historique.index') }}">

                <div>
                    <label>N° de demande</label>
                    <input type="text" name="recherche" placeholder="STG-2026-..." value="{{ request('recherche') }}">
                </div>

                <div>
                    <label>Type d'action</label>
                    <select name="action">
                        <option value="">Toutes</option>
                        @foreach ($actionsDisponibles as $action)
                            <option value="{{ $action }}" @selected(request('action') === $action)>{{ $action }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Utilisateur</label>
                    <select name="idUtilisateur">
                        <option value="">Tous</option>
                        @foreach ($utilisateurs as $utilisateur)
                            <option value="{{ $utilisateur->idUtilisateur }}" @selected((string) request('idUtilisateur') === (string) $utilisateur->idUtilisateur)>
                                {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Du</label>
                    <input type="date" name="dateDebut" value="{{ request('dateDebut') }}">
                </div>

                <div>
                    <label>Au</label>
                    <input type="date" name="dateFin" value="{{ request('dateFin') }}">
                </div>

                <div>
                    <button type="submit" class="btn">Filtrer</button>
                </div>

            </form>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Utilisateur</th>
                        <th>Action</th>
                        <th>Demande</th>
                        <th>Détail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($historiques as $item)
                        <tr>
                            <td>{{ optional($item->dateAction)->format('d/m/Y H:i') }}</td>
                            <td>{{ optional($item->utilisateur)->prenom }} {{ optional($item->utilisateur)->nom }}</td>
                            <td><span class="action-tag">{{ $item->action }}</span></td>
                            <td>
                                @if ($item->demande)
                                    <a href="{{ route('responsable.demandes.show', $item->demande->idDemande) }}" style="color:#1a7a86;text-decoration:none;font-weight:bold;">
                                        {{ $item->demande->numeroDemande }}
                                    </a>
                                    <br>
                                    <span style="color:#999;font-size:12px;">
                                        {{ optional($item->demande->candidat)->prenom }} {{ optional($item->demande->candidat)->nom }}
                                    </span>
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $item->nouvelleValeur }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;color:#999;padding:25px;">Aucune action enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-wrap">
                {{ $historiques->links('vendor.pagination.abhoer') }}
            </div>
        </div>

    </div>

</body>

</html>

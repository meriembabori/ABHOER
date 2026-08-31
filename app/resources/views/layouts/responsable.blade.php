<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Responsable') - ABHOER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --c-teal-dark: #0d6e6e;
            --c-teal: #25a6a6;
            --c-teal-pale: #e6f4f4;
            --c-bg: #f6f9fb;
            --c-navy: #0f172a;
            --c-navy-2: #16213a;
            --radius: 14px;
            --shadow: 0 4px 18px rgba(15, 23, 42, 0.06);
            --shadow-lg: 0 12px 34px rgba(15, 23, 42, 0.10);
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--c-bg);
            color: #1e293b;
            display: flex;
            min-height: 100vh;
        }

        a { text-decoration: none; color: inherit; }

        /* ============ SIDEBAR ============ */
        .sidebar {
            width: 260px;
            flex-shrink: 0;
            background: linear-gradient(190deg, var(--c-navy) 0%, var(--c-navy-2) 100%);
            color: #cbd5e1;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 22px 22px 18px;
        }

        .sidebar-brand .logo-badge {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            color: white;
            flex-shrink: 0;
        }

        .sidebar-brand h1 { font-size: 15px; color: white; line-height: 1.2; }
        .sidebar-brand span { font-size: 10.5px; color: #94a3b8; line-height: 1.3; display: block; margin-top: 2px; }

        .sidebar-label {
            font-size: 10.5px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
            padding: 18px 22px 8px;
        }

        .sidebar-nav { flex: 1; overflow-y: auto; padding: 0 12px; }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 13.5px;
            color: #cbd5e1;
            margin-bottom: 3px;
            transition: background 0.15s, color 0.15s;
        }

        .sidebar-nav a i { font-size: 17px; width: 18px; text-align: center; opacity: 0.85; }

        .sidebar-nav a:hover { background: rgba(255,255,255,0.06); color: white; }

        .sidebar-nav a.active {
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            color: white;
            box-shadow: 0 4px 14px rgba(37, 166, 166, 0.35);
        }

        .sidebar-nav a.active i { opacity: 1; }

        .sidebar-user {
            padding: 16px;
            margin: 10px 12px 16px;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
        }

        .sidebar-user-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }

        .sidebar-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
            color: white;
            flex-shrink: 0;
        }

        .sidebar-user-name { font-size: 13px; color: white; font-weight: 600; }
        .sidebar-user-role { font-size: 11px; color: #94a3b8; }

        .sidebar-user button {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.12);
            background: transparent;
            color: #cbd5e1;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: background 0.15s;
        }

        .sidebar-user button:hover { background: rgba(255,255,255,0.08); }

        /* ============ MAIN AREA ============ */
        .main { flex: 1; min-width: 0; display: flex; flex-direction: column; }

        .topbar {
            background: white;
            border-bottom: 1px solid #eef2f6;
            padding: 16px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-title { font-size: 20px; font-weight: 600; color: var(--c-navy); }
        .topbar-subtitle { font-size: 12.5px; color: #64748b; margin-top: 2px; }

        .topbar-right { display: flex; align-items: center; gap: 16px; }

        .topbar-date {
            font-size: 12.5px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .content { padding: 28px 30px; flex: 1; }

        .fade-in { animation: fadeIn 0.5s ease both; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 18px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn:hover { transform: translateY(-1px); }

        .btn-primary {
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            color: white;
            box-shadow: 0 6px 16px rgba(37, 166, 166, 0.3);
        }

        .btn-secondary { background: var(--c-teal-pale); color: var(--c-teal-dark); }
        .btn-outline { background: white; color: var(--c-navy); border: 1px solid #e2e8f0; }
        .btn-danger { background: #fee2e2; color: #991b1b; }

        .card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 22px;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            padding: 13px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13.5px;
            border-left: 3px solid #10b981;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            padding: 13px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13.5px;
            border-left: 3px solid #ef4444;
        }

        .badge {
            display: inline-block;
            padding: 4px 11px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
        }
        .badge-EN_ATTENTE { background: #fef3c7; color: #92400e; }
        .badge-INFOS_DEMANDEES { background: #ede9fe; color: #5b21b6; }
        .badge-ACCEPTEE { background: #d1fae5; color: #065f46; }
        .badge-REFUSEE { background: #fee2e2; color: #991b1b; }
        .badge-NON_DEMANDEE { background: #f1f5f9; color: #64748b; }
        .badge-EN_PREPARATION { background: #fef3c7; color: #92400e; }
        .badge-PRETE { background: #dbeafe; color: #1e40af; }
        .badge-REMISE { background: #d1fae5; color: #065f46; }

        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 13px 10px; border-bottom: 1px solid #f1f5f9; font-size: 13.5px; }
        th { color: #94a3b8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.4px; font-weight: 700; }
        tr:hover td { background: #fafcfd; }

        input, select, textarea {
            width: 100%;
            padding: 10px 13px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            font-size: 13.5px;
            font-family: inherit;
            background: white;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--c-teal);
            box-shadow: 0 0 0 3px rgba(37,166,166,0.12);
        }

        label { display: block; margin-bottom: 6px; font-size: 12.5px; font-weight: 600; color: #334155; }

        /* Pagination */
        .abhoer-pagination { display: flex; flex-direction: column; align-items: center; gap: 10px; }
        .abhoer-pagination-list { display: flex; list-style: none; gap: 6px; flex-wrap: wrap; }
        .abhoer-page-item .abhoer-page-link {
            display: inline-block; padding: 8px 13px; border: 1px solid #e2e8f0; border-radius: 8px;
            color: var(--c-teal-dark); text-decoration: none; font-size: 13px; background: white;
        }
        .abhoer-page-item .abhoer-page-link:hover { background: var(--c-teal-pale); }
        .abhoer-page-item.active .abhoer-page-link {
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark)); color: white; border-color: transparent; font-weight: bold;
        }
        .abhoer-page-item.disabled .abhoer-page-link { color: #cbd5e1; cursor: default; }
        .abhoer-pagination-info { font-size: 12px; color: #94a3b8; }

        @media (max-width: 960px) {
            .sidebar { display: none; }
            .content { padding: 20px 16px; }
            .topbar { padding: 14px 18px; }
        }
    
        .sidebar-brand .logo-badge-img {
            width: 40px; height: 40px; object-fit: contain; border-radius: 10px; background: white; padding: 3px; flex-shrink: 0;
        }
</style>

    @stack('styles')
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="logo-badge-img">
            <div>
                <h1>ABHOER</h1>
                <span>Espace Responsable</span>
            </div>
        </div>

        <p class="sidebar-label">Menu principal</p>

        <nav class="sidebar-nav">
            <a href="{{ route('responsable.dashboard') }}" class="{{ request()->routeIs('responsable.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Tableau de bord
            </a>
            <a href="{{ route('responsable.demandes.index') }}" class="{{ request()->routeIs('responsable.demandes.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i> Demandes de stage
            </a>
            <a href="{{ route('responsable.stages.index') }}" class="{{ request()->routeIs('responsable.stages.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i> Suivi des stages
            </a>
            <a href="{{ route('responsable.attestations.index') }}" class="{{ request()->routeIs('responsable.attestations.*') ? 'active' : '' }}">
                <i class="bi bi-award-fill"></i> Attestations
            </a>
            <a href="{{ route('responsable.historique.index') }}" class="{{ request()->routeIs('responsable.historique.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Historique des actions
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="sidebar-user-row">
                <div class="sidebar-user-avatar">{{ strtoupper(substr(auth()->user()->prenom ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom ?? '', 0, 1)) }}</div>
                <div>
                    <div class="sidebar-user-name">{{ auth()->user()->prenom ?? '' }} {{ auth()->user()->nom ?? '' }}</div>
                    <div class="sidebar-user-role">Responsable</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="bi bi-box-arrow-right"></i> Se déconnecter</button>
            </form>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <div>
                <div class="topbar-title">@yield('page-title', 'Tableau de bord')</div>
                <div class="topbar-subtitle">@yield('page-subtitle', '')</div>
            </div>

            <div class="topbar-right">
                <div class="topbar-date"><i class="bi bi-calendar3"></i> {{ ucfirst(\Carbon\Carbon::now()->locale('fr')->isoFormat('dddd D MMMM YYYY')) }}</div>
                <a href="{{ route('responsable.demandes.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nouvelle demande physique</a>
            </div>
        </div>

        <div class="content fade-in">

            @if (session('success'))
                <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @yield('content')

        </div>
    </div>

    @stack('scripts')

</body>

</html>

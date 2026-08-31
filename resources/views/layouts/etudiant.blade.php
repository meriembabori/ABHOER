<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Étudiant') - ABHOER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --c-teal-dark: #0d6e6e;
            --c-teal: #25a6a6;
            --c-teal-pale: #e6f4f4;
            --c-bg: #f6f9fb;
            --c-navy: #0f172a;
            --radius: 14px;
            --shadow: 0 4px 18px rgba(15, 23, 42, 0.06);
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--c-bg);
            color: #1e293b;
            display: flex;
            min-height: 100vh;
        }

        a { text-decoration: none; color: inherit; }

        /* ============ SIDEBAR (claire) ============ */
        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: white;
            border-right: 1px solid #eef2f6;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-brand { display: flex; align-items: center; gap: 10px; padding: 22px; }
        .sidebar-brand .logo-badge {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            display: flex; align-items: center; justify-content: center; font-size: 19px; color: white; flex-shrink: 0;
        }
        .sidebar-brand h1 { font-size: 15px; color: var(--c-navy); }
        .sidebar-brand span { font-size: 10.5px; color: #94a3b8; display: block; margin-top: 2px; }

        .sidebar-nav { flex: 1; padding: 10px 12px; }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px;
            font-size: 13.5px; color: #475569; margin-bottom: 3px; transition: background 0.15s, color 0.15s;
        }
        .sidebar-nav a i { font-size: 17px; width: 18px; text-align: center; }
        .sidebar-nav a:hover { background: var(--c-teal-pale); color: var(--c-teal-dark); }
        .sidebar-nav a.active {
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark)); color: white;
            box-shadow: 0 4px 14px rgba(37, 166, 166, 0.3);
        }

        .sidebar-user { padding: 16px; margin: 10px 12px 16px; background: var(--c-teal-pale); border-radius: 12px; }
        .sidebar-user-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .sidebar-user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: bold; color: white; flex-shrink: 0;
        }
        .sidebar-user-name { font-size: 13px; color: var(--c-navy); font-weight: 600; }
        .sidebar-user-role { font-size: 11px; color: #64748b; }
        .sidebar-user button {
            width: 100%; padding: 8px; border-radius: 8px; border: 1px solid rgba(13,110,110,0.2);
            background: white; color: var(--c-teal-dark); font-size: 12px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .sidebar-user button:hover { background: var(--c-teal-pale); }

        /* ============ MAIN ============ */
        .main { flex: 1; min-width: 0; display: flex; flex-direction: column; }

        .topbar {
            background: white; border-bottom: 1px solid #eef2f6; padding: 16px 30px;
            display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10;
        }
        .topbar-title { font-size: 20px; font-weight: 600; color: var(--c-navy); }
        .topbar-subtitle { font-size: 12.5px; color: #64748b; margin-top: 2px; }

        .content { padding: 28px 30px; flex: 1; }

        .fade-in { animation: fadeIn 0.5s ease both; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .btn {
            display: inline-flex; align-items: center; gap: 7px; padding: 10px 18px; border-radius: 10px;
            border: none; font-weight: 600; font-size: 13.5px; cursor: pointer; transition: transform 0.15s;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark)); color: white; box-shadow: 0 6px 16px rgba(37,166,166,0.3); }
        .btn-secondary { background: var(--c-teal-pale); color: var(--c-teal-dark); }
        .btn-outline { background: white; color: var(--c-navy); border: 1px solid #e2e8f0; }

        .card { background: white; border-radius: var(--radius); box-shadow: var(--shadow); padding: 22px; }

        .alert-success { background: #ecfdf5; color: #065f46; padding: 13px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 13.5px; border-left: 3px solid #10b981; }
        .alert-error { background: #fef2f2; color: #991b1b; padding: 13px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 13.5px; border-left: 3px solid #ef4444; }

        .badge { display: inline-block; padding: 4px 11px; border-radius: 20px; font-size: 11.5px; font-weight: 700; }
        .badge-EN_ATTENTE { background: #fef3c7; color: #92400e; }
        .badge-INFOS_DEMANDEES { background: #ede9fe; color: #5b21b6; }
        .badge-ACCEPTEE { background: #d1fae5; color: #065f46; }
        .badge-REFUSEE { background: #fee2e2; color: #991b1b; }

        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 13px 10px; border-bottom: 1px solid #f1f5f9; font-size: 13.5px; }
        th { color: #94a3b8; font-size: 11px; text-transform: uppercase; font-weight: 700; }

        input, select, textarea {
            width: 100%; padding: 10px 13px; border: 1px solid #e2e8f0; border-radius: 9px; font-size: 13.5px; font-family: inherit; background: white;
        }
        input:focus, select:focus, textarea:focus { outline: none; border-color: var(--c-teal); box-shadow: 0 0 0 3px rgba(37,166,166,0.12); }
        label { display: block; margin-bottom: 6px; font-size: 12.5px; font-weight: 600; color: #334155; }

        @media (max-width: 960px) {
            .sidebar { display: none; }
            .content { padding: 20px 16px; }
            .topbar { padding: 14px 18px; }
        }
    
        .sidebar-brand .logo-badge-img {
            width: 38px; height: 38px; object-fit: contain; border-radius: 10px; background: white; padding: 3px; flex-shrink: 0;
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
                <span>Espace Étudiant</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('etudiant.dashboard') }}" class="{{ request()->routeIs('etudiant.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Tableau de bord
            </a>
            <a href="{{ route('etudiant.demandes.index') }}" class="{{ request()->routeIs('etudiant.demandes.index') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i> Mes demandes
            </a>
            <a href="{{ route('etudiant.demandes.create') }}" class="{{ request()->routeIs('etudiant.demandes.create') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-plus-fill"></i> Nouvelle demande
            </a>
            <a href="{{ route('etudiant.profil') }}" class="{{ request()->routeIs('etudiant.profil*') ? 'active' : '' }}">
                <i class="bi bi-person-fill"></i> Mon profil
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="sidebar-user-row">
                <div class="sidebar-user-avatar">{{ strtoupper(substr(auth()->user()->prenom ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom ?? '', 0, 1)) }}</div>
                <div>
                    <div class="sidebar-user-name">{{ auth()->user()->prenom ?? '' }} {{ auth()->user()->nom ?? '' }}</div>
                    <div class="sidebar-user-role">Étudiant</div>
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
            <a href="{{ route('etudiant.demandes.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nouvelle demande</a>
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

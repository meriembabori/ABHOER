<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration - ABHOER')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/aqua-theme.css') }}">

    <style>
        :root {
            --admin-primary: #01111D;
            --admin-blue: #008FD5;
            --admin-blue-dark: #005B91;
            --admin-blue-light: rgba(0,143,213,0.14);
            --admin-bg: #01111D;
            --admin-white: #0A1B2A;
            --admin-text: #F5FAFC;
            --admin-muted: #9FB2BE;
            --admin-border: rgba(255,255,255,0.10);
            --admin-success: #8BD63C;
            --admin-warning: #F5A623;
            --admin-danger: #FF5C7A;
            --sidebar-width: 260px;
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; min-height: 100%; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; }

        .admin-layout { min-height: 100vh; display: flex; }

        .admin-sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: linear-gradient(180deg, #041220 0%, #010a13 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            border-right: 1px solid var(--admin-border);
            overflow-y: auto;
        }

        .admin-sidebar-brand {
            height: 90px; display: flex; align-items: center; padding: 18px 21px;
            border-bottom: 1px solid var(--admin-border);
        }
        .admin-sidebar-logo { width: 48px; height: 48px; object-fit: contain; background: #fff; border-radius: 12px; padding: 4px; margin-right: 12px; box-shadow: 0 5px 15px rgba(0,0,0,.3); }
        .admin-sidebar-brand-title { margin: 0; font-size: 19px; font-weight: 800; color: #fff; letter-spacing: .4px; line-height: 1.2; }
        .admin-sidebar-brand-subtitle { display: block; margin-top: 4px; font-size: 10px; color: rgba(255,255,255,.55); font-weight: 500; }

        .admin-sidebar-profile {
            margin: 18px 15px 14px; padding: 13px; background: rgba(0,217,208,.06);
            border: 1px solid var(--admin-border); border-radius: 13px; display: flex; align-items: center; gap: 11px;
        }
        .admin-profile-icon {
            width: 40px; height: 40px; flex-shrink: 0; border-radius: 11px; background: rgba(0,217,208,.18);
            color: var(--aqua-cyan); display: flex; align-items: center; justify-content: center; font-size: 18px; position: relative;
        }
        .admin-profile-icon::after {
            content: ''; position: absolute; bottom: -1px; right: -1px; width: 10px; height: 10px; border-radius: 50%;
            background: var(--aqua-green-env); border: 2px solid #041220;
        }
        .admin-profile-name { display: block; font-size: 13px; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-profile-role { display: block; margin-top: 3px; font-size: 10px; color: rgba(255,255,255,.50); }

        .admin-sidebar-menu { flex: 1; padding: 9px 12px; overflow-y: auto; }
        .admin-menu-title { padding: 10px 11px; margin-bottom: 6px; font-size: 10px; font-weight: 800; color: rgba(255,255,255,.38); text-transform: uppercase; letter-spacing: 1px; }
        .admin-menu-item { margin-bottom: 4px; }
        .admin-menu-link {
            position: relative; display: flex; align-items: center; width: 100%; min-height: 45px; padding: 10px 13px;
            border-radius: 10px; color: rgba(255,255,255,.65); font-size: 13px; font-weight: 500;
            transition: background .2s ease, color .2s ease, transform .2s ease;
        }
        .admin-menu-link i { width: 23px; margin-right: 11px; font-size: 16px; text-align: center; flex-shrink: 0; }
        .admin-menu-link:hover { color: #fff; background: rgba(255,255,255,.06); transform: translateX(2px); }
        .admin-menu-link.active {
            color: #012027; background: linear-gradient(90deg, #11C9C0, #1AD6C5); font-weight: 700;
            box-shadow: 0 7px 18px rgba(0,220,210,.25);
        }
        .admin-menu-link.active::before { content: ""; position: absolute; left: 0; top: 9px; bottom: 9px; width: 3px; border-radius: 0 5px 5px 0; background: #012027; }
        .admin-menu-link.active i { color: #012027; }

        .admin-sidebar-footer { padding: 13px; border-top: 1px solid var(--admin-border); }
        .admin-logout-link {
            width: 100%; border: none; background: transparent; display: flex; align-items: center;
            padding: 11px 13px; border-radius: 10px; color: #ff8fa3; font-size: 13px; font-weight: 600; transition: .2s ease;
        }
        .admin-logout-link:hover { background: rgba(255,92,122,.14); color: #ffc2cf; }
        .admin-logout-link i { width: 23px; margin-right: 10px; font-size: 16px; }

        .admin-main { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); min-height: 100vh; display: flex; flex-direction: column; }

        .admin-topbar {
            min-height: 76px; background: rgba(4, 15, 24, 0.82); backdrop-filter: blur(14px); border-bottom: 1px solid var(--admin-border);
            display: flex; align-items: center; justify-content: space-between; padding: 0 30px;
            position: sticky; top: 0; z-index: 900;
        }
        .admin-topbar-left { display: flex; align-items: center; gap: 12px; }
        .admin-topbar-icon { width: 41px; height: 41px; border-radius: 11px; background: rgba(0,217,208,.14); color: var(--aqua-cyan); display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .admin-topbar-title { margin: 0; font-size: 16px; font-weight: 750; color: var(--admin-text); }
        .admin-topbar-subtitle { display: block; margin-top: 3px; font-size: 11px; color: var(--admin-muted); }
        .admin-mobile-button { display: none; border: none; background: transparent; color: #fff; font-size: 22px; }
        .admin-topbar-actions { display: flex; align-items: center; gap: 14px; }
        .admin-notif-btn {
            position: relative; width: 41px; height: 41px; border-radius: 11px; border: 1px solid var(--admin-border);
            background: rgba(255,255,255,.04); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 16px;
        }
        .admin-notif-badge {
            position: absolute; top: -5px; right: -5px; min-width: 17px; height: 17px; border-radius: 50%;
            background: var(--aqua-blue-water); color: white; font-size: 10px; font-weight: 700;
            display: flex; align-items: center; justify-content: center; border: 2px solid #01111D; padding: 0 3px;
        }

        .admin-page { width: 100%; max-width: 1500px; margin: 0 auto; padding: 31px; }
        .admin-page-header { margin-bottom: 27px; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 14px; }
        .admin-page-title { margin: 0 0 6px; font-size: 27px; font-weight: 800; color: var(--admin-text); letter-spacing: -.3px; }
        .admin-page-description { margin: 0; font-size: 13px; color: var(--admin-muted); }

        .card { background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px); border: 1px solid var(--admin-border); border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,.25); color: var(--admin-text); }
        .btn { border-radius: 9px; font-weight: 600; transition: all .2s ease; }
        .btn-primary { background: linear-gradient(135deg, #11C9C0, #1AD6C5); border-color: transparent; color: #012027; box-shadow: 0 5px 16px rgba(0,220,210,.25); }
        .btn-primary:hover { filter: brightness(1.06); transform: translateY(-1px); color: #012027; }
        .btn-outline-primary { color: var(--aqua-cyan); border-color: rgba(0,217,208,.4); }
        .btn-outline-primary:hover { background: rgba(0,217,208,.14); border-color: var(--aqua-cyan); color: var(--aqua-cyan); }

        .table { color: var(--admin-text); margin-bottom: 0; }
        .table thead th { font-size: 11px; text-transform: uppercase; letter-spacing: .55px; color: var(--admin-muted); font-weight: 750; padding: 15px 16px; background: rgba(255,255,255,.03); border-bottom: 1px solid var(--admin-border); }
        .table tbody td { padding: 15px 16px; border-color: var(--admin-border); font-size: 13px; vertical-align: middle; }
        .table-hover tbody tr:hover { background: rgba(255,255,255,.03); }

        .badge { border-radius: 7px; padding: 6px 9px; font-size: 10px; font-weight: 700; letter-spacing: .2px; }
        .admin-alert { border: none; border-radius: 11px; padding: 13px 16px; font-size: 13px; background: rgba(0,217,208,.10); color: var(--aqua-cyan); border: 1px solid rgba(0,217,208,.25); }
        .admin-alert.alert-danger { background: rgba(255,92,122,.10); color: #ff8fa3; border-color: rgba(255,92,122,.3); }

        .form-control, .form-select { border-radius: 9px; border: 1px solid var(--admin-border); padding: 10px 13px; font-size: 13px; box-shadow: none !important; background: rgba(255,255,255,.03); color: var(--admin-text); }
        .form-control:focus, .form-select:focus { border-color: var(--aqua-cyan); box-shadow: 0 0 0 3px rgba(0,217,208,.14) !important; background: rgba(255,255,255,.05); color: var(--admin-text); }
        .form-control::placeholder { color: var(--admin-muted); }
        .form-label { font-size: 13px; font-weight: 600; color: var(--admin-text); }

        .admin-footer { margin-top: auto; text-align: center; color: var(--admin-muted); font-size: 11px; padding: 20px 15px 25px; }

        /* ---- Stat cards (KPI row) ---- */
        .admin-stat-card { background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px); border: 1px solid var(--admin-border); border-radius: 16px; min-height: 150px; padding: 24px; transition: transform .2s ease, border-color .2s ease; }
        .admin-stat-card:hover { transform: translateY(-3px); border-color: rgba(0,217,208,.3); }
        .admin-stat-content { display: flex; justify-content: space-between; align-items: flex-start; }
        .admin-stat-label { font-size: 12.5px; color: var(--admin-muted); margin-bottom: 8px; }
        .admin-stat-number { font-size: 27px; font-weight: 800; color: var(--admin-text); }
        .admin-stat-description { font-size: 11px; color: var(--admin-muted); margin-top: 6px; }
        .admin-stat-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 19px; flex-shrink: 0; }
        .icon-primary { background: rgba(0,217,208,.15); color: var(--aqua-cyan); }
        .icon-warning { background: rgba(245,166,35,.15); color: var(--admin-warning); }
        .icon-success { background: rgba(139,214,60,.15); color: var(--admin-success); }
        .icon-danger { background: rgba(255,92,122,.15); color: var(--admin-danger); }
        .icon-purple { background: rgba(139,92,246,.15); color: var(--aqua-violet); }
        .icon-blue { background: rgba(0,143,213,.15); color: var(--aqua-blue-water); }

        /* ---- Info cards (Utilisateurs / Candidats / Services) ---- */
        .admin-info-card { background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px); border: 1px solid var(--admin-border); border-radius: 16px; padding: 24px; height: 100%; transition: transform .2s ease, border-color .2s ease; }
        .admin-info-card:hover { transform: translateY(-3px); border-color: rgba(0,217,208,.3); }
        .admin-info-header { display: flex; align-items: center; gap: 13px; margin-bottom: 18px; }
        .admin-info-icon { width: 44px; height: 44px; flex-shrink: 0; border-radius: 12px; background: rgba(0,217,208,.14); color: var(--aqua-cyan); display: flex; align-items: center; justify-content: center; font-size: 19px; }
        .admin-info-title { margin: 0; font-size: 14.5px; font-weight: 700; color: var(--admin-text); }
        .admin-info-text { margin: 3px 0 0; font-size: 12px; color: var(--admin-muted); }
        .admin-info-value { font-size: 30px; font-weight: 800; color: var(--admin-text); margin-bottom: 14px; }
        .admin-info-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 14px; border-top: 1px solid var(--admin-border); font-size: 12.5px; color: var(--admin-muted); }
        .admin-link { color: var(--aqua-cyan); font-weight: 700; font-size: 12.5px; display: inline-flex; align-items: center; gap: 6px; transition: gap .2s; }
        .admin-link:hover { color: var(--aqua-cyan-bright); gap: 9px; }

        /* ---- Quick actions section ---- */
        .admin-section-card { background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px); border: 1px solid var(--admin-border); border-radius: 16px; padding: 26px; }
        .admin-section-header { margin-bottom: 8px; }
        .admin-section-title { margin: 0 0 4px; font-size: 17px; font-weight: 800; color: var(--admin-text); }
        .admin-section-description { margin: 0; font-size: 12.5px; color: var(--admin-muted); }

        .admin-action {
            display: flex; align-items: center; gap: 14px; padding: 16px; border-radius: 13px;
            background: rgba(255,255,255,.03); border: 1px solid var(--admin-border); color: var(--admin-text);
            transition: background .2s ease, border-color .2s ease, transform .2s ease;
        }
        .admin-action:hover { background: rgba(0,217,208,.08); border-color: rgba(0,217,208,.3); transform: translateY(-2px); color: var(--admin-text); }
        .admin-action-icon { width: 42px; height: 42px; flex-shrink: 0; border-radius: 11px; background: rgba(0,217,208,.14); color: var(--aqua-cyan); display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .admin-action-title { font-size: 13.5px; font-weight: 700; color: var(--admin-text); }
        .admin-action-text { font-size: 11.5px; color: var(--admin-muted); margin-top: 2px; }
        .admin-action i.bi-chevron-right { color: var(--admin-muted); }

        @media (max-width: 992px) {
            :root { --sidebar-width: 230px; }
            .admin-page { padding: 25px 22px; }
            .admin-topbar { padding: 0 22px; }
        }
        @media (max-width: 768px) {
            .admin-sidebar { transform: translateX(-100%); transition: transform .25s ease; }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-main { margin-left: 0; width: 100%; }
            .admin-mobile-button { display: block; }
            .admin-topbar { padding: 0 15px; }
            .admin-page { padding: 21px 15px; }
            .admin-page-title { font-size: 23px; }
        }

        @stack('styles')
    </style>
</head>

<body>

<div class="admin-layout">

    <aside class="admin-sidebar" id="adminSidebar">

        <div class="admin-sidebar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="admin-sidebar-logo">
            <div>
                <h1 class="admin-sidebar-brand-title">ABHOER</h1>
                <span class="admin-sidebar-brand-subtitle">Espace Administrateur</span>
            </div>
        </div>

        <div class="admin-sidebar-profile">
            <div class="admin-profile-icon"><i class="bi bi-shield-lock-fill"></i></div>
            <div>
                <span class="admin-profile-name">{{ auth()->user()->prenom ?? auth()->user()->nom ?? 'Administrateur' }}</span>
                <span class="admin-profile-role">Administrateur</span>
            </div>
        </div>

        <nav class="admin-sidebar-menu">
            <div class="admin-menu-title">Administration</div>

            <div class="admin-menu-item">
                <a href="{{ route('admin.dashboard') }}" class="admin-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i><span>Tableau de bord</span>
                </a>
            </div>
            <div class="admin-menu-item">
                <a href="{{ route('admin.utilisateurs.index') }}" class="admin-menu-link {{ request()->routeIs('admin.utilisateurs.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i><span>Utilisateurs</span>
                </a>
            </div>
            <div class="admin-menu-item">
                <a href="{{ route('admin.departements.index') }}" class="admin-menu-link {{ request()->routeIs('admin.departements.*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3-fill"></i><span>Départements</span>
                </a>
            </div>
            <div class="admin-menu-item">
                <a href="{{ route('admin.services.index') }}" class="admin-menu-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="bi bi-bounding-box"></i><span>Services</span>
                </a>
            </div>
            <div class="admin-menu-item">
                <a href="{{ route('admin.demandes.index') }}" class="admin-menu-link {{ request()->routeIs('admin.demandes.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text-fill"></i><span>Demandes de stage</span>
                </a>
            </div>

            <div class="admin-menu-title mt-3">Suivi</div>
            <div class="admin-menu-item">
                <a href="{{ route('admin.stages.index') }}" class="admin-menu-link {{ request()->routeIs('admin.stages.*') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard-fill"></i><span>Stages</span>
                </a>
            </div>
        </nav>

        <div class="admin-sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="admin-logout-link"><i class="bi bi-box-arrow-right"></i><span>Déconnexion</span></button>
            </form>
        </div>

    </aside>

    <div class="admin-main">

        <header class="admin-topbar">
            <div class="admin-topbar-left">
                <button type="button" class="admin-mobile-button" id="adminMobileButton" aria-label="Ouvrir le menu"><i class="bi bi-list"></i></button>
                <div class="admin-topbar-icon"><i class="bi bi-shield-check"></i></div>
                <div>
                    <h2 class="admin-topbar-title">Espace Administrateur</h2>
                    <span class="admin-topbar-subtitle">Plateforme de gestion des stages ABHOER</span>
                </div>
            </div>

            <div class="admin-topbar-actions">
                <a href="{{ route('admin.utilisateurs.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-person-plus me-1"></i> Ajouter un utilisateur
                </a>
            </div>
        </header>

        <main class="admin-page">

            @hasSection('page-header')
                @yield('page-header')
            @else
                <div class="admin-page-header">
                    <div>
                        <h1 class="admin-page-title">@yield('page-title', 'Espace Administrateur')</h1>
                        <p class="admin-page-description">@yield('page-description', 'Plateforme de gestion des stages ABHOER.')</p>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success admin-alert mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger admin-alert mb-4" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <div class="admin-content">
                @yield('content')
            </div>

        </main>

        <footer class="admin-footer">ABHOER — Plateforme de gestion des stages</footer>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('adminMobileButton');
        const sidebar = document.getElementById('adminSidebar');
        if (button && sidebar) {
            button.addEventListener('click', function () { sidebar.classList.toggle('show'); });
        }
    });
</script>

@stack('scripts')

</body>
</html>

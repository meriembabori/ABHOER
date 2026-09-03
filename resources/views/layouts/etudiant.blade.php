<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Étudiant - ABHOER')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/aqua-theme.css') }}">

    <style>
        :root {
            --etud-primary: #01111D;
            --etud-blue: #008FD5;
            --etud-blue-dark: #005B91;
            --etud-blue-light: rgba(0,143,213,0.14);
            --etud-bg: #01111D;
            --etud-white: #0A1B2A;
            --etud-text: #F5FAFC;
            --etud-muted: #9FB2BE;
            --etud-border: rgba(255,255,255,0.10);
            --etud-success: #8BD63C;
            --etud-warning: #F5A623;
            --etud-danger: #FF5C7A;
            --sidebar-width: 260px;
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; min-height: 100%; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: var(--etud-bg);
            color: var(--etud-text);
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; }

        .etud-layout { min-height: 100vh; display: flex; }

        .etud-sidebar {
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
            border-right: 1px solid var(--etud-border);
            overflow-y: auto;
        }

        .etud-sidebar-brand {
            height: 90px; display: flex; align-items: center; padding: 18px 21px;
            border-bottom: 1px solid var(--etud-border);
        }
        .etud-sidebar-logo { width: 48px; height: 48px; object-fit: contain; background: #fff; border-radius: 12px; padding: 4px; margin-right: 12px; box-shadow: 0 5px 15px rgba(0,0,0,.3); }
        .etud-sidebar-brand-title { margin: 0; font-size: 19px; font-weight: 800; color: #fff; letter-spacing: .4px; line-height: 1.2; }
        .etud-sidebar-brand-subtitle { display: block; margin-top: 4px; font-size: 10px; color: rgba(255,255,255,.55); font-weight: 500; }

        .etud-sidebar-profile {
            margin: 18px 15px 14px; padding: 13px; background: rgba(0,217,208,.06);
            border: 1px solid var(--etud-border); border-radius: 13px; display: flex; align-items: center; gap: 11px;
        }
        .etud-profile-icon {
            width: 40px; height: 40px; flex-shrink: 0; border-radius: 11px; background: rgba(0,217,208,.18);
            color: var(--aqua-cyan); display: flex; align-items: center; justify-content: center; font-size: 18px; position: relative;
        }
        .etud-profile-icon::after {
            content: ''; position: absolute; bottom: -1px; right: -1px; width: 10px; height: 10px; border-radius: 50%;
            background: var(--aqua-green-env); border: 2px solid #041220;
        }
        .etud-profile-name { display: block; font-size: 13px; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .etud-profile-role { display: block; margin-top: 3px; font-size: 10px; color: rgba(255,255,255,.50); }

        .etud-sidebar-menu { flex: 1; padding: 9px 12px; overflow-y: auto; }
        .etud-menu-title { padding: 10px 11px; margin-bottom: 6px; font-size: 10px; font-weight: 800; color: rgba(255,255,255,.38); text-transform: uppercase; letter-spacing: 1px; }
        .etud-menu-item { margin-bottom: 4px; }
        .etud-menu-link {
            position: relative; display: flex; align-items: center; width: 100%; min-height: 45px; padding: 10px 13px;
            border-radius: 10px; color: rgba(255,255,255,.65); font-size: 13px; font-weight: 500;
            transition: background .2s ease, color .2s ease, transform .2s ease;
        }
        .etud-menu-link i { width: 23px; margin-right: 11px; font-size: 16px; text-align: center; flex-shrink: 0; }
        .etud-menu-link:hover { color: #fff; background: rgba(255,255,255,.06); transform: translateX(2px); }
        .etud-menu-link.active {
            color: #012027; background: linear-gradient(90deg, #11C9C0, #1AD6C5); font-weight: 700;
            box-shadow: 0 7px 18px rgba(0,220,210,.25);
        }
        .etud-menu-link.active::before { content: ""; position: absolute; left: 0; top: 9px; bottom: 9px; width: 3px; border-radius: 0 5px 5px 0; background: #012027; }
        .etud-menu-link.active i { color: #012027; }
        .etud-menu-badge { margin-left: auto; background: var(--aqua-blue-water); color: #fff; font-size: 10px; font-weight: 700; border-radius: 20px; padding: 1px 7px; }

        .etud-sidebar-footer { padding: 13px; border-top: 1px solid var(--etud-border); }
        .etud-logout-link {
            width: 100%; border: none; background: transparent; display: flex; align-items: center;
            padding: 11px 13px; border-radius: 10px; color: #ff8fa3; font-size: 13px; font-weight: 600; transition: .2s ease;
        }
        .etud-logout-link:hover { background: rgba(255,92,122,.14); color: #ffc2cf; }
        .etud-logout-link i { width: 23px; margin-right: 10px; font-size: 16px; }

        .etud-main { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); min-height: 100vh; display: flex; flex-direction: column; }

        .etud-topbar {
            min-height: 76px; background: rgba(4, 15, 24, 0.82); backdrop-filter: blur(14px); border-bottom: 1px solid var(--etud-border);
            display: flex; align-items: center; justify-content: space-between; padding: 0 30px;
            position: sticky; top: 0; z-index: 900;
        }
        .etud-topbar-left { display: flex; align-items: center; gap: 12px; }
        .etud-topbar-icon { width: 41px; height: 41px; border-radius: 11px; background: rgba(0,217,208,.14); color: var(--aqua-cyan); display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .etud-topbar-title { margin: 0; font-size: 16px; font-weight: 750; color: var(--etud-text); }
        .etud-topbar-subtitle { display: block; margin-top: 3px; font-size: 11px; color: var(--etud-muted); }
        .etud-mobile-button { display: none; border: none; background: transparent; color: #fff; font-size: 22px; }
        .etud-topbar-actions { display: flex; align-items: center; gap: 14px; }
        .etud-notif-btn {
            position: relative; width: 41px; height: 41px; border-radius: 11px; border: 1px solid var(--etud-border);
            background: rgba(255,255,255,.04); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 16px;
        }
        .etud-notif-badge {
            position: absolute; top: -5px; right: -5px; min-width: 17px; height: 17px; border-radius: 50%;
            background: var(--aqua-blue-water); color: white; font-size: 10px; font-weight: 700;
            display: flex; align-items: center; justify-content: center; border: 2px solid #01111D; padding: 0 3px;
        }

        .etud-page { width: 100%; max-width: 1500px; margin: 0 auto; padding: 31px; }
        .etud-page-header { margin-bottom: 27px; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 14px; }
        .etud-page-title { margin: 0 0 6px; font-size: 27px; font-weight: 800; color: var(--etud-text); letter-spacing: -.3px; }
        .etud-page-description { margin: 0; font-size: 13px; color: var(--etud-muted); }

        .card { background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px); border: 1px solid var(--etud-border); border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,.25); color: var(--etud-text); }
        .btn { border-radius: 9px; font-weight: 600; transition: all .2s ease; }
        .btn-primary { background: linear-gradient(135deg, #11C9C0, #1AD6C5); border-color: transparent; color: #012027; box-shadow: 0 5px 16px rgba(0,220,210,.25); }
        .btn-primary:hover { filter: brightness(1.06); transform: translateY(-1px); color: #012027; }
        .btn-outline-primary { color: var(--aqua-cyan); border-color: rgba(0,217,208,.4); }
        .btn-outline-primary:hover { background: rgba(0,217,208,.14); border-color: var(--aqua-cyan); color: var(--aqua-cyan); }

        .table { color: var(--etud-text); margin-bottom: 0; }
        .table thead th { font-size: 11px; text-transform: uppercase; letter-spacing: .55px; color: var(--etud-muted); font-weight: 750; padding: 15px 16px; background: rgba(255,255,255,.03); border-bottom: 1px solid var(--etud-border); }
        .table tbody td { padding: 15px 16px; border-color: var(--etud-border); font-size: 13px; vertical-align: middle; }
        .table-hover tbody tr:hover { background: rgba(255,255,255,.03); }

        .badge { border-radius: 7px; padding: 6px 9px; font-size: 10px; font-weight: 700; letter-spacing: .2px; }
        .etud-alert { border: none; border-radius: 11px; padding: 13px 16px; font-size: 13px; background: rgba(0,217,208,.10); color: var(--aqua-cyan); border: 1px solid rgba(0,217,208,.25); }
        .etud-alert.alert-danger { background: rgba(255,92,122,.10); color: #ff8fa3; border-color: rgba(255,92,122,.3); }

        .form-control, .form-select { border-radius: 9px; border: 1px solid var(--etud-border); padding: 10px 13px; font-size: 13px; box-shadow: none !important; background: rgba(255,255,255,.03); color: var(--etud-text); }
        .form-control:focus, .form-select:focus { border-color: var(--aqua-cyan); box-shadow: 0 0 0 3px rgba(0,217,208,.14) !important; background: rgba(255,255,255,.05); color: var(--etud-text); }
        .form-control::placeholder { color: var(--etud-muted); }
        .form-label { font-size: 13px; font-weight: 600; color: var(--etud-text); }

        .etud-footer { margin-top: auto; text-align: center; color: var(--etud-muted); font-size: 11px; padding: 20px 15px 25px; }

        .etud-stat-card { background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px); border: 1px solid var(--etud-border); border-radius: 16px; min-height: 150px; padding: 24px; transition: transform .2s ease, border-color .2s ease; }
        .etud-stat-card:hover { transform: translateY(-3px); border-color: rgba(0,217,208,.3); }
        .etud-stat-content { display: flex; justify-content: space-between; align-items: flex-start; }
        .etud-stat-label { font-size: 12.5px; color: var(--etud-muted); margin-bottom: 8px; }
        .etud-stat-number { font-size: 27px; font-weight: 800; color: var(--etud-text); }
        .etud-stat-description { font-size: 11px; color: var(--etud-muted); margin-top: 6px; }
        .etud-stat-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 19px; flex-shrink: 0; }
        .icon-primary { background: rgba(0,217,208,.15); color: var(--aqua-cyan); }
        .icon-warning { background: rgba(245,166,35,.15); color: var(--etud-warning); }
        .icon-success { background: rgba(139,214,60,.15); color: var(--etud-success); }
        .icon-danger { background: rgba(255,92,122,.15); color: var(--etud-danger); }
        .icon-purple { background: rgba(139,92,246,.15); color: var(--aqua-violet); }
        .icon-blue { background: rgba(0,143,213,.15); color: var(--aqua-blue-water); }

        @media (max-width: 992px) {
            :root { --sidebar-width: 230px; }
            .etud-page { padding: 25px 22px; }
            .etud-topbar { padding: 0 22px; }
        }
        @media (max-width: 768px) {
            .etud-sidebar { transform: translateX(-100%); transition: transform .25s ease; }
            .etud-sidebar.show { transform: translateX(0); }
            .etud-main { margin-left: 0; width: 100%; }
            .etud-mobile-button { display: block; }
            .etud-topbar { padding: 0 15px; }
            .etud-page { padding: 21px 15px; }
            .etud-page-title { font-size: 23px; }
        }

        @stack('styles')
    </style>
</head>

<body>

<div class="etud-layout">

    <aside class="etud-sidebar" id="etudSidebar">

        <div class="etud-sidebar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="etud-sidebar-logo">
            <div>
                <h1 class="etud-sidebar-brand-title">ABHOER</h1>
                <span class="etud-sidebar-brand-subtitle">Espace Étudiant</span>
            </div>
        </div>

        <div class="etud-sidebar-profile">
            <div class="etud-profile-icon"><i class="bi bi-person-fill"></i></div>
            <div>
                <span class="etud-profile-name">{{ auth()->user()->prenom ?? auth()->user()->nom ?? 'Étudiant' }}</span>
                <span class="etud-profile-role">Étudiant</span>
            </div>
        </div>

        <nav class="etud-sidebar-menu">
            <div class="etud-menu-title">Menu principal</div>

            <div class="etud-menu-item">
                <a href="{{ route('etudiant.dashboard') }}" class="etud-menu-link {{ request()->routeIs('etudiant.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i><span>Tableau de bord</span>
                </a>
            </div>
            <div class="etud-menu-item">
                <a href="{{ route('etudiant.demandes.index') }}" class="etud-menu-link {{ request()->routeIs('etudiant.demandes.index') || request()->routeIs('etudiant.demandes.show') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text-fill"></i><span>Mes demandes</span>
                </a>
            </div>
            <div class="etud-menu-item">
                <a href="{{ route('etudiant.demandes.create') }}" class="etud-menu-link {{ request()->routeIs('etudiant.demandes.create') || request()->routeIs('etudiant.demandes.informations') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-plus-fill"></i><span>Nouvelle demande</span>
                </a>
            </div>
            @if (\Illuminate\Support\Facades\Route::has('etudiant.documents.index'))
            <div class="etud-menu-item">
                <a href="{{ route('etudiant.documents.index') }}" class="etud-menu-link {{ request()->routeIs('etudiant.documents.*') ? 'active' : '' }}">
                    <i class="bi bi-folder-fill"></i><span>Mes documents</span>
                </a>
            </div>
            @endif
            @if (\Illuminate\Support\Facades\Route::has('etudiant.notifications'))
            <div class="etud-menu-item">
                <a href="{{ route('etudiant.notifications') }}" class="etud-menu-link {{ request()->routeIs('etudiant.notifications*') ? 'active' : '' }}">
                    <i class="bi bi-bell-fill"></i><span>Notifications</span>
                </a>
            </div>
            @endif

            <div class="etud-menu-title mt-3">Compte</div>
            <div class="etud-menu-item">
                <a href="{{ route('etudiant.profil') }}" class="etud-menu-link {{ request()->routeIs('etudiant.profil*') ? 'active' : '' }}">
                    <i class="bi bi-person-vcard-fill"></i><span>Mon profil</span>
                </a>
            </div>
        </nav>

        <div class="etud-sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="etud-logout-link"><i class="bi bi-box-arrow-right"></i><span>Déconnexion</span></button>
            </form>
        </div>

    </aside>

    <div class="etud-main">

        <header class="etud-topbar">
            <div class="etud-topbar-left">
                <button type="button" class="etud-mobile-button" id="etudMobileButton" aria-label="Ouvrir le menu"><i class="bi bi-list"></i></button>
                <div class="etud-topbar-icon"><i class="bi bi-mortarboard-fill"></i></div>
                <div>
                    <h2 class="etud-topbar-title">Espace Étudiant</h2>
                    <span class="etud-topbar-subtitle">Suivi de vos demandes de stage ABHOER</span>
                </div>
            </div>

            <div class="etud-topbar-actions">
                <a href="{{ route('etudiant.demandes.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Nouvelle demande
                </a>
                @if (\Illuminate\Support\Facades\Route::has('etudiant.notifications'))
                <a href="{{ route('etudiant.notifications') }}" class="etud-notif-btn" aria-label="Notifications">
                    <i class="bi bi-bell-fill"></i>
                </a>
                @endif
            </div>
        </header>

        <main class="etud-page">

            @hasSection('page-header')
                @yield('page-header')
            @else
                <div class="etud-page-header">
                    <div>
                        <h1 class="etud-page-title">@yield('page-title', 'Tableau de bord')</h1>
                        <p class="etud-page-description">@yield('page-description', '')</p>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success etud-alert mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger etud-alert mb-4" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <div class="etud-content">
                @yield('content')
            </div>

        </main>

        <footer class="etud-footer">ABHOER — Plateforme de gestion des stages</footer>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('etudMobileButton');
        const sidebar = document.getElementById('etudSidebar');
        if (button && sidebar) {
            button.addEventListener('click', function () { sidebar.classList.toggle('show'); });
        }
    });
</script>

@stack('scripts')

</body>
</html>

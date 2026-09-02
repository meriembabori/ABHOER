<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Responsable - ABHOER')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --resp-primary: #14213d;
            --resp-blue: #2563eb;
            --resp-blue-dark: #1d4ed8;
            --resp-blue-light: #eff6ff;
            --resp-bg: #f5f7fb;
            --resp-white: #ffffff;
            --resp-text: #172033;
            --resp-muted: #7b8496;
            --resp-border: #e5e9f0;
            --resp-success: #16a34a;
            --resp-warning: #d97706;
            --resp-danger: #dc2626;
            --sidebar-width: 260px;
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; min-height: 100%; }
        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: var(--resp-bg);
            color: var(--resp-text);
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; }

        .resp-layout { min-height: 100vh; display: flex; }

        .resp-sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: linear-gradient(180deg, #14213d 0%, #101a30 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 8px 0 30px rgba(15,23,42,.10);
            overflow-y: auto;
        }

        .resp-sidebar-brand {
            height: 90px; display: flex; align-items: center; padding: 18px 21px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .resp-sidebar-logo { width: 48px; height: 48px; object-fit: contain; background: #fff; border-radius: 12px; padding: 4px; margin-right: 12px; box-shadow: 0 5px 15px rgba(0,0,0,.12); }
        .resp-sidebar-brand-title { margin: 0; font-size: 19px; font-weight: 800; color: #fff; letter-spacing: .4px; line-height: 1.2; }
        .resp-sidebar-brand-subtitle { display: block; margin-top: 4px; font-size: 10px; color: rgba(255,255,255,.55); font-weight: 500; }

        .resp-sidebar-profile {
            margin: 18px 15px 14px; padding: 13px; background: rgba(255,255,255,.055);
            border: 1px solid rgba(255,255,255,.08); border-radius: 13px; display: flex; align-items: center; gap: 11px;
        }
        .resp-profile-icon {
            width: 40px; height: 40px; flex-shrink: 0; border-radius: 11px; background: rgba(37,99,235,.20);
            color: #60a5fa; display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .resp-profile-name { display: block; font-size: 13px; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .resp-profile-role { display: block; margin-top: 3px; font-size: 10px; color: rgba(255,255,255,.50); }

        .resp-sidebar-menu { flex: 1; padding: 9px 12px; overflow-y: auto; }
        .resp-menu-title { padding: 10px 11px; margin-bottom: 6px; font-size: 10px; font-weight: 800; color: rgba(255,255,255,.38); text-transform: uppercase; letter-spacing: 1px; }
        .resp-menu-item { margin-bottom: 4px; }
        .resp-menu-link {
            position: relative; display: flex; align-items: center; width: 100%; min-height: 45px; padding: 10px 13px;
            border-radius: 10px; color: rgba(255,255,255,.67); font-size: 13px; font-weight: 500;
            transition: background .2s ease, color .2s ease, transform .2s ease;
        }
        .resp-menu-link i { width: 23px; margin-right: 11px; font-size: 16px; text-align: center; flex-shrink: 0; }
        .resp-menu-link:hover { color: #fff; background: rgba(255,255,255,.075); transform: translateX(2px); }
        .resp-menu-link.active {
            color: #fff; background: linear-gradient(90deg, #2563eb, #1d4ed8); font-weight: 700;
            box-shadow: 0 7px 18px rgba(37,99,235,.25);
        }
        .resp-menu-link.active::before { content: ""; position: absolute; left: 0; top: 9px; bottom: 9px; width: 3px; border-radius: 0 5px 5px 0; background: #fff; }
        .resp-menu-link.active i { color: #fff; }

        .resp-sidebar-footer { padding: 13px; border-top: 1px solid rgba(255,255,255,.08); }
        .resp-logout-link {
            width: 100%; border: none; background: transparent; display: flex; align-items: center;
            padding: 11px 13px; border-radius: 10px; color: #fda4af; font-size: 13px; font-weight: 600; transition: .2s ease;
        }
        .resp-logout-link:hover { background: rgba(220,38,38,.12); color: #fecdd3; }
        .resp-logout-link i { width: 23px; margin-right: 10px; font-size: 16px; }

        .resp-main { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); min-height: 100vh; display: flex; flex-direction: column; }

        .resp-topbar {
            min-height: 76px; background: rgba(255,255,255,.97); border-bottom: 1px solid var(--resp-border);
            display: flex; align-items: center; justify-content: space-between; padding: 0 30px;
            position: sticky; top: 0; z-index: 900; box-shadow: 0 3px 15px rgba(20,33,61,.035);
        }
        .resp-topbar-left { display: flex; align-items: center; gap: 12px; }
        .resp-topbar-icon { width: 41px; height: 41px; border-radius: 11px; background: var(--resp-blue-light); color: var(--resp-blue); display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .resp-topbar-title { margin: 0; font-size: 16px; font-weight: 750; color: var(--resp-text); }
        .resp-topbar-subtitle { display: block; margin-top: 3px; font-size: 11px; color: var(--resp-muted); }
        .resp-mobile-button { display: none; border: none; background: transparent; color: var(--resp-primary); font-size: 22px; }

        .resp-page { width: 100%; max-width: 1500px; margin: 0 auto; padding: 31px; }
        .resp-page-header { margin-bottom: 27px; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 14px; }
        .resp-page-title { margin: 0 0 6px; font-size: 27px; font-weight: 800; color: var(--resp-text); letter-spacing: -.3px; }
        .resp-page-description { margin: 0; font-size: 13px; color: var(--resp-muted); }

        .card { background: #fff; border: 1px solid var(--resp-border); border-radius: 15px; box-shadow: 0 5px 20px rgba(20,33,61,.045); }
        .btn { border-radius: 9px; font-weight: 600; transition: all .2s ease; }
        .btn-primary { background: var(--resp-blue); border-color: var(--resp-blue); box-shadow: 0 5px 12px rgba(37,99,235,.15); }
        .btn-primary:hover { background: var(--resp-blue-dark); border-color: var(--resp-blue-dark); transform: translateY(-1px); }
        .btn-outline-primary { color: var(--resp-blue); border-color: #bfdbfe; }
        .btn-outline-primary:hover { background: var(--resp-blue); border-color: var(--resp-blue); color: #fff; }

        .table { color: var(--resp-text); margin-bottom: 0; }
        .table thead th { font-size: 11px; text-transform: uppercase; letter-spacing: .55px; color: var(--resp-muted); font-weight: 750; padding: 15px 16px; background: #f8fafc; border-bottom: 1px solid var(--resp-border); }
        .table tbody td { padding: 15px 16px; border-color: var(--resp-border); font-size: 13px; vertical-align: middle; }
        .table-hover tbody tr:hover { background: #f8faff; }

        .badge { border-radius: 7px; padding: 6px 9px; font-size: 10px; font-weight: 700; letter-spacing: .2px; }
        .resp-alert { border: none; border-radius: 11px; padding: 13px 16px; font-size: 13px; box-shadow: 0 3px 12px rgba(23,32,51,.04); }

        .form-control, .form-select { border-radius: 9px; border-color: #dfe4ec; padding: 10px 13px; font-size: 13px; box-shadow: none !important; }
        .form-control:focus, .form-select:focus { border-color: var(--resp-blue); box-shadow: 0 0 0 3px rgba(37,99,235,.09) !important; }
        .form-label { font-size: 13px; font-weight: 600; color: var(--resp-text); }

        .resp-footer { margin-top: auto; text-align: center; color: #98a1b2; font-size: 11px; padding: 20px 15px 25px; }

        .resp-stat-card { background: #fff; border: 1px solid var(--resp-border); border-radius: 16px; min-height: 150px; padding: 24px; box-shadow: 0 5px 20px rgba(23,32,51,.045); transition: transform .2s ease, box-shadow .2s ease; }
        .resp-stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(23,32,51,.08); }
        .resp-stat-content { display: flex; justify-content: space-between; align-items: flex-start; }
        .resp-stat-label { font-size: 12.5px; color: var(--resp-muted); margin-bottom: 8px; }
        .resp-stat-number { font-size: 27px; font-weight: 800; color: var(--resp-text); }
        .resp-stat-description { font-size: 11px; color: var(--resp-muted); margin-top: 6px; }
        .resp-stat-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 19px; flex-shrink: 0; }
        .icon-primary { background: var(--resp-blue-light); color: var(--resp-blue); }
        .icon-warning { background: #fff7ed; color: var(--resp-warning); }
        .icon-success { background: #ecfdf3; color: var(--resp-success); }
        .icon-danger { background: #fff1f2; color: var(--resp-danger); }
        .icon-purple { background: #f3e8ff; color: #7c3aed; }

        @media (max-width: 992px) {
            :root { --sidebar-width: 230px; }
            .resp-page { padding: 25px 22px; }
            .resp-topbar { padding: 0 22px; }
        }
        @media (max-width: 768px) {
            .resp-sidebar { transform: translateX(-100%); transition: transform .25s ease; }
            .resp-sidebar.show { transform: translateX(0); }
            .resp-main { margin-left: 0; width: 100%; }
            .resp-mobile-button { display: block; }
            .resp-topbar { padding: 0 15px; }
            .resp-page { padding: 21px 15px; }
            .resp-page-title { font-size: 23px; }
        }

        @stack('styles')
    </style>
</head>

<body>

<div class="resp-layout">

    <aside class="resp-sidebar" id="respSidebar">

        <div class="resp-sidebar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="resp-sidebar-logo">
            <div>
                <h1 class="resp-sidebar-brand-title">ABHOER</h1>
                <span class="resp-sidebar-brand-subtitle">Espace Responsable</span>
            </div>
        </div>

        <div class="resp-sidebar-profile">
            <div class="resp-profile-icon"><i class="bi bi-person-fill"></i></div>
            <div>
                <span class="resp-profile-name">{{ auth()->user()->prenom ?? auth()->user()->nom ?? 'Responsable' }}</span>
                <span class="resp-profile-role">Responsable</span>
            </div>
        </div>

        <nav class="resp-sidebar-menu">
            <div class="resp-menu-title">Menu principal</div>

            <div class="resp-menu-item">
                <a href="{{ route('responsable.dashboard') }}" class="resp-menu-link {{ request()->routeIs('responsable.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i><span>Tableau de bord</span>
                </a>
            </div>
            <div class="resp-menu-item">
                <a href="{{ route('responsable.demandes.index') }}" class="resp-menu-link {{ request()->routeIs('responsable.demandes.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text-fill"></i><span>Demandes de stage</span>
                </a>
            </div>
            <div class="resp-menu-item">
                <a href="{{ route('responsable.stages.index') }}" class="resp-menu-link {{ request()->routeIs('responsable.stages.*') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard-fill"></i><span>Suivi des stages</span>
                </a>
            </div>
            <div class="resp-menu-item">
                <a href="{{ route('responsable.attestations.index') }}" class="resp-menu-link {{ request()->routeIs('responsable.attestations.*') ? 'active' : '' }}">
                    <i class="bi bi-award-fill"></i><span>Attestations</span>
                </a>
            </div>

            <div class="resp-menu-title mt-3">Suivi</div>
            <div class="resp-menu-item">
                <a href="{{ route('responsable.historique.index') }}" class="resp-menu-link {{ request()->routeIs('responsable.historique.*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i><span>Historique des actions</span>
                </a>
            </div>
        </nav>

        <div class="resp-sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="resp-logout-link"><i class="bi bi-box-arrow-right"></i><span>Déconnexion</span></button>
            </form>
        </div>

    </aside>

    <div class="resp-main">

        <header class="resp-topbar">
            <div class="resp-topbar-left">
                <button type="button" class="resp-mobile-button" id="respMobileButton" aria-label="Ouvrir le menu"><i class="bi bi-list"></i></button>
                <div class="resp-topbar-icon"><i class="bi bi-clipboard-data-fill"></i></div>
                <div>
                    <h2 class="resp-topbar-title">Espace Responsable</h2>
                    <span class="resp-topbar-subtitle">Gestion des demandes de stage ABHOER</span>
                </div>
            </div>

            <a href="{{ route('responsable.demandes.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Nouvelle demande physique
            </a>
        </header>

        <main class="resp-page">

            @hasSection('page-header')
                @yield('page-header')
            @else
                <div class="resp-page-header">
                    <div>
                        <h1 class="resp-page-title">@yield('page-title', 'Espace Responsable')</h1>
                        <p class="resp-page-description">@yield('page-description', 'Gestion des demandes de stage ABHOER.')</p>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success resp-alert mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger resp-alert mb-4" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <div class="resp-content">
                @yield('content')
            </div>

        </main>

        <footer class="resp-footer">ABHOER — Plateforme de gestion des stages</footer>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('respMobileButton');
        const sidebar = document.getElementById('respSidebar');
        if (button && sidebar) {
            button.addEventListener('click', function () { sidebar.classList.toggle('show'); });
        }
    });
</script>

@stack('scripts')

</body>
</html>

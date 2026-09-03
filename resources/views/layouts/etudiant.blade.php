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

    <style>
        :root {
            --et-teal: #0E9C8F;
            --et-teal-dark: #0B7F75;
            --et-teal-pale: #E4F5F2;
            --et-green: #8BC34A;
            --et-red: #E5484D;
            --et-bg: #F4F9F8;
            --et-white: #ffffff;
            --et-text: #143A38;
            --et-muted: #6B8582;
            --et-border: #E1EEEC;
            --sidebar-width: 260px;
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; min-height: 100%; }
        body { font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: var(--et-bg); color: var(--et-text); }
        a { text-decoration: none; }

        .et-layout { min-height: 100vh; display: flex; }

        .et-sidebar {
            width: var(--sidebar-width); min-width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, #ffffff 0%, #EAF6F4 100%);
            border-right: 1px solid var(--et-border);
            display: flex; flex-direction: column; z-index: 1000; overflow: hidden;
        }
        .et-sidebar-brand { height: 84px; display: flex; align-items: center; padding: 16px 20px; border-bottom: 1px solid var(--et-border); }
        .et-sidebar-logo { width: 44px; height: 44px; object-fit: contain; margin-right: 11px; }
        .et-sidebar-brand-title { margin: 0; font-size: 17px; font-weight: 800; color: var(--et-text); }
        .et-sidebar-brand-subtitle { display: block; font-size: 10.5px; color: var(--et-muted); margin-top: 2px; }

        .et-sidebar-profile { margin: 16px 16px 10px; padding: 12px; background: #fff; border: 1px solid var(--et-border); border-radius: 14px; display: flex; align-items: center; gap: 11px; box-shadow: 0 4px 14px rgba(14,156,143,.08); }
        .et-profile-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--et-teal-pale); color: var(--et-teal); display: flex; align-items: center; justify-content: center; font-size: 18px; position: relative; flex-shrink: 0; }
        .et-profile-icon::after { content: ''; position: absolute; bottom: 0; right: 0; width: 9px; height: 9px; border-radius: 50%; background: var(--et-green); border: 2px solid #fff; }
        .et-profile-name { font-size: 13.5px; font-weight: 700; color: var(--et-text); }
        .et-profile-role { display: block; font-size: 11px; color: var(--et-teal); margin-top: 1px; }

        .et-sidebar-menu { flex: 1; padding: 8px 12px; overflow-y: auto; }
        .et-menu-title { padding: 12px 11px 6px; font-size: 10px; font-weight: 800; color: #9BB3B0; text-transform: uppercase; letter-spacing: .8px; }
        .et-menu-link { position: relative; display: flex; align-items: center; gap: 11px; width: 100%; min-height: 42px; padding: 9px 13px; border-radius: 10px; color: #4B6764; font-size: 13.5px; font-weight: 500; margin-bottom: 3px; }
        .et-menu-link i { width: 18px; text-align: center; font-size: 15px; }
        .et-menu-link:hover { background: var(--et-teal-pale); color: var(--et-teal-dark); }
        .et-menu-link.active { background: var(--et-teal-pale); color: var(--et-teal-dark); font-weight: 700; }
        .et-menu-badge { margin-left: auto; width: 8px; height: 8px; border-radius: 50%; background: var(--et-red); }

        .et-sidebar-deco { position: relative; margin-top: auto; height: 130px; overflow: hidden; pointer-events: none; }
        .et-sidebar-deco svg { position: absolute; bottom: 0; left: 0; width: 100%; }

        .et-sidebar-footer { padding: 13px 16px; border-top: 1px solid var(--et-border); position: relative; z-index: 2; }
        .et-logout-link { width: 100%; border: none; background: transparent; display: flex; align-items: center; gap: 10px; padding: 10px 13px; border-radius: 10px; color: var(--et-red); font-size: 13.5px; font-weight: 600; }
        .et-logout-link:hover { background: #FDEDED; }

        .et-main { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); min-height: 100vh; display: flex; flex-direction: column; }

        .et-topbar { min-height: 78px; background: #fff; border-bottom: 1px solid var(--et-border); display: flex; align-items: center; justify-content: space-between; padding: 0 30px; position: sticky; top: 0; z-index: 900; }
        .et-topbar-left { display: flex; align-items: center; gap: 13px; }
        .et-topbar-icon { width: 42px; height: 42px; border-radius: 12px; background: var(--et-teal); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 19px; }
        .et-topbar-title { margin: 0; font-size: 17px; font-weight: 800; color: var(--et-text); }
        .et-topbar-subtitle { display: block; font-size: 11.5px; color: var(--et-muted); margin-top: 2px; }
        .et-mobile-button { display: none; border: none; background: transparent; font-size: 22px; color: var(--et-text); }

        .et-topbar-actions { display: flex; align-items: center; gap: 12px; }
        .btn-et-primary { background: linear-gradient(135deg, var(--et-teal), var(--et-teal-dark)); color: #fff; border: none; border-radius: 999px; padding: 10px 20px; font-size: 13.5px; font-weight: 700; box-shadow: 0 6px 16px rgba(14,156,143,.25); }
        .btn-et-primary:hover { color: #fff; filter: brightness(1.05); }
        .et-notif-btn { position: relative; width: 42px; height: 42px; border-radius: 50%; border: 1px solid var(--et-border); background: #fff; color: var(--et-text); display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .et-notif-dot { position: absolute; top: 9px; right: 10px; width: 8px; height: 8px; border-radius: 50%; background: var(--et-red); border: 2px solid #fff; }

        .et-page { width: 100%; max-width: 1500px; margin: 0 auto; padding: 30px; }

        .card { background: #fff; border: 1px solid var(--et-border); border-radius: 16px; box-shadow: 0 4px 18px rgba(14,80,75,.05); }
        .table { color: var(--et-text); margin-bottom: 0; }
        .table thead th { font-size: 11px; text-transform: uppercase; color: var(--et-muted); font-weight: 750; padding: 14px 16px; background: #F7FBFA; border-bottom: 1px solid var(--et-border); }
        .table tbody td { padding: 14px 16px; border-color: var(--et-border); font-size: 13px; vertical-align: middle; }
        .table-hover tbody tr:hover { background: #F7FBFA; }
        .badge { border-radius: 7px; padding: 6px 9px; font-size: 10px; font-weight: 700; }
        .et-alert { border: none; border-radius: 12px; padding: 13px 16px; font-size: 13px; background: var(--et-teal-pale); color: var(--et-teal-dark); }
        .form-control, .form-select { border-radius: 10px; border: 1px solid var(--et-border); padding: 10px 13px; font-size: 13px; box-shadow: none !important; }
        .form-control:focus, .form-select:focus { border-color: var(--et-teal); box-shadow: 0 0 0 3px rgba(14,156,143,.12) !important; }
        .form-label { font-size: 13px; font-weight: 600; color: var(--et-text); }
        .btn-outline-primary { color: var(--et-teal-dark); border-color: var(--et-teal); border-radius: 999px; }
        .btn-outline-primary:hover { background: var(--et-teal); border-color: var(--et-teal); color: #fff; }

        .et-footer { margin-top: auto; text-align: center; color: var(--et-muted); font-size: 11px; padding: 18px; }

        @media (max-width: 992px) { :root { --sidebar-width: 230px; } .et-page { padding: 22px; } .et-topbar { padding: 0 20px; } }
        @media (max-width: 768px) {
            .et-sidebar { transform: translateX(-100%); transition: transform .25s ease; }
            .et-sidebar.show { transform: translateX(0); }
            .et-main { margin-left: 0; width: 100%; }
            .et-mobile-button { display: block; }
            .et-page { padding: 16px; }
        }

        @stack('styles')
    </style>
</head>
<body>

<div class="et-layout">

    <aside class="et-sidebar" id="etSidebar">
        <div class="et-sidebar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="et-sidebar-logo">
            <div>
                <div class="et-sidebar-brand-title">ABHOER</div>
                <span class="et-sidebar-brand-subtitle">Espace Étudiant</span>
            </div>
        </div>

        <div class="et-sidebar-profile">
            <div class="et-profile-icon"><i class="bi bi-person-fill"></i></div>
            <div>
                <div class="et-profile-name">@auth{{ auth()->user()->prenom ?? auth()->user()->nom ?? 'Étudiant' }}@else Étudiant @endauth</div>
                <span class="et-profile-role">● Étudiant</span>
            </div>
        </div>

        <nav class="et-sidebar-menu">
            <div class="et-menu-title">Menu principal</div>
            <a href="{{ route('etudiant.dashboard') }}" class="et-menu-link {{ request()->routeIs('etudiant.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Tableau de bord</a>
            <a href="{{ route('etudiant.demandes.index') }}" class="et-menu-link {{ request()->routeIs('etudiant.demandes.index') || request()->routeIs('etudiant.demandes.show') ? 'active' : '' }}"><i class="bi bi-file-earmark-text-fill"></i> Mes demandes</a>
            <a href="{{ route('etudiant.demandes.create') }}" class="et-menu-link {{ request()->routeIs('etudiant.demandes.create') || request()->routeIs('etudiant.demandes.informations') ? 'active' : '' }}"><i class="bi bi-plus-circle-fill"></i> Nouvelle demande</a>
            <a href="{{ route('etudiant.documents.index') }}" class="et-menu-link {{ request()->routeIs('etudiant.documents.*') ? 'active' : '' }}"><i class="bi bi-folder-fill"></i> Mes documents</a>
            <a href="{{ route('etudiant.notifications') }}" class="et-menu-link {{ request()->routeIs('etudiant.notifications') ? 'active' : '' }}"><i class="bi bi-bell-fill"></i> Notifications <span class="et-menu-badge"></span></a>

            <div class="et-menu-title">Compte</div>
            <a href="{{ route('etudiant.profil') }}" class="et-menu-link {{ request()->routeIs('etudiant.profil') ? 'active' : '' }}"><i class="bi bi-person-circle"></i> Mon profil</a>
        </nav>

        <div class="et-sidebar-deco">
            <svg viewBox="0 0 260 130" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 90 C 60 60, 200 120, 260 70 L 260 130 L 0 130 Z" fill="#E4F5F2"/>
                <path d="M0 110 C 80 85, 180 130, 260 95 L 260 130 L 0 130 Z" fill="#D3EEE9"/>
            </svg>
        </div>

        <div class="et-sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="et-logout-link"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
            </form>
        </div>
    </aside>

    <div class="et-main">

        <header class="et-topbar">
            <div class="et-topbar-left">
                <button type="button" class="et-mobile-button" id="etMobileButton"><i class="bi bi-list"></i></button>
                <div class="et-topbar-icon"><i class="bi bi-mortarboard-fill"></i></div>
                <div>
                    <h2 class="et-topbar-title">Espace Étudiant</h2>
                    <span class="et-topbar-subtitle">Suivi de vos demandes de stage ABHOER</span>
                </div>
            </div>
            <div class="et-topbar-actions">
                <a href="{{ route('etudiant.demandes.create') }}" class="btn-et-primary"><i class="bi bi-plus-lg me-1"></i> Nouvelle demande</a>
                <a href="{{ route('etudiant.notifications') }}" class="et-notif-btn"><i class="bi bi-bell-fill"></i><span class="et-notif-dot"></span></a>
            </div>
        </header>

        <main class="et-page">
            @if(session('success'))
                <div class="alert et-alert mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert mb-4" style="background:#FDEDED;color:#B42318;border-radius:12px;border:none;"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>

        <footer class="et-footer">ABHOER — Plateforme de gestion des stages</footer>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const b = document.getElementById('etMobileButton'), s = document.getElementById('etSidebar');
        if (b && s) b.addEventListener('click', () => s.classList.toggle('show'));
    });
</script>

@stack('scripts')
</body>
</html>

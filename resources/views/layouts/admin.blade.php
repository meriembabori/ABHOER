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

    <style>
        :root {
            --ad-teal: #0E9C8F; --ad-teal-dark: #0B7F75; --ad-teal-pale: #E4F5F2;
            --ad-green: #8BC34A; --ad-red: #E5484D;
            --ad-bg: #F4F9F8; --ad-text: #143A38; --ad-muted: #6B8582; --ad-border: #E1EEEC;
            --sidebar-width: 260px;
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; min-height: 100%; }
        body { font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: var(--ad-bg); color: var(--ad-text); }
        a { text-decoration: none; }

        .ad-layout { min-height: 100vh; display: flex; }

        .ad-sidebar {
            width: var(--sidebar-width); min-width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, #ffffff 0%, #EAF6F4 100%);
            border-right: 1px solid var(--ad-border);
            display: flex; flex-direction: column; z-index: 1000; overflow: hidden;
        }
        .ad-sidebar-brand { height: 84px; display: flex; align-items: center; padding: 16px 20px; border-bottom: 1px solid var(--ad-border); }
        .ad-sidebar-logo { width: 44px; height: 44px; object-fit: contain; margin-right: 11px; }
        .ad-sidebar-brand-title { margin: 0; font-size: 17px; font-weight: 800; color: var(--ad-text); }
        .ad-sidebar-brand-subtitle { display: block; font-size: 10.5px; color: var(--ad-muted); margin-top: 2px; }

        .ad-sidebar-profile { margin: 16px 16px 10px; padding: 12px; background: #fff; border: 1px solid var(--ad-border); border-radius: 14px; display: flex; align-items: center; gap: 11px; box-shadow: 0 4px 14px rgba(14,156,143,.08); }
        .ad-profile-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--ad-teal-pale); color: var(--ad-teal); display: flex; align-items: center; justify-content: center; font-size: 18px; position: relative; flex-shrink: 0; }
        .ad-profile-icon::after { content: ''; position: absolute; bottom: 0; right: 0; width: 9px; height: 9px; border-radius: 50%; background: var(--ad-green); border: 2px solid #fff; }
        .ad-profile-name { font-size: 13.5px; font-weight: 700; color: var(--ad-text); }
        .ad-profile-role { display: block; font-size: 11px; color: var(--ad-teal); margin-top: 1px; }

        .ad-sidebar-menu { flex: 1; padding: 8px 12px; overflow-y: auto; }
        .ad-menu-title { padding: 12px 11px 6px; font-size: 10px; font-weight: 800; color: #9BB3B0; text-transform: uppercase; letter-spacing: .8px; }
        .ad-menu-link { position: relative; display: flex; align-items: center; gap: 11px; width: 100%; min-height: 42px; padding: 9px 13px; border-radius: 10px; color: #4B6764; font-size: 13.5px; font-weight: 500; margin-bottom: 3px; }
        .ad-menu-link i { width: 18px; text-align: center; font-size: 15px; }
        .ad-menu-link:hover { background: var(--ad-teal-pale); color: var(--ad-teal-dark); }
        .ad-menu-link.active { background: var(--ad-teal-pale); color: var(--ad-teal-dark); font-weight: 700; }

        .ad-sidebar-deco { position: relative; margin-top: auto; height: 130px; overflow: hidden; pointer-events: none; }
        .ad-sidebar-deco svg { position: absolute; bottom: 0; left: 0; width: 100%; }

        .ad-sidebar-footer { padding: 13px 16px; border-top: 1px solid var(--ad-border); position: relative; z-index: 2; }
        .ad-logout-link { width: 100%; border: none; background: transparent; display: flex; align-items: center; gap: 10px; padding: 10px 13px; border-radius: 10px; color: var(--ad-red); font-size: 13.5px; font-weight: 600; }
        .ad-logout-link:hover { background: #FDEDED; }

        .ad-main { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); min-height: 100vh; display: flex; flex-direction: column; }

        .ad-topbar { min-height: 78px; background: #fff; border-bottom: 1px solid var(--ad-border); display: flex; align-items: center; justify-content: space-between; padding: 0 30px; position: sticky; top: 0; z-index: 900; }
        .ad-topbar-left { display: flex; align-items: center; gap: 13px; }
        .ad-topbar-icon { width: 42px; height: 42px; border-radius: 12px; background: var(--ad-teal); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 19px; }
        .ad-topbar-title { margin: 0; font-size: 17px; font-weight: 800; color: var(--ad-text); }
        .ad-topbar-subtitle { display: block; font-size: 11.5px; color: var(--ad-muted); margin-top: 2px; }
        .ad-mobile-button { display: none; border: none; background: transparent; font-size: 22px; color: var(--ad-text); }

        .ad-topbar-actions { display: flex; align-items: center; gap: 12px; }
        .btn-ad-primary { background: linear-gradient(135deg, var(--ad-teal), var(--ad-teal-dark)); color: #fff; border: none; border-radius: 999px; padding: 10px 20px; font-size: 13.5px; font-weight: 700; box-shadow: 0 6px 16px rgba(14,156,143,.25); }
        .btn-ad-primary:hover { color: #fff; filter: brightness(1.05); }
        .ad-notif-btn { position: relative; width: 42px; height: 42px; border-radius: 50%; border: 1px solid var(--ad-border); background: #fff; color: var(--ad-text); display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .ad-notif-dot { position: absolute; top: 9px; right: 10px; width: 8px; height: 8px; border-radius: 50%; background: var(--ad-red); border: 2px solid #fff; }
        .ad-topbar-user { display: flex; align-items: center; gap: 10px; }
        .ad-topbar-user-icon { width: 40px; height: 40px; border-radius: 12px; background: var(--ad-teal-pale); color: var(--ad-teal); display: flex; align-items: center; justify-content: center; font-size: 17px; }
        .ad-topbar-user-name { font-size: 12.5px; font-weight: 700; color: var(--ad-text); }
        .ad-topbar-user-role { display: block; font-size: 10.5px; color: var(--ad-muted); margin-top: 2px; }
        .ad-topbar-chevron { color: var(--ad-muted); font-size: 12px; }

        .ad-page { width: 100%; max-width: 1560px; margin: 0 auto; padding: 30px; }

        .card { background: #fff; border: 1px solid var(--ad-border); border-radius: 16px; box-shadow: 0 4px 18px rgba(14,80,75,.05); }
        .card-header { background: transparent; border-bottom: 1px solid var(--ad-border); }
        .table { color: var(--ad-text); margin-bottom: 0; }
        .table thead th { font-size: 11px; text-transform: uppercase; color: var(--ad-muted); font-weight: 750; padding: 14px 16px; background: #F7FBFA; border-bottom: 1px solid var(--ad-border); }
        .table tbody td { padding: 14px 16px; border-color: var(--ad-border); font-size: 13px; vertical-align: middle; }
        .table-hover tbody tr:hover { background: #F7FBFA; }
        .badge { border-radius: 7px; padding: 6px 9px; font-size: 10px; font-weight: 700; }
        .ad-alert { border: none; border-radius: 12px; padding: 13px 16px; font-size: 13px; background: var(--ad-teal-pale); color: var(--ad-teal-dark); }
        .form-control, .form-select { border-radius: 10px; border: 1px solid var(--ad-border); padding: 10px 13px; font-size: 13px; box-shadow: none !important; }
        .form-control:focus, .form-select:focus { border-color: var(--ad-teal); box-shadow: 0 0 0 3px rgba(14,156,143,.12) !important; }
        .form-label { font-size: 13px; font-weight: 600; color: var(--ad-text); }
        .btn-outline-primary { color: var(--ad-teal-dark); border-color: var(--ad-teal); border-radius: 999px; }
        .btn-outline-primary:hover { background: var(--ad-teal); border-color: var(--ad-teal); color: #fff; }
        .btn-primary { background: linear-gradient(135deg, var(--ad-teal), var(--ad-teal-dark)); border: none; border-radius: 999px; }

        .ad-footer { margin-top: auto; text-align: center; color: var(--ad-muted); font-size: 11px; padding: 18px; }

        @media (max-width: 992px) { :root { --sidebar-width: 230px; } .ad-page { padding: 22px; } .ad-topbar { padding: 0 20px; } }
        @media (max-width: 768px) {
            .ad-sidebar { transform: translateX(-100%); transition: transform .25s ease; }
            .ad-sidebar.show { transform: translateX(0); }
            .ad-main { margin-left: 0; width: 100%; }
            .ad-mobile-button { display: block; }
            .ad-page { padding: 16px; }
        }

        @stack('styles')
    </style>
</head>
<body>

<div class="ad-layout">

    <aside class="ad-sidebar" id="adSidebar">
        <div class="ad-sidebar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="ad-sidebar-logo">
            <div>
                <div class="ad-sidebar-brand-title">ABHOER</div>
                <span class="ad-sidebar-brand-subtitle">Gestion des stages</span>
            </div>
        </div>

        <div class="ad-sidebar-profile">
            <div class="ad-profile-icon"><i class="bi bi-person-fill"></i></div>
            <div>
                <div class="ad-profile-name">ABHOER</div>
                <span class="ad-profile-role">● Administrateur</span>
            </div>
        </div>

        <nav class="ad-sidebar-menu">
            <div class="ad-menu-title">Administration</div>
            <a href="{{ route('admin.dashboard') }}" class="ad-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Tableau de bord</a>
            <a href="{{ route('admin.utilisateurs.index') }}" class="ad-menu-link {{ request()->routeIs('admin.utilisateurs.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Utilisateurs</a>
            <a href="{{ route('admin.departements.index') }}" class="ad-menu-link {{ request()->routeIs('admin.departements.*') ? 'active' : '' }}"><i class="bi bi-diagram-3-fill"></i> Départements</a>
            <a href="{{ route('admin.services.index') }}" class="ad-menu-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"><i class="bi bi-building-fill"></i> Services</a>
            <a href="{{ route('admin.demandes.index') }}" class="ad-menu-link {{ request()->routeIs('admin.demandes.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-text-fill"></i> Demandes de stage</a>

            <div class="ad-menu-title">Suivi</div>
            <a href="{{ route('admin.stages.index') }}" class="ad-menu-link {{ request()->routeIs('admin.stages.*') ? 'active' : '' }}"><i class="bi bi-mortarboard-fill"></i> Stages</a>
        </nav>

        <div class="ad-sidebar-deco">
            <svg viewBox="0 0 260 130" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 90 C 60 60, 200 120, 260 70 L 260 130 L 0 130 Z" fill="#E4F5F2"/>
                <path d="M0 110 C 80 85, 180 130, 260 95 L 260 130 L 0 130 Z" fill="#D3EEE9"/>
            </svg>
        </div>

        <div class="ad-sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="ad-logout-link"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
            </form>
        </div>
    </aside>

    <div class="ad-main">

        <header class="ad-topbar">
            <div class="ad-topbar-left">
                <button type="button" class="ad-mobile-button" id="adMobileButton"><i class="bi bi-list"></i></button>
                <div class="ad-topbar-icon"><i class="bi bi-mortarboard-fill"></i></div>
                <div>
                    <h2 class="ad-topbar-title">Espace Administrateur</h2>
                    <span class="ad-topbar-subtitle">Plateforme de gestion des stages ABHOER</span>
                </div>
            </div>
            <div class="ad-topbar-actions">
                <div class="dropdown">
                    <button type="button" class="ad-notif-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell-fill"></i>
                        @if($topbarNotificationsNonLues > 0)
                            <span class="ad-notif-dot"></span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-2" style="width:320px; border-radius:14px; border:1px solid var(--ad-border); box-shadow:0 10px 30px rgba(14,80,75,.12);">
                        <div class="d-flex justify-content-between align-items-center px-2 py-1">
                            <span class="fw-bold" style="font-size:13px;color:var(--ad-text);">Notifications</span>
                            @if($topbarNotificationsNonLues > 0)
                                <form method="POST" action="{{ route('admin.notifications.lire-toutes') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0" style="font-size:11px; color:var(--ad-teal-dark); text-decoration:none;">Tout marquer lu</button>
                                </form>
                            @endif
                        </div>
                        <div class="dropdown-divider"></div>
                        @forelse($topbarNotifications as $notif)
                            <form method="POST" action="{{ route('admin.notifications.lire', $notif->idNotification) }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item white-space-normal py-2" style="{{ $notif->lu ? '' : 'background:var(--ad-teal-pale);' }} border-radius:10px; white-space:normal;">
                                    <div class="fw-bold" style="font-size:12.5px;color:var(--ad-text);">{{ $notif->titre }}</div>
                                    <div style="font-size:11.5px;color:var(--ad-muted);">{{ \Illuminate\Support\Str::limit($notif->message, 80) }}</div>
                                    <div style="font-size:10px;color:var(--ad-muted);margin-top:2px;">{{ $notif->created_at->diffForHumans() }}</div>
                                </button>
                            </form>
                        @empty
                            <div class="text-center py-3" style="color:var(--ad-muted); font-size:12.5px;">Aucune notification pour le moment.</div>
                        @endforelse
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="ad-topbar-user border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="ad-topbar-user-icon"><i class="bi bi-person-fill"></i></div>
                        <div class="d-none d-lg-block text-start">
                            <span class="ad-topbar-user-name">ABHOER</span>
                            <span class="ad-topbar-user-role">Administrateur</span>
                        </div>
                        <i class="bi bi-chevron-down ad-topbar-chevron d-none d-lg-inline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="border-radius:14px; border:1px solid var(--ad-border); box-shadow:0 10px 30px rgba(14,80,75,.12);">
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="ad-page">
            @if(session('success'))
                <div class="alert ad-alert mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert mb-4" style="background:#FDEDED;color:#B42318;border-radius:12px;border:none;"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>

        <footer class="ad-footer">ABHOER — Plateforme de gestion des stages</footer>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const b = document.getElementById('adMobileButton'), s = document.getElementById('adSidebar');
        if (b && s) b.addEventListener('click', () => s.classList.toggle('show'));
    });
</script>

@stack('scripts')
</body>
</html>

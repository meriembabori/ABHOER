<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Responsable - ABHOER')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --rt-teal: #0E9C8F; --rt-teal-dark: #0B7F75; --rt-teal-pale: #E4F5F2;
            --rt-green: #8BC34A; --rt-red: #E5484D;
            --rt-bg: #F4F9F8; --rt-text: #143A38; --rt-muted: #6B8582; --rt-border: #E1EEEC;
            --sidebar-width: 260px;
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; min-height: 100%; }
        body { font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: var(--rt-bg); color: var(--rt-text); }
        a { text-decoration: none; }

        .rt-layout { min-height: 100vh; display: flex; }

        .rt-sidebar {
            width: var(--sidebar-width); min-width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, #ffffff 0%, #EAF6F4 100%);
            border-right: 1px solid var(--rt-border);
            display: flex; flex-direction: column; z-index: 1000; overflow: hidden;
        }
        .rt-sidebar-brand { height: 84px; display: flex; align-items: center; padding: 16px 20px; border-bottom: 1px solid var(--rt-border); }
        .rt-sidebar-logo { width: 44px; height: 44px; object-fit: contain; margin-right: 11px; }
        .rt-sidebar-brand-title { margin: 0; font-size: 17px; font-weight: 800; color: var(--rt-text); }
        .rt-sidebar-brand-subtitle { display: block; font-size: 10.5px; color: var(--rt-muted); margin-top: 2px; }

        .rt-sidebar-profile { margin: 16px 16px 10px; padding: 12px; background: #fff; border: 1px solid var(--rt-border); border-radius: 14px; display: flex; align-items: center; gap: 11px; box-shadow: 0 4px 14px rgba(14,156,143,.08); }
        .rt-profile-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--rt-teal-pale); color: var(--rt-teal); display: flex; align-items: center; justify-content: center; font-size: 18px; position: relative; flex-shrink: 0; }
        .rt-profile-icon::after { content: ''; position: absolute; bottom: 0; right: 0; width: 9px; height: 9px; border-radius: 50%; background: var(--rt-green); border: 2px solid #fff; }
        .rt-profile-name { font-size: 13.5px; font-weight: 700; color: var(--rt-text); }
        .rt-profile-role { display: block; font-size: 11px; color: var(--rt-teal); margin-top: 1px; }

        .rt-sidebar-menu { flex: 1; padding: 8px 12px; overflow-y: auto; }
        .rt-menu-title { padding: 12px 11px 6px; font-size: 10px; font-weight: 800; color: #9BB3B0; text-transform: uppercase; letter-spacing: .8px; }
        .rt-menu-link { position: relative; display: flex; align-items: center; gap: 11px; width: 100%; min-height: 42px; padding: 9px 13px; border-radius: 10px; color: #4B6764; font-size: 13.5px; font-weight: 500; margin-bottom: 3px; }
        .rt-menu-link i { width: 18px; text-align: center; font-size: 15px; }
        .rt-menu-link:hover { background: var(--rt-teal-pale); color: var(--rt-teal-dark); }
        .rt-menu-link.active { background: var(--rt-teal-pale); color: var(--rt-teal-dark); font-weight: 700; }

        .rt-sidebar-deco { position: relative; margin-top: auto; height: 130px; overflow: hidden; pointer-events: none; }
        .rt-sidebar-deco svg { position: absolute; bottom: 0; left: 0; width: 100%; }

        .rt-sidebar-footer { padding: 13px 16px; border-top: 1px solid var(--rt-border); position: relative; z-index: 2; }
        .rt-logout-link { width: 100%; border: none; background: transparent; display: flex; align-items: center; gap: 10px; padding: 10px 13px; border-radius: 10px; color: var(--rt-red); font-size: 13.5px; font-weight: 600; }
        .rt-logout-link:hover { background: #FDEDED; }

        .rt-main { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); min-height: 100vh; display: flex; flex-direction: column; }

        .rt-topbar { min-height: 78px; background: #fff; border-bottom: 1px solid var(--rt-border); display: flex; align-items: center; justify-content: space-between; padding: 0 30px; position: sticky; top: 0; z-index: 900; }
        .rt-topbar-left { display: flex; align-items: center; gap: 13px; }
        .rt-topbar-icon { width: 42px; height: 42px; border-radius: 12px; background: var(--rt-teal); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 19px; }
        .rt-topbar-title { margin: 0; font-size: 17px; font-weight: 800; color: var(--rt-text); }
        .rt-topbar-subtitle { display: block; font-size: 11.5px; color: var(--rt-muted); margin-top: 2px; }
        .rt-mobile-button { display: none; border: none; background: transparent; font-size: 22px; color: var(--rt-text); }

        .rt-topbar-actions { display: flex; align-items: center; gap: 12px; }
        .btn-rt-primary { background: linear-gradient(135deg, var(--rt-teal), var(--rt-teal-dark)); color: #fff; border: none; border-radius: 999px; padding: 10px 20px; font-size: 13.5px; font-weight: 700; box-shadow: 0 6px 16px rgba(14,156,143,.25); }
        .btn-rt-primary:hover { color: #fff; filter: brightness(1.05); }
        .rt-notif-btn { position: relative; width: 42px; height: 42px; border-radius: 50%; border: 1px solid var(--rt-border); background: #fff; color: var(--rt-text); display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .rt-notif-dot { position: absolute; top: 9px; right: 10px; width: 8px; height: 8px; border-radius: 50%; background: var(--rt-red); border: 2px solid #fff; }
        .rt-topbar-user { display: flex; align-items: center; gap: 10px; }
        .rt-topbar-user-icon { width: 40px; height: 40px; border-radius: 12px; background: var(--rt-teal-pale); color: var(--rt-teal); display: flex; align-items: center; justify-content: center; font-size: 17px; }
        .rt-topbar-user-name { font-size: 12.5px; font-weight: 700; color: var(--rt-text); }
        .rt-topbar-user-role { display: block; font-size: 10.5px; color: var(--rt-muted); margin-top: 2px; }
        .rt-topbar-chevron { color: var(--rt-muted); font-size: 12px; }

        .rt-page { width: 100%; max-width: 1560px; margin: 0 auto; padding: 30px; }

        .card { background: #fff; border: 1px solid var(--rt-border); border-radius: 16px; box-shadow: 0 4px 18px rgba(14,80,75,.05); }
        .card-header { background: transparent; border-bottom: 1px solid var(--rt-border); }
        .table { color: var(--rt-text); margin-bottom: 0; }
        .table thead th { font-size: 11px; text-transform: uppercase; color: var(--rt-muted); font-weight: 750; padding: 14px 16px; background: #F7FBFA; border-bottom: 1px solid var(--rt-border); }
        .table tbody td { padding: 14px 16px; border-color: var(--rt-border); font-size: 13px; vertical-align: middle; }
        .table-hover tbody tr:hover { background: #F7FBFA; }
        .badge { border-radius: 7px; padding: 6px 9px; font-size: 10px; font-weight: 700; }
        .rt-alert { border: none; border-radius: 12px; padding: 13px 16px; font-size: 13px; background: var(--rt-teal-pale); color: var(--rt-teal-dark); }
        .form-control, .form-select { border-radius: 10px; border: 1px solid var(--rt-border); padding: 10px 13px; font-size: 13px; box-shadow: none !important; }
        .form-control:focus, .form-select:focus { border-color: var(--rt-teal); box-shadow: 0 0 0 3px rgba(14,156,143,.12) !important; }
        .form-label { font-size: 13px; font-weight: 600; color: var(--rt-text); }
        .btn-outline-primary { color: var(--rt-teal-dark); border-color: var(--rt-teal); border-radius: 999px; }
        .btn-outline-primary:hover { background: var(--rt-teal); border-color: var(--rt-teal); color: #fff; }
        .btn-primary { background: linear-gradient(135deg, var(--rt-teal), var(--rt-teal-dark)); border: none; border-radius: 999px; }

        .rt-footer { margin-top: auto; text-align: center; color: var(--rt-muted); font-size: 11px; padding: 18px; }

        @media (max-width: 992px) { :root { --sidebar-width: 230px; } .rt-page { padding: 22px; } .rt-topbar { padding: 0 20px; } }
        @media (max-width: 768px) {
            .rt-sidebar { transform: translateX(-100%); transition: transform .25s ease; }
            .rt-sidebar.show { transform: translateX(0); }
            .rt-main { margin-left: 0; width: 100%; }
            .rt-mobile-button { display: block; }
            .rt-page { padding: 16px; }
        }

        @stack('styles')
    </style>
</head>
<body>

<div class="rt-layout">

    <aside class="rt-sidebar" id="rtSidebar">
        <div class="rt-sidebar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="rt-sidebar-logo">
            <div>
                <div class="rt-sidebar-brand-title">ABHOER</div>
                <span class="rt-sidebar-brand-subtitle">Espace Responsable</span>
            </div>
        </div>

        <div class="rt-sidebar-profile">
            <div class="rt-profile-icon"><i class="bi bi-person-fill"></i></div>
            <div>
                <div class="rt-profile-name">ABHOER</div>
                <span class="rt-profile-role">● Responsable</span>
            </div>
        </div>

        <nav class="rt-sidebar-menu">
            <div class="rt-menu-title">Menu principal</div>
            <a href="{{ route('responsable.dashboard') }}" class="rt-menu-link {{ request()->routeIs('responsable.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Tableau de bord</a>
            <a href="{{ route('responsable.demandes.index') }}" class="rt-menu-link {{ request()->routeIs('responsable.demandes.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-text-fill"></i> Demandes de stage</a>
            <a href="{{ route('responsable.stages.index') }}" class="rt-menu-link {{ request()->routeIs('responsable.stages.*') ? 'active' : '' }}"><i class="bi bi-mortarboard-fill"></i> Suivi des stages</a>
            <a href="{{ route('responsable.attestations.index') }}" class="rt-menu-link {{ request()->routeIs('responsable.attestations.*') ? 'active' : '' }}"><i class="bi bi-award-fill"></i> Attestations</a>

            <div class="rt-menu-title">Suivi</div>
            <a href="{{ route('responsable.historique.index') }}" class="rt-menu-link {{ request()->routeIs('responsable.historique.*') ? 'active' : '' }}"><i class="bi bi-clock-history"></i> Historique des actions</a>
        </nav>

        <div class="rt-sidebar-deco">
            <svg viewBox="0 0 260 130" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 90 C 60 60, 200 120, 260 70 L 260 130 L 0 130 Z" fill="#E4F5F2"/>
                <path d="M0 110 C 80 85, 180 130, 260 95 L 260 130 L 0 130 Z" fill="#D3EEE9"/>
            </svg>
        </div>

        <div class="rt-sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="rt-logout-link"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
            </form>
        </div>
    </aside>

    <div class="rt-main">

        <header class="rt-topbar">
            <div class="rt-topbar-left">
                <button type="button" class="rt-mobile-button" id="rtMobileButton"><i class="bi bi-list"></i></button>
                <div class="rt-topbar-icon"><i class="bi bi-bar-chart-fill"></i></div>
                <div>
                    <h2 class="rt-topbar-title">Espace Responsable</h2>
                    <span class="rt-topbar-subtitle">Gestion des demandes de stage ABHOER</span>
                </div>
            </div>
            <div class="rt-topbar-actions">
                <a href="{{ route('responsable.demandes.create') }}" class="btn-rt-primary d-none d-md-inline-flex"><i class="bi bi-plus-lg me-1"></i> Nouvelle demande physique</a>
                <div class="dropdown">
                    <button type="button" class="rt-notif-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell-fill"></i>
                        @if($topbarNotificationsNonLues > 0)
                            <span class="rt-notif-dot"></span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-2" style="width:320px; border-radius:14px; border:1px solid var(--rt-border); box-shadow:0 10px 30px rgba(14,80,75,.12);">
                        <div class="d-flex justify-content-between align-items-center px-2 py-1">
                            <span class="fw-bold" style="font-size:13px;color:var(--rt-text);">Notifications</span>
                            @if($topbarNotificationsNonLues > 0)
                                <form method="POST" action="{{ route('responsable.notifications.lire-toutes') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0" style="font-size:11px; color:var(--rt-teal-dark); text-decoration:none;">Tout marquer lu</button>
                                </form>
                            @endif
                        </div>
                        <div class="dropdown-divider"></div>
                        @forelse($topbarNotifications as $notif)
                            <form method="POST" action="{{ route('responsable.notifications.lire', $notif->idNotification) }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item white-space-normal py-2" style="{{ $notif->lu ? '' : 'background:var(--rt-teal-pale);' }} border-radius:10px; white-space:normal;">
                                    <div class="fw-bold" style="font-size:12.5px;color:var(--rt-text);">{{ $notif->titre }}</div>
                                    <div style="font-size:11.5px;color:var(--rt-muted);">{{ \Illuminate\Support\Str::limit($notif->message, 80) }}</div>
                                    <div style="font-size:10px;color:var(--rt-muted);margin-top:2px;">{{ $notif->created_at->diffForHumans() }}</div>
                                </button>
                            </form>
                        @empty
                            <div class="text-center py-3" style="color:var(--rt-muted); font-size:12.5px;">Aucune notification pour le moment.</div>
                        @endforelse
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="rt-topbar-user border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rt-topbar-user-icon"><i class="bi bi-person-fill"></i></div>
                        <div class="d-none d-lg-block text-start">
                            <span class="rt-topbar-user-name">ABHOER</span>
                            <span class="rt-topbar-user-role">Responsable</span>
                        </div>
                        <i class="bi bi-chevron-down rt-topbar-chevron d-none d-lg-inline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="border-radius:14px; border:1px solid var(--rt-border); box-shadow:0 10px 30px rgba(14,80,75,.12);">
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

        <main class="rt-page">
            @if(session('success'))
                <div class="alert rt-alert mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert mb-4" style="background:#FDEDED;color:#B42318;border-radius:12px;border:none;"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>

        <footer class="rt-footer">ABHOER — Plateforme de gestion des stages</footer>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const b = document.getElementById('rtMobileButton'), s = document.getElementById('rtSidebar');
        if (b && s) b.addEventListener('click', () => s.classList.toggle('show'));
    });
</script>

@stack('scripts')
</body>
</html>

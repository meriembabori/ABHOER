<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ABHOER') - Agence du Bassin Hydraulique de l'Oum Er-Rbia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --c-teal-dark: #0d6e6e;
            --c-teal: #25a6a6;
            --c-teal-pale: #e6f4f4;
            --c-bg: #f6f9fb;
            --c-navy: #0f172a;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #1e293b;
            background: white;
        }

        a { text-decoration: none; color: inherit; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.2s, opacity 0.2s, box-shadow 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            color: white;
            box-shadow: 0 8px 20px rgba(13, 110, 110, 0.25);
        }

        .btn-outline {
            background: white;
            color: var(--c-teal-dark);
            border: 1.5px solid var(--c-teal);
        }

        /* -------- Navbar -------- */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(6px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 48px;
            box-shadow: 0 2px 15px rgba(15,23,42,0.05);
        }

        .navbar-brand { display: flex; align-items: center; gap: 10px; }
        .navbar-brand .logo-badge {
            width: 40px; height: 40px; border-radius: 10px;
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            display: flex; align-items: center; justify-content: center; color: white; font-size: 19px;
        }
        .navbar-brand .brand-text { font-weight: 700; color: var(--c-navy); font-size: 16px; line-height: 1.2; }
        .navbar-brand .brand-sub { font-size: 10.5px; color: #64748b; display: block; margin-top: 1px; }

        .navbar-links { display: flex; align-items: center; gap: 30px; }
        .navbar-links .nav-item {
            font-size: 14px; color: #334155; font-weight: 500; transition: color 0.2s;
        }
        .navbar-links .nav-item:hover, .navbar-links .nav-item.active { color: var(--c-teal-dark); }

        .breadcrumb { font-size: 12.5px; color: #64748b; padding: 22px 48px 0; }
        .breadcrumb a { color: var(--c-teal-dark); font-weight: 600; }

        .reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        section { padding: 70px 48px; max-width: 1280px; margin: 0 auto; }

        .section-label {
            color: var(--c-teal-dark); font-weight: 700; font-size: 12.5px; letter-spacing: 1.5px;
            text-transform: uppercase; margin-bottom: 10px;
        }
        .section-title { font-size: 30px; color: var(--c-navy); margin-bottom: 16px; font-weight: 700; }

        /* -------- Footer -------- */
        footer {
            background: linear-gradient(160deg, var(--c-navy), #16213a);
            color: white;
            padding: 55px 48px 26px;
        }

        .footer-grid {
            max-width: 1280px; margin: 0 auto;
            display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 40px;
            padding-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        footer .logo-badge {
            width: 40px; height: 40px; border-radius: 10px;
            background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
            display: flex; align-items: center; justify-content: center; color: white; font-size: 19px;
            margin-bottom: 14px;
        }

        footer h4 { font-size: 13px; text-transform: uppercase; letter-spacing: 0.6px; color: #94a3b8; margin-bottom: 16px; }
        footer p { font-size: 13px; color: #cbd5e1; line-height: 1.7; margin-bottom: 8px; }
        footer a.footer-link { display: block; font-size: 13px; color: #cbd5e1; margin-bottom: 10px; }
        footer a.footer-link:hover { color: white; }

        .footer-bottom {
            max-width: 1280px; margin: 0 auto; padding-top: 20px;
            text-align: center; font-size: 12.5px; color: #64748b;
        }

        @media (max-width: 900px) {
            .navbar-links { display: none; }
            section { padding: 50px 22px; }
            .breadcrumb { padding: 20px 22px 0; }
            .footer-grid { grid-template-columns: 1fr; }
        }

        @stack('styles')
    
        .navbar-brand .logo-badge-img, footer .logo-badge-img {
            width: 44px; height: 44px; object-fit: contain; border-radius: 10px;
            background: white; padding: 3px; box-shadow: 0 2px 8px rgba(15,23,42,0.08);
        }
        footer .logo-badge-img { margin-bottom: 14px; }
</style>
</head>

<body>

    <div class="navbar">
        <a href="{{ route('accueil') }}" class="navbar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="logo-badge-img">
            <div>
                <div class="brand-text">ABHOER</div>
                <span class="brand-sub">Bassin Hydraulique de l'Oum Er-Rbia</span>
            </div>
        </a>

        <div class="navbar-links">
            <a href="{{ route('accueil') }}#intro" class="nav-item">À propos</a>
            <a href="{{ route('accueil.services') }}" class="nav-item {{ request()->routeIs('accueil.services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('accueil.localisation') }}" class="nav-item {{ request()->routeIs('accueil.localisation') ? 'active' : '' }}">Localisation</a>
            <a href="{{ route('accueil') }}#galerie" class="nav-item">Galerie</a>
            <a href="{{ route('login') }}" class="btn btn-outline">Se connecter</a>
            <a href="{{ route('inscription') }}" class="btn btn-primary">S'inscrire</a>
        </div>
    </div>

    @yield('content')

    <footer>
        <div class="footer-grid">
            <div>
                <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="logo-badge-img">
                <p style="color:white;font-weight:700;font-size:15px;margin-bottom:6px;">ABHOER</p>
                <p>Agence du Bassin Hydraulique de l'Oum Er-Rbia — Béni Mellal, Maroc. Gestion, protection et valorisation durable des ressources en eau du bassin.</p>
            </div>
            <div>
                <h4>Navigation</h4>
                <a href="{{ route('accueil') }}" class="footer-link">Accueil</a>
                <a href="{{ route('accueil.services') }}" class="footer-link">Services</a>
                <a href="{{ route('accueil.localisation') }}" class="footer-link">Localisation</a>
            </div>
            <div>
                <h4>Compte</h4>
                <a href="{{ route('login') }}" class="footer-link">Connexion</a>
                <a href="{{ route('inscription') }}" class="footer-link">Inscription étudiant</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} ABHOER — Plateforme de gestion des demandes de stage
        </div>
    </footer>

    <script>
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(el => observer.observe(el));
    </script>

    @stack('scripts')

</body>

</html>

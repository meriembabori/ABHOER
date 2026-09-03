<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'ABHOER') - Agence du Bassin Hydraulique de l'Oum Er-Rbia
    </title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Theme principal -->
    <link rel="stylesheet" href="{{ asset('css/aqua-theme.css') }}">



    <style>

        /* =========================================================
           GLOBAL
        ========================================================= */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --c-teal-dark: #0d6e6e;
            --c-teal: #25a6a6;
            --c-teal-pale: #e6f4f4;
            --c-bg: #f6f9fb;
            --c-navy: #0f172a;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            color: var(--aqua-white);
            background: var(--aqua-bg-deep-1);
            transition:
                background-color 0.35s ease,
                color 0.35s ease;
        }

        a {
            text-decoration: none;
            color: inherit;
        }



        /* =========================================================
           BOUTONS
        ========================================================= */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 12px 22px;

            border-radius: 10px;

            font-weight: 600;
            font-size: 14px;

            transition:
                transform 0.2s,
                opacity 0.2s,
                box-shadow 0.2s;

            border: none;
            cursor: pointer;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(
                135deg,
                var(--c-teal),
                var(--c-teal-dark)
            );

            color: white;

            box-shadow:
                0 8px 20px rgba(13, 110, 110, 0.25);
        }

        .btn-outline {
            background: white;
            color: var(--c-teal-dark);
            border: 1.5px solid var(--c-teal);
        }



        /* =========================================================
           NAVBAR
        ========================================================= */

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

            box-shadow:
                0 2px 15px rgba(15,23,42,0.05);

            transition:
                background 0.35s ease,
                box-shadow 0.35s ease;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand .logo-badge {
            width: 40px;
            height: 40px;

            border-radius: 10px;

            background: linear-gradient(
                135deg,
                var(--c-teal),
                var(--c-teal-dark)
            );

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
            font-size: 19px;
        }

        .navbar-brand .brand-text {
            font-weight: 700;
            color: var(--c-navy);
            font-size: 16px;
            line-height: 1.2;

            transition: color 0.35s ease;
        }

        .navbar-brand .brand-sub {
            font-size: 10.5px;
            color: #64748b;
            display: block;
            margin-top: 1px;

            transition: color 0.35s ease;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .navbar-links .nav-item {
            font-size: 14px;
            color: #334155;
            font-weight: 500;

            transition: color 0.2s ease;
        }

        .navbar-links .nav-item:hover,
        .navbar-links .nav-item.active {
            color: var(--c-teal-dark);
        }



        /* =========================================================
           BOUTON MODE CLAIR / SOMBRE
        ========================================================= */

        .theme-toggle {
            width: 54px;
            height: 54px;

            border-radius: 50%;

            border: 1px solid #dbe4e8;

            background: #f8fafc;

            color: #0f172a;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;

            font-size: 18px;

            transition:
                background 0.3s ease,
                color 0.3s ease,
                transform 0.25s ease,
                border-color 0.3s ease,
                box-shadow 0.3s ease;
        }

        .theme-toggle:hover {
            transform: rotate(15deg) scale(1.05);

            background: #e6f4f4;

            border-color: var(--c-teal);

            box-shadow:
                0 6px 18px rgba(13,110,110,0.15);
        }

        .theme-toggle i {
            transition:
                transform 0.3s ease;
        }



        /* =========================================================
           MODE SOMBRE
        ========================================================= */

        body.dark-mode {
            background: var(--aqua-bg-deep-1);
            color: var(--aqua-white);
        }

        body.dark-mode .navbar {
            background: rgba(8, 25, 35, 0.96);

            box-shadow:
                0 2px 20px rgba(0,0,0,0.25);
        }

        body.dark-mode .navbar-brand .brand-text {
            color: white;
        }

        body.dark-mode .navbar-brand .brand-sub {
            color: #94a3b8;
        }

        body.dark-mode .navbar-links .nav-item {
            color: #dbeafe;
        }

        body.dark-mode .navbar-links .nav-item:hover,
        body.dark-mode .navbar-links .nav-item.active {
            color: var(--c-teal);
        }

        body.dark-mode .theme-toggle {
            background: rgba(255,255,255,0.06);

            border-color: rgba(255,255,255,0.18);

            color: white;
        }

        body.dark-mode .theme-toggle:hover {
            background: rgba(255,255,255,0.12);
        }



        /* =========================================================
           MODE CLAIR
        ========================================================= */

        body.light-mode {
            background: #f7fbfb;
            color: #0f172a;
        }

        body.light-mode .navbar {
            background: rgba(255,255,255,0.97);

            box-shadow:
                0 2px 15px rgba(15,23,42,0.08);
        }

        body.light-mode .navbar-brand .brand-text {
            color: #0f172a;
        }

        body.light-mode .navbar-brand .brand-sub {
            color: #64748b;
        }

        body.light-mode .navbar-links .nav-item {
            color: #334155;
        }

        body.light-mode .navbar-links .nav-item:hover,
        body.light-mode .navbar-links .nav-item.active {
            color: #0d6e6e;
        }

        body.light-mode .theme-toggle {
            background: #ffffff;

            color: #0f766e;

            border-color: #dbe7e7;
        }

        body.light-mode section {
            background: #f7fbfb;
        }

        body.light-mode .section-title {
            color: #0f172a;
        }

        body.light-mode .section-label {
            color: #0d6e6e;
        }

        body.light-mode .intro-media,
        body.light-mode .stat-box {
            box-shadow:
                0 15px 40px rgba(15,23,42,0.08);
        }

        body.light-mode footer {
            background: linear-gradient(
                160deg,
                #0f172a,
                #16213a
            );

            color: white;
        }



        /* =========================================================
           BREADCRUMB
        ========================================================= */

        .breadcrumb {
            font-size: 12.5px;
            color: #64748b;

            padding: 22px 48px 0;
        }

        .breadcrumb a {
            color: var(--c-teal-dark);
            font-weight: 600;
        }



        /* =========================================================
           ANIMATIONS
        ========================================================= */

        .reveal {
            opacity: 0;

            transform: translateY(24px);

            transition:
                opacity 0.7s ease,
                transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;

            transform: translateY(0);
        }



        /* =========================================================
           SECTIONS
        ========================================================= */

        section {
            padding: 70px clamp(20px, 4vw, 64px);

            max-width: 1580px;

            margin: 0 auto;

            transition:
                background-color 0.35s ease;
        }

        .section-label {
            color: var(--c-teal-dark);

            font-weight: 700;

            font-size: 12.5px;

            letter-spacing: 1.5px;

            text-transform: uppercase;

            margin-bottom: 10px;
        }

        .section-title {
            font-size: 30px;

            color: var(--c-navy);

            margin-bottom: 16px;

            font-weight: 700;

            transition: color 0.35s ease;
        }



        /* =========================================================
           FOOTER
        ========================================================= */

        footer {
            background: linear-gradient(
                160deg,
                var(--c-navy),
                #16213a
            );

            color: white;

            padding: 55px 48px 26px;

            transition:
                background 0.35s ease;
        }

        .footer-grid {
            max-width: 1580px;

            margin: 0 auto;

            display: grid;

            grid-template-columns:
                1.4fr 1fr 1fr;

            gap: 40px;

            padding-bottom: 30px;

            border-bottom:
                1px solid rgba(255,255,255,0.1);
        }

        footer .logo-badge {
            width: 40px;
            height: 40px;

            border-radius: 10px;

            background: linear-gradient(
                135deg,
                var(--c-teal),
                var(--c-teal-dark)
            );

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            font-size: 19px;

            margin-bottom: 14px;
        }

        footer h4 {
            font-size: 13px;

            text-transform: uppercase;

            letter-spacing: 0.6px;

            color: #94a3b8;

            margin-bottom: 16px;
        }

        footer p {
            font-size: 13px;

            color: #cbd5e1;

            line-height: 1.7;

            margin-bottom: 8px;
        }

        footer a.footer-link {
            display: block;

            font-size: 13px;

            color: #cbd5e1;

            margin-bottom: 10px;
        }

        footer a.footer-link:hover {
            color: white;
        }

        .footer-bottom {
            max-width: 1580px;

            margin: 0 auto;

            padding-top: 20px;

            text-align: center;

            font-size: 12.5px;

            color: #64748b;
        }

        footer {
            padding-left: clamp(20px, 4vw, 64px);
            padding-right: clamp(20px, 4vw, 64px);
        }



        /* =========================================================
           LOGO
        ========================================================= */

        .navbar-brand .logo-badge-img,
        footer .logo-badge-img {
            width: 44px;
            height: 44px;

            object-fit: contain;

            border-radius: 10px;

            background: white;

            padding: 3px;

            box-shadow:
                0 2px 8px rgba(15,23,42,0.08);
        }

        footer .logo-badge-img {
            margin-bottom: 14px;
        }



        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            .navbar-links {
                display: none;
            }

            section {
                padding: 50px 22px;
            }

            .breadcrumb {
                padding: 20px 22px 0;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

        }



        /* =========================================================
           STYLES DES PAGES ENFANTS
        ========================================================= */

        @stack('styles')
/* =========================================================
   THEME TOGGLE
========================================================= */

.theme-toggle {
    width: 54px;
    height: 54px;

    border-radius: 50%;

    border: 1px solid #dbe4e8;

    background: #f8fafc;

    color: #0f766e;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    cursor: pointer;

    font-size: 18px;

    padding: 0;

    transition: all 0.3s ease;
}

.theme-toggle:hover {
    transform: rotate(15deg) scale(1.05);

    background: #e6f4f4;

    border-color: #25a6a6;

    box-shadow: 0 6px 18px rgba(13,110,110,0.18);
}


/* =========================================================
   MODE SOMBRE
========================================================= */

body.dark-theme {
    background: #071923 !important;
    color: #ffffff !important;
}

body.dark-theme .navbar {
    background: #081d29 !important;
    box-shadow: 0 3px 20px rgba(0,0,0,0.35);
}

body.dark-theme .navbar-brand .brand-text {
    color: #ffffff !important;
}

body.dark-theme .navbar-brand .brand-sub {
    color: #94a3b8 !important;
}

body.dark-theme .navbar-links .nav-item {
    color: #e2e8f0 !important;
}

body.dark-theme .navbar-links .nav-item:hover,
body.dark-theme .navbar-links .nav-item.active {
    color: #25d9d0 !important;
}

body.dark-theme .theme-toggle {
    background: rgba(255,255,255,0.08);

    border-color: rgba(255,255,255,0.20);

    color: #ffffff;
}

body.dark-theme section {
    background: #071923 !important;
}

body.dark-theme .section-title {
    color: #ffffff !important;
}

body.dark-theme .section-label {
    color: #25d9d0 !important;
}


/* =========================================================
   MODE CLAIR
========================================================= */

body.light-theme {
    background: #f7fbfb !important;
    color: #0f172a !important;
}

body.light-theme .navbar {
    background: #ffffff !important;

    box-shadow:
        0 3px 20px rgba(15,23,42,0.08);
}

body.light-theme .navbar-brand .brand-text {
    color: #0f172a !important;
}

body.light-theme .navbar-brand .brand-sub {
    color: #64748b !important;
}

body.light-theme .navbar-links .nav-item {
    color: #334155 !important;
}

body.light-theme .navbar-links .nav-item:hover,
body.light-theme .navbar-links .nav-item.active {
    color: #0d6e6e !important;
}

body.light-theme .theme-toggle {
    background: #ffffff;

    border-color: #dbe7e7;

    color: #0f766e;
}

body.light-theme section {
    background: #f7fbfb !important;
}

body.light-theme .section-title {
    color: #0f172a !important;
}

body.light-theme .section-label {
    color: #0d6e6e !important;
}
    </style>

</head>


<body>


    <!-- =========================================================
         NAVBAR
    ========================================================= -->

    <div class="navbar">


        <!-- LOGO -->

        <a href="{{ route('accueil') }}"
           class="navbar-brand">

            <img
                src="{{ asset('images/logo-abhoer.png') }}"
                alt="Logo ABHOER"
                class="logo-badge-img"
            >

            <div>

                <div class="brand-text">
                    ABHOER
                </div>

                <span class="brand-sub">
                    Bassin Hydraulique de l'Oum Er-Rbia
                </span>

            </div>

        </a>



        <!-- MENU -->

        <div class="navbar-links">


            <a href="{{ route('accueil') }}#intro"
               class="nav-item">
                À propos
            </a>


            <a href="{{ route('accueil.services') }}"
               class="nav-item {{ request()->routeIs('accueil.services') ? 'active' : '' }}">
                Services
            </a>


            <a href="{{ route('accueil.localisation') }}"
               class="nav-item {{ request()->routeIs('accueil.localisation') ? 'active' : '' }}">
                Localisation
            </a>


            <a href="{{ route('accueil') }}#galerie"
               class="nav-item">
                Galerie
            </a>



            <!-- =================================================
                 BOUTON MODE CLAIR / SOMBRE
            ================================================== -->
<button
    type="button"
    id="themeToggle"
    class="theme-toggle"
    onclick="toggleTheme()"
    aria-label="Changer le thème"
    title="Changer le thème"
>
    <i id="themeIcon" class="bi bi-sun-fill"></i>
</button>



            <!-- CONNEXION -->

            <a href="{{ route('login') }}"
               class="btn btn-outline">

                Se connecter

            </a>



            <!-- INSCRIPTION -->

            <a href="{{ route('inscription') }}"
               class="btn btn-primary">

                S'inscrire

                <i class="bi bi-arrow-right"></i>

            </a>


        </div>

    </div>



    <!-- =========================================================
         CONTENU DES PAGES
    ========================================================= -->

    @yield('content')



    <!-- =========================================================
         FOOTER
    ========================================================= -->

    <footer>

        <div class="footer-grid">


            <!-- COLONNE 1 -->

            <div>

                <img
                    src="{{ asset('images/logo-abhoer.png') }}"
                    alt="Logo ABHOER"
                    class="logo-badge-img"
                >

                <p
                    style="
                        color:white;
                        font-weight:700;
                        font-size:15px;
                        margin-bottom:6px;
                    "
                >
                    ABHOER
                </p>

                <p>
                    Agence du Bassin Hydraulique de l'Oum Er-Rbia —
                    Béni Mellal, Maroc.
                    Gestion, protection et valorisation durable
                    des ressources en eau du bassin.
                </p>

            </div>



            <!-- COLONNE 2 -->

            <div>

                <h4>
                    Navigation
                </h4>

                <a
                    href="{{ route('accueil') }}"
                    class="footer-link"
                >
                    Accueil
                </a>

                <a
                    href="{{ route('accueil.services') }}"
                    class="footer-link"
                >
                    Services
                </a>

                <a
                    href="{{ route('accueil.localisation') }}"
                    class="footer-link"
                >
                    Localisation
                </a>

            </div>



            <!-- COLONNE 3 -->

            <div>

                <h4>
                    Compte
                </h4>

                <a
                    href="{{ route('login') }}"
                    class="footer-link"
                >
                    Connexion
                </a>

                <a
                    href="{{ route('inscription') }}"
                    class="footer-link"
                >
                    Inscription étudiant
                </a>

            </div>


        </div>



        <!-- COPYRIGHT -->

        <div class="footer-bottom">

            &copy; {{ date('Y') }}

            ABHOER —

            Plateforme de gestion des demandes de stage

        </div>

    </footer>



    <!-- =========================================================
         JAVASCRIPT : MODE CLAIR / SOMBRE
    ========================================================= -->

    <script>
            



            /* -----------------------------------------------------
               Récupérer le thème sauvegardé
            ----------------------------------------------------- */

            const savedTheme =
                localStorage.getItem('abhoer-theme');



            /* -----------------------------------------------------
               Si aucun thème n'est enregistré :
               mode sombre par défaut
            ----------------------------------------------------- */

            if (!savedTheme) {

                document.body.classList.add('dark-mode');

                icon.classList.remove('bi-moon-fill');

                icon.classList.add('bi-sun-fill');

            }



            /* -----------------------------------------------------
               Restaurer le mode clair
            ----------------------------------------------------- */

            if (savedTheme === 'light') {

                document.body.classList.remove('dark-mode');

                document.body.classList.add('light-mode');

                icon.classList.remove('bi-sun-fill');

                icon.classList.add('bi-moon-fill');

                themeToggle.setAttribute(
                    'title',
                    'Activer le mode sombre'
                );

                themeToggle.setAttribute(
                    'aria-label',
                    'Activer le mode sombre'
                );

            }



            /* -----------------------------------------------------
               Restaurer le mode sombre
            ----------------------------------------------------- */

            if (savedTheme === 'dark') {

                document.body.classList.remove('light-mode');

                document.body.classList.add('dark-mode');

                icon.classList.remove('bi-moon-fill');

                icon.classList.add('bi-sun-fill');

                themeToggle.setAttribute(
                    'title',
                    'Activer le mode clair'
                );

                themeToggle.setAttribute(
                    'aria-label',
                    'Activer le mode clair'
                );

            }



            /* -----------------------------------------------------
               CLIC SUR LE BOUTON
            ----------------------------------------------------- */

            themeToggle.addEventListener(
                'click',
                function () {


                    const isLight =
                        document.body.classList.contains(
                            'light-mode'
                        );


                    /* ================================
                       PASSAGE AU MODE CLAIR
                    ================================= */

                    if (!isLight) {

                        document.body.classList.remove(
                            'dark-mode'
                        );

                        document.body.classList.add(
                            'light-mode'
                        );


                        icon.classList.remove(
                            'bi-sun-fill'
                        );

                        icon.classList.add(
                            'bi-moon-fill'
                        );


                        themeToggle.setAttribute(
                            'title',
                            'Activer le mode sombre'
                        );

                        themeToggle.setAttribute(
                            'aria-label',
                            'Activer le mode sombre'
                        );


                        localStorage.setItem(
                            'abhoer-theme',
                            'light'
                        );

                    }


                    /* ================================
                       PASSAGE AU MODE SOMBRE
                    ================================= */

                    else {

                        document.body.classList.remove(
                            'light-mode'
                        );

                        document.body.classList.add(
                            'dark-mode'
                        );


                        icon.classList.remove(
                            'bi-moon-fill'
                        );

                        icon.classList.add(
                            'bi-sun-fill'
                        );


                        themeToggle.setAttribute(
                            'title',
                            'Activer le mode clair'
                        );

                        themeToggle.setAttribute(
                            'aria-label',
                            'Activer le mode clair'
                        );


                        localStorage.setItem(
                            'abhoer-theme',
                            'dark'
                        );

                    }

                }
            );



            /* =====================================================
               ANIMATION DES SECTIONS
            ===================================================== */

            const revealEls =
                document.querySelectorAll('.reveal');


            const observer =
                new IntersectionObserver(
                    (entries) => {

                        entries.forEach(entry => {

                            if (entry.isIntersecting) {

                                entry.target.classList.add(
                                    'visible'
                                );

                                observer.unobserve(
                                    entry.target
                                );

                            }

                        });

                    },
                    {
                        threshold: 0.15
                    }
                );


            revealEls.forEach(
                el => observer.observe(el)
            );

        });

    </script>



    <!-- Scripts des pages enfants -->
     <script>

/* =========================================================
   THEME ABHOER
========================================================= */

function toggleTheme() {

    const body = document.body;
    const icon = document.getElementById('themeIcon');

    /* MODE CLAIR → MODE SOMBRE */
    if (body.classList.contains('light-theme')) {

        body.classList.remove('light-theme');
        body.classList.add('dark-theme');

        icon.classList.remove('bi-moon-fill');
        icon.classList.add('bi-sun-fill');

        localStorage.setItem('abhoer-theme', 'dark');

    }

    /* MODE SOMBRE → MODE CLAIR */
    else {

        body.classList.remove('dark-theme');
        body.classList.add('light-theme');

        icon.classList.remove('bi-sun-fill');
        icon.classList.add('bi-moon-fill');

        localStorage.setItem('abhoer-theme', 'light');
    }
}


/* =========================================================
   CHARGER LE THEME SAUVEGARDE
========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const savedTheme =
        localStorage.getItem('abhoer-theme');

    const body =
        document.body;

    const icon =
        document.getElementById('themeIcon');


    /* Si mode clair sauvegardé */

    if (savedTheme === 'light') {

        body.classList.add('light-theme');

        body.classList.remove('dark-theme');

        if (icon) {

            icon.classList.remove('bi-sun-fill');

            icon.classList.add('bi-moon-fill');

        }
    }


    /* Si mode sombre sauvegardé */

    else {

        body.classList.add('dark-theme');

        body.classList.remove('light-theme');

        if (icon) {

            icon.classList.remove('bi-moon-fill');

            icon.classList.add('bi-sun-fill');

        }

    }

});



/* =========================================================
   ANIMATION DES SECTIONS
========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const revealEls =
        document.querySelectorAll('.reveal');

    const observer =
        new IntersectionObserver(
            (entries) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add(
                            'visible'
                        );

                        observer.unobserve(
                            entry.target
                        );

                    }

                });

            },
            {
                threshold: 0.15
            }
        );


    revealEls.forEach(
        el => observer.observe(el)
    );

});

</script>

    @stack('scripts')


</body>

</html>
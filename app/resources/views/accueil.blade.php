<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABHOER - Agence du Bassin Hydraulique de l'Oum Er-Rbia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/2.44.0/iconfont/tabler-icons.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --teal-dark: #1a7a86;
            --teal: #2fa9b0;
            --teal-light: #9bd9d6;
            --teal-pale: #e6f7f6;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #223;
            background: white;
        }

        a { text-decoration: none; color: inherit; }

        /* -------- Navbar -------- */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,0.96);
            backdrop-filter: blur(6px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 40px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
        }

        .navbar-brand { display: flex; align-items: center; gap: 10px; }
        .navbar-brand img { height: 42px; }
        .navbar-brand span { font-weight: bold; color: var(--teal-dark); font-size: 15px; }

        .navbar-links { display: flex; align-items: center; gap: 28px; }
        .navbar-links a {
            font-size: 14px;
            color: #334;
            font-weight: 500;
            transition: color 0.2s;
        }
        .navbar-links a:hover { color: var(--teal-dark); }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            transition: transform 0.2s, opacity 0.2s;
        }
        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            color: white;
        }

        .btn-outline {
            border: 1.5px solid var(--teal-dark);
            color: var(--teal-dark);
        }

        /* -------- Hero -------- */
        .hero {
            position: relative;
            min-height: 92vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            background: url('{{ asset("images/bassin/barrage-1.jpeg") }}') center/cover no-repeat;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(10,50,55,0.55) 0%, rgba(10,60,65,0.75) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            max-width: 780px;
            padding: 0 24px;
            animation: fadeUp 1.1s ease both;
        }

        .hero-content img {
            width: 130px;
            margin-bottom: 22px;
            background: white;
            border-radius: 14px;
            padding: 8px 14px;
        }

        .hero-content h1 {
            font-size: 38px;
            margin-bottom: 12px;
            line-height: 1.25;
        }

        .hero-content p {
            font-size: 16px;
            opacity: 0.92;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .hero-buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Vagues animées bas du hero */
        .hero-waves {
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            z-index: 2;
            line-height: 0;
        }
        .hero-waves svg { width: 100%; height: 90px; display: block; }
        .hero-waves .w1 { animation: waveShift 12s ease-in-out infinite; }
        .hero-waves .w2 { animation: waveShift 16s ease-in-out infinite reverse; }
        @keyframes waveShift {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(-45px); }
        }

        /* -------- Sections -------- */
        section { padding: 90px 40px; max-width: 1180px; margin: 0 auto; }

        .section-label {
            color: var(--teal-dark);
            font-weight: bold;
            font-size: 13px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .section-title { font-size: 28px; color: #14343a; margin-bottom: 18px; }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* -------- Intro -------- */
        .intro-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 50px;
            align-items: center;
        }

        .intro-text p {
            color: #445;
            line-height: 1.8;
            font-size: 15px;
            margin-bottom: 16px;
        }

        .intro-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 28px;
        }

        .stat-card {
            background: var(--teal-pale);
            border-radius: 12px;
            padding: 18px;
            text-align: center;
        }

        .stat-card .num { font-size: 24px; font-weight: bold; color: var(--teal-dark); }
        .stat-card .label { font-size: 12px; color: #567; margin-top: 4px; }

        .intro-image {
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(20,80,90,0.2);
        }

        .intro-image img {
            width: 100%;
            display: block;
            transition: transform 0.5s;
        }

        .intro-image:hover img { transform: scale(1.05); }

        /* -------- Services -------- */
        .services-section { background: var(--teal-pale); }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-top: 40px;
        }

        .service-card {
            background: white;
            border-radius: 16px;
            padding: 28px 24px;
            box-shadow: 0 6px 20px rgba(20,80,90,0.06);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 34px rgba(20,80,90,0.15);
        }

        .service-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--teal-dark), var(--teal));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .service-card h3 { font-size: 16px; color: #14343a; margin-bottom: 8px; line-height: 1.3; }
        .service-card p { font-size: 13px; color: #567; line-height: 1.6; }

        /* -------- Localisation -------- */
        .location-grid {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 40px;
            align-items: stretch;
        }

        .location-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .location-item {
            display: flex;
            gap: 14px;
            margin-bottom: 22px;
        }

        .location-item .ico {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--teal-pale);
            color: var(--teal-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .location-item h4 { font-size: 14px; color: #14343a; margin-bottom: 3px; }
        .location-item p { font-size: 13px; color: #567; line-height: 1.5; }

        .map-wrap {
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(20,80,90,0.15);
            min-height: 360px;
        }

        .map-wrap iframe { width: 100%; height: 100%; min-height: 360px; border: 0; display: block; }

        /* -------- Galerie -------- */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 40px;
        }

        .gallery-item {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            aspect-ratio: 4/3;
            box-shadow: 0 8px 22px rgba(20,80,90,0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .gallery-item:hover img { transform: scale(1.08); }

        .gallery-caption {
            position: absolute;
            inset: auto 0 0 0;
            padding: 14px 16px 12px;
            background: linear-gradient(0deg, rgba(10,50,55,0.85), transparent);
            color: white;
            font-size: 12.5px;
            line-height: 1.4;
        }

        /* -------- Footer -------- */
        footer {
            background: linear-gradient(135deg, #0f4952, var(--teal-dark));
            color: white;
            padding: 50px 40px 24px;
            text-align: center;
        }

        footer img { height: 44px; background: white; border-radius: 8px; padding: 4px 8px; margin-bottom: 14px; }
        footer p { font-size: 13px; opacity: 0.85; margin: 4px 0; }
        footer .footer-links { margin: 18px 0; display: flex; justify-content: center; gap: 22px; flex-wrap: wrap; }
        footer .footer-links a { font-size: 13px; opacity: 0.9; }
        footer .footer-links a:hover { opacity: 1; text-decoration: underline; }

        @media (max-width: 900px) {
            .navbar-links { display: none; }
            .intro-grid, .location-grid { grid-template-columns: 1fr; }
            .services-grid, .gallery-grid { grid-template-columns: repeat(2, 1fr); }
            section { padding: 60px 22px; }
            .hero-content h1 { font-size: 28px; }
        }

        @media (max-width: 560px) {
            .services-grid, .gallery-grid, .intro-stats { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER">
            <span>ABHOER</span>
        </div>

        <div class="navbar-links">
            <a href="#intro">À propos</a>
            <a href="#services">Services</a>
            <a href="#localisation">Localisation</a>
            <a href="#galerie">Galerie</a>
            <a href="{{ route('login') }}" class="btn btn-outline">Se connecter</a>
            <a href="{{ route('inscription') }}" class="btn btn-primary">S'inscrire</a>
        </div>
    </div>

    <div class="hero">
        <div class="hero-content">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER">
            <h1>Agence du Bassin Hydraulique de l'Oum Er-Rbia</h1>
            <p>Gestion, protection et valorisation durable des ressources en eau du bassin — Béni Mellal, Maroc.
                Déposez votre demande de stage en ligne et suivez son traitement en toute simplicité.</p>
            <div class="hero-buttons">
                <a href="{{ route('inscription') }}" class="btn btn-primary">Déposer une demande de stage</a>
                <a href="{{ route('login') }}" class="btn btn-outline" style="background:rgba(255,255,255,0.9);">Espace connexion</a>
            </div>
        </div>

        <div class="hero-waves">
            <svg viewBox="0 0 1440 90" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path class="w1" fill="#e6f7f6" fill-opacity="0.9" d="M0,45 C240,90 480,10 720,45 C960,80 1200,20 1440,55 L1440,90 L0,90 Z"></path>
                <path class="w2" fill="#ffffff" d="M0,65 C300,30 600,85 900,50 C1150,25 1300,60 1440,45 L1440,90 L0,90 Z"></path>
            </svg>
        </div>
    </div>

    <section id="intro">
        <div class="intro-grid">
            <div class="intro-text reveal">
                <p class="section-label">À propos de l'agence</p>
                <h2 class="section-title">Une mission au service de l'eau</h2>
                <p>
                    L'Agence du Bassin Hydraulique de l'Oum Er-Rbia (ABHOER), basée à Béni Mellal, est un établissement
                    public marocain chargé de la gestion intégrée, de l'évaluation et de la protection des ressources
                    en eau du bassin de l'Oum Er-Rbia — l'un des plus grands bassins versants du Royaume.
                </p>
                <p>
                    L'agence veille à la planification des ressources hydrauliques, au suivi de la qualité de l'eau,
                    à la gestion du domaine public hydraulique et à la réalisation des aménagements nécessaires à
                    l'irrigation, à l'alimentation en eau potable et à la protection contre les inondations.
                </p>
                <p>
                    Cette plateforme permet aux étudiants de déposer et suivre leurs demandes de stage auprès des
                    différents services de l'agence, en toute transparence.
                </p>

                <div class="intro-stats">
                    <div class="stat-card">
                        <div class="num">6</div>
                        <div class="label">Divisions &amp; services</div>
                    </div>
                    <div class="stat-card">
                        <div class="num">1963</div>
                        <div class="label">Barrage Bin El Ouidane</div>
                    </div>
                    <div class="stat-card">
                        <div class="num">100%</div>
                        <div class="label">Suivi en ligne</div>
                    </div>
                </div>
            </div>

            <div class="intro-image reveal">
                <img src="{{ asset('images/bassin/barrage-2.jpeg') }}" alt="Barrage de l'Oum Er-Rbia">
            </div>
        </div>
    </section>

    <section id="services" class="services-section">
        <p class="section-label" style="text-align:center;">Organisation</p>
        <h2 class="section-title" style="text-align:center;">Nos services</h2>
        <p style="text-align:center;color:#567;max-width:600px;margin:0 auto;font-size:14px;">
            Découvrez les divisions et services de l'agence auprès desquels vous pouvez effectuer votre stage.
        </p>

        <div class="services-grid">
            @foreach ($services as $service)
                <div class="service-card reveal">
                    <div class="service-icon"><i class="ti {{ $service['icone'] }}"></i></div>
                    <h3>{{ $service['nom'] }}</h3>
                    <p>{{ $service['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section id="localisation">
        <div class="location-grid">
            <div class="location-info reveal">
                <p class="section-label">Nous trouver</p>
                <h2 class="section-title">Localisation</h2>

                <div class="location-item">
                    <div class="ico"><i class="ti ti-map-pin"></i></div>
                    <div>
                        <h4>Adresse</h4>
                        <p>Agence du Bassin Hydraulique de l'Oum Er-Rbia, Béni Mellal, Maroc</p>
                    </div>
                </div>

                <div class="location-item">
                    <div class="ico"><i class="ti ti-compass"></i></div>
                    <div>
                        <h4>Coordonnées GPS</h4>
                        <p>Latitude : {{ $latitude }} — Longitude : {{ $longitude }}</p>
                    </div>
                </div>

                <div class="location-item">
                    <div class="ico"><i class="ti ti-droplet"></i></div>
                    <div>
                        <h4>Zone d'action</h4>
                        <p>Bassin de l'Oum Er-Rbia : provinces de Béni Mellal, Khouribga, Khénifra, El Jadida, Settat...</p>
                    </div>
                </div>

                <a href="https://www.openstreetmap.org/?mlat={{ $latitude }}&mlon={{ $longitude }}#map=13/{{ $latitude }}/{{ $longitude }}"
                   target="_blank" class="btn btn-primary" style="align-self:flex-start;">
                    <i class="ti ti-route"></i> Voir l'itinéraire
                </a>
            </div>

            <div class="map-wrap reveal">
                <iframe
                    src="https://www.openstreetmap.org/export/embed.html?bbox={{ $longitude - 0.08 }}%2C{{ $latitude - 0.06 }}%2C{{ $longitude + 0.08 }}%2C{{ $latitude + 0.06 }}&layer=mapnik&marker={{ $latitude }}%2C{{ $longitude }}"
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <section id="galerie">
        <p class="section-label" style="text-align:center;">En images</p>
        <h2 class="section-title" style="text-align:center;">Le bassin de l'Oum Er-Rbia</h2>

        <div class="gallery-grid">
            @foreach ($galerie as $photo)
                <div class="gallery-item reveal">
                    <img src="{{ asset($photo['src']) }}" alt="{{ $photo['legende'] }}">
                    <div class="gallery-caption">{{ $photo['legende'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <footer>
        <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER">
        <p>Agence du Bassin Hydraulique de l'Oum Er-Rbia</p>
        <p>Béni Mellal, Maroc</p>

        <div class="footer-links">
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('inscription') }}">Inscription</a>
            <a href="#intro">À propos</a>
            <a href="#services">Services</a>
        </div>

        <p style="opacity:0.6;margin-top:16px;">&copy; {{ date('Y') }} ABHOER — Plateforme de gestion des demandes de stage</p>
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

</body>

</html>

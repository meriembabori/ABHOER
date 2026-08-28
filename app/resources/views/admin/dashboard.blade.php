<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Administrateur - ABHOER</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, #1a7a86, #2fa9b0);
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 22px;
        }

        .logout button {
            background: white;
            color: #1a7a86;
            border: none;
            padding: 9px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .container {
            padding: 30px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            margin-bottom: 8px;
        }

        .welcome p {
            color: #666;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            font-size: 15px;
            color: #666;
            margin-bottom: 12px;
        }

        .card .number {
            font-size: 32px;
            font-weight: bold;
            color: #1a7a86;
        }

        .card.pending .number {
            color: #d97706;
        }

        .card.accepted .number {
            color: #16a34a;
        }

        .card.refused .number {
            color: #dc2626;
        }

        .info-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .info-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .info-card h3 {
            margin-bottom: 12px;
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .info-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 15px;
            }
        }
            /* --- Identité visuelle ABHOER (logo + vagues) --- */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-logo {
            height: 42px;
            width: auto;
            background: white;
            border-radius: 8px;
            padding: 3px 6px;
        }

        .navbar-brand h1 {
            font-size: 19px;
            line-height: 1.1;
        }

        .navbar-subtitle {
            display: block;
            font-size: 11px;
            opacity: 0.85;
            letter-spacing: 0.3px;
            margin-top: 2px;
        }

        .wave-divider {
            line-height: 0;
            margin-top: -1px;
        }

        .wave-divider svg {
            width: 100%;
            height: 26px;
            display: block;
        }

    </style>
</head>

<body>

    <div class="navbar">

        <div class="navbar-brand">
            <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER" class="navbar-logo">
            <div>
                <h1>ABHOER</h1>
                <span class="navbar-subtitle">Gestion des stages</span>
            </div>
        </div>

        <div class="logout">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    Se déconnecter
                </button>
            </form>

        </div>

    </div>

    <div class="wave-divider">
        <svg viewBox="0 0 1440 40" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path fill="#9bd9d6" d="M0,20 C240,40 480,0 720,15 C960,30 1200,5 1440,20 L1440,40 L0,40 Z"></path>
        </svg>
    </div>

    <div class="container">

        <div class="welcome">

            <h2>Tableau de bord administrateur</h2>

            <p>
                Bienvenue dans l'espace d'administration de l'ABHOER.
            </p>

        </div>

        <div class="cards">

            <div class="card">
                <h3>Total demandes</h3>
                <div class="number">
                    {{ $totalDemandes }}
                </div>
            </div>

            <div class="card pending">
                <h3>Demandes en attente</h3>
                <div class="number">
                    {{ $demandesEnAttente }}
                </div>
            </div>

            <div class="card accepted">
                <h3>Demandes acceptées</h3>
                <div class="number">
                    {{ $demandesAcceptees }}
                </div>
            </div>

            <div class="card refused">
                <h3>Demandes refusées</h3>
                <div class="number">
                    {{ $demandesRefusees }}
                </div>
            </div>

        </div>

        <div class="info-section">

            <div class="info-card">
                <h3>Utilisateurs</h3>

                <p>
                    Total :
                    <strong>{{ $totalUtilisateurs }}</strong>
                </p>
            </div>

            <div class="info-card">
                <h3>Candidats</h3>

                <p>
                    Total :
                    <strong>{{ $totalCandidats }}</strong>
                </p>
            </div>

            <div class="info-card">
                <h3>Services</h3>

                <p>
                    Total :
                    <strong>{{ $totalServices }}</strong>
                </p>
            </div>

        </div>

    </div>

</body>

</html>
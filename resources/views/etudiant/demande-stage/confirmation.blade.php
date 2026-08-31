<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Confirmation - ABHOER</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .header {
            background: linear-gradient(135deg, #0d6e6e, #25a6a6);
            color: white;
            padding: 18px 35px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout button {
            background: white;
            color: #0d6e6e;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .container {
            width: 90%;
            max-width: 950px;
            margin: 35px auto;
        }

        .steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            gap: 10px;
        }

        .step {
            flex: 1;
            padding: 14px;
            text-align: center;
            background: #e2e8f0;
            border-radius: 6px;
            font-weight: bold;
            color: #64748b;
        }

        .step.active {
            background: #0d6e6e;
            color: white;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.08);

            margin-bottom: 20px;
        }

        h2 {
            color: #0d6e6e;
            margin-top: 0;
        }

        .subtitle {
            color: #64748b;
        }

        .section-title {
            color: #0d6e6e;

            border-bottom:
                2px solid #e2e8f0;

            padding-bottom: 8px;
            margin-top: 30px;
        }

        .grid {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 15px;

            margin-top: 20px;
        }

        .info {
            background: #f8fafc;
            padding: 15px;
            border-radius: 6px;
        }

        .info strong {
            display: block;
            color: #334155;
            margin-bottom: 7px;
        }

        .info span {
            color: #475569;
        }

        .motivation {
            background: #f8fafc;
            padding: 15px;
            border-radius: 6px;

            line-height: 1.6;

            white-space: pre-line;
        }

        .documents {
            margin-top: 20px;
        }

        .document {
            background: #f8fafc;
            padding: 15px;

            border-radius: 6px;

            margin-bottom: 10px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .document-type {
            font-weight: bold;
            color: #0d6e6e;
        }

        .document-name {
            color: #475569;
        }

        .actions {
            margin-top: 30px;

            display: flex;
            justify-content: space-between;

            gap: 15px;
        }

        .button {
            display: inline-block;

            padding: 12px 20px;

            border-radius: 6px;

            text-decoration: none;

            font-weight: bold;

            border: none;

            cursor: pointer;
        }

        .secondary {
            background: #64748b;
            color: white;
        }

        .primary {
            background: #0d6e6e;
            color: white;
        }

        .primary:hover {
            background: #14606a;
        }

        .secondary:hover {
            background: #475569;
        }

        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        @media (max-width: 700px) {

            .grid {
                grid-template-columns: 1fr;
            }

            .steps {
                flex-direction: column;
            }

            .document {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .actions {
                flex-direction: column;
            }

            .header {
                padding: 15px 20px;
            }

        }

    </style>

</head>

<body>

<header class="header">

    <h1>
        ABHOER - Gestion des stages
    </h1>

    <form
        method="POST"
        action="{{ route('logout') }}"
        class="logout"
    >

        @csrf

        <button type="submit">
            Se déconnecter
        </button>

    </form>

</header>


<main class="container">

    <!-- Étapes -->

    <div class="steps">

        <div class="step">
            ✓ Informations
        </div>

        <div class="step">
            ✓ Documents
        </div>

        <div class="step active">
            3. Confirmation
        </div>

    </div>


    <!-- Messages -->

    @if(session('success'))

        <div class="alert success">

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="alert error">

            {{ session('error') }}

        </div>

    @endif


    <!-- Carte principale -->

    <div class="card">

        <h2>
            Confirmation de votre demande
        </h2>

        <p class="subtitle">

            Vérifiez attentivement les informations
            avant de confirmer l'envoi de votre demande.

        </p>


        <!-- Informations personnelles -->

        <h3 class="section-title">
            Informations personnelles
        </h3>

        <div class="grid">

            <div class="info">

                <strong>
                    Nom
                </strong>

                <span>
                    {{ $candidat->nom }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Prénom
                </strong>

                <span>
                    {{ $candidat->prenom }}
                </span>

            </div>


            <div class="info">

                <strong>
                    CIN
                </strong>

                <span>
                    {{ $candidat->cin }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Téléphone
                </strong>

                <span>
                    {{ $candidat->telephone ?? 'Non renseigné' }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Email
                </strong>

                <span>
                    {{ $candidat->email }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Formation
                </strong>

                <span>
                    {{ $candidat->formation ?? 'Non renseignée' }}
                </span>

            </div>

        </div>


        <!-- Informations du stage -->

        <h3 class="section-title">
            Informations du stage
        </h3>

        <div class="grid">

            <div class="info">

                <strong>
                    Numéro de demande
                </strong>

                <span>
                    {{ $demande->numeroDemande }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Service
                </strong>

                <span>
                    {{ $demande->service->nomService }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Type de stage
                </strong>

                <span>
                    {{ $demande->typeDepot }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Date de dépôt
                </strong>

                <span>
                    {{ $demande->dateDepot?->format('d/m/Y') }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Date de début
                </strong>

                <span>
                    {{ $demande->dateDebut?->format('d/m/Y') }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Date de fin
                </strong>

                <span>
                    {{ $demande->dateFin?->format('d/m/Y') }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Statut
                </strong>

                <span>
                    {{ $demande->statut }}
                </span>

            </div>

        </div>


        <!-- Thème -->

        <h3 class="section-title">
            Thème du stage
        </h3>

        <div class="motivation">

            {{ $demande->theme }}

        </div>


        <!-- Motivation -->

        <h3 class="section-title">
            Motivation
        </h3>

        <div class="motivation">

            {{ $demande->motivation }}

        </div>


        <!-- Documents -->

        <h3 class="section-title">
            Documents déposés
        </h3>

        <div class="documents">

            @forelse($demande->documents as $document)

                <div class="document">

                    <div>

                        <div class="document-type">

                            {{ $document->typeDocument }}

                        </div>

                        <div class="document-name">

                            {{ $document->nomFichier }}

                        </div>

                    </div>

                </div>

            @empty

                <p>
                    Aucun document enregistré.
                </p>

            @endforelse

        </div>


        <!-- Actions -->

        <div class="actions">

            <a
                href="{{ route(
                    'etudiant.demande.documents',
                    $demande->idDemande
                ) }}"
                class="button secondary"
            >
                ← Retour aux documents
            </a>


            <form
                method="POST"
                action="{{ route(
                    'etudiant.demande.confirmer',
                    $demande->idDemande
                ) }}"
            >

                @csrf

                <button
                    type="submit"
                    class="button primary"
                >
                    ✓ Confirmer et envoyer la demande
                </button>

            </form>

        </div>

    </div>

</main>

</body>

</html>
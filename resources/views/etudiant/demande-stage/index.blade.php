<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mes demandes - ABHOER</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f9;
            color: #1f2937;
        }

        /* ================= HEADER ================= */

        .header {
            height: 70px;
            background: #25a6a6;
            color: white;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 35px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            background: white;
            color: #25a6a6;

            border: none;
            border-radius: 6px;

            padding: 10px 18px;

            font-weight: bold;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #eaf4f8;
        }

        /* ================= CONTAINER ================= */

        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
        }

        /* ================= TITRE ================= */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0 0 8px;
            font-size: 28px;
            color: #1f2937;
        }

        .page-header p {
            margin: 0;
            color: #64748b;
        }

        /* ================= BOUTON ================= */

        .btn-primary {
            background: #25a6a6;
            color: white;

            text-decoration: none;

            padding: 12px 20px;

            border-radius: 6px;

            font-weight: bold;

            display: inline-block;
        }

        .btn-primary:hover {
            background: #064d6e;
        }

        /* ================= ALERTES ================= */

        .alert {
            padding: 15px 18px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* ================= CARD ================= */

        .card {
            background: white;
            border-radius: 10px;

            padding: 25px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);

            margin-bottom: 25px;
        }

        .card h2 {
            margin-top: 0;
            color: #25a6a6;
        }

        /* ================= INFORMATIONS ================= */

        .student-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);

            gap: 20px;

            margin-top: 20px;
        }

        .info-box {
            background: #f8fafc;

            padding: 15px;

            border-radius: 7px;

            border: 1px solid #e2e8f0;
        }

        .info-label {
            display: block;

            font-size: 13px;

            color: #64748b;

            margin-bottom: 5px;
        }

        .info-value {
            font-weight: bold;

            color: #1e293b;
        }

        /* ================= TABLE ================= */

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;

            margin-top: 15px;
        }

        th {
            background: #f1f5f9;

            color: #334155;

            font-size: 14px;

            text-align: left;

            padding: 14px;

            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 15px 14px;

            border-bottom: 1px solid #e5e7eb;

            vertical-align: middle;
        }

        tr:hover {
            background: #f8fafc;
        }

        /* ================= STATUT ================= */

        .status {
            display: inline-block;

            padding: 6px 12px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;
        }

        .status-attente {
            background: #fef3c7;
            color: #92400e;
        }

        .status-accepte {
            background: #dcfce7;
            color: #166534;
        }

        .status-refuse {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-default {
            background: #e5e7eb;
            color: #374151;
        }

        /* ================= ACTION ================= */

        .action-btn {
            display: inline-block;

            padding: 7px 12px;

            background: #e0f2fe;

            color: #0369a1;

            border-radius: 5px;

            text-decoration: none;

            font-size: 13px;

            font-weight: bold;
        }

        .action-btn:hover {
            background: #bae6fd;
        }

        /* ================= EMPTY ================= */

        .empty {
            text-align: center;

            padding: 50px 20px;

            color: #64748b;
        }

        .empty h3 {
            margin-bottom: 10px;

            color: #334155;
        }

        /* ================= RETOUR ================= */

        .back {
            margin-top: 25px;
        }

        .back a {
            color: #25a6a6;

            text-decoration: none;

            font-weight: bold;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 800px) {

            .page-header {
                flex-direction: column;
                align-items: flex-start;

                gap: 15px;
            }

            .student-info {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 0 15px;
            }

            .container {
                padding: 0 10px;
            }
        }

    </style>
</head>


<body>

<header class="header">

    <div class="logo">
        ABHOER - Gestion des stages
    </div>

    @auth

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="logout-form"
        >

            @csrf

            <button
                type="submit"
                class="logout-btn"
            >
                Se déconnecter
            </button>

        </form>

    @endauth

</header>


<main class="container">


    {{-- ================= MESSAGES ================= --}}

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    {{-- ================= TITRE ================= --}}

    <div class="page-header">

        <div>

            <h1>
                Mes demandes de stage
            </h1>

            <p>
                Consultez et suivez l'état de vos demandes de stage.
            </p>

        </div>


        <a
            href="{{ route('etudiant.demande.create') }}"
            class="btn-primary"
        >
            + Nouvelle demande
        </a>

    </div>


    {{-- ================= INFORMATIONS ÉTUDIANT ================= --}}

    <div class="card">

        <h2>
            Informations de l'étudiant
        </h2>


        <div class="student-info">


            <div class="info-box">

                <span class="info-label">
                    Nom
                </span>

                <span class="info-value">
                    {{ $candidat->nom ?? '-' }}
                </span>

            </div>


            <div class="info-box">

                <span class="info-label">
                    Prénom
                </span>

                <span class="info-value">
                    {{ $candidat->prenom ?? '-' }}
                </span>

            </div>


            <div class="info-box">

                <span class="info-label">
                    CIN
                </span>

                <span class="info-value">
                    {{ $candidat->cin ?? '-' }}
                </span>

            </div>


        </div>

    </div>


    {{-- ================= DEMANDES ================= --}}

    <div class="card">

        <h2>
            Mes demandes
        </h2>


        @if($demandes->isEmpty())

            <div class="empty">

                <h3>
                    Aucune demande de stage
                </h3>

                <p>
                    Vous n'avez pas encore déposé de demande de stage.
                </p>

                <br>

                <a
                    href="{{ route('etudiant.demande.create') }}"
                    class="btn-primary"
                >
                    Créer ma première demande
                </a>

            </div>

        @else


            <div class="table-container">

                <table>

                    <thead>

                        <tr>

                            <th>
                                N° Demande
                            </th>

                            <th>
                                Service
                            </th>

                            <th>
                                Type de stage
                            </th>

                            <th>
                                Date début
                            </th>

                            <th>
                                Date fin
                            </th>

                            <th>
                                Date dépôt
                            </th>

                            <th>
                                Statut
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    @foreach($demandes as $demande)

                        <tr>


                            {{-- NUMÉRO --}}

                            <td>

                                <strong>
                                    {{ $demande->numeroDemande }}
                                </strong>

                            </td>


                            {{-- SERVICE --}}

                            <td>

                                @if($demande->service)

                                    {{ $demande->service->nomService }}

                                @else

                                    <span>
                                        Non défini
                                    </span>

                                @endif

                            </td>


                            {{-- TYPE --}}

                            <td>

                                {{ $demande->typeDepot ?? '-' }}

                            </td>


                            {{-- DATE DÉBUT --}}

                            <td>

                                @if($demande->dateDebut)

                                    {{ \Carbon\Carbon::parse($demande->dateDebut)->format('d/m/Y') }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- DATE FIN --}}

                            <td>

                                @if($demande->dateFin)

                                    {{ \Carbon\Carbon::parse($demande->dateFin)->format('d/m/Y') }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- DATE DÉPÔT --}}

                            <td>

                                @if($demande->dateDepot)

                                    {{ \Carbon\Carbon::parse($demande->dateDepot)->format('d/m/Y') }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- STATUT --}}

                            <td>

                                @php

                                    $statut = strtoupper(
                                        trim($demande->statut ?? '')
                                    );

                                @endphp


                                @switch($statut)

                                    @case('EN_ATTENTE')

                                    @case('EN ATTENTE')

                                        <span class="status status-attente">
                                            En attente
                                        </span>

                                        @break


                                    @case('ACCEPTEE')

                                    @case('ACCEPTE')

                                        <span class="status status-accepte">
                                            Acceptée
                                        </span>

                                        @break


                                    @case('REFUSEE')

                                    @case('REFUSE')

                                        <span class="status status-refuse">
                                            Refusée
                                        </span>

                                        @break


                                    @case('INFORMATION')

                                        <span class="status status-info">
                                            Information demandée
                                        </span>

                                        @break


                                    @default

                                        <span class="status status-default">
                                            {{ $demande->statut ?? 'Non défini' }}
                                        </span>

                                @endswitch

                            </td>


                            {{-- ACTION --}}

                            <td>

                                <a
                                    href="{{ route(
                                        'etudiant.demande.documents',
                                        $demande->idDemande
                                    ) }}"
                                    class="action-btn"
                                >
                                    Documents
                                </a>

                            </td>


                        </tr>

                    @endforeach


                    </tbody>

                </table>

            </div>

        @endif

    </div>


    {{-- ================= RETOUR ================= --}}

    <div class="back">

        <a
            href="{{ route('etudiant.dashboard') }}"
        >
            ← Retour au tableau de bord
        </a>

    </div>


</main>

</body>

</html>
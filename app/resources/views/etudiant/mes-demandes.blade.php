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

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .header {
            background: linear-gradient(135deg, #1a7a86, #2fa9b0);
            color: white;
            padding: 18px 35px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
        }

        .logout button {
            background: white;
            color: #1a7a86;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 35px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
        }

        h2 {
            color: #1a7a86;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #f8fafc;
            color: #334155;
        }

        .status {
            padding: 6px 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .attente {
            background: #fef3c7;
            color: #92400e;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            background: #1a7a86;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #64748b;
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
    >

        @csrf

        <button type="submit">
            Se déconnecter
        </button>

    </form>

</header>


<main class="container">

    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif


    <div class="card">

        <h2>
            Mes demandes de stage
        </h2>


        @if($demandes->count() > 0)

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
                            Date de dépôt
                        </th>

                        <th>
                            Période
                        </th>

                        <th>
                            Statut
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($demandes as $demande)

                        <tr>

                            <td>
                                {{ $demande->numeroDemande }}
                            </td>

                            <td>
                                {{ $demande->service->nomService }}
                            </td>

                            <td>
                                {{ $demande->dateDepot?->format('d/m/Y') }}
                            </td>

                            <td>

                                {{ $demande->dateDebut?->format('d/m/Y') }}

                                -

                                {{ $demande->dateFin?->format('d/m/Y') }}

                            </td>

                            <td>

                                <span class="status attente">

                                    {{ $demande->statut }}

                                </span>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">

                Vous n'avez encore aucune demande de stage.

            </div>

        @endif


        <br>

        <a
            href="{{ route('etudiant.dashboard') }}"
            class="button"
        >
            ← Retour au tableau de bord
        </a>

    </div>

</main>

</body>

</html>
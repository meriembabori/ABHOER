<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Utilisateurs - ABHOER
    </title>


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


        /* =====================================================
           NAVBAR
        ====================================================== */

        .navbar {
            background: linear-gradient(
                135deg,
                #1a7a86,
                #2fa9b0
            );

            color: white;

            padding: 18px 30px;

            display: flex;

            justify-content: space-between;

            align-items: center;
        }


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


        .navbar-links {
            display: flex;

            align-items: center;

            gap: 20px;
        }


        .navbar-links a {
            color: white;

            text-decoration: none;

            font-weight: 600;
        }


        .navbar-links a:hover {
            text-decoration: underline;
        }


        /* =====================================================
           VAGUE
        ====================================================== */

        .wave-divider {
            line-height: 0;

            margin-top: -1px;
        }


        .wave-divider svg {
            width: 100%;

            height: 26px;

            display: block;
        }


        /* =====================================================
           CONTENEUR
        ====================================================== */

        .container {
            padding: 30px;

            max-width: 1500px;

            margin: auto;
        }


        /* =====================================================
           HEADER
        ====================================================== */

        .header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 25px;

            gap: 20px;
        }


        .header h2 {
            color: #1a7a86;

            font-size: 28px;
        }


        /* =====================================================
           BOUTONS
        ====================================================== */

        .btn {
            display: inline-block;

            padding: 10px 16px;

            border-radius: 6px;

            text-decoration: none;

            border: none;

            cursor: pointer;

            font-weight: bold;

            font-size: 14px;
        }


        .btn-primary {
            background: #1a7a86;

            color: white;
        }


        .btn-primary:hover {
            background: #14636d;
        }


        .btn-danger {
            background: #dc2626;

            color: white;
        }


        .btn-danger:hover {
            background: #b91c1c;
        }


        .btn-success {
            background: #16a34a;

            color: white;
        }


        .btn-success:hover {
            background: #15803d;
        }


        /* =====================================================
           MESSAGES
        ====================================================== */

        .message {
            padding: 12px 16px;

            border-radius: 6px;

            margin-bottom: 20px;
        }


        .message-success {
            background: #dcfce7;

            color: #166534;
        }


        .message-error {
            background: #fee2e2;

            color: #991b1b;
        }


        .message ul {
            margin-top: 8px;

            margin-left: 20px;
        }


        /* =====================================================
           TABLEAU
        ====================================================== */

        .table-container {
            background: white;

            border-radius: 10px;

            box-shadow:
                0 3px 12px
                rgba(0, 0, 0, 0.08);

            overflow-x: auto;
        }


        table {
            width: 100%;

            border-collapse: collapse;
        }


        th,
        td {
            padding: 15px;

            text-align: left;

            border-bottom: 1px solid #eee;
        }


        th {
            background: #1a7a86;

            color: white;

            white-space: nowrap;
        }


        tbody tr:hover {
            background: #f8fafc;
        }


        /* =====================================================
           BADGES
        ====================================================== */

        .badge {
            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 13px;

            font-weight: bold;
        }


        .badge-active {
            background: #dcfce7;

            color: #166534;
        }


        .badge-inactive {
            background: #fee2e2;

            color: #991b1b;
        }


        /* =====================================================
           RÔLE
        ====================================================== */

        .role {
            font-weight: 600;
        }


        /* =====================================================
           ACTIONS
        ====================================================== */

        .actions {
            display: flex;

            gap: 8px;

            align-items: center;
        }


        .actions form {
            display: inline;

            margin: 0;
        }


        /* =====================================================
           VIDE
        ====================================================== */

        .empty {
            text-align: center;

            padding: 30px;

            color: #666;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 768px) {

            .navbar {
                padding: 15px;

                flex-direction: column;

                gap: 15px;

                align-items: flex-start;
            }


            .navbar-links {
                width: 100%;

                flex-wrap: wrap;

                gap: 12px;
            }


            .container {
                padding: 20px 15px;
            }


            .header {
                flex-direction: column;

                align-items: flex-start;
            }


            .header h2 {
                font-size: 23px;
            }

        }

    </style>

</head>


<body>


    {{-- =====================================================
         NAVBAR
    ====================================================== --}}

    <div class="navbar">


        <div class="navbar-brand">


            <img
                src="{{ asset('images/logo-abhoer.png') }}"
                alt="Logo ABHOER"
                class="navbar-logo"
            >


            <div>

                <h1>
                    ABHOER
                </h1>


                <span class="navbar-subtitle">
                    Gestion des stages
                </span>

            </div>


        </div>


        <div class="navbar-links">


            <a
                href="{{ route('admin.dashboard') }}"
            >
                Tableau de bord
            </a>


            <a
                href="{{ route('logout') }}"
                onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                "
            >
                Déconnexion
            </a>


            <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display: none;"
            >

                @csrf

            </form>


        </div>


    </div>


    {{-- =====================================================
         VAGUE
    ====================================================== --}}

    <div class="wave-divider">

        <svg
            viewBox="0 0 1440 40"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
        >

            <path
                fill="#9bd9d6"
                d="M0,20 C240,40 480,0 720,15 C960,30 1200,5 1440,20 L1440,40 L0,40 Z"
            >
            </path>

        </svg>

    </div>


    {{-- =====================================================
         CONTENU
    ====================================================== --}}

    <div class="container">


        {{-- =================================================
             TITRE
        ================================================== --}}

        <div class="header">


            <h2>
                Gestion des utilisateurs
            </h2>


            <a
                href="{{ route('admin.utilisateurs.create') }}"
                class="btn btn-primary"
            >
                + Ajouter un utilisateur
            </a>


        </div>


        {{-- =================================================
             MESSAGE SUCCÈS
        ================================================== --}}

        @if(session('success'))

            <div class="message message-success">

                {{ session('success') }}

            </div>

        @endif


        {{-- =================================================
             MESSAGE ERREUR
        ================================================== --}}

        @if(session('error'))

            <div class="message message-error">

                {{ session('error') }}

            </div>

        @endif


        {{-- =================================================
             ERREURS VALIDATION
        ================================================== --}}

        @if($errors->any())

            <div class="message message-error">


                <strong>
                    Une erreur est survenue :
                </strong>


                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>


            </div>

        @endif


        {{-- =================================================
             TABLEAU
        ================================================== --}}

        <div class="table-container">


            @if($utilisateurs->count() > 0)


                <table>


                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Nom
                            </th>

                            <th>
                                Prénom
                            </th>

                            <th>
                                Login
                            </th>

                            <th>
                                Rôle
                            </th>

                            <th>
                                État
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @foreach($utilisateurs as $utilisateur)


                            <tr>


                                {{-- =========================
                                     ID
                                ========================== --}}

                                <td>

                                    {{ $utilisateur->idUtilisateur }}

                                </td>


                                {{-- =========================
                                     NOM
                                ========================== --}}

                                <td>

                                    {{ $utilisateur->nom }}

                                </td>


                                {{-- =========================
                                     PRÉNOM
                                ========================== --}}

                                <td>

                                    {{ $utilisateur->prenom }}

                                </td>


                                {{-- =========================
                                     LOGIN
                                ========================== --}}

                                <td>

                                    {{ $utilisateur->login }}

                                </td>


                                {{-- =========================
                                     RÔLE
                                ========================== --}}

                                <td>

                                    <span class="role">

                                        {{ $utilisateur->role }}

                                    </span>

                                </td>


                                {{-- =========================
                                     ÉTAT
                                ========================== --}}

                                <td>


                                    @if($utilisateur->actif)


                                        <span class="badge badge-active">

                                            Actif

                                        </span>


                                    @else


                                        <span class="badge badge-inactive">

                                            Inactif

                                        </span>


                                    @endif


                                </td>


                                {{-- =========================
                                     ACTION
                                ========================== --}}

                                <td>


                                    <div class="actions">


                                        <form
                                            method="POST"
                                            action="{{ route('admin.utilisateurs.toggle', $utilisateur->idUtilisateur) }}"
                                        >


                                            @csrf


                                            {{-- IMPORTANT :
                                                 La route Laravel utilise
                                                 PATCH et non PUT. --}}

                                            @method('PATCH')


                                            @if($utilisateur->actif)


                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                >

                                                    Désactiver

                                                </button>


                                            @else


                                                <button
                                                    type="submit"
                                                    class="btn btn-success"
                                                >

                                                    Activer

                                                </button>


                                            @endif


                                        </form>


                                        {{-- =========================
                                             SUPPRIMER
                                        ========================== --}}

                                        <form
                                            method="POST"
                                            action="{{ route('admin.utilisateurs.destroy', $utilisateur->idUtilisateur) }}"
                                            onsubmit="return confirm('Supprimer définitivement {{ $utilisateur->prenom }} {{ $utilisateur->nom }} ? Cette action est irréversible.');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                style="background:#7f1d1d;"
                                            >

                                                Supprimer

                                            </button>

                                        </form>


                                    </div>


                                </td>


                            </tr>


                        @endforeach


                    </tbody>


                </table>


            @else


                <div class="empty">

                    Aucun utilisateur trouvé.

                </div>


            @endif


        </div>


    </div>


</body>

</html>

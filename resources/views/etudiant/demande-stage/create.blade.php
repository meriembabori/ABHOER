<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Nouvelle demande - ABHOER</title>

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
            max-width: 900px;

            margin: 35px auto;
        }

        .card {
            background: white;

            padding: 30px;

            border-radius: 10px;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #0d6e6e;

            margin-top: 0;
        }

        .subtitle {
            color: #64748b;

            margin-bottom: 30px;
        }

        .steps {
            display: flex;

            gap: 10px;

            margin-bottom: 30px;
        }

        .step {
            flex: 1;

            text-align: center;

            padding: 12px;

            background: #e2e8f0;

            border-radius: 6px;

            font-weight: bold;

            color: #64748b;
        }

        .step.active {
            background: #0d6e6e;

            color: white;
        }

        .section-title {
            color: #0d6e6e;

            border-bottom:
                2px solid #e2e8f0;

            padding-bottom: 8px;

            margin-top: 25px;
        }

        .form-group {
            margin-top: 20px;
        }

        label {
            display: block;

            font-weight: bold;

            margin-bottom: 8px;

            color: #334155;
        }

        input,
        select,
        textarea {
            width: 100%;

            padding: 12px;

            border:
                1px solid #cbd5e1;

            border-radius: 6px;

            font-size: 15px;

            background: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;

            border-color: #0d6e6e;
        }

        textarea {
            min-height: 130px;

            resize: vertical;
        }

        .required {
            color: #dc2626;
        }

        .error {
            margin-top: 6px;

            color: #dc2626;

            font-size: 14px;
        }

        .alert {
            padding: 12px 15px;

            border-radius: 6px;

            margin-bottom: 20px;
        }

        .alert-error {
            background: #fee2e2;

            color: #991b1b;
        }

        .actions {
            display: flex;

            justify-content: space-between;

            margin-top: 30px;
        }

        .button {
            display: inline-block;

            padding: 11px 20px;

            border-radius: 6px;

            background: #0d6e6e;

            color: white;

            text-decoration: none;

            border: none;

            font-weight: bold;

            cursor: pointer;
        }

        .button:hover {
            background: #14606a;
        }

        .button.secondary {
            background: #64748b;
        }

        .button.secondary:hover {
            background: #475569;
        }

        .info-box {
            background: #f8fafc;

            padding: 15px;

            border-radius: 6px;

            margin-bottom: 25px;
        }

        .info-box strong {
            color: #0d6e6e;
        }

        @media (max-width: 700px) {

            .header {
                padding: 15px 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .container {
                width: 95%;
            }

            .card {
                padding: 20px;
            }

            .steps {
                flex-direction: column;
            }

            .actions {
                flex-direction: column;

                gap: 10px;
            }

            .button {
                text-align: center;
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

    <div class="card">

        <h2>
            Nouvelle demande de stage
        </h2>

        <p class="subtitle">
            Remplissez les informations nécessaires
            pour déposer votre demande.
        </p>


        <!-- Étapes -->

        <div class="steps">

            <div class="step active">
                1. Informations
            </div>

            <div class="step">
                2. Documents
            </div>

            <div class="step">
                3. Confirmation
            </div>

        </div>


        <!-- Erreurs -->

        @if ($errors->any())

            <div class="alert alert-error">

                <strong>
                    Veuillez corriger les erreurs suivantes :
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Informations étudiant -->

        <div class="info-box">

            <strong>
                Étudiant :
            </strong>

            {{ $candidat->nom }}
            {{ $candidat->prenom }}

            <br>

            <strong>
                CIN :
            </strong>

            {{ $candidat->cin }}

            <br>

            <strong>
                Formation :
            </strong>

            {{ $candidat->formation ?? 'Non renseignée' }}

        </div>


        <form
            method="POST"
            action="{{ route('etudiant.demande.store') }}"
        >

            @csrf


            <!-- Informations du stage -->

            <h3 class="section-title">
                Informations du stage
            </h3>


            <!-- Service -->

            <div class="form-group">

                <label for="idService">

                    Service souhaité

                    <span class="required">
                        *
                    </span>

                </label>

                <select
                    name="idService"
                    id="idService"
                    required
                >

                    <option value="">
                        -- Sélectionner un service --
                    </option>

                    @foreach ($services as $service)

                        <option
                            value="{{ $service->idService }}"
                            {{ old('idService') == $service->idService ? 'selected' : '' }}
                        >

                            {{ $service->nomService }}

                        </option>

                    @endforeach

                </select>

                @error('idService')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- Type de stage -->

            <div class="form-group">

                <label for="typeDepot">

                    Type de stage

                    <span class="required">
                        *
                    </span>

                </label>

                <select
                    name="typeDepot"
                    id="typeDepot"
                    required
                >

                    <option value="">
                        -- Sélectionner --
                    </option>

                    <option
                        value="Stage d'observation"
                        {{ old('typeDepot') == "Stage d'observation" ? 'selected' : '' }}
                    >
                        Stage d'observation
                    </option>

                    <option
                        value="Stage technique"
                        {{ old('typeDepot') == 'Stage technique' ? 'selected' : '' }}
                    >
                        Stage technique
                    </option>

                    <option
                        value="Stage de fin d'études"
                        {{ old('typeDepot') == "Stage de fin d'études" ? 'selected' : '' }}
                    >
                        Stage de fin d'études
                    </option>

                </select>

                @error('typeDepot')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- Date de début -->

            <div class="form-group">

                <label for="dateDebut">

                    Date de début

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="date"
                    name="dateDebut"
                    id="dateDebut"
                    value="{{ old('dateDebut') }}"
                    required
                >

                @error('dateDebut')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- Date de fin -->

            <div class="form-group">

                <label for="dateFin">

                    Date de fin

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="date"
                    name="dateFin"
                    id="dateFin"
                    value="{{ old('dateFin') }}"
                    required
                >

                @error('dateFin')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- Thème -->

            <div class="form-group">

                <label for="theme">

                    Thème du stage

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="text"
                    name="theme"
                    id="theme"
                    value="{{ old('theme') }}"
                    placeholder="Exemple : Développement d'une application web"
                    maxlength="255"
                    required
                >

                @error('theme')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- Motivation -->

            <div class="form-group">

                <label for="motivation">

                    Motivation

                    <span class="required">
                        *
                    </span>

                </label>

                <textarea
                    name="motivation"
                    id="motivation"
                    placeholder="Expliquez votre motivation pour effectuer ce stage..."
                    required
                >{{ old('motivation') }}</textarea>

                @error('motivation')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- Boutons -->

            <div class="actions">

                <a
                    href="{{ route('etudiant.dashboard') }}"
                    class="button secondary"
                >
                    ← Annuler
                </a>

                <button
                    type="submit"
                    class="button"
                >
                    Continuer →
                </button>

            </div>

        </form>

    </div>

</main>

</body>

</html>
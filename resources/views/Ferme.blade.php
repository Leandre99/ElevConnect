<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme ElevConnect</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link href="assets/css/theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 2%">
            <div class="container-fluid">
                <a class="navbar-brand mx-auto" href="/" style="color: rgb(115, 168, 36)">ElevConnect</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        @guest
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium active" style="font-weight: bold;"
                                    href="{{ route('welcome') }}">Accueil</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Ferme') }}">Ma ferme</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Veterinaire') }}">Véterinaires</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Contact') }}">Nous Contacter</a>
                            </li>
                            <li class="nav-item d-flex">
                                <a class="nav-link fw-medium" style="font-weight:bold; position: absolute;right: 0;"
                                    href="{{ route('register') }}">
                                    <img src="{{ asset('assets/images/connexion.png') }}" width=30>
                                </a>
                            </li>
                        @endguest

                        @auth
                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle fw-medium" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Gestion
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item fw-medium" href="#">Dashboard Ferme</a></li>
                                        <li><a class="dropdown-item fw-medium" href="#">Dashboard User</a></li>
                                        <li><a class="dropdown-item fw-medium" href="{{ route('admin.taches') }}">Dashboard
                                                Tâche</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium active" style="font-weight: bold;"
                                        href="{{ route('welcome') }}">Accueil</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Ferme') }}">Ma ferme</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Veterinaire') }}">Véterinaires</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Contact') }}">Nous Contacter</a>
                                </li>
                            @endif

                            <li class="nav-item dropdown mx-auto">
                                <a class="nav-link dropdown-toggle fw-medium" href="#" id="navbarScrollingDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item fw-medium" href="{{ route('profile.edit') }}">Profil</a>
                                    </li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li>
                                            <a class="dropdown-item fw-medium" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">Se
                                                déconnecter</a>
                                        </li>
                                    </form>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        @if ($fermes->count() > 0)
                            <div class="d-flex justify-content-between mb-4" style="margin-top:-6%">
                                <!-- Bouton à gauche -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalFormulaire">
                                    + Nouvelle Ferme
                                </button>

                                <!-- Bouton à droite -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#weatherModal">
                                    Voir la météo
                                </button>
                            </div>
                            <div class="modal fade" id="modalFormulaire" tabindex="-1"
                                aria-labelledby="modalFormulaireLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <style>
                                        body {
                                            font-family: sans-serif;
                                            color: black;
                                        }

                                        h2 {
                                            text-align: center;
                                            margin-bottom: 20px;
                                        }

                                        label {
                                            display: block;
                                            margin-bottom: 5px;
                                        }

                                        input[type="text"],
                                        input[type="number"],
                                        select {
                                            width: 100%;
                                            padding: 10px;
                                            border: 1px solid #ccc;
                                            box-sizing: border-box;
                                        }

                                        textarea {
                                            width: 100%;
                                            height: 150px;
                                            padding: 10px;
                                            border: 1px solid #ccc;
                                            box-sizing: border-box;
                                        }

                                        button {
                                            background-color: #4CAF50;
                                            color: white;
                                            padding: 10px 20px;
                                            border: none;
                                            cursor: pointer;
                                            margin-top: 2%
                                        }
                                    </style>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><img class="img-fluid"
                                                    src="{{ asset('assets/images/plus.png') }}"
                                                    style="width:7%; padding-right:2%">Ajouter une nouvelle Ferme</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('ferme') }}" method="POST">
                                                Ce formulaire vous permet de créer une nouvelle ferme et d'ajouter les
                                                informations relatives à l'espèce principale d'animaux que vous élevez.
                                                Vous pourrez ensuite ajouter des animaux d'autres espèces
                                                ultérieurement.
                                                @csrf

                                                <input type="hidden" name="user_id"
                                                    value="{{ auth()->user()->id }}">

                                                <label for="nomferme">Nom Ferme</label>
                                                <input type="text" id="nomferme" name="nomferme" required>
                                                <label for="description">Description</label>
                                                <input type="text" id="description" name="description" required>
                                                <label for="adresse">Adresse</label>
                                                <input type="text" id="adresse" name="adresse" required>
                                                <button type="submit">Enregistrer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal pour la météo -->
                            <div class="modal fade" id="weatherModal" tabindex="-1"
                                aria-labelledby="weatherModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="weatherModalLabel">Météo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe
                                                src="https://www.meteoblue.com/fr/meteo/widget/three/cotonou_b%c3%a9nin_2394819?geoloc=fixed&nocurrent=0&noforecast=0&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&layout=monochrome"
                                                frameborder="0" scrolling="NO" allowtransparency="true"
                                                sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox"
                                                style="width: 100%; height: 400px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="https://www.meteoblue.com/fr/meteo/semaine/cotonou_b%c3%a9nin_2394819?utm_source=three_widget&utm_medium=linkus&utm_content=three&utm_campaign=Weather%2BWidget"
                                                target="_blank" rel="noopener" class="btn btn-primary">Voir plus sur
                                                meteoblue</a>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Liste des fermes -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group">
                                            @foreach ($fermes as $ferme)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                    <div>
                                                        <h5 class="mb-1">{{ $ferme->nomferme }}</h5>
                                                        <p class="mb-1">
                                                            <strong>Description:</strong>
                                                            <span class="description-truncate">{{ $ferme->description }}</span><br>
                                                            <strong>Adresse:</strong> {{ $ferme->adresse }}
                                                        </p>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Actions">
                                                        <a href="{{ route('reports.index', $ferme->id) }}"
                                                            class="btn btn-info btn-sm me-2">
                                                            <i class="material-icons">insert_chart</i> Rapport
                                                        </a>
                                                        <a href="{{ route('tasks.index', $ferme->id) }}"
                                                            class="btn btn-success btn-sm me-2">
                                                            <i class="material-icons">tasks</i> Tâches
                                                        </a>
                                                        <a href="{{route('fermes.edit', $ferme->id)}}" class="btn btn-warning btn-sm me-2">
                                                            <i class="material-icons">edit</i> Modifier
                                                        </a>
                                                        <a href="{{ route('animals.index', $ferme->id) }}" class="btn btn-danger btn-sm">
                                                            <i class="material-icons">list_alt</i>Animaux
                                                        </a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center" style="margin-top:-5%">
                                <h1>
                                    <img class="img-fluid" src="{{ asset('assets/images/field.png') }}"
                                        style="width: 20%; filter: blur(3px); border-radius: 50%;">
                                </h1>
                                <h1 style="font-size: 25px;">Vous n'avez pas encore de ferme !</h1>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalFormulaire">
                                    + Nouvelle Ferme
                                </button>
                            </div>

                            <div class="modal fade" id="modalFormulaire" tabindex="-1"
                                aria-labelledby="modalFormulaireLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <style>
                                        body {
                                            font-family: sans-serif;
                                            color: black;
                                        }

                                        h2 {
                                            text-align: center;
                                            margin-bottom: 20px;
                                        }

                                        label {
                                            display: block;
                                            margin-bottom: 5px;
                                        }

                                        input[type="text"],
                                        input[type="number"],
                                        select {
                                            width: 100%;
                                            padding: 10px;
                                            border: 1px solid #ccc;
                                            box-sizing: border-box;
                                        }

                                        textarea {
                                            width: 100%;
                                            height: 150px;
                                            padding: 10px;
                                            border: 1px solid #ccc;
                                            box-sizing: border-box;
                                        }

                                        button {
                                            background-color: #4CAF50;
                                            color: white;
                                            padding: 10px 20px;
                                            border: none;
                                            cursor: pointer;
                                            margin-top: 2%
                                        }
                                    </style>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><img class="img-fluid"
                                                    src="{{ asset('assets/images/plus.png') }}"
                                                    style="width:8%; padding-right:2%">Ajouter une nouvelle Ferme
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('ferme') }}" method="POST">
                                                Ce formulaire vous permet de créer une nouvelle ferme et d'ajouter les
                                                informations relatives à l'espèce principale d'animaux que vous élevez.
                                                Vous pourrez ensuite ajouter des animaux d'autres espèces
                                                ultérieurement.
                                                @csrf

                                                <input type="hidden" name="user_id"
                                                    value="{{ auth()->user()->id }}">

                                                <label for="nomferme">Nom Ferme</label>
                                                <input type="text" id="nomferme" name="nomferme" required>
                                                <label for="description">Description</label>
                                                <input type="text" id="description" name="description" required>
                                                <label for="adresse">Adresse</label>
                                                <input type="text" id="adresse" name="adresse" required>
                                                <button type="submit">Enregistrer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-success" style="padding-top:5%;">
        <div class="container">
            <div class="row text-md-left">
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <h5><img class="img-fluid" src="{{ asset('assets/images/preview.png') }}" style="width:50%;">
                    </h5>
                    <p style="margin-left:8%; color:white;"><b>Elev<span style="color: black;">Connect</b></p>
                </div><br>

                <div class="col-md-4 col-lg-4 col-sm-4" style="padding-top: 3%">
                    <h5 style="color:black;">Explorez</h5>
                    <p style="color:white;">A propos<br>Conditions générales d'utilisation<br>Avertissement</p>
                </div><br>

                <div class="col-md-4 col-lg-4 col-sm-4">
                    <div class="card bg-success">
                        <div class="card-body p-sm-4">
                            <h5 style="color:black;">ElevConnect</h5>
                            <p class="mb-0 text-white">Adresse: 123 Rue des Éleveurs, Benin</p>
                            <p>
                                <ul class="list-unstyled">
                                    <li>
                                        <i class="agrikon-icon-email"></i>
                                        <a href="mailto:leandreelisha20@gmail.com">ElevConnect@company.com</a>
                                    </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div><br>
        </div>
    </footer>

    <script>
        document.getElementById('especes').addEventListener('change', function() {
            const selectedSpecies = this.value;
            const raceSelect = document.getElementById('race');
            // Réinitialisez la liste des races
            raceSelect.innerHTML = '';

            // Remplissez la liste des races en fonction de l'espèce sélectionnée
            switch (selectedSpecies) {
                case 'volailles':
                    addRaceOption('Pintade');
                    addRaceOption('Poulet de chair');
                    addRaceOption('Poule pondeuse');
                    addRaceOption('Dinde');
                    addRaceOption('Poulet locale (Bicyclette)');
                    // Ajoutez d'autres races de volailles ici
                    break;
                case 'bovins':
                    addRaceOption('Vache');
                    addRaceOption('Taureaux');
                    addRaceOption('Veaux');
                    break;
                case 'caprins':
                    addRaceOption('Chèvre Djallonké');
                    addRaceOption('Chèvre du Sahel')
                    break;
                case 'ovins':
                    addRaceOption('Balibali');
                    addRaceOption('Autres');
                    break;
                case 'porcs':
                    addRaceOption('Porc Local');
                    addRaceOption('Porc Landrace')
                    addRaceOption('Autre');
                    break;
            }

            // Fonction pour ajouter une option de race
            function addRaceOption(raceName) {
                const option = document.createElement('option');
                option.value = raceName;
                option.textContent = raceName;
                raceSelect.appendChild(option);
            }
        });
    </script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="assets/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fonction pour tronquer le texte
            function truncateText(element, maxLength) {
                const text = element.textContent.trim();
                if (text.length > maxLength) {
                    element.textContent = text.slice(0, maxLength) + '...';
                }
            }

            // Sélectionner tous les éléments avec la classe 'description-truncate'
            const descriptionElements = document.querySelectorAll('.description-truncate');

            // Limiter le texte de chaque élément à 100 caractères
            descriptionElements.forEach(element => {
                truncateText(element, 100); // Limiter à 100 caractères
            });
        });
    </script>
</body>

</html>

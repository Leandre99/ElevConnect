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

        <div class="container">
            <h1>Animaux de la ferme: {{ $ferme->nomferme }}</h1>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnimalModal">
                Ajouter un animal
            </button>

            <h3 class="mt-4">Liste des animaux</h3>
            <ul class="list-group">
                @foreach ($animaux as $animal)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $animal->race->nomrace }} - {{ $animal->age }} Semaines ({{ $animal->nombre }} animaux)
                        <form
                            action="{{ route('animals.destroy', ['ferme' => $ferme->id, 'animal' => $animal->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </li>
                @endforeach
            </ul>

            <!-- Modal pour ajouter un animal -->
            <!-- Modal pour ajouter un animal -->
<div class="modal fade" id="addAnimalModal" tabindex="-1" aria-labelledby="addAnimalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAnimalModalLabel">Ajouter un animal à la ferme: {{ $ferme->nomferme }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('animals.store', $ferme->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Sélection de l'espèce -->
                    <div class="mb-3">
                        <label for="espece" class="form-label">Espèce</label>
                        <select class="form-select" id="espece" name="espece_id" required>
                            <option value="" disabled selected>Choisir une espèce</option>
                            @foreach ($especes as $espece)
                                <option value="{{ $espece->id }}">{{ $espece->nomespece }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Sélection de la race -->
                    <div class="mb-3">
                        <label for="race" class="form-label">Race</label>
                        <select class="form-select" id="race" name="race_id" required>
                            <option value="" disabled selected>Choisir une race</option>
                            @foreach ($races as $race)
                                <option value="{{ $race->id }}">{{ $race->nomrace }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Champ pour l'âge -->
                    <div class="mb-3">
                        <label for="age" class="form-label">Âge</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <!-- Champ pour le nombre d'animaux -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="number" class="form-control" id="nombre" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

        </div>
    </main>
    <script>
        document.getElementById('espece').addEventListener('change', function() {
            const selectedSpeciesId = this.value;
            const raceSelect = document.getElementById('race');

            // Réinitialiser la liste des races
            raceSelect.innerHTML = '<option value="" disabled selected>Choisir une race</option>';

            // Remplir la liste des races en fonction de l'espèce sélectionnée
            fetch(`/especes/${selectedSpeciesId}/races`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(race => {
                        const option = document.createElement('option');
                        option.value = race.id;
                        option.textContent = race.nomrace;
                        raceSelect.appendChild(option);
                    });
                });
        });
    </script>
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

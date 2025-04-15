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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#animalsTable').DataTable();
        });
    </script>

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
                                    href="{{ route('login') }}">
                                    <span style="margin-right: 8px;">Connexion</span>
                                    <img src="{{ asset('assets/images/connexion.png') }}" width=30>
                                </a>
                            </li>
                        @endguest

                        @auth
                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link fw-medium" href="{{ route('admin.dashboard') }}">Tableau de bord</a>
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
                                    <a class="nav-link fw-medium" href="{{ route('alerts.index') }}">Alertes</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Contact') }}">Nous Contacter</a>
                                </li>
                            @endif

                            <li class="nav-item dropdown mx-auto">
                                <a class="nav-link dropdown-toggle fw-medium" href="#"
                                    id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item fw-medium"
                                            href="{{ route('profile.edit') }}">Profil</a>
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
            <h1 style="padding-top: 5%">Animaux de la ferme: {{ $ferme->nomferme }}</h1>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnimalModal">
                Ajouter un animal
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal">
                Signaler une maladie
            </button>

            <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reportModalLabel">Signaler une maladie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('alerts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ferme_id" value="{{ $ferme->id }}">

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="description">Description du problème</label>
                                    <textarea id="description" name="description" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="priority">Priorité</label>
                                    <select id="priority" name="priority" class="form-control" required>
                                        <option value="high">Élevée</option>
                                        <option value="medium">Moyenne</option>
                                        <option value="low">Faible</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="race_id">Race</label>
                                    <select id="race_id" name="race_id" class="form-control" required>
                                        <option value="">Sélectionner une race</option>
                                        @foreach($races as $race)
                                            <option value="{{ $race->id }}">{{ $race->nomrace }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="media">Ajouter une photo ou une vidéo (optionnel)</label>
                                    <input type="file" id="media" name="media" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Soumettre</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <h3 class="mt-4"style="padding-bottom: 2%">Liste des animaux</h3>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table id="animalsTable" class="display table table-striped">
                            <thead>
                                <tr>
                                    <th>Espèce</th>
                                    <th>Race</th>
                                    <th>Âge (Semaines)</th>
                                    <th>Nombre d'animaux</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($animaux as $animal)
                                    <tr>
                                        <td>{{ $animal->race->espece->nomespece }}</td>
                                        <td>{{ $animal->race->nomrace }}</td>
                                        <td>{{ $animal->age }}</td>
                                        <td>{{ $animal->nombre }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('animals.edit', $animal->id) }}"
                                                    class="btn btn-warning btn-sm me-2">Modifier</a>
                                                <form
                                                    action="{{ route('animals.destroy', ['ferme' => $ferme->id, 'animal' => $animal->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">Supprimer</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addAnimalModal" tabindex="-1" aria-labelledby="addAnimalModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAnimalModalLabel">Ajouter un animal à la ferme:
                                {{ $ferme->nomferme }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('animals.store', $ferme->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="alert alert-warning" role="alert">
                                    Attention : Dès que vous ajoutez un animal à la ferme, les tâches correspondantes seront automatiquement générées par le système.
                                </div>
                                <div class="mb-3">
                                    <label for="espece" class="form-label">Espèce</label>
                                    <select class="form-select" id="espece" name="espece_id" required>
                                        <option value="" disabled selected>Choisir une espèce</option>
                                        @foreach ($especes as $espece)
                                            <option value="{{ $espece->id }}">{{ $espece->nomespece }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="race" class="form-label">Race</label>
                                    <select class="form-select" id="race" name="race_id" required>
                                        <option value="" disabled selected>Choisir une race</option>
                                        @foreach ($races as $race)
                                            <option value="{{ $race->id }}">{{ $race->nomrace }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="age" class="form-label">Âge Moyen (En semaine)</label>
                                    <input type="number" class="form-control" id="age" name="age"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="number" class="form-control" id="nombre" name="nombre"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <script>
        document.getElementById('especes').addEventListener('change', function() {
            const selectedSpecies = this.value;
            const raceSelect = document.getElementById('race');
            raceSelect.innerHTML = '';
            switch (selectedSpecies) {
                case 'volailles':
                    addRaceOption('Pintade');
                    addRaceOption('Poulet de chair');
                    addRaceOption('Poule pondeuse');
                    addRaceOption('Dinde');
                    addRaceOption('Poulet locale (Bicyclette)');
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
                    break;
                case 'porcs':
                    addRaceOption('Porc Local');
                    addRaceOption('Porc Landrace')
                    break;
            }

            function addRaceOption(raceName) {
                const option = document.createElement('option');
                option.value = raceName;
                option.textContent = raceName;
                raceSelect.appendChild(option);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const especeSelect = document.getElementById('espece');
            const raceSelect = document.getElementById('race');

            especeSelect.addEventListener('change', function() {
                const especeId = this.value;
                raceSelect.innerHTML =
                    '<option value="" disabled selected>Choisir une race</option>';

                if (especeId) {
                    fetch(`/races/${especeId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(race => {
                                const option = document.createElement('option');
                                option.value = race.id;
                                option.textContent = race.nomrace;
                                raceSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching races:', error));
                }
            });
        });
    </script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="assets/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function truncateText(element, maxLength) {
                const text = element.textContent.trim();
                if (text.length > maxLength) {
                    element.textContent = text.slice(0, maxLength) + '...';
                }
            }

            const descriptionElements = document.querySelectorAll('.description-truncate');

            descriptionElements.forEach(element => {
                truncateText(element, 100);
            });
        });
    </script>
</body>

</html>

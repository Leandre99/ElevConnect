@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAnimalModal">
        Ajouter un animal
    </button>

    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#reportModal">
        Signaler une maladie
    </button>

    <a href="{{ route('completedTasks.soinsParFerme', ['farm' => $ferme->id]) }}"
       class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-journal-medical"></i> Historique médical
    </a>
</div>


    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Signaler une maladie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                @foreach ($races as $race)
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

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
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
                        <div class="d-flex gap-2">
                            <a href="{{ route('animals.edit', $animal->id) }}" class="text-warning" title="Modifier">
                                <i class="bi bi-pencil-square fs-1"></i>
                            </a>
                            <form
                                action="{{ route('animals.destroy', ['ferme' => $ferme->id, 'animal' => $animal->id]) }}"
                                method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0 m-0" title="Supprimer">
                                    <i class="bi bi-trash fs-1 "></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addAnimalModal" tabindex="-1" aria-labelledby="addAnimalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnimalModalLabel">Ajouter un animal à la ferme:
                        {{ $ferme->nomferme }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('animals.store', $ferme->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            Attention : Dès que vous ajoutez un animal à la ferme, les tâches correspondantes seront
                            automatiquement générées par le système.
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
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>

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
{{-- <script>
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
</script> --}}
@endsection
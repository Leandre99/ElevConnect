@extends('layouts.admin_layout')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-success">Créer une Nouvelle Tâche</h4>
            <a href="{{ route('admin.taches') }}" class="btn btn-outline-success">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card shadow-sm p-4">
            <form action="{{ route('admin.tasks.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label for="nomtache" class="form-label fw-bold">Description</label>
                        <input type="text" class="form-control" id="nomtache" name="nomtache" required placeholder="Ex: Nourrir les animaux">
                    </div>

                    <!-- Espèce -->
                    <div class="col-md-6 mb-3">
                        <label for="espece" class="form-label fw-bold">Espèce</label>
                        <select class="form-select" id="espece" name="espece_id" required>
                            <option value="" disabled selected>Choisir une espèce</option>
                            @foreach ($especes as $espece)
                                <option value="{{ $espece->id }}">{{ $espece->nomespece }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Race -->
                    <div class="col-md-6 mb-3">
                        <label for="race_id" class="form-label fw-bold">Race</label>
                        <select class="form-select" id="race_id" name="race_id" required>
                            <option value="" disabled selected>Choisir une race</option>
                        </select>
                    </div>

                    <!-- Fréquence -->
                    <div class="col-md-6 mb-3">
                        <label for="frequence" class="form-label fw-bold">Fréquence (en jours)</label>
                        <input type="number" class="form-control" id="frequence" name="frequence" required placeholder="Ex: 7">
                    </div>

                    <!-- Quantité -->
                    <div class="col-md-6 mb-3">
                        <label for="quantite" class="form-label fw-bold">Quantité (en g)</label>
                        <input type="number" class="form-control" id="quantite" name="quantite" required placeholder="Ex: 500">
                    </div>

                    <!-- Type -->
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label fw-bold">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="" disabled selected>Choisir un type</option>
                            <option value="Alimentation">Alimentation</option>
                            <option value="Soins">Soins</option>
                            <option value="Environnement">Environnement</option>
                        </select>
                    </div>

                    <!-- Âge minimum -->
                    <div class="col-md-6 mb-3">
                        <label for="age_min" class="form-label fw-bold">Âge Minimum</label>
                        <input type="number" class="form-control" id="age_min" name="age_min" required placeholder="Ex: 3">
                    </div>

                    <!-- Âge maximum -->
                    <div class="col-md-6 mb-3">
                        <label for="age_max" class="form-label fw-bold">Âge Maximum</label>
                        <input type="number" class="form-control" id="age_max" name="age_max" required placeholder="Ex: 12">
                    </div>

                    <!-- Jour -->
                    <div class="col-md-6 mb-3">
                        <label for="jour" class="form-label fw-bold">Jour</label>
                        <input type="number" class="form-control" id="jour" name="jour" required placeholder="Ex: 1">
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('espece').addEventListener('change', function() {
            const selectedSpeciesId = this.value;
            const raceSelect = document.getElementById('race_id');

            raceSelect.innerHTML = '<option value="" disabled selected>Chargement...</option>';

            fetch(`/especes/${selectedSpeciesId}/races`)
                .then(response => response.json())
                .then(data => {
                    raceSelect.innerHTML = '<option value="" disabled selected>Choisir une race</option>';
                    data.forEach(race => {
                        const option = document.createElement('option');
                        option.value = race.id;
                        option.textContent = race.nomrace;
                        raceSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    raceSelect.innerHTML = '<option value="" disabled selected>Aucune race disponible</option>';
                });
        });
    </script>
@endsection

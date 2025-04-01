@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Modifier la Tâche</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nomtache" name="nomtache" value="{{ $task->nomtache }}" required>
                            <label for="nomtache">Nom de la Tâche</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="jour" name="jour" value="{{ $task->jour }}" required>
                            <label for="jour">Jour</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="race_id" name="race_id" required>
                                @foreach ($races as $race)
                                <option value="{{ $race->id }}" {{ $task->race_id == $race->id ? 'selected' : '' }}>{{ $race->nomrace }}</option>
                                @endforeach
                            </select>
                            <label for="race_id">Race</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="espece_id" name="espece_id" required>
                                @foreach ($especes as $espece)
                                <option value="{{ $espece->id }}" {{ $task->espece_id == $espece->id ? 'selected' : '' }}>{{ $espece->nomespece }}</option>
                                @endforeach
                            </select>
                            <label for="espece_id">Espèce</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="frequence" name="frequence" required>
                                <option value="quotidien" {{ $task->frequence == 'quotidien' ? 'selected' : '' }}>Quotidien</option>
                                <option value="hebdomadaire" {{ $task->frequence == 'hebdomadaire' ? 'selected' : '' }}>Hebdomadaire</option>
                                <option value="unique" {{ $task->frequence == 'unique' ? 'selected' : '' }}>Unique</option>
                            </select>
                            <label for="frequence">Fréquence</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="quantite" name="quantite" value="{{ $task->quantite }}" required>
                            <label for="quantite">Quantité</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="type" name="type" required>
                                <option value="Alimentation" {{ $task->type == 'Alimentation' ? 'selected' : '' }}>Alimentation</option>
                                <option value="Soins" {{ $task->type == 'Soins' ? 'selected' : '' }}>Soins</option>
                                <option value="Environnement" {{ $task->type == 'Environnement' ? 'selected' : '' }}>Environnement</option>
                            </select>
                            <label for="type">Type</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.taches') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

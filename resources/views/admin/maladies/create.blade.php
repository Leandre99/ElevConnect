@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Ajouter une Maladie</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.maladies.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nom" name="nom" required>
                        <label for="nom">Nom de la maladie</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="symptomes" class="form-label">Symptômes</label>
                    <textarea class="form-control" id="symptomes" name="symptomes" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="race_id" class="form-label">Race associée</label>
                    <select class="form-select" id="race_id" name="race_id" required>
                        <option value="">-- Sélectionner une race --</option>
                        @foreach ($races as $race)
                            <option value="{{ $race->id }}">{{ $race->nomrace }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.maladies.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-success">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

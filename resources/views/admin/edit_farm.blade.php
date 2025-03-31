@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h3 class="text-center text-success fw-bold">Modifier la Ferme</h3>
        <form action="{{ route('admin.farms.update', $farm->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nomferme" class="form-label fw-medium">Nom de la ferme</label>
        <input type="text" class="form-control" id="nomferme" name="nomferme"
            value="{{ old('nomferme', $farm->nomferme) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label fw-medium">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $farm->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="adresse" class="form-label fw-medium">Adresse</label>
        <input type="text" class="form-control" id="adresse" name="adresse"
            value="{{ old('adresse', $farm->adresse) }}" required>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-success px-4">Mettre à jour</button>
        <a href="{{ route('admin.farms') }}" class="btn btn-secondary px-4">Annuler</a>
    </div>
</form>

    </div>
</div>
@endsection

@extends('admin.admin_layout')

@section('content')
<div class="container">
    <h2>Ajouter une Espèce</h2>
    
    <form action="{{ route('admin.especes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nomespece" class="form-label">Nom de l'Espèce</label>
            <input type="text" class="form-control" id="nomespece" name="nomespece" required>
        </div>
        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('admin.especes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

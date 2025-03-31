@extends('admin.admin_layout')

@section('content')
<div class="container">
    <h2>Modifier l'Espèce</h2>
    
    <form action="{{ route('admin.especes.update', $espece->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nomespece" class="form-label">Nom de l'Espèce</label>
            <input type="text" class="form-control" id="nomespece" name="nomespece" value="{{ $espece->nomespece }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="{{ route('admin.especes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

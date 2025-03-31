@extends('admin.admin_layout')

@section('content')
<div class="container">
    <h2>Ajouter une Race</h2>
    
    <form action="{{ route('admin.races.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="espece_id" class="form-label">Espèce</label>
            <select class="form-control" id="espece_id" name="espece_id" required>
                @foreach ($especes as $espece)
                    <option value="{{ $espece->id }}">{{ $espece->nomespece }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nomrace" class="form-label">Nom de la Race</label>
            <input type="text" class="form-control" id="nomrace" name="nomrace" required>
        </div>
        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('admin.races.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Modifier l'Espèce</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.especes.update', $espece->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nomespece" name="nomespece" value="{{ $espece->nomespece }}" required>
                        <label for="nomespece">Nom de l'Espèce</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.especes.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

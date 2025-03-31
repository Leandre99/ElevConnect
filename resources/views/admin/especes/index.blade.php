@extends('admin.admin_layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des Espèces</h2>
    <a href="{{ route('admin.especes.create') }}" class="btn btn-success mb-3">Ajouter une Espèce</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especes as $espece)
            <tr>
                <td>{{ $espece->id }}</td>
                <td>{{ $espece->nomespece }}</td>
                <td>
                    <a href="{{ route('admin.especes.edit', $espece->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                    <form action="{{ route('admin.especes.destroy', $espece->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

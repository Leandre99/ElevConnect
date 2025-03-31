@extends('admin.admin_layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des Races</h2>
    <a href="{{ route('admin.races.create') }}" class="btn btn-success mb-3">Ajouter une Race</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Espèce</th>
                <th>Nom de la Race</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($races as $race)
            <tr>
                <td>{{ $race->id }}</td>
                <td>{{ $race->espece->nomespece }}</td>
                <td>{{ $race->nomrace }}</td>
                <td>
                    <a href="{{ route('admin.races.edit', $race->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                    <form action="{{ route('admin.races.destroy', $race->id) }}" method="POST" class="d-inline">
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

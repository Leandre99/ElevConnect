@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Liste des Espèces</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span><strong>Espèces enregistrées</strong></span>
            <a href="{{ route('admin.especes.create') }}" class="btn btn-light btn-sm text-success fw-bold">
                <i class="fas fa-plus"></i> Ajouter
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($especes as $espece)
                        <tr>
                            <td>{{ $espece->id }}</td>
                            <td>{{ $espece->nomespece }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.especes.edit', $espece->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.especes.destroy', $espece->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($especes->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center text-muted">Aucune espèce enregistrée.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

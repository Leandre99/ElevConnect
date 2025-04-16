@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Liste des Animaux</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span><strong>Animaux enregistrés ({{ $fermes->sum(fn($ferme) => $ferme->animals->count()) }})</strong></span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Race</th>
                            <th>Âge</th>
                            <th>Nombre</th>
                            <th>Ferme</th>
                            <th>Utilisateur</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fermes as $ferme)
                            @foreach ($ferme->animals as $animal)
                            <tr>
                                <td>{{ $animal->id }}</td>
                                <td>{{ $animal->race->nomrace }}</td>
                                <td>{{ $animal->age }}</td>
                                <td>{{ $animal->nombre }}</td>
                                <td>{{ $ferme->nomferme }}</td>
                                <td>{{ $ferme->user->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.animals.edit', $animal) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.animals.destroy', $animal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach

                        @if ($fermes->sum(fn($ferme) => $ferme->animals->count()) == 0)
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucun animal enregistré.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });
    });
</script>
@endsection

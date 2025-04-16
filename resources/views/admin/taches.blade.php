@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Liste des Tâches</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span><strong>Tâches enregistrées ({{ $tasks->count() }})</strong></span>
            <a href="{{ route('admin.create_tache') }}" class="btn btn-light btn-sm text-success fw-bold">
                <i class="fas fa-plus"></i> Ajouter une Tâche
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Espèce</th>
                            <th>Race</th>
                            <th>Fréquence (jours)</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->nomtache }}</td>
                            <td>{{ $task->espece->nomespece ?? 'Non spécifié' }}</td>
                            <td>{{ $task->race->nomrace ?? 'Non spécifiée' }}</td>
                            <td>{{ $task->frequence }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.edit_tache', $task) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($tasks->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucune tâche enregistrée.</td>
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

@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Liste des Fermes</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span><strong>Fermes enregistrées ({{ $farms->count() }})</strong></span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Propriétaire</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Adresse</th>
                            <th>Statut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($farms as $farm)
                        <tr>
                            <td>{{ $farm->id }}</td>
                            <td>{{ $farm->user->name }}</td>
                            <td>{{ $farm->nomferme }}</td>
                            <td>{{ $farm->description }}</td>
                            <td>{{ $farm->adresse }}</td>
                            <td>
                                <span class="badge {{ $farm->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $farm->is_active ? 'Active' : 'Désactivée' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.farms.edit', $farm) }}" class="btn btn-sm btn-primary"
                                   data-bs-toggle="tooltip" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.farms.toggleStatus', $farm) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm {{ $farm->is_active ? 'btn-success' : 'btn-danger' }}"
                                        onclick="return confirm('{{ $farm->is_active ? 'Confirmer la désactivation ?' : 'Confirmer l\'activation ?' }}')">
                                        <i class="fas {{ $farm->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($farms->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucune ferme enregistrée.</td>
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

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection

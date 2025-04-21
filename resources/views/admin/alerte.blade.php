@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Liste des Alertes</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <span><strong>Alertes enregistrées ({{ $alertes->count() }})</strong></span>

            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Priorité</th>
                            <th>Race</th>
                            <th>Créée par</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alertes as $alerte)
                        <tr>
                            <td>{{ $alerte->id }}</td>
                            <td>{{ $alerte->description }}</td>
                            <td>
                                <span class="badge bg-{{
                                    $alerte->priority == 'high' ? 'danger' :
                                    ($alerte->priority == 'medium' ? 'warning' : 'success')
                                }}">
                                    {{ ucfirst($alerte->priority) }}
                                </span>
                            </td>
                            <td>{{ $alerte->race->name ?? '-' }}</td>
                            <td>{{ $alerte->user->name ?? '-' }}</td>
                            <td>{{ $alerte->created_at->format('d/m/Y H:i') }}</td>
                            {{-- <td class="text-center">
                                <a href="{{ route('admin.alerts.show', $alerte) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.alerts.destroy', $alerte) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach

                        @if ($alertes->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucune alerte enregistrée.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Script DataTables + tooltips --}}
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection

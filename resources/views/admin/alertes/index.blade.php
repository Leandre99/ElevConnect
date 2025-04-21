@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-success">Liste des Alertes</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-dark d-flex justify-content-between align-items-center">
            <span><strong>Alertes enregistrées</strong></span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Utilisateur</th>
                            <th>Race</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alertes as $alerte)
                        <tr>
                            <td>{{ $alerte->id }}</td>
                            <td>{{ $alerte->description ?? 'N/A' }}</td>
                            <td>{{ $alerte->user->name ?? 'N/A' }}</td>
                            <td>{{ $alerte->race->nomrace ?? 'N/A' }}</td>
                            <td>{{ $alerte->created_at->format('d/m/Y H:i') ?? 'N/A' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.alertes.show', $alerte->id) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('admin.alertes.destroy', $alerte->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($alertes->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucune alerte enregistrée.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endpush

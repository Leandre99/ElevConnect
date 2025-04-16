@extends('layouts.admin_layout')

@section('content')
<div class="container py-4" style="margin-top: 5%">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold" style="color: rgb(115, 168, 36);">Liste des Fermes ({{ $farms->count() }})</h3>
    </div>

    <div class="table-responsive">
        <table id="farmsTable" class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Propriétaire</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Adresse</th>
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
                    <td class="text-center">
                        <a href="{{ route('admin.farms.edit', $farm) }}" class="btn btn-sm btn-primary" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.farms.toggleStatus', $farm) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-link p-0 m-0 {{ $farm->active ? 'text-danger' : 'text-success' }}" title="{{ $farm->active ? 'Désactiver' : 'Activer' }}">
                                <i class="fas {{ $farm->active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#farmsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });
    });
</script>
@endsection

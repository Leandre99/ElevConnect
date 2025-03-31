@extends('layouts.admin_layout')

@section('content')
<div class="container py-4" style="margin-top: 5%">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold" style="color: rgb(115, 168, 36);">Liste des Animaux ({{ $fermes->sum(fn($ferme) => $ferme->animals->count()) }})</h3>
    </div>

    <div class="table-responsive">
        <table id="animalsTable" class="table table-striped align-middle">
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
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-warning" href="{{ route('admin.animals.edit', $animal) }}">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.animals.destroy', $animal->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash-alt"></i> Supprimer
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#animalsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });
    });
</script>
@endsection

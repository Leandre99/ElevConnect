@extends('layouts.admin_layout')

@section('content')
<div class="container py-4" style="margin-top: 5%">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold" style="color: rgb(115, 168, 36);">Liste des Utilisateurs ({{ $users->count() }})</h3>
    </div>

    <div class="table-responsive">
        <table id="usersTable" class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td>
                        @if ($user->status == 1)
                            <span class="badge bg-success">Actif</span>
                        @else
                            <span class="badge bg-danger">Désactivé</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}"><i class="fas fa-edit"></i> Modifier</a></li>
                                <li>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash"></i> Supprimer</button>
                                    </form>
                                </li>
                                <li>
                                    @if ($user->status == 1)
                                        <a class="dropdown-item text-warning" href="{{ route('admin.users.deactivate', $user) }}">
                                            <i class="fas fa-user-slash"></i> Désactiver
                                        </a>
                                    @else
                                        <a class="dropdown-item text-success" href="{{ route('admin.users.activate', $user) }}">
                                            <i class="fas fa-user-check"></i> Activer
                                        </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });
    });
</script>
@endsection

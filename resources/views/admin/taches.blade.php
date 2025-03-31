@extends('layouts.admin_layout')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-success">Liste des Tâches</h4>
            <a href="{{ route('admin.create_tache') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter une Tâche
            </a>
        </div>

        <div class="list-group">
            @foreach ($tasks as $task)
                <div class="list-group-item d-flex justify-content-between align-items-center shadow-sm p-3 mb-2 bg-white rounded">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $task->nomtache }}</h6>
                        <small class="text-muted">
                            <i class="fas fa-paw"></i> Espèce : {{ $task->espece->nomespece ?? 'Non spécifié' }} |
                            <i class="fas fa-dna"></i> Race : {{ $task->race->nomrace }} |
                            <i class="fas fa-sync-alt"></i> Fréquence : {{ $task->frequence }} jours
                        </small>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item text-primary" href="{{ route('admin.edit_tache', $task) }}">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

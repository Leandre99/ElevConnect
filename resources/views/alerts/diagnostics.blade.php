@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Diagnostics pour Alerte #{{ $alert->id }}</h2>

        <!-- Bouton pour revenir à la page précédente -->
        <a href="{{ route('alerts.index') }}" class="btn btn-primary mb-4">
            <i class="bi bi-arrow-left"></i> Retour aux alertes
        </a>

        @if ($alert->diagnostics->count() > 0)
            <!-- Tableau des diagnostics -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Maladie</th>
                        <th>Symptômes</th>
                        <th>Traitement</th>
                        <th>Soumis le</th>
                        <th>Soumis par</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alert->diagnostics as $diagnostic)
                        <tr>
                            <td>{{ $diagnostic->maladie->nom }}</td>
                            <td>{{ $diagnostic->maladie->symptomes }}</td>
                            <td>{{ $diagnostic->traitement ?? 'Non spécifié' }}</td>
                            <td>{{ $diagnostic->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $diagnostic->veterinaire->name ?? 'Vétérinaire inconnu' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Aucun diagnostic enregistré pour cette alerte.</p>
        @endif
    </div>
@endsection

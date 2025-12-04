@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Historique des alertes et diagnostics</h2>

    <form method="GET" class="mb-3">
        <div class="row g-2">
            <div class="col-md-6">
                <select name="espece_id" class="form-select">
                    <option value="">-- Filtrer par espèce --</option>
                    @foreach($especes as $espece)
                        <option value="{{ $espece->id }}" {{ request('espece_id') == $espece->id ? 'selected' : '' }}>
                            {{ $espece->nomespece }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <select name="race_id" class="form-select">
                    <option value="">-- Filtrer par race --</option>
                    @foreach($races as $race)
                        <option value="{{ $race->id }}" {{ request('race_id') == $race->id ? 'selected' : '' }}>
                            {{ $race->nomrace }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-primary mt-2">Filtrer</button>
    </form>

    @if($alerts->isEmpty())
        <div class="alert alert-info">Aucune alerte trouvée.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Espèce</th>
                        <th>Race</th>
                        <th>Diagnostics</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alerts as $alert)
                        <tr>
                            <td>{{ $alert->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $alert->description }}</td>
                            <td>{{ $alert->race->espece->nomespece ?? '-' }}</td>
                            <td>{{ $alert->race->nomrace ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#diagnosticModal{{ $alert->id }}">
                                    Voir diagnostics
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $alerts->links() }}
        </div>
    @endif
</div>

<!-- Modals Diagnostics -->
@foreach($alerts as $alert)
<div class="modal fade" id="diagnosticModal{{ $alert->id }}" tabindex="-1" aria-labelledby="diagnosticModalLabel{{ $alert->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Diagnostics pour l'alerte: "{{ $alert->description }}"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                @if($alert->diagnostics->isNotEmpty())
                    <ul class="list-group">
                        @foreach($alert->diagnostics as $diag)
                            <li class="list-group-item">
                                <p><strong>Maladie:</strong> {{ $diag->maladie->nom ?? $diag->nom_autre_maladie }}</p>
                                <p><strong>Symptômes:</strong> {{ $diag->symptomes ?? $diag->symptomes_autre }}</p>
                                <p><strong>Traitement recommandé:</strong> {{ $diag->traitement ?? '-' }}</p>
                                <p><strong>Vétérinaire:</strong> {{ $diag->veterinaire->name ?? '-' }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucun diagnostic émis pour cette alerte.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

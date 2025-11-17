@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Historique médical de la ferme : {{ $farm->nomferme ?? 'Nom de la ferme' }}</h2>

    @if($completedSoins->isEmpty())
    <div class="alert alert-info text-center">
        <i class="bi bi-info-circle"></i> Aucune tâche de soin effectuée pour cette ferme.
    </div>
    @else
    @php
        $races = $farm->animals->pluck('race', 'race_id')->unique('id');

        $soinsParRace = $completedSoins->groupBy(function($soin) use ($races) {
            if ($soin->tache_id && $soin->tache && $soin->tache->race) {
                return $soin->tache->race->nomrace;
            } elseif (isset($races[$soin->race_id])) {
                return $races[$soin->race_id]->nomrace;
            } else {
                return 'Race inconnue';
            }
        });
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        @if(auth()->user()->role === 'Eleveur')
        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addSoinModal">
            <i class="bi bi-plus-circle"></i> Ajouter un soin
        </button>
        @endif
    </div>

    @if(auth()->user()->role === 'Eleveur')
    <div class="modal fade" id="addSoinModal" tabindex="-1" aria-labelledby="addSoinLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('completedTasks.store') }}" method="POST">
                @csrf
                <input type="hidden" name="ferme_id" value="{{ $farm->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSoinLabel">Ajouter un soin manuel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nomtache" class="form-label">Nom du soin</label>
                            <input type="text" name="nomtache" id="nomtache" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="race_id" class="form-label">Race</label>
                            <select name="race_id" id="race_id" class="form-select" required>
                                @foreach($farm->animals->pluck('race')->unique() as $race)
                                    <option value="{{ $race->id }}">{{ $race->nomrace }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="completed_at" class="form-label">Date du soin</label>
                            <input type="date" name="completed_at" id="completed_at" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité / détails</label>
                            <input type="text" name="quantite" id="quantite" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    @foreach($soinsParRace as $raceNom => $soins)
    <div class="mb-4">
        <h5 class="mb-3">{{ $raceNom }}</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nom de la tâche</th>
                        <th>Effectuée par</th>
                        <th>Date de complétion</th>
                        <th>Quantité / détails</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($soins as $soin)
                    <tr>
                        <td>{{ $soin->nomtache ?? ($soin->tache->nomtache ?? 'Nom inconnu') }}</td>
                        <td>{{ $soin->user->name ?? 'Utilisateur inconnu' }}</td>
                        <td>{{ \Carbon\Carbon::parse($soin->completed_at)->format('d/m/Y') }}</td>
                        <td>{{ $soin->quantite ?? ($soin->tache->quantite ?? '-') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection

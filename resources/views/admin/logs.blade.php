@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Historique des actions des utilisateurs</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span><strong>Logs enregistrés ({{ $logs->count() }})</strong></span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Utilisateur</th>
                            <th>Action</th>
                            <th>Model</th>
                            <th>ID</th>
                            <th>Détails</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->created_at }}</td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ $log->user->name ?? 'Utilisateur supprimé' }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-info text-dark">{{ $log->action }}</span>
                            </td>

                            <td>{{ $log->model }}</td>
                            <td>{{ $log->model_id }}</td>

                            <td>
                                <pre class="bg-light p-2 rounded" style="white-space: pre-wrap;">
@php
    $details = json_decode($log->details, true);
    if(isset($details['espece_id'])) {
        $espece = \App\Models\Espece::find($details['espece_id']);
        $details['espece'] = $espece->nomespece ?? $details['espece_id'];
        unset($details['espece_id']);
    }

    if(isset($details['race_id'])) {
        $race = \App\Models\Race::find($details['race_id']);
        $details['race'] = $race->nomrace ?? $details['race_id'];
        unset($details['race_id']);
    }

    echo json_encode($details, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
@endphp
    </pre>
                            </td>

                        </tr>
                        @endforeach

                        @if ($logs->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucun log enregistré.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
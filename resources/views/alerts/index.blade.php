@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if (auth()->user()->role === 'Eleveur')
            <h2 class="mb-4">Liste de mes alertes</h2>
        @elseif (auth()->user()->role === 'Veterinaire')
            <h2 class="mb-4">Liste des alertes</h2>
        @endif

        @if ($alerts->isEmpty())
            <div class="alert alert-info text-center">
                <i class="bi bi-exclamation-circle"></i> Vous n'avez émis aucune alerte pour le moment.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th>Priorité</th>
                            <th>Statut</th>
                            <th>Diagnostics</th>
                            <th>Meets Planifiés</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alerts as $alert)
                            @php
                                $priorite = match ($alert->priority) {
                                    'high' => 'Haute',
                                    'medium' => 'Moyenne',
                                    'low' => 'Faible',
                                    default => ucfirst($alert->priority),
                                };
                            @endphp
                            <tr class="{{ !$alert->is_active ? 'table-secondary' : '' }}">
                                <td>{{ $alert->description }}</td>
                                <td>
                                    <span
                                        class="badge
                                    {{ $priorite === 'Haute' ? 'bg-danger' : ($priorite === 'Moyenne' ? 'bg-warning text-dark' : 'bg-success') }}">
                                        {{ $priorite }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge
                                    {{ $alert->status === 'Traitée'
                                        ? 'bg-success'
                                        : ($alert->status === 'Désactivée'
                                            ? 'bg-secondary'
                                            : 'bg-warning text-dark') }}">
                                        {{ $alert->status }}
                                    </span>
                                </td>
                                <td>{{ $alert->diagnostics_count ?? 0 }}</td>
                                <td>{{ $alert->meetings_count ?? 0 }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-sm btn-outline-info" title="Voir détails"
                                            data-bs-toggle="modal" data-bs-target="#alertModal{{ $alert->id }}">
                                            <i class="bi bi-info-circle"></i>
                                        </button>

                                        @if (auth()->user()->role === 'Eleveur')
                                            <a href="{{ route('alerts.diagnostics', $alert->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="Voir diagnostics">
                                                <i class="bi bi-file-earmark-medical"></i>
                                            </a>

                                            @if ($alert->status !== 'Désactivée')
                                                <form action="{{ route('alerts.disable', $alert->id) }}" method="POST"
                                                    onsubmit="return confirm('Confirmer la désactivation de cette alerte ?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Désactiver alerte">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @elseif (auth()->user()->role === 'Veterinaire')
                                        <a href="{{ route('alerts.diagnostics', $alert->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="Voir diagnostics">
                                                <i class="bi bi-file-earmark-medical"></i>
                                            </a>
                                            @if ($alert->status !== 'Désactivée')
                                                <button class="btn btn-sm btn-outline-primary" title="Planifier réunion"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#planMeetingModal{{ $alert->id }}">
                                                    <i class="bi bi-calendar-check"></i>
                                                </button>

                                                <button class="btn btn-sm btn-outline-success" title="Soumettre diagnostic"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#diagnosticModal{{ $alert->id }}">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            @endif
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-4">
                <h4>Réunions Planifiées (Alertes Actives)</h4>
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th>Date de Réunion</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alerts as $alert)
                            @if ($alert->is_active && $alert->meetings->isNotEmpty())
                                @foreach ($alert->meetings as $meeting)
                                    <tr>
                                        <td>{{ $alert->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ $meeting->meeting_url }}" target="_blank"
                                                class="btn btn-sm btn-primary">
                                                Rejoindre
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @foreach ($alerts as $alert)
        @include('partials.modals.alert-details', ['alert' => $alert])
        @include('partials.modals.plan-meeting', ['alert' => $alert])
        @include('partials.modals.diagnostic-form', ['alert' => $alert, 'maladies' => $maladies])
    @endforeach
@endsection

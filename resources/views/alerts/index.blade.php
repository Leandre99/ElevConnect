@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Liste des alertes</h2>

        <div class="row g-4">
            @foreach ($alerts as $alert)
                @php
                    $priorite = match ($alert->priority) {
                        'high' => 'Haute',
                        'medium' => 'Moyenne',
                        'low' => 'Faible',
                        default => ucfirst($alert->priority),
                    };
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100"
                        style="border-left: 6px solid
                        {{ $alert->priority === 'Haute' ? '#dc3545' : ($alert->priority === 'Moyenne' ? '#ffc107' : '#28a745') }};">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-capitalize">
                                Priorité : <span
                                    class="badge
                                    {{ $priorite === 'Haute' ? 'bg-danger' : ($priorite === 'Moyenne' ? 'bg-warning text-dark' : 'bg-success') }}">
                                    {{ $priorite }}
                                </span>
                                <h5>

                                </h5 class="card-title"> Statut: <span
                                    class="badge {{ $alert->statut === 'Traitée' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $alert->statut }}
                                </span>
                                <p class="card-text mb-4">
                                    {{ $alert->description }}
                                </p>

                                <div class="mt-auto">
                                    <p class="mb-1"><i class="bi bi-heart-pulse"></i> Diagnostics :
                                        {{ $alert->diagnostics_count ?? 0 }}</p>
                                    <p><i class="bi bi-calendar-event"></i> Réunions : {{ $alert->meetings_count ?? 0 }}</p>

                                    @if (auth()->user()->role === 'Eleveur')
                                        <button class="btn btn-sm btn-outline-info mb-1 w-100" data-bs-toggle="modal"
                                            data-bs-target="#alertModal{{ $alert->id }}">
                                            <i class="bi bi-info-circle"></i> Détails
                                        </button>
                                        <button class="btn btn-sm btn-outline-success w-100" data-bs-toggle="modal"
                                            data-bs-target="#alertDiagnosticsModal{{ $alert->id }}">
                                            <i class="bi bi-file-earmark-medical"></i> Diagnostics
                                        </button>
                                            @if ($alert->is_active)
                                            <form action="{{ route('alerts.disable', $alert->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Confirmer la désactivation de cette alerte ?')">
                                                    Désactiver
                                                </button>
                                            </form>
                                            @endif
                                    @endif

                                    @if (auth()->user()->role === 'Veterinaire')
                                        <button class="btn btn-sm btn-outline-info mb-1 w-100" data-bs-toggle="modal"
                                            data-bs-target="#alertModal{{ $alert->id }}">
                                            <i class="bi bi-info-circle"></i> Détails
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary mb-1 w-100" data-bs-toggle="modal"
                                            data-bs-target="#planMeetingModal{{ $alert->id }}">
                                            <i class="bi bi-calendar-check"></i> Planifier
                                        </button>
                                        <button class="btn btn-sm btn-outline-success w-100" data-bs-toggle="modal"
                                            data-bs-target="#diagnosticModal{{ $alert->id }}">
                                            <i class="bi bi-check-circle"></i> Diagnostic
                                        </button>
                                    @endif

                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @foreach ($alerts as $alert)
        @include('partials.modals.alert-details', ['alert' => $alert])
        @include('partials.modals.alert-diagnostics', ['alert' => $alert])
        @include('partials.modals.plan-meeting', ['alert' => $alert])
        @include('partials.modals.diagnostic-form', ['alert' => $alert, 'maladies' => $maladies])
    @endforeach
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectMaladie = document.getElementById('maladie_id{{ $alert->id }}');
            const symptomesField = document.getElementById('symptomes_{{ $alert->id }}');
            selectMaladie.addEventListener('change', function() {
                const maladieId = this.value;
                if (maladieId) {
                    fetch(`/maladies/${maladieId}/symptomes`)
                        .then(response => response.json())
                        .then(data => {
                            symptomesField.value = data.symptomes;
                        });
                } else {
                    symptomesField.value = '';
                }
            });
            if (selectMaladie.value) {
                selectMaladie.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection

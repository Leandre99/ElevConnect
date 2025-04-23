@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Liste de mes alertes</h2>
            @if ($alerts->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-exclamation-circle"></i> Vous n'avez émis aucune alerte pour le moment.
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    @foreach ($alerts as $alert)
                        @php
                            $priorite = match ($alert->priority) {
                                'high' => 'Haute',
                                'medium' => 'Moyenne',
                                'low' => 'Faible',
                                default => ucfirst($alert->priority),
                            };
                            $borderColor = match ($priorite) {
                                'Haute' => '#dc3545',
                                'Moyenne' => '#ffc107',
                                'Faible' => '#28a745',
                                default => '#6c757d',
                            };
                        @endphp

                        <div class="col">
                            <div class="card shadow-sm border-start border-4" style="border-left-color: {{ $borderColor }}">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span
                                            class="badge {{ $priorite === 'Haute' ? 'bg-danger' : ($priorite === 'Moyenne' ? 'bg-warning text-dark' : 'bg-success') }}">
                                            Priorité : {{ $priorite }}
                                        </span>
                                        <span
                                            class="badge {{ $alert->statut === 'Traitée' ? 'bg-success' : 'bg-secondary' }}">
                                            Statut : {{ $alert->statut }}
                                        </span>
                                    </div>

                                    <p class="text-muted mb-3">{{ $alert->description }}</p>

                                    <div class="mb-2">
                                        <small><i class="bi bi-heart-pulse"></i> Diagnostics :
                                            {{ $alert->diagnostics_count ?? 0 }}</small><br>
                                        <small><i class="bi bi-calendar-event"></i>Meets Planifiés :
                                            {{ $alert->meetings_count ?? 0 }}</small>
                                    </div>

                                    <div class="mt-auto">
                                        @if (auth()->user()->role === 'Eleveur')
                                            <button class="btn btn-sm btn-outline-info w-100 mb-2" data-bs-toggle="modal"
                                                data-bs-target="#alertModal{{ $alert->id }}">
                                                <i class="bi bi-info-circle"></i> Détails
                                            </button>
                                            <button class="btn btn-sm btn-outline-success w-100 mb-2" data-bs-toggle="modal"
                                                data-bs-target="#alertDiagnosticsModal{{ $alert->id }}">
                                                <i class="bi bi-file-earmark-medical"></i> Diagnostics
                                            </button>
                                            @if ($alert->is_active)
                                                <form action="{{ route('alerts.disable', $alert->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100"
                                                        onclick="return confirm('Confirmer la désactivation de cette alerte ?')">
                                                        <i class="bi bi-x-circle"></i> Supprimer
                                                    </button>
                                                </form>
                                            @endif
                                        @elseif (auth()->user()->role === 'Veterinaire')
                                            <button class="btn btn-sm btn-outline-info w-100 mb-2" data-bs-toggle="modal"
                                                data-bs-target="#alertModal{{ $alert->id }}">
                                                <i class="bi bi-info-circle"></i> Détails
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary w-100 mb-2" data-bs-toggle="modal"
                                                data-bs-target="#planMeetingModal{{ $alert->id }}">
                                                <i class="bi bi-calendar-check"></i> Planifier Meet
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
            @endif

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
    <script>
        function startJitsiMeeting(meetingName) {
            const domain = 'meet.jit.si';
            const options = {
                roomName: meetingName,
                width: '100%',
                height: 500,
                parentNode: document.querySelector('#jitsi-container'),
            };
            const api = new JitsiMeetExternalAPI(domain, options);
        }

        function openJitsiModal(meetingName) {
            startJitsiMeeting(meetingName);
            $('#jitsiModal').modal('show');
        }
    </script>
@endsection

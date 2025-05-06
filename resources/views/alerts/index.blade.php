@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Liste de mes alertes</h2>

        <!-- Modal boîte mail info -->
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Consulter votre boîte mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <p>Vous devez consulter votre boîte mail pour voir les meetings planifiés par le vétérinaire. Ces
                            meetings sont essentiels pour suivre les alertes et planifier les actions nécessaires pour vos
                            animaux.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

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
                            <tr>
                                <td>{{ $alert->description }}</td>
                                <td>
                                    <span
                                        class="badge 
                                    {{ $priorite === 'Haute' ? 'bg-danger' : ($priorite === 'Moyenne' ? 'bg-warning text-dark' : 'bg-success') }}">
                                        {{ $priorite }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $alert->statut === 'Traitée' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $alert->statut }}
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
                                            <!-- Voir Diagnostics -->
                                            <a href="{{ route('alerts.diagnostics', $alert->id) }}"
                                                class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Voir diagnostics">
                                                <i class="bi bi-file-earmark-medical"></i>
                                            </a>

                                            <!-- Désactiver alerte -->
                                            @if ($alert->is_active)
                                                <form action="{{ route('alerts.disable', $alert->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Désactiver alerte"
                                                        onclick="return confirm('Confirmer la désactivation de cette alerte ?')">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @elseif (auth()->user()->role === 'Veterinaire')
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
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Inclus les Modals pour chaque alerte -->
    @foreach ($alerts as $alert)
        @include('partials.modals.alert-details', ['alert' => $alert])
        @include('partials.modals.alert-diagnostics', ['alert' => $alert])
        @include('partials.modals.plan-meeting', ['alert' => $alert])
        @include('partials.modals.diagnostic-form', ['alert' => $alert, 'maladies' => $maladies])
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($alerts as $alert)
                const selectMaladie{{ $alert->id }} = document.getElementById('maladie_id{{ $alert->id }}');
                const symptomesField{{ $alert->id }} = document.getElementById(
                'symptomes_{{ $alert->id }}');
                if (selectMaladie{{ $alert->id }}) {
                    selectMaladie{{ $alert->id }}.addEventListener('change', function() {
                        const maladieId = this.value;
                        if (maladieId) {
                            fetch(`/maladies/${maladieId}/symptomes`)
                                .then(response => response.json())
                                .then(data => {
                                    symptomesField{{ $alert->id }}.value = data.symptomes;
                                });
                        } else {
                            symptomesField{{ $alert->id }}.value = '';
                        }
                    });
                    if (selectMaladie{{ $alert->id }}.value) {
                        selectMaladie{{ $alert->id }}.dispatchEvent(new Event('change'));
                    }
                }
            @endforeach
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>

@endsection

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme ElevConnect</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://meet.jit.si/external_api.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#alertsTable').DataTable();
        });
    </script>
</head>

<body>
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 2%">
            <div class="container-fluid">
                <a class="navbar-brand mx-auto" href="/" style="color: rgb(115, 168, 36)">ElevConnect</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        @guest
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium active" style="font-weight: bold;"
                                    href="{{ route('welcome') }}">Accueil</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Ferme') }}">Ma ferme</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Veterinaire') }}">Véterinaires</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Contact') }}">Nous Contacter</a>
                            </li>
                            <li class="nav-item d-flex">
                                <a class="nav-link fw-medium" style="font-weight:bold; position: absolute;right: 0;"
                                    href="{{ route('register') }}">
                                    <img src="{{ asset('assets/images/connexion.png') }}" width=30>
                                </a>
                            </li>
                        @endguest

                        @auth
                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle fw-medium" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Gestion
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item fw-medium" href="{{ route('admin.farms') }}">Dashboard
                                                Ferme</a>
                                        <li>
                                        <li><a class="dropdown-item fw-medium" href="{{ route('admin.users') }}">Dashboard
                                                User</a></li>
                                        <li><a class="dropdown-item fw-medium" href="{{ route('admin.taches') }}">Dashboard
                                                Tâche</a></li>
                                        <li><a class="dropdown-item fw-medium"
                                                href="{{ route('admin.animals') }}">Dashboard Animal</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium active" style="font-weight: bold;"
                                        href="{{ route('welcome') }}">Accueil</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Ferme') }}">Ma ferme</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Veterinaire') }}">Véterinaires</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('alerts.index') }}">Alertes</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Contact') }}">Nous Contacter</a>
                                </li>
                            @endif

                            <li class="nav-item dropdown mx-auto">
                                <a class="nav-link dropdown-toggle fw-medium" href="#" id="navbarScrollingDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item fw-medium" href="{{ route('profile.edit') }}">Profil</a>
                                    </li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li>
                                            <a class="dropdown-item fw-medium" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">Se
                                                déconnecter</a>
                                        </li>
                                    </form>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h1>Alertes</h1>
            <table id="alertsTable" class="display">
                <thead>
                    <tr>
                        <th>Priorité</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alerts as $alert)
                        <tr>
                            <td>{{ $alert->priority }}</td>
                            <td>{{ $alert->description }}</td>
                            <td>
                                @if (auth()->user()->role === 'Eleveur')
                                    <button type="button" class="btn btn-info me-2" data-bs-toggle="modal"
                                        data-bs-target="#alertModal{{ $alert->id }}">
                                        Voir les détails
                                    </button>
                                    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal"
                                        data-bs-target="#alertDiagnosticsModal{{ $alert->id }}">
                                        Consulter diagnostics
                                    </button>


                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#diagnosticModal{{ $alert->id }}">
                                        Supprimer alerte
                                    </button>
                                @endif

                                @if (auth()->user()->role === 'Veterinaire')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#planMeetingModal{{ $alert->id }}"
                                        data-alerte-id="{{ $alert->id }}">
                                        Planifier un meet
                                    </button>

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#diagnosticModal{{ $alert->id }}">
                                        Émettre un diagnostic
                                    </button>
                                @endif

                                <!-- Modal pour Voir les détails -->
                                <div class="modal fade" id="alertModal{{ $alert->id }}" tabindex="-1"
                                    aria-labelledby="alertModalLabel{{ $alert->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="alertModalLabel{{ $alert->id }}">
                                                    Détails de l'alerte</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Description:</strong> {{ $alert->description }}</p>
                                                <p><strong>Priorité:</strong> {{ $alert->priority }}</p>
                                                @if ($alert->media)
                                                    <p><strong>Media:</strong></p>
                                                    <a href="{{ asset('storage/' . $alert->media) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $alert->media) }}"
                                                            class="img-fluid" alt="Media">
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                @if (auth()->user()->role === 'veterinaire')
                                                    <!-- Bouton Intervenir dans le modal des détails -->
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#planMeetingModal{{ $alert->id }}"
                                                        data-alerte-id="{{ $alert->id }}">
                                                        Intervenir
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal pour Planifier la Réunion -->
                                <div class="modal fade" id="planMeetingModal{{ $alert->id }}" tabindex="-1"
                                    aria-labelledby="planMeetingModalLabel{{ $alert->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="planMeetingModalLabel{{ $alert->id }}">Planifier une
                                                    Réunion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form id="planMeetingForm{{ $alert->id }}"
                                                action="{{ route('meeting.schedule') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="meetingDate{{ $alert->id }}"
                                                            class="form-label">Date et Heure de la Réunion</label>
                                                        <input type="datetime-local" class="form-control"
                                                            id="meetingDate{{ $alert->id }}" name="meetingDate"
                                                            required>
                                                    </div>
                                                    <input type="hidden" name="alert_id"
                                                        value="{{ $alert->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Planifier</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal pour Émettre un Diagnostic -->
                                <div class="modal fade" id="diagnosticModal{{ $alert->id }}" tabindex="-1"
                                    aria-labelledby="diagnosticModalLabel{{ $alert->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Fermer"></button>
                                            </div>
                                            <form action="{{ route('diagnostics.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="maladie_id{{ $alert->id }}"
                                                            class="form-label">Maladie</label>
                                                        <select name="maladie_id" id="maladie_id{{ $alert->id }}"
                                                            class="form-control" required>
                                                            @foreach ($maladies as $maladie)
                                                                <option value="{{ $maladie->id }}">
                                                                    {{ $maladie->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="symptomes_{{ $alert->id }}"
                                                            class="form-label">Symptômes</label>
                                                        <textarea name="symptomes" id="symptomes_{{ $alert->id }}" class="form-control" rows="1" readonly></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date{{ $alert->id }}"
                                                            class="form-label">Date</label>
                                                        <input type="date" name="date"
                                                            id="date{{ $alert->id }}" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="traitement{{ $alert->id }}"
                                                            class="form-label">Traitement recommandé</label>
                                                        <textarea name="traitement" id="traitement{{ $alert->id }}" class="form-control" rows="3" required></textarea>
                                                    </div>
                                                    <input type="hidden" name="alert_id"
                                                        value="{{ $alert->id }}">
                                                    <input type="hidden" name="ferme_id"
                                                        value="{{ $alert->ferme_id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-success">Soumettre</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Voir le diagnostic -->
                                <div class="modal fade" id="alertDiagnosticsModal{{ $alert->id }}" tabindex="-1"
                                    aria-labelledby="diagnosticModalLabel{{ $alert->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="diagnosticModalLabel{{ $alert->id }}">
                                                    Diagnostic(s) pour Alerte #{{ $alert->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Fermer"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($alert->diagnostics->count() > 0)
                                                    @foreach ($alert->diagnostics as $diagnostic)
                                                        <div class="mb-3 border p-3 rounded bg-light">
                                                            <p><strong>Maladie :</strong>
                                                                {{ $diagnostic->maladie->nom }}</p>
                                                            <p><strong>Symptômes :</strong>
                                                                {{ $diagnostic->maladie->symptomes }}</p>
                                                            <p><strong>Traitement :</strong>
                                                                {{ $diagnostic->traitement ?? 'Non spécifié' }}</p>
                                                            <p><strong>Soumis le :</strong>
                                                                {{ $diagnostic->created_at->format('d/m/Y H:i') }}</p>
                                                            <p><strong>Soumis par :</strong>
                                                                {{ $diagnostic->veterinaire->name ?? 'Vétérinaire inconnu' }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-muted">Aucun diagnostic enregistré pour cette
                                                        alerte.</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                    button.addEventListener('click', function() {
                        var alerteId = this.getAttribute('data-alerte-id');
                        var modalId = '#planMeetingModal' + alerteId;
                        var modal = new bootstrap.Modal(document.querySelector(modalId));
                        modal.show();
                    });
                });
            });
        </script>
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
        <script src="vendors/is/is.min.js"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
        <script src="assets/js/theme.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                function truncateText(element, maxLength) {
                    const text = element.textContent.trim();
                    if (text.length > maxLength) {
                        element.textContent = text.slice(0, maxLength) + '...';
                    }
                }

                const descriptionElements = document.querySelectorAll('.description-truncate');


                descriptionElements.forEach(element => {
                    truncateText(element, 100);
                });
            });
        </script>
        <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap"
            rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>

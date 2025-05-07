<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElevConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://meet.jit.si/external_api.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
</head>

<body style="font-family: 'Roboto', sans-serif;">
    <main class="d-flex flex-column min-vh-100">
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
                                <a class="nav-link fw-medium active" style="font-weight: bold;" href="{{ route('welcome') }}">Accueil</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Ferme') }}">Ma ferme</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Veterinaire') }}">Vétérinaires</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link fw-medium" href="{{ route('Contact') }}">Nous Contacter</a>
                            </li>
                            <li class="nav-item d-flex">
                                <a class="nav-link fw-medium" style="font-weight:bold; position: absolute; right: 0;" href="{{ route('login') }}">
                                    <span style="margin-right: 8px;">Connexion</span>
                                    <img src="{{ asset('assets/images/connexion.png') }}" width="30">
                                </a>
                            </li>
                        @endguest
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link fw-medium" href="{{ route('admin.dashboard') }}">Tableau de bord</a>
                                </li>
                            @else
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium active" style="font-weight: bold;" href="{{ route('welcome') }}">Accueil</a>
                                </li>
                                @if (Auth::user()->role === 'Eleveur')
                                    <li class="nav-item px-2">
                                        <a class="nav-link fw-medium" href="{{ route('Ferme') }}">Ma ferme</a>
                                    </li>
                                @endif
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Veterinaire') }}">Vétérinaires</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('alerts.index') }}">Alertes</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Contact') }}">Nous Contacter</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown mx-auto">
                                <a class="nav-link dropdown-toggle fw-medium" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li>
                                        <a class="dropdown-item fw-medium" href="{{ route('profile.edit') }}">Profil</a>
                                    </li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li>
                                            <a class="dropdown-item fw-medium" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                                                Se déconnecter
                                            </a>
                                        </li>
                                    </form>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container my-5 flex-grow-1">
            @yield('content')
        </div>

        <footer class="bg-success mt-auto">
            <div class="container">
                <div class="row text-md-left pt-5">
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <h5><img class="img-fluid" src="{{ asset('assets/images/preview.png') }}" style="width:50%;"></h5>
                        <p style="margin-left:8%; color:white;"><b>Elev<span style="color: black;">Connect</span></b></p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4 pt-3">
                        <h5 style="color:black;">Explorez</h5>
                        <p style="color:white;">A propos<br>Conditions générales d'utilisation<br>Avertissement</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <div class="card bg-success border-0">
                            <div class="card-body p-sm-4">
                                <h5 style="color:black;">ElevConnect</h5>
                                <p class="mb-0 text-white">Adresse: 123 Rue des Éleveurs, Benin</p>
                                <ul class="list-unstyled">
                                    <li>
                                        <i class="agrikon-icon-email"></i>
                                        <a class="text-white" href="mailto:leandreelisha20@gmail.com">ElevConnect@company.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><br>
            </div>
        </footer>
    </main>

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
    <script>
        $(document).ready(function() {
            $('#alertsTable').DataTable();
        });
    </script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendors/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
</body>
</html>

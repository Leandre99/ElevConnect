<!DOCTYPE html>
<html>

<head>
    <title>Rapports de Performance</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Plateforme ElevConnect</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container {
            margin-top: 20px;
        }

        .chart-container {
            position: relative;
            height: 40vh;
            width: 80vw;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
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
                                <a class="nav-link fw-medium" href="{{ route('Ferme-index') }}">Ma ferme</a>
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
                                        <li><a class="dropdown-item fw-medium" href="#">Dashboard Ferme</a></li>
                                        <li><a class="dropdown-item fw-medium" href="#">Dashboard User</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium active" style="font-weight: bold;"
                                        href="{{ route('welcome') }}">Accueil</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Ferme-index') }}">Ma ferme</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-medium" href="{{ route('Veterinaire') }}">Véterinaires</a>
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
    </header>

    <div class="container">
        <h1>Rapports de Performance</h1>
        <form method="POST" action="{{ route('reports.generate', $ferme_id) }}" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <label for="start_date" class="form-label">Date de Début :</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>
                <div class="col-md-5">
                    <label for="end_date" class="form-label">Date de Fin :</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4">Filtrer</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Tâches Complètes</th>
                    <th>Tâches Totales</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $displayTotalTasks = true;
                @endphp

                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->task->nomtache }}</td>
                        @if ($displayTotalTasks)
                            <td rowspan="{{ $reports->count() }}">{{ $total_task}}</td>
                            @php
                                $displayTotalTasks = false;
                            @endphp
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Status de Performance : </h2>
        <p>Tâches Complétées: {{ $completedTasksCount }} / {{ $total_task }}</p>
        <p>Date prédite de fin de l'élevage : {{ $endDatePrediction }}</p>
    </div>

    <footer class="bg-success" style="padding-top:5%;">
        <div class="container">
            <div class="row text-md-left">
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <h5><img class="img-fluid" src="{{ asset('assets/images/preview.png') }}" style="width:50%;">
                    </h5>
                    <p style="margin-left:8%; color:white;"><b>Elev<span style="color: black;">Connect</b></p>
                </div><br>

                <div class="col-md-4 col-lg-4 col-sm-4" style="padding-top: 3%">
                    <h5 style="color:black;">Explorez</h5>
                    <p style="color:white;">A propos<br>Conditions générales d'utilisation<br>Avertissement</p>
                </div><br>

                <div class="col-md-4 col-lg-4 col-sm-4">
                    <div class="card bg-success">
                        <div class="card-body p-sm-4">
                            <h5 class="text-white">ElevConnect</h5>
                            <p class="mb-0 text-white">Adresse: 123 Rue des Éleveurs, Benin</p>
                            <button class="btn btn-light text-success w-100" type="button">
                                <ul class="list-unstyled">
                                    <li>
                                        <i class="agrikon-icon-email"></i>
                                        <a href="mailto:leandreelisha20@gmail.com">ElevConnect@company.com</a>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div><br>
        </div>
    </footer>

    <script>
        // const ctx = document.getElementById('performanceChart').getContext('2d');
        // const tasksChart = new Chart(ctx, {
        //     type: 'line',
        //     data: {
        //         labels: ,
        //         datasets: [{
        //             label: 'Tâches Complétées',
        //             data: ,
        //             borderColor: 'rgba(75, 192, 192, 1)',
        //             borderWidth: 2,
        //             fill: false
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             x: {
        //                 type: 'category',
        //                 labels: ,
        //             },
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>

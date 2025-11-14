<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Chivo', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .sidebar {
            width: 260px;
            background-color: #fff;
            border-right: 1px solid #dee2e6;
            min-height: 100vh;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar img {
            display: block;
            margin: 0 auto 15px;
            max-width: 100px;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            transition: 0.3s;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .sidebar a:hover, .sidebar .active {
            background-color: rgb(115, 168, 36);
            color: white;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar .logout {
            margin-top: 50px;
        }

        .content-area {
            margin-left: 280px;
            padding: 20px;
            width: calc(100% - 280px);
        }

        .navbar {
            background-color: #fff;
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
                padding: 15px;
            }
            .content-area {
                margin-left: 240px;
                width: calc(100% - 240px);
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav class="sidebar">
            <img src="{{ asset('assets/images/preview.png') }}" alt="Logo">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Tableau de bord
            </a>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Utilisateurs
            </a>
            <a href="{{ route('admin.farms') }}" class="{{ request()->routeIs('admin.farms') ? 'active' : '' }}">
                <i class="fas fa-warehouse"></i> Fermes
            </a>
            <a href="{{ route('admin.animals') }}" class="{{ request()->routeIs('admin.animals') ? 'active' : '' }}">
                <i class="fas fa-paw"></i> Animaux
            </a>
            <a href="{{ route('admin.taches') }}" class="{{ request()->routeIs('admin.taches') ? 'active' : '' }}">
                <i class="fas fa-tasks"></i> Tâches
            </a>
            <a href="{{ route('admin.especes.index') }}" class="{{ request()->routeIs('admin.especes.index') ? 'active' : '' }}">
                <i class="fas fa-dna"></i> Espèces
            </a>
            <a href="{{ route('admin.races.index') }}" class="{{ request()->routeIs('admin.races.index') ? 'active' : '' }}">
                <i class="fas fa-hippo"></i> Races
            </a>
            <a href="{{ route('admin.maladies.index') }}" class="{{ request()->routeIs('admin.maladies.index') ? 'active' : '' }}">
                <i class="fas fa-virus"></i> Maladies
            </a>
            <a href="{{ route('admin.diagnostics.index') }}" class="{{ request()->routeIs('admin.diagnostics.index') ? 'active' : '' }}">
                <i class="fas fa-stethoscope"></i> Diagnostics
            </a>
            <a href="{{ route('admin.alertes.index') }}" class="{{ request()->routeIs('admin.alertes.index') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle"></i> Alertes
            </a>
            <a href="{{ route('admin.logs') }}" class="{{ request()->routeIs('admin.logs') ? 'active' : '' }}">
                <i class="fas fa-history"></i>Historique des actions
            </a>
        </nav>

        <div class="content-area">
            <nav class="navbar d-flex justify-content-between">
                <span class="fw-bold fs-5">Bienvenue sur le tableau de bord</span>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a class="dropdown-item fw-medium text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                </form>
            </nav>

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

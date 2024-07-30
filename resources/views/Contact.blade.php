<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme ElevConnect</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/img/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x3 2" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link href="assets/css/theme.css" rel="stylesheet" />
</head>

<body>
    <main class="main" id="top">
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
                                            Gestion des Fermes
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

        <section>
            <h1>Nous souhaitons nous améliorer</h1>
        </section>

        <div class="container" style="margin-top:-8%; margin-bottom:5%">
            <div class="row">
                <div class="bg-light p-4" id="form-outer" style="color: black">
                    <form id="contact-form" method="POST" action="{{ route('form') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">Votre nom :</label>
                            <input type="text" id="nom" name="nom" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Votre Email :</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Votre âge :</label>
                            <input type="number" id="age" name="age" class="form-control" min="7" max="77" required>
                        </div>

                        <div class="mb-3">
                            <label for="position_actuelle" class="form-label">Votre position actuelle :</label>
                            <select id="position_actuelle" name="position_actuelle" class="form-select" required>
                                <option value="student">Eleveur</option>
                                <option value="veterinarian">Vétérinaire</option>
                                <option value="employee">Employé</option>
                                <option value="entrepreneur">Entrepreneur</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="recommande" class="form-label">Est-ce que vous nous recommandez ?</label>
                            <div>
                                <input type="radio" id="recommande1" name="recommande" value="1" class="form-check-input">
                                <label for="recommande1" class="form-check-label">Oui</label>
                            </div>
                            <div>
                                <input type="radio" id="recommande2" name="recommande" value="2" class="form-check-input">
                                <label for="recommande2" class="form-check-label">Peut-être</label>
                            </div>
                            <div>
                                <input type="radio" id="recommande3" name="recommande" value="3" class="form-check-input">
                                <label for="recommande3" class="form-check-label">Non</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="plus_aime" class="form-label">Ce que vous aimez le plus chez nous :</label>
                            <select id="plus_aime" name="plus_aime" class="form-select" required>
                                <option value="challenges">Les défis</option>
                                <option value="projects">Les projets</option>
                                <option value="community">La communauté</option>
                                <option value="open_source">L'open source</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="preferences" class="form-label">Ce que nous devons améliorer :</label>
                            <div>
                                <input type="checkbox" id="preferences1" name="preferences[]" value="L'interface utilisateur" class="form-check-input">
                                <label for="preferences1" class="form-check-label">L'interface utilisateur</label>
                            </div>
                            <div>
                                <input type="checkbox" id="preferences2" name="preferences[]" value="Le rapport de performance" class="form-check-input">
                                <label for="preferences2" class="form-check-label">Le rapport de performance</label>
                            </div>
                            <div>
                                <input type="checkbox" id="preferences3" name="preferences[]" value="Présence sur les réseaux sociaux" class="form-check-input">
                                <label for="preferences3" class="form-check-label">Présence sur les réseaux sociaux</label>
                            </div>
                            <div>
                                <input type="checkbox" id="preferences4" name="preferences[]" value="Le formulaire de contact" class="form-check-input">
                                <label for="preferences4" class="form-check-label">Le formulaire de contact</label>
                            </div>
                            <div>
                                <input type="checkbox" id="preferences5" name="preferences[]" value="Le service de messagerie" class="form-check-input">
                                <label for="preferences5" class="form-check-label">Le service de messagerie</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="commentaires" class="form-label">Commentaires :</label>
                            <textarea id="commentaires" name="commentaires" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
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
    </main>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="assets/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap"rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"> </script>
</body>
</html>

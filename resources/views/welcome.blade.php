<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme ElevConnect</title>
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link href="assets/css/theme.css" rel="stylesheet" />
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
                                        <li><a class="dropdown-item fw-medium" href="{{route('admin.farms')}}">Dashboard Ferme</a></li>
                                        <li><a class="dropdown-item fw-medium" href="{{route('admin.users')}}">Dashboard User</a></li>
                                        <li><a class="dropdown-item fw-medium" href="{{route('admin.taches')}}">Dashboard Tâche</a></li>
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

        <section class="py-0" id="header">
            <div class="bg-holder d-none d-md-block"
                style="background-image:url(assets/images/h.png);background-position:right top;background-size:contain;">
            </div>

            <div class="bg-holder d-md-none"
                style="background-image:url(assets/img/illustrations/hero-bg.png);background-position:right top;background-size:contain;">
            </div>

            <div class="container my-5">
                <div class="row align-items-center min-vh-75 min-vh-lg-100">
                    <div class="col-md-7 col-lg-6 col-xxl-5 mb-5 py-6 text-sm-start text-center">

                        <h1 class="mt-6 mb-sm-4 fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6"><br class="d-block d-lg-block" />ElevConnect,</h1>
                        <p class="mb-4 fs-1" style="color: black;">Simplifiez votre élevage, maximisez votre
                            productivité et assurez le bien-être de chaque animal grace à des spécialistes.</p>
                            <a class="btn btn-success mb-5" href="{{ route('Ferme-index') }}" style="cursor: pointer;">Ma ferme</a>

                    </div>
                </div>
            </div>
        </section>

        <section class="py-0 mt-5" id="Opportuanities">
            <div class="bg-holder d-none d-sm-block"
                style="background-image:url(assets/img/illustrations/arriere.png);background-position:top left;background-size:225px 755px;margin-top:-17.5rem;">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9 mx-auto text-center mb-3">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Nos Services</h5>
                    </div>
                </div>
                <div class="row flex-center h-100">
                    <div class="col-xl-9">
                        <div class="row">
                            <div class="col-md-4 mb-5">
                                <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                                    <div class="text-center text-md-start card-hover"><img class="ps-3 icons"
                                            src="{{ asset('assets/img/icons/tache.png') }}" height="60"
                                            alt="" />
                                        <div class="card-body">
                                            <h6 class="fw-bold fs-1 heading-color">Gestion des tâches</h6>
                                            <p class="mt-3 mb-md-0 mb-lg-2">Abandonnez les listes de tâches
                                                manuscrites! Notre application génère automatiquement un programme
                                                journalier personnalisé pour votre élevage, en tenant compte de vos
                                                animaux et de vos besoins spécifiques.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                                    <div class="text-center text-md-start card-hover"><img class="ps-3 icons"
                                            src="{{ asset('assets/img/icons/rapport.png') }}" height="60"
                                            alt="" />
                                        <div class="card-body">
                                            <h6 class="fw-bold fs-1 heading-color">Rapport de Performances</h6>
                                            <p class="mt-3 mb-md-0 mb-lg-2">Obtenez des rapports complets et
                                                personnalisés qui résument vos activités d'élevage, vous offrant une
                                                vision claire de vos performances.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                                    <div class="text-center text-md-start card-hover"><img class="ps-3 icons"
                                            src="{{ asset('assets/img/icons/veterinaire.png') }}" height="60"
                                            alt="" />
                                        <div class="card-body">
                                            <h6 class="fw-bold fs-1 heading-color">Connection avec nos vétérinaires
                                            </h6>
                                            <p class="mt-3 mb-md-0 mb-lg-2"> Posez des questions sur la santé de vos
                                                animaux, obtenez des diagnostics et recevez des recommandations de
                                                traitement personnalisées
                                                avec des vétérinaires certifiés par chat ou vidéo.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-0">
            <div class="bg-holder"
                style="background-image:url(assets/img/illustrations/how-it-works.png);background-position:center bottom;background-size:cover;">
            </div>

            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-sm-8 col-md-9 col-xl-5 text-center pt-8">
                        <h5 class="fw-bold fs-3 fs-xxl-5 lh-sm mb-3 text-white">Comment ça marche ?</h5>
                        <p class="mb-5 text-white">L'application s'appuie sur vos données et les paramètres définis
                            pour générer des tâches quotidiennes personnalisées. En cas de maladies ou d'inquiétude vous
                            pouvez consulter un vétérinaire via la plateforme.</p>
                    </div>
                    <div class="col-sm-9 col-md-12 col-xxl-9">
                        <div class="theme-tab">
                            <ul class="nav justify-content-between">
                                <li class="nav-item" role="presentation"><a class="nav-link active fw-semi-bold"
                                        href="#bootstrap-tab1" data-bs-toggle="tab" data-bs-target="#tab1"
                                        id="tab-1"><span class="nav-item-circle-parent"><span
                                                class="nav-item-circle">01</span></span></a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link fw-semi-bold"
                                        href="#bootstrap-tab2" data-bs-toggle="tab" data-bs-target="#tab2"
                                        id="tab-2"><span class="nav-item-circle-parent"><span
                                                class="nav-item-circle">02</span></span></a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link fw-semi-bold"
                                        href="#bootstrap-tab3" data-bs-toggle="tab" data-bs-target="#tab3"
                                        id="tab-3"><span class="nav-item-circle-parent"><span
                                                class="nav-item-circle">03</span></span></a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link fw-semi-bold"
                                        href="#bootstrap-tab4" data-bs-toggle="tab" data-bs-target="#tab4"
                                        id="tab-4"><span class="nav-item-circle-parent"><span
                                                class="nav-item-circle">04</span></span></a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                    aria-labelledby="tab-1">
                                    <div class="row align-items-center my-6 mx-auto">
                                        <div class="col-md-6 col-lg-5 offset-md-1">
                                            <h3 class="fw-bold lh-base text-white">Créez un compte éleveur puis
                                                sélectionner vos animaux et leurs spécificités.</h3>
                                        </div>
                                        <div class="col-md-5 text-white offset-lg-1">
                                            <p class="mb-0">L'application collecte des données sur les tâches
                                                accomplies par l'éleveur, les événements enregistrés et les informations
                                                saisies manuellement.
                                                Ces données sont analysées pour générer des rapports de performance qui
                                                fournissent à l'éleveur un aperçu de ses activités et de l'état de son
                                                élevage</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-8" id="testimonial">
            <div class="container-lg">
                <div class="row flex-center">
                    <div class="col-12 col-lg-10 col-xl-12">
                        <div class="bg-holder"
                            style="background-image:url(assets/img/illustrations/testimonial-bg.png);background-position:top left;background-size:120px 83px;">
                        </div>
                        <h6 class="fs-3 fs-lg-4 fw-bold lh-sm">Qu'est ce que les éleveurs comme vous<br />disent à
                            propos de nous</h6>
                    </div>
                    <div class="carousel slide pt-3" id="carouselExampleDark" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <div class="row h-100 mx-3 mx-sm-5 mx-md-4 my-md-7 m-lg-7 mt-7">
                                    <div class="col-md-4 mb-5 mb-md-0">
                                        <div class="card h-100 shadow">
                                            <div class="card-body my-3">
                                                <div class="align-items-xl-center d-block d-xl-flex px-3"><img
                                                        class="img-fluid me-3 me-md-2 me-lg-3"
                                                        src="assets/img/gallery/usert.jpg" width="50"
                                                        alt="" style="border-radius: 45%" />
                                                    <div class="flex-1 align-items-center pt-2">
                                                        <h5 class="mb-0 fw-bold text-success">Kwame Osei</h5>
                                                        <p class="fw-normal text-black">Éleveur de volailles</p>
                                                    </div>
                                                </div>
                                                <p class="mb-0 px-3 px-md-2 px-xxl-3">&quot;Depuis que j'utilise
                                                    l'application, j'ai gagné un temps fou sur la gestion quotidienne de
                                                    mon troupeau. Plus besoin de listes de tâches manuscrites, tout est
                                                    centralisé et automatisé. Je suis beaucoup plus efficace et je peux
                                                    me concentrer davantage sur le bien-être de mes vaches."</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-5 mb-md-0">
                                        <div class="card h-100 shadow">
                                            <div class="card-body my-3">
                                                <div class="align-items-xl-center d-block d-xl-flex px-3"><img
                                                        class="img-fluid me-3 me-md-2 me-lg-3"
                                                        src="assets/img/gallery/useru.jpg" width="50"
                                                        alt="" style="border-radius: 45%;" />
                                                    <div class="flex-1 align-items-center pt-2">
                                                        <h5 class="mb-0 fw-bold text-success">Aïssa Diop</h5>
                                                        <p class="fw-normal text-black">Éleveuse laitière</p>
                                                    </div>
                                                </div>
                                                <p class="mb-0 px-3 px-md-2 px-xxl-3">&quot;L'application m'a permis
                                                    d'améliorer considérablement la santé de mes animaux. Grâce au suivi
                                                    des tâches et aux alertes, je ne manque plus jamais un traitement ou
                                                    une vaccination. Je suis beaucoup plus sereine depuis que j'utilise
                                                    cet outil."</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-5 mb-md-0">
                                        <div class="card h-100 shadow">
                                            <div class="card-body my-3">
                                                <div class="align-items-xl-center d-block d-xl-flex px-3"><img
                                                        class="img-fluid me-3 me-md-2 me-lg-3"
                                                        src="assets/img/gallery/sidiki.png" width="50"
                                                        alt="" style="border-radius: 45%;" />
                                                    <div class="flex-1 align-items-center pt-2">
                                                        <h5 class="mb-0 fw-bold text-success"> Baba Sidibe</h5>
                                                        <p class="fw-normal text-black">Éleveur caprin</p>
                                                    </div>
                                                </div>
                                                <p class="mb-0 px-3 px-md-2 px-xxl-3">&quot;J'ai remarqué une nette
                                                    augmentation de ma production depuis que j'utilise l'application.
                                                    Grâce aux rapports de performance, j'ai pu identifier les domaines
                                                    où je pouvais améliorer mes pratiques et optimiser l'alimentation de
                                                    mes poulets."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <div class="row h-100 mx-3 mx-sm-5 mx-md-4 my-md-7 m-lg-7 mt-7">
                                    <div class="col-md-4 mb-5 mb-md-0">
                                        <div class="card h-100 shadow">
                                            <div class="card-body my-3">
                                                <div class="align-items-xl-center d-block d-xl-flex px-3"><img
                                                        class="img-fluid me-3 me-md-2 me-lg-3"
                                                        src="assets/img/gallery/roumi.png" width="50"
                                                        alt="" style="border-radius: 45%;" />
                                                    <div class="flex-1 align-items-center pt-2">
                                                        <h5 class="mb-0 fw-bold text-success">Moussa Coulibaly</h5>
                                                        <p class="fw-normal text-black">Éleveur de poulets de chair</p>
                                                    </div>
                                                </div>
                                                <p class="mb-0 px-3 px-md-2 px-xxl-3">&quot;L'application est un
                                                    véritable atout pour la communication avec mon vétérinaire. Je peux
                                                    facilement partager des informations sur l'état de santé de mes
                                                    moutons et programmer des rendez-vous en ligne. C'est beaucoup plus
                                                    pratique et efficace."</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-5 mb-md-0">
                                        <div class="card h-100 shadow">
                                            <div class="card-body my-3">
                                                <div class="align-items-xl-center d-block d-xl-flex px-3"><img
                                                        class="img-fluid me-3 me-md-2 me-lg-3"
                                                        src="assets/img/gallery/ttr.png" width="50"
                                                        alt="" style="border-radius: 40%;" />
                                                    <div class="flex-1 align-items-center pt-2">
                                                        <h5 class="mb-0 fw-bold text-success">Souleymane Traoré</h5>
                                                        <p class="fw-normal text-black">Éleveur de porcs</p>
                                                    </div>
                                                </div>
                                                <p class="mb-0 px-3 px-md-2 px-xxl-3">&quot;J'ai recommandé
                                                    l'application à tous mes voisins éleveurs. C'est un outil
                                                    indispensable pour tous ceux qui veulent gérer leur exploitation de
                                                    manière moderne et efficace."</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-5 mb-md-0">
                                        <div class="card h-100 shadow">
                                            <div class="card-body my-3">
                                                <div class="align-items-xl-center d-block d-xl-flex px-3"><img
                                                        class="img-fluid me-3 me-md-2 me-lg-3"
                                                        src="assets/img/gallery/fati.jpg" width="50"
                                                        alt="" style="border-radius: 40%;" />
                                                    <div class="flex-1 align-items-center pt-2">
                                                        <h5 class="mb-0 fw-bold text-success"> Fatoumata Camara</h5>
                                                        <p class="fw-normal text-black">Éleveuse de chevaux</p>
                                                    </div>
                                                </div>
                                                <p class="mb-0 px-3 px-md-2 px-xxl-3">&quot;L'application m'a permis de
                                                    gagner en temps, en précision et en efficacité dans la gestion de
                                                    mon écurie. Je suis très satisfaite de cet outil et je le recommande
                                                    à tous les éleveurs de chevaux."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3 px-sm-6 px-md-0 px-lg-5 px-xl-4">
                            <div class="col-12 position-relative">
                                <a class="carousel-control-prev carousel-icon z-index-2" href="#carouselExampleDark"
                                    role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next carousel-icon z-index-2" href="#carouselExampleDark"
                                    role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap" rel="stylesheet">
</body>
</html>

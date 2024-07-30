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
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="/chat.css">
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

        <div class="container" style="margin-top: 10%;margin-bottom: 10%">
            <div class="row">
                @foreach ($veterinaires as $veterinaire)
                    <div class="col-md-4" style="margin-bottom:3%">
                        <div class="card h-100 shadow">
                            <img class="img-fluid me-3 me-md-2 me-lg-3" src="{{ asset('assets/images/veto.png') }}"
                                width="50" style="margin: 3%;" alt="" />
                            <div class="card-header">
                                <h5 class="card-title mb-0 fw-bold text-success">{{ $veterinaire->name }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text fw-normal text-black">{{ $veterinaire->description }}</p>
                                <!-- Button trigger modal -->
                                <button type="button" style=" position: absolute; bottom:0; right:0;" class="btn"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal{{ $veterinaire->id }}">
                                    <span class="material-symbols-outlined">
                                        maps_ugc
                                    </span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $veterinaire->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel{{ $veterinaire->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel{{ $veterinaire->id }}">
                                                    Discussion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="chat" id="chat-{{ $veterinaire->id }}">
                                                    <!-- Header -->
                                                    <div class="top">
                                                        <div>
                                                            <h5>{{ $veterinaire->name }}</h5>
                                                        </div>
                                                    </div>
                                                    <!-- End Header -->

                                                    <!-- Chat -->
                                                    <div class="messages" id="messages-{{ $veterinaire->id }}">
                                                        @include('receive', [
                                                            'message' =>
                                                                "Hey! Comment puis-je vous aider aujourd'hui !  👋",
                                                        ])
                                                    </div>
                                                    <!-- End Chat -->

                                                    <!-- Footer -->
                                                    <div class="bottom">
                                                        <form id="form-{{ $veterinaire->id }}">
                                                            <input type="text" id="message-{{ $veterinaire->id }}"
                                                                name="message" placeholder="Enter message..."
                                                                autocomplete="off">
                                                            <button type="submit"></button>
                                                            <input type="hidden" name="veterinaire_id"
                                                                value="{{ $veterinaire->id }}">
                                                        </form>
                                                    </div>
                                                    <!-- End Footer -->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </main>

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
    <script src="vendors/is/is.min.js"><script/>
    <script src ="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <link href ="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap"rel = "stylesheet" >
    <script src ="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity = "sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin = "anonymous" > </script>
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity = "sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin = "anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
                cluster: 'eu'
            });

            const veterinaireIds = @json($veterinaires->pluck('id'));

            veterinaireIds.forEach(id => {
                const channel = pusher.subscribe(`public.${id}`);

                // Receive messages
                channel.bind('chat', function(data) {
                    $.post("/receive", {
                        _token: '{{ csrf_token() }}',
                        message: data.message,
                        veterinaire_id: id
                    }).done(function(res) {
                        $(`#messages-${id} > .message`).last().after(res);
                        $(document).scrollTop($(document).height());
                    });
                });

                // Broadcast messages
                $(`#form-${id}`).submit(function(event) {
                    event.preventDefault();

                    const message = $(`#message-${id}`).val();

                    $.ajax({
                        url: "/broadcast",
                        method: 'POST',
                        headers: {
                            'X-Socket-Id': pusher.connection.socket_id
                        },
                        data: {
                            _token: '{{ csrf_token() }}',
                            message: message,
                            veterinaire_id: id
                        }
                    }).done(function(res) {
                        // Append the sent message to the messages container
                        $.post("/receive", {
                            _token: '{{ csrf_token() }}',
                            message: message,
                            veterinaire_id: id
                        }).done(function(res) {
                            $(`#messages-${id} > .message`).last().after(res);
                            $(`#message-${id}`).val('');
                            $(document).scrollTop($(document).height());
                        });
                    });
                });
            });
        });
    </script>
</body>

</html>

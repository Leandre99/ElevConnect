<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taches du jour</title>
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
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
<div class="container" style="margin-top: 10%">
    <h1>Tâches Journalières pour :<strong> {{ $ferme->nomferme }}</strong></h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h2>Race: {{ $race->nomrace }}</h2>
    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $task->nomtache }}
                @if ($task->task_id === null)
                    <form id="mark-task-form-{{ $task->id }}"
                        action="{{ route('tasks.markAsCompleted', $task) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <input type="hidden" name="ferme_id" value="{{ $ferme->id }}">
                        <button type="submit" class="btn btn-sm btn-success mark-complete-btn">Tâche
                            accomplie</button>
                        <img class="check-circle" src="{{ asset('assets/images/check.png') }}"
                            style="display: none;">
                    </form>
                @else
                    <img class="check-circle" style="width: 3%" src="{{ asset('assets/images/check.png') }}">
                @endif
            </li>
        @endforeach
    </ul>
</div>
</body>
<script>
    // Supposons que vous avez un bouton ou une action qui déclenche le marquage comme complété
    $('#markAsCompletedBtn').click(function(e) {
        e.preventDefault();

        // Récupérez l'ID de la tâche que l'utilisateur souhaite marquer comme complétée
        var taskId = $(this).data(
        'task-id'); // Remplacez cela par votre propre logique pour obtenir l'ID de la tâche

        // Effectuez la requête AJAX
        $.ajax({
            url: "{{ route('tasks.mark-as-completed', ['task' => ':task']) }}".replace(':task',
                taskId),
            method: 'PATCH', // ou 'POST' si vous avez configuré votre route pour POST
            data: {
                _token: "{{ csrf_token() }}", // CSRF token
                task_id: taskId // ID de la tâche à marquer comme complétée
            },
            success: function(response) {
                // Réussite de la requête AJAX
                console.log(response
                .message); // Affichez le message de succès ou traitez-le comme nécessaire
                // Rafraîchissez ou mettez à jour l'interface utilisateur si nécessaire
            },
            error: function(xhr) {
                // Gestion des erreurs AJAX
                console.error('Erreur lors de la requête AJAX:', xhr
                .responseText); // Affichez l'erreur pour le débogage
            }
        });
    });

    // Fonction pour marquer une tâche comme complétée (exemple d'utilisation avec AJAX)
    $(document).ready(function() {
        // Intercepter la soumission du formulaire pour marquer la tâche comme complétée
        $('form[id^="mark-task-form"]').on('submit', function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du formulaire

            var form = $(this);
            var taskId = form.find('input[name="task_id"]').val();

            $.ajax({
                method: 'PATCH', // Utiliser la méthode PATCH ou POST comme nécessaire
                url: form.attr('action'),
                data: form.serialize(),
                success: function(response) {
                    // Une fois que la tâche est marquée comme complétée, masquer le bouton et afficher l'image du check circle
                    form.find('.mark-complete-btn').hide();
                    form.find('.check-circle').show();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>

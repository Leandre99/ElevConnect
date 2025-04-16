@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                @if ($fermes->count() > 0)
                    <div class="d-flex justify-content-between mb-4" style="margin-top:-6%">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFormulaire">
                            + Nouvelle Ferme
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#weatherModal">
                            Voir la météo
                        </button>
                    </div>

                    <div class="modal fade" id="modalFormulaire" tabindex="-1" aria-labelledby="modalFormulaireLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <style>
                                body {
                                    font-family: sans-serif;
                                    color: black;
                                }

                                h2 {
                                    text-align: center;
                                    margin-bottom: 20px;
                                }

                                label {
                                    display: block;
                                    margin-bottom: 5px;
                                }

                                input[type="text"],
                                input[type="number"],
                                select {
                                    width: 100%;
                                    padding: 10px;
                                    border: 1px solid #ccc;
                                    box-sizing: border-box;
                                }

                                textarea {
                                    width: 100%;
                                    height: 150px;
                                    padding: 10px;
                                    border: 1px solid #ccc;
                                    box-sizing: border-box;
                                }

                                button {
                                    background-color: #4CAF50;
                                    color: white;
                                    padding: 10px 20px;
                                    border: none;
                                    cursor: pointer;
                                    margin-top: 2%;
                                }

                                .btn-orange {
                                    background-color: orange;
                                    color: white;
                                }

                                .modal-footer {
                                    display: flex;
                                    justify-content: space-between;
                                    margin-top: 10px;
                                }
                            </style>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <img class="img-fluid" src="{{ asset('assets/images/plus.png') }}"
                                            style="width:7%; padding-right:2%">
                                        Ajouter une nouvelle Ferme
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ferme') }}" method="POST">
                                        Ce formulaire vous permet de créer une nouvelle ferme et d'ajouter les
                                        informations relatives à
                                        l'espèce principale d'animaux que vous élevez. Vous pourrez ensuite
                                        ajouter des animaux d'autres
                                        espèces ultérieurement.
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                        <label for="nomferme">Nom Ferme</label>
                                        <input type="text" id="nomferme" name="nomferme" required>
                                        <label for="description">Description</label>
                                        <input type="text" id="description" name="description" required>
                                        <label for="adresse">Adresse</label>
                                        <input type="text" id="adresse" name="adresse" required>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-orange" data-bs-dismiss="modal">Fermer
                                            </button>
                                            <button type="submit" class="btn btn-success">Enregistrer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="weatherModal" tabindex="-1" aria-labelledby="weatherModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="weatherModalLabel">Météo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe
                                        src="https://www.meteoblue.com/fr/meteo/widget/three/cotonou_b%c3%a9nin_2394819?geoloc=fixed&nocurrent=0&noforecast=0&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&layout=monochrome"
                                        frameborder="0" scrolling="NO" allowtransparency="true"
                                        sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox"
                                        style="width: 100%; height: 400px"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <a href="https://www.meteoblue.com/fr/meteo/semaine/cotonou_b%c3%a9nin_2394819?utm_source=three_widget&utm_medium=linkus&utm_content=three&utm_campaign=Weather%2BWidget"
                                        target="_blank" rel="noopener" class="btn btn-primary">Voir plus sur
                                        meteoblue</a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group">
                                    @foreach ($fermes as $ferme)
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <div>
                                                <h5 class="mb-1">{{ $ferme->nomferme }}</h5>
                                                <p class="mb-1">
                                                    <strong>Description:</strong>
                                                    <span class="description-truncate">{{ $ferme->description }}</span><br>
                                                    <strong>Adresse:</strong> {{ $ferme->adresse }}
                                                </p>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                <a href="{{ route('reports.index', $ferme->id) }}"
                                                    class="btn btn-info btn-sm me-2">
                                                    <i class="material-icons">insert_chart</i> Rapport
                                                </a>
                                                <a href="{{ route('tasks.index', $ferme->id) }}"
                                                    class="btn btn-success btn-sm me-2">
                                                    <i class="material-icons">tasks</i> Tâches
                                                </a>

                                                <a href="{{ route('fermes.edit', $ferme->id) }}"
                                                    class="btn btn-warning btn-sm me-2">
                                                    <i class="material-icons">edit</i> Modifier
                                                </a>
                                                <a href="{{ route('animals.index', $ferme->id) }}"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="material-icons">list_alt</i>Animaux
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center" style="margin-top:-5%">
                        <h1>
                            <img class="img-fluid" src="{{ asset('assets/images/field.png') }}"
                                style="width: 20%; filter: blur(3px); border-radius: 50%;">
                        </h1>
                        <h1 style="font-size: 25px;">Vous n'avez pas encore de ferme !</h1>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#modalFormulaire">
                            + Nouvelle Ferme
                        </button>
                    </div>

                    <div class="modal fade" id="modalFormulaire" tabindex="-1" aria-labelledby="modalFormulaireLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <style>
                                body {
                                    font-family: sans-serif;
                                    color: black;
                                }

                                h2 {
                                    text-align: center;
                                    margin-bottom: 20px;
                                }

                                label {
                                    display: block;
                                    margin-bottom: 5px;
                                }

                                input[type="text"],
                                input[type="number"],
                                select {
                                    width: 100%;
                                    padding: 10px;
                                    border: 1px solid #ccc;
                                    box-sizing: border-box;
                                }

                                textarea {
                                    width: 100%;
                                    height: 150px;
                                    padding: 10px;
                                    border: 1px solid #ccc;
                                    box-sizing: border-box;
                                }

                                button {
                                    background-color: #4CAF50;
                                    color: white;
                                    padding: 10px 20px;
                                    border: none;
                                    cursor: pointer;
                                    margin-top: 2%;
                                }

                                .btn-orange {
                                    background-color: orange;
                                    color: white;
                                }

                                .modal-footer {
                                    display: flex;
                                    justify-content: space-between;
                                    margin-top: 10px;
                                }
                            </style>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <img class="img-fluid" src="{{ asset('assets/images/plus.png') }}"
                                            style="width:7%; padding-right:2%">
                                        Ajouter une nouvelle Ferme
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ferme') }}" method="POST">
                                        Ce formulaire vous permet de créer une nouvelle ferme et d'ajouter les
                                        informations relatives à
                                        l'espèce principale d'animaux que vous élevez. Vous pourrez ensuite
                                        ajouter des animaux d'autres
                                        espèces ultérieurement.
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                        <label for="nomferme">Nom Ferme</label>
                                        <input type="text" id="nomferme" name="nomferme" required>
                                        <label for="description">Description</label>
                                        <input type="text" id="description" name="description" required>
                                        <label for="adresse">Adresse</label>
                                        <input type="text" id="adresse" name="adresse" required>

                                        <!-- Boutons à l'intérieur du formulaire -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Enregistrer</button>
                                            <button type="button" class="btn btn-orange"
                                                data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

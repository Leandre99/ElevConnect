@extends('layouts.app')

@section('content')
<section style="margin-top:-8%;">
    <h1 class="text-center">Nous souhaitons nous améliorer</h1>
</section>

<div class="container" style="margin-top:-8%; margin-bottom:5%">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="p-4 rounded shadow" id="form-outer" style="background-color: #f8f9fa; color: black;">
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
                        <label class="form-label">Est-ce que vous nous recommandez ?</label>
                        <div class="form-check">
                            <input type="radio" id="recommande1" name="recommande" value="1" class="form-check-input">
                            <label for="recommande1" class="form-check-label">Oui</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="recommande2" name="recommande" value="2" class="form-check-input">
                            <label for="recommande2" class="form-check-label">Peut-être</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="recommande3" name="recommande" value="3" class="form-check-input">
                            <label for="recommande3" class="form-check-label">Non</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="plus_aime" class="form-label">Ce que vous aimez le plus chez nous :</label>
                        <select id="plus_aime" name="plus_aime" class="form-select" required>
                            <option value="challenges">L'automatisation des taches</option>
                            <option value="projects">La gestion des alertes maladies</option>
                            <option value="community">Le rapport de performance</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ce que nous devons améliorer :</label>
                        <div class="form-check">
                            <input type="checkbox" id="preferences1" name="preferences[]" value="L'interface utilisateur" class="form-check-input">
                            <label for="preferences1" class="form-check-label">L'interface utilisateur</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="preferences2" name="preferences[]" value="Le rapport de performance" class="form-check-input">
                            <label for="preferences2" class="form-check-label">Le rapport de performance</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="preferences3" name="preferences[]" value="Présence sur les réseaux sociaux" class="form-check-input">
                            <label for="preferences3" class="form-check-label">Présence sur les réseaux sociaux</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="preferences4" name="preferences[]" value="Le formulaire de contact" class="form-check-input">
                            <label for="preferences4" class="form-check-label">La gestion des tâches</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="preferences5" name="preferences[]" value="Le service de messagerie" class="form-check-input">
                            <label for="preferences5" class="form-check-label">La gestion des alertes maladies</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="commentaires" class="form-label">Commentaires :</label>
                        <textarea id="commentaires" name="commentaires" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

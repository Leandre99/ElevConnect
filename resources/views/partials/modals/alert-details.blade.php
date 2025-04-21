<div class="modal fade" id="alertModal{{ $alert->id }}" tabindex="-1" aria-labelledby="alertModalLabel{{ $alert->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel{{ $alert->id }}">Détails de l'alerte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p><strong>Priorité :</strong> {{ $alert->priority }}</p>
                <p><strong>Description :</strong> {{ $alert->description }}</p>
                <p><strong>Race :</strong> {{ $alert->race->nomrace }}</p>
                <p><strong>Ferme :</strong> {{ $alert->ferme->nomferme }}</p>
                <p>@if ($alert->media)
                    <p><strong>Media:</strong></p>
                    <a href="{{ asset('storage/' . $alert->media) }}"
                        target="_blank">
                        <img src="{{ asset('storage/' . $alert->media) }}"
                            class="img-fluid" alt="Media">
                    </a>
                @endif</p>
            </div>
        </div>
    </div>
</div>

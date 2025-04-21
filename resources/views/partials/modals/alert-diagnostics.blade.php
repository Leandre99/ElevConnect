<div class="modal fade" id="alertDiagnosticsModal{{ $alert->id }}" tabindex="-1"
    aria-labelledby="diagnosticModalLabel{{ $alert->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="diagnosticModalLabel{{ $alert->id }}">
                    Diagnostic(s) pour Alerte #{{ $alert->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                @if ($alert->diagnostics->count() > 0)
                    @foreach ($alert->diagnostics as $diagnostic)
                        <div class="mb-3 border p-3 rounded bg-light">
                            <p><strong>Maladie :</strong>
                                {{ $diagnostic->maladie->nom }}</p>
                            <p><strong>Symptômes :</strong>
                                {{ $diagnostic->maladie->symptomes }}</p>
                            <p><strong>Traitement :</strong>
                                {{ $diagnostic->traitement ?? 'Non spécifié' }}</p>
                            <p><strong>Soumis le :</strong>
                                {{ $diagnostic->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Soumis par :</strong>
                                {{ $diagnostic->veterinaire->name ?? 'Vétérinaire inconnu' }}
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Aucun diagnostic enregistré pour cette
                        alerte.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>






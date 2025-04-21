<div class="modal fade" id="diagnosticModal{{ $alert->id }}" tabindex="-1"
    aria-labelledby="diagnosticModalLabel{{ $alert->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Fermer"></button>
            </div>
            <form action="{{ route('diagnostics.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="maladie_id{{ $alert->id }}"
                            class="form-label">Maladie</label>
                        <select name="maladie_id" id="maladie_id{{ $alert->id }}"
                            class="form-control" required>
                            @foreach ($maladies as $maladie)
                                <option value="{{ $maladie->id }}">
                                    {{ $maladie->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="symptomes_{{ $alert->id }}" class="form-label">Symptômes</label>
                        <textarea name="symptomes" id="symptomes_{{ $alert->id }}" class="form-control" required></textarea>
                    </div>                    
                    <div class="mb-3">
                        <label for="date{{ $alert->id }}"
                            class="form-label">Date</label>
                        <input type="date" name="date"
                            id="date{{ $alert->id }}" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="traitement{{ $alert->id }}"
                            class="form-label">Traitement recommandé</label>
                        <textarea name="traitement" id="traitement{{ $alert->id }}" class="form-control" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="alert_id"
                        value="{{ $alert->id }}">
                    <input type="hidden" name="ferme_id"
                        value="{{ $alert->ferme_id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Soumettre</button>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectMaladie = document.getElementById('maladie_id{{ $alert->id }}');
                        const symptomesField = document.getElementById('symptomes_{{ $alert->id }}');
                        selectMaladie.addEventListener('change', function() {
                            const maladieId = this.value;
                            if (maladieId) {
                                fetch(`/maladies/${maladieId}/symptomes`)
                                    .then(response => response.json())
                                    .then(data => {
                                        symptomesField.value = data.symptomes;
                                    });
                            } else {
                                symptomesField.value = '';
                            }
                        });
                        if (selectMaladie.value) {
                            selectMaladie.dispatchEvent(new Event('change'));
                        }
                    });
                </script>
            </form>
        </div>
    </div>
</div>

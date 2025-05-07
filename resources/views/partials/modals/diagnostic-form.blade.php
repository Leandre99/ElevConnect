<div class="modal fade" id="diagnosticModal{{ $alert->id }}" tabindex="-1"
    aria-labelledby="diagnosticModalLabel{{ $alert->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <form action="{{ route('diagnostics.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="maladie_id{{ $alert->id }}" class="form-label">Maladie</label>
                        <select name="maladie_id" id="maladie_id{{ $alert->id }}" class="form-control">
                            <option value="">-- Sélectionner une maladie --</option>
                            @foreach ($maladies as $maladie)
                                <option value="{{ $maladie->id }}">{{ $maladie->nom }}</option>
                            @endforeach
                            <option value="autre">Autre (nouvelle maladie)</option>
                        </select>
                    </div>
                    <div class="mb-3 d-none" id="autre_maladie_block_{{ $alert->id }}">
                        <label for="nouvelle_maladie_{{ $alert->id }}" class="form-label">Nom de la nouvelle
                            maladie</label>
                        <input type="text" name="nouvelle_maladie" id="nouvelle_maladie_{{ $alert->id }}"
                            class="form-control">
                    </div>
                    <div class="mb-3" id="symptomes_block_{{ $alert->id }}">
                        <label for="symptomes_{{ $alert->id }}" class="form-label">Symptômes</label>
                        <textarea name="symptomes" id="symptomes_{{ $alert->id }}" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="traitement{{ $alert->id }}" class="form-label">Traitement recommandé</label>
                        <textarea name="traitement" id="traitement{{ $alert->id }}" class="form-control" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="alert_id" value="{{ $alert->id }}">
                    <input type="hidden" name="ferme_id" value="{{ $alert->ferme_id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Soumettre</button>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectMaladie = document.getElementById('maladie_id{{ $alert->id }}');
                        const symptomesField = document.getElementById('symptomes_{{ $alert->id }}');
                        const autreMaladieBlock = document.getElementById('autre_maladie_block_{{ $alert->id }}');
                        const nouvelleMaladieInput = document.getElementById('nouvelle_maladie_{{ $alert->id }}');

                        selectMaladie.addEventListener('change', function() {
                            const selected = this.value;

                            if (selected === "autre") {
                                autreMaladieBlock.classList.remove("d-none");
                                symptomesField.value = '';
                                symptomesField.removeAttribute("readonly");
                            } else {
                                autreMaladieBlock.classList.add("d-none");
                                if (selected) {
                                    fetch(`/maladies/${selected}/symptomes`)
                                        .then(response => response.json())
                                        .then(data => {
                                            symptomesField.value = data.symptomes;
                                            symptomesField.setAttribute("readonly", true);
                                        });
                                } else {
                                    symptomesField.value = '';
                                    symptomesField.removeAttribute("readonly");
                                }
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

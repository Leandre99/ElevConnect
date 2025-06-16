@extends('layouts.admin_layout')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-success">Liste des Diagnostics</h2>

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <span><strong>Diagnostics enregistrés</strong></span>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Maladie</th>
                                <th>Symptômes</th>
                                <th>Traitement</th>
                                <th>Vétérinaire</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnostics as $diagnostic)
                                <tr>
                                    <td>{{ $diagnostic->id }}</td>
                                    <td>
                                        {{ $diagnostic->maladie->nom ?? ($diagnostic->nom_autre_maladie ?? 'Non spécifiée') }}
                                    </td>
                                    <td>
                                        {{ $diagnostic->maladie->symptomes ?? ($diagnostic->symptomes_autre ?? 'Non spécifiés') }}
                                    </td>
                                    <td>{{ $diagnostic->traitement ?? 'N/A' }}</td>
                                    <td>{{ $diagnostic->veterinaire->name ?? 'N/A' }}</td>
                                    <td>{{ $diagnostic->created_at->format('d/m/Y H:i') ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.diagnostics.destroy', $diagnostic->id) }}"
                                            method="POST" class="d-inline" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Supprimer">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Confirmer la suppression ?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const selectMaladie = document.getElementById('maladie_id_{{ $diagnostic->id }}');
                                        const symptomesCell = document.getElementById('symptomes_{{ $diagnostic->id }}');

                                        selectMaladie.addEventListener('change', function() {
                                            const maladieId = this.value;
                                            if (maladieId) {
                                                fetch(`/maladies/${maladieId}/symptomes`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        symptomesCell.textContent = data
                                                            .symptomes;
                                                    });
                                            } else {
                                                symptomesCell.textContent = 'Aucun symptôme';
                                            }
                                        });
                                        if (selectMaladie.value) {
                                            selectMaladie.dispatchEvent(new Event('change'));
                                        }
                                    });
                                </script>
                            @endforeach

                            @if ($diagnostics->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Aucun diagnostic enregistré.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
@endpush

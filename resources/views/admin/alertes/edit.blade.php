@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Détails de l'Alerte</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <strong>Alerte #{{ $alerte->id }}</strong>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label"><strong>Message :</strong></label>
                <p class="form-control-plaintext">{{ $alerte->message ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Utilisateur :</strong></label>
                <p class="form-control-plaintext">{{ $alerte->user->name ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Race :</strong></label>
                <p class="form-control-plaintext">{{ $alerte->race->nom ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Date :</strong></label>
                <p class="form-control-plaintext">{{ $alerte->created_at->format('d/m/Y H:i') ?? 'N/A' }}</p>
            </div>

            <a href="{{ route('admin.alertes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>
</div>
@endsection

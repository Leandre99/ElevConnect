@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-users fa-2x text-success"></i>
                <h6 class="mt-2">Éleveurs</h6>
                <p class="fw-bold fs-5">{{ $eleveurCount }}</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-user-md fa-2x text-success"></i>
                <h6 class="mt-2">Vétérinaires</h6>
                <p class="fw-bold fs-5">{{ $veterinaireCount }}</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-warehouse fa-2x text-success"></i>
                <h6 class="mt-2">Fermes</h6>
                <p class="fw-bold fs-5">{{ $farmCount }}</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-leaf fa-2x text-success"></i>
                <h6 class="mt-2">Espèces</h6>
                <p class="fw-bold fs-5">{{ $especeCount }}</p>
            </div>
        </div>

        <!-- Ligne 2 -->
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-paw fa-2x text-success"></i>
                <h6 class="mt-2">Races</h6>
                <p class="fw-bold fs-5">{{ $raceCount }}</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-virus fa-2x text-success"></i>
                <h6 class="mt-2">Maladies</h6>
                <p class="fw-bold fs-5">{{ $maladieCount }}</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-bell fa-2x text-success"></i>
                <h6 class="mt-2">Alertes</h6>
                <p class="fw-bold fs-5">{{ $alerteCount }}</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-stethoscope fa-2x text-success"></i>
                <h6 class="mt-2">Diagnostics</h6>
                <p class="fw-bold fs-5">{{ $diagnosticCount }}</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-tasks fa-2x text-success"></i>
                <h6 class="mt-2">Tâches</h6>
                <p class="fw-bold fs-5">{{ $tacheCount }}</p>
            </div>
        </div>
        
    </div>
</div>
@endsection

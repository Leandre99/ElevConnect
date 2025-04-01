@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-users fa-2x text-success"></i>
                <h6 class="mt-2">Éleveurs</h6>
                <p class="fw-bold fs-5">{{ $eleveurCount }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-user-md fa-2x text-success"></i>
                <h6 class="mt-2">Vétérinaires</h6>
                <p class="fw-bold fs-5">{{ $veterinaireCount }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-warehouse fa-2x text-success"></i>
                <h6 class="mt-2">Fermes</h6>
                <p class="fw-bold fs-5">{{ $farmCount }}</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-leaf fa-2x text-success"></i>
                <h6 class="mt-2">Espèces</h6>
                <p class="fw-bold fs-5">{{ $especeCount }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-paw fa-2x text-success"></i>
                <h6 class="mt-2">Races</h6>
                <p class="fw-bold fs-5">{{ $raceCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

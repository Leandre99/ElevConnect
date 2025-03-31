@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-users fa-2x text-success"></i>
                <h6 class="mt-2">Personnel</h6>
                <p class="fw-bold fs-5">34</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-paw fa-2x text-success"></i>
                <h6 class="mt-2">Animaux</h6>
                <p class="fw-bold fs-5">120</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-warehouse fa-2x text-success"></i>
                <h6 class="mt-2">Fermes</h6>
                <p class="fw-bold fs-5">5</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="fas fa-bell fa-2x text-success"></i>
                <h6 class="mt-2">Alertes</h6>
                <p class="fw-bold fs-5">8</p>
            </div>
        </div>
    </div>
</div>
@endsection

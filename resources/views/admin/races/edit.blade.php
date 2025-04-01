@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Modifier la Race</h2>
    
    <form action="{{ route('admin.races.update', $race->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="mb-3">
                    <label for="espece_id" class="form-label">Espèce</label>
                    <select class="form-control" id="espece_id" name="espece_id" required>
                        @foreach ($especes as $espece)
                            <option value="{{ $espece->id }}" {{ $race->espece_id == $espece->id ? 'selected' : '' }}>
                                {{ $espece->nomespece }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nomrace" class="form-label">Nom de la Race</label>
                    <input type="text" class="form-control" id="nomrace" name="nomrace" value="{{ $race->nomrace }}" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <a href="{{ route('admin.races.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

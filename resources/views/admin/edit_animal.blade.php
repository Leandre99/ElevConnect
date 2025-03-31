@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4><i class="fas fa-edit"></i> Modifier un animal</h4>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="race_id" class="form-label">Race:</label>
                    <select name="race_id" id="race_id" class="form-select">
                        @foreach($races as $race)
                            <option value="{{ $race->id }}" {{ $animal->race_id == $race->id ? 'selected' : '' }}>
                                {{ $race->nomrace }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ferme_id" class="form-label">Ferme:</label>
                    <select name="ferme_id" id="ferme_id" class="form-select">
                        @foreach($fermes as $ferme)
                            <option value="{{ $ferme->id }}" {{ $animal->ferme_id == $ferme->id ? 'selected' : '' }}>
                                {{ $ferme->nomferme }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Âge:</label>
                    <input type="number" name="age" id="age" value="{{ old('age', $animal->age) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="number" name="nombre" id="nombre" value="{{ old('nombre', $animal->nombre) }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection

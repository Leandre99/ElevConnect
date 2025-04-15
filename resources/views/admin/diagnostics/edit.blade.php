@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Modifier le Diagnostic</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.diagnostics.update', $diagnostic->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="maladie_id" class="form-label">Maladie</label>
                    <select name="maladie_id" id="maladie_id" class="form-select" required>
                        @foreach($maladies as $maladie)
                            <option value="{{ $maladie->id }}" @if($maladie->id == $diagnostic->maladie_id) selected @endif>
                                {{ $maladie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <textarea name="description" id="description" class="form-control" required>{{ $diagnostic->description }}</textarea>
                        <label for="description">Description</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.diagnostics.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

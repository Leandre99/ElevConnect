<form action="{{ route('diagnostics.store', $animal) }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>Maladie</label>
        <select name="maladie_id" class="form-control">
            @foreach($maladies as $maladie)
                <option value="{{ $maladie->id }}">{{ $maladie->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Nombre de cas (max: {{ $animal->nombre }})</label>
        <input type="number" name="nombre_cas" class="form-control"
               min="1" max="{{ $animal->nombre }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
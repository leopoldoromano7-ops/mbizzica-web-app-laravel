<form method="GET" action="{{ route('pastes.index') }}" class="filter-form">
    <div class="field-group">
        <label for="q" class="form-label">Ricerca</label>
        <input class="form-control" type="text" id="q" name="q" placeholder="Cerca per titolo o contenuto" value="{{ request('q') }}">
    </div>

    <div class="field-group">
        <label for="tag" class="form-label">Tag</label>
        <select id="tag" name="tag" class="form-select">
            <option value="">Tutti</option>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-neon w-100" type="submit">Filtra archivio</button>
</form>

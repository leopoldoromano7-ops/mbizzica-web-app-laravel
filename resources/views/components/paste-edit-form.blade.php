<section class="editor-layout">
    <article class="surface-panel editor-panel">
        <p class="section-kicker">Edit mode</p>
        <h2>Aggiorna il contenuto</h2>

        <form method="POST" action="{{ route('paste.update', $paste->id) }}" enctype="multipart/form-data" class="stack-form">
            @csrf
            @method('PUT')

            <div class="field-group">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $paste->title) }}">
            </div>

            <div class="field-group">
                <label for="content" class="form-label">Contenuto</label>
                <div class="code-input-shell">
                    <div class="code-toolbar">
                        <div class="window-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <span>editing session</span>
                    </div>
                    <textarea class="form-control" cols="30" rows="10" id="content" name="content">{{ old('content', $paste->content) }}</textarea>
                </div>
            </div>

            <div class="field-group">
                <label class="form-label">Visibilita</label>
                <div class="visibility-grid">
                    <label class="radio-chip">
                        <input type="radio" name="visibility" value="0" {{ old('visibility', $paste->visibility) == 0 ? 'checked' : '' }}>
                        <span>Pubblico</span>
                    </label>
                    <label class="radio-chip">
                        <input type="radio" name="visibility" value="1" {{ old('visibility', $paste->visibility) == 1 ? 'checked' : '' }}>
                        <span>Privato</span>
                    </label>
                    <label class="radio-chip">
                        <input type="radio" name="visibility" value="2" {{ old('visibility', $paste->visibility) == 2 ? 'checked' : '' }}>
                        <span>Non elencato</span>
                    </label>
                </div>
            </div>

            <div class="field-group field-group--split">
                <div class="field-group">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', $paste->tags->pluck('name')->implode(', ')) }}">
                </div>

                <div class="field-group">
                    <label for="attachment" class="form-label">Nuovo allegato</label>
                    <input type="file" class="form-control" id="attachment" name="attachment">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-neon">Aggiorna</button>
            </div>
        </form>
    </article>

    <aside class="surface-panel helper-panel">
        <p class="section-kicker">Update notes</p>
        <h2>Mantieni il controllo</h2>

        <ul class="helper-list">
            <li>
                <strong>File testuale</strong>
                Se cambi il contenuto, il file esportabile viene rigenerato con la logica attuale.
            </li>
            <li>
                <strong>Tag allineati</strong>
                I tag restano modificabili nello stesso campo comma separated.
            </li>
            <li>
                <strong>Pubblicazione flessibile</strong>
                Le opzioni di visibilita non cambiano, cambia solo il modo in cui vengono presentate.
            </li>
        </ul>
    </aside>
</section>

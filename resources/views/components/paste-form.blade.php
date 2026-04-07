<section class="editor-layout">
    <article class="surface-panel editor-panel">
        <p class="section-kicker">Compose</p>
        <h2>Nuovo contenuto</h2>

        <form method="POST" action="{{ route('paste.store') }}" enctype="multipart/form-data" class="stack-form">
            @csrf

            <div class="field-group">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Dai un nome chiaro al paste">
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
                        <span>plain text editor</span>
                    </div>
                    <textarea class="form-control" cols="30" rows="10" id="content" name="content" placeholder="Scrivi o incolla qui il contenuto del tuo paste">{{ old('content') }}</textarea>
                </div>
            </div>

            <div class="field-group">
                <label class="form-label">Visibilita</label>
                <div class="visibility-grid">
                    <label class="radio-chip">
                        <input type="radio" name="visibility" value="0" checked>
                        <span>Pubblico</span>
                    </label>
                    <label class="radio-chip">
                        <input type="radio" name="visibility" value="2">
                        <span>Non elencato</span>
                    </label>
                    @auth
                        <label class="radio-chip">
                            <input type="radio" name="visibility" value="1">
                            <span>Privato</span>
                        </label>
                    @endauth
                </div>
            </div>

            <div class="field-group field-group--split">
                <div class="field-group">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags') }}" placeholder="es. backend, app, release">
                </div>

                <div class="field-group">
                    <label for="attachment" class="form-label">Allegato</label>
                    <input type="file" class="form-control" id="attachment" name="attachment">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-neon">Invia</button>
            </div>
        </form>
    </article>

    <aside class="surface-panel helper-panel">
        <p class="section-kicker">Publishing guide</p>
        <h2>Come apparira</h2>

        <ul class="helper-list">
            <li>
                <strong>Titolo leggibile</strong>
                Un nome chiaro aiuta a ritrovare il paste piu velocemente nel feed.
            </li>
            <li>
                <strong>Visibilita rapida</strong>
                Pubblico, non elencato e privato restano gli stessi flussi gia previsti.
            </li>
            <li>
                <strong>Extra asset</strong>
                Puoi allegare un file senza uscire dall'editor principale.
            </li>
        </ul>
    </aside>
</section>

<section class="auth-shell">
    <article class="surface-panel auth-panel">
        <form method="POST" action="/two-factor-challenge" class="stack-form">
            @csrf

            <div class="field-group">
                <label for="code" class="form-label">Codice a 6 cifre</label>
                <input id="code" name="code" type="text" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-neon">Conferma</button>
        </form>
    </article>
</section>

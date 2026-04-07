<x-layout>
    <main class="page-shell page-shell--narrow">
        <section class="surface-panel page-hero page-hero--compact">
            <div>
                <p class="section-kicker">Reset</p>
                <h1>Nuova password</h1>
                <p class="page-lead">Aggiorna le credenziali dentro una card piu leggibile e coerente con il resto dell'app.</p>
            </div>
        </section>

        <section class="auth-shell">
            <article class="surface-panel auth-panel">
                <form method="POST" action="{{ route('password.update') }}" class="stack-form">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="field-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="field-group">
                        <label for="password" class="form-label">Nuova password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="field-group">
                        <label for="password_confirmation" class="form-label">Conferma password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-neon">Reset password</button>
                </form>
            </article>
        </section>
    </main>
</x-layout>

<x-layout>
    <main class="page-shell page-shell--narrow">
        <section class="surface-panel page-hero page-hero--compact">
            <div>
                <p class="section-kicker">Recovery</p>
                <h1>Password dimenticata</h1>
                <p class="page-lead">Invia la tua email e riceverai un link per reimpostare l'accesso.</p>
            </div>
        </section>

        <section class="auth-shell">
            <article class="surface-panel auth-panel">
                <form method="POST" action="{{ route('password.email') }}" class="stack-form">
                    @csrf
                    <div class="field-group">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Reimposta la password</button>
                </form>
            </article>
        </section>

        @if(session('status'))
            <div class="alert alert-success status-banner mt-4">
                {{ session('status') }}
            </div>
        @endif

        @error('email')
            <div class="alert alert-danger status-banner mt-4">
                {{ $message }}
            </div>
        @enderror
    </main>
</x-layout>

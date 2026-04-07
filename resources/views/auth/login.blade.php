<x-layout>
    <main class="page-shell page-shell--narrow">
        <section class="surface-panel page-hero page-hero--compact">
            <div>
                <p class="section-kicker">Access</p>
                <h1>Login</h1>
                <p class="page-lead">Accedi con una vista piu pulita e tecnica, allineata al resto della workspace.</p>
            </div>
        </section>

        <x-login-form />

        <p class="auth-links">Non hai un account? <a href="{{ route('register') }}">Registrati</a></p>
        <p class="auth-links"><a href="{{ route('password.request') }}">Hai dimenticato la password?</a></p>
    </main>
</x-layout>

<x-layout>
    <main class="page-shell page-shell--narrow">
        <section class="surface-panel page-hero page-hero--compact">
            <div>
                <p class="section-kicker">Create account</p>
                <h1>Registrazione</h1>
                <p class="page-lead">Un onboarding piu coerente con il nuovo tema, senza toccare il flusso di autenticazione.</p>
            </div>
        </section>

        <x-registration-form />

        <p class="auth-links">Hai gia un account? <a href="{{ route('login') }}">Accedi</a></p>
    </main>
</x-layout>

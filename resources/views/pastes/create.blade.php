<x-layout>
    <main class="page-shell">
        @if (session('status'))
            <div class="alert alert-success status-banner">
                {{ session('status') }}
            </div>
        @endif

        <section class="surface-panel page-hero page-hero--compact">
            <div>
                <p class="section-kicker">Create</p>
                <h1>Crea nuovo paste</h1>
                <p class="page-lead">Editor scuro, tipografia piu tecnica e controlli raccolti in una shell unica, senza cambiare il comportamento del form.</p>
            </div>

            <a href="{{ route('pastes.index') }}" class="btn btn-ghost">Vai all'archivio</a>
        </section>

        <x-paste-form />
    </main>
</x-layout>

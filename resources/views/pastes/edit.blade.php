<x-layout>
    <main class="page-shell">
        <section class="surface-panel page-hero page-hero--compact">
            <div>
                <p class="section-kicker">Edit</p>
                <h1>Modifica il paste</h1>
                <p class="page-lead">Stessa logica di aggiornamento, ma dentro una superficie piu coerente con il nuovo linguaggio visivo.</p>
            </div>

            <a href="{{ route('paste.show', $paste->url) }}" class="btn btn-ghost">Torna al dettaglio</a>
        </section>

        <x-paste-edit-form :paste="$paste" />
    </main>
</x-layout>

<x-layout>
    <main class="page-shell">
        @if (session('status'))
            <div class="alert alert-success status-banner">
                {{ session('status') }}
            </div>
        @endif

        <section class="surface-panel page-hero page-hero--compact">
            <div>
                <p class="section-kicker">Paste detail</p>
                <h1>{{ $paste->title }}</h1>
                <p class="page-lead">Vista estesa del contenuto, con allegati, commenti e azioni mantenuti nello stesso flusso operativo.</p>
            </div>

            <a href="{{ route('pastes.index') }}" class="btn btn-ghost">Torna all'archivio</a>
        </section>

        <section class="stack-layout">
            <x-paste-card :paste="$paste" />
        </section>
    </main>
</x-layout>

<x-layout>
        <main class="page-shell">
            <section class="surface-panel page-hero">
                <div>
                    <p class="section-kicker">Archive</p>
                    <h1>Tutti i paste</h1>
                    <p class="page-lead">Lista, filtra e apri i contenuti in una workspace piu vicina a un paste editor, lasciando intatte logiche e flussi esistenti.</p>
                </div>

                <div class="hero-metrics">
                    <div class="metric-card">
                        <strong>{{ $pastes->count() }}</strong>
                        <span>paste visibili ora</span>
                    </div>
                    <div class="metric-card">
                        <strong>{{ $tags->count() }}</strong>
                        <span>tag disponibili</span>
                    </div>
                    <div class="metric-card">
                        <strong>{{ request()->filled('q') || request()->filled('tag') ? 'ON' : 'OFF' }}</strong>
                        <span>filtro attivo</span>
                    </div>
                </div>
            </section>

            <section class="workspace-grid">
                <aside class="workspace-sidebar">
                    <div class="surface-panel sticky-panel">
                        <p class="section-kicker">Filters</p>
                        <h2>Affina il feed</h2>
                        <p class="page-lead">Ricerca rapida e filtro per tag, con lo stesso contenuto di prima ma in un pannello dedicato.</p>

                        <x-paste-filter-form :tags="$tags" />
                    </div>
                </aside>

                <div class="workspace-main">
                    <div class="surface-panel panel-header-inline">
                        <div>
                            <p class="section-kicker">Stream</p>
                            <h2>Archivio attivo</h2>
                        </div>

                        <a href="{{ route('pastes.create') }}" class="btn btn-neon">Nuovo paste</a>
                    </div>

                    <div class="paste-list">
                        @forelse ($pastes as $paste)
                            <x-paste-card :paste="$paste" />
                        @empty
                            <article class="surface-panel empty-state">
                                <p class="section-kicker">Empty state</p>
                                <h2>Nessun paste trovato.</h2>
                                <p class="page-lead mb-0">Prova a cambiare filtro oppure crea un nuovo contenuto.</p>
                            </article>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>
</x-layout>

<x-layout>
    <main class="page-shell">
        <section class="hero-grid">
            <article class="surface-panel page-hero home-hero-copy">
                <div>
                    <p class="section-kicker">Dark paste workspace</p>
                    <h1>Condividi testo, file e snippet in una dashboard piu nitida.</h1>
                    <p class="page-lead">Mbizzica prende il feeling di un paste tool tecnico e lo reinterpreta con un'identita che rende: pannelli compatti, contenuti leggibili e accenti neon ben definiti.</p>
                </div>

                <div class="hero-actions">
                    <a href="{{ route('pastes.index') }}" class="btn btn-neon">Apri l'archivio</a>
                    <a href="{{ route('pastes.create') }}" class="btn btn-ghost">Crea un paste</a>
                </div>
            </article>

            <article class="surface-panel terminal-panel">
                <div class="window-bar">
                    <div class="window-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span>live-preview.txt</span>
                </div>
                <pre class="terminal-code">Title: deploy-notes
Visibility: public
Tags: release, backend, notes

1. Apri l'editor.
2. Incolla contenuto o allega un file.
3. Pubblica e condividi il link.</pre>
            </article>
        </section>
    </main>
</x-layout>

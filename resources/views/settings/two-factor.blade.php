<x-layout>
    <main class="page-shell">
        <section class="surface-panel page-hero page-hero--compact">
            <div>
                <p class="section-kicker">Settings</p>
                <h1>Le tue impostazioni</h1>
                <p class="page-lead">Pannello dedicato alla sicurezza dell'account, riallineato allo stesso linguaggio visivo del resto dell'app.</p>
            </div>
        </section>

        <section class="settings-grid">
            <article class="surface-panel settings-panel">
                <p class="section-kicker">Security</p>
                <h2>2FA</h2>
                <x-two-factor-setting-form />
            </article>

            <aside class="surface-panel helper-panel">
                <p class="section-kicker">Why it matters</p>
                <h2>Protezione extra</h2>

                <ul class="helper-list">
                    <li>
                        <strong>Accesso piu sicuro</strong>
                        Un secondo fattore riduce il rischio di accessi non autorizzati.
                    </li>
                    <li>
                        <strong>Attivazione semplice</strong>
                        Il flusso resta lo stesso, ma dentro un layout piu leggibile.
                    </li>
                    <li>
                        <strong>Controllo immediato</strong>
                        Stato attivo, conferma e disattivazione sono separati con gerarchia piu chiara.
                    </li>
                </ul>
            </aside>
        </section>
    </main>
</x-layout>

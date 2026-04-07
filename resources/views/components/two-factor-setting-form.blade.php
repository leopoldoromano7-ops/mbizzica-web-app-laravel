@if (session('status'))
    <div class="alert alert-success status-banner">
        {{ session('status') }}
    </div>
@endif

@if (!auth()->user()->two_factor_secret)
    <div class="settings-stack">
        <p class="page-lead mb-0">La 2FA non e attiva. Puoi abilitarla per proteggere meglio il tuo account.</p>

        <form method="POST" action="/user/two-factor-authentication">
            @csrf
            <button type="submit" class="btn btn-neon">
                Abilita la 2FA
            </button>
        </form>
    </div>
@endif

@if (auth()->user()->two_factor_secret && !auth()->user()->two_factor_confirmed_at)
    <div class="settings-stack">
        <p class="page-lead mb-0">Scansiona il QR code e inserisci il codice a 6 cifre per completare l'attivazione.</p>

        <div class="qr-shell">
            {!! auth()->user()->twoFactorQrCodeSvg() !!}
        </div>

        <form method="POST" action="/user/confirmed-two-factor-authentication" class="stack-form">
            @csrf

            <div class="field-group">
                <label for="code" class="form-label">Codice di conferma</label>
                <input type="text" id="code" name="code" class="form-control" placeholder="Codice 6 cifre" required autocomplete="one-time-code">
            </div>

            <button type="submit" class="btn btn-neon">
                Conferma
            </button>
        </form>
    </div>
@endif

@if (auth()->user()->two_factor_confirmed_at)
    <div class="settings-stack">
        <span class="status-chip">2FA attiva</span>
        <p class="page-lead mb-0">La verifica a due fattori e gia abilitata sul tuo account.</p>

        <form method="POST" action="/user/two-factor-authentication">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Disabilita 2FA
            </button>
        </form>
    </div>
@endif

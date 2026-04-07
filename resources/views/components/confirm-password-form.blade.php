<section class="auth-shell">
  <article class="surface-panel auth-panel">
    <form action="{{ route('password.confirm') }}" method="POST" class="stack-form">
      @csrf

      <div class="field-group">
        <label for="password" class="form-label">Conferma password</label>
        <input type="password" class="form-control" id="password" placeholder="Usa caratteri speciali ed altro" name="password">
      </div>

      <button type="submit" class="btn btn-neon">Conferma</button>
    </form>
  </article>
</section>

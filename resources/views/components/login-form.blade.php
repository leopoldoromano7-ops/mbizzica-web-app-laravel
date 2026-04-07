<section class="auth-shell">
  <article class="surface-panel auth-panel">
    <form method="POST" action="{{ route('login') }}" class="stack-form">
      @csrf

      <div class="field-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="la tua email" name="email">
      </div>

      <div class="field-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Usa caratteri speciali ed altro" name="password">
      </div>

      <button type="submit" class="btn btn-neon">Entra</button>
    </form>
  </article>
</section>

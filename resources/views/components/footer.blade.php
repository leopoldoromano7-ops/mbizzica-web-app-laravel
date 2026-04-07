<footer class="site-footer">
  <div class="shell-container">
    <div class="surface-panel footer-panel">
      <div class="footer-copy">
        <p class="section-kicker">Newsletter</p>
        <h2>Resta nel flusso senza uscire dalla console.</h2>
        <p class="page-lead mb-0">Aggiornamenti, novita e reminder in un blocco semplice e veloce, con lo stesso mood dell'interfaccia.</p>
      </div>

      <form action="{{ route('send.email') }}" method="POST" class="footer-form">
        @csrf
        <input type="text" name="username" class="form-control" placeholder="Nome" required>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <button type="submit" class="btn btn-neon">Iscriviti</button>
      </form>
    </div>
  </div>
</footer>

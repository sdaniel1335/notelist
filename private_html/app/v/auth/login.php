<section class="login-card">
  <h1>Belépés</h1>
  <form method="post" action="<?php echo url('/login'); ?>">
    <input type="hidden" name="_csrf" value="<?php echo note_html(auth_csrf_token()); ?>">
    <label for="username">Felhasználónév</label>
    <input id="username" name="username" maxlength="100" autocomplete="username" required autofocus>
    <label for="password">Jelszó</label>
    <input type="password" id="password" name="password" autocomplete="current-password" required>
    <button class="primary" type="submit">Belépés</button>
  </form>
</section>

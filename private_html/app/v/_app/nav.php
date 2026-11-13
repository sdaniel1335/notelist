<nav>
  <a class="brand" href="<?php echo url('/'); ?>">Notelist</a>
  <?php if (auth_logged_in()) { ?>
    <span class="user"><?php echo note_html(auth_username()); ?></span>
    <form method="post" action="<?php echo url('/logout'); ?>">
      <input type="hidden" name="_csrf" value="<?php echo note_html(auth_csrf_token()); ?>">
      <button type="submit">Kilépés</button>
    </form>
  <?php } ?>
</nav>

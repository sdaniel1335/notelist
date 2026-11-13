<div class="page-heading"><a href="<?php echo url('/'); ?>">← Jegyzetek</a><span id="save-status" role="status"></span></div>
<?php if ($error !== '') { ?><p class="alert alert-danger" role="alert"><?php echo note_html($error); ?></p><?php } ?>
<section class="notepad">
  <form method="post" action="<?php echo url('/note/save'); ?>" id="note-form">
    <input type="hidden" name="_csrf" value="<?php echo note_html(auth_csrf_token()); ?>">
    <input type="hidden" name="id" value="<?php echo (int) $note['id']; ?>">
    <div class="editor-toolbar">
      <div class="title-field"><label for="note-title">Cím / átnevezés</label><input id="note-title" name="title" value="<?php echo note_html($note['title']); ?>" maxlength="255" required placeholder="Névtelen jegyzet" <?php echo $note['id'] ? '' : 'autofocus'; ?>></div>
      <div><label for="list-key">Lista</label><select id="list-key" name="list_key"><?php foreach (array('B', 'P', 'W') as $list_key) { ?><option value="<?php echo $list_key; ?>" <?php echo $note['list_key'] === $list_key ? 'selected' : ''; ?>><?php echo $list_key; ?></option><?php } ?></select></div>
      <button class="primary" type="submit">Mentés</button>
    </div>
    <label class="sr-only" for="note-content">Jegyzet szövege</label>
    <textarea id="note-content" name="content" spellcheck="false" placeholder="Írj ide…"><?php echo note_html($note['content']); ?></textarea>
    <div class="editor-status">Egyszerű szöveg <span id="character-count"></span></div>
  </form>
</section>
<?php if ($note['id']) { ?>
<form method="post" action="<?php echo url('/note/delete'); ?>" class="delete-form" data-confirm="Biztosan törlöd ezt a jegyzetet?">
  <input type="hidden" name="_csrf" value="<?php echo note_html(auth_csrf_token()); ?>">
  <input type="hidden" name="id" value="<?php echo (int) $note['id']; ?>">
  <button class="danger" type="submit">Jegyzet törlése</button>
</form>
<?php } ?>

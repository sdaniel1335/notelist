<div class="page-heading"><h1>Jegyzetek</h1><a class="button primary" href="<?php echo url('/note'); ?>">+ Új jegyzet</a></div>
<div class="note-lists">
<?php $has_notes = false; foreach ($groups as $list_key => $notes) { if (!$notes) { continue; } $has_notes = true; ?>
  <section class="note-list" aria-labelledby="list-<?php echo $list_key; ?>">
    <div class="list-heading"><h2 id="list-<?php echo $list_key; ?>"><?php echo $list_key; ?> <small><?php echo count($notes); ?></small></h2><a href="<?php echo url('/note?list=' . $list_key); ?>" aria-label="Új jegyzet: <?php echo $list_key; ?>">+ Új</a></div>
    <ul>
    <?php foreach ($notes as $note) { ?>
      <li><a class="note-link" href="<?php echo url('/note?id=' . (int) $note['id']); ?>"><span aria-hidden="true">▤</span> <?php echo note_html($note['title']); ?></a></li>
    <?php } ?>
    </ul>
  </section>
<?php } ?>
</div>
<?php if (!$has_notes) { ?><div class="empty-state"><h2>Még nincs jegyzeted.</h2><p>Hozz létre egyet a B, P vagy W listában.</p></div><?php } ?>

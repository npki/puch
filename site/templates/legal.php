<?php snippet('header') ?>
<section class="grid">
  <article class="start-2 col-11">
    <h1><?= $page->title() ?></h1>
    <?= $page->text() ?>
  </article>
</section>
<section class="grid">
  <article class="col-11 start-2">
    <a class="back" href="<?= $site->url() ?>">Zurück zur Startseite</a>
  </article>
</section>

<?php snippet('footer') ?>
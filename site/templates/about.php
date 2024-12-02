<?php snippet('header') ?>
<section class="indent about-page">
  <p>
    <span class="name" data-show-image><?= $page->name()->html() ?></span>
    <span><?= $page->text() ?></span>
  </p>            
  <a href="mailto:<?= $page->email() ?>"><?= $page->email() ?></a><br>
  <a href="tel:+<?= $page->phone() ?>">+(49) 162 202 90 54</a>

  <?php $avatar = $page->picture()->toFile(); ?>
  <?php if ($avatar): ?>
    <div class="centered-image" data-portrait-image>
      <img src="<?= $avatar->url() ?>" alt="Louis Dickhaut">
    </div>
  <?php endif; ?>
</section>
<?php snippet('footer') ?>
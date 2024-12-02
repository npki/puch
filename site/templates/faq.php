<?php snippet('header') ?>

<div class="grid">
  <section class="start-2 col-10 intro">
    <article>
      <h1>FAQ</h1>
      <p class="intro-text">
        <?= $page->introText(); ?>
      </p>
    </article>
  </section>

  <?php foreach ($page->faqs()->toStructure() as $faq): ?>
  <section class="col-12" id="<?= strtolower($faq->title()) ?>">
    <article class="grid" data-question-item>
      <h2 data-question class="start-2 col-10 question"><?= $faq->question() ?></h2>
      <div class="box col-12" data-answer>          
        <div class="head"></div>
        <div class="body">
          <div class="message">              
            <p><?= $faq->answer() ?></p>
          </div>
        </div>
      </div>
    </article>
  </section>
  <?php endforeach ?>

  <section class="col-11 start-2">
    <a class="back" href="<?= $site->url() ?>">Zurück zur Startseite</a>
  </section>

</div> <!-- end grid -->
<?php snippet('footer') ?>
<?php snippet('header') ?>

<div class="gradient" data-background></div>
<div class="cursor" data-cursor>
  <span></span>
</div>


<div class="grid">

  <div class="col-6">
    <?php snippet('player') ?>
    <figure class="current-poster">
      <?php if($page->poster()->isNotEmpty()): ?>
      <?php $poster = $page->poster()->toFile(); ?>
        <?php if($poster): ?>
          <img src="<?= $poster->url() ?>" alt="<?= $poster->alt() ?>">
        <?php endif ?>
      <?php endif ?>
    </figure>
  </div>

  <div class="col-6">
    <div class="box">
      <div class="head">
        <div class="title"><?= $page->announcementTextHeadline() ?></div>
      </div>
      <div class="body">
        <div class="message">
          <!-- // .small -->
          <div class="text expandable" data-expandable> 
            <?= $page->announcementText() ?>
          </div>      
          <a class="btn" data-expand-text>mehr</a>
        </div>
      </div>  
    </div>
    <div id="map" style="height: 500px; width: 100%;"></div>

    <?php snippet('address') ?>

    <?php snippet('countdown') ?>

    <div class="box cookie-msg" id="cookie-banner">
      <div class="head">
        <div class="title">cookies</div>
        <a href="" class="btn" id="accept-cookies">alles klar</a>
      </div>
      <div class="body">
        <div class="message">
          <div class="text small">Durch die Nutzung unserer Website stimmst du der Verwendung von Cookies gemäß unserer Cookie-Richtlinie zu. mehr dazu steht in unserer <a href="<?= $site->url() ?>/legal">Datenschutzerklärung</a>.</div>
        </div>
      </div>
    </div>
  </div><!-- end col -->
  <section id="bilder" class="col-12">    
    <div class="block-slider" data-slider>
      <ul class="slider" data-slider>
        <li><img src="<?= $site->url('') ?>/assets/media/slider-01.jpg"></li>
        <li><img src="<?= $site->url('') ?>/assets/media/slider-02.jpg"></li>
      </ul>
    </div>
  </section>
  <section class="col-12" id="lineup">
    <?php snippet('lineup') ?>
  </section>
  <div class="col-6 start-4">
    <div class="box nmb">
      <div class="head">
        <div class="title"><?= $page->faqTextHeadline() ?></div>
      </div>
      <div class="body">
        <div class="message">
          <!-- // .small -->
          <div class="text"><?= $page->faqText() ?></div>      
          <a class="btn">mehr</a>
        </div>
      </div>  
    </div>
  </div>
  <section class="col-12" id="poster">
    <?php snippet('poster-slider') ?>
  </section>
  <div class="col-12">    
    <div class="box nmb">
      <div class="head">
        <div class="title"><?= $page->posterTextHeadline() ?></div>
      </div>
      <div class="body">
        <div class="message">         
          <div class="text"><?= $page->posterText() ?></div>          
        </div>
      </div>  
    </div>    
  </div>


</div> <!-- end grid -->
  
<?php snippet('footer') ?>
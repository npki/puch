<?php snippet('head') ?>
<?php
$formatter = new IntlDateFormatter(
    'de_DE',
    IntlDateFormatter::NONE,  // Ändern Sie FULL zu NONE
    IntlDateFormatter::NONE,
    'Europe/Berlin',
    IntlDateFormatter::GREGORIAN,
    'd. MMMM Y'  // Neues Formatmuster ohne Wochentag
);
?>
<body class="start">    
  <header>
      <nav data-menu>
        <div class="menu-area">
          <div class="bar">
            <div class="bar-inner grid">
              <div class="<?php if($site->date()->isNotEmpty()): ?>col-3<?php else: ?>col-5<?php endif ?> menu-item-button ">
                <div class="knob"><div class="btn" data-menu-btn></div></div> <div class="title">MENÜ</div>
              </div>              
              <div class="<?php if($site->date()->isNotEmpty()): ?>col-3<?php else: ?>col-4<?php endif ?> menu-item-parent">Puch Open Air</div>              
              <?php if($site->date()->isNotEmpty()): ?><div class="col-3 menu-item-parent"><?= $site->date()->toDate($formatter) ?></div><?php endif ?>
              <div class="col-3 tickets">
                <?php if($site->ticketurl()->isNotEmpty()): ?>              
                  <a class="btn" href="<?= $site->ticketurl() ?>" target="_blank">tickets</a>
                  <?php else: ?>
                  <a class="btn" href="<?= $site->notifyticketurl() ?>" target="_blank">ticket reminder</a>
                <?php endif ?>
              </div>
            </div>
          </div>
          <div class="menu-items grid">
            <ul class="col-3">
              <li class="head-menu-item <?= $page->is($site->homePage()) ? 'active' : '' ?>"><a href="<?= $site->url() ?>">START</a></li>
              <li><a href="<?= $site->url() ?>#bilder">Bilder</a></li>
              <li><a href="<?= $site->url() ?>#lineup">Lineup 2024</a></li>
              <li><a href="<?= $site->url() ?>#poster">Poster</a></li>
            </ul>
            <ul class="col-3">
              <li class="head-menu-item <?= $page->is($site->find('faq')) ? 'active' : '' ?>"><a href="<?= $site->url() ?>/faq">FAQ</a></li>
              <?php if ($site->index()->findBy('intendedTemplate', 'faq')): ?>  
              <span class="scrollable">
              <?php foreach ($site->index()->findBy('intendedTemplate', 'faq')->faqs()->toStructure() as $faq): ?>
                <li><a href="<?= $site->url() ?>/faq#<?= strtolower($faq->title()) ?>"><?= $faq->title() ?></a></li>
              <?php endforeach ?>                        
                <li><a href="<?= $site->url() ?>/faq">Alle FAQ</a></li>
              </span>
              <?php endif ?>
            </ul>
            <ul class="col-3">
              <li class="head-menu-item <?= $page->is($site->find('geschichte')) ? 'active' : '' ?>"><a href="<?= $site->url() ?>/geschichte">GESCHICHTE</a></li>
              <li>
                <p>Highlights aus über 30 Jahren Festivalgeschichte</p>
              </li>
            </ul>
            <div class="col-3">
              <div class="map" id="map2"></div>
            </div>
          </div>          
        </div>     
        <?php if ($page->template() == 'home'): ?>
        <div class="player-area grid" data-player-menu>
          <div class="col-12 player">
            <div class="play-btn btn" data-play-menu></div>
            <div class="track-info">              
              <div class="track-title" data-song-title></div>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </nav>
  </header>
  <main>
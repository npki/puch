<div class="poster-slider">
  <div class="stand" data-floating="300">
    <a href="mailto:pw@rote-sonne.com?subject=Puch Festival: Weißt du noch?" class="share" data-floating="100">
      <div class="share-knob" >
        <img src="<?= $site->url('') ?>/assets/media/share.svg" alt="share button">
      </div>
      <div class="btn" data-floating="500">share a story</div>
    </a>
    <img src="<?= $site->url('') ?>/assets/media/poster-stand.png" alt="poster ständer">    
    <div class="poster-wrap">
    <?php         
      $posterslider = $page->posterslider()->toStructure(); 

      if ($posterslider->isNotEmpty()): 
          foreach ($posterslider as $slide):         
              $image = $slide->image()->toFile(); 
              if ($image):
      ?>
                          
        <img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>" class="poster" data-poster="<?= $slide->year() ?>">
          
      <?php 
              endif; 
          endforeach; 
      endif; 
    ?>
    </div>
    <div class="regulator" data-regulator data-floating="200">
      <div class="random btn" data-random-number data-floating="300">Random Poster</div>
      <div class="wrap">        
        <span class="number" data-number>2024</span>
        <input type="range" min="1999" max="" data-range>     
        <div class="knob" data-knob><span>turn back <br>time</span></div>        
      </div>      
    </div>
  </div>
</div>
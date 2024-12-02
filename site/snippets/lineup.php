<div class="box lineup" data-lineup>
  <div class="head">
    <div class="title"><?= $site->lineupHeading() ?></div>
  </div>
  <div class="body">
    <div class="message">
      <div class="text">
        <div data-scroll>
        <?php 
          $index = 0;
          foreach($site->artistlist()->toStructure() as $artist): 
        ?>
        <span data-artist="<?= $index ?>"><?= $artist->artist() ?></span>
        <?php 
          $index++;
        endforeach 
        ?>
        <?php 
          $index = 0; // Setzen Sie den Index zurück auf 0
          foreach($site->artistlist()->toStructure() as $artist): 
        ?>
          <span data-artist="<?= $index ?>"><?= $artist->artist() ?></span>
        <?php 
          $index++;
          endforeach 
        ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="lineup-content " data-lineup-content>
<?php 
  $indexC = 0;
  foreach($site->artistlist()->toStructure() as $artist): 
?>
<article data-artist-content="<?= $indexC ?>" class="grid">
    <figure class="col-6">
    <?php if($artist->image()->isNotEmpty()): ?>
      <?php $artistPoster = $artist->image()->toFile(); ?>
        <?php if($artistPoster): ?>
          <img src="<?= $artistPoster->url() ?>" alt="<?= $artistPoster->alt() ?>">
        <?php endif ?>
      <?php endif ?>      
    </figure>
    <div class="col-6">
      <div class="box">                        
        <div class="body">
          <div class="message">          
            <div class="text"><?= $artist->description() ?></div>             
            <?php                           
                  foreach($artist->links()->toStructure() as $artistLink): 
              ?>
                  <a class="btn" href="<?= $artistLink->buttonUrl() ?>" target="_blank"><?= $artistLink->buttonText() ?></a>
              <?php 
                  endforeach; 
              
              ?>
          </div>
      </div>          
    </div>
    <div class="video-embed-frame">
      <iframe src="<?= $artist->video() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div> 
  </div>
</article>

<?php 
  $indexC++;
  endforeach 
?>
</div>
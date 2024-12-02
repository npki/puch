<?php snippet('header') ?>
<!-- <section class="indent">
    <div class="project-meta">                
        <h1><?= $page->title()->html() ?></h1>                
        <div class="year"><?= $page->year()->html() ?></div>
    </div>      
    
    <div class="image-box fullhd project-header" data-aos="fade-up">        
        <?php if($page->video()->isNotEmpty()): ?>
        <iframe src="<?= $page->video() ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>        
        <?php else: ?>
            <?php foreach($page->cover()->toFiles() as $cover): ?>            
                <img src="<?= $cover->url() ?>" alt="<?= $cover->alt() ?>">            
            <?php endforeach ?>            
        <?php endif ?>
    </div>
    
    <div class="project-text" data-aos="fade-up"><?= $page->intro_text()->kirbytext() ?></div>
    
    <?php if($page->selected_images()->isNotEmpty()): ?>
        <?php foreach($page->selected_images()->toFiles() as $image): ?>
            <figure class="image-box fullhd" data-aos="fade-up">                
                <img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>">
            </figure>
        <?php endforeach ?>
    <?php endif ?>

    <div class="project-footer">
        <div class="project-team">
        <?php foreach($page->team_members()->toStructure() as $member): ?>
            <div><?= $member->role()->html() ?>:<br><?= $member->name()->html() ?></div>
        <?php endforeach ?>
        </div>
        <?php $backlinkCat = $page->backlink_cat(); ?>
        <div class="backlink-container">
            <a href="<?= $site->url() ?>/archive#<?= html($backlinkCat) ?>" class="backlink">all <span><?= html($backlinkCat) ?></span></a>
        </div>
    </div>
</section> -->
<?php snippet('footer') ?>
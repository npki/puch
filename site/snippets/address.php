<div class="box address">
  <div class="head">
    <div class="title">adresse</div>
    <a href="https://www.google.com/maps/dir/?api=1&destination=48.41427542497464, 11.404087612951633" target="_blank" class="btn">anfahrt</a>    
  </div>
  <div class="body">
    <div class="message">
      <div class="text">
        <?php if($site->adress()->isNotEmpty()): ?>
          <?php foreach($site->adress()->toStructure() as $adressItem): ?>
            <div>
              <?= $adressItem->street()?>
              <?= $adressItem->number()?>
            </div>
            <div>
              <?= $adressItem->plz()?>
              <?= $adressItem->city()?>
            </div>
          <?php endforeach ?>
        <?php endif ?>              
      </div>
    </div>
  </div>
</div>  
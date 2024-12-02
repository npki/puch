</main>
    <footer>
       <div class="grid">
            <div class="col-6">                
                <?php snippet('address') ?>
            </div>
            <div class="col-6">
            <?php if ($page->template() == 'home'): ?>
                <div class="links faq">
                    <div class="box">
                        <div class="head">
                            <div class="title">FAQ</div>
                            <a class="btn">alle FAQs</a>
                        </div>
                        <div class="body">
                            <ul class="list">
                            <?php foreach ($site->index()->findBy('intendedTemplate', 'faq')->faqs()->toStructure() as $faq): ?>
                                <li><a href="<?= $site->url() ?>/faq#<?= strtolower($faq->title()) ?>"><?= $faq->title() ?></a></li>
                            <?php endforeach ?>  
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
                <div class="links">
                    <div class="box nmb">
                        <div class="head">
                            <div class="title">links</div>                             
                        </div>
                        <div class="body">
                            <ul class="list">
                                <li><a href="<?= $site->url() ?>/legal">Impressum</a></li>
                                <li><a href="<?= $site->url() ?>/legal">Datenschutz</a></li>
                                <li><a href="https://www.instagram.com/puchopenair/" target="_blank">Instagram</a></li>
                                <li><a href="https://www.facebook.com/puch.openair/" target="_blank">Facebook</a></li>
                                <li><a href="mailto:pw@rote-sonne.com">E-Mail</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </footer>    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDahF6IEVWov2Aeibi4Z-R9m4a6NpIpsBc&callback=initMap&loading=async" async defer></script>

    <?php if ($page->template() == 'home'): ?>

    <script>        
        function initMap() {                
            var center = {lat: 48.412752904344494, lng: 11.403764870909288};
            
            var map1 = new google.maps.Map(document.getElementById('map'), {
                center: center,
                zoom: 15,
                mapTypeId: 'terrain'
            });
            
            var map2 = new google.maps.Map(document.getElementById('map2'), {
                center: center,
                zoom: 15,
                mapTypeId: 'terrain'
            });
        }        
    </script>

    <?php else: ?>

    <script>        
        function initMap() {                
            var center = {lat: 48.412752904344494, lng: 11.403764870909288};
            
            var map2 = new google.maps.Map(document.getElementById('map2'), {
                center: center,
                zoom: 15,
                mapTypeId: 'terrain'
            });
        }        
    </script>

    <?php endif; ?>

    <script src="<?= $site->url('') ?>/assets/js/slick.min.js"></script>    
    <?= js(['assets/js/base.js', '@auto']) ?>
    <script src="<?= $site->url('') ?>/assets/js/player.js"></script>
    
  </body>
</html>
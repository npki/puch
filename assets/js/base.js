handleMenu = function () {
  $('[data-menu]').on('click', function(event) {  
    event.stopPropagation();
    $('html').addClass('menu-open');
  });

  // Event-Listener für den Button innerhalb des Menüs
  $('[data-menu-btn]').on('click', function(event) {
    event.stopPropagation(); // Verhindert das Schließen des Menüs durch Klicks auf andere innere Elemente
    $('html').removeClass('menu-open'); // Schließt das Menü nur bei Klick auf den Button
  });

  $(document).on('click', function(event) {    
    if (!$(event.target).closest('.menu').length) {
      $('html').removeClass('menu-open');
    }
  });
};

initCountdown = function() {
  // Set the date we're counting down to
  var countDownDate = new Date("Aug 15, 2025 23:59:59").getTime();

  // Update the countdown every 1 second
  var countdownfunction = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the countdown date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    

      // Output the result in the elements with id
      $("[data-days]").text(days);
      $("[data-hours]").text(hours);
      $("[data-minutes]").text(minutes);      

      // If the countdown is finished, write some text
      if (distance < 0) {
          clearInterval(countdownfunction);
          $("#countdown").html("EXPIRED");
      }
  }, 1000);
}


initAOS = function() {
  AOS.init();
};

$(document).ready(function() {  
  handleMenu();
  initCountdown();
});
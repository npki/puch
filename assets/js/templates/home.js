setCursor = function () {
  $(document).on('mousemove', function(e) {
    var x = e.pageX;
    var y = e.pageY;

    $('[data-cursor]').css({'left': x, 'top': y});    
  });
}

mapFeeling = function () {
  var pageCenterX = $(window).innerWidth() / 2;
  var pageCenterY = $(window).innerHeight() / 2;

  // Berechne den maximalen Versatz (10% der Fensterbreite)
  var maxOffset = $(window).innerWidth() * 0.1;
  var maxOffsetY = $(window).innerHeight() * 0.1;

  $(document).on('mousemove', function(e) {
    var x = e.pageX;
    var y = e.pageY;

    // Berechne das Verhältnis der Mausposition zur Seitenmitte
    var ratio = (x - pageCenterX) / pageCenterX;
    var ratioY = (y - pageCenterY) / pageCenterY;

    // Berechne die linke Position des Containers basierend auf dem Verhältnis
    var leftPosition = ratio * maxOffset;
    var topPosition = ratioY * maxOffsetY;

    // Setze die Margin-Left-Eigenschaft des Containers
    $('[data-background]').css({'margin-left': -leftPosition, 'margin-top': -topPosition});
  });


  $(document).on('click', function(e) {
    $('[data-cursor]').addClass('pulse');
  })
}


truncateText = function(selector, maxLength) {
  var element = $(selector);
  var originalText = element.html().trim(); // Originaltext speichern
  var truncatedText = originalText.substring(0, maxLength) + '...'; // Text auf 100 Zeichen kürzen

  // Nur kürzen, wenn der Text länger als maxLength ist
  if (originalText.length > maxLength) {
    element.data('original-text', originalText); // Speichere den gesamten Text in einem data-Attribut
    element.html(truncatedText); // Setze den gekürzten Text
  }
}

initSlider = function() {
  $('[data-slider]').slick({
      infinite: true,
      autoplaySpeed: 4000,
      speed: 400,
      autoplay: true,      
      slidesToShow: 1,              
      prevArrow: "<div class='arrow prev'></div>",
      nextArrow: "<div class='arrow next'></div>",
  });
};

handlePosterSlider = function() {
  const regulator = $('[data-regulator]');
  const range = regulator.find('[data-range]')
  const knob = regulator.find('[data-knob]');
  const year = new Date().getFullYear();
  const poster = $('[data-poster]');

  range.attr('max', year);

  poster.hide();
  $('[data-poster="2024"]').show();

  range.on('input', function() {
    const min = $(this).attr('min');
    const max = $(this).attr('max');
    const currentValue = $(this).val();

    // Berechne den prozentualen Wert
    const valuePercentage = ((currentValue - min) / (max - min)) * 100;
    
    // Berechne den Rotationswinkel basierend auf dem prozentualen Wert
    const rotationDegree = (valuePercentage / 100) * 360;    
    
    // Dreh den Knopf entsprechend des berechneten Winkels
    knob.css('transform', 'rotate(' + rotationDegree + 'deg)');

    regulator.find('[data-number]').html(currentValue);
    poster.hide();
    $('[data-poster="'+currentValue+'"]').show();

  });

  const randomBtn = $('[data-random-number]');

  randomBtn.on('click', function() {
    $(this).parent().addClass('randomize');
  
    const startYear = 1999;
    const currentYear = new Date().getFullYear();
  
    // Berechne eine zufällige Endzahl zwischen 1989 und dem aktuellen Jahr
    const targetYear = Math.floor(Math.random() * (currentYear - startYear + 1)) + startYear;
  
    // Kürzere Dauer der Animation in Millisekunden
    const duration = 1600;
  
    // Starte die Animation
    $({ year: startYear }).animate({ year: targetYear }, {
      duration: duration,
      easing: 'swing',
      step: function() {
        // Generiere zufällige Jahreszahlen während der Animation
        const randomYear = Math.floor(Math.random() * (currentYear - startYear + 1)) + startYear;
        $('[data-number]').text(randomYear);
      },
      complete: function() {
        // Setze den Endwert nach Abschluss der Animation
        $('[data-number]').text(targetYear);
        range.val(targetYear);
        regulator.removeClass('randomize');
        
        poster.hide();
        $('[data-poster="'+targetYear+'"]').fadeIn();
      }
    });
  });
}

letElFloat = function() {
  $(window).on('mousemove', function(e) { // Korrigiert 'mouseover' zu 'mousemove' für kontinuierliche Bewegung
    const x = e.pageX;
    const center = $(this).innerWidth() / 2;    
    const el = $('[data-floating]');
    
    el.each(function() {  
      const elSpecificFloat = $(this).data('floating') / 5;
      const float = (x - center) / elSpecificFloat;
      $(this).css('transform', 'translateX(' + float + 'px)');
    });
  });
};

let scrollStopped = false;
let scrollDirection = -1; // Scroll nach links
let scrollSpeed = 3; // Anpassbare Scrollgeschwindigkeit

endlessScrollText = function() {
  var $scrollDiv = $('[data-scroll]');
  var scrollWidth = $scrollDiv.width();
  var parentWidth = $scrollDiv.parent().width();

  // Duplizieren des Inhalts, um nahtloses Scrollen zu ermöglichen
  if ($scrollDiv.children().length < 2) {
    $scrollDiv.append($scrollDiv.html()); // Textinhalt duplizieren
    $scrollDiv.append($scrollDiv.html()); // Nochmals duplizieren für mehr Platz
  }

  // Start der Animation
  function startScrolling() {
    if (!scrollStopped) {
      var currentLeft = parseInt($scrollDiv.css('left'), 10);
      var newLeft = currentLeft + scrollDirection * scrollSpeed;

      // Wenn der Text zu weit nach links gescrollt ist, setze ihn zurück
      if (newLeft <= -scrollWidth / 2) {
        newLeft = 0; // Zurücksetzen auf Anfang
      }

      // Bewege den Text nach links
      $scrollDiv.css('left', newLeft + 'px');

      // Setze die Animation fort
      requestAnimationFrame(startScrolling);
    }
  }

  // Bei Hover die Animation anhalten
  $scrollDiv.hover(
    function() {
      scrollStopped = true;
    },
    function() {
      scrollStopped = false;
      startScrolling(); // Animation neu starten
    }
  );

  // Draggable für den Text aktivieren
  $scrollDiv.draggable({
    axis: "x", // Nur horizontal bewegen
    drag: function() {
      scrollStopped = true; // Animation stoppen, wenn gezogen wird
    },
    stop: function(event, ui) {
      // Korrigiere die Position, wenn zu weit gezogen
      var currentLeft = parseInt($scrollDiv.css('left'), 10);
      
      if (currentLeft < -scrollWidth / 2) {
        $scrollDiv.css('left', 0); // Zurücksetzen auf den Anfang
      } else if (currentLeft > 0) {
        $scrollDiv.css('left', -scrollWidth / 2 + 'px'); // Setze zurück, wenn zu weit nach rechts gezogen
      }
      
      // Setze das Scrollen nach dem Dragging fort
      scrollStopped = false;
      startScrolling();
    }
  });

  // Animation beim Laden starten
  startScrolling();

  $('[data-artist]').on('click', function() {    
    $('[data-artist]').removeClass('active');
    $(this).addClass('active');

    const i = $(this).data('artist');
    console.log(i);

    // Verstecke alle anderen Inhalte
    $('[data-lineup-content] article').css('display', 'none');

    // Zeige nur den ausgewählten Künstlerinhalt
    $('[data-lineup-content]').find('[data-artist-content="'+i+'"]').css('display', 'grid');
  });
};

handleCookies = function() {
  function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }

  // Funktion zum Überprüfen, ob das Cookie gesetzt ist
  function getCookie(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) === ' ') c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
  }

  // Überprüfen, ob das Cookie gesetzt ist
  if (getCookie("cookiesAccepted") !== "true") {
      $("#cookie-banner").show(); // Banner anzeigen
  } else {
      $("#cookie-banner").hide(); // Banner ausblenden
  }

  // Event-Handler für den Button
  $("#accept-cookies").on("click", function(e) {
      e.preventDefault(); // Standardverhalten des Links verhindern
      setCookie("cookiesAccepted", "true", 30); // Cookie setzen für 30 Tage
      $("#cookie-banner").fadeOut(); // Banner ausblenden
  });
}


$(document).ready(function() {    
  setCursor();
  mapFeeling();
  handlePosterSlider();
  letElFloat();  
  endlessScrollText();
  initSlider();
  handleCookies();
  // Kürze den Text in der .text.expandable Div auf 100 Zeichen
  truncateText('[data-expandable]', 420);

  // Bei Klick auf den Button mit data-expand-text den gesamten Text anzeigen
  $('[data-expand-text]').on('click', function() {
    var textElement = $(this).siblings('[data-expandable]'); // Finde den zugehörigen Text
    var originalText = textElement.data('original-text'); // Den vollständigen Text abrufen

    if (textElement.hasClass('expanded')) {
      // Wenn der Text bereits erweitert ist, dann wieder kürzen
      truncateText(textElement, 420);
      textElement.removeClass('expanded');
      $(this).text('mehr'); // Button-Text zurücksetzen
    } else {
      // Wenn der Text gekürzt ist, dann den vollständigen Text anzeigen
      textElement.html(originalText);
      textElement.addClass('expanded');
      $(this).text('weniger'); // Button-Text ändern
    }
  });
});
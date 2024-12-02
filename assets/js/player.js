animateSpeaker = function() {
  var box = $('[data-speaker-animation]');
  box.addClass('state-1')
  setTimeout(function() {
    box.removeClass('state-1')
  }, 1000)
}

setupPlaylist = function() {
  const play = $('[data-play]');
  const next = $('[data-next-track]');
  const prev = $('[data-prev-track]');

  const list = $('[data-track-container]');
  const track = list.find('[data-track]');
  let currentAudio = null; // Variable to keep track of the currently playing audio
  let currentTrackIndex = 0; // Index of the currently active track
  let speakerAnimationInterval = null; // Variable to store the interval ID

  const playerMenu = $('[data-player-menu]');
  const menuPlayBtn = $('[data-play-menu]');
  
  // menu synchron
  playerMenu.find('[data-song-title]').text(list.find('#trackTitle').get(0).innerText);
  track.eq(currentTrackIndex).addClass('active');  

  play.on('click', function() {
    const activeTrack = list.find('.active').find('[data-audio]').get(0);

    if ($(this).hasClass('pause')) {
      // Pause the current track and stop the speaker animation
      activeTrack.pause();
      clearInterval(speakerAnimationInterval);
      $('[data-speaker-animation]').removeClass('state-1');
    } else {
      // Play the current track and start the speaker animation
      activeTrack.play();
      currentAudio = activeTrack;
      updateProgress(); // Start updating the progress bar
      
      // Start the speaker animation interval if not already running
      speakerAnimationInterval = setInterval(animateSpeaker, 700);
    }

    if (currentAudio && currentAudio !== activeTrack) {
      currentAudio.pause();
      currentAudio.currentTime = 0; // Optional: Reset the previous audio to start
      play.removeClass('pause');
    }

    $(this).toggleClass('pause');

    const trackTitles = document.querySelectorAll("#trackTitle");   
    const currentTrackTitle = trackTitles[currentTrackIndex];

    // menu synchron
    playerMenu.find('[data-song-title]').text(currentTrackTitle.innerText);
    playerMenu.find(menuPlayBtn).toggleClass('pause');    
  });

  next.on('click', function() {
    changeTrack(1);
  });

  prev.on('click', function() {
    changeTrack(-1);
  });

  // menu synchron
  menuPlayBtn.on('click', function() {        
    $(this).toggleClass('pause');
    // Check if the button has the 'pause' class and set the variable accordingly
    // console.log(list.find('.active').find('[data-audio]'));
    if ($(this).hasClass('pause')) {        
        play.addClass('pause');
        console.log(list.find('.active').find('[data-audio]').get(0));
        list.find('.active').find('[data-audio]').get(0).play();        

    } else {              
        play.removeClass('pause');        
        console.log(list.find('.active').find('[data-audio]').get(0));
        list.find('.active').find('[data-audio]').get(0).pause();   
        list.find('[data-audio]').get(0).pause();       
    }
  });

  function changeTrack(direction) {
    // Pause the current audio and clear the interval
    if (currentAudio) {
      currentAudio.pause();
      currentAudio.currentTime = 0; // Optional: Reset the previous audio to start
      clearInterval(speakerAnimationInterval);
      $('[data-speaker-animation]').removeClass('state-1');
    }

    // Remove the active class from the current track
    track.eq(currentTrackIndex).removeClass('active');

    // Update the track index
    currentTrackIndex = (currentTrackIndex + direction + track.length) % track.length;

    // Add the active class to the new track
    track.eq(currentTrackIndex).addClass('active');

    // Play the new track
    currentAudio = track.eq(currentTrackIndex).find('[data-audio]').get(0);
    currentAudio.play();
    updateProgress(); // Start updating the progress bar for the new track

    // Restart the speaker animation
    speakerAnimationInterval = setInterval(animateSpeaker, 700);

    play.addClass('pause'); // Ensure the play button shows as paused 

    // menu synchron
    
    const trackTitles = document.querySelectorAll("#trackTitle");    
    const currentTrackTitle = trackTitles[currentTrackIndex];
      
    playerMenu.find('[data-song-title]').text(currentTrackTitle.innerText);    
  }

  function updateProgress() {
    const progressBar = list.find('.active').find('[data-progress]');
    const progressContainer = list.find('.active').find('[data-progress-bar]');

    if (!currentAudio) return;

    currentAudio.addEventListener('timeupdate', function() {
      const percentage = (currentAudio.currentTime / currentAudio.duration) * 100;
      progressBar.css('width', `${percentage}%`);
    });

    currentAudio.addEventListener('ended', function() {
      progressBar.css('width', '0%');
      clearInterval(speakerAnimationInterval);
      $('[data-speaker-animation]').removeClass('state-1');
      changeTrack(1); // Automatically play the next track when the current one ends
    });

    // Adding the click event to seek in the audio
    progressContainer.on('click', function(event) {
      const offsetX = event.offsetX; // Get the horizontal position where the click occurred
      const totalWidth = $(this).width(); // Get the total width of the progress bar
      const clickPosition = offsetX / totalWidth; // Calculate the position as a percentage
      const newTime = clickPosition * currentAudio.duration; // Calculate the new time for the audio
      currentAudio.currentTime = newTime; // Set the audio current time to the new calculated time
    });
  }
}

scrollableText = function() {
  $('[data-scroll-container]').on('mouseenter', function() {
    const $this = $(this);
    const content = $this.find('[data-scroll-content]');
    const containerWidth = $this.width();    

    // Ermittelt die tatsächliche Breite des Inhalts
    const textWidth = content[0].scrollWidth;

    content.removeClass('cut-off');

    if (textWidth > containerWidth) {
      const scrollDistance = textWidth - containerWidth;
      content.css('transform', 'translateX(-' + scrollDistance + 'px)');
    }  
  });

  $('[data-scroll-container]').on('mouseleave', function() {
    const content = $(this).find('[data-scroll-content]');
    content.css('transform', 'translateX(0)');
    content.addClass('cut-off');
  });
}


$(document).ready(function() {  
  if( $('[data-player-widget]').length !== 0 ) {
    setupPlaylist();
    scrollableText();
  }
});
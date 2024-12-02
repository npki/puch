faqToggle = function() {
  const question = $('[data-question');
  const answer = $('[data-answer');
  
  question.on('click', function() {
    $(this).parent(question).toggleClass('open')
  });

  $(window).on('hashchange', function() {
    var hash = location.hash;  // Get the current hash

    $('[data-question-item]').removeClass('open');
    $(hash).find('[data-question-item]').addClass('open');    
  });

};


$(document).ready(function() {  
  faqToggle(); 

  var hash = $(location).prop('hash');
  if (hash) {
    $(hash).find('[data-question-item]').addClass('open');
  }
});
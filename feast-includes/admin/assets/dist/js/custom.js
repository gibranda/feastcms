var unsaved = false;

$("form :input, form textarea").change(function(){ //trigers change in all input fields including text type
    unsaved = true;
});

$('button[type=submit], input[type=submit], button.addSlide, #addItem, #save').click(function() {
    unsaved = false;
});

function unloadPage(){
    if(unsaved){
        return "This page is asking you to confirm that you want to leave - data you have entered may not be saved.";
    }
}

window.onbeforeunload = unloadPage;

$( document ).ready(function() {   
    // Initialize ui slider
    $(".ui-slider").ionRangeSlider({
      min: $(this).data('min') || 1,
      max: $(this).data('max') || 20,
      from: $(this).data('from') || 1,
      step:  $(this).data('step') || 1,
      prefix: $(this).data('prefix') || false,
      hasGrid: $(this).data('grid') || false        
    });


    $('#sliderType img').click(function() {
      var typeid = $(this).attr('data-type');
      //alert( typeid );
      $('.slider-source').slideUp();
      $('#' + typeid).slideDown();
    });


    // Collapsed panels
    $('.panel.collapsed').each(function() {
        $(this).children('.panel-body').slideToggle('fast');
        $('.panel-collapse', this).addClass( "closed" );
    });

    /*
      // check if form-group contains an danger paragraph
      // if it contains a paraphraph then add danger icon inside input
      $('.form-group').each(function() {
        if($(this).find('p').length > 0){
            $('input[type="text"]', this).after('<i class="fa fa-close"></i>');
        }
      });

      // check if form-group contains an danger icon
      // if it contains a danger icon then hide thsis icon if input value is change
      $('input[type="text"').keyup(function() {
          if($(this).val().length > 0){
            $(this).next('i.fa-close').css('display', 'none');
          } else {
            $(this).next('i.fa-close').css('display', 'block');
          }
      });
    */
});

// Wait for window load
$(window).load(function() {
  // Animate loader off screen
  $("#loader").css('display', 'none', 'position', 'relative');
  $("#main-wrapper").children().show();
});
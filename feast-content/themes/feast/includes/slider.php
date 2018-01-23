<?php if( is_option('slider_type') && get_slider( get_option('home_slider') ) ) { ?>
<div class="home_slider">
<?php
  switch (get_option('slider_type')) {
    case 1:
      load_template('includes/slider-01.php');
      break;

    case 2:
      load_template('includes/slider-02.php');
      break;

    case 3:
      load_template('includes/slider-03.php');
      break;
    
    default:
      load_template('includes/slider-02.php');
      break;
  }
?>
</div>
<hr>
<?php } ?>
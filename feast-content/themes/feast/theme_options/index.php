<?php
  $themes = array(
              'default' => 'default',
              'cerulean' => 'cerulean',
              'cosmo' => 'cosmo',
              'cyborg' => 'cyborg',
              'darkly' => 'darkly',
              'flatly' => 'flatly',
              'journal' => 'journal',
              'lumen' => 'lumen',
              'paper' => 'paper',
              'readable' => 'readable',
              'sandstone' => 'sandstone',
              'simplex' => 'simplex',
              'slate' => 'slate',
              'solar' => 'solar',
              'spacelab' => 'spacelab',
              'superhero' => 'superhero',
              'united' => 'united',
              'yeti' => 'yeti'
          );

  $types = array(
              1 =>  THEME_FOLDER.'assets/images/slider/Slide-01.png',
              2 =>  THEME_FOLDER.'assets/images/slider/Slide-02.png',
              3 =>  THEME_FOLDER.'assets/images/slider/Slide-03.png'
          );

  $layouts = array(
              1 =>  THEME_FOLDER.'assets/images/blog/1cols.png',
              2 =>  THEME_FOLDER.'assets/images/blog/2cols.png',
              3 =>  THEME_FOLDER.'assets/images/blog/3cols.png'
          );
?>


      <div class="col-xs-12">
        <?=admin_select('Home slider', 'home_slider', sliders_list(), get_option('home_slider'), 'Select a slider for home page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio_image ('Slider type', 'slider_type', $types, get_option('slider_type'), 'Select a slider type.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio_image ('Post layout', 'posts_layout', $layouts, get_option('posts_layout'), 'Select a post layout.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_select('Bootstrap Theme', 'bootstrap_theme', $themes, get_option('bootstrap_theme'), 'Select a bootstrap theme.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio('Sidebar', 'site_sidebar', array(0 => 'Off', 1 => 'On') , get_option('site_sidebar'), 'Enable/Disable Sidebar in all website.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio('Post comments', 'post_comments', array(0 => 'Off', 1 => 'On') , get_option('post_comments'), 'Enable/Disable post comments.')?>
      </div>


      <div class="col-xs-12">
        <?=admin_radio('Page comments', 'page_comments', array(0 => 'Off', 1 => 'On') , get_option('page_comments'), 'Enable/Disable page comments.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_spinner('Posts per page', 'posts_per_page', get_option('posts_per_page'), 'Set number of posts per page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_spinner('Home page posts', 'home_posts_num', get_option('home_posts_num'), 'Set number of posts on home page.')?>
      </div>

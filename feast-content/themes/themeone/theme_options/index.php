<?php if(is_rtl() == TRUE) {?>
<style type="text/css">
.question-icon i { border-right: 1px solid #555; border-left: none}
</style>
<?php }
  $layouts = array(
              '2cols-sidebar' =>  THEME_FOLDER.'assets/images/blog/2cols-sidebar.png',
              '3cols' =>  THEME_FOLDER.'assets/images/blog/3cols.png',
              '3cols-sidebar' =>  THEME_FOLDER.'assets/images/blog/3cols-sidebar.png',
              '4cols' =>  THEME_FOLDER.'assets/images/blog/4cols.png',
              'classic-right' =>  THEME_FOLDER.'assets/images/blog/classic-right.png',
              'classic-left' =>  THEME_FOLDER.'assets/images/blog/classic-left.png'
          );

  $portfolio = array(
              '2cols' =>  '2 Cols',
              '3cols' =>  '3 Cols',
              '4cols' =>  '4 Cols'
          );

?>

<div class="tabbable nav-tabs-custom tabs-<?=is_rtl() == TRUE ? 'right' : 'left'?>" role="tabpanel">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general">General options</a></li>
    <li><a data-toggle="tab" href="#header">Header options</a></li>
    <li><a data-toggle="tab" href="#blog">Blog options</a></li>
    <li><a data-toggle="tab" href="#menus">Menus & widgets</a></li>
  </ul>

  <div class="tab-content full-content">
    <div id="general" class="tab-pane fade in active">
      <h3>General options</h3>

      <div class="col-xs-12">
        <?=admin_input_spinner('Posts per page', 'posts_per_page', get_option('posts_per_page'), 'Set number of posts per page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_spinner('Search posts per page', 'search_per_page', get_option('search_per_page'), 'Set number of posts on search page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_spinner('Category posts per page', 'category_per_page', get_option('category_per_page'), 'Set number of posts on category page.')?>
      </div>

    </div>

    <div id="header" class="tab-pane fade">

      <div class="col-xs-12">
        <?=admin_select('Home page Header style', 'themeone_header_layout', array('Flex slider' => 'slider', 'Text rotate' => 'textrotate', 'Static image' => 'static_image', 'Gradient overlay' => 'gradient'), get_option('themeone_header_layout'), 'Select a home page header style.')?>
      </div>      

      <div class="col-xs-12">
        <?=admin_radio ('Home page Fullscreen header', 'themeone_header_fullscreen', array(1 => 'Fullscreen', 0 => 'Classic'), get_option('themeone_header_fullscreen'), 'Select a home page header layout Fullscreen/Classic.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_select('Home slider', 'home_slider', sliders_list(), get_option('home_slider'), 'Select a slider for home page.')?>
      </div>
      
      <div class="col-xs-12">
        <?=admin_upload('Textrotate background', 'themeone_textrotate_image', get_option('themeone_textrotate_image'), 'Select background image for Textrotate header.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_text('Textrotate title', 'themeone_textrotate_title', get_option('themeone_textrotate_title'), 'Enter a title for Textrotate header.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_text('Textrotate texts', 'themeone_textrotate', get_option('themeone_textrotate'), 'Enter texts for textslider (separate them by comma ",").')?>
      </div>
      
      <div class="col-xs-12">
        <?=admin_upload('Static image background', 'themeone_header_image', get_option('themeone_header_image'), 'Select background image for static image header.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_text('Static image title', 'themeone_header_image_title', get_option('themeone_header_image_title'), 'Enter a title for static image header.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_textarea('Static image text', 'themeone_header_image_text', get_option('themeone_header_image_text'), 'Enter a welcome text for static image header.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_textarea('Blog page text', 'themeone_blog_text', get_option('themeone_blog_text'), 'Enter a short text for Blog page header.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_textarea('Category page text', 'themeone_category_text', get_option('themeone_category_text'), 'Enter a short text for Category page header.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_textarea('Portfolio page text', 'themeone_portfolio_text', get_option('themeone_portfolio_text'), 'Enter a short text for Portfolio page header.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_textarea('Search page text', 'themeone_search_text', get_option('themeone_search_text'), 'Enter a short text for Search page header.')?>
      </div>

    </div>

    <div id="blog" class="tab-pane fade">
      <h3>Blog options</h3>

      <div class="col-xs-12">
        <?=admin_radio_image ('Blog layout', 'themeone_blog_layout', $layouts, get_option('themeone_blog_layout'), 'Select a layout for blog page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio_image ('Category layout', 'themeone_category_layout', $layouts, get_option('themeone_category_layout'), 'Select a layout for category page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio_image ('Search page layout', 'themeone_search_layout', $layouts, get_option('themeone_search_layout'), 'Select a layout for search page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio ('Portfolio page layout', 'themeone_portfolio_layout', $portfolio, get_option('themeone_portfolio_layout'), 'Select a layout for portfolio page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio ('Portfolio Boxed', 'themeone_portfolio_boxed', NULL, get_option('themeone_portfolio_boxed'), 'Select portfolio layout Boxed/Full width.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio ('Portfolio Gutter', 'themeone_portfolio_gutter', NULL, get_option('themeone_portfolio_gutter'), 'Select portfolio gutter layout.')?>
      </div>            

    </div>

    <div id="menus" class="tab-pane fade">
      <h3>About</h3>
      <div class="col-xs-12">
        <?=admin_select('Main menu', 'nova_main_menu', menus_list(), get_option('nova_main_menu'), 'Select a main menu.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_input_text('Sidebar menu title', 'nova_sidebar_title', get_option('nova_sidebar_title'), 'Set sidebar menu title.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_select('Sidebar menu', 'nova_sidebar_menu', menus_list(), get_option('nova_sidebar_menu'), 'Select a sidebar menu.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_input_text('Footer Widget title', 'footer_widget_title', get_option('footer_widget_title'), 'Set a title fot footer widget.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_textarea('Footer Widget content', 'footer_widget_content', get_option('footer_widget_content'), 'Set a content fot footer widget.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_input_text('Sidebar Widget title', 'sidebar_widget_title', get_option('sidebar_widget_title'), 'Set a title fot sidebar widget.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_textarea('Sidebar Widget content', 'sidebar_widget_content', get_option('sidebar_widget_content'), 'Set a content fot sidebar widget.')?>
      </div>

    </div>

  </div>
</div>
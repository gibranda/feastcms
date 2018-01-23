<?php if(is_rtl() == TRUE) {?>
<style type="text/css">
.question-icon i { border-right: 1px solid #555; border-left: none}
</style>
<?php }?>

<div class="tabbable nav-tabs-custom tabs-<?=is_rtl() == TRUE ? 'right' : 'left'?>" role="tabpanel">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general">General options</a></li>
    <li><a data-toggle="tab" href="#menus">Menus</a></li>
    <li><a data-toggle="tab" href="#advs">Advertizing banners</a></li>
  </ul>

  <div class="tab-content full-content">
    <div id="general" class="tab-pane fade in active">
      <h3>General options</h3>

      <div class="col-xs-12">
        <?=admin_select('Home slider', 'home_slider', sliders_list(), get_option('home_slider'), 'Select a slider for home page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_spinner('Posts per page', 'posts_per_page', get_option('posts_per_page'), 'Set number of posts per page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_spinner('Category posts per page', 'category_per_page', get_option('category_per_page'), 'Set number of posts on category page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_input_spinner('Portfolio per page', 'portfolio_per_page', get_option('portfolio_per_page'), 'Set number of works on portfolio page.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio('Post comments', 'post_comments', array(0 => 'Off', 1 => 'On') , get_option('post_comments'), 'Enable/Disable post comments.')?>
      </div>


      <div class="col-xs-12">
        <?=admin_radio('Page comments', 'page_comments', array(0 => 'Off', 1 => 'On') , get_option('page_comments'), 'Enable/Disable page comments.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_radio('Site sidebar', 'site_sidebar', array(0 => 'Off', 1 => 'On') , get_option('site_sidebar'), 'Enable/Disable sidebar on Blog page.')?>
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
      <?=admin_input_text('Footer menu one title', 'nova_footer_title1', get_option('nova_footer_title1'), 'Set footer menu one title.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_select('Footer menu one', 'nova_footer_menu1', menus_list(), get_option('nova_footer_menu1'), 'Select a footer menu one.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_input_text('Footer menu one title', 'nova_footer_title2', get_option('nova_footer_title2'), 'Set footer menu two title.')?>
      </div>

      <div class="col-xs-12">
        <?=admin_select('Footer menu two', 'nova_footer_menu2', menus_list(), get_option('nova_footer_menu2'), 'Select a footer menu two.')?>
      </div>

    </div>
    <div id="advs" class="tab-pane fade">
      <h3>Advertizing banners</h3>

      <div class="col-xs-12">
      <?=admin_input_text('Sidebar First Adv title', 'nova_adv_url1', get_option('nova_adv_url1'), 'Set Sidebar First Adv title.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_upload('Sidebar First Adv image', 'nova_adv_img1', get_option('nova_adv_img1'), 'Set Sidebar First Adv image.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_input_text('Sidebar First Adv title', 'nova_adv_url2', get_option('nova_adv_url2'), 'Set Sidebar First Adv title.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_upload('Sidebar First Adv image', 'nova_adv_img2', get_option('nova_adv_img2'), 'Set Sidebar First Adv image.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_input_text('Sidebar First Adv title', 'nova_adv_url3', get_option('nova_adv_url3'), 'Set Sidebar First Adv title.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_upload('Sidebar First Adv image', 'nova_adv_img3', get_option('nova_adv_img3'), 'Set Sidebar First Adv image.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_input_text('Sidebar First Adv title', 'nova_adv_url4', get_option('nova_adv_url4'), 'Set Sidebar First Adv title.')?>
      </div>

      <div class="col-xs-12">
      <?=admin_upload('Sidebar First Adv image', 'nova_adv_img4', get_option('nova_adv_img4'), 'Set Sidebar First Adv image.')?>
      </div>

    </div>
  </div>
</div>
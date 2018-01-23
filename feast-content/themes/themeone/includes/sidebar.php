              <div class="col-sm-4 col-md-3 col-md-offset-1 sidebar">
                <div class="widget">
                  <?=form_open(base_url('posts/search'))?>
                    <div class="search-box">
                      <input class="form-control" type="text" name="text" placeholder="Search..."/>
                      <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                  <?=form_close()?>
                </div>
                <div class="widget">
                  <h5 class="widget-title font-alt"><?=is_option('nova_sidebar_title') ? get_option('nova_sidebar_title') : NULL?></h5>

                  <?=(is_option('nova_footer_menu2') && get_option('nova_footer_menu2') != '') ? show_menu(get_option('nova_footer_menu2'), array('nav_tag_open' => '<ul class="icon-list">')) : '<span class="navbar-text pull-left" style="margin: 17px 15px 0 0">No menu selected</span>'?>                  
                </div>

                <?=$this->widget->latest_posts(5)?>
                <!-- End Popular Posts -->        

                <div class="widget">
                  <h5 class="widget-title font-alt"><?=get_option('sidebar_widget_title')?></h5>
                  <?=get_option('sidebar_widget_content')?>
                </div>

                <?=$this->widget->latest_comments()?>

              </div>
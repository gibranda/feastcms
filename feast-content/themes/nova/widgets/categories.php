        <div class="widget">
            <h3><?=is_option('nova_sidebar_title') ? get_option('nova_sidebar_title') : NULL?></h3>
            <div>
                <div class="row-fluid">
                    <div class="col-mr-12">
                    <?=(is_option('nova_footer_menu2') && get_option('nova_footer_menu2') != '') ? show_menu(get_option('nova_footer_menu2'), array('nav_tag_open' => '<ul class="arrow-fluid">')) : '<span class="navbar-text pull-left" style="margin: 17px 15px 0 0">No menu selected</span>'?>       

                    </div>
                </div>

            </div>                       
        </div>
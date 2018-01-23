      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">

            <li <?=!$this->uri->segment(2) ? ' class="active"' : ''?>>
              <a href="<?=base_url('admin')?>">
                <i class="fa fa-dashboard"></i> <span><?=feast_line('dashboard')?></span>
              </a>
            </li>

            <li>
              <a href="<?=base_url()?>" target="_blank">
                <i class="fa fa-home"></i> <span><?=feast_line('visit_site')?></span>
              </a>
            </li>            
            <?=show_admin_menu(FALSE)?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
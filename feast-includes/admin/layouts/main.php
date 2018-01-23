        <!-- header -->
        <?php $this->load->ext_view('admin', 'layouts/includes/header'); ?>

        <!-- sidebar -->
        <?php $this->load->ext_view('admin', 'layouts/includes/sidebar'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=$page_title?>
            <?php if(!$this->uri->segment(3) and $this->uri->segment(2) and !in_array($this->uri->segment(2), array('settings', 'translator', 'apperance', 'media', 'dashboard', 'module', 'comments'))) { ?>
             - <a href="<?=base_url('admin/'.$this->uri->segment(2) .'/add')?>" class="btn btn-sm btn-primary"><?=feast_line('add')?></a>
             <?php } ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=(!$this->uri->segment(2) or $this->uri->segment(2) == 'dashboard') ? '#' : base_url('admin')?>"><i class="fa fa-dashboard"></i> <?=feast_line('dashboard')?></a></li>
            <?php
            if($this->uri->segment(2) && $this->uri->segment(2) != 'dashboard') { ?>
              <li <?=!$this->uri->segment(3) ? ' class="active"' : ''?> >
                <?php
                if(!$this->uri->segment(3)) {
                  echo ucfirst($this->uri->segment(2));                
                } else {
                  echo '<a href="'.base_url('admin/'.$this->uri->segment(2)).'">'.ucfirst($this->uri->segment(2)).'</a>';
                }
                ?>
              </li>              
            <?php } ?>

            <?php
              if($this->uri->segment(3) && in_array($this->uri->segment(3), array('add', 'edit'))) {
                echo '<li class="active">' . feast_line( strtolower($this->uri->segment(3)) ) . '</li>';                
              }
            ?>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content" style="position: relative;">
          <div id="loader">
            <div class="loading">
              <div class="rect1"></div>
              <div class="rect2"></div>
              <div class="rect3"></div>
              <div class="rect4"></div>
              <div class="rect5"></div>
            </div>
          </div>

        <?php
          if(validation_errors()) { ?>
          <div class="col-md-12 no-padding no-margin">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> <?=feast_line('check_errors')?></h4>
              <ul class="no-margin">
                <?=validation_errors('<li>', '</li>')?>
              </ul>
            </div>
          </div>
        <?php 
          }
        ?>

          <?php if(file_exists(FCPATH.'feast-content/modules/'.$main_content.'.php')) {
            $this->load->ext_view('../feast-content/', 'modules/'.$main_content);
          } elseif(file_exists(FCPATH.'feast-includes/admin/'.$main_content.'.php')) {
            $this->load->ext_view('admin', $main_content);
          }  else {
            $this->load->ext_view('admin', $main_content);
          } ?>


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

        <!-- footer -->
        <?php $this->load->ext_view('admin2', 'layouts/includes/footer'); ?>
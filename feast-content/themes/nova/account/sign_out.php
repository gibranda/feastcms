  <section class="title">
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <h1><?=feast_line('login')?></h1>
        </div>
        <div class="span6">
          <ul class="breadcrumb pull-right">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li><a href="#">Pages</a> <span class="divider">/</span></li>
            <li class="active">Registration</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- / .title --> 

  <section class="container">
        <div class="span12">
        	<?php redirect($this->agent->referrer(),'refresh') ?>
            <h2><?php echo lang('sign_out_successful'); ?></h2>

            <p><?php echo anchor('', lang('sign_out_go_to_home'), array('class' => 'button')); ?></p>

        </div>
  </section>
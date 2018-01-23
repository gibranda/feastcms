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
			<?php echo form_open(uri_string().(empty($_SERVER['QUERY_STRING']) ? '' : '?'.$_SERVER['QUERY_STRING'])); ?>
			<?php echo form_fieldset(); ?>
            <div class="span12">
                <h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>

                <p><?php echo lang('reset_password_captcha'); ?></p>
            </div>
            <div class="clear"></div>
            <div class="span6">
				<?php echo form_button(array('type' => 'submit', 'class' => 'btn', 'content' => lang('reset_password_captcha_submit'))); ?>
            </div>
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
        </div>
        <div class="clear"></div>
  </section>
  <section class="title">
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <h1><?php echo lang('forgot_password_page_name'); ?></h1>
        </div>
        <div class="span6">
          <ul class="breadcrumb pull-right">
            <li><a href="<?=base_url()?>">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo lang('forgot_password_page_name'); ?></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- / .title --> 

  <section class="container">
        <div class="span7">

			<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

            <div class="well"><?php echo lang('forgot_password_instructions'); ?></div>

            <div class="control-group <?php echo (form_error('forgot_password_username_email') OR isset($forgot_password_username_email_error)) ? 'error' : ''; ?>">
                <label class="control-label span3" for="forgot_password_username_email"><?php echo lang('forgot_password_username_email'); ?></label>

                <div class="span9">
					<?php
					$value = set_value('forgot_password_username_email') ? set_value('forgot_password_username_email') : (isset($account) ? $account->username : '');
					$value = str_replace(array('\'', '"'), ' ', $value);
					echo form_input(array('class' => 'input-xlarge',
					'name' => 'forgot_password_username_email',
					'id' => 'forgot_password_username_email',
					'value' => $value,
					'maxlength' => '80'
				)); ?>
					<?php if (form_error('forgot_password_username_email') || isset($forgot_password_username_email_error))
				{
					?>
                    <span class="help-inline">
					<?php
						echo form_error('forgot_password_username_email');
						echo isset($forgot_password_username_email_error) ? $forgot_password_username_email_error : '';
						?>
					</span>
					<?php } ?>
                </div>
            </div>

			<?php if (isset($recaptcha)) : ?>
			<?php echo $recaptcha; ?>
			<?php if (isset($forgot_password_recaptcha_error)) : ?>
                <span class="field_error"><?php echo $forgot_password_recaptcha_error; ?></span>
				<?php endif; ?>
			<?php endif; ?>

            <div class="clearfix">
				<?php echo form_button(array(
				'type' => 'submit',
				'class' => 'btn btn-large pull-right',
				'content' => lang('forgot_password_send_instructions')
			)); ?>
            </div>
            <div class="clear"></div>
			<?php echo form_close(); ?>

        </div>
  </section>
    <div id="main" class="container">
    <div class="row">
        <div class="col-md-12">
			<?php echo form_open(uri_string().(empty($_SERVER['QUERY_STRING']) ? '' : '?'.$_SERVER['QUERY_STRING'])); ?>
			<?php echo form_fieldset(); ?>
            <div class="col-md-12">
                <h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>

                <p><?php echo lang('reset_password_captcha'); ?></p>
            </div>
            <div class="clear"></div>
            <div class="col-md-6">
				<?php echo form_button(array('type' => 'submit', 'class' => 'btn', 'content' => lang('reset_password_captcha_submit'))); ?>
            </div>
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
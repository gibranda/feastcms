    <div id="main" class="container">
    <div class="row">
        <div class="col-md-2">
			<?php echo $this->load->view($this->pref->active_theme.'/account/account_menu', array('current' => 'account_password')); ?>
        </div>
        <div class="col-md-10">

			<?php if ($this->session->flashdata('password_info')) : ?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('password_info'); ?>
            </div>
			<?php endif; ?>

        <div class="panel">
            <div class="panel-heading">
            <h2 class="panel-title"><?php echo lang('password_page_name'); ?></h2>
            </div>
            <div class="panel-body">


            <div class="well">
				<?php echo lang('password_safe_guard_your_account'); ?>
            </div>

			<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>

            <br>

            <div class="form-group <?php echo (form_error('password_new_password')) ? 'error' : ''; ?>">
                <label class="control-label col-md-3" for="password_new_password"><?php echo lang('password_new_password'); ?></label>

                <div class="col-md-9">
					<?php echo form_password(array('class' => 'form-control','name' => 'password_new_password', 'id' => 'password_new_password', 'value' => set_value('password_new_password'), 'autocomplete' => 'off')); ?>
					<?php if (form_error('password_new_password'))
				{
					?>
                    <span class="help-inline">
					<?php echo form_error('password_new_password'); ?>
					</span>
					<?php } ?>
                </div>
            </div>

            <div class="form-group <?php echo (form_error('password_retype_new_password')) ? 'error' : ''; ?>">
                <label class="control-label col-md-3 col-md-3" for="password_retype_new_password"><?php echo lang('password_retype_new_password'); ?></label>

                <div class="col-md-9">
					<?php echo form_password(array('class' => 'form-control', 'name' => 'password_retype_new_password', 'id' => 'password_retype_new_password', 'value' => set_value('password_retype_new_password'), 'autocomplete' => 'off')); ?>
					<?php if (form_error('password_retype_new_password'))
				{
					?>
                    <span class="help-inline">
					<?php echo form_error('password_retype_new_password'); ?>
					</span>
					<?php } ?>
                </div>
            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo lang('password_change_my_password'); ?></button>
            </div>

			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>

            </div>
        </div>
        </div>
    </div>
</div>
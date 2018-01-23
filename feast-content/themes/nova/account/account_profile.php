  <section class="title">
    <div class="container">
      <div class="row-fluid">
        <div class="span6">
          <h1><?php echo lang('profile_page_name'); ?></h1>
        </div>
        <div class="span6">
          <ul class="breadcrumb pull-right">
            <li><a href="<?=base_url()?>">Home</a> <span class="divider">/</span></li>
            <li class="active"><?php echo lang('profile_page_name'); ?></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- / .title --> 

  <section class="container">
<style type="text/css">
	ul.user-info li {
		padding: 10px 0;
		border-top: 1px dashed #ddd;
	}
	ul.user-info li:first-child {
		padding-top: 0;
		border-top: 0px dashed #ddd;
	}
</style>
<?php if(!$this->uri->segment(3) or $this->uri->segment(3) == $this->session->userdata('account_id')) { ?>
        <div class="span2">
			<?php echo $this->load->view($this->pref->active_theme.'/account/account_menu', array('current' => 'account_profile')); ?>
        </div>
        <div class="span9">
			<?php if (isset($profile_info))
		{
			?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $profile_info; ?>
            </div>
			<?php } ?>
        	<div class="panel">
			<div class="panel-body">

			<?php echo form_open_multipart(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>

            <div class="control-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
                <label class="control-label span3" for="profile_username"><?php echo lang('profile_username'); ?></label>

                <div class="span9">
					<?php echo form_input(array('class' => 'input-xlarge','name' => 'profile_username', 'id' => 'profile_username', 'value' => set_value('profile_username') ? set_value('profile_username') : (isset($account->username) ? $account->username : ''), 'maxlength' => '24')); ?>
					<?php if (form_error('profile_username') || isset($profile_username_error))
				{
					?>
                    <span class="help-inline">
					<?php
						echo form_error('profile_username');
						echo isset($profile_username_error) ? $profile_username_error : '';
						?>
					</span>
					<?php } ?>
                </div>
            </div>

            <div class="control-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
                <label class="control-label span3" for="profile_picture"><?php echo lang('profile_picture'); ?></label>

                <div class="span9">
                <p>
					<?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) : ?>
					<?php echo showPhoto($account_details->picture); ?> &nbsp;
					<?php echo anchor('account/profile/'.$this->session->userdata('account_id').'/delete', '<i class="icon-trash"></i> '.lang('profile_delete_picture'), 'class="btn"'); ?>
					<?php else : ?>
						
						<div class="accountPicSelect clearfix">
							<div class="pull-left">
								<input type="radio" name="pic_selection" value="custom" checked="true" />
								<?php echo showPhoto(); ?>
							</div>
							<div class="pull-left">
								<p><?php echo lang('profile_custom_upload_picture'); ?><br>
									<?php echo form_upload(array('name' => 'account_picture_upload', 'id' => 'account_picture_upload')); ?><br>
									<small>(<?php echo lang('profile_picture_guidelines'); ?>)</small>
								</p>
							</div>
						</div>

						<div class="accountPicSelect clearfix">
							<div class="pull-left">
								<input type="radio" name="pic_selection" value="gravatar" />
								<?php echo showPhoto( $gravatar ); ?>
							</div>
							<div class="pull-left">
								<p>
									<small><a href="http://gravatar.com/" target="_blank">Gravatar</a></small>
								</p>
							</div>
						</div>
					
					<?php endif; ?>
                    </p>
					<?php if ( ! isset($account_details->picture)) : ?>
					<?php endif; ?>

					<?php if (isset($profile_picture_error))
				{
					?>
                    <span class="help-inline">
					<?php echo $profile_picture_error; ?>
					</span>
					<?php } ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo lang('profile_save'); ?></button>
            </div>

			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>

        	</div>
        	</div>
        </div>
<?php } else { ?>
		<div class="span3">
			<div class="panel">
				<div class="panel-body text-center">
					<?php echo showPhoto($account_details->picture); ?>
					<h3><?=get_user('username', uri_segment(3))?></h3>
					<small>Registerd on: <?=date('d M Y', strtotime(get_user('createdon', uri_segment(3))))?></small>
				</div>
			</div>
		</div>

		<div class="span9">
			<div class="panel">
				<div class="panel-body">
					<ul class="nav user-info">
						<li><strong>Full name: </strong> <?=get_user('fullname', uri_segment(3))?></li>
						<li><strong>Date of birth: </strong> <?=get_user('dateofbirth', uri_segment(3))?></li>
						<li><strong>Gender: </strong> <?=get_user('gender', uri_segment(3)) == 'm' ? 'Male' : 'Female'?></li>
						<li><strong>From: </strong> <?=get_user('country', uri_segment(3))?></li>
					</ul>
				</div>
			</div>
		</div>
<?php } ?>
  </section>

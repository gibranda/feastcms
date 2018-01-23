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
      
  <section id="registration-page" class="container">

    <?php $login = is_demo() == FALSE ? null : 'Demo'; $pass = is_demo() == FALSE ? null : '123321'; ?>

    <?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : ''), 'class="center"'); ?>
      <fieldset class="registration-form">

        <div class="control-group">
          <!-- E-mail -->
          <div class="controls">

            <?php echo form_input(array('class' => 'input-xlarge','name' => 'sign_in_username_email', 'id' => 'sign_in_username_email', 'value' => set_value('sign_in_username_email', $login), 'maxlength' => '24')); ?>
            <?php if (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) :?>
                <span class="help-inline">
                <?php echo form_error('sign_in_username_email'); ?>
                <?php if (isset($sign_in_username_email_error)) : ?>
                    <span class="field_error"><?php echo $sign_in_username_email_error; ?></span>
                <?php endif; ?>
                </span>
            <?php endif; ?>
          </div>
        </div>

        <div class="control-group">
          <!-- Password-->
          <div class="controls">
            <?php echo form_password(array('class' => 'input-xlarge','name' => 'sign_in_password', 'id' => 'sign_in_password', 'value' => set_value('sign_in_password', $pass))); ?>
            <?php if (form_error('sign_in_password')) : ?>
                <span class="help-inline"><?php echo form_error('sign_in_password'); ?></span>
            <?php endif; ?>

            <?php if (isset($recaptcha)) : ?>
                <?php echo $recaptcha; ?>
                <?php if (isset($sign_in_recaptcha_error)) : ?>
                    <span class="field_error"><?php echo $sign_in_recaptcha_error; ?></span>
                <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>

        <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-success btn-large btn-block', 'content' => '<i class="icon-lock"></i> '.lang('sign_in_sign_in'))); ?>
          </div>
          <hr>
          <a href="<?=base_url('account/forgot_password')?>">Forgot password</a> - <a href="<?=base_url('account/sign_up')?>">Crate account</a>
        </div>        

      </fieldset>
    <?php echo form_close(); ?>
    </form>
  </section>
  <!-- /#registration-page -->


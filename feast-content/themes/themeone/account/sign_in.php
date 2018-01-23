    <?php $login = is_demo() == FALSE ? null : 'Demo'; $pass = is_demo() == FALSE ? null : '123321'; ?>
      <div class="main">
        <section class="module bg-dark-30" data-background="<?=theme_folder('themeone')?>assets/images/section-4.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0"><?=feast_line('login')?></h1>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 mb-sm-40">
                <h4 class="font-alt"><?=feast_line('login')?></h4>
                <hr class="divider-w mb-10">
                  <?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : ''), 'class="center"'); ?>
                  <div class="form-group">
                  <?php echo form_input(array('class' => 'form-control','name' => 'sign_in_username_email', 'id' => 'sign_in_username_email', 'value' => set_value('sign_in_username_email', $login), 'maxlength' => '24')); ?>
                  <?php if (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) :?>
                      <span class="help-inline">
                      <?php echo form_error('sign_in_username_email'); ?>
                      <?php if (isset($sign_in_username_email_error)) : ?>
                          <span class="field_error"><?php echo $sign_in_username_email_error; ?></span>
                      <?php endif; ?>
                      </span>
                  <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <?php echo form_password(array('class' => 'form-control','name' => 'sign_in_password', 'id' => 'sign_in_password', 'value' => set_value('sign_in_password', $pass))); ?>
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
                  <div class="form-group">
                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-round btn-b', 'content' => '<i class="icon-lock"></i> '.lang('sign_in_sign_in'))); ?>
                  </div>
                  <div class="form-group"><a href="">Forgot Password?</a></div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </section>
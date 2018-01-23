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
            <h2><?php echo anchor(current_url(), lang('reset_password_page_name')); ?></h2>

            <p><?php echo lang('reset_password_unsuccessful'); ?></p>

            <p><?php echo anchor('account/forgot_password', lang('reset_password_resend'), array('class' => 'btn')); ?></p>
        </div>
  </section>
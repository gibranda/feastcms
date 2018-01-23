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
			<?php echo sprintf(lang('reset_password_sent_instructions'), anchor('account/forgot_password', lang('reset_password_resend_the_instructions'))); ?>
        </div>
  </section>
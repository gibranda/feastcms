<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->
    <?=admin_css('assets/bootstrap/css/bootstrap.min.css')?>

    <?=admin_css('assets/plugins/font-awesome/css/font-awesome.min.css')?>
    
    <?=admin_css('assets/plugins/ionicons/css/ionicons.css')?>

    <?=isset($css) ? $css : ''?>
    
    <?=admin_css('assets/dist/css/AdminLTE.min.css')?>

    <?=admin_css('assets/dist/css/custom.css')?>
    
    <?=admin_css('assets/dist/css/skins/_all-skins.min.css')?>

    <?=admin_css('assets/plugins/iCheck/square/blue.css')?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?=base_url('admin')?>"><b>FEAST</b>CMS</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">

        <?php
          if(validation_errors()) { ?>
          <div class="col-md-12 no-padding no-margin">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> <?=feast_line('check_errors')?></h4>
              <ul class="no-margin">
                <?=validation_errors('<li>', '</li>')?>
              </ul>
            </div>
          </div>
        <?php 
          }
        ?>

        <p class="login-box-msg"><?=feast_line('login_dashboard_msg')?></p>
        <form method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="<?=feast_line('username')?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="<?=feast_line('password')?>" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember"> <?=feast_line('login_remember')?>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><?=feast_line('signin')?></button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="<?=base_url('account/reset_password')?>"><?=feast_line('forgot_password')?></a><br>

      </div><!-- /.login-box-body -->
      <p class="text-center text-muted" style="margin-top: 10px">Copyright © 2017 <a href="http://eadhassan.com" target="_blank"></a>. All rights reserved.</p>
    </div><!-- /.login-box -->

    <?=admin_script('assets/plugins/jQuery/jQuery-2.1.4.min.js')?>

    <?=admin_script('assets/bootstrap/js/bootstrap.min.js')?>

    <?=admin_script('assets/plugins/iCheck/icheck.min.js')?>

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

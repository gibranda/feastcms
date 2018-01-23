<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $page_title = explode('<span', $page_title); ?>
    <title><?php echo feast_line('dashboard'); echo (!$this->uri->segment(2) or $this->uri->segment(2) == 'dashboard') ? ' | ' . $this->pref->site_title : ' | ' . $page_title[0]; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php $dir = is_rtl() ? 'true' : 'false'; ?>
    
    <!-- Bootstrap 3.3.5 -->
    <?=admin_css('assets/bootstrap/css/bootstrap.min.css')?>

    <?=admin_css('assets/plugins/font-awesome/css/font-awesome.min.css')?>
    
    <?=admin_css('assets/plugins/ionicons/css/ionicons.css')?>
    
    <?=admin_css('assets/plugins/pretty.css')?>
    
    <link rel="stylesheet" type="text/css" href="<?=base_url('feast-content/themes/themeone/assets/lib/et-line-font/et-line-font.css')?>">

    <?=isset($css) ? $css : ''?>
    
    <?php if( is_rtl() ) { ?>

    <?=admin_css('assets/dist/css/rtl/AdminLTE.css')?>

    <?php } else { ?>

    <?=admin_css('assets/dist/css/AdminLTE.min.css')?>

    <?php } ?>
    
    <?=admin_css('assets/dist/css/skins/_all-skins.min.css')?>

    <?php if(is_rtl()) {
        echo admin_css('assets/dist/css/rtl/bootstrap-spinner.css');
    } else {
        echo admin_css('assets/dist/css/bootstrap-spinner.css');
    } ?>
    
    <?=admin_css('assets/plugins/iCheck/flat/blue.css')?>
    
    <?=admin_css('assets/plugins/fancybox/css/jquery.fancybox.css')?>

    <?=admin_css('assets/plugins/datatables/dataTables.bootstrap.css')?>

    <?=admin_css('assets/plugins/ion.rangeslider/css/ion.rangeSlider.css')?>

    <?=admin_css('assets/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css')?>
    
    <?=admin_css('assets/plugins/toastr/toastr.min.css')?>
    
    <?=admin_css('assets/dist/css/nested.css')?>
    
    <?=admin_css('assets/plugins/bootstrap-datepicker/css/datepicker3.css')?>

    <?=admin_css('assets/plugins/bootstrap-fileinput/css/fileinput.min.css')?>

    <?=admin_css('assets/plugins/switchery/switchery.min.css')?>

    <?=admin_css('assets/plugins/select2/select2.min.css')?>

    <?=admin_css('assets/dist/css/custom.css')?>

    <?php if( is_rtl() ) { ?>
    
    <?=admin_css('assets/dist/css/rtl/bootstrap-rtl.min.css')?>
    
    <?=admin_css('assets/dist/css/rtl/rtl.css')?>    

    <?php } ?>

    <?=admin_script('assets/plugins/jquery/jquery-2.1.4.min.js')?>

    <!-- jQuery UI 1.11.4 -->
    <?=admin_script('assets/plugins/jquery-ui/jquery-ui.min.js')?>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">var baseUrl = "<?=base_url()?>";</script>
  </head>
  <body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url('admin')?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?=base_url('feast-includes/admin/assets/images/logo-small.png')?>" height="30" alt="F"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="height: 50px; line-height: 50px; display: block;display: flex;align-content: center;align-items: center;"><img src="<?=base_url('feast-includes/admin/assets/images/logo.png')?>" class="img-responsive" alt="FEAST CMS"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <?php if(is_demo() == TRUE) { ?>
              <span class="navbar-text text-danger"><strong><i class="fa fa-exclamation-circle"></i> This is a demo version and all functions not work <i class="fa fa-smile-o"></i></strong></span>
          <?php } ?>          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language"></i> <?=feast_line('language')?></a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <?php foreach(list_langs() as $lang): ?>
                    <li <?=$this->session->userdata('site_lang') == $lang ? ' class="active"' : null?>><a href="<?=base_url('langswitch/switchLanguage/'.$lang)?>"><?=$lang?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?=showPhoto( get_user('picture'), array('class' => 'user-image') )?>
                  <span class="hidden-xs"><?=get_user('username')?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?=showPhoto( get_user('picture'), array('class' => 'img-circle') )?>
                    <p>
                      <?=get_user('username')?>
                      <small>Member since <?=date('M, Y', strtotime(get_user('createdon')))?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?=base_url('account/profile')?>" target="_blank" class="btn btn-default btn-flat"><?=feast_line('profile')?></a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=base_url('account/sign_out')?>" class="btn btn-default btn-flat"><?=feast_line('logout')?></a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  
    Document Title
    =============================================
    -->
    <?php $page_title = isset($page_title) ? ' | ' . $page_title : null ?>
    <title><?php echo $this->pref->site_title . $page_title; ?></title>
    <!--  
    Favicons
    =============================================
    -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-76x76.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo theme_folder('themeone'); ?>assets/images/favicons/android-icon-192x192.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--  
    Stylesheets
    =============================================    
    -->
    <!-- Default stylesheets-->
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php if(is_rtl()) { ?> 
    <link href="http://localhost/feast-cms/feast-content/themes/feast/assets/css/bootstrap-rtl.min.css" rel="stylesheet">
    <?php } ?>
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/animate.css/animate.css" rel="stylesheet">
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/et-line-font/et-line-font.css" rel="stylesheet">
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="<?php echo theme_folder('themeone'); ?>assets/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="<?php echo theme_folder('themeone'); ?>assets/css/style<?=is_rtl() ? '-rtl' : null?>.css" rel="stylesheet">
    <link id="color-scheme" href="<?php echo theme_folder('themeone'); ?>assets/css/colors/default<?=is_rtl() ? '-rtl' : null?>.css" rel="stylesheet">

    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/jquery/dist/jquery.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/js/jquery.mark.min.js"></script>

    <?php $CI =& get_instance(); $CI->load->helper('portfolio/portfolio'); ?> 
  </head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="<?=base_url()?>"><?=$this->pref->site_logo != '' ? '<img src="'.$this->pref->site_logo.'" style="max-height: 100%;">' : $this->pref->site_title?></a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">

                <?php $rtl = is_rtl() ? 'left' : 'right'; ?>

                <ul class="nav navbar-nav navbar-<?=$rtl?>">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language"></i> <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                        <?php foreach(list_langs() as $lang): ?>
                            <li><a href="<?=base_url('langswitch/switchLanguage/'.$lang)?>"><?=ucfirst($lang)?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php if(is_logged_in() == FALSE) { ?>
                    <li class="login"><a href="<?=base_url('account/sign_in')?>"><i class="fa fa-lock"></i></a></li>
                    <?php } else {
                      $profile = is_profile() ? 'active' : null; ?>
                    <li class="login dropdown <?=$profile?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=get_user('username')?> <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="<?=$profile?>"><a href="<?=base_url('account/profile')?>"><i class="glyphicon glyphicon-user"></i> <?=feast_line('profile')?></a></li>
                            <li><a href="<?=base_url('admin')?>" target="_blank"><i class="glyphicon glyphicon-dashboard"></i> <?=feast_line('dashboard')?></a></li>
                            <li><a href="<?=base_url('account/sign_out')?>"><i class="glyphicon glyphicon-log-out"></i> <?=feast_line('logout')?></a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>

                    <?=(is_option('nova_main_menu') && get_option('nova_main_menu') != '') ? show_menu(get_option('nova_main_menu')) : '<span class="navbar-text pull-left" style="margin: 17px 15px 0 0">No menu selected</span>'?>       

          </div>
        </div>
      </nav>
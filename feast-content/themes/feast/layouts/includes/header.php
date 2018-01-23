<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php $page_title = isset($page_title) ? ' | ' . $page_title : null ?>
    <title><?php echo $this->pref->site_title . $page_title; ?></title>

    <!-- meta tags -->
    <meta name="description" content="<?=$this->pref->site_description?>">
    <meta name="keywords" content="<?=$this->pref->site_keywords?>">
    <meta name="generator" content="FeastCMS">

    <!-- Bootstrap -->
    <link href="<?php echo theme_folder('feast'); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo theme_folder('feast'); ?>assets/css/styles/<?=get_option('bootstrap_theme')?>.css" rel="stylesheet">

    <?php if( is_rtl() ) { ?>
    <link href="<?php echo theme_folder('feast'); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet">
    <?php } ?>

    <link href="<?php echo theme_folder('feast'); ?>assets/css/custom.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo theme_folder('feast'); ?>/assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo theme_folder('feast'); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo theme_folder('feast'); ?>/assets/js/bootstrap-hover-dropdown.min.js"></script>

    <script type="text/javascript">
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body <?=is_rtl() ? 'class="rtl"' : null?>>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar top-bar"></span>
          <span class="icon-bar middle-bar"></span>
          <span class="icon-bar bottom-bar"></span>
        </button>
          <a class="navbar-brand" href="<?=base_url()?>">
            <img src="<?=$this->pref->site_logo?>" style="height: 100%">
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation">
  
          <?=add_menu_item(array(
                            'home'        => 'first', 
                            'categories'  => 'first', 
                            'posts'       => 'last'
                          ))?>

          <?=show_menu($key = "home")?>

          <ul class="nav navbar-nav <?=is_rtl() ? ' navbar-left' : ' navbar-right'?>">
            <?php if(is_logged_in() == FALSE) { ?>
            <li><a href="<?=base_url('account/sign_in')?>"><i class="glyphicon glyphicon-user"></i> <?=feast_line('login')?></a></li>
            <?php } else { ?>
            <li class="dropdown  <?=is_profile() ? ' active' : null?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php $direct = is_rtl() ? 'right' : 'left'; $direct2 = is_rtl() ? 'left' : 'right'; ?>
                <?=showPhoto( get_user('picture'), array('style' => 'margin-top: -5px; margin-'.$direct2.': 5px;', 'class' => 'img-responsive img-circle pull-'.$direct, 'height' => 32, 'width' => 32) )?>
                <?=get_user('username')?> 
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li <?=is_profile() ? ' class="active"' : null?>><a href="<?=base_url('account/profile')?>"><i class="glyphicon glyphicon-user"></i> <?=feast_line('profile')?></a></li>
                <?php if( is_admin() ) { ?>
                <li><a href="<?=base_url('admin')?>" target="_blank"><i class="glyphicon glyphicon-dashboard"></i> <?=feast_line('dashboard')?></a></li>
                <?php } ?>
                <li><a href="<?=base_url('account/sign_out')?>"><i class="glyphicon glyphicon-log-out"></i> <?=feast_line('logout')?></a></li>
              </ul>
            </li>
            <?php } ?>
          </ul>

          <ul class="nav navbar-nav <?=is_rtl() ? ' navbar-left' : ' navbar-right'?>">
          	<li class="dropdown">
          		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-globe"></i> <?=feast_line('language')?> <span class="caret"></span></a>
          		<ul class="dropdown-menu">
          			<?php foreach(list_langs() as $lang): ?>
      				<li <?=$this->session->userdata('site_lang') == $lang ? ' class="active"' : null?>><a href="<?=base_url('langswitch/switchLanguage/'.$lang)?>"><?=$lang?></a></li>
          			<?php endforeach; ?>
          		</ul>
          	</li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
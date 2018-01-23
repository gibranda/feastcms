<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php $page_title = isset($page_title) ? ' | ' . $page_title : null ?>
    <title><?php echo $this->pref->site_title . $page_title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="<?=theme_folder('nova')?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=theme_folder('nova')?>/assets/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="<?=theme_folder('nova')?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=theme_folder('nova')?>/assets/css/main.css">
    <link rel="stylesheet" href="<?=theme_folder('nova')?>/assets/css/sl-slide.css">


    <script src="<?=theme_folder('nova')?>/assets/js/vendor/jquery-1.9.1.min.js"></script>

    <script src="<?=theme_folder('nova')?>/assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?=theme_folder('nova')?>/assets/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=theme_folder('nova')?>/assets/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=theme_folder('nova')?>/assets/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=theme_folder('nova')?>/assets/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=theme_folder('nova')?>/assets/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

    <!--Header-->
    <header class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <?php $logo = $this->pref->site_logo != '' ? $this->pref->site_logo : base_url('feast-includes/admin/assets/images/logo.png') ?>
                <a id="logo" class="pull-left" href="<?=base_url()?>">
                    <img src="<?=$logo?>" class="img-responsive" height="100%">
                </a>
                <div class="nav-collapse collapse pull-right">
                    <?=(is_option('nova_main_menu') && get_option('nova_main_menu') != '') ? show_menu(get_option('nova_main_menu')) : '<span class="navbar-text pull-left" style="margin: 17px 15px 0 0">No menu selected</span>'?>       
                    <ul class="nav">

                        <?php if(is_logged_in() == FALSE) { ?>
                        <li class="login">
                            <a href="<?=base_url('account/sign_in')?>"><i class="icon-lock"></i></a>
                        </li>
                        <?php } else { ?>       
                        <li class="login dropdown <?=is_profile() ? 'active' : null?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=get_user('username')?> <i class="icon-angle-down"></i></a>
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
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </header>
    <!-- /header -->

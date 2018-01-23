<?php

error_reporting(E_ALL); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../feast-includes/application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


    // First create the database, then create tables, then write config file
    if ($core->write_config($_POST) == false) {
    	$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
    } elseif($database->create_database($_POST) == false) {
    	$message = $core->show_message('error',"The database could not be created, please verify your settings.");
    } elseif ($database->create_tables($_POST) == false) {
    	$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
    }

    // If no errors, redirect to registration page
    if(!isset($message)) {
            sleep(5);
            header( 'Location: ' . $_POST['root'] ) ;
    } else {
    	echo $message;
    }

}

?>
<!DOCTYPE html>
<html>
    <head>

        <!-- Title -->
        <title>FEAST CMS | Installation wizard</title>

        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="FEAST CMS is an complete content manegment system for your blog, company, portfolio or organization" />
        <meta name="keywords" content="FEAST, cms, content manegment system, php" />
        <meta name="author" content="eadhassan.com" />

        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="../feast-includes/admin/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../feast-includes/admin/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../feast-includes/admin/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <link href="../feast-includes/admin/assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
        
        <link href="assets/custom.css" rel="stylesheet" type="text/css"/>

        <style type="text/css">
            .error {
                color: #c0392b;
            }
        </style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="overlay"></div>
        <main class="page-content content-wrap">
            <!--<div class="navbar">
                <div class="navbar-inner">
                    <div class="logo-box">
                        <a class="logo-text"><span>FEAST</span></a>
                    </div>
                </div>
            </div>-->
            <div class="page-inner">
                <div class="page-title">
                    <h3 class="text-center">
                        <img src="../feast-includes/admin/assets/images/logo.png" alt="FEAST CMS logo" width="150">
                        <p><small>Installation wizard</small></p>
                    </h3>
                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="box">
                                <div class="box-body">
                                    <div id="rootwizard">
                                      <div class="nav nav-tabs-custom">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-home"></i><span> Welcome</span></a></li>
                                            <li role="presentation"><a href="#tab2" data-toggle="tab"><i class="fa fa-cog"></i> Basic settings</a></li>
                                            <li role="presentation"><a href="#tab3" data-toggle="tab"><i class="fa fa-database"></i> Database info</a></li>
                                            <li role="presentation"><a href="#tab4" data-toggle="tab"><i class="fa fa-user"></i> Admin info</a></li>
                                            <li role="presentation"><a href="#tab5" data-toggle="tab"><i class="fa fa-check"></i> Finish</a></li>
                                        </ul>
                                      </div>


                                        <div class="progress progress-sm m-t-sm">
                                            <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            </div>
                                        </div>

                              		    <?php if(isset($message)) {echo '<p class="alert alert-danger">' . $message . '</p>';}?>

                                        <form id="wizardForm" action="" method="post">
                                            <div class="tab-content">
                                                <div class="tab-pane active fade in" id="tab1">
                                                    <div class="row m-b-lg">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="callout callout-info">
                                                                        <h4 class="text-muted">This installation wizard will show you how to install FEAST CMS</h4>
                                                                        <p class="text-danger"><strong>Please make sure the following steps:</strong></p>
                                                                        <ol>
                                                                            <li>Create new database</li>
                                                                            <li>Insert your website title - url and contact email in Basic settings.</li>
                                                                            <li>Insert your new database information in the database settings</li>
                                                                            <li>Insert your admin info in Admin settings.</li>
                                                                        </ol>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade in" id="tab2">
                                                    <div class="row m-b-lg">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="title">Website title</label>
                                                                <input type="text" class="form-control" name="title" id="title" placeholder="Website title" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="root">Website url</label>
                                                                <input type="text" class="form-control" name="root" id="root" placeholder="Website url" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Website email</label>
                                                                <input type="email" class="form-control" name="email" id="email" placeholder="Website email">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="language">Default language</label>
                                                                <select name="language" id="language" class="form-control">
                                                                    <option value="">Select language</option>
                                                                    <option value="english">English</option>
                                                                    <option value="arabic">Arabic</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab3">
                                                    <div class="row m-b-lg">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="host name">Localhost</label>
                                                                <input type="text" class="form-control" name="host name" id="host name" placeholder="host name" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="db_username">Database username</label>
                                                                <input type="text" class="form-control" name="db_username" id="db_username" placeholder="Database username" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="db_password">Database password</label>
                                                                <input type="password" class="form-control" name="db_password" id="db_password" placeholder="Database password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="db_name">Database name</label>
                                                                <input type="text" class="form-control" name="db_name" id="db_name" placeholder="Database password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab4">
                                                    <div class="row m-b-lg">
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                              <label for="username">Username</label>
                                                              <input type="text" class="form-control" name="username" id="username" placeholder="Username" >
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="user_email">Email</label>
                                                              <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Email" >
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="password">Password</label>
                                                              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="password2">Confirm password</label>
                                                              <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm password">
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab5">
                                                    <h2 class="no-s">Installed Successfull!</h2>
                                                    <div class="alert alert-info m-t-sm m-b-lg" role="alert">
                                                        Congratulations ! You got the last step.<br>
                                                        You will redirect to the home page now. please wait ...
                                                    </div>
                                                </div>
                                                <ul class="pager wizard">
                                                    <li class="previous"><a class="btn btn-default"><i class="fa fa-angle-left"></i> Previous</a></li>
                                                    <li class="next"><a class="btn btn-default">Next <i class="fa fa-angle-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                              <div class="box-footer">
                                <p style="padding-top: 10px">RG93bmxvYWRlZCBmcm9tIENPREVMSVNULkND</p>
                              </div>

                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        <div class="cd-overlay"></div>


        <!-- Javascripts -->
        <script src="../feast-includes/admin/assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="../feast-includes/admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="../feast-includes/admin/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../feast-includes/admin/assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="../feast-includes/admin/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/install.js"></script>

    </body>
</html>
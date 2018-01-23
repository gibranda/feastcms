<?php

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
            header( 'Location: ' . $_POST['root'] ) ;
    } else {
    	echo $message;
    }
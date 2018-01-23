<?php

class Core {

	// Function to validate the post data
	function validate_post($data)
	{
		/* Validating the hostname, the database name and the username. The password is optional. */
		return !empty($data['host_name']) && !empty($data['username']) && !empty($data['database']) && !empty($data['root']);
	}

	// Function to show an error
	function show_message($type,$message) {
		return $message;
	}

	// Function to write the config file
	function write_config($data) {

		// Config path
		$template_path 	= 'config/config/database.php';
		$output_path 	= '../feast-includes/application/config/database.php';

		// Open the file
		$database_file = file_get_contents($template_path);

		$new  = str_replace("%HOSTNAME%",$data['host_name'],$database_file);
		$new  = str_replace("%USERNAME%",$data['db_username'],$new);
		$new  = str_replace("%PASSWORD%",$data['db_password'],$new);
		$new  = str_replace("%DATABASE%",$data['db_name'],$new);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {
			// Write the file
			if(fwrite($handle,$new)) {
                if($this->write_database($data) == true) {
					return true;
                } else {
					return false;
                }
			} else {
              return false;
			}
		} else {
			return false;
		}
	}

	function write_database($data) {

		// Config path
		$template_path 	= 'assets/template-install.txt';
		$output_path 	= 'assets/install.txt';

		// Open the file
		$database_file = file_get_contents($template_path);

		include_once('PasswordHash.php');

		$hasher = new PasswordHash(8, FALSE);
		$hashed_password = $hasher->HashPassword($data['password']);

		$new  = str_replace("%ROOT%",$data['root'],$database_file);
		$new  = str_replace("%TITLE%",$data['title'],$new);
		$new  = str_replace("%EMAIL%",$data['email'],$new);
		$new  = str_replace("%LANGUAGE%",$data['language'],$new);
		$new  = str_replace("%USERNAME%",$data['username'],$new);
		$new  = str_replace("%USER_EMAIL%",$data['user_email'],$new);
		$new  = str_replace("%PASSWORD%",$hashed_password,$new);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	function get_domain($url)
	{
	  $pieces = parse_url($url);
	  $domain = isset($pieces['host']) ? $pieces['host'] : '';
	  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
	    return $regs['domain'];
	  }
	  return false;
	}

}
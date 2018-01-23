<?php
  //Loads configuration from database into global CI config
  function load_config()
  {
   $CI =& get_instance();
   foreach($CI->Siteconfig->get_all()->result() as $site_config)
   {
    $CI->config->set_item($site_config->key,$site_config->value);
    if($site_config->key == 'timezone') {
    	date_default_timezone_set($site_config->value);
    } elseif($site_config->key == 'default_controller') {
     $CI->router->default_controller = $site_config->value;
    }
   }
  }
?>
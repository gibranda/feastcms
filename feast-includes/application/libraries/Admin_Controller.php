<?php

class Admin_Controller extends MY_Controller {

    private $CI;

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
		// Login check
		$exception_uris = array(
			'admin/login',
			'admin/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->authentication->is_signed_in() == FALSE) {
				redirect('account/sign_in/?continue='.urlencode(base_url().uri_string()));
			} elseif($this->authorization->is_admin() == FALSE and !$this->authorization->is_permitted('admin_panel')) {
			  echo '<style type="text/css">body, html{ width: 100%; height: 100%;} body{width: 100%; overflow: hidden; margin: 0; padding: 0; height: 100%; background: #2e4254; text-align: center; position: relative;} p{ background:#c0392b; color: #ecf0f1; border-radius: 4px; padding: 15px; display: table; margin:auto; margin-top: 200px; box-shadow: 4px 4px 0 #283848;}</style>';
			  echo '<p>You don\'t have permission to visit this page</p>';
              exit;
			}
		}

    }

}
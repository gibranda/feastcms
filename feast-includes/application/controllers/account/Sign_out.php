<?php
/*
 * Sign_out Controller
 */
class Sign_out extends Frontend_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url'));
		$this->load->config('account/account');
		$this->load->library(array('account/authentication', 'account/authorization'));
	}

	// --------------------------------------------------------------------

	/**
	 * Account sign out
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Redirect signed out users to homepage
		if ( ! $this->authentication->is_signed_in()) redirect('');

		// Run sign out routine
		$this->authentication->sign_out();

		// Redirect to homepage
		if ( ! $this->config->item("sign_out_view_enabled")) redirect('');

        $data['page_title'] = feast_line('logout');

		// Load sign out view
		$data['main_content'] = '/account/sign_out';

		$this->load->view($this->pref->active_theme.'/layouts/main', $data);
	}

}


/* End of file sign_out.php */
/* Location: ./application/account/controllers/sign_out.php */
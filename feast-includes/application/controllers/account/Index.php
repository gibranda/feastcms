<?php
/*
 * Account_profile Controller
 */
class Index extends Frontend_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url', 'photo'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation', 'gravatar'));
		$this->load->model(array('account/account_model', 'account/account_details_model'));

		redirect('account/account_profile','refresh');
	}

}


/* End of file account_profile.php */
/* Location: ./application/account/controllers/account_profile.php */
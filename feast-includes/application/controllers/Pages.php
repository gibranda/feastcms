<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Pages extends Frontend_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

    /**
     * Check if default controller is set to page.
     *
     * @return mixed load view file with data 
     */
	public function index()
	{

		// get default controller value from database
		$this->db->where( 'key', 'default_controller' );
		$query = $this->db->get( 'config_data' );
		$result = $query->row();

		// check resault
		if($result and !empty($result)) {

			// Get page data from database
			$data['page'] = $this->Page_m->get($result->value, TRUE, TRUE);

			// Set page title
	        $data['page_title'] = feast_line('home');

	        // Set view file
	        $data['main_content'] = 'page';

	        // Load view file with data
	        $this->load->view($this->pref->active_theme.'/layouts/main',$data);

		}
	}

    /**
     * Get page data from database.
     *
     * @param int  		Page id to get data from database
     *
     * @param string 	Page slug default as FALSE
     *
     * @return mixed load view file with data 
     */
	public function page ($id, $slug = FALSE)
	{

		// Get menu items
		$data['menu'] = $this->Page_m->get();

		// Get page details
		$data['page'] = $this->Page_m->get($id, TRUE, TRUE);

		// Set page title
        $data['page_title'] = post_title( $data['page'] );

        // Set view file
        $data['main_content'] = 'page';

        // Load view file with data
        $this->load->view($this->pref->active_theme.'/layouts/main',$data);
	}


}
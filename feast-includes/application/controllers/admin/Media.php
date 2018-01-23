<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Media extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }

    function index()
    {
	    // Redirect unauthorized users
	    if ( ! $this->authorization->is_permitted('manage_media'))
	    {
  		$this->session->set_flashdata('access_error', feast_line('access_denied'));
	      redirect($this->agent->referrer());
	    }

		$data['main_content'] = 'media/index';
		$data['page_title'] = feast_line('media');

		$this->load->ext_view('admin', 'layouts/main',$data);
    }


}
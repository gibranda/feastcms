<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Category extends Frontend_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}


    /**
     * Set Category index page.
     *
     * @param int 	$id     Category id to get data from database
     * @param mixed $slug 	Category slug optional FALSE as default  
     *
     * @return html template for viewing category posts
     */
	public function category ($id, $slug = FALSE)
	{

		// Set pagination settings
    	$this->load->library('pagination');
    	
    	$data['total'] = $this->Post_m->get_by(array('category_id' => $id));

    	$config['base_url'] = base_url() . 'category/'.$id.'/'.$slug.'/';
    	$config['total_rows'] = count($data['total']);
    	$config['per_page'] = get_option('category_per_page');
    	$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<div class="row text-center"><div class="col-md-12"><ul class="pagination">';
		$config['full_tag_close'] ='</ul></div></div>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
		$config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tagl_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tagl_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tagl_close'] = '</li>';
    	
		// Initialize pagination
    	$this->pagination->initialize($config);

    	// Get category data from database
        $data['category'] = $this->Category_m->get($id, TRUE);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // Get category posts from database
        $data['posts'] = $this->Post_m->get_last($config['per_page'], $page, $id);

        // Set page title for title tag
        $data['page_title'] = cat_title( $data['category'] );

        // Load view file with data
        $data['main_content'] = 'category';
        $this->load->view($this->pref->active_theme.'/layouts/main',$data);
	}


}
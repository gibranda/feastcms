<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Posts extends Frontend_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}


    /**
     * Get all posts from database
     *
     * @access public
     */
   public function index()
    {

        // Get all posts
		$data['posts'] = $this->Post_m->get();

        // Load pagination library
    	$this->load->library('pagination');

        // Set pagination options    	
    	$config['base_url'] = base_url().'posts/index/';
    	$config['total_rows'] = count( $data['posts'] );
    	$config['per_page'] = get_option('posts_per_page');
    	$config['uri_segment'] = 3;
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
    	
        // Inintialize pagination
    	$this->pagination->initialize($config);
    	
        // Set page title
        $data['page_title'] = feast_line('all', 'posts');

        // Set view file
        $data['main_content'] = 'posts';

        // Load view file with data
        $this->load->view($this->pref->active_theme.'/layouts/main',$data);
    }

    /**
     * Get posts like search
     *
     * @access public
     */
   public function search()
    {

        $data['text'] = $this->input->post('text');

        $search = array('posts.title' => $data['text'], 'posts.body' => $data['text']);

        // Get all posts
        $data['total'] = $this->Post_m->get_results(NULL, 0, $search);

        // Set pagination settings
        $this->load->library('pagination');
        
        $config['base_url'] = base_url() . 'posts/search';
        $config['total_rows'] = count($data['total']);
        $config['per_page'] = get_option('search_per_page');
        $config['uri_segment'] = 3;
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

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Get category posts from database
        $data['posts'] = $this->Post_m->get_results($config['per_page'], $page, $search);
        
        // Set page title
        $data['page_title'] = feast_line('all', 'posts');

        // Set view file
        $data['main_content'] = 'search';

        // Load view file with data
        $this->load->view($this->pref->active_theme.'/layouts/main',$data);
    }

    /**
     * Get single post from database.
     *
     * @param int   $id     Post id to get data from database
     * @param mixed $slug   Post slug optional FALSE as default  
     *
     * @return html template for viewing category posts
     */
	public function single ($id, $slug = FALSE)
	{

        // Get menu items
		$data['menu'] = $this->Page_m->get();

		// Get post details
		$data['post'] = $this->Post_m->get_by_id($id, TRUE, TRUE);

        // Get next post
		$data['next'] = $this->Post_m->get_next($id);

        // Get previuse post
		$data['previuse'] = $this->Post_m->get_previuse($id);

        // Set page title
        $data['page_title'] = post_title( $data['post'] );

        // Set view file
        $data['main_content'] = 'single';

        // Load view file with data
        $this->load->view($this->pref->active_theme.'/layouts/main',$data);
	}


}
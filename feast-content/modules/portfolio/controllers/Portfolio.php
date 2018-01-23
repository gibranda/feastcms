<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Portfolio extends Frontend_Controller {

    public function __construct() {
      parent::__construct();
      module_enable('portfolio') || redirect();
      $this->load->model('Portfolio_m');
      $this->load->helper('portfolio');
    }

    public function index()
    {
 
        // Get all posts
    $data['posts'] = $this->Portfolio_m->get(NULL, FALSE, TRUE);

        // Load pagination library
      $this->load->library('pagination');


      // Set pagination options     
      $config['base_url'] = base_url('portfolio/index');
      $config['total_rows'] = count_table('posts', array('post_type' => 'portfolio', 'statue' => 1));
      $config['per_page'] = get_option('posts_per_page');
      $config['uri_segment'] = 3;
      $config['full_tag_open'] = '<div class="row text-right"><div class="col-md-12"><ul class="pagination">';
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
        $data['page_title'] = feast_line('portfolio');
        $data['module_name'] = 'portfolio';

        // Set view file
        $data['main_content'] = 'portfolio';

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
  public function work ($id, $slug = FALSE)
  {

    // Get post details
    $data['work'] = $this->Portfolio_m->get_by_id($id, TRUE, TRUE);

    // Get next post
    $data['next'] = $this->Portfolio_m->get_next($id);

    // Get previuse post
    $data['previuse'] = $this->Portfolio_m->get_previuse($id);

    // Set page title
    $data['page_title'] = post_title( $data['work'] );

    // Set view file
    $data['main_content'] = 'portfolio_work';

    // Load view file with data
    $this->load->view($this->pref->active_theme.'/layouts/main',$data);
  }

}
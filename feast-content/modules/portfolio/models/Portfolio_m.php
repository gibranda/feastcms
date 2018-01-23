<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Portfolio_m extends MY_Model
{
	protected $_table_name = 'posts';
	protected $_primary_key = 'posts.id';
	protected $_order_by = 'pubdate desc, posts.id desc';
	protected $_timestamps = TRUE;
	public $rules = array(
		'title' => array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'trim|required|max_length[100]|xss_clean'
		),
		'slug' => array(
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'
		),
		'category_id' => array(
			'field' => 'category_id',
			'label' => 'Category',
			'rules' => 'trim|required|is_natural|xss_clean'
		),
		'body' => array(
			'field' => 'body',
			'label' => 'Body',
			'rules' => 'trim|required'
		),
		'pubdate' => array(
			'field' => 'pubdate',
			'label' => 'Publication date',
			'rules' => 'trim|required|exact_length[10]|xss_clean'
		),
		'image' => array(
			'field' => 'image',
			'label' => 'Image',
			'rules' => 'trim|xss_clean'
		)
	);

	public function __construct ()
	{
		parent::__construct();
		$this->load->dbforge();

		
		// Create table if not exist
        $this->dbforge->add_field(array(
                'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'auto_increment' => TRUE
                ),
                'title' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                ),
                'slug' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255'
                ),
                'order' => array(
                        'type' => 'INT',
                        'constraint' => 11
                ),
                'parent_id' => array(
                        'type' => 'INT',
                        'null' => true,
                        'constraint' => 11,
                        'default' => '0'
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('portfolio_cats', TRUE);
        

	}

	public function get_new ()
	{
		$article = new stdClass();
		$article->title = '';
		$article->slug = '';
		$article->body = '';
		$article->category_id = '';
		$article->statue = 1;
		$article->sidebar = 1;
		$article->option = '';
        $article->post_type = 'portfolio';
		$article->pubdate = date('Y-m-d');
		$article->user_id = $this->session->userdata('account_id');
        $map = directory_map(APPPATH . 'language', 1);
        foreach($map as $lang) {
        	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
            if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
              $title = 'title_'.$lang;
              $body = 'body_'.$lang;
              $article->$title = '';
              $article->$body = '';
            }
        }

		return $article;
	}

	public function get($id = NULL, $single = FALSE, $published = FALSE, $category = NULL)
	{
		$this->db->where('posts.post_type', 'portfolio');
		$this->db->select('posts.*, p.title as category, p.slug as cat_slug, c.image, c.thumb, d.*, e.username');
		$this->db->join('portfolio_cats as p', 'posts.category_id=p.id', 'left');
		$this->db->join('images as c', 'posts.id=c.post_id', 'left');
		$this->db->join('post_meta as d', 'posts.id=d.post_id', 'left');
		$this->db->join('feast_account as e', 'posts.user_id=e.id', 'left');
        if($published != FALSE){
		    $this->set_published();
        }
        if(!is_null($category)) {
        	$this->db->where('posts.category_id', $category);
        }
        $this->_primary_key = 'posts.id';
		return parent::get($id, $single);
	}

	public function get_by_category($cat_id, $id = NULL, $single = FALSE)
	{
		$this->db->where('posts.post_type', 'portfolio');
        $this->db->where('posts.category_id', $cat_id);
		return $this->get($id, $single);
	}

    public function get_last($limit = null, $offset = 0, $category = null) {
		$this->db->where('posts.post_type', 'portfolio');
		if(!is_null($limit)) {
        	$this->db->limit($limit, $offset);
		}
    	$this->set_published();
		return $this->get(NULL, FALSE, TRUE, $category);
    }

    public function get_next($id) {
		$this->db->where('posts.post_type', 'portfolio');
        $this->db->where('posts.id >', $id);
        $this->set_published();
        $this->db->limit(1);
        $this->_order_by = "posts.id ASC";
		return $this->get(NULL, TRUE);
    }

    public function get_previuse($id) {
		$this->db->where('posts.post_type', 'portfolio');
        $this->db->where('posts.id <', $id);
        $this->set_published();
        $this->db->limit(1);
        $this->_order_by = "posts.id DESC";
		return $this->get(NULL, TRUE);
    }

    public function get_slider_posts($limit = null, $posts = array(), $cats = array(), $expect_posts = array(), $expect_cats = array())
    {
    	if(!empty($limit)) {
    		$this->db->limit( $limit );
    	}
    	if(!empty($posts)) {
    		$this->db->where_in( 'posts.id', $posts );
    	}
    	if(!empty($cats)) {
    		$this->db->where_in( 'posts.category_id', $cats );
    	}
    	if(!empty($expect_posts)) {
    		$this->db->where_not_in( 'posts.id', $expect_posts );
    	}
    	if(!empty($expect_cats)) {
    		$this->db->where_not_in( 'posts.category_id', $expect_cats );
    	}

    	$this->db->order_by('posts.id', 'DESC');

    	return $this->get(null, FALSE, TRUE);

    }

	public function get_by_id($id = NULL, $single = FALSE, $published = FALSE)
	{
        if($published != FALSE){
		    $this->set_published();
        }
        $this->_primary_key = 'posts.id';
		return $this->get($id, $single);
	}


	public function set_published(){
		$this->db->where('pubdate <=', date('Y-m-d'));
		$this->db->where('statue', 1);
	}

	public function get_recent($limit = 3){
		
		// Fetch a limited number of recent posts
		$limit = (int) $limit;
		$this->db->where('posts.post_type', 'post');
		$this->set_published();
		$this->db->limit($limit);
		return $this->get();
	}

}
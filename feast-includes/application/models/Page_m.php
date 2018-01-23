<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Page_M extends MY_Model
{
	protected $_table_name = 'posts';
	protected $_primary_key = 'posts.id';
	protected $_order_by = 'pubdate desc, posts.id desc';
	protected $_timestamps = TRUE;
	public $rules = array(
		'pubdate' => array(
			'field' => 'pubdate',
			'label' => 'Publication date',
			'rules' => 'trim|required|exact_length[10]|xss_clean'
		),
		'image' => array(
			'field' => 'image',
			'label' => 'Image',
			'rules' => 'trim|xss_clean'
		),
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
		'order' => array(
			'field' => 'order',
			'label' => 'Order',
			'rules' => 'trim|numeric|xss_clean'
		),
		'body' => array(
			'field' => 'body',
			'label' => 'Body',
			'rules' => 'trim|required'
		)
	);

	public function get_new ()
	{
		$page = new stdClass();
		$page->title = '';
		$page->slug = '';
		$page->body = '';
		$page->category_id = '0';
		$page->statue = 1;
		$page->sidebar = 1;
		$page->option = '';
        $page->post_type = 'page';
		$page->pubdate = date('Y-m-d');
		$page->user_id = $this->session->userdata('account_id');
		$page->parent_id = '';
		$page->order = '0';
        $map = directory_map(APPPATH . 'language', 1);
        foreach($map as $lang) {
        	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
            if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
              $title = 'title_'.$lang;
              $body = 'body_'.$lang;
              $page->$title = '';
              $page->$body = '';
            }
        }

		return $page;
	}

	public function save_order ($pages)
	{
		if (count($pages)) {
			foreach ($pages as $order => $page) {
				if ($page['item_id'] != '') {
					$data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
					$this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
				}
			}
		}
	}

	public function get_nested()
	{
		$this->db->order_by($this->_order_by);
		$this->db->where('post_type', 'page');
		$this->db->where('in_menu', 1);
		$pages = $this->db->get('posts')->result_array();

		$array = array();
		foreach ($pages as $page) {
			if (!$page['parent_id']) {
				// This page has no parent
				$array[$page['id']] = $page;
			}
			else {
				// This is a child page
				$array[$page['parent_id']]['children'][] = $page;
			}
		}
		return $array;
	}

	public function get($id = NULL, $single = FALSE, $published = FALSE)
	{
		$this->db->where('posts.post_type', 'page');
		$this->db->select('posts.*, b.image, b.thumb, c.*');
		$this->db->join('images as b', 'posts.id=b.post_id', 'left');
		$this->db->join('post_meta as c', 'posts.id=c.post_id', 'left');
        if($published != FALSE){
		    $this->set_published();
        }
        $this->_primary_key = 'posts.id';
		return parent::get($id, $single);
	}


	public function get_by($where = FALSE, $single = FALSE, $like = FALSE){
		if($where != FALSE) {
			$this->db->where($where);
		}
		if($like != FALSE) {
			$this->db->like($like);
		}
		return $this->get(NULL, $single, TRUE);
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

}
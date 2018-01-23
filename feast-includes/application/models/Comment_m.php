<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Comment_M extends MY_Model {

	protected $_table_name = 'comments';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();

	function __construct() {
		parent::__construct();
	}

	public function get($id = NULL, $single = FALSE)
	{
		$this->db->select('comments.*, p.title as post, p.id as post_id, p.slug as post_slug, p.post_type');
		$this->db->join('posts as p', 'comments.post_id=p.id', 'left');
        $this->_primary_key = 'comments.id';
		return parent::get($id, $single);
	}


	public function get_comments($post = null)
	{
		if(!is_null($post)) {
			$this->db->where('post_id', $post);
		}
		return $this->get(NULL, FALSE);
	}

}



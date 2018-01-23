<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Category_M extends MY_Model
{
	protected $_table_name = 'categories';
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
		'parent_id' => array(
			'field' => 'parent_id',
			'label' => 'Parent category',
			'rules' => 'trim|is_natural|xss_clean'
		),
		'order' => array(
			'field' => 'order',
			'label' => 'Order',
			'rules' => 'trim|required|is_natural|xss_clean'
		)
	);

	public function get_new ()
	{
		$article = new stdClass();
		$article->title = '';
		$article->slug = '';
		$article->parent_id = 0;
		$article->order = '';
		return $article;
	}

    public function get_last($limit = 5) {
        $this->db->limit($limit);
		return $this->get();
    }

}
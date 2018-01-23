<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Menu_model extends MY_Model
{
	protected $_table_name = 'menu';
	public $rules = array(
		'title' => array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'trim|required|max_length[100]|xss_clean'
		),
		'alias' => array(
			'field' => 'alias',
			'label' => 'Alias',
			'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'
		),
		'st_tag' => array(
			'field' => 'st_tag',
			'label' => 'Start tag',
			'rules' => 'trim|xss_clean'
		),
		'en_tag' => array(
			'field' => 'en_tag',
			'label' => 'End tag',
			'rules' => 'trim|xss_clean'
		),
		'item_st_tag' => array(
			'field' => 'item_st_tag',
			'label' => 'Item start tag',
			'rules' => 'trim|xss_clean'
		),
		'item_en_tag' => array(
			'field' => 'item_en_tag',
			'label' => 'Item end tag',
			'rules' => 'trim|xss_clean'
		),
		'sub_st_tag' => array(
			'field' => 'sub_st_tag',
			'label' => 'Sub-menu start tag',
			'rules' => 'trim|xss_clean'
		),
		'sub_en_tag' => array(
			'field' => 'sub_en_tag',
			'label' => 'Sub-menu end tag',
			'rules' => 'trim|xss_clean'
		),
		'active_class' => array(
			'field' => 'active_class',
			'label' => 'Active class',
			'rules' => 'trim|xss_clean'
		),
		'has_sub_class' => array(
			'field' => 'has_sub_class',
			'label' => 'Has-sub class',
			'rules' => 'trim|xss_clean'
		)
	);

	public function get_new ()
	{
		$menu = new stdClass();
		$menu->title = '';
		$menu->alias = '';
		$menu->st_tag = '';
		$menu->en_tag = '';
		$menu->item_st_tag = '';
		$menu->item_en_tag = '';
		$menu->sub_st_tag = '';
		$menu->sub_en_tag = '';
		$menu->active_class = '';
		$menu->has_sub_class = '';
		return $menu;
	}

	public function all()
	{
		return $this->db->get("menu_items")
					->result_array();
	}


}
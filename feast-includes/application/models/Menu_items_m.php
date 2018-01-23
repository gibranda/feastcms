<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Menu_items_m extends MY_Model
{
	protected $_table_name = 'menu_items';
	protected $_primary_key = 'id';
	protected $_order_by = 'order asc';

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
		return $this->db->get("menus")
					->result_array();
	}

	public function save_order ($items)
	{
		if (count($items)) {
			foreach ($items as $order => $item) {
				if(!array_key_exists('item_id', $item)) { 
					if ($item['id'] != '') {
						$data = array('parent_id' => (int) $item['parent_id'], 'order' => $order);
						$this->db->set($data)->where($this->_primary_key, $item['id'])->update($this->_table_name);
					}
				} elseif($item['item_id'] != '') {
					if ($item['item_id'] != '') {
						$data = array('parent_id' => (int) $item['parent_id'], 'order' => $order);
						$this->db->set($data)->where($this->_primary_key, $item['item_id'])->update($this->_table_name);
					}
				}
			}
		}
	}

	public function get_nested ($published = TRUE, $menu_id = null)
	{
		is_null($menu_id) || $this->db->where('menu_id', $menu_id);
		$this->db->order_by($this->_order_by);
		$items = $this->db->get('menu_items')->result_array();

		$array = array();
		foreach ($items as $item) {
			if (! $item['parent_id']) {
				// This page has no parent
				$array[$item['id']] = $item;
			}
			else {
				// This is a child page
				$array[$item['parent_id']]['children'][] = $item;
			}
		}
		return $array;
	}

	public function get_with_parent ($id = NULL, $single = FALSE)
	{
		$this->db->select('menu_items.*, p.link as parent_link, p.title as parent_title');
		$this->db->join('menu_items as p', 'menu_items.parent_id=p.id', 'left');
		return parent::get($id, $single);
	}

	public function get_no_parents ()
	{
		// Fetch items without parents
		$this->db->select('id, title');
		$this->db->where('parent_id', 0);
		$items = parent::get();

		// Return key => value pair array
		$array = array(
			0 => 'No parent'
		);
		if (count($items)) {
			foreach ($items as $item) {
				$array[$item->id] = $item->title;
			}
		}

		return $array;
	}

}
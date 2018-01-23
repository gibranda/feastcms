<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Image_M extends MY_Model
{
	protected $_table_name = 'images';
	protected $_primary_key = 'id';
	protected $_order_by = 'id desc';

	public function update($data, $id = NULL){

		$check = parent::get_by(array('post_id' => $id));

		if(count($check)) {
	    	$filter = $this->_primary_filter;
	    	$id = $filter($id);
	    	$this->db->set($data);
	    	$this->db->where('post_id', $id);
	    	$id = $this->db->update($this->_table_name);
		} else {
			$data['post_id'] = $id;
			parent::save($data);
		}


		return $id;
	}

}
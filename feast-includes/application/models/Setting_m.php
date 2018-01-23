<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Setting_M extends MY_Model {

  protected $_table_name = 'settings';
  protected $_order_by = 'order asc';
  public $rules = array();

    public function update($data, $key) {
        $this->db->where('key', $key);
        $this->db->update($this->_table_name, $data);
        return true;
    }


}
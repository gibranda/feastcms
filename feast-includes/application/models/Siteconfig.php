<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Siteconfig extends CI_Model {

 public function __construct()
 {
    parent::__construct();
 }

 public function get_all()
 {
    return $this->db->get('config_data');
 }

}
<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Prefs extends CI_Model {

    function __construct()
    {
      parent::__construct();
      $pre = array();
      $CI = &get_instance();

      if($this->config->item("useDatabaseConfig"))
      {
        $pr = $this->db->get("settings")->result();

        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->value);
        }
      } else {
        $pre = (object) $CI->config->config;
      }
      $CI->pref = (object) $pre;
    }

}
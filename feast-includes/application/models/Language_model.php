<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Language_Model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get_all($where = NULL)
  {
    if(isset($where))
    {
      $this->db->where($where);
    }
    $this->db->order_by('language_name','ASC');
    $query = $this->db->get('languages');
    if($query->num_rows()>0)
    {
      return $query->result();
    }
    return FALSE;
  }

  public function get_by_id($id = NULL)
  {
    if(isset($id) && is_int($id))
    {
      $this->db->where('id',$id);
      $query = $this->db->get('languages');
      if($query->num_rows()==1)
      {
        return $query->row();
      }
    }
    return FALSE;
  }

  public function create($data)
  {
    if($data['default']=='1')
    {
      $this->db->where('default', '1');
      $this->db->update('languages', array('default'=>'0'));
    }
    return $this->db->insert('languages',$data);
  }

  public function update($language_id, $data)
  {
    if($data['default']=='1')
    {
      $this->db->where('default', '1');
      $this->db->update('languages', array('default'=>'0'));
    }
    $this->db->where('id',$language_id);
    return $this->db->update('languages',$data);
  }

  public function delete($language_id)
  {
    return $this->db->delete('languages', array('id'=>$language_id));
  }

  public function update_phrases($data, $key, $lang) {
      $this->db->where('description', $key);
      $this->db->where('lang', $lang);
      $id = $this->db->get('lang_token');
      if(count($id)){
          $this->db->where('description', $key);
          $this->db->where('lang', $lang);
          $this->db->update('lang_token', $data);
      }
      else {
          $this->db->set($data);
          $this->db->insert('lang_token');
      }
      return true;
  }

}
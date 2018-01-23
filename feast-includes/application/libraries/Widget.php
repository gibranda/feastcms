<?php
/**
 * Widget library
 * This class enables you to use Widgets system in your preview
 *
 * @package       CodeIgniter
 * @subpackage    Librarys
 * @category      Widgets
 * @version       1.0.0
 * @author        Ead Hassan
 * @link          http://eadhassan.com/codeigniter-widgets
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Widget
{
    function __construct()
    {
        $this->ci = & get_instance();
        log_message('debug', 'Widget Library: Initialized');
    }

    function latest_posts($limit = 7, $category = null)
    {
        $data['posts'] = list_posts($limit, 0, $category);
        return $this->ci->load->view($this->ci->pref->active_theme . '/widgets/latest_posts', $data, TRUE);
    }

    function latest_comments($limit = 7)
    {
        $data['comments'] = latest_comments($limit);
        return $this->ci->load->view($this->ci->pref->active_theme . '/widgets/latest_comments', $data, TRUE);
    }

    function list_cats($expect = null)
    {
        $this->ci->db->select('*');
        if($expect != null) {
            $this->ci->db->where_not_in('id', $expect);
        }

        $data['categories'] = $this->ci->db->get('categories')->result();
        return $this->ci->load->view($this->ci->pref->active_theme . '/widgets/categories', $data, TRUE);
    }

}
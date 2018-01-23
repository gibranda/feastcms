<?php

/**
 * List all works with accessibility to set a limit option
 *
 * @access public
 *
 * @return array of portfolio works
 */

function list_works ($limit = null, $offset = 0, $category = null)
{

  $CI =& get_instance();
  @$CI->load->model('portfolio/Portfolio_m');
  return @$CI->Portfolio_m->get_last($limit, $offset, $category);

}

// list all categories
function list_portfolio_cats ($limit = NULL)
{

  $CI =& get_instance();
  @$CI->load->database();
  @$CI->db->select('*');
  if($limit != NULL) {
    @$CI->db->limit($limit);
  }
  @$CI->db->order_by('order asc');
  return @$CI->db->get('portfolio_cats')->result();
}

// post category slug
function post_cat_slug($post)
{
  return $post->cat_slug;
}

// post url
function work_url($post)
{
 return base_url('portfolio/work/'.$post->id.'/'.$post->slug);
}
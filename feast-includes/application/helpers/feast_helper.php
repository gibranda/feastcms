<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
function uniord($u) 
{
    // i just copied this function fron the php.net comments, but it should work fine!
    $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
    $k1 = ord(substr($k, 0, 1));
    $k2 = ord(substr($k, 1, 1));
    return $k2 * 256 + $k1;
}

/**
 * Check if given string is arabic.
 *
 * @param string $str String to check  
 *
 * @return bool  TRUE if is arabic or FALSE if not
 */
function is_arabic($str) 
{
    if(mb_detect_encoding($str) !== 'UTF-8') {
        $str = mb_convert_encoding($str,mb_detect_encoding($str),'UTF-8');
    }

    /*
    $str = str_split($str); <- this function is not mb safe, it splits by bytes, not characters. we cannot use it
    $str = preg_split('//u',$str); <- this function woulrd probably work fine but there was a bug reported in some php version so it pslits by bytes and not chars as well
    */
    preg_match_all('/.|\n/u', $str, $matches);
    $chars = $matches[0];
    $arabic_count = 0;
    $latin_count = 0;
    $total_count = 0;
    foreach($chars as $char) {
        //$pos = ord($char); we cant use that, its not binary safe
        $pos = uniord($char);

        if($pos >= 1536 && $pos <= 1791) {
            $arabic_count++;
        } else if($pos > 123 && $pos < 123) {
            $latin_count++;
        }
        $total_count++;
    }
    if(($arabic_count/$total_count) > 0.6) {
        // 60% arabic chars, its probably arabic
        return true;
    }
    return false;
}

function get_ol ($array, $child = FALSE)
{
  $str = '';

  if (count($array)) {
    $str .= @$child == FALSE ? '<ol class="sortable" style="margin: 0 0 2em">' : '<ol>';

    foreach ($array as $item) {
      $str .= '<li id="list_' . @$item['id'] .'">';
      $str .= '<div>' . @$item['title'];
      $str .= '<span class="pull-right"><a id="editItem" href="#" data-id="' . @$item['id'] .'" title="edit item"><i class="fa fa-edit"></i> </a>';
      $str .= '<a href="#" class="text-danger" title="delete item" data-id="' . @$item['id'] .'" id="deleteItem"> <i class="fa fa-trash"></i></a></span>';
      $str .= '</div>';

      // Do we have any children?
      if (@isset($item['children']) && @count($item['children'])) {
        $str .= @get_ol($item['children'], TRUE);
      }

      $str .= '</li>' . PHP_EOL;
    }

    $str .= '</ol>' . PHP_EOL;
  }

  return $str;
}


/**
 * Check if current language is rtl.
 *
 * @param string $str String to check  
 *
 * @return bool  TRUE if is arabic or FALSE if not
 */
function is_rtl()
{
  $CI =& get_instance();
    if(@$CI->session->userdata('site_lang')) {
      if(@$CI->session->userdata('site_lang') == 'arabic') {
          return true;
      } else {
          return false;
      }
    } elseif(@$CI->pref->default_language == 'arabic') {
        return true;
    } else {
        return false;
    }
}

/*
 * User helpers
 */
function is_logged_in()
{
  $CI =& get_instance();
  @$CI->load->library('account/authorization');
  @$CI->load->library('account/authentication');
  return @@$CI->authentication->is_signed_in() ? TRUE : FALSE;
}

function is_admin()
{
  $CI =& get_instance();
  @$CI->load->library('account/authorization');
  @$CI->load->library('account/authentication');
  return @@$CI->authorization->is_admin() ? TRUE : FALSE;
}

function get_user($field, $id = null)
{
  $CI =& get_instance();
  @$CI->load->model('account_details_model');
  @$CI->load->model('account_model');
  @$CI->load->library('session');

  if($id == null) {
    $id = @$CI->session->userdata('account_id');
  }

  if($field) {
    if ( in_array($field, array('username', 'email', 'createdon')) ) {
      return @@$CI->account_model->get_by_id($id)->$field;
    } elseif($field == 'picture') {
      $val = @@$CI->account_details_model->get_by_account_id($id)->$field;
      return (is_null($val) or !$val) ? 'avatar.png' : $val;
    } else {
      return @@$CI->account_details_model->get_by_account_id($id)->$field;  
    }    
  } else {
    return @@$CI->account_details_model->get_by_account_id($id);   
  }
}

/*
 * Check Module state Enable/Disable
 */
function module_enable($module = NULL)
{
  $CI =& get_instance();
  $CI->load->database();
  if($module == NULL) return FALSE;

  $CI->db->where('module_name', $module);
  $module_data = $CI->db->get('modules')->row();
  if(!count($module_data)) return FALSE;
  return $module_data->statue == 'enable' ? TRUE : FALSE;

}

function theme_has_options($theme = null)
{
  $CI =& get_instance();
  $theme = is_null($theme) ? @$CI->pref->active_theme : $theme;
  $theme_settings = FCPATH.'feast-content/themes/'.$theme.'/theme_options/index.php';
  if(file_exists($theme_settings)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function theme_folder($theme = null)
{
  $CI =& get_instance();

  $theme = is_null($theme) ? $CI->pref->active_theme : $theme;

  return base_url().config_item('templates_path').$theme.'/';
}
function system_ver()
{
  return '2.1';
}

function sliders_list()
{
  $CI =& get_instance();
  @$CI->load->model(array('Slide_m', 'Post_m'));

  $sliders = @$CI->Slide_m->get();
  $list = array();
  $i = 0;
  foreach( $sliders as $slide ):
    //array_push($list, array($slide->id => $slide->title));
    $list[$slide->title] = $slide->alias;
  endforeach;

  return $list;
}

function get_slider($alias = null) 
{
  $CI =& get_instance();
  @$CI->load->model(array('Slide_m', 'Post_m'));

  $slider = @$CI->Slide_m->get_by(array('alias' => $alias), TRUE);

  if(count($slider)) {
      $slider->sliderSource = unserialize(base64_decode($slider->sliderSource));

      if($slider->sliderType == 1) {

          $i = 1;
          foreach( @$CI->Post_m->get_slider_posts($slider->sliderSource['postNum'], array(), array(), isset($slider->sliderSource['expectPosts']) ? $slider->sliderSource['expectPosts'] : null, isset($slider->sliderSource['expectCats']) ? $slider->sliderSource['expectCats'] : null) as $slide ) {
            $slider->sliderSource[$i]['title'] = post_title($slide);
            $slider->sliderSource[$i]['date'] = post_date($slide, TRUE);
            $slider->sliderSource[$i]['thumb'] = post_thumb($slide, 'small');
            $slider->sliderSource[$i]['text'] = post_body($slide) ;
            $slider->sliderSource[$i]['button'] = post_url($slide) ;
            $slider->sliderSource[$i]['button_text'] = 'Read more' ;
            $slider->sliderSource[$i]['button_target'] = '_blank' ;
            $slider->sliderSource[$i]['background'] = isset($slider->sliderSource['postBg']) ? post_image($slide) : $slider->sliderSource['staticBg'];
            $i++;
          }

          if(isset($slider->sliderSource['postNum'])) {unset($slider->sliderSource['postNum']);}
          if(isset($slider->sliderSource['expectPosts'])) {unset($slider->sliderSource['expectPosts']);}
          if(isset($slider->sliderSource['expectCats'])) {unset($slider->sliderSource['expectCats']);}
          if(isset($slider->sliderSource['postBg'])) {unset($slider->sliderSource['postBg']);}
          if(isset($slider->sliderSource['staticBg'])) {unset($slider->sliderSource['staticBg']);}

      } elseif ($slider->sliderType == 2) {

          $i = 1;
          foreach( @$CI->Post_m->get_slider_posts($slider->sliderSource['postNum'], $slider->sliderSource['custPosts']) as $slide ) {
            $slider->sliderSource[$i]['title'] = post_title($slide);
            $slider->sliderSource[$i]['text'] = post_body($slide) ;
            $slider->sliderSource[$i]['button'] = post_url($slide) ;
            $slider->sliderSource[$i]['button_text'] = 'Read more' ;
            $slider->sliderSource[$i]['button_target'] = '_blank' ;
            $slider->sliderSource[$i]['background'] = isset($slider->sliderSource['postBg']) ? post_image($slide) : $slider->sliderSource['staticBg'];
            $i++;
          }

          if(isset($slider->sliderSource['postNum'])) {unset($slider->sliderSource['postNum']);}
          if(isset($slider->sliderSource['custPosts'])) {unset($slider->sliderSource['custPosts']);}
          if(isset($slider->sliderSource['postBg'])) {unset($slider->sliderSource['postBg']);}
          if(isset($slider->sliderSource['staticBg'])) {unset($slider->sliderSource['staticBg']);}
           
      } elseif ($slider->sliderType == 3) {

          $i = 1;
          foreach( @$CI->Post_m->get_slider_posts($slider->sliderSource['postNum'], array(), $slider->sliderSource['custCats']) as $slide ) {
            $slider->sliderSource[$i]['title'] = post_title($slide);
            $slider->sliderSource[$i]['text'] = post_body($slide);
            $slider->sliderSource[$i]['button'] = post_url($slide) ;
            $slider->sliderSource[$i]['button_text'] = 'Read more' ;
            $slider->sliderSource[$i]['button_target'] = '_blank' ;
            $slider->sliderSource[$i]['background'] = isset($slider->sliderSource['postBg']) ? post_image($slide) : $slider->sliderSource['staticBg'];
            $i++;
          }
          if(isset($slider->sliderSource['postNum'])) {unset($slider->sliderSource['postNum']);}
          if(isset($slider->sliderSource['custCats'])) {unset($slider->sliderSource['custCats']);}
          if(isset($slider->sliderSource['postBg'])) {unset($slider->sliderSource['postBg']);}
          if(isset($slider->sliderSource['staticBg'])) {unset($slider->sliderSource['staticBg']);}

      } else {
          if(isset($slider->sliderSource['postNum'])) {unset($slider->sliderSource['postNum']);}
          if(isset($slider->sliderSource['staticBg'])) {unset($slider->sliderSource['staticBg']);}
          if(isset($slider->sliderSource['postBg'])) {unset($slider->sliderSource['postBg']);}
          $i = 1;
          foreach( $slider->sliderSource as $slide ) {
            $slider->sliderSource[$i]['title'] = $slide['slideTitle'];
            $slider->sliderSource[$i]['text'] = $slide['slideDesc'];
            $slider->sliderSource[$i]['button'] = $slide['slideBtnL'];
            $slider->sliderSource[$i]['button_text'] = $slide['slideBtnT'];
            $slider->sliderSource[$i]['button_target'] = isset($slide['slideBtnTa']) ? $slide['slideBtnTa'] : '_parent';
            $slider->sliderSource[$i]['background'] = $slide['slideBg'];

          if(isset($slider->sliderSource[$i]['slideTitle'])) {unset($slider->sliderSource[$i]['slideTitle']);}
          if(isset($slider->sliderSource[$i]['slideDesc'])) {unset($slider->sliderSource[$i]['slideDesc']);}
          if(isset($slider->sliderSource[$i]['slideBtnL'])) {unset($slider->sliderSource[$i]['slideBtnL']);}
          if(isset($slider->sliderSource[$i]['slideBtnT'])) {unset($slider->sliderSource[$i]['slideBtnT']);}
          if(isset($slider->sliderSource[$i]['slideBtnTa'])) {unset($slider->sliderSource[$i]['slideBtnTa']);}
          if(isset($slider->sliderSource[$i]['slideBg'])) {unset($slider->sliderSource[$i]['slideBg']);}

            $i++;
          }
      }

      return $slider->sliderSource;
  } else {
    return FALSE;
  }

}

function slider_option($alias = null, $option = null) {
  $CI =& get_instance();
  @$CI->load->model(array('Slide_m', 'Post_m'));

  $slider = @$CI->Slide_m->get_by(array('alias' => $alias), TRUE);
  $slider->customize = unserialize(base64_decode($slider->customize));

  if(isset($slider->customize[$option])) {
    if($option != null) {
      if($option == 'autoplay') {
        return $slider->customize[$option] == 1 ? $slider->customize['autoplay_delay'] : 'false';
      } elseif (in_array($option, array('navigation', 'pagination'))) {
        return isset($slider->customize[$option]) ? 'true' : 'false';
      } else {
        return $slider->customize[$option];
      }
    } else {
      return 'error';
    }
  } else {
    return FALSE;
  }

}

function slide_title($slide)
{
  return $slide['title'];
}

function slide_text($slide, $limit = 10)
{
  return strip_tags( word_limiter( $slide['text'], $limit ), '<br>' );
}

function slide_button($slide)
{
  return $slide['button'];
}

function slide_button_text($slide)
{
  return $slide['button_text'];
}

function slide_button_target($slide)
{
  return $slide['button_target'];
}

function slide_background($slide)
{
  return $slide['background'];
}

function slide_thumb($slide)
{
  return $slide['thumb'];
}

function slide_date($slide)
{
  return $slide['date'];
}

function uri_segment($seg)
{
  $CI =& get_instance();
  return @$CI->uri->segment($seg);
}

function list_langs()
{
    $map = directory_map(APPPATH . 'language', 1);
    $return = array();
    foreach($map as $lang) {
    $lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
      if(is_dir(APPPATH . 'language/'.$lang) and file_exists(APPPATH . 'language/'.$lang.'/file_lang.php')) {
        $return[] = $lang;
      }
    }

    return $return;

}

function feast_line($line = '', $swap = null) 
{
  $CI =& get_instance();
  $loaded_line    = @$CI->lang->line($line) == '' ? $line : @$CI->lang->line($line);
  // If swap if not given, just return the line from the language file (default codeigniter functionality.)
  if(!$swap) return str_replace('%s', '', $loaded_line);

  // If an array is given
  if (is_array($swap)) {
      // Explode on '%s'
      $exploded_line = explode('%s', $loaded_line);

      // Loop through each exploded line
      foreach ($exploded_line as $key => $value) {
          // Check if the $swap is set
          if(isset($swap[$key])) {
              // Append the swap variables
              $exploded_line[$key] .= $swap[$key];
          }
      }
      // Return the implode of $exploded_line with appended swap variables
      return implode('', $exploded_line);
  }
  // A string is given, just do a simple str_replace on the loaded line
  else {
      return str_replace('%s', $swap, $loaded_line);
  }
}

function feast_head($container = NULL)
{
  $CI =& get_instance();
  @$CI->load->library('session');
}

function feast_footer()
{
  return '<script type="text/javascript">$.get("top_menu.php"), function(data) {$("body").prepend( "<div id="topTop"></div>" ).html( data );alert( data );};</script>';
}

function load_template($template, $data = array())
{
  $CI =& get_instance();

  return @$CI->load->view(THEME.'/'.$template, $data);
}

/*
 *----------------------------------------
 * Admin scripts
 *----------------------------------------
 */
function admin_script($file, $theme = 'admin')
{
  return '<script src="' . base_url('feast-includes') . '/' . $theme . '/' . $file . '"></script>';
}

/*
 *----------------------------------------
 * Admin css link
 *----------------------------------------
 */
function admin_css($file, $theme = 'admin')
{
  return '<link rel="stylesheet" type="text/css" href="' . base_url('feast-includes') . '/' . $theme . '/' . $file . '" />';
}

/*
 *---------------------------------------
 * Dynamic Admin Menu
 *---------------------------------------
 */

  function show_admin_menu($dumb = FALSE)
  {

    $CI =& get_instance();
    $CI->load->model('Admin_menu');

    $CI->Admin_menu->build_menu();
    if($dumb != FALSE) return $CI->Admin_menu->dump_menu();

    $menu_items = $CI->Admin_menu->menu_items;
    $menu  = '';
    foreach($menu_items as $section):
      $title = feast_line($section['title']);
        $menu .= '
    <li class="header">'.$title.'</li>';
        if(count($section['items'])) {
          foreach($section['items'] as $item):
            $link = count($item['items']) ? '#' : base_url('admin/'.$item['url']);
            $active =  strpos( current_url(), $item['url'] ) ? 'active treeview' : 'treeview';
            $title2 = feast_line($item['title']);
            $menu .= '
    <li class="'.$active.'"><a href="'.$link.'">
    <i class="'.$item['icon'].'"></i> <span>'.$title2.'</span>';
          $menu .= count($item['items']) ? '<i class="fa fa-angle-left pull-right"></i></a>' : '</a>';
            if(count($item['items'])) {
              $menu .= '
      <ul class="treeview-menu">';
              foreach($item['items'] as $sub):
                $title3 = feast_line($sub['title']);
                $act =  current_url() == base_url('admin/'.$sub['url']) ? 'active' : '';
                $menu .= '
        <li class="'.$act.'"><a href="'.base_url('admin/'.$sub['url']).'"><i class="fa fa-circle-o"></i> '.$title3.'</a></li>
                ';
              endforeach;
              $menu .= '
      </ul>';
              $menu .= '
    </li>';
            } else {
              $menu .= '
    </li>';
          }
        endforeach;
      }
    endforeach;

    return $menu;   
  }

    function add_admin_section($name, $order = 4)
    {

    $CI =& get_instance();
    $CI->load->model('Admin_menu');
    $CI->Admin_menu->build_menu();

    return $CI->Admin_menu->add_section($name, $order = 4);
    }

    function add_admin_menu_item($name, $url, $icon = null,$order = 90, $section = 0)
    {

    $CI =& get_instance();
    $CI->load->model('Admin_menu');
    $CI->Admin_menu->build_menu();

    return $CI->Admin_menu->add_menu_item($name, $url, $icon = null,$order = 90, $section = 0);

    }

    function add_admin_sub_menu($name, $url, $order = 90, $section = 0, $parent = 0)
    {

    $CI =& get_instance();
    $CI->load->model('Admin_menu');
    $CI->Admin_menu->build_menu();

    return $CI->Admin_menu->add_sub_menu_item($name, $url, $order = 90, $section = 0, $parent = 0);

    }



function count_table ($table, $where = NULL)
{

  $CI =& get_instance();
  @$CI->load->database();
  @$CI->db->select('*');
  if($where != NULL){
    @$CI->db->where($where);
  }
  return @$CI->db->count_all_results($table);
}

function add_meta_title ($string)
{
	$CI =& get_instance();
	@$CI->data['meta_title'] = e($string) . ' - ' . @$CI->data['meta_title'];
}

function is_home ()
{
  $CI =& get_instance();
  if( !@$CI->uri->segment(1) or @$CI->uri->segment(1) == @$CI->router->default_controller) {
      return true;
  }

}

function is_account ()
{
  $CI =& get_instance();
  if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'account') {
      return true;
  }
}

function is_profile ()
{
  $CI =& get_instance();
  if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'account') {
    if( @$CI->uri->segment(2) and @$CI->uri->segment(2) == 'profile' ) {
      return true;
    }
  }
}

function is_account_settings ()
{
  $CI =& get_instance();
  if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'account') {
    if( @$CI->uri->segment(2) and @$CI->uri->segment(2) == 'settings' ) {
      return true;
    }
  }
}

function is_account_password ()
{
  $CI =& get_instance();
  if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'account') {
    if( @$CI->uri->segment(2) and @$CI->uri->segment(2) == 'password' ) {
      return true;
    }
  }
}

function is_posts ()
{
  $CI =& get_instance();
  if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'posts') {
      return true;
  } else {
    return false;
  }
}

function is_post ()
{
  $CI =& get_instance();
  if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'post') {
      return true;
  }
}

function is_category ($id = null)
{
  $CI =& get_instance();
  if(!is_null($id)) {
    if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'category' and @$CI->uri->segment(2) == $id) {
        return true;
    } else {
      return false;
    }
  }
  if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'category') {
      return true;
  } else {
    return false;
  }
}

function is_page ($slug = null)
{
  $CI =& get_instance();
  if(!is_null($slug)) {
    if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'page' and @$CI->uri->segment(3) == $slug) {
        return true;
    } else {
      return false;
    }
  }
  if( @$CI->uri->segment(1) and @$CI->uri->segment(1) == 'page') {
      return true;
  } else {
    return false;
  }
}

//***************************************************************
// Functions to get all category infromation 
// Get (title - image - date ...) for single post
//***************************************************************

// list all categories
function list_cats ($limit = NULL)
{

  $CI =& get_instance();
  @$CI->load->database();
  @$CI->db->select('*');
  if($limit != NULL) {
    @$CI->db->limit($limit);
  }
  @$CI->db->order_by('order asc');
  return @$CI->db->get('categories')->result();
}

// post title
function cat_title($cat)
{
 return $cat->title;
}

// post title
function cat_slug($cat)
{
 return $cat->slug;
}

// post title
function cat_order($cat)
{
 return $cat->order;
}

// post id
function cat_id($cat)
{
 return $cat->id;
}

// post url
function cat_url($cat)
{
 return base_url('category/' . $cat->id . '/' . $cat->slug);
}

function menus_list()
{
  $CI =& get_instance();
  @$CI->load->model('Menu_model');

  $menus = @$CI->Menu_model->get();
  $list = array();
  $i = 0;
  foreach( $menus as $menu ):
    //array_push($list, array($slide->id => $slide->title));
    $list[$menu->title] = $menu->alias;
  endforeach;

  return $list;
}

/**
 * List all posts with accessibility to set a limit option
 *
 * @access public
 *
 * @return array of posts
 */

function list_posts ($limit = null, $offset = 0, $category = null)
{

  $CI =& get_instance();
  @$CI->load->model('Post_m');
  return @$CI->Post_m->get_last($limit, $offset, $category);

}

// post url
function post_url($post)
{
  $type = $post->post_type == 'post' ? 'post' : 'page';
 return base_url($type . '/'.$post->id.'/'.$post->slug);
}

// post id
function post_id($post)
{
 return $post->id;
}

// post title
function post_title($post)
{
  $CI =& get_instance();
  @$CI->load->library('session');
  if(!@$CI->session->userdata('site_lang') and @$CI->pref->default_language != 'english') {
    $session = 'title_'.@$CI->pref->default_language;
    $title = !empty($post->$session) ? $post->$session : $post->title;
  } elseif((!@$CI->session->userdata('site_lang') and  @$CI->pref->default_language == 'english') or @$CI->session->userdata('site_lang') == 'english') {
    $title = $post->title;
  } else {
    $session = 'title_'.@$CI->session->userdata('site_lang');
    $title = !empty($post->$session) ? $post->$session : $post->title;
  }
   return $title;
}

function post_body($post)
{
  $CI =& get_instance();
  @$CI->load->library('session');
  if(!@$CI->session->userdata('site_lang') and @$CI->pref->default_language != 'english') {
    $session = 'body_'.@$CI->pref->default_language;
    $body = !empty($post->$session) ? $post->$session : $post->body;
  } elseif((!@$CI->session->userdata('site_lang') and  @$CI->pref->default_language == 'english') or @$CI->session->userdata('site_lang') == 'english') {
    $body = $post->body;
  } else {
    $session = 'body_'.@$CI->session->userdata('site_lang');
    $body = !empty($post->$session) ? $post->$session : $post->body;
  }
   return do_shortcode($body);
}

function post_option($option = null, $post)
{
  if($post->option) {
      $options = unserialize(base64_decode($post->option));
  } else {
      $options = array();
  }

  if($option) {
    return @$options[$option]['value'];
  } else {
    foreach($options as $key => $value):
      @$array[$key] = $value['value'];
    endforeach;

    return $array;
  }  
}

function post_excerpt($post, $chars = NULL, $words = 20 )
{
  $CI =& get_instance();
  @$CI->load->library('session');

  if(!@$CI->session->userdata('site_lang') and @$CI->pref->default_language != 'english') {
    $session = 'body_'.@$CI->pref->default_language;
    $body = !empty($post->$session) ? $post->$session : $post->body;
  } elseif((!@$CI->session->userdata('site_lang') and  @$CI->pref->default_language == 'english') or @$CI->session->userdata('site_lang') == 'english') {
    $body = $post->body;
  } else {
    $session = 'body_'.@$CI->session->userdata('site_lang');
    $body = !empty($post->$session) ? $post->$session : $post->body;
  }

  if(!is_null($chars)) {
    $body = character_limiter( strip_tags($body) , $chars);
  } elseif(!is_null($words)) {
    $body = $CI->shortcode->run($body);
    $body = word_limiter( strip_tags($body) , $words);
  }

   return $body;
}

// post slug
function post_slug($post)
{
  return $post->slug;
}

// post author
function post_author($post)
{
  return $post->username;
}

// post category
function post_category($post)
{
  return $post->category;
}

// post category
function post_cat_url($post)
{
  return base_url('category/' . $post->category_id . '/' . $post->cat_slug);
}

// post thumbnail
function post_thumb($post, $size = null)
{
  if(!is_null($size)) {
    if(!is_null($post->image)) {
      return base_url('feast-content/thumbs/' . $size . '_' . $post->image);
    } else {
      return base_url('feast-content/thumbs/' . $size . '_no-image.jpg');
    }
  } else {
    if(!is_null($post->image)) {
      return base_url('feast-content/thumbs/' . $post->image);
    } else {
      return base_url('feast-content/thumbs/no-image.jpg');
    }
  }
}

// post image
function post_image($post)
{
  if(!is_null($post->image)) {
    return base_url('feast-content/uploads/' . $post->image);
  } else {
    return base_url('feast-content/uploads/no-image.jpg');   
  }
}

// post date
function post_date($post, $nice = TRUE)
{
  $CI =& get_instance();
  @$CI->load->library('text_formatting');
  if($nice == FALSE) {
    return $post->created;    
  } else {
    return @$CI->text_formatting->date_special( $post->created );
  }
}

// post statue
function post_statue($post)
{
  return $post->statue;
}

function login_box()
{
  $CI =& get_instance();

  return $CI->load->ext_view('admin', 'widgets/login_box');
}

function comment_box($id, $customClass = null, $inputClass = null, $bootstrap = null)
{
  $CI =& get_instance();

  $CI->db->where( 'key', 'default_controller' );
  $query = $CI->db->get( 'config_data' );
  $result = $query->row();

  $id = is_null($id) ? $result->value : $id;


  $str = '
      <script type="text/javascript">

        $(function() {
            var segment = "'.@$CI->uri->segment(2).'";

            $.ajax({

                type: "POST",

                url: "'.base_url('comment').'/index/" + segment ,

                data: {id: segment},

                cache: false,

                success: function(data){

                  $("#comments").html(data);

                }

            });
        });

        $(function() {

            $("#submit").click(function() {

                var name = $("#name").val();

                var email = $("#email").val();

                var comment = $("#comment").val();

                var user_type = $("#user_type").val();
                
                var user_id = $("#user_id").val();

                var dataString = "name="+ name + "&email=" + email + "&comment=" + comment + "&user_type=" + user_type + "&user_id=" + user_id;

                var segment = "'.@$CI->uri->segment(2).'";

                if(name=="" || email=="" || comment=="") {

                    alert("Please check all Filds");

                }

                else {

                    //$("#display_comment").show();

                    var topOffset = $("#comments").offset().top;

                    $("#add_comment")[0].reset();

                    $("html, body").animate({scrollTop : topOffset-100},300);

                    $("#comments").fadeIn(100).html("<img src=\"'.THEME_FOLDER.'assets/images/AjaxLoader.gif\" width=\"48\" />Please Wait...");

                    $.ajax({

                        type: "POST",

                        url: "'.base_url('comment/addcomment').'/"+ segment,

                        data: dataString,

                        cache: false,

                        success: function(data){

                            $("#comments").html(data);

                            $("#comments").fadeIn(slow);

                        }

                    });

                }return false;



            });



        });
    
      </script>
  ';

  if(is_logged_in() == TRUE) {
    $username = get_user('username');
    $email = get_user('email');
    $user_type = 1;
    $user_id = @$CI->session->userdata('account_id');
    $ufield = ' type="hidden"';
    $efield = ' type="hidden"';
  } else {
    $username = null;
    $user_type = 2;
    $user_id = '';
    $email = null;
    $ufield = ' type="text"';
    $efield = ' type="email"';
  }

  if($bootstrap != null) {
    $bootstrap = 'span';
  } else {
    $bootstrap = 'col-md-';
  }

  $inputClass = is_null($inputClass) ? 'form-control' : $inputClass;

  $str .= '
                <div class="'.$customClass.'">
                  <h4>'.feast_line('leave_comment').':</h4>
                  '.form_open( base_url('comments/add_comment/'.$id), array('role' => 'form', 'id' => 'add_comment', 'class' => $customClass) ).'
                  <input type="hidden" class="form-control" name="user_type" value="'.$user_type.'" id="user_type">
                  <input type="hidden" class="form-control" name="user_id" value="'.$user_id.'" id="user_id">
                  <div class="row-fluid">
                    <div class="'.$bootstrap.'6">
                      <div class="form-group">
                        <input '.$ufield.' class="'.$inputClass.'" placeholder="'.feast_line('name').'" name="name" value="'.$username.'" id="name">
                      </div>
                    </div>
                    <div class="'.$bootstrap.'6">
                      <div class="form-group">
                        <input '.$efield.' class="'.$inputClass.'" placeholder="'.feast_line('email').'" name="email" value="'.$email.'" id="email">
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="'.$bootstrap.'12">
                      <div class="form-group">
                        <textarea class="'.$inputClass.'" placeholder="'.feast_line('your_comment').'" name="comment" id="comment" rows="10"></textarea>
                      </div>
                    </div>
                  </div>
                  <button type="submit" id="submit" class="btn btn-primary">'.feast_line('submit_comment').'</button>
                  '.form_close().'
                </div>
  ';

  return $str;
  
}

function show_comments()
{
  $str  = '
      <div id="comments" style="margin-bottom: 30px"></div>
  ';

  return $str; 
}

function count_comments($post = null)
{
  $CI =& get_instance();
  @$CI->load->model('Comment_m');
  $count = @count( $CI->Comment_m->get_comments( is_null($post) ? null : $post->id ) );
  $count = $count > 0 ? $count : 'No';
  return $count;
}

function latest_comments($limit = 5)
{
  $CI =& get_instance();
  @$CI->load->model('Comment_m');
  @$CI->load->database();
  @$CI->db->limit($limit);
  return @$CI->Comment_m->get();
}

function list_comments($post = null)
{
  $CI =& get_instance();
  @$CI->load->model('Comment_m');
  return @$CI->Comment_m->get_comments( is_null($post) ? null : $post->id );
}

// comment date
function comment_date($comment, $nice = TRUE)
{
  $CI =& get_instance();
  @$CI->load->library('text_formatting');
  if($nice == FALSE) {
    return $comment->created;    
  } else {
    return @$CI->text_formatting->date_special( $comment->created );
  }
}

// comment id
function comment_id($comment)
{
  return $comment->id;
}

// comment username
function comment_username($comment)
{
  return $comment->username;
}

// comment username
function comment_email($comment)
{
  return $comment->email;
}

// the comment
function comment_text($comment)
{
  return $comment->text;
}

// the comment
function comment_post($comment)
{
  return $comment->post;
}

// the comment
function comment_post_url($comment)
{
  $type = $comment->post_type == 'post' ? 'post' : 'page';
 return base_url($type . '/'.$comment->post_id.'/'.$comment->post_slug);
}

// the comment
function comment_post_id($comment)
{
  return $comment->post_id;
}

/* 
 * Contact form 
 */
function contact_form()
{
    $str = ''.
            form_open( base_url('home/contact/'), array('role' => 'form', 'id' => 'contactForm') ).'
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success success_message" style="display: none"></div>
                        <div class="alert alert-danger error_message" style="display: none"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required="required" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" name="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="submitContact">
                            Send Message</button>
                    </div>
                </div>
            '.form_close().'
            <script>
                $(document).ready(function(){
                    $("#contactForm").submit(function(event) {
                        event.preventDefault();
                        $.ajax({
                
                            type: "POST",
                
                            url: '.base_url('home/contact/').',
                
                            data: $("#contactForm").serialize(),
                
                            cache: false,
                
                            success: function(data){
                
                              $(".success_message").html(data).show();
                
                            }
                
                        });
                    });
                });
            </script>
    ';
    return $str;
}

function list_pages ($published = TRUE)
{

  $CI =& get_instance();
  @$CI->load->model('Page_m');
  return @$CI->Page_m->get(NULL, FALSE, TRUE);

}


function article_link($article){
	return 'article/' . intval($article->id) . '/' . e($article->slug);
}
function article_links($articles){
	$string = '<ul>';
	foreach ($articles as $article) {
		$url = article_link($article);
		$string .= '<li>';
		$string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
		$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
		$string .= '</li>';
	}
	$string .= '</ul>';
	return $string;
}

function get_excerpt($article, $numwords = 50){
	$string = '';
	$url = article_link($article);
	$string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';
	$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
	$string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
	return $string;
}

function limit_to_numwords($string, $numwords){
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}

function e($string){
	return htmlentities($string);
}

function add_menu_item($item, $position = 'last')
{
  $CI =& get_instance();
  $CI->load->library('multi_menu');
  if(!is_array($item)) {
    $CI->multi_menu->inject_item($item, $position);
  } else {
    foreach($item as $key => $value):

      switch ($key) {
        case 'home':
          $add_item_act = is_home() == true ? 'class="active"' : NULL;
          $add_item = '<li ' . $add_item_act . '><a href="'.base_url().'">'.feast_line('home').'</a></li>'; 

          $CI->multi_menu->inject_item($add_item, $value);

          break;

        case 'posts':
          $add_item_act = is_posts() == true ? 'class="active"' : NULL;
          $add_item = '<li ' . $add_item_act . '><a href="'.base_url('posts').'">'.feast_line('blog').'</a></li>'; 
          $CI->multi_menu->inject_item($add_item, $value);
          break;

        case 'categories':
          $add_item_act = is_category() == true ? ' active' : NULL;
          $add_item = '<li class="dropdown ' . $add_item_act . '"><a tabindex="0" class="dropdown-toggle" href="#">'.feast_line('categories').'<span class="caret"></span></a>'; 
          $add_item .= '<ul class="dropdown-menu">'; 
          foreach(list_cats() as $cat):
            $set_active = is_category(cat_id($cat)) ? 'class="active"' : null;
            $add_item .= '<li '.$set_active.'><a href="'.cat_url($cat).'">'.cat_title($cat).'</a></li>'; 
          endforeach;
          $add_item .= '</ul>'; 
          $add_item .= '</li>'; 
          $CI->multi_menu->inject_item($add_item, $value);
          break;

        }
    endforeach;
  }
}

function objectToArray( $object ){
   if( !is_object( $object ) && !is_array( $object ) ){
    return $object;
 }
if( is_object( $object ) ){
    $object = get_object_vars( $object );
}
    return array_map( 'objectToArray', $object );
}

function show_menu($menu, $config = array(), $additional = array())
{
  $CI =& get_instance();
  $CI->load->model('Menu_items_m');
  $CI->load->model('Menu_model');
  $CI->load->library('multi_menu');

  $menu_id = $CI->Menu_model->get_by(array('alias' => $menu), TRUE);
  $menu_id = objectToArray($menu_id);

  if(!count($menu_id)) { return FALSE;}

  foreach ($menu_id as $key => $value) {
    if($key == 'id') {
      $id_menu = $value;
    }
  }

  $items = $CI->Menu_items_m->get_by(array('menu_id' => $id_menu));

  if(!count($items)) { return FALSE;}

  $items = objectToArray($items);

  if(count($additional)) {
    foreach ($additional as $ad_item):
      $items[] = array(
        'title' => $ad_item['title'],
        'link' => $ad_item['link'],
        'order' => $ad_item['order'],
        'parent_id' => $ad_item['parent_id']
      );
    endforeach;
  }

  $CI->multi_menu->set_items($items);

  $navbar_class = is_rtl() ? ' navbar-left' : ' navbar-right';

  if(!count($config)) {
    $config = array(
              'nav_tag_open'        => '<ul class="nav navbar-nav'.$navbar_class.'">',            
              'parentl1_tag_open'   => '<li class="dropdown">',
              'parentl1_anchor'     => '<a href="%s" class="dropdown-toggle" data-toggle="dropdown">%s <i class="icon-angle-down"></i></a>',
              'parent_tag_open'     => '<li class="dropdown">',
              'parent_anchor'       => '<a href="%s" class="dropdown-toggle" data-toggle="dropdown">%s <i class="icon-angle-down"></i></a>',
              'children_tag_open'   => '<ul class="dropdown-menu">'
            );
  }

  $menu = $CI->multi_menu->render($config);

  return $menu;
}

function get_menu ()
{
  $CI =& get_instance();
  @$CI->load->model('Page_m');
  return @$CI->Page_m->get_by(array('in_menu' => 1));
}

function get_menu_items ($menu_id)
{
  $CI =& get_instance();
  @$CI->load->model('Menu_items_m');
  return @$CI->Menu_items_m->get_by(array('menu_id' => $menu_id));
}

function admin_input_text ($label, $name, $value, $warning = FALSE)
{
  $str = '<div class="form-group">';
  $str .= '<label class="control-label col-md-3" for="'.$name.'" style="padding-left: 0">'.$label;
  if($warning != FALSE) {
    $str .= '<p class="help-block text-info">'.$warning.'</p>';
  }
  $str .= '</label>';
  $str .= '<div class="col-md-3">';
  $str .= form_input(strtolower($name), set_value(strtolower($label), $value, FALSE), array('class' => 'form-control', 'id' => $name));
  $str .= form_error(strtolower($name), '<p class="text-danger">', '</p>');
  $str .= '</div>';
  
  $str .= '</div>';

  return $str;
}

function admin_input_spinner ($label, $name, $value, $warning = FALSE)
{
  $str = '<div class="form-group spinner" data-trigger="spinner">';
  $str .= '<label class="control-label col-md-3" for="'.$name.'" style="padding-left: 0">'.$label;
  if($warning != FALSE) {
    $str .= '<p class="help-block text-info">'.$warning.'</p>';
  }
  $str .= '</label>';
  $str .= '<div class="col-md-3">';
  $str .= '<input type="text" class="form-control" name="' . $name . '" id="'.$name.'" value="' . $value . '" data-rule="quantity">';
  $str .= '<div class="input-group-addon">';
  $str .= '<a href="javascript:;" class="spin-up" data-spin="up"><i class="fa fa-caret-up"></i></a>';
  $str .= '<a href="javascript:;" class="spin-down" data-spin="down"><i class="fa fa-caret-down"></i></a>';
  $str .= '</div>';
  $str .= form_error(strtolower($name), '<p class="text-danger">', '</p>');
  $str .= '</div>';
  
  $str .= '</div>';

  return $str;
}

function admin_switch ($label, $name, $value, $warning = FALSE)
{

  $str = '<div class="form-group">';
  $str .= '<div class="ios-switch switch-lg">';
  $str .= '<label class="control-label col-md-3" style="padding-left: 0;" for="'.$name.'">';
  $str .= '<span class="check-label">' . $label . '&nbsp;</span>';
  if($warning != FALSE) {
    $str .= '<p class="help-block">'.$warning.'</p>';
  }
  $str .= '</label>';

  $str .= '<div class="col-md-3">';
  if($value == 1) {$val = 'checked';} else {$val = null;}
  $str .= '<input type="checkbox" class="js-switch pull-left" name="' . $name . '" id="'.$name.'" value="' . $value . '" ' . $val . '>';
  $str .= '</div>';
  
  $str .= '</div>';
  
  $str .= form_error(strtolower($name), '<p class="text-danger">', '</p>');
  $str .= '</div>';

  return $str;
}

function admin_radio ($label, $name, $options = null, $value, $warning = FALSE)
{

  $str  = '<div class="form-group">';
  $str .= '<label class="control-label col-md-3" for="'.$name.'" style="padding-left: 0">'.$label;
  if($warning != FALSE) {
    $str .= '<p class="help-block text-info">'.$warning.'</p>';
  }
  $str .= '</label>';
  $str .= '<div class="col-md-6">';

  $val1  = $value == 1 ? ' checked' : null;
  $val11 = $value == 1 ? ' active' : null;
  $val2  = $value == 0 ? ' checked' : null;
  $val22 = $value == 0 ? ' active' : null;

  $str .= '<div class="btn-group colors" data-toggle="buttons">';

  if(!is_null($options)) {
    foreach($options as $key => $val):
      $str .= '<label class="btn btn-primary';
      $str .= $value == $key ? ' active' : null;
      $str .= '">';
      $str .= '<input type="radio" name="'.$name.'" value="'.$key.'" autocomplete="off" ';
      $str .= $value == $key ? ' checked' : null;
      $str .= '> ' . $val;
      $str .= '</label>';
    endforeach;
  } else {
    $str .= '<label class="btn btn-primary ' . $val22 . '">';
    $str .= '<input type="radio" name="'.$name.'" value="0" autocomplete="off" ' . $val2 . '> Off';
    $str .= '</label>';
    $str .= '<label class="btn btn-primary ' . $val11 . '">';
    $str .= '<input type="radio" name="'.$name.'" value="1" autocomplete="off" ' . $val1 . '> On';
    $str .= '</label>';
  }
  $str .= '</div>';

  $str .= form_error(strtolower($name), '<p class="text-danger">', '</p>');
  $str .= '</div>';
  $str .= '</div>';

  return $str;
}

function admin_select ($label, $name, $options, $value, $warning = FALSE, $label_col = 3, $control_col = 3)
{
  $dir = $dir = is_rtl() ? 'rtl' : 'ltr';
  $str  = '<div class="form-group">';
  $str .= '<label class="control-label col-md-' . $label_col . '" for="'.$name.'" style="padding-left: 0">'.$label;
  if($warning != FALSE) {
    $str .= '<p class="help-block">'.$warning.'</p>';
  }
  $str .= '</label>';
  $str .= '<div class="col-md-' . $control_col . '">';
  $str .= '<select name="'.$name.'" class="select2" id="'.$name.'">';
  foreach($options as $key => $val) {
    $selected = $value == $val ? ' selected' : '';
    $str .= '<option value="'.$val.'"'. $selected .'>'.$key.'</option>';
  }
  $str .= '</select>';
  $str .= form_error(strtolower($name), '<p class="text-danger">', '</p>');
  $str .= '</div>';  
  $str .= '</div>';

  return $str;
}

function admin_radio_image ($label, $name, $options, $value, $warning = FALSE)
{
  $str  = '<div class="form-group img-radio">';
  $str .= '<div class="col-md-3" style="padding-left: 0">';
  $str .= '<label class="control-label" for="'.$name.'">' . $label;
  if($warning != FALSE) {
    $str .= '<p class="help-block">'.$warning.'</p>';
  }
  $str .= '</label>';
  $str .= '</div>';

  $str .= '<div class="col-md-9">';

  if(count($options) <= 4) { $col = 3;} else { $col = 2;}
  foreach($options as $key => $val) {
    $selected = $value == $key ? ' checked="checked"' : '';
    $str .= '<label for="' . $name . '" class="col-md-'.$col.'" style="padding-left: 0; padding-right: 10px;">';
    $str .= '<input type="radio" class="no-uniform" name="' . $name . '"value="' . $key . '" id="'.$name.'" ' . $selected . ' />';
    $str .= '<img src="' . $val . '" alt="'.$name.'" />';
    $str .= '</label>';
  }
  $str .= '</div>';

  $str .= '</div>';

  return $str;
} 

function admin_textarea ($label, $name, $value, $warning = FALSE)
{
  $str = '<div class="form-group">';
  $str .= '<label class="control-label col-md-3" for="'.$name.'" style="padding-left: 0">'.$label;
  if($warning != FALSE) {
    $str .= '<p class="help-block">'.$warning.'</p>';
  }
  $str .= '</label>';
  $str .= '<div class="col-md-9">';
  $str .= form_textarea(strtolower($name), set_value(strtolower($label), $value, FALSE), array('class' => 'form-control', 'style' => 'height: 150px !important', 'id' => $name));
  $str .= form_error(strtolower($name), '<p class="text-danger">', '</p>');
  $str .= '</div>';
  $str .= '</div>';

  return $str;
}

function admin_slider ($label, $name, $value, $min = 1, $max = 10, $prefix = 's ', $step = 1, $warning = FALSE)
{
  $str = '<div class="form-group">';
  $str .= '<label class="control-label col-md-3" for="'.$name.'" style="padding-left: 0">'.$label;
  if($warning != FALSE) {
    $str .= '<p class="help-block text-info">'.$warning.'</p>';
  }
  $str .= '</label>';
  $str .= '<div class="col-md-3">';
  $str .= form_input(strtolower($name), set_value(strtolower($label), $value), array('class' => 'ui-slider', 'id' => $name, 'data-min' => $min, 'data-max' => $max, 'data-prefix' => $prefix, 'data-from' => $value, 'data-step' => $step, 'data-grid' => true));
  $str .= form_error(strtolower($name), '<p class="text-danger">', '</p>');
  $str .= '</div>';
  
  $str .= '</div>';

  return $str;
}

function admin_upload($label, $name, $value, $warning = FALSE)
{
  $CI =& get_instance();
  $str  = '<div class="form-group">';

  $str .= '<label class="control-label col-md-3" for="'.$name.'" style="padding-left: 0">'.$label;
  if($warning != FALSE) {
    $str .= '<p class="help-block">'.$warning.'</p>';
  }
  $str .= '</label>';
  $str .= '<div class="col-md-3">';
  $str .= '<div class="input-group input-group-sm">';
  $str .= '<input class="form-control iframe-btn" type="text" value="'.set_value($name, get_option($name)).'" name="'.$name.'" id="'.$name.'">';
  $str .= '<span class="input-group-btn">';
  $str .= '<a href="#" class="btn btn-danger delete_media" id="image" data-toggle="tooltip" data-title="remove" type="button"><i class="fa fa-trash"></i></a>';
  $str .= '<a href="'.base_url().'feast-includes/admin/assets/filemanager/dialog.php?type=1&field_id='.$name.'" class="btn btn-success iframe-btn" data-toggle="tooltip" data-title="select image" type="button"><i class="fa fa-folder-open"></i></a>';
  $str .= '</span>';
  $str .= '</div>';
  $str .= form_error(strtolower($name), '<p class="text-danger">', '</p>');
  $str .= '<div id="'.$name.'_preview" class="thumbnail" style="margin-top: 10px; display: none">';
  $str .= '<img src="" class="img-responsive">';
  $str .= '</div>';
  $str .= '</div>';
  $str .= '</div>';

  return $str;
}

function admin_post_option($name, $title, $type)
{

    $CI =& get_instance();
    $CI->load->database();

    if($CI->uri->segment(4)) {
      // get post data
      $id = $CI->uri->segment(4);
      $CI->db->select('*');
      $CI->db->where('id', $id);
      $CI->db->limit(1);
      $data = $CI->db->get('posts')->row();
      $value = post_option($name, $data);
    } else {
      $value = '';
    }

  switch($type) {
    case 'text':
    case 'email':
        $str  = '<div class="optionPlace form-group">';
        $str .= '<label for="' . $name . '">' . $title . '</label>';
        $str .= '<input type="' . $type . '" id="' . $name . '" name="option[' . $name . '][value]" value="' . $value . '" class="form-control"/>';
        $str .= '<input type="hidden" name="option[' . $name . '][type]" value="' . $type . '" class="form-control"/>';
        $str .= '<input type="hidden" name="option[' . $name . '][title]" value="' . $title . '" class="form-control"/>';
        $str .= '</div>';
    break;
    case 'checkbox':
        $checked = $value == 1 ? 'checked' : null;
        $str  = '<div class="optionPlace form-group">';
        $str .= '<div class="ios-switch switch-md">';
        $str .= '<label style="padding-left: 0;">';
        $str .= '<span class="check-label">' . $title . '&nbsp;</span>';
        $str .= '<input type="checkbox" class="js-switch" name="option[' . $name . '][value]" value="1" ' . $checked . '>';
        $str .= '</label>';
        $str .= '</div>';
        $str .= '<input type="hidden" name="option[' . $name . '][type]" value="' . $type . '" class="form-control">';
        $str .= '<input type="hidden" name="option[' . $name . '][title]" value="' . $title . '" class="form-control">';
        $str .= '</div>';
    break;
    case 'datepicker':
        $str  = '<div class="optionPlace form-group">';
        $str .= '<label for="' . $name . '">' . $title . '</label>';
        $str .= '<input type="text" id="' . $name . '" name="option[' . $name . '][value]" value="' . $value . '" class="form-control date-picker"/>';
        $str .= '<i class="fa fa-calendar"></i>';
        $str .= '<input type="hidden" name="option[' . $name . '][type]" value="' . $type . '" class="form-control"/>';
        $str .= '<input type="hidden" name="option[' . $name . '][title]" value="' . $title . '" class="form-control"/>';
        $str .= '</div>';
    break;
    case 'textarea':
        $str  = '<div class="optionPlace form-group">';
        $str .= '<label for="' . $name . '">' . $title . '</label>';
        $str .= '<textarea id="' . $name . '" name="option[' . $name . '][value]" class="form-control simple">' . $value . '</textarea>';
        $str .= '<input type="hidden" name="option[' . $name . '][type]" value="' . $type . '" class="form-control"/>';
        $str .= '<input type="hidden" name="option[' . $name . '][title]" value="' . $title . '" class="form-control"/>';
        $str .= '</div>';
    break;
  };

  return $str;

}

function theme_headers($template)
{
  $data = read_file(FCPATH.'feast-content/themes/'.$template.'/style.css');

  preg_match ('|Theme Name:(.*)$|mi', $data, $name);
  preg_match ('|Theme URI:(.*)$|mi', $data, $uri);
  preg_match ('|Version:(.*)|i', $data, $version);
  preg_match ('|Description:(.*)$|mi', $data, $description);
  preg_match ('|Author:(.*)$|mi', $data, $author_name);
  preg_match ('|Author URI:(.*)$|mi', $data, $author_uri);

  $arr = array();

  if (isset($name[1]))
  {
      $arr['theme_name'] = trim($name[1]) != null ? trim($name[1]) : $template;
  } else {
      $arr['theme_name'] = $template;
  }

  if (isset($uri[1]))
  {

      $arr['theme_uri'] = trim($uri[1]);
  } else {
      $arr['theme_uri'] = null;
  }

  if (isset($version[1]))
  {
      $arr['theme_version'] = trim($version[1]);
  } else {
      $arr['theme_version'] = null;
  }

  if (isset($description[1]))
  {
      $arr['theme_description'] = trim($description[1]);
  } else {
      $arr['theme_description'] = null;
  }

  if (isset($author_name[1]))
  {
      $arr['theme_author'] = trim($author_name[1]);
  } else {
      $arr['theme_author'] = null;
  }

  if (isset($author_uri[1]))
  {
      $arr['theme_author_uri'] = trim($author_uri[1]);
  } else {
      $arr['theme_author_uri'] = null;
  }

  return $arr;

}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}

function is_demo()
{
  if(config_item('demo_site') == TRUE) {
    return TRUE;
  } else {
    return FALSE;
  }
}

if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

function register_shortcode_css($links = array())
{
  $CI =& get_instance();
  $CI->load->model('Shortcodes_m');
  $CI->Shortcodes_m->register_shortcode_css($links);
}

function shortcode_css()
{
  $CI =& get_instance();
  $CI->load->model('Shortcodes_m');
  return implode(',', $CI->Shortcodes_m->shortcode_css()) ;
}

function register_editor_plugin($link = array())
{
  $CI =& get_instance();
  $CI->load->model('Shortcodes_m');
  $CI->Shortcodes_m->register_editor_plugin($link);
}

function editor_plugins()
{
  $CI =& get_instance();
  $CI->load->model('Shortcodes_m');
  return implode(',', $CI->Shortcodes_m->registered_editor_plugins()) ;
}

function do_shortcode($content)
{
    $CI =& get_instance();
    $out = @str_replace('&lt;br&gt;', '', @$CI->shortcode->run($content));
    $out = @str_replace('&lt;br/&gt;', '', @$CI->shortcode->run($out));
    $out = @str_replace('<br>', '', @$CI->shortcode->run($out));
    $out = @str_replace('<br/>', '', @$CI->shortcode->run($out));
    $out = @str_replace('<br >', '', @$CI->shortcode->run($out));
    $out = @str_replace('<br />', '', @$CI->shortcode->run($out));
    $out = @str_replace('&nbsp;', '', @$CI->shortcode->run($out));
    return $out;
}
function add_shortcode($tag, $func)
{
  $CI =& get_instance();
  return @$CI->shortcode->add($tag, $func);
}

function shortcode_att($pairs, $atts)
{
  $CI =& get_instance();
  return @$CI->shortcode->shortcode_atts($pairs, $atts);
}


function get_shortcodes($theme = 'default')
{

    if (file_exists(FCPATH.'/feast-content/themes/' . $theme . '/shortcodes.php')) {
      include_once(FCPATH.'/feast-content/themes/' . $theme . '/shortcodes.php');
    }

}
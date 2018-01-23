<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Pages extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }

    function index()
    {

      // Redirect unauthorized users
      if ( !$this->authorization->is_permitted('retrieve_pages'))
      {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
        redirect($this->agent->referrer());
      }

      $data['pages'] = $this->Page_m->get();

      $data['main_content'] = 'pages/index';
      $data['page_title'] = feast_line('pages') . ' <span class="badge bg-aqua">' . count_table('posts', array('post_type' => 'page')) . '</span>';

      $this->load->ext_view('admin', 'layouts/main',$data);
    }

	public function edit ($id = NULL)
	{
		// Fetch a page or set a new one
		if ($id) {
      // Redirect unauthorized users
      if ( !$this->authorization->is_permitted('update_pages'))
      {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
        redirect($this->agent->referrer());
      }
      $data['page']      = $this->Page_m->get($id);
      $oldSlug = $data['page']->slug;

			count($data['page']) || $data['errors'][] = 'page could not be found';
            $data['page_title'] = feast_line('edit', $this->lang->line('page') );
		}
		else {
      // Redirect unauthorized users
      if ( ! $this->authorization->is_permitted('create_pages'))
      {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
        redirect($this->agent->referrer());
      }
			$data['page'] = $this->Page_m->get_new();
      $data['item_id'] = 0; 
      $data['page_title'] = feast_line('add', $this->lang->line('page') );
		}

		// Set up the form
		$rules = $this->Page_m->rules;
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run($this) == TRUE) {


			$pageArray = array(
				'title',
				'slug',
				'body',
				'pubdate',
        'statue',
        'sidebar',
        'parent_id',
        'order',
        'option'
      );

      $map = directory_map(APPPATH . 'language', 1);
      foreach($map as $lang) {
      	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
          if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
            $title = 'title_'.$lang;
            $body = 'body_'.$lang;
            if(!empty($title) or !empty($body)) {
              array_push($pageArray, $title, $body);
            }
          }
      }

      $oldImg = $data['page']->image;

      $data = $this->Page_m->array_from_post($pageArray);

      if($id == null) {
        array_push($pageArray, 'user_id', $this->session->userdata('account_id'));
      }


      if($data['statue'] != 1){ $data['statue'] = 0;}
      
      if($data['sidebar'] != 1){ $data['sidebar'] = 0;}

      if($data['option'] != '') {
          foreach($data['option'] as $k => $v):
            if($data['option'][$k]['type'] == 'checkbox') {
              if(!$data['option'][$k]['value'] or $data['option'][$k]['value'] != 1) { 
                $data['option'][$k]['value'] = 0;
              }
            }
          endforeach;
      }

      if($data['option'] != '' && is_array($data['option'])) {
          $data['option'] = base64_encode( serialize($data['option']) );
      }
      
      $data['post_type'] = 'page';
      
      $data['category_id'] = '0';

      foreach($map as $lang) {
      	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
          if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
            $title = 'title_'.$lang;
            $body = 'body_'.$lang;
            unset($data[$title]);
            unset($data[$body]);
          }
      }

      if($this->input->post('image') == '') {
        if($oldImg == '') {
          $img = base_url('feast-content/uploads/no-image.jpg');
        } else {
          $img = $oldImg;
        }
      } else {
        $img = $this->input->post('image');
      }

      $data['image'] = pathinfo( $img )['basename'];

      if(!empty($data['image'])) {
            $this->_createThumbnail($data['image']);        
            $thumbnail = pathinfo( $img )['filename'] . '.' . pathinfo( $img )['extension'];
      }

      /*
      echo $data['image'];
      echo $thumbnail;
      exit();
      */

    if(is_demo() == FALSE) {
      $post_id = $this->Page_m->save($data, $id);

      if(!empty($data['image'])) {
        if($id) {
            $this->Image_m->update(array('image' => $data['image'],'thumb' => $thumbnail), $id);
        } else {
            $this->Image_m->save(array('image' => $data['image'],'thumb' => $thumbnail,'post_id' => $post_id));
        }
      }

      $map = directory_map(APPPATH . 'language', 1);
      $i = 0;
      foreach($map as $lang) {
        $lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
          if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
            $title = 'title_'.$lang;
            $body = 'body_'.$lang;
            $title_val = $this->input->post($title);
            $body_val = $this->input->post($body);

          if(!empty($title_val) or !empty($body_val)) {
            if($id) {
                $data = array(
                    $title => $title_val,
                    $body => $body_val
                );
                $new = FALSE;
                if(count($this->db->where('post_id', $post_id)->get('post_meta')->result()) < 1) {
                  $new = TRUE;
                }
                if($new) {
                  $data = array(
                      'post_id' => $post_id,
                      $title => $title_val,
                      $body => $body_val
                  );
                  $this->db->set($data);
                  $this->db->insert('post_meta');
                } else {
                  $this->db->set($data);
                  $this->db->where('post_id', $post_id);
                  $this->db->update('post_meta');
                }
            } else {
                $data = array(
                    'post_id' => $post_id,
                    $title => $title_val,
                    $body => $body_val
                );

                if($i == 0) {
                  $data = array(
                      'post_id' => $post_id,
                      $title => $title_val,
                      $body => $body_val
                  );
                  $this->db->set($data);
                  $this->db->insert('post_meta');

                } else {
                $data = array(
                    $title => $title_val,
                    $body => $body_val
                );
                $this->db->set($data);
                $this->db->where('post_id', $post_id);
                $this->db->update('post_meta');
                }
            }
          } else {
                $data = array(
                    'post_id' => $post_id,
                    $title => $title_val,
                    $body => $body_val
                );
                $this->db->set($data);
                $this->db->where('post_id', $post_id);
                $this->db->update('post_meta');
          }

          } $i++;
      }

      $this->session->set_flashdata('message', feast_line('saved', $this->lang->line('page') ));
			redirect('admin/pages');

    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

		}
    $dir = $this->session->userdata('site_lang') == 'arabic' ? 'true' : 'false';

    $data['js']   = $this->data['textarea'];
    $data['js']  .= '
    <script type="text/javascript">
      $(document).ready(function(){
          $("input[name=\"title\"]").blur(function(){
              var Slug = $(this).val().toLowerCase();
              $("input[name=\"slug\"]").val(Slug);
          });
      });
    </script>
    ';


    $data['main_content'] = 'pages/edit';

    $this->load->ext_view('admin', 'layouts/main',$data);
	}

  public function delete_multi ()
  {
    // Redirect unauthorized users
    if ( ! $this->authorization->is_permitted('delete_pages'))
    {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
      redirect($this->agent->referrer());
    }
    $id = $this->input->post('id');

    if(is_demo() == FALSE) {
      $this->Page_m->delete_multi($id);
      $this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('pages') ));
      redirect('admin/pages');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

  }

	public function delete ($id)
	{
    // Redirect unauthorized users
    if ( !$this->authorization->is_permitted('delete_pages'))
    {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
      redirect($this->agent->referrer());
    }

    if(is_demo() == FALSE) {
  		$this->Page_m->delete($id);
      $this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('page') ));
  		redirect('admin/pages');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

	}

	public function publish ($id)
	{

    if(is_demo() == FALSE) {
  		$this->Page_m->save(array('statue' => '1'), $id);
      $this->session->set_flashdata('message', feast_line('published', $this->lang->line('page') ));
  		redirect('admin/pages');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

	}

	public function unpublish ($id)
	{

    if(is_demo()) {      
  		$this->Page_m->save(array('statue' => '0'), $id);
      $this->session->set_flashdata('message', feast_line('unpublished', $this->lang->line('page') ));
  		redirect('admin/pages');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }
	}

    function _createThumbnail($fileName) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = './feast-content/uploads/' . $fileName;
        $config['new_image'] = './feast-content/thumbs/'. $fileName;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 350;
        $config['height'] = 350;

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
    }


    public function _create_watermark($fileName)
    {
        $config['image_library']    = 'gd2';
        $config['source_image']     = './feast-content/uploads/' . $fileName;
        $config['wm_type']          = 'overlay';
        $config['wm_overlay_path']  = './feast-content/uploads/logo.png'; //the overlay image
        $config['wm_opacity']       = 50;
        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'right';

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);

        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors();
        }

    }

  public function _unique_slug ($str)
  {
    // Do NOT validate if slug already exists
    // UNLESS it's the slug for the current page


    $id = $this->uri->segment(4);
    $this->db->where('posts.slug', $this->input->post('slug'));
    ! $id || $this->db->where('posts.id !=', $id);
    $post = $this->Post_m->get();

    if (count($post)) {
      $this->form_validation->set_message('_unique_slug', 'This %s is currently used for another post.');
      return FALSE;
    }

    return TRUE;
  }

}
<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Slider extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{
      // Redirect unauthorized users
      if ( ! $this->authorization->is_permitted('retrieve_sliders'))
      {
  		$this->session->set_flashdata('access_error', feast_line('access_denied'));
        redirect($this->agent->referrer());
      }
		// Fetch all posts
		$data['sliders'] = $this->Slide_m->get();

        $data['main_content'] = 'sliders/index';
        $data['page_title'] = feast_line('sliders');

        $this->load->ext_view('admin', 'layouts/main',$data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a post or set a new one
		if ($id) {
	      // Redirect unauthorized users
	      if ( ! $this->authorization->is_permitted('update_sliders'))
	      {
  			$this->session->set_flashdata('access_error', feast_line('access_denied'));
	        redirect($this->agent->referrer());
	      }
			$data['slide'] = $this->Slide_m->get($id);
			count($data['slide']) || $data['errors'][] = 'slide could not be found';
            $data['page_title'] = feast_line('edit', 'slider');
		}
		else {
	      // Redirect unauthorized users
	      if ( ! $this->authorization->is_permitted('create_sliders'))
	      {
	  		$this->session->set_flashdata('access_error', feast_line('access_denied'));
	        redirect($this->agent->referrer());
	      }
			$data['slide'] = $this->Slide_m->get_new();
            $data['page_title'] = feast_line('add', 'slider');
		}
		$data['categories'] = $this->Category_m->get();
		$data['posts'] = $this->Post_m->get();
		// Set up the form
		$rules = $this->Slide_m->rules;
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run($this) == TRUE) {          

			$data = $this->Slide_m->array_from_post(array(
				'title',
				'alias',
				'sliderType',
				'sliderSource',
				'customize'
            ));

			foreach($data as $key => $value){
				if( is_array($data[$key]) ) {
					$data[$key] = base64_encode( serialize($value) );
				} elseif( is_null($value) ) {
					unset( $key );
				}
	      	}

      		if(is_demo() == FALSE) {
		      	if($this->input->post()) {
					$slider_id = $this->Slide_m->save($data, $id);	      		
		            $this->session->set_flashdata('message', feast_line('saved', 'slider'));
					redirect('admin/slider');
		      	}
		    } else {
		        // Set successfully flashdata
		        $this->session->set_flashdata('error', 'This option not work in demo site.');

		        // redirect user to referrer url
		        redirect($this->agent->referrer()); 
		    }

		}


        $data['main_content'] = 'sliders/edit';

        $this->load->ext_view('admin', 'layouts/main',$data);


	}

	public function delete_multi ()
	{
		// Redirect unauthorized users
		if ( ! $this->authorization->is_permitted('delete_sliders'))
		{
		  $this->session->set_flashdata('access_error', feast_line('access_denied'));
		  redirect($this->agent->referrer());
		}
		$id = $this->input->post('id');

		if(is_demo() == FALSE) {
			$this->Slide_m->delete_multi($id);
			$this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('sliders') ));
			redirect('admin/slider');
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
      if ( ! $this->authorization->is_permitted('delete_sliders'))
      {
  		$this->session->set_flashdata('access_error', feast_line('access_denied'));
        redirect($this->agent->referrer());
      }

		if(is_demo() == FALSE) {
			$this->Slide_m->delete($id);
	        $this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('page') ));
			redirect('admin/slider');
	    } else {
	        // Set successfully flashdata
	        $this->session->set_flashdata('error', 'This option not work in demo site.');

	        // redirect user to referrer url
	        redirect($this->agent->referrer()); 
	    }
	}


}
<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Categories extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }

    function index()
    {
	    // Redirect unauthorized users
	    if ( ! $this->authorization->is_permitted('retrieve_cats'))
	    {
  		$this->session->set_flashdata('access_error', feast_line('access_denied'));
	      redirect($this->agent->referrer());
	    }

		$data['categories'] = $this->Category_m->get();

		$data['main_content'] = 'categories/index';
		$data['page_title'] = feast_line('categories') . ' <span class="badge bg-aqua">' . count_table('categories') . '</span>';

		$this->load->ext_view('admin', 'layouts/main',$data);
    }

	public function edit ($id = NULL)
	{
		// Fetch a page or set a new one
		if ($id) {
		    // Redirect unauthorized users
		    if ( ! $this->authorization->is_permitted('update_cats'))
		    {
			$this->session->set_flashdata('access_error', feast_line('access_denied'));
		      redirect($this->agent->referrer());
		    }
			$data['category'] = $this->Category_m->get($id);
			count($data['category']) || $data['errors'][] = 'page could not be found';
            $data['page_title'] = feast_line('edit', $this->lang->line('category') );
		}
		else {
		    // Redirect unauthorized users
		    if ( ! $this->authorization->is_permitted('create_cats'))
		    {
  			$this->session->set_flashdata('access_error', feast_line('access_denied'));
		      redirect($this->agent->referrer());
		    }
			$data['category'] = $this->Category_m->get_new();
            $data['page_title'] = feast_line('add', $this->lang->line('category') );
		}

		// Set up the form
		$rules = $this->Category_m->rules;
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run($this) == TRUE) {
			$data = $this->Category_m->array_from_post(array(
				'title',
				'slug',
				'parent_id',
				'order'
			));
			if(is_demo() == FALSE) {
				$this->Category_m->save($data, $id);
			} else {
	          // Set successfully flashdata
	          $this->session->set_flashdata('error', 'This option not work in demo site.');

	          // redirect user to referrer url
	          redirect($this->agent->referrer());
			}

            $this->session->set_flashdata('message', feast_line('saved', $this->lang->line('category') ));
			redirect('admin/categories');
		}

        $data['main_content'] = 'categories/edit';

        $this->load->ext_view('admin', 'layouts/main',$data);
	}

	public function delete_multi ()
	{
		// Redirect unauthorized users
		if ( ! $this->authorization->is_permitted('delete_cats'))
		{
		  $this->session->set_flashdata('access_error', feast_line('access_denied'));
		  redirect($this->agent->referrer());
		}
		$id = $this->input->post('id');
		if(is_demo() == FALSE) {
			$this->Category_m->delete_multi($id);
			$this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('categories') ));
			redirect('admin/categories');
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
	    if ( ! $this->authorization->is_permitted('delete_cats'))
	    {
  		$this->session->set_flashdata('access_error', feast_line('access_denied'));
	      redirect($this->agent->referrer());
	    }
	    if(is_demo() == FALSE) {
			$this->Category_m->delete($id);
	        $this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('category') ));
			redirect('admin/categories');
		} else {
			// Set successfully flashdata
			$this->session->set_flashdata('error', 'This option not work in demo site.');

			// redirect user to referrer url
			redirect($this->agent->referrer());	
		}
	}


	public function _unique_slug ($str)
	{
		// Do NOT validate if slug already exists
		// UNLESS it's the slug for the current page


		$id = $this->uri->segment(4);
		$this->db->where('slug', $this->input->post('slug'));
		! $id || $this->db->where('id !=', $id);
		$page = $this->Category_m->get();

		if (count($page)) {
			$this->form_validation->set_message('_unique_slug', 'This %s is currently used for another category.');
			return FALSE;
		}

		return TRUE;
	}


}
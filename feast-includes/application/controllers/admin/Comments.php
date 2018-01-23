<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Comments extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }

    function index()
    {
	    // Redirect unauthorized users
	    if ( ! $this->authorization->is_permitted('retrieve_comments'))
	    {
  		$this->session->set_flashdata('access_error', feast_line('access_denied'));
	      redirect($this->agent->referrer());
	    }

		$data['main_content'] = 'comments/index';
		$data['page_title'] = feast_line('comments') . ' <span class="badge bg-aqua">' . count_table('comments') . '</span>';

		$this->load->ext_view('admin', 'layouts/main',$data);
    }

    public function comment() {

        $id = $this->input->post('id');
        
        $data['comment'] = $this->Comment_m->get($id, TRUE);

        $this->load->ext_view('admin', 'comments/comment',$data);
    }

	public function delete_multi ()
	{
		// Redirect unauthorized users
		if ( ! $this->authorization->is_permitted('delete_comments'))
		{
		  $this->session->set_flashdata('access_error', feast_line('access_denied'));
		  redirect($this->agent->referrer());
		}
		$id = $this->input->post('id');

		if(is_demo() == FALSE) {
			$this->Comment_m->delete_multi($id);
			$this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('comments') ));
			redirect('admin/comments');
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
	    if ( ! $this->authorization->is_permitted('delete_comments'))
	    {
  		$this->session->set_flashdata('access_error', feast_line('access_denied'));
	      redirect($this->agent->referrer());
	    }

	    if(is_demo() ==FALSE) {
			$this->Comment_m->delete($id);
	        $this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('comment') ));
			redirect('admin/comments');
	    } else {
			// Set successfully flashdata
			$this->session->set_flashdata('error', 'This option not work in demo site.');

			// redirect user to referrer url
			redirect($this->agent->referrer());	
	    }
	}

}
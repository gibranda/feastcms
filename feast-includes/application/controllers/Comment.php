<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Comment extends Frontend_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}


    /**
     * Check if frontpage is a page or post.
     *
     * @param int   $id     Post/Page id to get comments from database
     *
     * @return array post or page comments
     */
	public function index($id = null)
	{

        // Get default controller from database 
        $this->db->where( 'key', 'default_controller' );
        $query = $this->db->get( 'config_data' );
        $result = $query->row();

        // Check if id null
        $id = is_null($id) ? $result->value : $id;

        // set comments array from daabase
        $data['comments'] = $this->Comment_m->get_by(array('post_id' => $id));

        // set comments view file and data
        $this->load->ext_view('admin', 'comments/comments',$data);
	}


    /**
     * Add new comment to post/page.
     *
     * @param int   $id     Post/Page id
     *
     */
    public function addcomment($id) {

        // set comment data for database
        $name    	= $this->input->post('name');
        $email   	= $this->input->post('email');
        $comment    = $this->input->post('comment');
        $user_type  = $this->input->post('user_type');
        $user_id  = $this->input->post('user_id');

        // prepare data on array to insert to database
        $save = array(
                'post_id' => $id,
                'username' => $name,
                'email' => $email,
                'text' => $comment,
                'user_id' => $user_id,
                'user_type' => $user_type
        );

        // check if user_id set or empty
        if( empty($save['user_id']) ) {
            unset($save['user_id']);
        }

        // Insert comment data to database
        $this->Comment_m->save($save);

        // Get post/page comments for ajax
        $data['comments'] = $this->Comment_m->get_by(array('post_id' => $id));
        $data['id'] = $id;

        // Load view file with data
        $this->load->ext_view('admin', 'comments/comments',$data);

    }


}
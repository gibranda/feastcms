<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Users extends Admin_Controller {

  /**
   * Constructor
   */
  function __construct()
  {
    parent::__construct();

    // Load the necessary stuff...
    $this->load->config('account/account');
    $this->load->helper(array('date', 'language', 'account/ssl', 'url'));
    $this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
    $this->load->model(array('account/account_model', 'account/account_details_model', 'account/acl_permission_model', 'account/acl_role_model', 'account/rel_account_permission_model', 'account/rel_account_role_model', 'account/rel_role_permission_model'));
  }

  /**
   * Manage Users
   */
  function index()
  {
    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users'));
    }

    // Redirect unauthorized users to account profile page
    if ( ! $this->authorization->is_permitted('retrieve_users'))
    {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
      redirect($this->agent->referrer());
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Get all user information
    $all_accounts = $this->account_model->get();
    $all_account_details = $this->account_details_model->get();
    $all_account_roles = $this->rel_account_role_model->get();
    $admin_role = $this->acl_role_model->get_by_name('Admin');

    // Compile an array for the view to use
    $data['all_accounts'] = array();
    foreach ( $all_accounts as $acc )
    {
      $current_user = array();
      $current_user['id'] = $acc->id;
      $current_user['username'] = $acc->username;
      $current_user['email'] = $acc->email;
      $current_user['firstname'] = '';
      $current_user['lastname'] = '';
      $current_user['is_admin'] = FALSE;
      $current_user['is_banned'] = isset( $acc->suspendedon );

      foreach( $all_account_details as $det ) 
      {
        if( $det->account_id == $acc->id ) 
        {
          $current_user['firstname'] = $det->firstname;
          $current_user['lastname'] = $det->lastname;
        }
      }

      foreach( $all_account_roles as $acrole ) 
      {
        if( $acrole->account_id == $acc->id && $acrole->role_id == $admin_role->id ) 
        {
          $current_user['is_admin'] = TRUE;
          break;
        }
      }

      // Append to the array
      $data['all_accounts'][] = $current_user;
    }

    $data['main_content'] = 'users/manage_users';
    $data['page_title'] = feast_line('users_page_name');

    // Load manage permissions view
    $this->load->ext_view('admin', 'layouts/main', $data);
  }

  /**
   * Create/Update Users
   */
  function edit($id=null)
  {
    // Keep track if this is a new user
    $is_new = empty($id);

    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users'));
    }

    // Check if they are allowed to Update Users
    if ( ! $this->authorization->is_permitted('update_users') && ! empty($id) )
    {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
      redirect($this->agent->referrer());
    }

    // Check if they are allowed to Create Users
    if ( ! $this->authorization->is_permitted('create_users') && empty($id) )
    {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
      redirect($this->agent->referrer());
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Get all the roles
    $data['roles'] = $this->acl_role_model->get();

    // Set action type (create or update user)
    $data['action'] = 'create';

    // Get the account to update
    if( ! $is_new )
    {
      $data['update_account'] = $this->account_model->get_by_id($id);
      $data['update_account_details'] = $this->account_details_model->get_by_account_id($id);
      $data['update_account_roles'] = $this->acl_role_model->get_by_account_id($id);
      $data['action'] = 'update';
    }

    // Setup form validation
    $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
    $this->form_validation->set_rules(
      array(
        array(
          'field' => 'users_username',
          'label' => 'lang:profile_username',
          'rules' => 'trim|required|alpha_dash|min_length[2]|max_length[24]'),
        array(
          'field' => 'users_email', 
          'label' => 'lang:settings_email', 
          'rules' => 'trim|required|valid_email|max_length[160]'), 
        array(
          'field' => 'users_fullname', 
          'label' => 'lang:settings_fullname', 
          'rules' => 'trim|max_length[160]'), 
        array(
          'field' => 'users_firstname', 
          'label' => 'lang:settings_firstname', 
          'rules' => 'trim|max_length[80]'), 
        array(
          'field' => 'users_lastname', 
          'label' => 'lang:settings_lastname', 
          'rules' => 'trim|max_length[80]'),
        array(
          'field' => 'users_new_password', 
          'label' => 'lang:password_new_password', 
          'rules' => 'trim|'.($is_new ? 'required' : null).'|min_length[6]'),
        array(
          'field' => 'users_retype_new_password', 
          'label' => 'lang:password_retype_new_password', 
          'rules' => 'trim|'.($is_new ? 'required' : null).'|matches[users_new_password]')
      ));

    // Run form validation
    if ($this->form_validation->run($this))
    {

      $email_taken = $this->email_check($this->input->post('users_email', TRUE));
      $username_taken = $this->username_check($this->input->post('users_username'));

      // If user is changing email and new email is already taken OR
      // if this is a new user, just check if it's been taken already.
      if ( (! empty($id) && strtolower($this->input->post('users_email', TRUE)) != strtolower($data['update_account']->email) && $email_taken) || (empty($id) && $email_taken) )
      {
        $data['users_email_error'] = lang('settings_email_exist');
      }
      // Check if user name is taken
      elseif ( (! empty($id) && strtolower($this->input->post('users_username', TRUE)) != strtolower($data['update_account']->username) && $username_taken) || (empty($id) && $username_taken) )
      {
        $data['users_username_error'] = lang('sign_up_username_taken');
      }
      else
      {

        if(is_demo() == FALSE) {
          // Create a new user
          if( empty($id) ) {
            $id = $this->account_model->create(
              $this->input->post('users_username', TRUE), 
              $this->input->post('users_email', TRUE), 
              $this->input->post('users_new_password', TRUE));
          }
          // Update existing user information
          else 
          {
            // Update account username
            $this->account_model->update_username($id, 
              $this->input->post('users_username', TRUE) ? $this->input->post('users_username', TRUE) : NULL);

            // Update account email
            $this->account_model->update_email($id, 
              $this->input->post('users_email', TRUE) ? $this->input->post('users_email', TRUE) : NULL);

            // Update password
            $pass = $this->input->post('users_new_password', TRUE) ? $this->input->post('users_new_password', TRUE) : NULL;
            if( ! empty($pass) )
            {
              $this->account_model->update_password($id, $pass);
            }

            // Check if the user should be suspended
            if( $this->authorization->is_permitted('ban_users') ) 
            {
              if( $this->input->post('manage_user_ban', true) )
              {
                $this->account_model->update_suspended_datetime($id);
              }
              elseif( $this->input->post('manage_user_unban', true) )
              {
                $this->account_model->remove_suspended_datetime($id);
              }
            }
          }


          // Update account details
          $attributes = array();
          $attributes['fullname'] = $this->input->post('users_fullname', TRUE) ? $this->input->post('users_fullname', TRUE) : NULL;
          $attributes['firstname'] = $this->input->post('users_firstname', TRUE) ? $this->input->post('users_firstname', TRUE) : NULL;
          $attributes['lastname'] = $this->input->post('users_lastname', TRUE) ? $this->input->post('users_lastname', TRUE) : NULL;
          $this->account_details_model->update($id, $attributes);

          // Apply roles
          $roles = array();
          foreach($data['roles'] as $r)
          {
            if( $this->input->post("account_role_{$r->id}", TRUE) )
            {
              $roles[] = $r->id;
            }
          }
          $this->rel_account_role_model->delete_update_batch($id, $roles);

          redirect("admin/users");
        } else {
            // Set successfully flashdata
            $this->session->set_flashdata('error', 'This option not work in demo site.');

            // redirect user to referrer url
            redirect($this->agent->referrer()); 
        }
      }
    }

    $data['css'] = admin_css('assets/plugins/switchery/switchery.min.css');
    $data['js']  = admin_script('assets/plugins/switchery/switchery.min.js');

    $data['main_content'] = 'users/manage_users_save';
    $data['page_title'] = feast_line('users_'.$data['action'].'_page_name');
    // Load manage permissions view
    $this->load->ext_view('admin', 'layouts/main', $data);
  }

  public function delete_multi ()
  {
    // Redirect unauthorized users
    if ( ! $this->authorization->is_permitted('delete_users'))
    {
      $this->session->set_flashdata('access_error', feast_line('access_denied'));
      redirect($this->agent->referrer());
    }
    $id = $this->input->post('id');

    if(is_demo() == FALSE) {
      $this->account_model->delete_multi($id);
      $this->session->set_flashdata('message', feast_line('deleted', $this->lang->line('users') ));
      redirect('admin/users');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

  }

  /**
   * Filter the user list by permission or role.
   *
   * @access public
   * @param string $type (permission, role)
   * @param int $id (permission_id, role_id)
   * @return void
   */
  function filter($type=null,$id=null)
  {
    $this->index();
  }

  /**
   * Check if a username exist
   *
   * @access public
   * @param string
   * @return bool
   */
  function delete($id)
  {
    if(is_demo() == FALSE) {
      return $this->account_model->delete($id) ? TRUE : FALSE;
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

  }


  /**
   * Check if a username exist
   *
   * @access public
   * @param string
   * @return bool
   */
  function username_check($username)
  {
    return $this->account_model->get_by_username($username) ? TRUE : FALSE;
  }

  /**
   * Check if an email exist
   *
   * @access public
   * @param string
   * @return bool
   */
  function email_check($email)
  {
    return $this->account_model->get_by_email($email) ? TRUE : FALSE;
  }
}

/* End of file manage_users.php */
/* Location: ./application/account/controllers/manage_users.php */

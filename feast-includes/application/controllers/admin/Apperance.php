<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Apperance extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }


    /**
     * Get avilable themes.
     *
     * @return mixed  Load view file
     */
    function themes()
    {

      // Set page title
      $data['page_title']   = feast_line('themes');

      // Set view file
      $data['main_content'] = 'apperance/themes';

      // Load view file with data
      $this->load->ext_view('admin', 'layouts/main',$data);
    }


    /**
     * Get Theme custom options.
     *
     * @param string   $theme   the theme name or FALSE
     *
     * @return mixed  Load view file
     */
    function theme_options($theme = FALSE)
    {

      // Check if $theme param is set or set the active theme as default value
      if($theme != FALSE) {
        $data['curr_theme'] = $theme;
      } else {
        $data['curr_theme'] = $this->pref->active_theme;
      }

      // Set page title
      $data['page_title']   = feast_line('theme_options');

      // Set view file
      $data['main_content'] = 'apperance/theme_options';

      // Load view file with data
      $this->load->ext_view('admin', 'layouts/main',$data);
    }

    function uninstall($theme)
    {

      if(is_demo() == FALSE) {

        $path = FCPATH . 'feast-content/themes/'.$theme;

        delete_files($path, true);

        if(rmdir($path)) {
          // Set successfully flashdata
          $this->session->set_flashdata('message', 'Your theme have been deleted.');

          // redirect user to referrer url
          redirect($this->agent->referrer());
        } else {
          // Set successfully flashdata
          $this->session->set_flashdata('error', 'Your theme can not delete.');

          // redirect user to referrer url
          redirect($this->agent->referrer());
        }
      } else {
          // Set successfully flashdata
          $this->session->set_flashdata('error', 'This option not work in demo site.');

          // redirect user to referrer url
          redirect($this->agent->referrer());
      }

    }

    /**
     * Update theme options on database.
     */
    public function update () {

      if(is_demo() == FALSE) {

          // Loop the post data in foreach
          foreach($this->input->post() as $key => $value){

            // update current option value
            update_option($key, $value);
          }
          // Set successfully flashdata
          $this->session->set_flashdata('message', 'Your settings have been saved successfully.');
    
          // redirect user to referrer url
          redirect($this->agent->referrer());
  
      } else {
          // Set successfully flashdata
          $this->session->set_flashdata('error', 'This option not work in demo site.');

          // redirect user to referrer url
          redirect($this->agent->referrer());
      }

    }

    /**
     * Get Theme information from style.css file
     *
     * @param string   $theme   the theme name
     *
     * @return array  theme headers
     */
    public function theme_info($theme)
    {
      $data['theme'] = $theme;

      // set theme headers array
      $data['theme_headers'] = theme_headers($theme);

      // Load view file with data
      $this->load->ext_view('admin', 'apperance/theme_info', $data);
    }

    /**
     * Set theme as active theme
     *
     * @param string   $theme   the theme name
     *
     * @return mixed  update database and return user
     */
    function set_theme($theme)
    {
        if(is_demo() == FALSE) {
          $data = array('value' => $theme);
          $this->db->where('key', 'active_theme');
          $this->db->update('settings', $data);
          redirect('admin/apperance/themes', 'refresh');
        } else {
          // Set successfully flashdata
          $this->session->set_flashdata('error', 'This option not work in demo site.');

          // redirect user to referrer url
          redirect($this->agent->referrer());
        }
    }

}
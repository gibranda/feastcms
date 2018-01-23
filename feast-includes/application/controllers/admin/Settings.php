<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Settings extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
    $this->load->model('account/ref_zoneinfo_model');
	}

	public function general ()
	{
    // Redirect unauthorized users
    if ( ! $this->authorization->is_permitted('general_settings'))
    {
      redirect('admin');
    }
		// Fetch all settings
    $data['settings'] = $this->Setting_m->get_by(array('group' => 1));
		$data['zoneinfo'] = $this->ref_zoneinfo_model->get_all();
    $data['zones'] = array();
    foreach ($data['zoneinfo'] as $zone) {
      $zone_n = explode('/', str_replace('_', ' ', $zone->zoneinfo))[1] . ' (' . $zone->offset . ')';
      $data['zones'][$zone_n] = $zone->zoneinfo;
    }

    $dir = $this->session->userdata('site_lang') == 'arabic' ? 'true' : 'false';

    $data['main_content'] = 'settings/general';
    $data['page_title'] = feast_line('settings', feast_line('general'));

    $this->load->ext_view('admin', 'layouts/main',$data);
	}

	public function contact ()
	{
      // Redirect unauthorized users
      if ( ! $this->authorization->is_permitted('contact_settings'))
      {
        redirect('admin');
      }
		// Fetch all settings
		$data['settings'] = $this->Setting_m->get_by(array('group' => 2));

        $dir = $this->session->userdata('site_lang') == 'arabic' ? 'true' : 'false';


        $data['main_content'] = 'settings/general';
        $data['page_title'] = feast_line('settings', feast_line('contact'));

        $this->load->ext_view('admin', 'layouts/main',$data);
	}

    public function update () {
      if(is_demo() == FALSE) {
        foreach($this->input->post() as $key => $value){
            $data = array('value' => $value);
            if($key == 'site_url') {
              $this->db->where('key', 'base_url');
              $this->db->update('config_data', $data);
            } elseif($key == 'default_controller') {
              $this->db->where('key', 'default_controller');
              $this->db->update('config_data', $data);
            } elseif($key == 'default_language') {
              $this->db->where('key', 'language');
              $this->db->update('config_data', $data);
            } elseif($key == 'timezone') {
              $this->db->where('key', 'timezone');
              $this->db->update('config_data', $data);
            }
            $this->Setting_m->update($data, $key);

        }
        $this->session->set_flashdata('message', feast_line('saved', feast_line('settings')));
        redirect($this->agent->referrer());
      } else {
          // Set successfully flashdata
          $this->session->set_flashdata('error', 'This option not work in demo site.');

          // redirect user to referrer url
          redirect($this->agent->referrer()); 
      }
    }

}
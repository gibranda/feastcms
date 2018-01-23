<?php
// application/controllers/Unzip.php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Unzip extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }
     
    public function upload()
    {

        $config['upload_path']          = $this->input->post('upload_path');
        $config['allowed_types']        = 'zip';
             
        $this->load->library('upload', $config);
             
        if ( ! $this->upload->do_upload('zip_file'))
        {

            $this->session->set_flashdata('error', 'Error! ' . $this->upload->display_errors());
            redirect($this->agent->referrer());

        }
        else
        {

            $data = array('upload_data' => $this->upload->data());
            $full_path = $data['upload_data']['full_path'];
     
            $this->load->library('extractor');
            $this->extractor->extract($full_path, $this->input->post('extract_location'));
            $params = array('success' => 'Extracted successfully!');
            unlink($full_path);

            $this->session->set_flashdata('message', 'Your module installed successfully.');
            redirect($this->agent->referrer());

        }
    }
}
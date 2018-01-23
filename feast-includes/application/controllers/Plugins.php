<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plugins extends CI_Controller {

    private $_plugins;

    public function __construct()
    {
        parent::__construct();

        $this->_plugins = $this->Plugins_model->get_plugins();

        $this->plugins_lib->update_all_plugin_headers();
    }

    public function index()
    {

        $data = array();

        $data['plugins'] = $this->Plugins_model->get_plugins();

        $this->load->ext_view('admin', 'plugin_list',$data);
    }

    public function config( $name )
    {
        $data = array();

        if( ! $name)
        {
            redirect('/');
        }
        elseif( ! isset($this->_plugins[$name]))
        {
            die("Unknown plugin {$name}");
        }
        elseif($this->_plugins[$name]->status != 1)
        {
            die("The plugin {$name} isn't enabled");
        }
        else
        {
            $data['plugin'] = $name;

            // Just some random stuff to send to the data, not needed unless the plugin
            // controller requires it
            $name_data = array('some' => 'data');

            if( ! $data['plugin_content'] = $this->plugins_lib->view_controller($name, $name_data))
            {
                die('No controller for this plugin');
            }
        }


        $this->load->ext_view('admin', 'plugin_settings',$data);
    }

}

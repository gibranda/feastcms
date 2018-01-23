<?php

/*
 * include all request pages in the same page 
 * this will make your code easy to customize
 * now you can include your header, footer or any
 * additional pages in one place
 */
$this->load->view($this->pref->active_theme.'/layouts/includes/header');


// Check if this view belong to a module
if(file_exists(FCPATH.'feast-content/themes/' . $this->pref->active_theme . '/' . $main_content.'.php')) {

	$this->load->view($this->pref->active_theme.'/'.$main_content);;

} elseif(file_exists(FCPATH . 'feast-content/modules/' . @$module_name . '/views/' . $main_content . '.php')) {

	$this->load->module_view(@$module_name, 'views/' . $main_content);

} else {

	$this->load->view($this->pref->active_theme.'/'.$main_content);;

}


$this->load->view($this->pref->active_theme.'/layouts/includes/footer'); ?>
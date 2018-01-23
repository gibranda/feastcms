<?php

/*
 * include all request pages in the same page 
 * this will make your code easy to customize
 * now you can include your header, footer or any
 * additional pages in one place
 */
$this->load->view($this->pref->active_theme.'/layouts/includes/header'); ?>

<div id="wrap" style="margin-top: 75px;">

		<?php $this->load->view($this->pref->active_theme.'/'.$main_content); ?>

</div>

<?php $this->load->view($this->pref->active_theme.'/layouts/includes/footer'); ?>
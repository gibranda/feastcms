<?php

	if(module_enable('portfolio')) {
	  	$this->add_menu_item('portfolio', 'portfolio', 'fa fa-image', 7, 0);
		$this->add_sub_menu_item('all_works', 'portfolio', 10, 0, 6);
		$this->add_sub_menu_item('add_work', 'portfolio/add', 20, 0, 6);
		$this->add_sub_menu_item('categories', 'portfolio/categories', 20, 0, 6);
	}
?>
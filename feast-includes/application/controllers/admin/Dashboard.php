<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Dashboard extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }

    function index()
    {

      // Set view file
      $data['main_content'] = 'dashboard/index';

      // Set page title
      $data['page_title']   = feast_line('dashboard');

      // Load view file with data
      $this->load->ext_view('admin', 'layouts/main',$data);
    }
}


<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Shortcodes extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

  public function parse()
  {
    $code = $this->input->post('scode');

    $data['content'] = $this->Shortcodes->parse($code);

    $this->load->ext_view('admin', 'layouts/shortcode',$data);
  }

}
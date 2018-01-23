<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Retrieve_Shortcode extends Frontend_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

    public function retrieve()
    {

        $shortcode = '[' . $this->input->post('shortcode') . '/]';

        $shortcode = str_replace('+', ' ', $shortcode);

        echo do_shortcode($shortcode);
    }

}
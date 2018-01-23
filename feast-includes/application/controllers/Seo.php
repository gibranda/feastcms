<?php
 
/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Class Seo extends CI_Controller {

    function sitemap()
    {

        $data['posts']      = $this->Post_m->get();
        $data['pages']      = $this->Page_m->get();
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->ext_view('admin', 'sitemap',$data);
    }
}
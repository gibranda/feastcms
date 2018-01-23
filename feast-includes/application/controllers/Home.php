<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Home extends Frontend_Controller {

    /**
     * Set Default frontpage.
     *
     * @return mixed load view file
     */
	public function index()
	{

        // Load menu items
		$data['menu'] = $this->Page_m->get();

        // Load sliders
		$data['sliders'] = $this->Slide_m->get();

        // Set page title for title tag
        $data['page_title'] = feast_line('home');

        // Set view file
        $data['main_content'] = 'index';

        // Load view file with data
        $this->load->view($this->pref->active_theme.'/layouts/main',$data);
        
	}

    /**
     * Contact function.
     *
     * @return string return sent message statue
     */
    public function contact()
    {

        // Load required libraries
        $this->load->library('email', 'user_agent');

        // Set mailtype to html
        $this->email->set_mailtype("html");

        // Set message content
        $message = "
            <style type='text/css'>
            	* {
            		padding: 0;
            		margin: 0;
            		outline: none;
            		text-decoration: none;
            	}
            	#message {
                	font-family: 'Open Sans', sans-serif;
                	line-height: 1.5;
                	font-size: 14px;
                	padding: 15px;
            	}
            	h1 {
            		font-size: 22px;
            		color: #19BA61;
            		padding-bottom: 10px;
            		border-bottom: 1px solid #19BA61;
            		margin-bottom: 20px;
            		font-weight: 700;
            	}
            
            	ul {
            		list-style: none;
            		margin: 0;
            	}
            
            	li span {
            		color: #19BA61;
            		font-weight: 400
            	}
            
            	li {
            		color: #2c3e50;
            		margin-bottom: 10px;
            		font-weight: 300
            	}
            </style>
             <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet'>
             <div id='message'>
            	<h1>Message from website</h1>
            
            	<ul>
            		<li><span>Name : </span> ".$_POST['name']."</li>
            		<li><span>Email : </span> ".$_POST['email']."</li>
            		<li><span>Message : </span> ".$_POST['message']."</li>
            	</ul>
        	</div>
        ";

        // Set email options
        $this->email->from($_POST['email'], $_POST['name']);
        $this->email->to( $this->pref->contact_email );
        $this->email->subject('Message from website');
        $this->email->message( $message );

        // Check if message sent or have errors        
        if( $this->email->send() ) {
            echo 'Your message has been sent successfully';
        } else {
            echo $_POST['email'].'\n'.$_POST['name'].'\n'.$_POST['message'].'\n'.$this->pref->contact_email;
        }     

    }
    
}

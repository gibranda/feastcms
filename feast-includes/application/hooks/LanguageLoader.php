<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        //$ci->lang->load('file', $GLOBALS['language']);
        /*
        */
        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            $ci->lang->load('file',$ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load('file', $ci->pref->default_language);
        }
    }
}
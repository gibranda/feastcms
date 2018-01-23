<?

class MyOtherClass {

    function MyOtherfunction() {

        $CI =& get_instance();

        $row = $CI->db->get('configs')->row();

        $CI->config->set_item('base_url', $row->base_url);
        $CI->config->set_item('language', $row->language);

    }

}
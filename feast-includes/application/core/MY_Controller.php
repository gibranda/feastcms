<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class MY_Controller extends MX_Controller {

    public $data = array();
    protected $langs = array();

    function __construct() {
        parent::__construct();

        $this->load->model("Menu_model");
        $this->load->library("multi_menu");

      // Check database exist
      $this->load->dbutil();
      if (is_null( $this->db->database ) or !$this->dbutil->database_exists( $this->db->database ))
      {
            exit('Sorry, Database not exist');
      }

      $theme_func = FCPATH.'feast-content/themes/'.$this->pref->active_theme.'/theme_options/functions.php';
      if(file_exists($theme_func)) {
        include_once $theme_func;
      }

        // For flashdata messages
        $this->session->keep_flashdata('message');
        $this->session->keep_flashdata('error');
        $this->session->keep_flashdata('access_error');

        // Errors
        $this->data['errors'] = array();

        // Menu items
        $this->data['menu_pages'] = $this->Page_m->get();

        // Get current theme shortcodes 
        get_shortcodes($this->pref->active_theme);

        // add new column for not exist language post_title and post_body
        $map = directory_map(APPPATH . 'language', 1);
        foreach($map as $lang) {
        	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
            if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
              $title = 'title_'.$lang;
              $body = 'body_'.$lang;
              if($this->db->field_exists($title, 'post_meta') == FALSE) {
                $this->db->query('ALTER TABLE post_meta ADD '.$title.' VARCHAR( 255 )');
                $this->db->query('ALTER TABLE post_meta ADD '.$body.' TEXT');
              }

            }
        }

        // Check the installed modules and insert it to database 
        $modules = directory_map(FCPATH . 'feast-content/modules', 1);
        foreach($modules as $module) {
          $module = str_replace(DIRECTORY_SEPARATOR, '', $module);
          //echo $module.'<br>';
            if(is_dir(FCPATH . 'feast-content/modules/'.$module)) {
              $this->load->model('Modules_m');
              $this->db->where('module_name', $module);
              $result = $this->Modules_m->get();
              if(!count($result)) {
                $dt['module_name'] = $module;
                $dt['statue'] = 'disable';
                $dt['description'] = $module.' module.';
                $this->Modules_m->save($dt);
              } 
            }
        }

        $this->load->model('Modules_m');
        $installed_modules = $this->Modules_m->get();
        foreach($installed_modules as $installed_module) {
          if(!is_dir(FCPATH . 'feast-content/modules/'.$installed_module->module_name)) {
            $this->Modules_m->delete($installed_module->id);
          }
        }        

    // Initialize timyMce text editor 
    $this->data['textarea'] = '
		'.admin_script('assets/tinymce/tinymce.min.js').'
		'.admin_script('assets/tinymce/jquery.tinymce.min.js').'
        <script type="text/javascript">
            tinymce.init({
                mode: "textareas",
                menubar:false,
                verify_html: false,
                editor_deselector: "simple",
                forced_root_block : "", 
                force_br_newlines : true,
                force_p_newlines : false,
                theme: "modern",
                skin: "bootmce",
                height: 300,
                relative_urls : false,
                remove_script_host: false,
        ';


if( file_exists(FCPATH.'feast-content/themes/'.$this->pref->active_theme.'/tinymce/plugin.min.js') ) {
        $this->data['textarea'] .= '
                plugins: [
                     "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                     "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                     "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager mfnsc fontawesome noneditable background sourcebeautifier",
               ],
               toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons | fullscreen code sourcebeautifier background mfnsc icons progress",
                external_plugins: { "filemanager" : "'.base_url('feast-includes').'/admin/assets/filemanager/plugin.min.js", "mfnsc" : "'.base_url('feast-content').'/themes/'.$this->pref->active_theme.'/tinymce/plugin.min.js"},
       ';
} else {
        $this->data['textarea'] .= '
                plugins: [
                     "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                     "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                     "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager fontawesome noneditable background sourcebeautifier",
               ],
               toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons fontawesome | fullscreen code sourcebeautifier background",
                external_plugins: { "filemanager" : "'.base_url('feast-includes').'/admin/assets/filemanager/plugin.min.js"},
       ';
}
        $this->data['textarea'] .= '
               style_formats: [
                  {title: "Headers", items: [
                      {title: "Header 1", format: "h1"},
                      {title: "Header 2", format: "h2"},
                      {title: "Header 3", format: "h3"},
                      {title: "Header 4", format: "h4"},
                      {title: "Header 5", format: "h5"},
                      {title: "Header 6", format: "h6"}
                  ]},
                  {title: "Inline", items: [
                      {title: "Bold", icon: "bold", format: "bold"},
                      {title: "Italic", icon: "italic", format: "italic"},
                      {title: "Underline", icon: "underline", format: "underline"},
                      {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
                      {title: "Superscript", icon: "superscript", format: "superscript"},
                      {title: "Subscript", icon: "subscript", format: "subscript"},
                      {title: "Code", icon: "code", format: "code"}
                  ]},
                  {title: "Blocks", items: [
                      {title: "Paragraph", format: "p"},
                      {title: "Blockquote", format: "blockquote"},
                      {title: "Div", format: "div"},
                      {title: "Pre", format: "pre"}
                  ]},
                  {title: "Alignment", items: [
                      {title: "Left", icon: "alignleft", format: "alignleft"},
                      {title: "Center", icon: "aligncenter", format: "aligncenter"},
                      {title: "Right", icon: "alignright", format: "alignright"},
                      {title: "Justify", icon: "alignjustify", format: "alignjustify"}
                  ]}
                ],
                visualblocks_default_state: false,
                valid_elements : "*[*]",
                valid_children : "+a[div]",
                body_class: "blue",
                extended_valid_elements: "i[*]|iframe[src|frameborder|style|scrolling|class|width|height|name|align]",
                content_css : "'.shortcode_css().'",
                external_filemanager_path:"'.base_url('feast-includes').'/admin/assets/filemanager/",
                filemanager_title:"Responsive Filemanager",
                setup: function(ed) {
                  ed.on("init", function() {
                    tinymce.ScriptLoader.load("http://localhost/feast-cms/feast-content/themes/themeone/assets/js/main.js");
                  });
                }
             });

        </script>
        ';

        /*
        echo '<pre>';
        var_dump(shortcode_css());
        echo '</pre>';
        */

        define('THEME', $this->pref->active_theme);

        define('THEME_FOLDER', base_url().config_item('templates_path').$this->pref->active_theme.'/');


    }
}
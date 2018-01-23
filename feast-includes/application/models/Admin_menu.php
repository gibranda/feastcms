<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Admin_menu extends CI_Model {

    function __construct() {
        parent::__construct();
	}

   	public $menu_items = array(
			array(
				'title' => 'content',
				'order' => 1,
				'items' => array(
					array(
						'title' => 'categories',
						'order' => 30,
						'url' => 'categories',
						'icon' => 'fa fa-tags',
						'items' => array(
							array(
								'title' => 'all_categories',
								'order' => 10,
								'url' => 'categories',
							),
							array(
								'title' => 'add_category',
								'order' => 20,
								'url' => 'categories/add',
							)
						)
					),
					array(
						'title' => 'comments',
						'order' => 20,
						'url' => 'comments',
						'icon' => 'fa fa-comment',
						'items' => array()
					),
					array(
						'title' => 'posts',
						'order' => 10,
						'url' => 'posts',
						'icon' => 'fa fa-file-text',
						'items' => array(
							array(
								'title' => 'all_posts',
								'order' => 10,
								'url' => 'posts',
							),
							array(
								'title' => 'add_post',
								'order' => 20,
								'url' => 'posts/add',
							)
						)
					),
					array(
						'title' => 'pages',
						'order' => 40,
						'url' => 'pages',
						'icon' => 'fa fa-files-o',
						'items' => array(
							array(
								'title' => 'all_pages',
								'order' => 10,
								'url' => 'pages',
							),
							array(
								'title' => 'add_page',
								'order' => 20,
								'url' => 'pages/add',
							)
						)
					),
					array(
						'title' => 'sliders',
						'order' => 50,
						'url' => 'slider',
						'icon' => 'fa fa-desktop',
						'items' => array(
							array(
								'title' => 'all_sliders',
								'order' => 10,
								'url' => 'slider',
							),
							array(
								'title' => 'add_slider',
								'order' => 20,
								'url' => 'slider/add',
							)
						)
					),
					array(
						'title' => 'media',
						'order' => 60,
						'url' => 'media',
						'icon' => 'fa fa-image',
						'items' => array()
					),

				)
			),
			array(
				'title' => 'system',
				'order' => 3,
				'items' => array(
					array(
						'title' => 'settings',
						'order' => 40,
						'url' => 'settings',
						'icon' => 'fa fa-cogs',
						'items' => array(
							array(
								'title' => 'general_settings',
								'order' => 10,
								'url' => 'settings/general',
							),
							array(
								'title' => 'contact_settings',
								'order' => 20,
								'url' => 'settings/contact',
							)
						)
					),
					array(
						'title' => 'apperance',
						'order' => 10,
						'url' => 'apperance',
						'icon' => 'fa fa-tint',
						'items' => array(
							array(
								'title' => 'themes',
								'order' => 10,
								'url' => 'apperance/themes',
							),
							array(
								'title' => 'theme_options',
								'order' => 20,
								'url' => 'apperance/theme_options',
							)
						)
					),
					array(
						'title' => 'menus',
						'order' => 10,
						'url' => 'menu',
						'icon' => 'fa fa-bars',
						'items' => array(
							array(
								'title' => 'all_menus',
								'order' => 10,
								'url' => 'menu',
							),
							array(
								'title' => 'add_menu',
								'order' => 20,
								'url' => 'menu/add',
							)
						)
					),
					array(
						'title' => 'modules',
						'order' => 20,
						'url' => 'module',
						'icon' => 'fa fa-plug',
						'items' => array()
					),
					array(
						'title' => 'languages',
						'order' => 30,
						'url' => 'translator',
						'icon' => 'fa fa-language',
						'items' => array()
					)
				)
			),
			array(
				'title' => 'users',
				'order' => 2,
				'items' => array(
					array(
						'title' => 'users',
						'order' => 10,
						'url' => 'users',
						'icon' => 'fa fa-desktop',
						'items' => array(
							array(
								'title' => 'all_users',
								'order' => 10,
								'url' => 'users',
							),
							array(
								'title' => 'add_user',
								'order' => 20,
								'url' => 'users/add',
							)
						)
					),
					array(
						'title' => 'permissions',
						'order' => 30,
						'url' => 'permissions',
						'icon' => 'fa fa-desktop',
						'items' => array(
							array(
								'title' => 'all_permissions',
								'order' => 10,
								'url' => 'permissions',
							),
							array(
								'title' => 'add_permission',
								'order' => 20,
								'url' => 'permissions/add',
							)
						)
					),
					array(
						'title' => 'roles',
						'order' => 20,
						'url' => 'roles',
						'icon' => 'fa fa-desktop',
						'items' => array(
							array(
								'title' => 'all_roles',
								'order' => 10,
								'url' => 'roles',
							),
							array(
								'title' => 'add_role',
								'order' => 20,
								'url' => 'roles/add',
							)
						)
					)
				)
			),
		);

		private function cmp($a, $b)
		{
		    return strcmp($a["order"], $b["order"]);
		}

		public function add_section($name, $order = 4)
		{
			$this->menu_items[] = array(
				'title' => $name,
				'order' => $order,
				'items' => array()
			);
		}

		public function add_menu_item($name, $url, $icon = null,$order = 90, $section = 0)
		{

			$icon = empty($icon) ? 'fa fa-folder' : $icon;
			$icon = is_null($icon) ? 'fa fa-folder' : $icon;
			$this->menu_items[$section]['items'][] = array(
											'title' => $name,
											'order' => $order,
											'url' => $url,
											'icon' => $icon,
											'items' => array()
										);
		}

		public function add_sub_menu_item($name, $url, $order = 90, $section = 0, $parent = 0)
		{
			$this->menu_items[$section]['items'][$parent]['items'][] = array(
											'title' => $name,
											'order' => $order,
											'url' => $url
										);
		}

		public function build_menu()
		{

			usort($this->menu_items, array($this, 'cmp'));
			foreach($this->menu_items as $key => $value){
				usort($this->menu_items[$key]['items'], array($this, 'cmp'));

				foreach($this->menu_items[$key]['items'] as $k => $v){
					if(count($this->menu_items[$key]['items'][$k]['items'])) {
						usort($this->menu_items[$key]['items'][$k]['items'], array($this, 'cmp'));
					}
				}
			}

			$modules_path = FCPATH.'feast-content/modules/';     
			$modules = scandir($modules_path);

			foreach($modules as $module)
			{
			    if($module === '.' || $module === '..') continue;
			    if(is_dir($modules_path) . '/' . $module)
			    {
			        $functions_path = $modules_path . $module . '/functions.php';
			        if(file_exists($functions_path))
			        {
			            require($functions_path);
			        }
			        else
			        {
			            continue;
			        }
			    }
			}

		}

		function dump_menu()
		{
			echo '
			<pre>';
			var_dump($this->menu_items);
			echo '
			</pre>';			
		}


}
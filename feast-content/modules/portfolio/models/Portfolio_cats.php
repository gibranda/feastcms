<?php

/*
 * This file is part of the FeastCMS package.
 *
 * (c) Ead Hassan <support@eadhassan.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Portfolio_cats extends MY_Model
{
	protected $_table_name = 'portfolio_cats';
	public $rules = array(
		'title' => array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'trim|required|max_length[100]|xss_clean'
		),
		'slug' => array(
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'trim|required|max_length[100]|url_title|callback__unique_cat_slug|xss_clean'
		),
		'parent_id' => array(
			'field' => 'parent_id',
			'label' => 'Parent category',
			'rules' => 'trim|is_natural|xss_clean'
		),
		'order' => array(
			'field' => 'order',
			'label' => 'Order',
			'rules' => 'trim|required|is_natural|xss_clean'
		)
	);

	public function __construct ()
	{
		parent::__construct();
		$this->load->dbforge();

		
		// Create table if not exist
        $this->dbforge->add_field(array(
                'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'auto_increment' => TRUE
                ),
                'title' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                ),
                'slug' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255'
                ),
                'order' => array(
                        'type' => 'INT',
                        'constraint' => 11
                ),
                'parent_id' => array(
                        'type' => 'INT',
                        'null' => true,
                        'constraint' => 11,
                        'default' => '0'
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('portfolio_cats', TRUE);
        

	}

	public function get_new ()
	{
		$article = new stdClass();
		$article->title = '';
		$article->slug = '';
		$article->parent_id = 0;
		$article->order = '';
		return $article;
	}

    public function get_last($limit = 5) {
        $this->db->limit($limit);
		return $this->get();
    }

}
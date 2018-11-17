<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Migration Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		 https://google.com
 */
class Migration_Create_ratecars extends CI_Migration {

	private $_table = 'ratecars';

	private $_permissions = array(
		array('Ratecars Link', 'ratecars.ratecars.link'),
		array('Ratecars List', 'ratecars.ratecars.list'),
		array('View Ratecar', 'ratecars.ratecars.view'),
		array('Add Ratecar', 'ratecars.ratecars.add'),
		array('Edit Ratecar', 'ratecars.ratecars.edit'),
		array('Delete Ratecar', 'ratecars.ratecars.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'ratecars',
			'menu_text' 		=> 'Ratecars',    
			'menu_link' 		=> 'ratecars/ratecars', 
			'menu_perm' 		=> 'ratecars.ratecars.link', 
			'menu_icon' 		=> 'fa fa-leaf', 
			'menu_order' 		=> 2, 
			'menu_active' 		=> 1
		),
	);

	function __construct()
	{
		parent::__construct();

		$this->load->model('core/migrations_model');
	}
	
	public function up()
	{
		// create the table
		$fields = array(
			'ratecar_id'		=> array('type' => 'INT', 'constraint' => 10, 'auto_increment' => TRUE, 'unsigned' => TRUE, 'null' => FALSE),
			'ratecar_car_model_id'		=> array('type' => 'INT', 'constraint' => 10, 'null' => FALSE),
			'ratecar_rate'		=> array('type' => 'SMALLINT', 'constraint' => 5, 'null' => FALSE),
			'ratecar_rent_hr'		=> array('type' => 'SMALLINT', 'constraint' => 5, 'null' => FALSE),

			'ratecar_created_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'ratecar_created_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'ratecar_modified_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'ratecar_modified_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'ratecar_deleted' 		=> array('type' => 'TINYINT', 'constraint' => 1, 'unsigned' => TRUE, 'null' => FALSE, 'default' => 0),
			'ratecar_deleted_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('ratecar_id', TRUE);
		$this->dbforge->add_key('ratecar_car_model_id');
		$this->dbforge->add_key('ratecar_rate');
		$this->dbforge->add_key('ratecar_rent_hr');

		$this->dbforge->add_key('ratecar_deleted');
		$this->dbforge->create_table($this->_table, TRUE);

		// add the module permissions
		$this->migrations_model->add_permissions($this->_permissions);

		// add the module menu
		$this->migrations_model->add_menus($this->_menus);
	}

	public function down()
	{
		// drop the table
		$this->dbforge->drop_table($this->_table, TRUE);

		// delete the permissions
		$this->migrations_model->delete_permissions($this->_permissions);

		// delete the menu
		$this->migrations_model->delete_menus($this->_menus);
	}
}
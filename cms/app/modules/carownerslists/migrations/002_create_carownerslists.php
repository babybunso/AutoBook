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
class Migration_Create_carownerslists extends CI_Migration {

	private $_table = 'carownerslists';

	private $_permissions = array(
		array('Carownerslists Link', 'carownerslists.carownerslists.link'),
		array('Carownerslists List', 'carownerslists.carownerslists.list'),
		array('View Carownerslist', 'carownerslists.carownerslists.view'),
		array('Add Carownerslist', 'carownerslists.carownerslists.add'),
		array('Edit Carownerslist', 'carownerslists.carownerslists.edit'),
		array('Delete Carownerslist', 'carownerslists.carownerslists.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'carownerslists',
			'menu_text' 		=> 'Carownerslists',    
			'menu_link' 		=> 'carownerslists/carownerslists', 
			'menu_perm' 		=> 'carownerslists.carownerslists.link', 
			'menu_icon' 		=> 'fa fa-excel', 
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
			'carownerslist_id'		=> array('type' => 'INT', 'constraint' => 10, 'auto_increment' => TRUE, 'unsigned' => TRUE, 'null' => FALSE),
			'carownerslist_carowner_id'		=> array('type' => 'INT', 'constraint' => 10, 'null' => FALSE),
			'carownerslist_car_id'		=> array('type' => 'INT', 'constraint' => 10, 'null' => FALSE),
			'carownerslist_plate_number'		=> array('type' => 'VARCHAR', 'constraint' => 10, 'null' => FALSE),
			'carownerslist_rent_price'		=> array('type' => 'DECIMAL(10,2)', 'null' => FALSE),
			'carownerslist_status'		=> array('type' => 'SET("Active","Disabled")', 'null' => FALSE),

			'carownerslist_created_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'carownerslist_created_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'carownerslist_modified_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'carownerslist_modified_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'carownerslist_deleted' 		=> array('type' => 'TINYINT', 'constraint' => 1, 'unsigned' => TRUE, 'null' => FALSE, 'default' => 0),
			'carownerslist_deleted_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('carownerslist_id', TRUE);
		$this->dbforge->add_key('carownerslist_carowner_id');
		$this->dbforge->add_key('carownerslist_car_id');

		$this->dbforge->add_key('carownerslist_deleted');
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
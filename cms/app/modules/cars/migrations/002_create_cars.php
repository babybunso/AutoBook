<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Migration Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		http://google.com
 */
class Migration_Create_cars extends CI_Migration {

	private $_table = 'cars';

	private $_permissions = array(
		array('Cars Link', 'cars.cars.link'),
		array('Cars List', 'cars.cars.list'),
		array('View Car', 'cars.cars.view'),
		array('Add Car', 'cars.cars.add'),
		array('Edit Car', 'cars.cars.edit'),
		array('Delete Car', 'cars.cars.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'cars',
			'menu_text' 		=> 'Cars',    
			'menu_link' 		=> 'cars/cars', 
			'menu_perm' 		=> 'cars.cars.link', 
			'menu_icon' 		=> 'fa fa-car', 
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
			'car_id'		=> array('type' => 'INT', 'constraint' => 10, 'auto_increment' => TRUE, 'unsigned' => TRUE, 'null' => FALSE),
			'car_model'		=> array('type' => 'VARCHAR', 'constraint' => 255, 'null' => FALSE),
			'car_model_type'		=> array('type' => 'SET("Hatchback","Sedan", "MPV", "SUV", "Crossover", "Coupe", "Convertible")', 'null' => FALSE),
			'car_year'		=> array('type' => 'VARCHAR', 'constraint' => 255, 'null' => FALSE),
			'car_description'		=> array('type' => 'TEXT', 'null' => TRUE),
			'car_image'		=> array('type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE),
			'car_status'		=> array('type' => 'SET("Active","Disabled")', 'null' => FALSE),

			'car_created_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'car_created_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'car_modified_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
			'car_modified_on' 	=> array('type' => 'DATETIME', 'null' => TRUE),
			'car_deleted' 		=> array('type' => 'TINYINT', 'constraint' => 1, 'unsigned' => TRUE, 'null' => FALSE, 'default' => 0),
			'car_deleted_by' 	=> array('type' => 'MEDIUMINT', 'unsigned' => TRUE, 'null' => TRUE),
		);
		//markt price/, mileage


		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('car_id', TRUE);
		$this->dbforge->add_key('car_model');
		$this->dbforge->add_key('car_model_type');
		$this->dbforge->add_key('car_year');
		$this->dbforge->add_key('car_status');

		$this->dbforge->add_key('car_deleted');
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
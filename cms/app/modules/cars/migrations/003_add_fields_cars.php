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
class Migration_Add_fields_cars extends CI_Migration {

	private $_table = 'cars';

	function __construct()
	{
		parent::__construct();

		$this->load->model('core/migrations_model');
	}
	
	public function up()
	{
		// create the table
		$fields = array(
			'car_idb'		=> array('type' => 'DECIMAL(12,2)', 
				'auto_increment' => TRUE, 
				'unsigned' => TRUE, 
				'null' => FALSE, 
				'comment'=> 'Insured Declared Value',
				'AFTER' => 'car_year'),
			
		);
		//markt price/, mileage


		$this->dbforge->add_column($this->_table, $fields);
		
	}

	public function down()
	{
		// drop the table
	

		// delete the menu
		$this->migrations_model->drop_column($this->_table, 'car_idb');
	}
}
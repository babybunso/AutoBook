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
class Migration_Add_brands_cars extends CI_Migration {

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
			'car_brands'		=> array('type' => 'SET("Mitsubishi","Toyota","Ford","Chevrolet", "Nissan","Mazda","Volkswagen")',
				'comment'=> 'BRANDS',
				'BEFORE' => 'car_model_type'),
			
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
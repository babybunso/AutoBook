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
class Migration_Create_carowners extends CI_Migration {

	private $_table = 'carowners';

	private $_permissions = array(
		array('Carowners Link', 'carowners.carowners.link'),
		array('Carowners List', 'carowners.carowners.list'),
		array('View Carowner', 'carowners.carowners.view'),
		array('Add Carowner', 'carowners.carowners.add'),
		array('Edit Carowner', 'carowners.carowners.edit'),
		array('Delete Carowner', 'carowners.carowners.delete'),
	);

	private $_menus = array(
		array(
			'menu_parent'		=> 'carowners',
			'menu_text' 		=> 'Car Owners',    
			'menu_link' 		=> 'carowners/carowners', 
			'menu_perm' 		=> 'carowners.carowners.link', 
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
		

		// add the module permissions
		$this->migrations_model->add_permissions($this->_permissions);

		// add the module menu
		$this->migrations_model->add_menus($this->_menus);
	}

	public function down()
	{
		// drop the table
		

		// delete the permissions
		$this->migrations_model->delete_permissions($this->_permissions);

		// delete the menu
		$this->migrations_model->delete_menus($this->_menus);
	}
}
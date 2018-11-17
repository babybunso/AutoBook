<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Migration Class
 *
 * @package		 
 * @version		1.0
 * @author 		 
 * @copyright 	Copyright (c) 2015, Digify, Inc.
 * @link		 
 */
class Migration_Edit_audittrails_001 extends CI_Migration 
{
	private $_table = 'audittrails';

	private $_permissions = array(
		array('Truncate Audit Trails', 'reports.audittrails.truncate'),
	);

	function __construct()
	{
		parent::__construct();

		$this->load->model('core/migrations_model');
	}
	
	public function up()
	{
		// add the module permissions
		$this->migrations_model->add_permissions($this->_permissions);
	}

	public function down()
	{
		// delete the permissions
		$this->migrations_model->delete_permissions($this->_permissions);
	}
}
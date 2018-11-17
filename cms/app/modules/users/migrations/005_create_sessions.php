<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Migration Class
 *
 * @package		 
 * @version		1.0
 * @author 		      
 * @copyright 	Copyright (c) 2014-2015,   
 * @link		   
 */
class Migration_Create_sessions extends CI_Migration
{
	private $_table = 'user_sessions';

	function __construct()
	{
		parent::__construct();

		$this->load->model('core/migrations_model');
	}

	public function up()
	{
		$fields = array(
			'id' 				=> array('type' => 'VARCHAR', 'constraint' => 128, 'null' => FALSE),
			'ip_address' 		=> array('type' => 'VARCHAR', 'constraint' => 45, 'null' => FALSE),
			'timestamp' 		=> array('type' => 'INT', 'constraint' => 10, 'unsigned' => TRUE, 'null' => FALSE),
			'data' 				=> array('type' => 'TEXT', 'null' => FALSE),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('ip_address');
		$this->dbforge->add_key('timestamp');
		$this->dbforge->create_table($this->_table, TRUE);
	}

	public function down()
	{
		// drop the table
		$this->dbforge->drop_table($this->_table);
	}
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Users_model Class
 *
 * @package		 
 * @version		1.0
 * @author 		      
 * @copyright 	Copyright (c) 2014-2015,   
 * @link		   
 */
class Users_model extends BF_Model 
{
	protected $table_name			= 'users';
	protected $key					= 'id';
	protected $log_user				= FALSE;
	protected $set_created			= FALSE;
	protected $set_modified			= FALSE;
	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'deleted';
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cars_model Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		http://google.com
 */
class Cars_model extends BF_Model {

	protected $table_name			= 'cars';
	protected $key					= 'car_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'car_created_on';
	protected $created_by_field		= 'car_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'car_modified_on';
	protected $modified_by_field	= 'car_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'car_deleted';
	protected $deleted_by_field		= 'car_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	public function get_datatables()
	{
		$fields = array(
			'car_id',
			'car_model',
			'car_model_type',
			'car_year',
			'car_status',

			'car_created_on', 
			'concat(creator.first_name, " ", creator.last_name)', 
			'car_modified_on', 
			'concat(modifier.first_name, " ", modifier.last_name)'
		);

		return $this->join('users as creator', 'creator.id = car_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = car_modified_by', 'LEFT')
					->datatables($fields);
	}
}
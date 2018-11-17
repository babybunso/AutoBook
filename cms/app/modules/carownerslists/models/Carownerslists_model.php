<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Carownerslists_model Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		 https://google.com
 */
class Carownerslists_model extends BF_Model {

	protected $table_name			= 'carownerslists';
	protected $key					= 'carownerslist_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'carownerslist_created_on';
	protected $created_by_field		= 'carownerslist_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'carownerslist_modified_on';
	protected $modified_by_field	= 'carownerslist_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'carownerslist_deleted';
	protected $deleted_by_field		= 'carownerslist_deleted_by';

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
			'carownerslist_id',
			'carownerslist_carowner_id',
			'carownerslist_car_id',
			'carownerslist_plate_number',
			'carownerslist_rent_price',
			'carownerslist_status',

			'carownerslist_created_on', 
			'concat(creator.first_name, " ", creator.last_name)', 
			'carownerslist_modified_on', 
			'concat(modifier.first_name, " ", modifier.last_name)'
		);

		return $this->join('users as creator', 'creator.id = carownerslist_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = carownerslist_modified_by', 'LEFT')
					->datatables($fields);
	}
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Ratecars_model Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		 https://google.com
 */
class Ratecars_model extends BF_Model {

	protected $table_name			= 'ratecars';
	protected $key					= 'ratecar_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'ratecar_created_on';
	protected $created_by_field		= 'ratecar_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'ratecar_modified_on';
	protected $modified_by_field	= 'ratecar_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'ratecar_deleted';
	protected $deleted_by_field		= 'ratecar_deleted_by';

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
			'ratecar_id',
			'ratecar_car_model_id',
			'ratecar_rate',
			'ratecar_rent_hr',

			'ratecar_created_on', 
			'concat(creator.first_name, " ", creator.last_name)', 
			'ratecar_modified_on', 
			'concat(modifier.first_name, " ", modifier.last_name)'
		);

		return $this->join('users as creator', 'creator.id = ratecar_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = ratecar_modified_by', 'LEFT')
					->datatables($fields);
	}
}
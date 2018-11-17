<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Carowners Class
 *
 * @package	 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		 https://google.com
 */
class Carowners extends MX_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->library('users/acl');
		$this->load->language('carowners');
		$this->load->model('users/groups_model');
		$this->load->model('users/users_model', 'users');
		$this->load->model('users/users_groups_model', 'users_groups');

		
	}
	
	// --------------------------------------------------------------------

	/**
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	public function index()
	{
		$this->acl->restrict('carowners.carowners.list');
		
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('carowners'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());
		
		
		
		// add plugins
		$this->template->add_css('mods/datatables.net-bs4/css/dataTables.bootstrap4.css');
		$this->template->add_css('mods/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
		$this->template->add_js('mods/datatables.net/js/jquery.dataTables.js');
		$this->template->add_js('mods/datatables.net-bs4/js/dataTables.bootstrap4.js');
		$this->template->add_js('mods/datatables.net-responsive/js/dataTables.responsive.min.js');
		$this->template->add_js('mods/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');

		// render the page
		$this->template->add_css(module_css('carowners', 'carowners_index'), 'embed');
		$this->template->add_js(module_js('carowners', 'carowners_index'), 'embed');
		$this->template->write_view('content', 'carowners_index', $data);
		$this->template->render();
	}	

/**
 * datatables
 *
 * @access	public
 * @param	mixed datatables parameters (datatables.net)
 * @author 	      
 */
	public function datatables()
	{
		$this->acl->restrict('users.users.list');

		$fields = array('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.created_on', 'users.last_login', 'users.active');

		/* echo 
			$this->users_model
				->join('users_groups', 'users_groups.user_id=users_model.id')
				->datatables($fields); */

		echo $this->users
			->join('users_groups', 'users_groups.user_id=users.id')
			->where ('users_groups.group_id', 3)
			->datatables($fields); 

	}
/*
select * from users
left join users_groups  on users_groups.user_id = users.id
where users_groups.user_id = 3

*/

}

/* End of file Carowners.php */
/* Location: ./application/modules/carowners/controllers/Carowners.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Carownerslists Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		 https://google.com
 */
class Carownerslists extends MX_Controller {
	
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
		$this->load->model('carownerslists_model');
		$this->load->model('cars/cars_model');
		$this->load->language('carownerslists');
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
		$this->acl->restrict('carownerslists.carownerslists.list');
		
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('carownerslists'));
		
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
		$this->template->add_css(module_css('carownerslists', 'carownerslists_index'), 'embed');
		$this->template->add_js(module_js('carownerslists', 'carownerslists_index'), 'embed');
		$this->template->write_view('content', 'carownerslists_index', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * datatables
	 *
	 * @access	public
	 * @param	mixed datatables parameters (datatables.net)
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	public function datatables()
	{
		$this->acl->restrict('carownerslists.carownerslists.list');
		if ($this->session->userdata('group_id') == 3) {
			echo $this->carownerslists_model
				->where('carownerslist_created_by',$this->session->userdata('user_id') )
				->get_datatables();
		}
		else 
			echo $this->carownerslists_model->get_datatables();
	}

	// --------------------------------------------------------------------

	/**
	 * form
	 *
	 * @access	public
	 * @param	$action string
	 * @param   $id integer
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	function form($action = 'add', $id = FALSE)
	{
		$this->acl->restrict('carownerslists.carownerslists.' . $action, 'modal');

		$data['page_heading'] = lang($action . '_heading');
		$data['action'] = $action;

		if ($this->input->post())
		{
			if ($this->_save($action, $id))
			{
				echo json_encode(array('success' => true, 'message' => lang($action . '_success'))); exit;
			}
			else
			{	
				$response['success'] = FALSE;
				$response['message'] = lang('validation_error');
				$response['errors'] = array(					
					'carownerslist_carowner_id'		=> form_error('carownerslist_carowner_id'),
					'carownerslist_car_id'		=> form_error('carownerslist_car_id'),
					'carownerslist_plate_number'		=> form_error('carownerslist_plate_number'),
				//	'carownerslist_rent_price'		=> form_error('carownerslist_rent_price'),
					'carownerslist_status'		=> form_error('carownerslist_status'),
				);
				echo json_encode($response);
				exit;
			}
		}

		$data['current_groups'] = '';
		if ($action != 'add') {
			
			$data['record'] = $this->carownerslists_model->find($id);
			$data['current_groups'] = $data['record']->carownerslist_car_id;
			
		}

		$data['cars_model_list']  = $this->cars_model
			->order_by('car_model', 'asc')
			->find_all_by(array('car_status'=>'Active', 'car_deleted'=> 0));
//	pr(  $data['cars_model_list'] );
	

		// render the page
		$this->template->set_template('modal');
		$this->template->add_css(module_css('carownerslists', 'carownerslists_form'), 'embed');
		$this->template->add_js(module_js('carownerslists', 'carownerslists_form'), 'embed');
		$this->template->add_css('mods/select2/css/select2.min.css');
		$this->template->add_js('mods/select2/js/select2.min.js');	
		$this->template->write_view('content', 'carownerslists_form', $data);
		$this->template->render();
	}

	function change_dropdown() {
		header("Content-type: application/json; charset=utf-8");

		$filter = $this->uri->segment(4);
		$value =  $data['cars_model_list']  = $this->cars_model
			->where('car_brands', $filter )
			->order_by('car_model', 'asc')
			->find_all_by(array('car_status'=>'Active', 'car_deleted'=> 0));
			//pr($value);
			echo json_encode($value);
	}

	// --------------------------------------------------------------------

	/**
	 * delete
	 *
	 * @access	public
	 * @param	integer $id
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	function delete($id)
	{
		$this->acl->restrict('carownerslists.carownerslists.delete', 'modal');

		$data['page_heading'] = lang('delete_heading');
		$data['page_confirm'] = lang('delete_confirm');
		$data['page_button'] = lang('button_delete');
		$data['datatables_id'] = '#datatables';

		if ($this->input->post())
		{
			$this->carownerslists_model->delete($id);

			echo json_encode(array('success' => true, 'message' => lang('delete_success'))); exit;
		}

		$this->load->view('../../modules/core/views/confirm', $data);
	}


	// --------------------------------------------------------------------

	/**
	 * _save
	 *
	 * @access	private
	 * @param	string $action
	 * @param 	integer $id
	 * @author 	CMS Admin <densetsu.ghem@gmail.com>
	 */
	private function _save($action = 'add', $id = 0)
	{
		// validate inputs
		$this->form_validation->set_rules('carownerslist_carowner_id', lang('carownerslist_carowner_id'), 'required');
		//$this->form_validation->set_rules('carownerslist_car_id', lang('carownerslist_car_id'), 'required');
		$this->form_validation->set_rules('carownerslist_plate_number', lang('carownerslist_plate_number'), 'required');
	//	$this->form_validation->set_rules('carownerslist_rent_price', lang('carownerslist_rent_price'), 'required');
		$this->form_validation->set_rules('carownerslist_status', lang('carownerslist_status'), 'required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		
		if ($this->form_validation->run($this) == FALSE)
		{
			return FALSE;
		}

		$data = array(
			'carownerslist_carowner_id'		=> $this->input->post('carownerslist_carowner_id'),
			'carownerslist_car_id'		=> $this->input->post('carownerslist_car_id'),
			'carownerslist_plate_number'		=> $this->input->post('carownerslist_plate_number'),
			'carownerslist_rent_price'		=> $this->input->post('carownerslist_rent_price'),
			'carownerslist_status'		=> $this->input->post('carownerslist_status'),
			'car_idb'			=> $this->input->post('car_idb'),
			'car_brands'			=> $this->input->post('car_brands'),
			'car_mileage'			=>$this->input->post('car_mileage'),
			'car_mileage_discount'	=>$this->input->post('car_mileage_discount'),
			'rent_milediscount'	=>$this->input->post('rent_milediscount'),
		);
		

		if ($action == 'add')
		{
			$insert_id = $this->carownerslists_model->insert($data);
			$return = (is_numeric($insert_id)) ? $insert_id : FALSE;
		}
		else if ($action == 'edit')
		{
			$return = $this->carownerslists_model->update($id, $data);
		}

		return $return;

	}
}

/* End of file Carownerslists.php */
/* Location: ./application/modules/carownerslists/controllers/Carownerslists.php */
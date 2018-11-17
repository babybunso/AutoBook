<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cars Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		http://google.com
 */
class Cars extends MX_Controller {
	
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
		$this->load->model('cars_model');
		$this->load->language('cars');
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
		$this->acl->restrict('cars.cars.list');
		
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('cars'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());
		
		//pr($this->session->userdata());
		// add plugins
		$this->template->add_css('mods/datatables.net-bs4/css/dataTables.bootstrap4.css');
		$this->template->add_css('mods/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
		$this->template->add_js('mods/datatables.net/js/jquery.dataTables.js');
		$this->template->add_js('mods/datatables.net-bs4/js/dataTables.bootstrap4.js');
		$this->template->add_js('mods/datatables.net-responsive/js/dataTables.responsive.min.js');
		$this->template->add_js('mods/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
		
		
		
		
		// render the page
		$this->template->add_css(module_css('cars', 'cars_index'), 'embed');
		$this->template->add_js(module_js('cars', 'cars_index'), 'embed');
		$this->template->write_view('content', 'cars_index', $data);
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
		$this->acl->restrict('cars.cars.list');

		echo $this->cars_model->get_datatables();
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
		$this->acl->restrict('cars.cars.' . $action, 'modal');

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
					'car_model'		=> form_error('car_model'),
					'car_model_type'		=> form_error('car_model_type'),
					/* 'car_year'		=> form_error('car_year'), */
					'car_description'		=> form_error('car_description'),
					'car_status'		=> form_error('car_status'),
				);
				echo json_encode($response);
				exit;
			}
		}

		if ($action != 'add') $data['record'] = $this->cars_model->find($id);


		

		// render the page
		$this->template->set_template('modal');
		$this->template->add_css(module_css('cars', 'cars_form'), 'embed');
		$this->template->add_js(module_js('cars', 'cars_form'), 'embed');
		$this->template->write_view('content', 'cars_form', $data);
		$this->template->render();
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
		$this->acl->restrict('cars.cars.delete', 'modal');

		$data['page_heading'] = lang('delete_heading');
		$data['page_confirm'] = lang('delete_confirm');
		$data['page_button'] = lang('button_delete');
		$data['datatables_id'] = '#datatables';

		if ($this->input->post())
		{
			$this->cars_model->delete($id);

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
		$this->form_validation->set_rules('car_model', lang('car_model'), 'required');
		$this->form_validation->set_rules('car_model_type', lang('car_model_type'), 'required');
		//$this->form_validation->set_rules('car_year', lang('car_year'), 'required');
		$this->form_validation->set_rules('car_description', lang('car_description'), 'required');
		$this->form_validation->set_rules('car_status', lang('car_status'), 'required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		
		if ($this->form_validation->run($this) == FALSE)
		{
			return FALSE;
		}

		$data = array(
			'car_model'		=> $this->input->post('car_model'),
			'car_model_type'		=> $this->input->post('car_model_type'),
			'car_year'		=> $this->input->post('car_year'),
			'car_description'		=> $this->input->post('car_description'),
			'car_image'		=> $this->input->post('car_image'),
			'car_status'		=> $this->input->post('car_status'),
			'car_idb'		=>$this->input->post('car_idb'),
			'car_brands'		=>$this->input->post('car_brands'),
		);
		

		if ($action == 'add')
		{
			$insert_id = $this->cars_model->insert($data);
			$return = (is_numeric($insert_id)) ? $insert_id : FALSE;
		}
		else if ($action == 'edit')
		{
			$return = $this->cars_model->update($id, $data);
		}

		return $return;

	}
}

/* End of file Cars.php */
/* Location: ./application/modules/cars/controllers/Cars.php */
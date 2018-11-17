<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Ratecars Class
 *
 * @package		 DG
 * @version		1.0
 * @author 		CMS Admin <densetsu.ghem@gmail.com>
 * @copyright 	Copyright (c) 2018, Digify Team
 * @link		 https://google.com
 */
class Ratecars extends MX_Controller {
	
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
		$this->load->model('ratecars_model');
		$this->load->language('ratecars');
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
		$this->acl->restrict('ratecars.ratecars.list');
		
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('ratecars'));
		
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
		$this->template->add_css(module_css('ratecars', 'ratecars_index'), 'embed');
		$this->template->add_js(module_js('ratecars', 'ratecars_index'), 'embed');
		$this->template->write_view('content', 'ratecars_index', $data);
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
		$this->acl->restrict('ratecars.ratecars.list');

		echo $this->ratecars_model->get_datatables();
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
		$this->acl->restrict('ratecars.ratecars.' . $action, 'modal');

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
					'ratecar_car_model_id'		=> form_error('ratecar_car_model_id'),
					'ratecar_rate'		=> form_error('ratecar_rate'),
					'ratecar_rent_hr'		=> form_error('ratecar_rent_hr'),
				);
				echo json_encode($response);
				exit;
			}
		}

		if ($action != 'add') $data['record'] = $this->ratecars_model->find($id);


		

		// render the page
		$this->template->set_template('modal');
		$this->template->add_css(module_css('ratecars', 'ratecars_form'), 'embed');
		$this->template->add_js(module_js('ratecars', 'ratecars_form'), 'embed');
		$this->template->write_view('content', 'ratecars_form', $data);
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
		$this->acl->restrict('ratecars.ratecars.delete', 'modal');

		$data['page_heading'] = lang('delete_heading');
		$data['page_confirm'] = lang('delete_confirm');
		$data['page_button'] = lang('button_delete');
		$data['datatables_id'] = '#datatables';

		if ($this->input->post())
		{
			$this->ratecars_model->delete($id);

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
		$this->form_validation->set_rules('ratecar_car_model_id', lang('ratecar_car_model_id'), 'required');
		$this->form_validation->set_rules('ratecar_rate', lang('ratecar_rate'), 'required');
		$this->form_validation->set_rules('ratecar_rent_hr', lang('ratecar_rent_hr'), 'required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		
		if ($this->form_validation->run($this) == FALSE)
		{
			return FALSE;
		}

		$data = array(
			'ratecar_car_model_id'		=> $this->input->post('ratecar_car_model_id'),
			'ratecar_rate'		=> $this->input->post('ratecar_rate'),
			'ratecar_rent_hr'		=> $this->input->post('ratecar_rent_hr'),
		);
		

		if ($action == 'add')
		{
			$insert_id = $this->ratecars_model->insert($data);
			$return = (is_numeric($insert_id)) ? $insert_id : FALSE;
		}
		else if ($action == 'edit')
		{
			$return = $this->ratecars_model->update($id, $data);
		}

		return $return;

	}
}

/* End of file Ratecars.php */
/* Location: ./application/modules/ratecars/controllers/Ratecars.php */
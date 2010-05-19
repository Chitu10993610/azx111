<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Iht_area.php
 *
 * DESCRIPTION   : Iht_area module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2010-02-02 04:18 AM   - dungbt     - Created
 *
 * @package             Iht_area
 * @subpackage          iht_area component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2009-2010 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 */

class Iht_area extends Controller {

	/**
	* Contructor function
	*
	* Load the instance of CI by invoking the parent constructor
	*
	* @access      public
	* @return      none
	*/
	function Iht_area() {
	  	parent::Controller();
	  	$this->load->helper('html');
	}
	
	/**
	* "Index" Page
	*
	* Default class action
	*
	* @access      public
	* @return      none
	*/
	
	function index() {
	  	// The default action is the showall action
	  	$this->browse();
	}

	/**
	 * Function: browse()
	 * Description: Extracts a list of all iht_area data records and displays it.
	 */
	function browse() {
		$this->user_group_model->can_access('View list area', null, null);
		
		$start = (int)$this->uri->segment(3,0);
		$limit_per_page = 20;
		
		$this->load->model('iht_area_model');                  // Instantiate the model
		//$user_id = $this->session->userdata('userid');
		      
		$filter = '';
		$the_results['iht_area_list'] = $this->iht_area_model->findByFilter($filter, $start, $limit_per_page);
		
		$this->load->library('pagination');
		
		
		$config['total_rows']   = $this->iht_area_model->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['base_url'] = base_url().'iht_area/browse/';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		
		$this->pagination->initialize($config);
		
		$the_results['page_links'] = $this->pagination->create_links();
		$the_results['title'] = "List iht_area";
		$the_results['start'] = $start;
		
		// Display in Template
		$this->_display('/iht_area/iht_area_grid', $the_results);
	}

   /**
    * Function: add()
    * Description: Prompts user for input and adds a new iht_area entry ...onto the database.
    */
	function add() {
		$this->user_group_model->can_access('Add new area', null, null);
		$submit = $this->input->post('Submit');      
		
		if ( $submit != false) {
		  	$this->load->library('form_validation');
		  	
		  	//field validates
			$this->_validate_form();
		  	$data = $this->_get_form_values();
		
			if($this->form_validation->run() == TRUE) {
		
			  	$this->load->model('iht_area_model');
				//$data['create_user']	= $this->session->userdata('userid');
		
				$this->iht_area_model->add($data);
				redirect('iht_area/', 'location');
			}
		}
		
		if(!$submit) $data = $this->_clear_form();
		
		$data['action']       = 'add';
		$data['title'] = 'Add iht_area';
		
		$this->_prepare_form($data);
		
		$this->_display('/iht_area/iht_area_form', $data);
	}

   /**
    * Function: modify()
    * Description: Controller function to process user modify requests
    */
	function modify() {
		$this->user_group_model->can_access('Edit area', null, null);
		$this->load->model('iht_area_model');

		$submit = $this->input->post('Submit');
		
		if ( $submit != false) {
			$this->load->library('form_validation');
		
			//field validates
			$this->_validate_form();
		
			if($this->form_validation->run() == TRUE) {
				$data = $this->_get_form_values();
				$data['id']		= $this->input->post('id', TRUE);
				//$data['create_user']	= $this->session->userdata('userid');
				
				$this->iht_area_model->modify($data['id'], $data);
				redirect('iht_area/', 'location');
			}
		}
		
		if(!$submit) {
			$idField = $this->uri->segment(3);
			$data = $this->iht_area_model->retrieve_by_pkey($idField);
		}
		
		$data['action'] = 'modify/'.$idField;
		$data['title'] = 'Edit iht_area';
		
		$this->_prepare_form($data);
		
		$this->_display('/iht_area/iht_area_form', $data);
	}


	/**
	* Function: delete()
	* Description: Controller function to process user delete requests
	*/
	function delete() {
		$this->user_group_model->can_access('Delete area', null, null);
	  	$idField = $this->uri->segment(3);
	
	  	$this->load->model('iht_area_model');
	  	
		//$user_id = $this->session->userdata('userid');
	  	$the_results = $this->iht_area_model->delete_by_pkey($idField);
	
	  	redirect('/iht_area/', 'location');
	}

	/**
	 * clear form
	 * @return array
	 */
	function _clear_form() {
		$data['id']		= '';
		$data['area_name']		= '';
		$data['province_id']		= '';
		$data['district_id']		= '';
		$data['description']		= '';
		$data['is_dtm']		= '';

      	return $data;
	}

	/**
	 * get form values
	 *
	 * @return array
	 */
	function _get_form_values() {
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['area_name']		= $this->input->post('area_name', TRUE);
		$data['province_id']		= $this->input->post('province_id', TRUE);
		$data['district_id']		= $this->input->post('district_id', TRUE);
		$data['description']		= $this->input->post('description', TRUE);
		$data['is_dtm']		= $this->input->post('is_dtm', TRUE);

		return $data;
	}
   
	/**
	 * validate form
	 */
	function _validate_form() {

		//trim|required|min_length[5]|max_length[12]|xss_clean
		$this->form_validation->set_rules('id','Id', 'xss_clean');
		$this->form_validation->set_rules('area_name','Name', 'xss_clean');
		$this->form_validation->set_rules('province_id','Province_id', 'xss_clean');
		$this->form_validation->set_rules('district_id','District_id', 'xss_clean');
		$this->form_validation->set_rules('description','Description', 'xss_clean');
		$this->form_validation->set_rules('is_dtm','Is_dtm', 'xss_clean');

		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
	}
   
	/**
	* prepare form
	*/
	function _prepare_form (&$data) {
		// Retrieve the iht_province lookup values.
		$this->load->model('iht_province_model');
		$data['iht_provincelist'] = $this->iht_province_model->findAll();
		// Retrieve the iht_district lookup values.
		$this->load->model('iht_district_model');
		$data['iht_districtlist'] = $this->iht_district_model->findAll();

	}
	
	/**
	 * private function, format data to template
	 */
	function _display($page_req, $data = array()) {
		
		$data['content'] = $this->load->view($page_req, $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);
	}
}
?>
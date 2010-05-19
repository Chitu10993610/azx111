<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Category.php
 *
 * DESCRIPTION   : Category module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-06-30 11:18 PM   - dungbt     - Created
 *
 * @package             Category
 * @subpackage          category component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2008-2009 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 */

class Category extends Controller {

	/**
	* Contructor function
	*
	* Load the instance of CI by invoking the parent constructor
	*
	* @access      public
	* @return      none
	*/
	function Category() {
	  	parent::Controller();
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
	 * Description: Extracts a list of all category data records and displays it.
	 */
	function browse() {
		$this->user_group_model->can_access('View list cat', null, null);
		
		$start = $this->uri->segment(3,0);
		$limit_per_page = 20;
		
		$this->load->model('category_model');                  // Instantiate the model
		//$user_id = $this->session->userdata('userid');
		      
		$filter = '';
		$the_results['category_list'] = $this->category_model->findByFilter($filter, $start, $limit_per_page);
		
		$this->load->library('pagination');
		
		
		$config['total_rows']   = $this->category_model->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['base_url'] = base_url().'category/browse/';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		
		$this->pagination->initialize($config);
		
		$the_results['page_links'] = $this->pagination->create_links();
		$the_results['title'] = "List category";
		$the_results['start'] = $start;
		
		// Display in Template
		$this->_display('/category/category_grid', $the_results);
	}

   /**
    * Function: add()
    * Description: Prompts user for input and adds a new category entry ...onto the database.
    */
	function add() {
		$this->user_group_model->can_access('Add new cat', null, null);
		$submit = $this->input->post('Submit');      
		
		if ( $submit != false) {
		  	$this->load->library('form_validation');
		  	
		  	//field validates
			$this->_validate_form();
		  	$data = $this->_get_form_values();
		
			if($this->form_validation->run() == TRUE) {
		
			  	$this->load->model('category_model');
				//$data['create_user']	= $this->session->userdata('userid');
		
				$this->category_model->add($data);
				redirect('category/', 'location');
			}
		}
		
		if(!$submit) $data = $this->_clear_form();
		
		$data['action']       = 'add';
		$data['title'] = 'Add category';
		
		$this->_prepare_form($data);
		
		$this->_display('/category/category_form', $data);
	}

   /**
    * Function: modify()
    * Description: Controller function to process user modify requests
    */
	function modify() {
		$this->user_group_model->can_access('Edit cat', null, null);
		$this->load->model('category_model');

		$submit = $this->input->post('Submit');
		
		if ( $submit != false) {
			$this->load->library('form_validation');
		
			//field validates
			$this->_validate_form();
		
			if($this->form_validation->run() == TRUE) {
				$data = $this->_get_form_values();
				$data['id']		= $this->input->post('id', TRUE);
				//$data['create_user']	= $this->session->userdata('userid');
				
				$this->category_model->modify($data['id'], $data);
				redirect('category/', 'location');
			}
		}
		
		if(!$submit) {
			$idField = $this->uri->segment(3);
			$data = $this->category_model->retrieve_by_pkey($idField);
		}
		
		$data['action'] = 'modify/'.$idField;
		$data['title'] = 'Edit category';
		
		$this->_prepare_form($data);
		
		$this->_display('/category/category_form', $data);
	}


	/**
	* Function: delete()
	* Description: Controller function to process user delete requests
	*/
	function delete() {
		$this->user_group_model->can_access('Delete cat', null, null);
	  	$idField = $this->uri->segment(3);
	
	  	$this->load->model('category_model');
	  	
		//$user_id = $this->session->userdata('userid');
	  	$the_results = $this->category_model->delete_by_pkey($idField);
	
	  	redirect('/category/', 'location');
	}

	/**
	 * clear form
	 * @return array
	 */
	function _clear_form() {
		$data['cat_id']		= '';
		$data['cat_name']		= '';

      	return $data;
	}

	/**
	 * get form values
	 *
	 * @return array
	 */
	function _get_form_values() {
		// XXS Filtering enforced for user input
		$data['cat_id']		= $this->input->post('cat_id', TRUE);
		$data['cat_name']		= $this->input->post('cat_name', TRUE);

		return $data;
	}
   
	/**
	 * validate form
	 */
	function _validate_form() {

		//trim|required|min_length[5]|max_length[12]|xss_clean
		$this->form_validation->set_rules('cat_id','Cat_id', 'xss_clean');
		$this->form_validation->set_rules('cat_name','Cat_name', 'xss_clean');

		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
	}
   
	/**
	* prepare form
	*/
	function _prepare_form (&$data) {

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
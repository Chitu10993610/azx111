<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : contact.php
 *
 * DESCRIPTION   : contact module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-12-15 11:53 PM   - dungbt     - Created
 *
 * @package             contact
 * @subpackage          contact component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2008-2009 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 */

class Contact extends Controller {

	/**
	* Contructor function
	*
	* Load the instance of CI by invoking the parent constructor
	*
	* @access      public
	* @return      none
	*/
	function Contact() {
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
	 * Description: Extracts a list of all contact data records and displays it.
	 */
	function browse() {
		$this->user_group_model->can_access(VIEW_LIST_CONTACT, null, null);
		
		$start = (int)$this->uri->segment(3,0);
		$limit_per_page = 20;
		
		$this->load->model('contact_model');                  // Instantiate the model
		//$user_id = $this->session->userdata('userid');
		      
		$filter = '';
		$the_results['contact_list'] = $this->contact_model->findByFilter($filter, $start, $limit_per_page);
		
		$this->load->library('pagination');
		
		
		$config['total_rows']   = $this->contact_model->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['base_url'] = base_url().'contact/browse/';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		
		$this->pagination->initialize($config);
		
		$the_results['page_links'] = $this->pagination->create_links();
		$the_results['title'] = "List contact";
		$the_results['start'] = $start;
		
		// Display in Template
		$this->_display('/contact/contact_grid', $the_results);
	}

   /**
    * Function: modify()
    * Description: Controller function to process user modify requests
    */
	function modify() {
		$this->user_group_model->can_access(VIEW_CONTACT_DETAIL, null, null);
		$this->load->model('contact_model');

		$submit = $this->input->post('Submit');
		
		if ( $submit != false) {
			$this->load->library('form_validation');
		
			//field validates
			$this->_validate_form();
		
			if($this->form_validation->run() == TRUE) {
				$data = $this->_get_form_values();
				$data['id']		= $this->input->post('id', TRUE);
				//$data['create_user']	= $this->session->userdata('userid');
				
				$this->contact_model->modify($data['id'], $data);
				redirect('contact/', 'location');
			}
		}
		
		if(!$submit) {
			$idField = $this->uri->segment(3);
			$data = $this->contact_model->retrieve_by_pkey($idField);
		}
		
		$data['action'] = 'modify/'.$idField;
		$data['title'] = 'Edit contact';
		
//		$this->_prepare_form($data);
		
		$this->_display('/contact/contact_view', $data);
	}


	/**
	* Function: delete()
	* Description: Controller function to process user delete requests
	*/
	function delete() {
		$this->user_group_model->can_access(DELETE_CONTACT, null, null);
	  	$idField = $this->uri->segment(3);
	
	  	$this->load->model('contact_model');
	  	
		//$user_id = $this->session->userdata('userid');
	  	$the_results = $this->contact_model->delete_by_pkey($idField);
	
	  	redirect('/contact/', 'location');
	}

	/**
	 * clear form
	 * @return array
	 */
	function _clear_form() {
		$data['name']		= '';
		$data['address']		= '';
		$data['email']		= '';
		$data['phone']		= '';
		$data['mobile']		= '';
		$data['subject']		= '';
		$data['content']		= '';
		$data['create_date']		= '';
		$data['status']		= '';
		$data['id']		= '';
		$data['recyclebin']		= '';
		$data['update_date']		= '';

      	return $data;
	}

	/**
	 * get form values
	 *
	 * @return array
	 */
	function _get_form_values() {
		// XXS Filtering enforced for user input
		$data['name']		= $this->input->post('name', TRUE);
		$data['address']		= $this->input->post('address', TRUE);
		$data['email']		= $this->input->post('email', TRUE);
		$data['phone']		= $this->input->post('phone', TRUE);
		$data['mobile']		= $this->input->post('mobile', TRUE);
		$data['subject']		= $this->input->post('subject', TRUE);
		$data['content']		= $this->input->post('content', TRUE);
		$data['create_date']		= $this->input->post('create_date', TRUE);
		$data['status']		= $this->input->post('status', TRUE);
		$data['id']		= $this->input->post('id', TRUE);
		$data['recyclebin']		= $this->input->post('recyclebin', TRUE);
		$data['update_date']		= $this->input->post('update_date', TRUE);

		return $data;
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
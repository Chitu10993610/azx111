<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Webs.php
 *
 * DESCRIPTION   : Webs module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             Webs
 * @subpackage          ci_webs component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Webs extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Webs() {
      parent::Controller();
      $this->load->helper('html');
      $this->lang->load('userauth', $this->session->userdata('ua_language'));
      $this->lang->load('validation', $this->session->userdata('ua_language'));
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
   	$this->user_group_model->can_access('View list Webs', null, null);
      // The default action is the showall action
      $this->browse();
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all ci_webs data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
   	
      $start = $this->uri->segment(4,0);
      $limit_per_page = 20;
      $site_id = $this->session->userdata('site_id');
	
      $filter = "WHERE site_id = '$site_id'";
      $this->load->model('ci_websmodel');                  // Instantiate the model
      $the_results['ci_webs_list'] = $this->ci_websmodel->findByFilter($filter, $start, $limit_per_page);  // Send the retrievelist msg
    
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->ci_websmodel->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'webs/browse/';

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = 'Webs List';
   		
      $this->_display('/ci_webs/ci_websgrid', $the_results);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_webs entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
		$this->user_group_model->can_access('Add new Webs', null, null);
      $this->load->helper('url');
      $error = '';

      // ///////////////////////////////////////////////////////////////////////
      // How are we being invoked. The user is either requesting a form or is
      // ...submitting it.
      // ///////////////////////////////////////////////////////////////////////
      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
		$this->form_validation->set_rules('webs_title','Title', 'required|xss_clean');
		$this->form_validation->set_rules('description','Description', 'xss_clean');
		$this->form_validation->set_rules('webs_url','Webs_url', 'xss_clean');

      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
         
      	// ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('ci_websmodel');
         $data = $this->_get_form_values();
         
         if($_FILES['image']['name'] != '') {
	        $config['upload_path'] = './images/'.'webs';
			$config['allowed_types'] = 'gif|jpg|png|swf';
			$config['max_size']	= '5000';
			$config['max_width']  = '11024';
			$config['max_height']  = '11768';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('image')) {
				$error = $this->upload->display_errors('<div class="error">','</div>');
			}
			else {
				$upload_data = $this->upload->data();
				$data['image'] = $upload_data['file_name'];
				
				//resize image
				$this->load->library('iht_common');
				$error = $this->iht_common->create_thumb($config['upload_path'].'/'.$upload_data['file_name'], 100, 100, false);
				
			}
        }
        else {
        	unset($data['image']);
        }
	        
         if(!$error) {
         	$this->ci_websmodel->add($data);
         	$this->session->set_flashdata('msg', $this->lang->line('ua_webs_added'));
         	redirect('webs/', 'location');	
         }
      	}
      }
      
         $data = $this->_clear_form();
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
		$data['pos_adv'] = $this->config->item('pos_adv');
         $data['title']       = 'Add a webs';
         $data['action']       = 'add';
         $data['error']       = $error;

		$data['content'] = $this->load->view('/ci_webs/ci_websdetails', $data, TRUE);
		
		$this->_display('/ci_webs/ci_websdetails', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
	$this->user_group_model->can_access('Edit Webs', null, null);
      $this->load->helper('url');
      $error = '';

      // ///////////////////////////////////////////////////////////////////////
      // How are we being invoked
      // ///////////////////////////////////////////////////////////////////////
      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
      	$this->form_validation->set_rules('id','Id', 'xss_clean');
		$this->form_validation->set_rules('webs_title','Title', 'required|xss_clean');
		$this->form_validation->set_rules('description','Description', 'xss_clean');
		$this->form_validation->set_rules('webs_url','Webs url', 'xss_clean');
      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
      	
         // ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('ci_websmodel');

         $data = $this->_get_form_values();
   		$data['id']		= $this->input->post('id', TRUE);
   		
   		if($_FILES['image']['name'] != '') {
	        $config['upload_path'] = './images/'.'webs';
			$config['allowed_types'] = 'gif|jpg|png|swf';
			$config['max_size']	= '5000';
			$config['max_width']  = '11024';
			$config['max_height']  = '11768';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('image')) {
				$error = $this->upload->display_errors('<div class="error">','</div>');
			}
			else {
				$upload_data = $this->upload->data();
				$data['image'] = $upload_data['file_name'];
				
				//resize image
				$this->load->library('iht_common');
				$error = $this->iht_common->create_thumb($config['upload_path'].'/'.$upload_data['file_name'], 140, 140, false);
			}
        }
        else {
        	unset($data['image']);
        }
	        
         if(!$error) {
         	$this->ci_websmodel->modify($data['id'], $data);

         	redirect('webs/', 'location');
         }
      	}
      }
         $idField = $this->uri->segment(3);

         $this->load->model('ci_websmodel');
         $data = $this->ci_websmodel->retrieve_by_pkey($idField);
         $data['pos_adv'] = $this->config->item('pos_adv');
         $data['action'] = 'modify';
         $data['title']       = 'Edit a webs';
		
		$this->_display('/ci_webs/ci_websdetails', $data);
   }


   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
   		$this->user_group_model->can_access('Delete Webs', null, null);
      $idField = $this->uri->segment(3);

      $this->load->model('ci_websmodel');
      $the_results = $this->ci_websmodel->delete_by_pkey($idField);

      $this->load->helper('url');
      redirect('webs/', 'location');

   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['webs_title']		= '';
		$data['image']		= '';
		$data['description']		= '';
		$data['webs_url']		= '';
		$data['webs_width']		= '';
		$data['webs_height']		= '';
		$data['site_id']		= '';
		$data['create_user']		= '';
		$data['start_date']		= '';
		$data['end_date']		= '';
		$data['create_date']		= '';
		$data['status_flg']		= '';
		$data['order']		= '';
		$data['position']		= '';

      return $data;

   }

   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['webs_title']		= $this->input->post('webs_title', TRUE);
		$data['description']	= $this->input->post('description', TRUE);
		$data['webs_url']		= $this->input->post('webs_url', TRUE);
		$data['webs_width']		= (int)$this->input->post('webs_width', TRUE);
		$data['webs_height']		= (int)$this->input->post('webs_height', TRUE);
		$data['position']		= $this->input->post('position', TRUE);
		$data['site_id']		= $this->session->userdata('site_id');
		$data['image']			= $this->input->post('image', TRUE);
		$data['create_user']	= $this->session->userdata('userid');
		$data['start_date']		= time();
		$data['end_date']		= time();
		$data['create_date']	= time();
		$data['status_flg']		= (int)$this->input->post('status_flg', TRUE);

      return $data;

   }
   
    // private function, format data to template
	function _display($page_req, $data = array()) {
		
		$data['content'] = $this->load->view($page_req, $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);
	}

}
?>
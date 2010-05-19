<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Languages.php
 *
 * DESCRIPTION   : Languages module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             Languages
 * @subpackage          ci_languages component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Languages extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Languages() {
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
   	$this->user_group_model->can_access('View list Languages', null, null);
      // The default action is the showall action
      $this->browse();
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all ci_languages data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
   	
      $start = $this->uri->segment(4,0);
      $limit_per_page = 20;
      $site_id = $this->session->userdata('site_id');
	
      $filter = "";
      $this->load->model('ci_languagesmodel');                  // Instantiate the model
      $the_results['ci_languages_list'] = $this->ci_languagesmodel->findByFilter($filter, $start, $limit_per_page);  // Send the retrievelist msg
    
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->ci_languagesmodel->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'languages/browse/';

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = 'Danh sách ngôn ngữ';
   		
      $this->_display('/ci_languages/ci_languagesgrid', $the_results);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_languages entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
		$this->user_group_model->can_access('Add new Languages', null, null);
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
		$this->form_validation->set_rules('name','Tên ngôn ngữ', 'required|xss_clean');
		$this->form_validation->set_rules('code','Mã ngôn ngữ', 'required|xss_clean');
		$this->form_validation->set_rules('image','Ảnh lá cờ', 'xss_clean');

      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
         
      	// ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('ci_languagesmodel');
         $data = $this->_get_form_values();
         
         if($_FILES['image']['name'] != '') {
	        $config['upload_path'] = './images/'.'languages';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '324';
			$config['max_height']  = '368';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('image')) {
				$error = $this->upload->display_errors('<div class="error">','</div>');
			}
			else {
				$upload_data = $this->upload->data();
				$data['image'] = $upload_data['file_name'];
			}
        }
        else {
        	unset($data['image']);
        }
	        
         if(!$error) {
         	$this->ci_languagesmodel->add($data);
         	$this->session->set_flashdata('msg', $this->lang->line('ua_languages_added'));
         	redirect('languages/add', 'location');	
         }
      	}
      }
      
         $data = $this->_clear_form();
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
         $data['title']       = 'Thêm mới ngôn ngữ';
         $data['action']       = 'add';
         $data['error']       = $error;

		$data['content'] = $this->load->view('/ci_languages/ci_languagesdetails', $data, TRUE);
		
		$this->_display('/ci_languages/ci_languagesdetails', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
	$this->user_group_model->can_access('Edit Languages', null, null);
      $this->load->helper('url');
      $data = array();
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
		$this->form_validation->set_rules('name','Tên ngôn ngữ', 'required|xss_clean');
		$this->form_validation->set_rules('code','Mã ngôn ngữ', 'required|xss_clean');
		$this->form_validation->set_rules('image','Ảnh lá cờ', 'xss_clean');
      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
      	
         // ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('ci_languagesmodel');

         $data = $this->_get_form_values();
   		 $data['id']		= $this->input->post('id', TRUE);
   		
   		if($_FILES['image']['name'] != '') {
	        $config['upload_path'] = './images/'.'languages';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '324';
			$config['max_height']  = '368';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('image')) {
				$error = $this->upload->display_errors('<div class="error">','</div>');
			}
			else {
				$upload_data = $this->upload->data();
				$data['image'] = $upload_data['file_name'];
			}
        }
        else {
        	unset($data['image']);
        }
	        
         if(!$error) {
         	$this->ci_languagesmodel->modify($data['id'], $data);

         	redirect('languages/', 'location');
         }
      	}
      }
 
         $idField = isset($data['id']) ? $data['id'] : $this->uri->segment(3);

         $this->load->model('ci_languagesmodel');
         $data = $this->ci_languagesmodel->retrieve_by_pkey($idField);
         $data['action'] = 'modify/'.$data['id'];
         $data['title']  = 'Chỉnh sửa ngôn ngữ';
         $data['error']       = $error;
		
		$this->_display('/ci_languages/ci_languagesdetails', $data);
   }


   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
   		$this->user_group_model->can_access('Delete Languages', null, null);
      $idField = $this->uri->segment(4);

      $this->load->model('ci_languagesmodel');
      $site_id = $this->session->userdata('site_id');
      $the_results = $this->ci_languagesmodel->delete_by_pkey($idField, $site_id);

      $this->load->helper('url');
      redirect('languages/', 'location');

   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['name']		= '';
		$data['image']		= '';
		$data['code']		= '';
		$data['create_user']		= '';
		$data['create_date']		= '';
		$data['status_flg']		= '';
		$data['ordering']		= '';

      return $data;

   }

   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['name']		= $this->input->post('name', TRUE);
		$data['ordering']		= $this->input->post('ordering', TRUE);
		$data['code']	= $this->input->post('code', TRUE);
		$data['image']			= $this->input->post('image', TRUE);
		$data['create_user']	= $this->session->userdata('userid');
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
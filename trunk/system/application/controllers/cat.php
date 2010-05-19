<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : News.php
 *
 * DESCRIPTION   : News module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             Cat
 * @subpackage          ci_news component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Cat extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Cat() {
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
   	$this->user_group_model->can_access('View list News', null, null);
      // The default action is the showall action
      $this->browse();
   }  

   /**
   * @access      public
   * @return      none
   */

   function sort() {
		$aryCatOrder = $this->input->post('cat_order');
		$aryCatId = $this->input->post('cat_id');
		$this->load->model('nny_catmodel');
		
		$affectedRows = $this->nny_catmodel->sortCat($aryCatOrder, $aryCatId);
		
		redirect('cat', 'location');
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all ci_news data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
   	
      $start = $this->uri->segment(3,0);
      $limit_per_page = 20;
//      $catId = $this->uri->segment(3,0);
	
      $this->load->model('nny_catmodel');                  // Instantiate the model
      
		//list all catergories
		$aryNewsTypesList = array();
		$this->nny_catmodel->getCategoryTree($aryNewsTypesList);
		$the_results['aryNewsTypesList'] = $aryNewsTypesList;
    
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->nny_catmodel->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'cat/browse/';

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = 'Danh sách tin';
   		
      $this->_display('/ci_news/cat_grid', $the_results);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_news entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
		$this->user_group_model->can_access('Add new News', null, null);

      $submit = $this->input->post('Submit');
      $this->load->model('nny_catmodel');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	$this->_validate_form();
      	
      	if($this->form_validation->run() == TRUE) {

         
         $data = $this->_get_form_values();
         
         $this->nny_catmodel->createCat($data);

         redirect('cat/add', 'location');
      	}
      }
      
      $data['aryCatInfo'] = $this->_clear_form();

      $parent_id = $this->uri->segment(3,0);
      if($parent_id) $data['aryCatInfo']['parent_id'] = $parent_id;
         
         $aryCatList = array();
		$this->nny_catmodel->getCategoryTree($aryCatList);
		//print_r($aryCatList);
		//exit;
		$data['aryCatList'] = $aryCatList;
				
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
         $data['title']       = 'Tạo danh mục tin';
         $data['action']       = 'add';

		$this->_display('/ci_news/nny_catdetails', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
	$this->user_group_model->can_access('Edit News', null, null);
      $submit = $this->input->post('Submit');
      $this->load->model('nny_catmodel');
      $catId = $this->uri->segment(3,0);

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	$this->_validate_form();    	
      	if($this->form_validation->run() == TRUE) {    
         $data = $this->_get_form_values();
         
         $this->nny_catmodel->editCat($data);

         redirect('cat', 'location');
      	}
      }
      
         $data = $this->_clear_form();
         
         $aryCatList = array();
		$this->nny_catmodel->getCategoryTree($aryCatList);
		$aryCatInfo = $this->nny_catmodel->getCatInfoBytId($catId);
		//print_r($aryCatList);
		//exit;
		$data['aryCatList'] = $aryCatList;
		$data['aryCatInfo'] = $aryCatInfo;
				
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
         $data['title']       = 'Sửa danh mục tin';
         $data['action']       = 'modify';

		$this->_display('/ci_news/nny_catdetails', $data);
   }


   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
	function delete() {
		$this->user_group_model->can_access('Delete News', null, null);
		$catid = $this->uri->segment(3);
		$this->load->model('nny_catmodel');
		$this->nny_catmodel->deleteCat($catid);
			
		redirect('cat', 'location');
	}

   function _clear_form() {

		$data['cat_id']		= '';
		$data['parent_id']		= '';
		$data['cat_order']		= '';
		$data['create_date']		= '';
		$data['last_modefied']		= '';
		$data['cat_status']		= '';
		$data['cat_image']		= '';
		$data['cat_name']		= '';
		$data['cat_des']		= '';
		$data['lang_id']		= '';
      
		return $data;

   }
   
   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['cat_id']		= 	$this->input->post('cat_id', TRUE);
		$data['parent_id']		= $this->input->post('parent_id', TRUE);
		$data['cat_order']		= $this->input->post('cat_order', TRUE);
		$data['create_date']	= $this->input->post('create_date', TRUE);
		$data['last_modefied']	= $this->input->post('last_modefied', TRUE);
		$data['cat_status']		= $this->input->post('cat_status', TRUE);
		$data['cat_image']		= $this->input->post('cat_image', TRUE);
		$data['cat_name']		= $this->input->post('cat_name', TRUE);
		$data['cat_des']		= $this->input->post('cat_des', TRUE);
		$data['lang_id']		= $this->input->post('lang_id', TRUE);

      return $data;

   }
   
     function _validate_form() {

   	//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
      	$this->form_validation->set_rules('cat_id','Cat_id', 'xss_clean');
		$this->form_validation->set_rules('parent_id','Parent_id', 'xss_clean');
		$this->form_validation->set_rules('cat_order','Cat_order', 'xss_clean');
		$this->form_validation->set_rules('create_date','Create_date', 'xss_clean');
		$this->form_validation->set_rules('last_modefied','Last_modefied', 'xss_clean');
		$this->form_validation->set_rules('cat_status','Cat_status', 'xss_clean');
		$this->form_validation->set_rules('cat_image','Cat_image', 'xss_clean');
		$this->form_validation->set_rules('cat_name','Cat_name', 'xss_clean');
		$this->form_validation->set_rules('cat_des','Cat_des', 'xss_clean');
		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
   }
   
    // private function, format data to template
	function _display($page_req, $data = array()) {
		
		$data['content'] = $this->load->view($page_req, $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);
	}

}
?>
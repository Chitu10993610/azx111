<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : News.php
 *
 * DESCRIPTION   : News module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             Menu
 * @subpackage          menu component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Menu extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Menu() {
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
   	
      // The default action is the showall action
      $this->browse();
   }  

   /**
   * @access      public
   * @return      none
   */

   function sort() {
		$aryMenuOrder = $this->input->post('ordering');
		$aryMenuId = $this->input->post('id');
		$this->load->model('menu_model');
		
		$affectedRows = $this->menu_model->sortMenu($aryMenuOrder, $aryMenuId);
		
		redirect('menu', 'lomenuion');
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all menu data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
   	$this->user_group_model->can_access(VIEW_LIST_MENU, null, null);
      $start = $this->uri->segment(3,0);
      $limit_per_page = 20;
//      $menuId = $this->uri->segment(3,0);
	
      $this->load->model('menu_model');                  // Instantiate the model
      
		//list all menuergories
		$aryNewsTypesList = array();
		$this->menu_model->getMenuegoryTree($aryNewsTypesList);
		$the_results['aryNewsTypesList'] = $aryNewsTypesList;
    
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->menu_model->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'menu/browse/';

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = 'Danh sách tin';
   		
      $this->_display('/menu/menu_grid', $the_results);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new menu entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
		$this->user_group_model->can_access(ADD_MENU, null, null);

      $submit = $this->input->post('Submit');
      $this->load->model('menu_model');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	$this->_validate_form();
      	
      	if($this->form_validation->run() == TRUE) {

         
         $data = $this->_get_form_values();
         
         $this->menu_model->createMenu($data);

         redirect('menu/add', 'lomenuion');
      	}
      }
      
      $data['aryMenuInfo'] = $this->_clear_form();

      $parent_id = $this->uri->segment(3,0);
      if($parent_id) $data['aryMenuInfo']['parent_id'] = $parent_id;
         
         $aryMenuList = array();
		$this->menu_model->getMenuegoryTree($aryMenuList);
		//print_r($aryMenuList);
		//exit;
		$data['aryMenuList'] = $aryMenuList;
				
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
         $data['title']       = 'Tạo danh mục tin';
         $data['action']       = 'add';

		$this->_display('/menu/menu_details', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
	$this->user_group_model->can_access(EDIT_MENU, null, null);
      $submit = $this->input->post('Submit');
      $this->load->model('menu_model');
      $menuId = $this->uri->segment(3,0);

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	$this->_validate_form();
      	
      	if($this->form_validation->run() == TRUE) {

         
         $data = $this->_get_form_values();
         
         $this->menu_model->editMenu($data);

         redirect('menu', 'lomenuion');
      	}
      }
      
         $data = $this->_clear_form();
         
         $aryMenuList = array();
		$this->menu_model->getMenuegoryTree($aryMenuList);
		$aryMenuInfo = $this->menu_model->getMenuInfoBytId($menuId);
		//print_r($aryMenuList);
		//exit;
		$data['aryMenuList'] = $aryMenuList;
		$data['aryMenuInfo'] = $aryMenuInfo;
				
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
         $data['title']       = 'Thêm / Sửa menu';
         $data['action']       = 'modify';

		$this->_display('/menu/menu_details', $data);
   }
   
   // //////////////////////////////////////////////////////////////////////////
   // Function: trans()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function trans() {
	$this->user_group_model->can_access(EDIT_MENU, null, null);

	$submit = $this->input->post('Submit');
      $this->load->model('menu_model');
      $menuId = (int)$this->uri->segment(3, $this->input->post('id'));

      if ( $submit != false ) {
      	 $translated = $this->input->post('translated');
         $aryMenuInfo = $this->_get_form_values();
         $this->menu_model->trans($aryMenuInfo, $translated);
         redirect('menu', 'location');
         exit;
      }

      	$data = $this->_clear_form();
		
		$lang_id = $this->input->post('lang_id');
		$lang_id = $lang_id ? $lang_id : 'en';
		
		$data['aryMenuInfo'] = $this->menu_model->getMenuInfoBytId($menuId, $lang_id);
		
		if(sizeof($data['aryMenuInfo'])) {
			$data['translate']       = 1;
		}
		else {
			$data['translate']       = 0;
			$data['aryMenuInfo']['id'] = $menuId;
		}
         
		$this->load->library('user_lib');
		$data['strLang'] = $this->user_lib->showListLang($lang_id);
		$data['title']       = 'Dịch nội dung sang => ';
		$data['trans']       = 't';
		$data['action'] .= 'trans/'.$menuId;

		$this->_display('/menu/menu_details', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
	function delete() {
		$this->user_group_model->can_access(DELETE_MENU, null, null);
		$menuid = $this->uri->segment(3);
		$this->load->model('menu_model');
		$this->menu_model->deleteMenu($menuid);
			
		redirect('menu', 'lomenuion');
	}

   function _clear_form() {

		$data['id']		= '';
		$data['parent_id']		= '';
		$data['ordering']		= '';
		$data['create_date']		= '';
		$data['last_modefied']		= '';
		$data['status']		= '';
		$data['url']		= '';
		$data['menu_image']		= '';
		$data['name']		= '';
		$data['menu_des']		= '';
		$data['lang_id']		= '';
      
		return $data;

   }
   
   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['id']		= 	$this->input->post('id', TRUE);
		$data['parent_id']		= $this->input->post('parent_id', TRUE);
		$data['ordering']		= $this->input->post('ordering', TRUE);
		$data['create_date']	= $this->input->post('create_date', TRUE);
		$data['last_modefied']	= $this->input->post('last_modefied', TRUE);
		$data['status']		= $this->input->post('status', TRUE);
		$data['url']		= $this->input->post('url', TRUE);
		$data['menu_image']		= $this->input->post('menu_image', TRUE);
		$data['name']		= $this->input->post('name', TRUE);
		$data['menu_des']		= $this->input->post('menu_des', TRUE);
		$data['lang_id']		= $this->input->post('lang_id', TRUE);

      return $data;

   }
   
     function _validate_form() {

   	//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
      	$this->form_validation->set_rules('id','Menu_id', 'xss_clean');
		$this->form_validation->set_rules('parent_id','Parent_id', 'xss_clean');
		$this->form_validation->set_rules('ordering','Menu_order', 'xss_clean');
		$this->form_validation->set_rules('create_date','Create_date', 'xss_clean');
		$this->form_validation->set_rules('last_modefied','Last_modefied', 'xss_clean');
		$this->form_validation->set_rules('status','Menu_status', 'xss_clean');
		$this->form_validation->set_rules('url','URl', 'xss_clean');
		$this->form_validation->set_rules('menu_image','Menu_image', 'xss_clean');
		$this->form_validation->set_rules('name','Menu_name', 'xss_clean');
		$this->form_validation->set_rules('menu_des','Menu_des', 'xss_clean');
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
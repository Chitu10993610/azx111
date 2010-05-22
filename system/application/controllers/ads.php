<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Ads.php
 *
 * DESCRIPTION   : Ads module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             Ads
 * @subpackage          ci_ads component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Ads extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Ads() {
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

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all ci_ads data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
   		$this->user_group_model->can_access(VIEW_LIST_PROMO, null, null);
      $start = $this->uri->segment(3,0);
      $limit_per_page = 20;
      $site_id = $this->session->userdata('site_id');
	
      $filter = "WHERE site_id = '$site_id'";
      $this->load->model('ci_adsmodel');                  // Instantiate the model
      $the_results['ci_ads_list'] = $this->ci_adsmodel->findByFilter($filter, $start, $limit_per_page);  // Send the retrievelist msg
    
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->ci_adsmodel->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 3;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'ads/browse/';

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = 'Ads List';
   		
      $this->_display('/ci_ads/ci_adsgrid', $the_results);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_ads entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
		$this->user_group_model->can_access(ADD_PROMO, null, null);
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
		$this->form_validation->set_rules('ads_title','Title', 'required|xss_clean');
		$this->form_validation->set_rules('description','Description', 'xss_clean');
		$this->form_validation->set_rules('ads_url','Ads_url', 'xss_clean');

      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
         
      	// ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('ci_adsmodel');
         $data = $this->_get_form_values();

         if($_FILES['image']['name'] != '') {
	        $config['upload_path'] = './images/'.'adv';
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
			}
        }
        else {
        	unset($data['image']);
        }
	        
         if(!$error) {
         	$this->ci_adsmodel->add($data);
         	$this->session->set_flashdata('msg', $this->lang->line('ua_ads_added'));
         	redirect('ads/', 'location');	
         }
      	}
      }
      
         $data = $this->_clear_form();
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
		$data['pos_adv'] = $this->config->item('pos_adv');
         $data['title']       = 'Add a ads';
         $data['action']       = 'add';
         $data['error']       = $error;
		
         $this->_prepare_form($data);
		$data['content'] = $this->load->view('/ci_ads/ci_adsdetails', $data, TRUE);
		
		$this->_display('/ci_ads/ci_adsdetails', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
	$this->user_group_model->can_access(EDIT_PROMO, null, null);
      $this->load->helper('url');
      $error = '';

      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
      	$this->form_validation->set_rules('id','Id', 'xss_clean');
		$this->form_validation->set_rules('ads_title','Title', 'required|xss_clean');
		$this->form_validation->set_rules('description','Description', 'xss_clean');
		$this->form_validation->set_rules('ads_url','Ads url', 'xss_clean');
      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
      	
         $this->load->model('ci_adsmodel');

         $data = $this->_get_form_values();
//	      print_r($data);
//         exit;
         
   		$data['id']		= $this->input->post('id', TRUE);
   		
   		if($_FILES['image']['name'] != '') {
	        $config['upload_path'] = './images/'.'adv';
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
			}
        }
        else {
        	unset($data['image']);
        }
	        
         if(!$error) {
         	$this->ci_adsmodel->modify($data['id'], $data);

         	redirect('ads/', 'location');
         }
      	}
      }

      
      $idField = $this->uri->segment(3);

         $this->load->model('ci_adsmodel');
         $data = $this->ci_adsmodel->retrieve_by_pkey($idField);
         $this->_prepare_form($data);
         $data['pos_adv'] = $this->config->item('pos_adv');
         $data['action'] = 'modify';
         $data['title']       = 'Edit a ads';
		
		$this->_display('/ci_ads/ci_adsdetails', $data);
   }


   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
   		$this->user_group_model->can_access(DELETE_PROMO, null, null);
      $idField = $this->uri->segment(3);

      $this->load->model('ci_adsmodel');
      $the_results = $this->ci_adsmodel->delete_by_pkey($idField);

      $this->load->helper('url');
      redirect('ads/', 'location');

   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['ads_title']		= '';
		$data['image']		= '';
		$data['description']		= '';
		$data['ads_url']		= '';
		$data['ads_width']		= '';
		$data['ads_height']		= '';
		$data['site_id']		= '';
		$data['create_user']		= '';
		$data['start_date']		= '';
		$data['end_date']		= '';
		$data['create_date']		= '';
		$data['status_flg']		= '';
		$data['ads_order']		= '';
		$data['position']		= '';

      return $data;

   }

   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['ads_title']		= $this->input->post('ads_title', TRUE);
		$data['description']	= $this->input->post('description', TRUE);
		$data['ads_url']		= $this->input->post('ads_url', TRUE);
		$data['ads_order']		= (int)$this->input->post('ads_order', TRUE);
		$data['ads_width']		= (int)$this->input->post('ads_width', TRUE);
		$data['ads_height']		= (int)$this->input->post('ads_height', TRUE);
		$data['position']		= $this->input->post('position', TRUE);
		$data['site_id']		= $this->session->userdata('site_id');
		$data['image']			= $this->input->post('image', TRUE);
		$data['create_user']	= $this->session->userdata('userid');
		$data['start_date']		= time();
		$data['end_date']		= time();
		$data['create_date']	= time();
		$data['status_flg']		= (int)$this->input->post('status_flg', TRUE);
		
		$aryView_rule		= $this->input->post('view_rule', TRUE);
		$data['view_rule'] = is_array($aryView_rule) ? implode($aryView_rule) : '';

      return $data;

   }
   
   	/**
	* prepare form
	*/
	function _prepare_form (&$data) {
		
		$this->load->model('nny_news_catmodel');
		$aryCatList = array();
		$this->nny_news_catmodel->getCategoryTree($aryCatList);
		$data['aryCatList'] = $aryCatList;
		$this->load->model('nny_catmodel');
		$aryCatList1 = array();
		$this->nny_catmodel->getCategoryTree($aryCatList1);
		$data['aryCatList1'] = $aryCatList1;
	}

   
    // private function, format data to template
	function _display($page_req, $data = array()) {
		
		$data['content'] = $this->load->view($page_req, $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);
	}

}
?>
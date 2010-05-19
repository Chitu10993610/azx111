<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Config.php
 *
 * DESCRIPTION   : Config module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-02-03 08:45 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             Config
 * @subpackage          Config component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Config extends Controller {

	public $site_name = '';
	public $site_id = 0;
   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Config() {
      	parent::Controller();
      	/*$this->site_name = realpath(dirname(__FILE__));
		$this->site_name = pathinfo($this->site_name, PATHINFO_BASENAME).'/';
		$this->site_id = $this->session->userdata('site_id');*/
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
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
   	
   	$this->user_group_model->can_access('Config site', null, null, $this->site_name);
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
	//      	$this->form_validation->set_rules('id','Id', 'xss_clean');
			$this->form_validation->set_rules('guide_name','Guide name', 'xss_clean');
			$this->form_validation->set_rules('contact_phone','Contact phone', 'xss_clean');
			$this->form_validation->set_rules('contact_mail','Contact mail', 'xss_clean|valid_email');
			$this->form_validation->set_rules('guide_image','Guide image', 'xss_clean');
			$this->form_validation->set_rules('guide_center_address','Guide center address', 'xss_clean');
			$this->form_validation->set_rules('street_address','Street address', 'xss_clean');
			$this->form_validation->set_rules('city','City', 'xss_clean');
			$this->form_validation->set_rules('state','State', 'xss_clean');
			$this->form_validation->set_rules('zip','Zip', 'xss_clean');
	//		$this->form_validation->set_rules('create_user','Create_user', 'xss_clean');
	
	      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
	      	if($this->form_validation->run() == TRUE) {
	      	
	         $this->load->model('hs_configmodel');
			
	        $data = $this->_get_form_values();
	
	        
	        if($_FILES['guide_image']['name'] != '') {
		        $config['upload_path'] = './images/'.$this->site_name.'config';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '5000';
				$config['max_width']  = '11024';
				$config['max_height']  = '11768';
				
				$this->load->library('upload', $config);
			
				if (!$this->upload->do_upload('guide_image')) {
					$error = $this->upload->display_errors('<div class="error">','</div>');
				}
				else
				{
					$upload_data = $this->upload->data();
					$data['guide_image'] = $upload_data['file_name'];
				}
	        }
	        else {
	        	unset($data['guide_image']);
	        }
			
	        $this->hs_configmodel->modify($data['id'], $data);
	
	         if(!$error) redirect($this->site_name.'cau-hinh', 'location');
	      	}
      }
      //else {
         // We have to show the user the input form

//        $idField = $this->uri->segment(3);

         $this->load->model('hs_configmodel');
         $this->load->model('ci_neighborhoodmodel');
         $this->load->model('ci_transportation_routermodel');
         $this->load->model('ci_amenitiesmodel');
         $this->load->model('ci_culturemodel');
         //$data = $this->hs_configmodel->retrieve_by_pkey($idField);
         
         if(!$submit) {
         	$data = $this->hs_configmodel->retrieve_by_pkey($this->site_id);
         }
         else $data = $this->_get_form_values();
         
		$data['title'] = 'Site Configuration';
		$data['error'] = $error;
				
		//get sitename
		$data['site_name'] = $this->site_name;
		
		$data['contact_info'] = $this->load->view('site_config/contact_info_form', $data, true);
		$data['guide_info'] = $this->load->view('site_config/guide_info_form', $data, true);
		$data['service_info'] = $this->load->view('site_config/service_form', $data, true);
		

		
	
		
		$data['content'] = $this->load->view('site_config/configuration', $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);
   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['guide_name']		= '';
		$data['contact_phone']		= '';
		$data['contact_mail']		= '';
		$data['information']		= '';
		$data['service']		= '';
		$data['fax']		= '';
		$data['guide_image']		= '';
		$data['guide_center_address']		= '';
		$data['center_name']		= '';
		$data['street_address']		= '';
		$data['city']		= '';
		$data['state']		= '';
		$data['zip']		= '';
		$data['create_user']		= '';

      return $data;

   }

   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['guide_name']		= $this->input->post('guide_name', TRUE);
		$data['contact_phone']		= $this->input->post('contact_phone', TRUE);
		$data['contact_mail']		= $this->input->post('contact_mail', TRUE);
		$data['information']		= $this->input->post('information', TRUE);
		$data['service']		= $this->input->post('service', TRUE);
		$data['fax']		= $this->input->post('fax', TRUE);
		$data['guide_center_address']		= $this->input->post('guide_center_address', TRUE);
		$data['center_name']		= $this->input->post('center_name', TRUE);
		$data['street_address']		= $this->input->post('street_address', TRUE);
		$data['city']		= $this->input->post('city', TRUE);
		$data['state']		= $this->input->post('state', TRUE);
		$data['zip']		= $this->input->post('zip', TRUE);
		$data['create_user']	= $this->session->userdata('userid');
		$data['site_id']	= $this->site_id;

      return $data;

   }

}
?>
<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : properties.php
 *
 * DESCRIPTION   : properties module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-02-03 09:52 PM   - Pradesh Chanderpaul     - Created
 *
 * @package             properties
 * @subpackage          properties component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Properties extends Controller {
	
	public $site_name = '';

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Properties() {
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

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all properties data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
														
   		$this->user_group_model->can_access(VIEW_LIST_ADS, null, null);

      $this->load->model('ci_propertiesmodel');                  // Instantiate the model
      $catid = (int)$this->uri->segment(3,0);
      $start = $this->uri->segment(4,0);
      $limit_per_page = 20;
      $filter = array();

      $user_id = $this->session->userdata('userid');
 
      if($catid) $filter['property_type'] = $catid;
      
	//view my news
	if(!access(VIEW_ALL_ADS)) $filter['create_user'] = $_SESSION['userdata']['userid'];
      
      $the_results['ci_properties_list'] = $this->ci_propertiesmodel->findByFilter($filter, $start, $limit_per_page);  // Send the retrievelist msg
     
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->ci_propertiesmodel->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'properties/browse/'.$catid;

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = "Danh sách tin";
      $the_results['start'] = $start;
      $the_results['site_name'] = "Danh sách tin";
		
		// Display in Template
		$this->_display('/properties/properties', $the_results);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_properties entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
   		
   	$this->user_group_model->can_access(ADD_ADS, null, null);
//   	$this->load->library('firephp');

		$data = array();
		

      $this->load->helper('url');
      $error = '';

      $submit = $this->input->post('Submit');      
     
      $submited = $this->input->post('submited');
      if ( $submit != false || $submited) {
	      	$this->load->library('form_validation');
	      	
	      	//field validates
			$this->_validate_form();
	      	
	      	$data = $this->_get_form_values();
	      	$data['create_user']				=  $_SESSION['userdata']['userid'];
         	$data['create_name']				=  $_SESSION['userdata']['username'];
         	$data['create_date']				=  time();
         	$data['update_date']				=  time();
		
			$data['attach_files']		= array();
			$ary_userfile_title		= array();
			
			//set default image
			if($this->input->post('house_image')) {
				$data['attach_files'][] = $this->input->post('house_image');
				$ary_userfile_title[] = '';
			}
			
			$userfile_title = $this->input->post('userfile_title', TRUE);
		
			//number file is attached
			$pattach = $this->input->post('pattach', TRUE);
			$flattach = $this->input->post('flattach', TRUE);
		    if($this->form_validation->run() == TRUE) {
		
		      	$this->load->model('ci_propertiesmodel');
	
				$config['upload_path'] = './images/'.$this->site_name.'property';
		        $config['allowed_types'] = 'gif|jpg|png';
				$config['max_width']  = '11024';
				$config['max_height']  = '11768';
				$config['max_size']	= '10000';
				$this->load->library('upload', $config);
				
				//upload property files are attached
				foreach ($pattach as $keyFile) {
					if(isset($_FILES['userfile'.$keyFile]['name']) && $_FILES['userfile'.$keyFile]['name'] != '') {
						if (!$this->upload->do_upload('userfile'.$keyFile)) {
							$error = $this->upload->display_errors('<div class="error">','</div>');
						}
						else {
							$upload_data = $this->upload->data();
							$data['attach_files'][] = $upload_data['file_name'];
							$ary_userfile_title[] = $userfile_title[$keyFile];
							
							//create thumbnail
							$img_src = './images/property/'.$upload_data['file_name'];
							
							$this->load->library('image_lib');
							$this->_create_thumb($img_src, 680, '', false);
							$this->image_lib->clear();
							
							//create small image
							$this->_create_thumb($img_src, 180);
							$this->image_lib->clear();
							
							$this->_create_thumb($img_src, 60, '_small');
						}
			        }
				}
				
				$this->load->library('front_lib');
			
				$data['attach_files'] = serialize(array('file'=>$data['attach_files'], 'title'=>$ary_userfile_title));
				$data['create_user']	= $this->session->userdata('userid');
				$data['site_id']	= $this->session->userdata('site_id');
				
				//convert name to name_sef
				$data['name_sef'] = $this->front_lib->cv2sef($data['name']).'.html';
				$this->ci_propertiesmodel->add($data);
				
				// $this->load->helper('url');
				if(empty($error)) redirect($this->site_name.'properties/', 'location');
	      	}
      }
      else $data['property_type'] = $this->uri->segment(3, 0);
      
		if(!$submit && !$submited) $data = $this->_clear_form();
		
		$data['action']       = 'add';
		$data['title'] = 'Add Property';
		
		$this->_prepare_form($data);
		$data['error'] = $error;

		$this->_display('/properties/add_property_form', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
   	$this->user_group_model->can_access(EDIT_ADS, null, null);

      $this->load->helper('url');
      $error = '';
      // ///////////////////////////////////////////////////////////////////////
      // How are we being invoked
      // ///////////////////////////////////////////////////////////////////////
      $submit = $this->input->post('Submit');
      $submited = $this->input->post('submited');

      if ( $submit != false || $submited) {
      	$this->load->library('form_validation');
      	
      	//field validates
		$this->_validate_form();
      	
      	if($this->form_validation->run() == TRUE) {
      	
	         // ////////////////////////////////////////////////////////////////////
	         // User is submitting data
	         // Store the values from the form onto the db
	         // ////////////////////////////////////////////////////////////////////
	         $this->load->model('ci_propertiesmodel');
	         
	         $data = $this->_get_form_values();
			$data['update_user']				=  $_SESSION['userdata']['userid'];
			$data['update_name']				=  $_SESSION['userdata']['username'];
			$data['update_date']				=  time();
         	
	         $data['id']		= $this->input->post('id', TRUE);
	         
	        $data['attach_files']		= array();
   			$ary_userfile_title		= array();
	        
	        //set default image
			if($this->input->post('house_image')) {
				$data['attach_files'][] = $this->input->post('house_image');
				$ary_userfile_title[] = '';
			}
			
//			$data['floorplan_file']		= array();
			$userfile_title = $this->input->post('userfile_title', TRUE);
			
			//number file is attached
			$pattach		= $this->input->post('pattach', TRUE);
			$flattach = $this->input->post('flattach', TRUE);
			
			//set attach file = older file
			if(is_array($this->input->post('older_file', TRUE))) {
				$attach_files = $this->input->post('older_file', TRUE);
				
				//get old file and title
				$older_file_title = $this->input->post('older_file_title', TRUE);
				foreach ($attach_files as $key=>$file) {
					$ary_userfile_title[] = $older_file_title[$key];
					$data['attach_files'][] = $file;
				}
			} else $attach_files = array();
			
			$config['upload_path'] = './images/'.$this->site_name.'property';
	        $config['allowed_types'] = 'gif|jpg|png';
			$config['max_width']  = '11024';
			$config['max_height']  = '11768';
			$config['max_size']	= '10000';
			$this->load->library('upload', $config);
			
			//process del older file
			$origin_older_file = $this->input->post('origin_older_file', TRUE);
			if(is_array($origin_older_file)) {
				$this->_del_old_file($origin_older_file, $attach_files, $config['upload_path']);
			}
			
//			$aryfloorplan_older_file = $this->input->post('floorplan_older_file', TRUE);
//			if(is_array($aryfloorplan_older_file)) $data['floorplan_file'] = $this->input->post('floorplan_older_file', TRUE);
			
			//upload property files are attached
			foreach ($pattach as $keyFile) {
				if(isset($_FILES['userfile'.$keyFile]['name']) && $_FILES['userfile'.$keyFile]['name'] != '') {
					if (!$this->upload->do_upload('userfile'.$keyFile)) {
						$error = $this->upload->display_errors('<div class="error">','</div>');
					}
					else {
						$upload_data = $this->upload->data();
						$data['attach_files'][] = $upload_data['file_name'];
						$ary_userfile_title[] = $userfile_title[$keyFile];
						
						//create thumbnail
						$img_src = './images/property/'.$upload_data['file_name'];
						
						$this->load->library('image_lib');
						$this->_create_thumb($img_src, 680, '', false);
						$this->image_lib->clear();
						
						//create small image
						$this->_create_thumb($img_src, 180);
						$this->image_lib->clear();
						
						$this->_create_thumb($img_src, 80, '_small');
					}
		        }
			}
			
			$this->load->library('front_lib');
		
			$data['attach_files'] = serialize(array('file'=>$data['attach_files'], 'title'=>$ary_userfile_title));
			$data['create_user']	= $this->session->userdata('userid');
			
			//convert name to name_sef
			$data['name_sef'] = $this->front_lib->cv2sef($data['name']).'.html';
				
			$this->ci_propertiesmodel->modify($data['id'], $data);

         if(empty($error)) redirect($this->site_name.'properties/browse/'.$data['property_type'], 'location');
      	}
      }
      //else {
         // We have to show the user the input form
         $idField = $this->uri->segment(3);

         $this->load->model('ci_propertiesmodel');
         $data = $this->ci_propertiesmodel->retrieve_by_pkey($idField);
         
         $data['action'] = 'modify/'.$idField;
         $data['title'] = 'Edit Property';

         $this->_prepare_form($data);
		
		$data['error'] = $error;

		$this->_display('/properties/add_property_form', $data);


      //}
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
	      
      $idField = $this->uri->segment(3);
      $this->load->model('ci_propertiesmodel');
      
      //check exist and delete file
      $data = $this->ci_propertiesmodel->retrieve_by_pkey($idField);
      
     
      if(access(DELETE_ADS) || (access(DELETE_ADS_UNPUBLISH) && !$data['status'])) {
      	
      	 $user_id = access(VIEW_ALL_ADS) ? 0 : $this->session->userdata('userid');
	      $the_results = $this->ci_propertiesmodel->delete_by_pkey($idField, $user_id);
	      if($data['attach_files']) {
	      	$aryFile = unserialize($data['attach_files']);
	      	$aryFile = $aryFile['file'];
	      	
	      	//path to folder file 
	      	$path = './images/'.$this->site_name.'property';
	      	
	      	foreach ($aryFile as $fileDel) {
	      		$this->_del_file($fileDel, $path);
	      	}
	      }
	      
	      redirect($this->site_name.'/properties/browse/'.$data['property_type'], 'location');
	      exit;
      }
   	  
   	  redirect('user/auth_error'); 
   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['name']		= '';
		$data['address']		= '';
		$data['contact_name']		= '';
		$data['contact_phone']		= '';
		$data['contact_email']		= '';
		$data['infomation']		= '';
		$data['url']		= '';
		$data['hold']		= '';
		$data['type']		= '';
		$data['attach_files']		= '';
		$data['is_vip']		= '';
		$data['is_hot']		= '';
		$data['property_type']		= '';
		$data['price']		= '';
		$data['create_user']		= '';
		$data['start_date']		= '';
		$data['end_date']		= '';
		$data['available_date']		= '';
		$data['price_max']		= '';
		$data['site_id']		= '';
		$data['area']		= '';
		$data['district']		= '';
		$data['province']		= '';
		$data['page_type']		= '';
		$data['currency']		= '';
		$data['status']		= '';

      return $data;

   }

   function _get_form_values() {
		$data['name']		= $this->input->post('name', TRUE);
		$data['address']		= $this->input->post('address', TRUE);
		$data['contact_name']		= $this->input->post('contact_name', TRUE);
		$data['contact_phone']		= $this->input->post('contact_phone', TRUE);
		$data['contact_email']		= $this->input->post('contact_email', TRUE);
		$data['infomation']		= $this->input->post('infomation', TRUE);
		$data['url']		= $this->input->post('url', TRUE);
		$data['hold']		= $this->input->post('hold', TRUE);
		$data['attach_files']		= $this->input->post('attach_files', TRUE);
		$data['is_vip']		= (int)$this->input->post('is_vip', TRUE);
		$data['is_hot']		= (int)$this->input->post('is_hot', TRUE);
		$data['property_type']		= $this->uri->segment(3, $this->input->post('property_type', TRUE));
		$data['price']		=  		$this->input->post('price', TRUE);
//		exit($data['price']);
		$data['create_user']		= $this->input->post('create_user', TRUE);
		$data['start_date']		= time();
		$data['end_date']		= $this->input->post('end_date', TRUE);
		$data['available_date']		=  		strtotime($this->input->post('available_date', TRUE));
		$data['price_max']		= $this->input->post('price_max', TRUE);
		$data['district']		= (int)$this->input->post('district', TRUE);
		$data['area']		= (int)$this->input->post('area', TRUE);
		$data['province']		= (int)$this->input->post('province', TRUE);
		$data['page_type']		= $this->input->post('page_type', TRUE);
		$data['currency']		=  	$this->input->post('currency', TRUE);
		$data['status']		=  	$this->input->post('status', TRUE);
		
		$data['type']		= $this->input->post('type', TRUE);

         return $data;
   }
   
   //validate form
   function _validate_form() {
		  //trim|required|min_length[5]|max_length[12]|xss_clean
//      	$this->form_validation->set_rules('id','Id', 'xss_clean');
		$this->form_validation->set_rules('name','Tiêu đề tin', 'required|xss_clean');
		$this->form_validation->set_rules('address','Address', 'xss_clean');
		$this->form_validation->set_rules('province','Tỉnh/Thành phố', 'required|xss_clean');
		$this->form_validation->set_rules('contact_name','Contact_name', 'xss_clean');
		$this->form_validation->set_rules('contact_phone','Contact_phone', 'xss_clean');
		$this->form_validation->set_rules('contact_email','Contact email', 'valid_email|xss_clean');
		$this->form_validation->set_rules('url','Url', 'xss_clean');
		$this->form_validation->set_rules('hold','Hold', 'xss_clean');
		$this->form_validation->set_rules('type','Type', 'xss_clean');
		$this->form_validation->set_rules('attach_files','Attach_files', 'xss_clean');
		$this->form_validation->set_rules('is_vip','is_vip', 'xss_clean');
		$this->form_validation->set_rules('is_hot','is_hot', 'xss_clean');
		$this->form_validation->set_rules('property_type','Loại tin rao vặt', 'required|xss_clean');
		$this->form_validation->set_rules('price','Price', 'xss_clean');
		
		//new
		$this->form_validation->set_rules('district','Quận/Huyện', 'xss_clean');
		$this->form_validation->set_rules('area','Khu vực', 'xss_clean');
		$this->form_validation->set_rules('page_type','Page_type', 'xss_clean');
		//end
		
		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
   }
   
   //prepare form
   function _prepare_form (&$data) {
   	
         //process unserialize file
      $this->load->model('nny_catmodel');
       $aryCatList = array();
		$this->nny_catmodel->getCategoryTree($aryCatList);
		$data['aryCatList'] = $aryCatList;
         $data['propertyPriceOption'] = $this->config->item('price_range');

		// Retrieve the ci_users lookup values.
//		$this->load->model('ci_usersmodel');
//		$data['ci_userslist'] = $this->ci_usersmodel->findAll();

		//province
		$this->load->model('iht_province_model');
		$data['provinceOption'] = $this->iht_province_model->findAll();
		//$filter = 'where id_area =3';
		//$data['provinceOption']=$this->iht_province_model->findByFilter($filter);
		//district
//		$this->load->model('iht_district_model');
//		$data['districtOption'] = $this->iht_district_model->findAll();		
		
		//are
//		$this->load->model('iht_area_model');
//		$data['areaOption'] = $this->iht_area_model->findAll();
		
		//get guide address
		$this->load->model('hs_configmodel');
		$dataConf = $this->hs_configmodel->findAll();
    	$data['guide_address'] = $dataConf[0]['street_address'];
   }
   
   function loadmodel() {
   	    $data['numberFile'] = (int)$this->uri->segment(3);

   	    $data['propertyTypeOption'] = $this->config->item('property_type');
        $data['propertyPriceOption'] = $this->config->item('price_range');
   		$aryModel = array('model'=>$this->load->view('/properties/pmodel', $data, TRUE));
   		echo json_encode($aryModel);
   }
   
   	// private function, format data to template
	function _display($page_req, $data = array()) {
		
		$data['site_name'] = $this->site_name;
		$data['content'] = $this->load->view($page_req, $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);
	}
	
	//resize image
	function _create_thumb($img_src, $width, $thumb_marker = '_thumb', $creat_thumb = true) {

		if(!$creat_thumb) {
			$imgSize = getimagesize($img_src);
			if($imgSize['width'] <= $width && $imgSize['height'] <= $width) return;
		}
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_src;
		$config['quality'] = '100%';
		$config['create_thumb'] = $creat_thumb;
		$config['thumb_marker'] = $thumb_marker;
		$config['width'] = $width;
		$config['height'] = $width;
		
		$this->image_lib->initialize($config); 
		
		if (!$this->image_lib->resize())
		{
		    echo $this->image_lib->display_errors();
//		    exit("error");
		}
//		$this->image_lib->clear();
//		return $this->image_lib->resize();
	}

	
	//del older file 
	function _del_old_file($origin_files, $older_files, $path) {
		
		$aryFilesDel = array_diff($origin_files, $older_files);
		if(is_array($aryFilesDel) && sizeof($aryFilesDel))
		
			foreach ($aryFilesDel as $fileDel) {
				
				if(stripos($fileDel, '/')) continue;
				
				$this->_del_file($fileDel, $path);
				/*//get image name
				$img_name = substr($fileDel, 0, strrpos($fileDel, '.'));
				$ext = strrchr($fileDel, '.');
				$thumb_name = $img_name.'_thumb'.$ext;
				$small_name = $img_name.'_small'.$ext;
				
				@unlink($path.'/'.$fileDel);
				@unlink($path.'/'.$thumb_name);
				@unlink($path.'/'.$small_name);*/
			}
	}
	
	function _del_file ($fileDel, $path) {
				
				//get image name
				$img_name = substr($fileDel, 0, strrpos($fileDel, '.'));
				$ext = strrchr($fileDel, '.');
				$thumb_name = $img_name.'_thumb'.$ext;
				$small_name = $img_name.'_small'.$ext;
				
				@unlink($path.'/'.$fileDel);
				@unlink($path.'/'.$thumb_name);
				@unlink($path.'/'.$small_name);
	}
}
?>
<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : product.php
 *
 * DESCRIPTION   : product module controller
 *
 * @since               Version 1.0
 * @filesource
 */

class Products extends Controller {
	
	public $site_name = '';

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Products() {
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
   // Description: Extracts a list of all products data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
														
   	$this->user_group_model->can_access('View list property', null, null);

      $start = $this->uri->segment(3,0);
      $limit_per_page = 20;

      $this->load->model('ci_productsmodel');                  // Instantiate the model
      $user_id = $this->session->userdata('userid');
      $filter = " WHERE create_user = $user_id";
      $the_results['ci_products_list'] = $this->ci_productsmodel->findByFilter($filter, $start, $limit_per_page);  // Send the retrievelist msg
     
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->ci_productsmodel->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 3;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'products/browse/';

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = "Danh sách tin";
      $the_results['start'] = $start;
      $the_results['site_name'] = "Danh sách tin";
		
		// Display in Template
		$this->_display('/products/products', $the_results);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_products entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
   		
   	$this->user_group_model->can_access('Add new property', null, null);
      $this->load->helper('url');
      $error = '';

      // ///////////////////////////////////////////////////////////////////////
      // How are we being invoked. The user is either requesting a form or is
      // ...submitting it.
      // ///////////////////////////////////////////////////////////////////////
      $submit = $this->input->post('Submit');      
     
      $submited = $this->input->post('submited');
      if ( $submit != false || $submited) {
	      	$this->load->library('form_validation');
	      	
	      	//field validates
			$this->_validate_form();
	      	
	      	$data = $this->_get_form_values();
		
			$data['attach_files']		= array();
			$ary_userfile_title		= array();
			
			//set default image
			if($this->input->post('house_image')) {
				$data['attach_files'][] = $this->input->post('house_image');
				$ary_userfile_title[] = '';
			}
			
//			$ary_floorplan_file_title		= array();
			$userfile_title = $this->input->post('userfile_title', TRUE);
		
		//number file is attached
		$pattach = $this->input->post('pattach', TRUE);
		$flattach = $this->input->post('flattach', TRUE);
		
	    if($this->form_validation->run() == TRUE) {
	
	      	$this->load->model('ci_productsmodel');

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
						
						$this->_create_thumb($img_src, 80, '_small');
					}
		        }
			}
			
				$this->load->library('front_lib');
			
				$data['attach_files'] = serialize(array('file'=>$data['attach_files'], 'title'=>$ary_userfile_title));
				$data['create_user']	= $this->session->userdata('userid');
				$data['site_id']	= $this->session->userdata('site_id');
				
				//convert name to name_sef
				$data['name_sef'] = $this->front_lib->cv2sef($data['name']).'.html';
				$this->ci_productsmodel->add($data);
				
				// $this->load->helper('url');
				if(empty($error)) redirect($this->site_name.'products/', 'location');
      	}
      }
      
		if(!$submit && !$submited) $data = $this->_clear_form();
		
		$data['action']       = 'add';
		$data['title'] = 'Add Property';
		
		$this->_prepare_form($data);
		$data['error'] = $error;

		$this->_display('/products/add_property_form', $data);

   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
   	$this->user_group_model->can_access('Edit property', null, null);

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
	         $this->load->model('ci_productsmodel');
	         
	         $data = $this->_get_form_values();
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
				
			$this->ci_productsmodel->modify($data['id'], $data);

         if(empty($error)) redirect($this->site_name.'products/', 'location');
      	}
      }
      //else {
         // We have to show the user the input form
         $idField = $this->uri->segment(3);

         $this->load->model('ci_productsmodel');
         $data = $this->ci_productsmodel->retrieve_by_pkey($idField);
         
         $data['action'] = 'modify/'.$idField;
         $data['title'] = 'Edit Property';

         $this->_prepare_form($data);
		
		$data['error'] = $error;

		$this->_display('/products/add_property_form', $data);


      //}
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
   	$this->user_group_model->can_access('Delete property', null, null);
      $idField = $this->uri->segment(3);

      $this->load->model('ci_productsmodel');
      $user_id = $this->session->userdata('userid');
      $the_results = $this->ci_productsmodel->delete_by_pkey($idField, $user_id);

      $this->load->helper('url');
      redirect($this->site_name.'/products/', 'location');

   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['name']		= '';
		$data['owner']		= '';
		$data['address']		= '';
		$data['neighborhood']		= '';
		$data['contact_name']		= '';
		$data['contact_phone']		= '';
		$data['contact_email']		= '';
		$data['zip']		= '';
		$data['infomation']		= '';
		$data['private_info']		= '';
		$data['url']		= '';
		$data['hold']		= '';
		$data['type']		= '';
		$data['attach_files']		= '';
		$data['bedrooms']		= '';
		$data['bath']		= '';
		$data['square_footage']		= '';
		$data['transport_router1']		= '';
		$data['transport_router2']		= '';
		$data['neighbor_hood']		= '';
		$data['property_type']		= '';
		$data['price']		= '';
		$data['create_user']		= '';
		$data['start_date']		= '';
		$data['end_date']		= '';
		$data['amenities']		= '';
		$data['geocode']		= '';
		$data['available_date']		= '';
//		$data['floorplan_file']		= '';
		$data['fprice']		= '';
		$data['fsquare']		= '';
		$data['fbedrooms']		= '';
		$data['fbath']		= '';
		$data['bath_max']		= '';
		$data['bedrooms_max']		= '';
		$data['price_max']		= '';
		$data['square_max']		= '';
		$data['distance']		= '';
		$data['site_id']		= '';
		$data['district']		= '';
		$data['province']		= '';
		$data['is_negotiate']		= '';
		$data['m2']		= '';
		$data['page_type']		= '';
		$data['position']		= '';
		$data['direction']		= '';
		$data['from_to_road']		= '';
		$data['is_power_oclock']		= '';
		$data['is_water']		= '';
		$data['build_year']		= '';
		$data['currency']		= '';

      return $data;

   }

   function _get_form_values() {
		$data['name']		= $this->input->post('name', TRUE);
		$data['owner']		= $this->input->post('owner', TRUE);
		$data['address']		= $this->input->post('address', TRUE);
		$data['neighborhood']		= $this->input->post('neighborhood', TRUE);
		$data['contact_name']		= $this->input->post('contact_name', TRUE);
		$data['contact_phone']		= $this->input->post('contact_phone', TRUE);
		$data['contact_email']		= $this->input->post('contact_email', TRUE);
		$data['zip']		= $this->input->post('zip', TRUE);
		$data['infomation']		= $this->input->post('infomation', TRUE);
		$data['private_info']		= $this->input->post('private_info', TRUE);
		$data['url']		= $this->input->post('url', TRUE);
		$data['hold']		= $this->input->post('hold', TRUE);
		$data['attach_files']		= $this->input->post('attach_files', TRUE);
		$data['bedrooms']		= (int)$this->input->post('bedrooms', TRUE);
		$data['bath']		= (float)$this->input->post('bath', TRUE);
		$data['square_footage']		= (float)$this->input->post('fsquare_width', TRUE) * (float)$this->input->post('fsquare_length', TRUE);
		$data['transport_router1']		= (int)$this->input->post('transport_router1', TRUE);
		$data['transport_router2']		= (int)$this->input->post('transport_router2', TRUE);
		$data['neighbor_hood']		= (int)$this->input->post('neighbor_hood', TRUE);
		$data['property_type']		= $this->input->post('property_type', TRUE);
		$data['price']		=  		(float)$this->input->post('price', TRUE);
		$data['create_user']		= $this->input->post('create_user', TRUE);
		$data['start_date']		= time();
		$data['end_date']		= $this->input->post('end_date', TRUE);
		$data['geocode']		= $this->input->post('geocode', TRUE);
		$data['available_date']		=  		strtotime($this->input->post('available_date', TRUE));
//		$data['floorplan_file']		= $this->input->post('floorplan_file', TRUE);
		$data['fprice']		= $this->input->post('fprice', TRUE);
		$data['fsquare_width']		= $this->input->post('fsquare_width', TRUE);
		$data['fsquare_length']		= $this->input->post('fsquare_length', TRUE);
		$data['fbedrooms']		= $this->input->post('fbedrooms', TRUE);
		$data['fbath']		= $this->input->post('fbath', TRUE);
		$data['bath_max']		= $this->input->post('bath_max', TRUE);
		$data['bedrooms_max']		= $this->input->post('bedrooms_max', TRUE);
		$data['price_max']		= $this->input->post('price_max', TRUE);
		$data['square_max']		= $this->input->post('square_max', TRUE);
		$data['distance']		= (int)$this->input->post('distance', TRUE);
		$data['site_id']		= (int)$this->input->post('site_id', TRUE);
		$data['district']		= (int)$this->input->post('district', TRUE);
		$data['province']		= (int)$this->input->post('province', TRUE);
		$data['page_type']		= $this->input->post('page_type', TRUE);
		$data['position']		= $this->input->post('position', TRUE);
		$data['direction']		= $this->input->post('direction', TRUE);
		$data['from_to_road']		= (int)$this->input->post('from_to_road', TRUE);
		$data['is_power_oclock']		= $this->input->post('is_power_oclock', TRUE);
		$data['is_water']		= $this->input->post('is_water', TRUE);
		$data['build_year']		= (int)$this->input->post('build_year', TRUE);
		$data['amenities']		=  	is_array($this->input->post('amenities', TRUE)) ? '|'.implode('|', $this->input->post('amenities', TRUE)).'|' : '';
		$data['culture']		=  	is_array($this->input->post('culture', TRUE)) ? '|'.implode('|', $this->input->post('culture', TRUE)).'|' : '';
		$data['currency']		=  	$this->input->post('currency', TRUE);
		$data['is_negotiate']	= $this->input->post('is_negotiate', TRUE);
		
		$data['m2']				= $this->input->post('m2', TRUE);
		$data['type']		= $this->input->post('type', TRUE);

         return $data;
   }
   
   //validate form
   function _validate_form() {
		$this->form_validation->set_rules('name','Property Name', 'required|xss_clean');
		$this->form_validation->set_rules('owner','Owner', 'xss_clean');
		$this->form_validation->set_rules('address','Address', 'xss_clean');
		$this->form_validation->set_rules('province','Tỉnh/Thành phố', 'xss_clean');
		$this->form_validation->set_rules('neighborhood','Neighborhood', 'xss_clean');
		$this->form_validation->set_rules('contact_name','Contact_name', 'xss_clean');
		$this->form_validation->set_rules('contact_phone','Contact_phone', 'xss_clean');
		$this->form_validation->set_rules('contact_email','Contact email', 'valid_email|xss_clean');
		$this->form_validation->set_rules('zip','Zip', 'xss_clean');
		$this->form_validation->set_rules('private_info','Thông tin bí mật', 'xss_clean');
		$this->form_validation->set_rules('url','Url', 'xss_clean');
		$this->form_validation->set_rules('hold','Hold', 'xss_clean');
		$this->form_validation->set_rules('type','Type', 'xss_clean');
		$this->form_validation->set_rules('attach_files','Attach_files', 'xss_clean');
		$this->form_validation->set_rules('bedrooms','Bedrooms', 'xss_clean');
		$this->form_validation->set_rules('bath','Bath', 'xss_clean');
		$this->form_validation->set_rules('square_footage','Square_footage', 'xss_clean');
		$this->form_validation->set_rules('transport_router1','Transport_router1', 'xss_clean');
		$this->form_validation->set_rules('transport_router2','Transport_router2', 'xss_clean');
		$this->form_validation->set_rules('neighbor_hood','Neighbor_hood', 'xss_clean');
		$this->form_validation->set_rules('property_type','Property_type', 'xss_clean');
		$this->form_validation->set_rules('price','Price', 'xss_clean');
		//end
		
		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
   }
   
   //prepare form
   function _prepare_form (&$data) {
   	
		// Retrieve the ci_transportation_router lookup values.
//		$this->load->model('ci_transportation_routermodel');
//		$data['ci_transportation_routerlist'] = $this->ci_transportation_routermodel->findAll();

   }
   
   function loadmodel() {
   	    $data['numberFile'] = (int)$this->uri->segment(3);

   	    $data['propertyTypeOption'] = $this->config->item('property_type');
        $data['propertyPriceOption'] = $this->config->item('price_range');
   		$aryModel = array('model'=>$this->load->view('/products/pmodel', $data, TRUE));
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
		}
	}

	
	//del older file 
	function _del_old_file($origin_files, $older_files, $path) {
		
		$aryFilesDel = array_diff($origin_files, $older_files);
		if(is_array($aryFilesDel) && sizeof($aryFilesDel))
		
			foreach ($aryFilesDel as $fileDel) {
				
				if(stripos($fileDel, '/')) continue;
				
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
}
?>
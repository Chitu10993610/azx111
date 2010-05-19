<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : iht_upload.php
 *
 * DESCRIPTION   : iht_upload module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-08-10 12:38 PM   - dungbt     - Created
 *
 * @package             iht_upload
 * @subpackage          iht_upload component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2008-2009 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 */

class iht_upload extends Controller {

	/**
	* Contructor function
	*
	* Load the instance of CI by invoking the parent constructor
	*
	* @access      public
	* @return      none
	*/
	function iht_upload() {
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
	 * Description: Extracts a list of all iht_upload data records and displays it.
	 */
	function browse() {
		$this->user_group_model->can_access('View list owner file', null, null);
		
		$start = $this->uri->segment(3,0);
		$limit_per_page = 20;
		
		$this->load->model('iht_upload_model');                  // Instantiate the model
		//$user_id = $this->session->userdata('userid');
		      
//		$filter = ' WHERE user_id = '.$this->session->userdata('userid');
		$the_results['iht_upload_list'] = $this->iht_upload_model->findByFilter($filter, $start, $limit_per_page);
		
		$this->load->library('pagination');
		
		
		$config['total_rows']   = $this->iht_upload_model->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['base_url'] = base_url().'iht_upload/browse/';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		$this->pagination->initialize($config);
		$the_results['page_links'] = $this->pagination->create_links();
		$the_results['title'] = "List File uploaded";
		$the_results['start'] = $start;
		$the_results['doc_type'] = $this->config->item('doc_type');
		
		// Display in Template
		$this->_display('/iht_upload/iht_upload_grid', $the_results);
	}

   /**
    * Function: add()
    * Description: Prompts user for input and adds a new iht_upload entry ...onto the database.
    */
	function add() {
		$this->user_group_model->can_access('Add new file', null, null);
		$submit = $this->input->post('Submit');      
		if ( $submit != false) {
		  	$this->load->library('form_validation');
		  	
		  	//field validates
			$this->_validate_form();
		  	$data = $this->_get_form_values();
		
			if($this->form_validation->run() == TRUE) {
				
				$this->load->model('iht_upload_model');
				if($_FILES['uploadfile']['name'] != '') {
			        $config['upload_path'] = './files/doc';
					$config['allowed_types'] = 'pdf|rar|zip|doc|txt|gif|jpg|png';
					$config['max_size']	= '5000';
			
					$this->load->library('upload', $config);
				
					if (!$this->upload->do_upload('uploadfile')) {
						$error = $this->upload->display_errors('<div class="error">','</div>');
//						exit($error);
					}
					else {
						$upload_data = $this->upload->data();
						$data['file_real_name'] = $upload_data['file_name'];
						$data['mine_type'] = $upload_data['file_type'];
						$data['file_size'] = $upload_data['file_size'];
					}
		        }
		        else {
		        	unset($data['file_real_name']);
		        }
		
		        if(!$error) {
					$this->iht_upload_model->add($data);
					redirect('iht_upload/', 'location');	
		        }
			}
		}
		
		if(!$submit) $data = $this->_clear_form();
		
		$data['error']       = $error;
		$data['action']       = 'add';
		$data['title'] = 'Tải file';
		
		$this->_prepare_form($data);
		
		
		$this->_display('/iht_upload/iht_upload_form', $data);
	}

   /**
    * Function: modify()
    * Description: Controller function to process user modify requests
    */
	function modify() {
		$this->user_group_model->can_access('Edit file', null, null);
		$this->load->model('iht_upload_model');

		$submit = $this->input->post('Submit');
		
		if ( $submit != false) {
			$this->load->library('form_validation');
		
			//field validates
			$this->_validate_form();
			$data = $this->_get_form_values();
		
			if($this->form_validation->run() == TRUE) {
				
				if($_FILES['uploadfile']['name'] != '') {
			        $config['upload_path'] = './files/doc';
					$config['allowed_types'] = 'pdf|rar|zip|doc|txt|gif|jpg|png';
					$config['max_size']	= '5000';
			
					$this->load->library('upload', $config);
				
					if (!$this->upload->do_upload('uploadfile')) {
						$error = $this->upload->display_errors('<div class="error">','</div>');
//						exit($error);
					}
					else {
						$upload_data = $this->upload->data();
						$data['file_real_name'] = $upload_data['file_name'];
						$data['mine_type'] = $upload_data['file_type'];
						$data['file_size'] = $upload_data['file_size'];
					}
		        }
		        else {
		        	unset($data['file_real_name']);
		        }
				
				$this->iht_upload_model->modify($data['id'], $data);
				redirect('iht_upload/', 'location');
			}
		}
		
		if(!$submit) {
			$idField = $this->uri->segment(3);
			$data = $this->iht_upload_model->retrieve_by_pkey($idField);
		}
		
		$data['action'] = 'modify/'.$idField;
		$data['title'] = 'Edit iht_upload';
		
		$this->_prepare_form($data);
		
		$this->_display('/iht_upload/iht_upload_form', $data);
	}
	
	/**
    * Function: download()
    * Description: Controller function to process user modify requests
    */
	function download() {
//		$this->user_group_model->can_access('View list owner file', null, null);
		$this->load->model('iht_upload_model');
		
		$idField = $this->uri->segment(3);
		$data = (is_numeric($idField)) ? $this->iht_upload_model->retrieve_by_pkey($idField) : 0;
		if(is_array($data) && sizeof($data)) {

			$fileType = $data['mine_type'];
			$filename = $data['file_real_name'];
			$filesize = $data['file_size'] * 1024;
			$pathFile = dirname(BASEPATH).DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'doc'.DIRECTORY_SEPARATOR.$filename;
			
			// set headers
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Type: $fileType");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: " . $filesize);
					
			set_time_limit(0);			
			
			// Send file for download
			if ($stream = fopen($pathFile, 'rb')){
				while(!feof($stream) && connection_status() == 0){
					//reset time limit for big files
					echo (fread($stream, $filesize));
//					flush();
				}
				
				fclose($stream);
			}
		}
	}

	/**
	* Function: delete()
	* Description: Controller function to process user delete requests
	*/
	function delete() {
		$this->user_group_model->can_access('Delete file', null, null);
	  	
	  	$this->load->model('iht_upload_model');
	  	
	  	$idField = $this->uri->segment(3);
	  	if(is_numeric($idField)) {
	  		$data = (is_numeric($idField)) ? $this->iht_upload_model->retrieve_by_pkey($idField) : 0;
		  	if(is_array($data) && sizeof($data)) {
		  		$the_results = $this->iht_upload_model->delete_by_pkey($idField);
		  		$rootPath = dirname(BASEPATH);
		  		@unlink($rootPath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.$data['file_real_name']);
		  	}
	  	}
	
	  	redirect('/iht_upload/', 'location');
	}

	/**
	 * clear form
	 * @return array
	 */
	function _clear_form() {
		$data['id']		= '';
		$data['file_name']		= '';
		$data['user_id']		= '';
		$data['cat_id']		= '';
		$data['file_real_name']		= '';
		$data['file_des']		= '';
		$data['file_size']		= '';
		$data['create_date']		= '';
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
		$data['id']		= $this->input->post('id', TRUE);
		$data['file_name']		= $this->input->post('file_name', TRUE);
		$data['user_id']		= $this->input->post('user_id', TRUE);
		$data['cat_id']			= $this->input->post('cat_id', TRUE);
		$data['file_real_name']		= $this->input->post('file_real_name', TRUE);
//		$data['file_des']		= $this->input->post('file_des', TRUE);
		$data['create_date']		= time();
		$data['update_date']		= $this->input->post('update_date', TRUE);

		return $data;
	}
   
	/**
	 * validate form
	 */
	function _validate_form() {

		//trim|required|min_length[5]|max_length[12]|xss_clean
		$this->form_validation->set_rules('id','Id', 'xss_clean');
		$this->form_validation->set_rules('file_name','Tên tài liệu', 'required|xss_clean');
		$this->form_validation->set_rules('cat_id','Loại tài liệu', 'required|xss_clean');
		$this->form_validation->set_rules('user_id','User_id', 'xss_clean');
		$this->form_validation->set_rules('file_real_name','File_real_name', 'xss_clean');
		$this->form_validation->set_rules('file_des','File_des', 'xss_clean');

		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
	}
   
	/**
	* prepare form
	*/
	function _prepare_form (&$data) {
		$data['doc_type'] = $this->config->item('doc_type');
//		print_r($this->config->item('doc_type'));
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
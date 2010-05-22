<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Video.php
 *
 * DESCRIPTION   : Video module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             Video
 * @subpackage          ci_video component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */
class Upload_video extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Upload_video() {
      parent::Controller();
      $this->load->helper('html');
      $this->lang->load('userauth', $this->session->userdata('ua_language'));
      $this->lang->load('validation', $this->session->userdata('ua_language'));
      $this->load->model('iht_video_model');                  // Instantiate the model
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
   	$this->user_group_model->can_access(LIST_VIDEO, null, null);
      // The default action is the showall action
      $this->browse();
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all ci_video data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
   	
      $start = (int)$this->uri->segment(4,0);
      $limit_per_page = 20;
      $videoId = (int)$this->uri->segment(3,0);
	
      $filter = $videoId ? ' WHERE video_id = ' .$videoId : '';
	  $aryVideoList = array();
	  $aryVideoList = $this->iht_video_model->findByFilter($filter, $start, $limit_per_page);
	
	  $the_results['aryVideoList'] = $aryVideoList;
	  $the_results['numOfVideo'] = $this->iht_video_model->table_record_count;
	  $the_results['cid'] = $videoId;
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->iht_video_model->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'upload_video/browse/';

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = 'Danh sách video';
   		
      $this->_display('/video/video_grid', $the_results);
   } 
   
   // //////////////////////////////////////////////////////////////////////////
   // Function: playlist()
   //
   // Description: playlist
   //
   // //////////////////////////////////////////////////////////////////////////
   function playlist() {
      $filter = ' WHERE video_status = 1';
	  $aryVideoList = array();
	  $the_results['aryVideoList'] = $this->iht_video_model->findByFilter($filter, 0, 10);
		
      exit($this->load->view('video/playlist', $the_results, true));
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_video entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
	
   	$this->user_group_model->can_access(ADD_VIDEO, null, null);
   	$error = '';
   	$aryVideoInfo = array();

      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	//field validates
      	$this->_validate_form();
      	if($this->form_validation->run() == TRUE) {
         
         $aryVideoInfo = $this->_get_form_values();
         $aryVideoInfo['create_user'] = $_SESSION['userdata']['userid'];
		$aryVideoInfo['create_name'] = $_SESSION['userdata']['username'];
		$aryVideoInfo['create_date'] = time();
		
		$this->load->library('upload');
        
		//upload image preview 
		$error .= $this->_upload_image($aryVideoInfo, $_FILES);
		
         //process upload video
         $error = $this->_upload($aryVideoInfo, $_FILES);
         
         if(!$error) {
         	
			if($aryVideoInfo['file_real_name'] || $aryVideoInfo['video_image']) {
				$aryVideo['video_path'] = base_url().IMG_VIDEO_PATH.$aryVideoInfo['file_real_name'];
				$aryVideo['image'] = $aryVideoInfo['video_image'] ? base_url().IMG_VIDEO_PATH.'thumb/'. $aryVideoInfo['video_image'] : '';
				$aryVideoInfo['embed_code'] = $this->load->view('video/code_single_video', $aryVideo, true);
			}
			
         	//insert database
			$this->iht_video_model->add($aryVideoInfo);
			
			$this->session->set_flashdata('msg', $this->lang->line('ua_video_added'));
			redirect('upload_video/browse/'.$aryVideoInfo['video_id'], 'location');
         }
      	}
      }
      
      $data['aryVideoInfo'] = (!isset($aryVideoInfo)) ? $this->_clear_form() : $aryVideoInfo;
         
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
         $data['error']       = $error;
         $data['title']       = 'Thêm mới video';
         $data['action']       = 'add';

//		$data['content'] = $this->load->view('/upload_videoci_videodetails', $data, TRUE);
		
		$this->_display('/video/ci_videodetails', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
		
   		$this->user_group_model->can_access(EDIT_VIDEO, null, null);
      	$error = '';

      $id = (int)$this->uri->segment(3,$this->input->post('id'));
      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
        $aryVideoInfo = $this->_get_form_values();
        $aryVideoInfo['update_user'] = $_SESSION['userdata']['userid'];
		$aryVideoInfo['update_name'] = $_SESSION['userdata']['username'];
		$aryVideoInfo['update_date'] = time();
      	
      	//field validates
      	$this->_validate_form(0);
      	if($this->form_validation->run() == TRUE) {
      		
      		$this->load->library('upload');

//         	$this->iht_video_model->modify($aryVideoInfo);
         				
			//upload image
			$old_image = $this->input->post('old_image');
			$error .= $this->_upload_image($aryVideoInfo, $_FILES, $old_image);

			//process upload video
			$older_file = $this->input->post('older_file', TRUE);
			$error = $this->_upload($aryVideoInfo, $_FILES, $older_file);
	
			if(!$error) {
				
				if($aryVideoInfo['file_real_name'] || $aryVideoInfo['video_image']) {
					$aryVideo['video_path'] = base_url().IMG_VIDEO_PATH.($aryVideoInfo['file_real_name'] ? $aryVideoInfo['file_real_name'] : $older_file);
					
					if($aryVideoInfo['video_image'] || $old_image) {
						$aryVideo['image'] = base_url().IMG_VIDEO_PATH.'thumb/'. ($aryVideoInfo['video_image'] ? $aryVideoInfo['video_image'] : $old_image);
					}
					
					$aryVideoInfo['embed_code'] = $this->load->view('video/code_single_video', $aryVideo, true);
				}
				
				$this->iht_video_model->modify($aryVideoInfo['id'], $aryVideoInfo);

				$this->session->set_flashdata('msg', $this->lang->line('ua_video_added'));
				redirect('upload_video/browse/'.$aryVideoInfo['video_id'], 'location');
				exit;
			}
      	}
      }
      
		$this->load->model('nny_catmodel');
		$aryVideoList = array();
		$this->nny_catmodel->getCategoryTree($aryVideoList);
		$data['aryVideoList'] = $aryVideoList;
		
		if(!isset($aryVideoInfo)) {
			
			$data['aryVideoInfo'] =  $this->iht_video_model->retrieve_by_pkey($id);
//			print_r($data['aryVideoInfo']);
		}
		else {
			$data['aryVideoInfo'] = $aryVideoInfo;
		}
         
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
		
         $data['action'] = 'modify/'.$id;
         $data['title']       = 'Thêm/Sửa video';
         $data['error']       = $error;
		
		$this->_display('/video/ci_videodetails', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
   		$this->user_group_model->can_access(DELETE_VIDEO, null, null);
		$videoid = $this->input->post('cid');
		$aryVideoId = $this->input->post('chkid');
		
		$aryDelVideo = array();
		$aryDelVideo = $this->iht_video_model->deleteVideo($aryVideoId);
		//delete video
		foreach ($aryDelVideo as $video) {
			$thumb = $this->iht_common->get_thumb($video);
			@unlink($video);
			@unlink($thumb);
		}

		$this->load->helper('url');
      	redirect('upload_video/browse/'.$videoid, 'location');
   }
   
  /**
   * "Index" Page
   *
   * Default class action
   *
   * @access      public
   * @return      none
   */

   function image_manager() {
   	$this->user_group_model->can_access('View list Video', null, null);
      $this->load->plugin('imageManager');
      init_image_manager();
   }

   function _clear_form() {

		$data['id']		= '';
		$data['video_image']		= '';
		$data['video_status']		= '';
		$data['cat_id']		= '';
		$data['lang_id']		= '';
		$data['file_name']		= '';
		$data['file_des']		= '';

      return $data;

   }

   function _get_form_values() {
   	
		$data['id']		= $this->input->post('id', TRUE);
		$data['video_status']		= $this->input->post('video_status', TRUE);
		$data['cat_id']		= $this->input->post('cat_id', TRUE);
//		$data['show_home']		= $this->input->post('show_home', TRUE);
		$data['lang_id']		= $this->input->post('lang_id', TRUE);
		$data['file_name'] = $this->input->post('file_name', TRUE);
		$data['file_des'] = $this->input->post('file_des', TRUE);
      return $data;
   }
   
   function _validate_form($new = 1) {
   	      	
   		$this->form_validation->set_rules('id','Video', 'xss_clean');
   		$this->form_validation->set_rules('file_name','Tên file', 'required|xss_clean');
   		$this->form_validation->set_rules('file_des','Mô tả', 'xss_clean');
//   		if($new)$this->form_validation->set_rules('userfile','File video', 'required|xss_clean');
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
   }
   
    // private function, format data to template
	function _display($page_req, $data = array()) {
		
		$this->iht_common->build_cat($data);
		$data['content'] = $this->load->view($page_req, $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);
	}
	
	//resize video
	function _create_thumb($img_src, $width, $height, $creat_thumb = true, $thumb_marker = '_thumb') {

		if(!$creat_thumb) {
			$imgSize = @getimagesize($img_src);
			if($imgSize[0] <= $width && $imgSize[1] <= $width) return;
		}
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_src;
		$config['quality'] = '100%';
		$config['create_thumb'] = $creat_thumb;
		$config['thumb_marker'] = $thumb_marker;
		$config['width'] = $width;
		$config['height'] = $height;
		
		$this->image_lib->initialize($config); 
		
		if (!$this->image_lib->resize())
		{
		    echo $this->image_lib->display_errors();
		}
		
		$this->image_lib->clear();
	}
	
	//del older file 
	function _del_old_file($origin_files, $path) {
		
//		$aryFilesDel = array_diff($origin_files, $older_files);
//		if(is_array($aryFilesDel) && sizeof($aryFilesDel))
		
//			foreach ($aryFilesDel as $fileDel) {
				
				//if(stripos($origin_files, '/')) continue;
				
				//get video name
				//$img_name = substr($origin_files, 0, strrpos($origin_files, '.'));
				//$ext = strrchr($origin_files, '.');
				//$thumb_name = $img_name.'_thumb'.$ext;
//				$small_name = $img_name.'_small'.$ext;
				
				@unlink($path.'/'.$origin_files);
				//@unlink($path.'/'.$thumb_name);
//				@unlink($path.'/'.$small_name);
//			}
	}
	
	//upload image
	function _upload_image(&$data, $_FILES, $old_image = '') {
		$error = '';
		if($_FILES['image']['name'] != '') {
			
	        $config['upload_path'] = IMG_VIDEO_PATH.'thumb/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '3024';
			$config['max_height']  = '3068';
			
			$this->upload->initialize($config);
		
			if (!$this->upload->do_upload('image')) {
				$error = $this->upload->display_errors('<div class="error">','</div>');
			}
			else {
				$upload_data = $this->upload->data();
				$data['video_image'] = $upload_data['file_name'];
				
				$this->load->library('image_lib');
				//resize image
				$this->_create_thumb($config['upload_path'].$data['video_image'], 190, 150, false);
				
				//create thumbnail
				$this->_create_thumb($config['upload_path'].$data['video_image'], 150, 120, true);
				
				if($old_image) {
					
					$thumb = $this->iht_common->get_thumb($config['upload_path'].$old_image);
					@unlink($config['upload_path'].$old_image);
					@unlink($thumb);
				}
			}
	    }
	    else {
	    	unset($data['video_image']);
	    }
	    
	    return $error;
	}
	
	//upload video
	function _upload(&$data, $_FILES, $origin_older_file = '') {
		
		$config['upload_path'] = IMG_VIDEO_PATH;
        $config['allowed_types'] = 'flv';
		$config['max_size']	= '32768';
		$this->upload->initialize($config);
		
		//upload property files are attached
		if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != '') {
			if (!$this->upload->do_upload('userfile')) {
				$error = $this->upload->display_errors('<div class="error">','</div>');
			}
			else {
				
				//process del older file
				if($origin_older_file) {
					$this->_del_old_file($origin_older_file, $config['upload_path']);
				}

				$upload_data = $this->upload->data();
				$data['file_real_name'] = $upload_data['file_name'];
				$data['mine_type'] = $upload_data['file_type'];
				$data['file_size'] = $upload_data['file_size'];
				
			}
        }
        else $error = 'Bạn chưa chọn file video cần upload';
		
		return $error;
	}
}
?>
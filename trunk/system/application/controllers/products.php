<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : News.php
 *
 * DESCRIPTION   : News module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             News
 * @subpackage          ci_news component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */
define("PRODUCT_TYPE", 'product');
class Products extends Controller {

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

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all ci_news data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
   	
      $start = (int)$this->uri->segment(3,0);
      $limit_per_page = 20;
      $catId = (int)$this->uri->segment(3,0);
	
      $this->load->model('ci_newsmodel');                  // Instantiate the model
      
		$aryNewsList = array();
		$aryNewsList = $this->ci_newsmodel->getNewsList('product', $catId);
	
	  $the_results['aryNewsList'] = $aryNewsList;
	  $the_results['numOfNews'] = $this->ci_newsmodel->table_record_count;
	  $the_results['cid'] = $catId;
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->ci_newsmodel->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 4;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'products/browse/';

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = 'News List';
   		
      $this->_display('/products/ci_newsgrid', $the_results);
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
   	$error = '';

      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	//field validates
      	$this->_validate_form();
      	if($this->form_validation->run() == TRUE) {
         
      	// ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('ci_newsmodel');
         $aryNewsInfo = $this->_get_form_values();
         
         //process upload images
         $error = $this->_upload($aryNewsInfo);
         
         if(!$error) {
	         $this->ci_newsmodel->createNews($aryNewsInfo);
	         $this->session->set_flashdata('msg', $this->lang->line('ua_news_added'));
	         redirect('products/browse/'.$aryNewsInfo['cat_id'], 'location');
         }
      	}
      }
      
      $data['aryNewsInfo'] = (!isset($aryNewsInfo)) ? $this->_clear_form() : $aryNewsInfo;
      $data['aryNewsInfo']['cat_id'] = $this->uri->segment(3, 0);
      $this->load->model('nny_catmodel');
       $aryCatList = array();
		$this->nny_catmodel->getCategoryTree($aryCatList);
		$data['aryCatList'] = $aryCatList;
		
         
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
         $data['title']       = 'Add a news';
         $data['action']       = 'add';

		$data['content'] = $this->load->view('/products/ci_newsdetails', $data, TRUE);
		
		$this->_display('/products/ci_newsdetails', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
		
   		$this->user_group_model->can_access('Edit News', null, null);
      	$this->load->helper('url');
      	
      	$error = '';

      $news_id = (int)$this->uri->segment(3,$this->input->post('news_id'));
      $submit = $this->input->post('Submit');

      $this->load->model('ci_newsmodel');
		
      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
        $aryNewsInfo = $this->_get_form_values();
      	
      	//field validates
      	$this->_validate_form();
      	if($this->form_validation->run() == TRUE) {
         
         
         //process upload images
         $error = $this->_upload($aryNewsInfo);
         
         if(!$error) {
         	$this->ci_newsmodel->updateNews($aryNewsInfo);
         	$this->session->set_flashdata('msg', $this->lang->line('ua_news_added'));
         	redirect('products/browse/'.$aryNewsInfo['cat_id'], 'location');
         	exit;
         }
      	}
      }
      
		$this->load->model('nny_catmodel');
		$aryCatList = array();
		$this->nny_catmodel->getCategoryTree($aryCatList);
		$data['aryCatList'] = $aryCatList;
		
		if(!isset($aryNewsInfo)) {
			
			$data['aryNewsInfo'] =  $this->ci_newsmodel->getNewsById($news_id);
		}
		else {
			$data['aryNewsInfo'] = $aryNewsInfo;
		}
         
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
		
         $data['action'] = 'modify/'.$news_id;
         $data['title']       = 'Thêm/Sửa sản phẩm';
         $data['error']       = $error;
		
		$this->_display('/products/ci_newsdetails', $data);
   }
   
   // //////////////////////////////////////////////////////////////////////////
   // Function: trans()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function trans() {
		
		$this->user_group_model->can_access('Edit News', null, null);
		$this->load->helper('url');
		
		$news_id = (int)$this->uri->segment(3, $this->input->post('news_id'));
		$submit = $this->input->post('Submit');
		
		$this->load->model('ci_newsmodel');
		
		if ( $submit != false ) {
			$translated = $this->input->post('translated');
			$aryNewsInfo = $this->_get_form_values();
			$this->ci_newsmodel->trans($aryNewsInfo, $translated);
			redirect('products/browse/'.$aryNewsInfo['cat_id'], 'location');
         	exit;
		}
      
		$lang_id = $this->input->post('lang_id');
		$lang_id = $lang_id ? $lang_id : 'en';
		
		$data['aryNewsInfo'] = (!isset($aryNewsInfo)) ? $this->ci_newsmodel->getNewsById($news_id, $lang_id) : $aryNewsInfo;
		if(sizeof($data['aryNewsInfo'])) {
			$data['translate']       = 1;
		}
		else {
			$data['translate']       = 0;
			$data['aryNewsInfo']['news_id'] = $news_id;
		}
		
		$this->load->library('user_lib');
		$data['strLang'] = $this->user_lib->showListLang($lang_id);
		$data['title']       = 'Dịch nội dung sản phẩm sang => ';
		$data['trans']       = 't';
		$data['action'] .= 'trans/'.$news_id;
		
		$this->_display('/products/ci_newsdetails', $data);
   }


   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
   		$this->user_group_model->can_access('Delete News', null, null);
		$catid = $this->input->post('cid');
		$aryNewsId = $this->input->post('chkid');
		
		$this->load->model('ci_newsmodel');
		
		$affectedRows = $this->ci_newsmodel->deleteNews($aryNewsId);

		$this->load->helper('url');
      	redirect('products/browse/'.$catid, 'location');

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
   	$this->user_group_model->can_access('View list News', null, null);
      $this->load->plugin('imageManager');
      init_image_manager();
   }

   function _clear_form() {

		$data['news_id']		= '';
		$data['create_date']		= '';
		$data['update_date']		= '';
		$data['update_user']		= '';
		$data['poster']		= '';
		$data['news_image']		= '';
		$data['news_status']		= '';
		$data['cat_id']		= '';
		$data['news_image_align']		= '';
		$data['news_image_border']		= '';
		$data['news_image_width']		= '';
		$data['news_image_higth']		= '';
		$data['show_home']		= '';
		$data['number_views']		= '';
		$data['news_title']		= '';
		$data['intro_content']		= '';
		$data['news_content']		= '';
		$data['lang_id']		= '';

      return $data;

   }

   function _get_form_values() {
   	
		$data['news_id']		= $this->input->post('news_id', TRUE);
		$data['create_date']		= $this->input->post('create_date', TRUE);
		$data['update_date']		= $this->input->post('update_date', TRUE);
		$data['update_user']		= $this->input->post('update_user', TRUE);
		$data['poster']		= $this->input->post('poster', TRUE);
		$data['news_image']		= $this->input->post('news_image', TRUE);
		$data['news_status']		= $this->input->post('news_status', TRUE);
		$data['cat_id']		= $this->input->post('cat_id', TRUE);
		$data['news_image_align']		= $this->input->post('news_image_align', TRUE);
		$data['news_image_border']		= $this->input->post('news_image_border', TRUE);
		$data['news_image_width']		= $this->input->post('news_image_width', TRUE);
		$data['news_image_higth']		= $this->input->post('news_image_higth', TRUE);
		$data['show_home']		= $this->input->post('show_home', TRUE);
		$data['number_views']		= $this->input->post('number_views', TRUE);
		$data['news_title']		= $this->input->post('news_title', TRUE);
		$data['intro_content']		= $this->input->post('intro_content', TRUE);
		$data['news_content']		= $this->input->post('news_content', TRUE);
		$data['news_type']		= PRODUCT_TYPE;
		$data['lang_id']		= $this->input->post('lang_id', TRUE);
      return $data;

   }
   
   function _validate_form() {
   	      	
   		$this->form_validation->set_rules('news_id','News_id', 'xss_clean');
		$this->form_validation->set_rules('create_date','Create_date', 'xss_clean');
		$this->form_validation->set_rules('update_date','Update_date', 'xss_clean');
		$this->form_validation->set_rules('update_user','Update_user', 'xss_clean');
		$this->form_validation->set_rules('poster','Poster', 'xss_clean');
		$this->form_validation->set_rules('news_image','News_image', 'xss_clean');
		$this->form_validation->set_rules('news_status','News_status', 'xss_clean');
		$this->form_validation->set_rules('cat_id','Cat_id', 'xss_clean');
		$this->form_validation->set_rules('news_image_align','News_image_align', 'xss_clean');
		$this->form_validation->set_rules('news_image_border','News_image_border', 'xss_clean');
		$this->form_validation->set_rules('news_image_width','News_image_width', 'xss_clean');
		$this->form_validation->set_rules('news_image_higth','News_image_higth', 'xss_clean');
		$this->form_validation->set_rules('show_home','Show_home', 'xss_clean');
		$this->form_validation->set_rules('news_title','Tên', 'required|xss_clean');
		$this->form_validation->set_rules('intro_content','Thông tin giới thiệu', 'requiredxss_clean');
		$this->form_validation->set_rules('news_content','Nội dung', 'requiredxss_clean');
		$this->form_validation->set_rules('lang_id','Lang_id', 'xss_clean');

		$this->form_validation->set_rules('number_views','Number_views', 'xss_clean');

      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
   }
   
    // private function, format data to template
	function _display($page_req, $data = array()) {
		
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
//				$small_name = $img_name.'_small'.$ext;
				
				@unlink($path.'/'.$fileDel);
				@unlink($path.'/'.$thumb_name);
//				@unlink($path.'/'.$small_name);
			}
	}
	
	//upload image
	function _upload(&$data) {
		
		$data['attach_files']		= array();
		$ary_userfile_title		= array();
			
		//set default image
		if($this->input->post('house_image')) {
			$data['attach_files'][] = $this->input->post('house_image');
			$ary_userfile_title[] = '';
		}
		
		$userfile_title = $this->input->post('userfile_title', TRUE);
		
		//number file is attached
		$pattach		= $this->input->post('pattach', TRUE);
//		print_r($pattach);
//		exit;
		
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
		
		$config['upload_path'] = './images/property';
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
//		print_r($_FILES);
//		exit;
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
					$this->_create_thumb($img_src, 120);
//					$this->image_lib->clear();
					
//					$this->_create_thumb($img_src, 80, '_small');
				}
	        }
		}
		
		$data['news_image'] = serialize(array('file'=>$data['attach_files'], 'title'=>$ary_userfile_title));
		
		return $error;
	}

}
?>
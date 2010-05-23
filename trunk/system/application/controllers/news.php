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
define("NEWS_TYPE", 'news');
class News extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function News() {
      parent::Controller();
      $this->load->helper('html');
      $this->lang->load('userauth', $this->session->userdata('ua_language'));
      $this->lang->load('validation', $this->session->userdata('ua_language'));
      
    	$this->load->library('front_lib');
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
   // Description: Extracts a list of all ci_news data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {
   	$this->user_group_model->can_access(VIEW_LIST_NEWS, null, null);
   	
		$filter = '';
		
		//view my news
		if(!access(VIEW_ALL_NEWS)) $filter .=' AND poster = ' . $_SESSION['userdata']['userid'];
		
      $start = (int)$this->uri->segment(5,0);
      $limit_per_page = 30;
      $cat_id = (int)$this->uri->segment(3, 0);
      $newsType = $this->uri->segment(4, 'news');
	
      $this->load->model('ci_newsmodel');                  // Instantiate the model
      
		$aryNewsList = array();
		$aryNewsList = $this->ci_newsmodel->getNewsList($newsType, $cat_id, $start, $limit_per_page, $filter);
	
	  $the_results['aryNewsList'] = $aryNewsList;
	  $the_results['numOfNews'] = $this->ci_newsmodel->table_record_count;
	  $the_results['newsType'] = $newsType;
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['total_rows']   = $this->ci_newsmodel->table_record_count;
      $config['per_page']     = $limit_per_page;
      $config['uri_segment'] = 5;
      $config['num_links'] = 3;
      $config['base_url'] = base_url().'news/browse/'.$cat_id.'/'.$newsType;

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();
      $the_results['title'] = 'News List';
      $the_results['cat_id'] = $cat_id;
   		
      $this->_display('/ci_news/ci_newsgrid', $the_results);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_news entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {
   	$this->user_group_model->can_access(ADD_NEWS, null, null);
		$cat_type = $this->uri->segment(4,'news');
		$cat_id = (int)$this->uri->segment(3,0);
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
         $aryNewsInfo['poster']				=  $_SESSION['userdata']['userid'];
         $aryNewsInfo['poster_name']		=  $_SESSION['userdata']['username'];
         
         $error = $this->_upload($aryNewsInfo, $_FILES['news_image']['name'], 'news_image', '');
         
         $this->ci_newsmodel->createNews($aryNewsInfo);

         // $this->load->helper('url');
         $this->session->set_flashdata('msg', $this->lang->line('ua_news_added'));
         redirect('news/browse/'.$aryNewsInfo['cat_id'].'/'.$aryNewsInfo['news_type'], 'location');
      	}
      }
      
		$data['aryNewsInfo'] = (!isset($aryNewsInfo)) ? $this->_clear_form() : $aryNewsInfo;
		$data['aryNewsInfo']['news_type'] = $cat_type;
		$data['aryNewsInfo']['cat_id'] = $cat_id;
		
		$this->load->model('nny_news_catmodel');
		$aryCatList = array();
		 $filter = " AND cat_type = '$cat_type'";
		$this->nny_news_catmodel->getCategoryTree($aryCatList, 0, 0, array(), $filter);
		$data['aryCatList'] = $aryCatList;
		
		$data['newsTypeOption'] = $this->config->item('news_type');
		
		if ($this->session->flashdata('msg')) {
		$data['msg'] = $this->session->flashdata('msg');
		}
		$data['title']       = 'Add a news';
		$data['action']       = 'add';
		
		$data['content'] = $this->load->view('/ci_news/ci_newsdetails', $data, TRUE);
		
		$this->_display('/ci_news/ci_newsdetails', $data);
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {
		
   	$this->user_group_model->can_access(EDIT_NEWS, null, null);


      $submit = $this->input->post('Submit');
		$this->load->model('ci_newsmodel');
		
      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	$aryNewsInfo = $this->_get_form_values();
      	
      	 $aryNewsInfo['update_user']				=  $_SESSION['userdata']['userid'];
         $aryNewsInfo['update_name']				=  $_SESSION['userdata']['username'];
      	
      	//field validates
      	$this->_validate_form();
      	if($this->form_validation->run() == TRUE) {
      		
  		//upload image
  		$old_file = $this->input->post('news_image_old');
  		$error = $this->_upload($aryNewsInfo, $_FILES['news_image']['name'], 'news_image', $old_file);
         
  		if(!$error) {
	         $this->ci_newsmodel->updateNews($aryNewsInfo);
	
	         // $this->load->helper('url');
	         $this->session->set_flashdata('msg', $this->lang->line('ua_news_added'));
	         redirect('news/browse/'.$aryNewsInfo['cat_id'].'/'.$aryNewsInfo['news_type'], 'location');
	         exit;
  		}
      	}
      }
      
		$this->load->model('nny_news_catmodel');
		$aryCatList = array();
		$this->nny_news_catmodel->getCategoryTree($aryCatList);
		$data['aryCatList'] = $aryCatList;
		
		if(!isset($aryNewsInfo)) {
			$news_id = $this->uri->segment(3,0);
//			$data['aryNewsInfo']['new_id'] = $news_id;
			$data['aryNewsInfo'] =  $this->ci_newsmodel->getNewsById($news_id);
		}
		else {
			$data['aryNewsInfo'] = $aryNewsInfo;
		}
		
		$data['newsTypeOption'] = $this->config->item('news_type');
		         
         if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
         $data['action'] = 'modify';
         $data['title']       = 'Edit a news';
         $data['error']       = $error;
		
		$this->_display('/ci_news/ci_newsdetails', $data);
   }
   
   // //////////////////////////////////////////////////////////////////////////
   // Function: trans()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function trans() {
		
		$this->user_group_model->can_access(EDIT_NEWS, null, null);
		$this->load->helper('url');
		
		$news_id = (int)$this->uri->segment(3,$this->input->post('news_id'));
		$submit = $this->input->post('Submit');
		
		$this->load->model('ci_newsmodel');
		
		if ( $submit != false ) {
			$translated = $this->input->post('translated');
			$aryNewsInfo = $this->_get_form_values();
			$this->ci_newsmodel->trans($aryNewsInfo, $translated);
			redirect('news/browse/'.$aryNewsInfo['news_type'], 'location');
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
		$data['title']       = 'Dịch nội dung sang => ';
		$data['trans']       = 't';
		$data['action'] .= 'trans/'.$news_id;
		
		$this->_display('/ci_news/ci_newsdetails', $data);
   }


// //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
   		$this->user_group_model->can_access(DELETE_NEWS_UNPUBLISH, null, null);
		$news_type = $this->input->post('news_type');
		$aryNewsId = $this->input->post('chkid');
		$btn = $this->input->post('setFeature');
		$aryImages = array();
		
		$this->load->model('ci_newsmodel');
		
		if($btn) {
			$this->ci_newsmodel->setFeature($aryNewsId[0]);
		}
		else {
			$aryImages = $this->ci_newsmodel->deleteNews($aryNewsId);
			
			//delete image of new
			foreach ($aryImages as $image) {
				$thumb = $this->front_lib->get_thumb(IMG_NEWS_PATH.$image);
				@unlink(IMG_NEWS_PATH.$image);
				@unlink($thumb);
			}
		}

		$this->load->helper('url');
      	redirect('news/browse/'.$news_type, 'location');
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
		$data['is_hot']		= '';
		$data['is_tieudiem']		= '';
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
		$data['is_tieudiem']		= $this->input->post('is_tieudiem', TRUE);
		$data['is_hot']				= $this->input->post('is_hot', TRUE);
		$data['number_views']		= $this->input->post('number_views', TRUE);
		$data['news_title']		= $this->input->post('news_title', TRUE);
		$data['intro_content']		= $this->input->post('intro_content', TRUE);
		$data['news_content']		= $this->input->post('news_content', TRUE);
		$data['news_type']			= $this->input->post('news_type', TRUE);;
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
		$this->form_validation->set_rules('news_type','Loại tin', 'required|xss_clean');
		$this->form_validation->set_rules('news_status','News_status', 'xss_clean');
		$this->form_validation->set_rules('cat_id','Cat_id', 'xss_clean');
		$this->form_validation->set_rules('news_image_align','News_image_align', 'xss_clean');
		$this->form_validation->set_rules('news_image_border','News_image_border', 'xss_clean');
		$this->form_validation->set_rules('news_image_width','News_image_width', 'xss_clean');
		$this->form_validation->set_rules('news_image_higth','News_image_higth', 'xss_clean');
		$this->form_validation->set_rules('news_title','Tiêu đề tin', 'required|xss_clean');
		$this->form_validation->set_rules('intro_content','Trích dẫn', 'required|xss_clean');
		$this->form_validation->set_rules('news_content','Nội dung tin', 'required|xss_clean');
		$this->form_validation->set_rules('lang_id','Lang_id', 'xss_clean');

		$this->form_validation->set_rules('number_views','Number_views', 'xss_clean');

      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
   }
   
   public function _upload(&$data, $file_name, $field_name, $old_file = '', $water_mark=false) {
   		$error = '';
   	 	if($file_name != '') {
			$config['upload_path'] = IMG_NEWS_PATH;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['max_width']  = '11024';
			$config['max_height']  = '11768';
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload($field_name)) {
				$error = $this->upload->display_errors('<div class="error">','</div>');
			}
			else {
				$upload_data = $this->upload->data();
				$data[$field_name] = $upload_data['file_name'];
				
				if($old_file) {
					$thumb = $this->front_lib->get_thumb($config['upload_path'].'/'.$old_file);
					@unlink($config['upload_path'].'/'.$old_file);
					@unlink($thumb);
				}
				
				$img_fullpath = $config['upload_path'].'/'.$upload_data['file_name'];
				
				//resize image
				$this->load->library('iht_common');
				$error = $this->iht_common->create_thumb($img_fullpath, 480, 368, false); //resize
				$error .= $this->iht_common->create_thumb($img_fullpath, 130, 100, true);
				
				if($water_mark) $this->iht_common->water_mark($img_fullpath, true, 'images/autovn/logo_wm.png');
			}
		}
		else {
			unset($data[$field_name]);
		}
		
		return $error;
   }
   
    // private function, format data to template
	function _display($page_req, $data = array()) {
		
		$data['content'] = $this->load->view($page_req, $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);
	}

}
?>
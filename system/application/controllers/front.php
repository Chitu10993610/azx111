<?php
define('TITLE_DEFAUL',  ' -tapchiphunu.net Chuyên san phụ nữ lớn nhất Việt Nam');
class Front extends Controller {
	function Front() {
		parent::Controller();
		$this->load->library('front_lib');
//		$data['user1_are'] = ''; 
//        $data['feature_are'] = '';
        
        global $catId;
        switch ($this->uri->segment(1, 0)) {
        	case 'tim-kiem':
        		$catId = 'search';
        		break;
        	case 'front':
        	case '':
        		$catId = 'home';
        		break;
        	default:
        		$catId = $this->uri->segment(2, 0);
        		break;
        }
	}
	function index() {
		$page_req = 'front/index';
		$start = (int)$this->uri->segment(3, 0);
		$this->load->model('hs_configmodel');
        $data['title'] = 'Trang chủ';
	//       $data['user1_are'] = ''; 
	//       $data['feature_are'] = '';
		$this->front_lib->_build_box1_front($data);    	
		$this->_display($page_req, $data);
	}
	/**
	 * gioi thieu chung
	 *
	 */
	function bieu_gia() {
		$this->load->model('hs_configmodel');	
		$dataConf = $this->hs_configmodel->findAll();
        $data = $dataConf[0];
        $data['title'] = 'Giá»›i thiá»‡u';
        $arydata['title'] = '<span class="upper" style="text-align:left; padding-top:0;"><b>Giá»›i thiá»‡u</b></span>';
		$data['content'] = $data['service'];
        //$data['user1_are'] .= $this->load->view('boxs/box', $arydata, TRUE);
		$this->_display('/contact/bieugia_tpl', $data);
	}
		function dang_nhap() {
        //$data['user1_are'] .= $this->load->view('boxs/box', $arydata, TRUE);
		$this->_display_raovat('boxs/login_tpl', $data);
	}
	/**
	 * dich vá»¥
	 *
	 */
	function dichvu() {
		$this->load->model('hs_configmodel');
		$dataConf = $this->hs_configmodel->findAll();
        $data = $dataConf[0];
        $data['title'] = 'Dá»‹ch vá»¥ BÄ?S';
        $arydata['title'] = '<span class="upper" style="text-align:left; padding-top:0;"><b>Giá»›i thiá»‡u</b></span>';
		$arydata['content'] = $data['service'];
        $data['user1_are'] .= $this->load->view('boxs/box', $arydata, TRUE);
		$this->_display($page_req, $data);
	}
	
	// Đăng nhập
		function dangnhap(){
      		
			$arydata['title'] = 'Thành viên đăng nhập';
			$arydata['content'] = $this->load->view('boxs/login_tpl', $data, TRUE);
			$data['box1_area'] .= $this->load->view('boxs/box1_tpl', $arydata, TRUE);
		$this->_display($page_req, $data);
	}
	/**
	 * list rent or sell
	 *
	 */
	function thoitrang(){
		if(!$_SESSION['city']){
		$filter_rules = "WHERE property_type='12'";
		}
		else {
			$city=$_SESSION['city'];
			$filter_rules = "WHERE property_type='12' AND province=$city";
		}
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = '';
		//$filter_rules .= 'province = '.$_SESSION['city'];
		$this->_get_list_rao_vat($filter_rules, $data);	
	}
function mypham_trangsuc(){
		if(!$_SESSION['city']){
		$filter_rules = "WHERE property_type='17'";
		}
		else {
			$city=$_SESSION['city'];
			$filter_rules = "WHERE property_type='17' AND province=$city";
		}
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = '';
		
		//$filter_rules .= 'province = '.$_SESSION['city'];
		$this->_get_list_rao_vat($filter_rules, $data);	
	}
function khac(){
		if(!$_SESSION['city']){
		$filter_rules = "WHERE property_type='18'";
		}
		else {
			$city=$_SESSION['city'];
			$filter_rules = "WHERE property_type='18' AND province=$city";
		}
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = '';

		//$filter_rules .= 'province = '.$_SESSION['city'];
		$this->_get_list_rao_vat($filter_rules, $data);	
	}	
	function thammy_lamdep() {
		if(!$_SESSION['city']){
		$filter_rules = "WHERE property_type='13'";
		}
		else {
			$city=$_SESSION['city'];
			$filter_rules = "WHERE property_type='13' AND province=$city";
		}
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = '';

		$this->_get_list_rao_vat($filter_rules, $data);
		
	}
	function me_be() {
		if(!$_SESSION['city']){
		$filter_rules = "WHERE property_type='14'";
		}
		else {
			$city=$_SESSION['city'];
			$filter_rules = "WHERE property_type='14' AND province=$city";
		}
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = '';

		$this->_get_list_rao_vat($filter_rules, $data);
		
	}
	function xe_doisong() {
		if(!$_SESSION['city']){
		$filter_rules = "WHERE property_type='15'";
		}
		else {
			$city=$_SESSION['city'];
			$filter_rules = "WHERE property_type='15' AND province=$city";
		}
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = '';

		$this->_get_list_rao_vat($filter_rules, $data);
		
	}
	function am_thuc() {
		if(!$_SESSION['city']){
		$filter_rules = "WHERE property_type='16'";
		}
		else {
			$city=$_SESSION['city'];
			$filter_rules = "WHERE property_type='16' AND province=$city";
		}
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = 0;
		$this->_get_list_rao_vat($filter_rules, $data);
		
	}
	// Tin rao
		function tin_rao() {
		$catId = $this->uri->segment(3, 0);
		if(!$_SESSION['city']){
		$filter_rules = "WHERE property_type=$catId";
		}
		else {
			$city=$_SESSION['city'];
			$filter_rules = "WHERE property_type=$catId AND province=$city";
		}
		$data['title'] = "Tin rao";
		$data['type'] = 0;
		$this->_get_list_rao_vat($filter_rules, $data);
		
	}
		function ha_noi() {
		$filter_rules = " WHERE province='1'AND property_type='12'";
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = 0;
		$this->_get_list_rao_vat($filter_rules, $data);
		
	}
		function ho_chi_minh() {
		
		$filter_rules = " WHERE province='2'";
		$data['title'] = "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] = 0;
		$this->_get_list_rao_vat($filter_rules, $data);
		
	}
	/**
	 * list rent or sell
	 *
	 */
	function canmua() {
		$filter_rules 	= " WHERE type='2' ";
		$data['title']	= "Danh sÃ¡ch nhÃ  cáº§n bÃ¡n";
		$data['type'] 	= 2;
		$this->_get_list_house($filter_rules, $data);
	}
	/**
	 * list rent or sell
	 *
	 */
	function nhachothue() {
		$filter_rules = " WHERE type='1' ";
		$data['title'] = "Danh sÃ¡ch nhÃ  muá»‘n cho thuÃª";
		$data['type'] = 1;
		$this->_get_list_house($filter_rules, $data);
	}	
	
	/**
	 * ./front/chon_city/<?=$lookupid?>
	 *
	 */
	function chon_city() {
		$city = $this->uri->segment(3,0);
		$_SESSION['city'] = $city;
		header("location:".$_SERVER['HTTP_REFERER']);
	}
	
	
function search() {
  $page_req = 'front/search_result';

  $start = $this->uri->segment(3,0);
  $limit_per_page = 20;
  
  $keyword = ($start) ? $keyword = $this->uri->segment(3,0) : $this->input->post('keyword');

  $filter = ($keyword) ? ' AND (news_title LIKE \'%'.$keyword.'%\' OR news_content LIKE \'%'.$keyword.'%\') ' : '';
  $this->load->model('ci_newsmodel');                  // Instantiate the model
  
  $aryNewsList = array();
  $aryNewsList = $this->ci_newsmodel->getNewsList($newsType, $catId, $start, $limit_per_page, $filter);
  
  $data['aryNewsMainList'] = $aryNewsList;
  $data['numOfNews'] = $this->ci_newsmodel->table_record_count;
  $data['cid'] = $catId;
  
  $this->load->library('pagination');
  $this->load->helper('url');
  
  $config['total_rows']   = $this->ci_newsmodel->table_record_count;
  $config['per_page']     = $limit_per_page;
  $config['uri_segment'] = 3;
  $config['num_links'] = 10;
  $config['base_url'] = base_url().'tim-kiem/'.urlencode($keyword);
  
  $this->pagination->initialize($config);
  $data['page_links'] = $this->pagination->create_links();
  
        $this->front_lib->build_right_level2($data);
        
  $data['keyword_search'] = $keyword;
  $data['title'] = 'Danh sách kết quả tìm kiếm';
   
  $this->_display($page_req, $data);
 }
	
	//google search
	function search_google() {
		$page_req = 'front/google_result';
		$this->_display($page_req);
	}
	
	//house detail
	function detail() {
		//$page_req = 'front/search_result_detail';
		$page_req = 'front/chitiet_raovat_tpl';
		$id = $this->uri->segment(2,0);
//		exit($id);
		
		$this->load->model('ci_propertiesmodel');                  // Instantiate the model
		
		$aryHouse = $this->ci_propertiesmodel->retrieve_by_pkey($id);
		
		if(is_array($aryHouse) && sizeof($aryHouse)) {
			$dataUpdate['view'] = "view + 1";
			$this->ci_propertiesmodel->update_view($aryHouse['id'], $dataUpdate);
		}
		
		$data['ci_properties'] = $aryHouse;

		$attach_files		 = @unserialize($data['ci_properties']['attach_files']);
		$data['ci_properties']['attach_files']		 = $attach_files['file'];
		$data['ci_properties']['attach_files_title']	 = $attach_files['title'];
		
		$data['title'] = isset($data['ci_properties']['name']) ? $data['ci_properties']['name'] : '';
		 //$data['ads_right_rv'] = $this->front_lib->get_box_adv('adv/right_rv_tpl', 'right_raovat', 10);		
		$this->_display_raovat($page_req, $data);
	}
	function mapit() {
		$data['geocode'] = base64_decode($this->input->post('geo', TRUE));
		$data['address'] = base64_decode($this->input->post('adr', TRUE));
		
	 	$info['map'] = $this->load->view('front/mapit', $data, TRUE);
	 	echo json_encode($info);
	 	exit;
	}
	
	function dieukhoan() {
		$page_req = 'front/dieukhoan';
		$this->load->model('hs_configmodel');
        $data['title'] = 'Ä?iá»?u khoáº£n sá»­ dá»¥ng';  	
		$this->_display($page_req, $data);
	}
	
	
	function tin_tuc() {
		$page_req = 'front/news/list_news';
		
		$start = 0;
		$start = $this->uri->segment(5,0);
		$limit_per_page = 20;
		$catId = $this->uri->segment(3, 11);;
		if(!is_numeric($catId)) {
			$catId = 11;
		}
		
		$time = 0;
		$day = $this->input->post('day');
		
		if($day) {
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$time = strtotime($year.'/'.$month.'/'.$day);
			$timeEnd = strtotime($year.'/'.$month.'/'.$day . ' +1day');
		}
		
		$this->load->model('ci_newsmodel');                  // Instantiate the model
		
		$aryNewsList = array();
		$filter = ($time) ? ' AND (n.create_date < '.$timeEnd . ' AND n.create_date > '.$time.')' : '';
		$aryNewsList = $this->ci_newsmodel->getNewsList($newsType, $catId, $start, $limit_per_page, $filter);
		
		$data['aryNewsMainList'] = $aryNewsList;
		$data['numOfNews'] = $this->ci_newsmodel->table_record_count;
		$data['cid'] = $catId;
		
		//get cat info
		$this->load->model('nny_news_catmodel');
		$aryCat = $this->nny_news_catmodel->getCatInfoBytId($catId);
		if($aryCat['parent_id']) {
			$data['current_menu_id'] = $aryCat['parent_id'];
			$data['current_submenu_id'] = $aryCat['cat_id'];
		}
		else $data['current_menu_id'] = $aryCat['cat_id'];
		$data['current_cat_name'] = $aryCat['cat_name'];
		$data['url'] = base_url().'front/tin_tuc/'.$catId;
		
        $this->front_lib->build_right_level2($data);
		
		$data['title'] = 'Danh sách tin tức';
			
		$this->_display_news($page_req, $data);
	}
	//list danh ba web
	function webs() {
		
		$page_req = 'front/webs';
		
		$start = $this->uri->segment(4,0);
		$limit_per_page = 20;
		$newsType = $this->uri->segment(3, 'news');
	//exit($newsType);
		$catId = 0;
		
		$this->load->model('ci_websmodel');                  
	//Instantiate the model
		
		$aryList = array();
		$aryList = $this->ci_websmodel->findByFilter($filter, $start, $limit_per_page);
		
		$data['aryList'] = $aryList;
		$data['numOfNews'] = $this->ci_newsmodel->table_record_count;
		$data['cid'] = $catId;
		
		$this->load->library('pagination');
		$this->load->helper('url');
		
		$config['total_rows']   = $this->ci_newsmodel->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['base_url'] = base_url().'front/webs/'.$newsType;
		
		$this->pagination->initialize($config);
		

		$data['title'] = 'Danh báº¡ web';
		$arydata['title'] = '<span style="text-align:left; padding-top:0;"><b>Danh báº¡ web</b></span>';
		$data['page_links'] = $this->pagination->create_links();
		
		$arydata['content'] = $this->load->view($page_req, $data, TRUE);
        $data['user1_are'] .= $this->load->view('boxs/box', $arydata, TRUE);
			
		$this->_display('', $data);
	}
	
	function news() {
		//$page_req = 'front/news/tpl_newsdetail';
		$page_req = 'front/news/tpl_chitiettintuc';			
		$this->load->model('ci_newsmodel');                  // Instantiate the model
				
		$news_id = $this->uri->segment(3,0);
		
		$data['aryNewsInfo'] =  $this->ci_newsmodel->getNewsById($news_id);

		//get another news
		if(is_array($data['aryNewsInfo']) && sizeof($data['aryNewsInfo'])) {
			$aryNewsList = array();
			$filter = " AND n.news_id < ".$data['aryNewsInfo']['news_id'];
			$aryNewsList = $this->ci_newsmodel->getNewsList($data['aryNewsInfo']['news_type'], $data['aryNewsInfo']['cat_id'], 0, 5, $filter);
			$data['aryNewsList'] = $aryNewsList;
		}
		
		$data['title'] = $data['aryNewsInfo']['news_title'];
		$data['page_description'] = addslashes($data['aryNewsInfo']['intro_content']);
		$data['ads_left'] = $this->front_lib->get_box_adv('adv/left_tpl', 'left', 10);
		$this->_display($page_req, $data);
	}

	//download document
	function download() {
		$page_req = 'front/download_tpl';
		$cat_id = $this->uri->segment(3,0);
		$start = $this->uri->segment(4,0);
		$limit_per_page = 20;
		
		$this->load->library('pagination');
		$this->load->helper('url');
		$config['total_rows']   = $this->ci_newsmodel->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['base_url'] = base_url().'front/download/'.$cat_id;
		
		$this->pagination->initialize($config);
		

		$data['title'] = 'Download tÃ i liá»‡u';
		$arydata['title'] = '<span style="text-align:left; padding-top:0;"><b>Download tÃ i liá»‡u</b></span>';
		$data['page_links'] = $this->pagination->create_links();
			
		$this->load->model('iht_upload_model');
		// Instantiate the model
		$filter = ' WHERE cat_id = '.$cat_id;
		$data['record_list'] = $this->iht_upload_model->findByFilter($filter, $start, $limit);  // Send the retrievelist msg
		$arydata['content'] = $this->load->view($page_req, $data, TRUE);
        $data['user1_are'] .= $this->load->view('boxs/box', $arydata, TRUE);
		
		$this->_display('', $data);
	}
	
	function news_print() {
		$page_req = 'front/news/tpl_newsdetail';
			
		$this->load->model('ci_newsmodel');                  // Instantiate the model
		
		$news_id = $this->uri->segment(3,0);
		
		$data['aryNewsInfo'] =  $this->ci_newsmodel->getNewsById($news_id);
		
		$this->load->view($page_req, $data);
	}

	// private function, format data to template
	function _display($page_req, $data = array(), $box = false) {
		
		// Get the content to display
//		$data['priceOptions'] = $this->config->item('price_range');
		$data['content'] = $page_req ? $this->load->view($page_req, $data, TRUE) : '';
		if($box) {
			$arydata['title'] = $data['title'];
			$arydata['content'] = $data['content'];
			$data['content'] = $this->load->view('boxs/box', $arydata, TRUE);	
		}
		$data['title'] .= TITLE_DEFAUL;

		// Get info to steer template adv
		$data['adv'] = $page_req;
		
		//get adv
		$this->load->model('ci_adsmodel');
      	
		$filter = " WHERE status_flg = 1 AND position='Bottom'";
    	$data['bottom_ads'] = $this->ci_adsmodel->findByFilter($filter, 0, 1);
		// List Tinh
		$this->load->model('iht_province_model');
		$filter = 'where id_area =3';
		$data['provinceOption3']=$this->iht_province_model->findByFilter($filter);
		$filter = 'where id_area =2';
		$data['provinceOption2']=$this->iht_province_model->findByFilter($filter);
		$filter = 'where id_area =1';
		$data['provinceOption1']=$this->iht_province_model->findByFilter($filter);
		
		
    	//get menu 1
    	$this->load->model('menu_model');
    	$filters = ' WHERE parent_id = 4';
    	$data['typemenu1']=$this->menu_model->find($filters);
		//get menu tin tuc
		//get menu 1
    	$this->load->model('nny_catmodel');
    	$data['catID']=$this->menu_model->find($filters);
    	$this->load->model('menu_model');
    	$filters = ' WHERE parent_id = 15';
    	$data['typemenu2']=$this->menu_model->find($filters);
		//build box1 area
		
				
		//get header banner
    	$data['ads_header'] = $this->front_lib->get_box_adv('adv/header_tpl', 'header', 2);
   
    	$data['ads_bottom'] = $this->front_lib->get_box_adv('adv/anhchay_tpl', 'bottom', 15);	
		//build box2 area
		$this->front_lib->_build_box2_front($data);
		//build box3 area
		$this->front_lib->_build_box3_front($data);				
		//build right area
		$this->front_lib->_build_right_front($data);				
		//build footer area
		$this->front_lib->_build_footer_front($data);
	

		// Display in Template
		$this->load->view('front_template', $data);
	}
	
//get list housing
	function _get_list_rao_vat($filter_rules, $data) {
//		$page_req = 'front/house_sell_tpl';
		
		$start = $this->uri->segment(5,0);
		$limit_per_page = 24;
		
		$this->load->model('ci_propertiesmodel');
		$data['ci_properties_list'] = $this->ci_propertiesmodel->findByFilter($filter_rules, $start, $limit_per_page);
		
		$this->load->library('pagination');
		$this->load->helper('url');
		
		$config['total_rows']   = $this->ci_propertiesmodel->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['base_url'] = $data['type'] ? base_url().'front/nhachothue':base_url().'front/nhaban';
		
		$this->pagination->initialize($config);
		
		$data['page_links'] = $this->pagination->create_links();
		$data['total_rows'] = $config['total_rows'];
		
		$arydata['title'] = '<span class="upper" style="text-align:left; padding-top:0px;"><b>Danh sách nhà</b></span>';
//		$arydata['box_style'] = 'margin-top:5px;';
		//$arydata['content'] = $this->load->view('front/property/property_newest', $data, TRUE);
		//$data['user1_are'] = $this->load->view('boxs/box', $arydata, TRUE);
		
		$this->_display_raovat('front/property/property_newest', $data);
	}
	
	/**
	 * register
	 *
	 */
	function register() {
		$submit = $this->input->post('Submit');     
		$this->load->library('user_lib');
     	
		if ( $submit != false ) {

			$this->_validate_user_form();
			$data = $this->_get_user_form_values();
			
			if($this->form_validation->run() == TRUE) {
				$status = $this->user_group_model->addUser($data);

				if ($status == 0) {
					$ua_data['msg'] = $this->lang->line('ua_missing');
				} elseif ($status == 1) {
					$this->session->set_flashdata('msg', $this->lang->line('ua_user_added'));
					redirect('admin/usergroups', 'location');	
				} else {
					$ua_data['msg'] = $this->lang->line('ua_user_exists');
				}
			}
		}
		
		if(!$submit) $data = $this->user_lib->_clear_user_form();
		
		$data['action']       = 'dang-ky-thanh-vien';
		$data['title'] = $this->lang->line('ua_adduser');
		//$data['content'] = $this->load->view('front/user/register_tpl.php', $data, TRUE);

		// Display in Template
		$this->_display("front/user/register_tpl", $data);
	}
	
	/**
    * Function: contact()
    * Description: Prompts user for input and adds a new contact entry ...onto the database.
    */
	function contact() {
		$submit = $this->input->post('Submit');      
		
		if ( $submit != false) {
		  	$this->load->library('form_validation');
		  	
		  	//field validates
			$this->form_validation->set_rules('name','Há»? TÃªn', 'required|xss_clean');
			$this->form_validation->set_rules('address','Ä?á»‹a chá»‰', 'xss_clean');
			$this->form_validation->set_rules('email','Email', 'valid_email|xss_clean');
			$this->form_validation->set_rules('phone','Ä?iá»‡n thoáº¡i', 'min_length[6]|max_length[12]|numeric|xss_clean');
			$this->form_validation->set_rules('mobile','Di Ä‘á»™ng', 'min_length[10]|max_length[15]|numeric|required|xss_clean');
			$this->form_validation->set_rules('subject','TiÃªu Ä‘á»?', 'required|xss_clean');
			$this->form_validation->set_rules('content','Ná»™i dung', 'required|xss_clean');
			
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
		  	$data = array();
		  	$data['name']		= $this->input->post('name', TRUE);
			$data['address']		= $this->input->post('address', TRUE);
			$data['email']		= $this->input->post('email', TRUE);
			$data['phone']		= $this->input->post('phone', TRUE);
			$data['mobile']		= $this->input->post('mobile', TRUE);
			$data['subject']		= $this->input->post('subject', TRUE);
			$data['content']		= $this->input->post('content', TRUE);
		
			if($this->form_validation->run() == TRUE) {
		
			  	$this->load->model('contact_model');
				//$data['create_user']	= $this->session->userdata('userid');
		
				$this->contact_model->add($data);
//				redirect('front/contact', 'location');
				$data['ok'] = '1';
			}
		}
		
		
		$data['title'] = '';
		
		$this->load->model('hs_configmodel');
		$dataConf = $this->hs_configmodel->findAll();
		$data['dataConf'] = $dataConf[0];
		
		$this->_display('/contact/contact_form', $data, true);
	}
	
	function _validate_user_form($is_myinfo = false) {
   		$this->load->library('form_validation');
   		
   		//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
//      	$this->form_validation->set_rules('userid','Userid', 'xss_clean');
		if(!$is_myinfo) {
			$this->form_validation->set_rules('username','Username', 'required|xss_clean');
			$this->form_validation->set_rules('groupid','Group', 'required|xss_clean');
		}
		
		$this->form_validation->set_rules('fullname','Fullname', 'required|xss_clean');
		$this->form_validation->set_rules('email','Email', 'required|valid_email|xss_clean');
//		$this->form_validation->set_rules('password','Password name', 'callback_password_check');

		if(!$this->input->post('userid', TRUE)) {
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		}
		
		$this->form_validation->set_rules('lastlogin','Lastlogin', 'xss_clean');
		$this->form_validation->set_rules('phone','Ä?T cá»‘ Ä‘á»‹nh', 'is_natural|xss_clean');
		$this->form_validation->set_rules('address','Ä?á»‹a chá»‰', 'xss_clean');
		$this->form_validation->set_rules('mobile_phone','Ä?TDÄ?', 'is_natural|xss_clean');
		$this->form_validation->set_rules('create_date','Create_date', 'xss_clean');
		$this->form_validation->set_rules('birthday','Birthday', 'xss_clean');
		$this->form_validation->set_rules('information','Information', 'xss_clean');
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
   }
   
   //get form values   
	function _get_user_form_values($is_myinfo = false) {
		if(!$is_myinfo) {
			$data['groupid']		= $this->input->post('groupid', TRUE);
			$data['username']		= $this->input->post('username', TRUE);
		}
		
		$data['fullname']		= $this->input->post('fullname', TRUE);
		$data['email']		= $this->input->post('email', TRUE);
		
		if(!$this->input->post('userid', TRUE)) {
			$data['password']		= $this->input->post('password', TRUE);
		}
		
		$data['lastlogin']		= $this->input->post('lastlogin', TRUE);
		$data['enabled']		= $this->input->post('enabled', TRUE);
		$data['site_id']		= $this->input->post('site_id', TRUE);
		$data['phone']		= $this->input->post('phone', TRUE);
		$data['address']		= $this->input->post('address', TRUE);
		$data['mobile_phone']		= $this->input->post('mobile_phone', TRUE);
		$data['create_date']		= $this->input->post('create_date', TRUE);
		$data['edit_date']		= $this->input->post('edit_date', TRUE);
		$data['last_login']		= $this->input->post('last_login', TRUE);
		$data['birthday']		= strtotime($this->input->post('birthday', TRUE));
		$data['information']		= $this->input->post('information', TRUE);
		$data['type']		= $this->input->post('type', TRUE);

      return $data;
   }
   
   // private function, format data to template
	function _display_news($page_req, $data = array(), $box = false) {
	
		// Get the content to display
//		$data['priceOptions'] = $this->config->item('price_range');
		
		if(!$data['content']) $data['content'] = $page_req ? $this->load->view($page_req, $data, TRUE) : '';
		if($box) {
			$arydata['title'] = $data['title'];
			$arydata['content'] = $data['content'];
			$data['content'] = $this->load->view('boxs/box', $arydata, TRUE);	
		}
		
		//$data['current_menu_id'] = $this->uri->segment(3);
//		$data['main_menu'] = $this->front_lib->build_menu($data);

		//get menu tin tuc
    	$this->load->model('menu_model');
    	$filters = ' WHERE parent_id = 0 ';
    	$data['typemenu']=$this->menu_model->find($filters);
		//build box1 area
		
		$data['title'] .= TITLE_DEFAUL;

		//Get info to steer template adv
		$data['adv'] = $page_req;
		    	//get menu 1
    	$this->load->model('menu_model');
    	$filters = ' WHERE parent_id = 4';
    	$data['typemenu1']=$this->menu_model->find($filters);
		//get menu tin tuc
    	$this->load->model('menu_model');
    	$filters = ' WHERE parent_id = 15';
    	$data['typemenu2']=$this->menu_model->find($filters);
		//build box1 area
		
		//get header banner
    	$data['ads_header'] = $this->front_lib->get_box_adv('adv/header_tpl', 'header', 2);
    	$data['ads_bottom'] = $this->front_lib->get_box_adv('adv/anhchay_tpl', 'bottom', 2);
    	
    	$filter = " WHERE status_flg = 1 AND position='Bottom'";
    	$data['adv_footer'] = $this->front_lib->get_box_adv('boxs/adv_tpl', 'footer', 2);

		$this->load->view('front_news_template', $data);
	}
	// font_rao vat
	function _display_raovat($page_req, $data = array(), $box = false) {
		
		// Get the content to display
//		$data['priceOptions'] = $this->config->item('price_range');
		$data['content'] = $page_req ? $this->load->view($page_req, $data, TRUE) : '';
		if($box) {
			$arydata['title'] = $data['title'];
			$arydata['content'] = $data['content'];
			$data['content'] = $this->load->view('boxs/box', $arydata, TRUE);	
		}
		$data['title'] .= TITLE_DEFAUL;

		// Get info to steer template adv
		$data['adv'] = $page_req;
		
		//get adv
		$this->load->model('ci_adsmodel');
      	
		$filter = " WHERE status_flg = 1 AND position='Bottom'";
    	$data['bottom_ads'] = $this->ci_adsmodel->findByFilter($filter, 0, 1);
		// List Tinh
		$this->load->model('iht_province_model');
		$filter = 'where id_area =3';
		$data['provinceOption3']=$this->iht_province_model->findByFilter($filter);
		$filter = 'where id_area =2';
		$data['provinceOption2']=$this->iht_province_model->findByFilter($filter);
		$filter = 'where id_area =1';
		$data['provinceOption1']=$this->iht_province_model->findByFilter($filter);
		
		
    	//get menu 1
    	$this->load->model('menu_model');
    	$filters = ' WHERE parent_id = 4';
    	$data['typemenu1']=$this->menu_model->find($filters);
		//get menu tin tuc
    	$this->load->model('menu_model');
    	$filters = ' WHERE parent_id = 15';
    	$data['typemenu2']=$this->menu_model->find($filters);
		//build box1 area
		$data['sub_menu'] = $this->front_lib->getSubmenu();
		
				
		//get header banner
    	$data['ads_header'] = $this->front_lib->get_box_adv('adv/header_tpl', 'header', 2);
   
    	$data['ads_bottom'] = $this->front_lib->get_box_adv('adv/anhchay_tpl', 'bottom', 15);	
		//build box2 area
		$this->front_lib->_build_box2_front($data);
		//build box3 area
		$this->front_lib->_build_box3_front($data);				
		//build right area
		$this->front_lib->_build_right_raovat($data);				
		//build footer area
		$this->front_lib->_build_footer_front($data);
	

		// Display in Template
		$this->load->view('front_raovat_templet', $data);
	}
}

?>
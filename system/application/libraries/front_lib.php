<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
define("ID_CAT_PHONG_THUY", 2);
define("ID_CAT_TIN_TUC", 4);
class Front_lib {

	var $obj;

	function Front_lib(){
		$this->obj =& get_instance();
		$this->obj->load->model('user_group_model', '', TRUE);
	}
		
	//getthumb
	function get_thumb($images_names) {
		$path_parts = pathinfo($images_names);
		
		$dirname = ($path_parts['dirname'] != '.') ? $path_parts['dirname'].'/' : '';
 		return $dirname.'.thumbs/.'.$path_parts['basename'];
	}
	
	/**
	 * get main menu
	 *
	 * retun main menu
	 */
	function get_main_menu (){
		//get menu 1
    	$this->obj->load->model('menu_model');
    	$filters = ' WHERE parent_id = 4';
    	$data['typemenu1']=$this->obj->menu_model->find($filters);
    	
		return $this->obj->load->view('boxs/main_menu', $data, TRUE);
	}
	
	/**
	 * get sub menu
	 *
	 * retun sub menu
	 */
	function get_sub_menu (){
		//get menu 1
    	$this->obj->load->model('menu_model');
    	$filters = ' WHERE parent_id = 15 ';
    	$data['typemenu']=$this->obj->menu_model->find($filters);
    	
		return $this->obj->load->view('boxs/sub_menu', $data, TRUE);
	}

	//build left front page
	function _build_left_front(&$data) {
		$arydata['box_style'] = '';
		$arydata['title'] = "Tìm kiếm bất động sản";
		$arydata['content'] = 	$this->_build_search();	
		$data['left_area'] .= $this->obj->load->view('boxs/box', $arydata, TRUE);
		$arydata['title'] = "Hỗ trợ trực tuyến";
		$arydata['content'] = 	$this->obj->load->view('boxs/online_tpl', $data, TRUE);
		$data['left_area'] .= $this->obj->load->view('boxs/box', $arydata, TRUE);
		$arydata['title'] = "Download dữ liệu";
		$arydata['content'] = 	$this->_get_document('boxs/download_tpl', 0, 10);
		$data['left_area'] .= $this->obj->load->view('boxs/box', $arydata, TRUE);
		$arydata['title'] = 'Thời tiết - Tỷ giá';
		$arydata['content'] = $this->obj->load->view('boxs/vninfo_tpl', $data, TRUE);		//box moi nhat
		$data['left_area'] .= $this->obj->load->view('boxs/box', $arydata, TRUE);	
//		$arydata['title'] = 'Quảng cáo';
		$data['left_area'] .= $this->get_box_adv('boxs/adv_tpl', 'left', 30);
	}	
		//build box1 front page
	function _build_box1_front(&$data) {
			
		$arydata['feature'] = 	$this->_get_box_feature();
		$arydata['topnews'] = $this->_get_box_topnews();
		
		$arydata['hautruong_thoicuoc'] = $this->get_box_group1();
		$arydata['chuyenla_tt_vh_kd'] = $this->get_box_group2();
		
		$arydata['bds_ck_doanhnhan'] = $this->get_box_group3();
		
		$arydata['quangcao1'] = $this->get_box_adv('adv/quangcao1_tpl', 'quangcao1', 1);
		$arydata['quangcao2'] = $this->get_box_adv('adv/quangcao2_tpl', 'quangcao2', 1);
		
		$arydata['video'] = 	$this->obj->load->view('boxs/video_tpl',$data, TRUE);
		$data['box1_area'] .= $this->obj->load->view('boxs/box1_tpl', $arydata, TRUE);
	}
	
		//build box2 front page
	function _build_box2_front(&$data) {
		$data['box2_area'] = '';
		$arydata['giaitri_suckhoe_lamdep'] = $this->get_box_group4();
		$arydata['thegioiphunu'] = $this->_get_box_the_gioi_phu_nu();
		
		//dungbt tam thoi comment
		$arydata['thoitiet'] = $this->obj->load->view('boxs/vninfo_tpl', $data, TRUE);
		$arydata['quangcao3'] = $this->get_box_adv('adv/quangcao3_tpl', 'quangcao3', 3);
		// tin rao vip
		$filter = 'WHERE is_vip=1 ';
        $arydata['raovip'] = $this->_get_box_house_newest1('', '', $filter);
        // tin rao hot
        $filter = 'WHERE is_hot=1 ';
        $arydata['giaodichhot'] = $this->_get_box_house_newest2('', '', $filter);
		$data['box2_area'] .= $this->obj->load->view('boxs/box2_tpl', $arydata, TRUE);
	}

		//build box3 front page
	function _build_box3_front(&$data) {
		$this->obj->load->model('hs_configmodel');
		$dataConf = $this->obj->hs_configmodel->findAll();
		$arydata['congdong'] = $this->get_box_group5($dataConf[0]['number_chuyen_gd']);
		$arydata['kinhnghiem'] = $this->_get_box_kinh_nghiem($dataConf[0]['number_chiase']);
		
		$data['box3_area'] .= $this->obj->load->view('boxs/box3_tpl', $arydata, TRUE);
	}	
	
	//getSubmenu
	function getSubmenu() {
		$arydata = array();
		return $this->obj->load->view('boxs/sub_menu_tpl', $arydata, TRUE);
	}
	
		
		//build right front page
	function _build_right_front(&$data) {
		$arydata['title'] = '';
		$arydata['content'] =$this->get_box_adv('adv/adv_tpl', 'right', 30); // quang cao
		$data['right_area'] .= $this->obj->load->view('boxs/box_right', $arydata, TRUE);
	}
			//build right front raovat
	function _build_right_raovat(&$data) {
		$arydata['title'] = '';
		$arydata['content'] =$this->get_box_adv('adv/right_rv_tpl', 'right_raovat', 30); // quang cao
		$data['right_raovat'] .= $this->obj->load->view('boxs/box_right', $arydata, TRUE);
	}

	//build fooe
	function _build_footer_front(&$data){
		$data['footer_are'] = '';
		//arydata['title'] = 'Quảng cáo';
		$data['footer_are'] .= $this->get_box_adv('boxs/adv_tpl', 'bottom', 30);
		//get add scroll left right
		$data['footer_are'] .= $this->get_box_adv('boxs/scroll_adv_tpl', 'sroll_right', 30);
		$data['footer_are'] .= $this->get_box_adv('boxs/scroll_adv_left_tpl', 'sroll_left', 30);
		//get user online
		$this->show_online($data);
	}	
	//get box quang cao
	function get_box_adv($page_req, $pos, $limit) {
		global $catId, $catAdId;
		$strWhere = $catId ? " view_rule REGEXP '(^|:)$catId([^0-9]|$)' " : " view_rule REGEXP '(^|r)$catAdId([^0-9]|$)' ";

		$filter = " WHERE status_flg = 1 AND $strWhere";
		$start = 0;
		if($pos) $filter .= " AND position='$pos' ";
		
		$this->obj->load->model('ci_adsmodel');                  // Instantiate the model
		$data['ads_list'] = $this->obj->ci_adsmodel->findByFilter($filter, $start, $limit);  // Send the retrievelist msg
		
		foreach ($data['ads_list'] as $key => $ci_ads) {
			$data['ads_list'][$key]['is_flash'] = $this->is_flash($ci_ads['image']) ? true : false;
		}
//		if($pos == 'main1_level2') print_r($data['ads_list']);
		return $this->obj->load->view($page_req, $data, TRUE);
	}	
	//get document
	function _get_document($page_req, $start, $limit) {
		$data['record_list'] = $this->obj->config->item('doc_type');
		return $this->obj->load->view($page_req, $data, TRUE);
	}
	//get vip box nha dat
	function _get_vip_house_newest($start, $limit_per_page, $filter_rules = '') {
		$data = $this->_get_box_house_newest($start, $limit_per_page, $filter_rules);
		$arydata['title'] = '<span class="upper" style="text-align:left; padding-top:0px;"><b>Tin mới nhất bằng hình ảnh - Video</b></span>';
		$arydata['box_style'] = 'margin-top:5px;';
		$arydata['content'] = $this->obj->load->view('front/property/property_newest', $data, TRUE);
		return $this->obj->load->view('boxs/box', $arydata, TRUE);
	}	
	//get free box nha dat
	function _get_free_house_newest($start, $limit_per_page, $filter_rules = '') {
		$data = $this->_get_box_house_newest($start, $limit_per_page, $filter_rules);
		$arydata['title'] = '<span class="upper" style="text-align:left; padding-top:0px;"><b>Tin mới nhất rao vặt miễn phí</b></span>';
		$arydata['box_style'] = 'margin-top:5px;';
		$arydata['content'] = $this->obj->load->view('front/property/property_free_newest', $data, TRUE);
		return $this->obj->load->view('boxs/box', $arydata, TRUE);
	}
	
	function _get_box_house_newest($start, $limit_per_page = 9, $filter_rules = '') {
//		$start = 0;
		
		$this->obj->load->model('ci_propertiesmodel');
		$data['ci_properties_list'] = $this->obj->ci_propertiesmodel->findByFilter($filter_rules, $start, $limit_per_page);		
		
		//pager
		$this->obj->load->library('pagination');
		$config['total_rows']   = $this->obj->ci_propertiesmodel->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['base_url'] = base_url().'front/index';
		
		$this->obj->pagination->initialize($config);
		
		$data['page_links'] = $this->obj->pagination->create_links();
		return $data;
	}
		
	// rao vip
	function _get_box_house_newest1($start, $limit_per_page, $filter_rules = '') {
	$start = 6;
		
		
		$this->obj->load->model('ci_propertiesmodel');
		$data['ci_properties_list'] = $this->obj->ci_propertiesmodel->findByFilter($filter_rules, $start, $limit_per_page);		
		
		//pager
		$this->obj->load->library('pagination');
		
		$config['total_rows']   = $this->obj->ci_propertiesmodel->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['base_url'] = base_url().'front/index';
		
		$this->obj->pagination->initialize($config);
		
		$data['page_links'] = $this->obj->pagination->create_links();
		return $this->obj->load->view('box2/raovip_tpl', $data, TRUE);
	}	
		function _get_box_house_newest2($start, $limit_per_page, $filter_rules = '') {
	$start = 6;
		
		
		$this->obj->load->model('ci_propertiesmodel');
		$data['ci_properties_list'] = $this->obj->ci_propertiesmodel->findByFilter($filter_rules, $start, $limit_per_page);		
		
		//pager
		$this->obj->load->library('pagination');
		
		$config['total_rows']   = $this->obj->ci_propertiesmodel->table_record_count;
		$config['per_page']     = $limit_per_page;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['base_url'] = base_url().'front/index';
		
		$this->obj->pagination->initialize($config);
		
		$data['page_links'] = $this->obj->pagination->create_links();
		return $this->obj->load->view('box2/giaodichhot_tpl', $data, TRUE);
	}	
	/**
	 * get dic vu bds
	 *
	 * @param unknown_type $start
	 * @param unknown_type $limit_per_page
	 * @param unknown_type $filter_rules
	 * @return unknown
	 */
	function _get_box_news_by_type($start=0, $limit_per_page = 0, $newsType = '', $title = '', $filter_rules = '', $page_req = 'front/news/list_news') {
		
		$this->obj->load->model('ci_newsmodel');                  // Instantiate the model
		$aryNewsList = array();
		$data['page_links'] = '';
		$aryNewsList = $this->obj->ci_newsmodel->getNewsList($newsType, $catId, $start, $limit_per_page);
		$data['aryNewsList'] = $aryNewsList;
		$data['numOfNews'] = $this->obj->ci_newsmodel->table_record_count;
		$data['cid'] = $catId;
		if($limit_per_page) {
			$this->obj->load->library('pagination');
			$this->obj->load->helper('url');
			
			$config['total_rows']   = $this->obj->ci_newsmodel->table_record_count;
			$config['per_page']     = $limit_per_page;
			$config['uri_segment'] = 3;
			$config['num_links'] = 3;
			$config['base_url'] = base_url().'front/tin_tuc/'.$newsType;

			$this->obj->pagination->initialize($config);
			$data['page_links'] = $this->obj->pagination->create_links();
		}
		
		$arydata['title'] = '<span style="text-align:left; padding-top:0;"><b>'.$title.'</b></span>';
		$arydata['content'] = $this->obj->load->view($page_req, $data, TRUE);
		
        return $this->obj->load->view('boxs/box', $arydata, TRUE);
	}
	
		//get box tin noi bat (feature)
	function _get_box_feature() {
		$filter_rules = "AND show_home=1 && news_status =1 AND is_tieudiem = 1";
		$start = 0;
		$limit_per_page =5;
		$this->obj->load->model('ci_newsmodel');                  // Instantiate the model
		$aryNewsList = array();
		$aryNewsList =$this->obj->ci_newsmodel->getNewsList('', 0, $start, $limit_per_page, $filter_rules);
		
		$data['aryNewsList'] = $aryNewsList;
		return $this->obj->load->view('boxs/feature_tpl', $data, TRUE);
	}
		// Lấy tin moi nong
	function _get_box_topnews() {
		$filter_rules = " AND show_home=1 && news_status = 1";
		$start = 0;
		$limit_per_page = 10;
		$this->obj->load->model('ci_newsmodel');                  // Instantiate the model
		$aryNewsList = array();
		$aryNewsList = $this->obj->ci_newsmodel->getNewsList(0,16 , $start, $limit_per_page, $filter_rules);
		$data['aryNewsList'] = $aryNewsList;
		return $this->obj->load->view('boxs/topnews_tpl', $data, TRUE);
	}
		// BOX TRUNG TIN TUC DAU TIEN 8 CHUYEN MUC
	
	//
	/**
	 * get_box_group, lay tin tong hop 1, chuyen la, the thao, van hoa
	 *
	 * @return unknown
	 */
	function get_box_group($parrent_id, $limitCat, $limitNews) {
		$start = 0;
		$aryData = array();
		$data = array();
		
		$this->obj->load->model('nny_news_catmodel', 'catModel');
		$this->obj->load->model('ci_newsmodel'); 
		
		$filterCat = " WHERE parent_id = $parrent_id AND cat_status = 1 ";
		$filterNews = " AND show_home=1 && news_status = 1";
		$aryCatList = $this->obj->catModel->findByFilter($filterCat, $start, $limitCat);
		
		if(is_array($aryCatList) && sizeof($aryCatList)) 
		foreach ($aryCatList as $aryCat) {
			
			$data['aryNewsList'] = $this->obj->ci_newsmodel->getNewsList(0, $aryCat['cat_id'] , $start, $limitNews, $filterNews);
			$data['cat_id'] = $aryCat['cat_id'];
			$data['cat_name']= $aryCat['cat_name'];
			array_push($aryData, $data);
		}
		
		return $aryData;
	}
	
	/**
	 * get box tong hop 1: hau truong, thoi cuoc
	 *
	 * @return string
	 */
	function get_box_group1() {
		$aryData = array();
		$aryData['aryCatList'] = $this->get_box_group(43, 2, 1);
		return $this->obj->load->view('boxs/hautruong_tpl', $aryData, TRUE);
	}
	
	/**
	 * get box tong hop 2 : chuyen la, the thao, van hoa, kinh doanh...
	 *
	 * @return string
	 */
	function get_box_group2() {
		$aryData = array();
		$aryData['aryCatList'] = $this->get_box_group(42, 8, 1);
		return $this->obj->load->view('boxs/tonghop_tpl', $aryData, TRUE);
	}
	
	/**
	 * get box tong hop 3 : bds chung khoan, doanh nhan
	 *
	 * @return string
	 */
	function get_box_group3() {
		$aryData = array();
		$aryData['aryCatList'] = $this->get_box_group(44, 7, 1);
		return $this->obj->load->view('boxs/sau_chuyen_muc_tpl', $aryData, TRUE);
	}
	
	/**
	 * get box tong hop 3 : 3 chuyen muc giai tri, suc khoe, lam dep
	 *
	 * @return string
	 */
	function get_box_group4() {
		$aryData = array();
		$aryData['aryCatList'] = $this->get_box_group(45, 3, 1);
		return $this->obj->load->view('box2/ba_chuyen_muc_tpl', $aryData, TRUE);
	}
	
	/**
	 * get box tong hop 3 : 3 chuyen muc giai tri, suc khoe, lam dep
	 *
	 * @return string
	 */
	function get_box_group5($limit = 10) {
		$aryData = array();
		$aryData['aryCatList'] = $this->get_box_group(46, 2, $limit);
		return $this->obj->load->view('box3/congdongshop_tpl', $aryData, TRUE);
	}
		// Lay tin the gioi phu nu
	function _get_box_the_gioi_phu_nu(){
		$this->obj->load->model('nny_news_catmodel', 'catModel');
		$filter_rules = " AND show_home=1 && news_status = 1";
		$start = 0;
		$limit_per_page = 10;
		$this->obj->load->model('ci_newsmodel');                  // Instantiate the model
		
		$catInfo = $this->obj->catModel->getCatInfoBytId(19);

		$aryNewsList = array();
		$aryNewsList = $this->obj->ci_newsmodel->getNewsList(0,19 , $start, $limit_per_page, $filter_rules);
		$data['aryNewsList'] = $aryNewsList;
		$data['cat_name'] = $catInfo['cat_name'];
		return $this->obj->load->view('box2/thegioiphunu_tpl', $data, TRUE);
	}
				
	// Lay tin kinh nghiem
	function _get_box_kinh_nghiem($limit_per_page = 6){
		$filter_rules = " AND show_home=1 && news_status = 1";
		$start = 0;
		$this->obj->load->model('ci_newsmodel');                  // Instantiate the model
		$aryNewsList = array();
		$aryNewsList = $this->obj->ci_newsmodel->getNewsList(0,35 , $start, $limit_per_page, $filter_rules);
		$data['aryNewsList'] = $aryNewsList;
		return $this->obj->load->view('box3/kinh_nghiem_tpl', $data, TRUE);
	}
	
	//get box tin tuc moi 
	function _get_box_newest() {
		$filter_rules = " AND show_home=1 && news_status = 1";
		$start = 0;
		$limit_per_page = 8;
		
		$this->obj->load->model('ci_newsmodel');                  // Instantiate the model
		$aryNewsList = array();
		$aryNewsList = $this->obj->ci_newsmodel->getNewsList('', 0, $start, $limit_per_page, $filter_rules);
		
		$data['aryNewsList'] = $aryNewsList;
		return $this->obj->load->view('boxs/news_newest_tpl', $data, TRUE);
	}
	
	//build right area for level 2 page
	function build_right_level2(&$data) {
		
		$data['noi_dung_phai'] = '';
        
		$data['ads_main1_level2'] = $this->get_box_adv('boxs/adv_tpl', 'main1_level2', 30);
		$data['ads_right_level2'] = $this->get_box_adv('boxs/adv_tpl', 'right_level2', 30);
//		exit($data['ads_right_level2']);
        		
		$title = "";
		$filter_rules = " AND is_tieudiem = 1 AND news_status = 1 ";
		$tpl = 'boxs/tieudiem_tpl';
		$data['tieudiem'] .= $this->get_box_newest($filter_rules, $tpl, 10);
		
        $data['noi_dung_phai'] = $this->obj->load->view('right_level2', $data, true);
	}
	
	//get box tin tuc moi 
	function get_box_newest($filter_rules, $tpl, $limit, $start = 0, $order = '') {		
		$this->obj->load->model('ci_newsmodel');                  // Instantiate the model
		$filter_rules .= ' AND news_status = 1';
		$aryNewsList = array();
		$aryNewsList = $this->obj->ci_newsmodel->getNewsList('', 0, $start, $limit, $filter_rules, $order);
		
		$data['aryNewsList'] = $aryNewsList;
		return $this->obj->load->view($tpl, $data, TRUE);
	}
	
	//build box search
	function _build_search() {
				
		//province
		$this->obj->load->model('iht_province_model');
		$data['provinceOption'] = $this->obj->iht_province_model->findAll();
		$data['propertyTypeOption'] = $this->obj->config->item('property_type');
		
//		return $this->load->view('app/searchView', $data, TRUE);
		return $this->obj->load->view('boxs/search_tpl', $data, TRUE);
	}
	
	//show user online
	function show_online(&$data) {
				
		//province
		$this->obj->load->library('OnlineUsers');
		$data['totalvisit'] = $this->obj->onlineusers->total_visit();
		$data['memonline'] = $this->obj->onlineusers->total_mems();
		$data['guestonline'] = $this->obj->onlineusers->total_guests();
	}
		
	/**
	 * Checks if a URL is a Flash file
	 *
	 * @param string
	 * @return URL
	 */
   function is_flash( $url )	{
		$result = preg_match( '#\.swf$#', $url );
		return $result;
	}
	
	function cut_string($str, $length) {
		$strCut = mb_substr($str, 0, $length, 'utf-8');
		
		//add ... if str > $length 
		if(mb_strlen($str, 'utf-8') > $length) {
			$strCut = htmlspecialchars(mb_substr($strCut, 0, mb_strrpos($strCut, " ", 0, 'utf-8'), 'utf-8'));
			$strCut .= "...";
		}
		
		return $strCut;
	}
	
	//-----------------------------------------------------	Ham doi ngay thang	--------------------------------------
	function insert_translate_date($arr) {
		$time = strftime("%H:%M:%S %A, %d/%m/%y", $arr["timestamp"]); 
		$temp = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
		$tran = array('Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy','Chủ nhật');
		return str_replace($temp,$tran,$time);
	}
	function insert_exchange_date($arr){
		$temp = array(	'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday',
						'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
						);
		$tran = array('Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy','Chủ nhật',
						'tháng một', 'Tháng hai', 'Tháng ba', 'Tháng tư', 'Tháng năm', 'tháng sáu', 'Tháng bảy', 'Tháng tám', 'Tháng chín',
						'Tháng mười', 'Tháng mười một', 'Tháng mười hai'
						);	
			
		return str_replace($temp,$tran,$arr["time"]);
	}
	
	//convert viet nam co dau to khong dau
	function cv2sef($text) {

		$text= trim($text);
//		$aryRegx = array('/[ ]+/', '/[-]+/', '/[ - ]/');
//		$aryRepl = array('-', '-', '-');
//		$text= preg_replace($aryRegx, $aryRepl, $text);	
		$text = str_replace(
		array('(',')',',','“','"',' ','%','/','\\','”','?','<','>','#','^','`','‘','=','!',':' ,',,','..','*','&'  ,'__','▄'),
		array('' ,'' ,'' ,'' ,'' ,'-','' ,'' ,''  ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-','' , '' , '' , '' , '', '-' ,''  ,''),
		$text);
		
		$chars = array('a','A','e','E','o','O','u','U','i','I','d', 'D','y','Y');		
		$uni[0] = array('á','à','ạ','ả','ã','â','ấ','ầ', 'ậ','ẩ','ẫ','ă','ắ','ằ','ặ','ẳ','ẵ');
		$uni[1] = array('Á','À','Ạ','Ả','Ã','Â','Ấ','Ầ', 'Ậ','Ẩ','Ẫ','Ă','Ắ','Ằ','Ặ','Ẳ','Ẵ');
		$uni[2] = array('é','è','ẹ','ẻ','ẽ','ê','ế','ề' ,'ệ','ể','ễ');
		$uni[3] = array('É','È','Ẹ','Ẻ','Ẽ','Ê','Ế','Ề' ,'Ệ','Ể','Ễ');
		$uni[4] = array('ó','ò','ọ','ỏ','õ','ô','ố','ồ', 'ộ','ổ','ỗ','ơ','ớ','ờ','ợ','ở','ỡ');
		$uni[5] = array('Ó','Ò','Ọ','Ỏ','Õ','Ô','Ố','Ồ', 'Ộ','Ổ','Ỗ','Ơ','Ớ','Ờ','Ợ','Ở','Ỡ');
		$uni[6] = array('ú','ù','ụ','ủ','ũ','ư','ứ','ừ', 'ự','ử','ữ');
		$uni[7] = array('Ú','Ù','Ụ','Ủ','Ũ','Ư','Ứ','Ừ', 'Ự','Ử','Ữ');
		$uni[8] = array('í','ì','ị','ỉ','ĩ');
		$uni[9] = array('Í','Ì','Ị','Ỉ','Ĩ');
		$uni[10] = array('đ');
		$uni[11] = array('Đ');
		$uni[12] = array('ý','ỳ','ỵ','ỷ','ỹ');
		$uni[13] = array('Ý','Ỳ','Ỵ','Ỷ','Ỹ');		
		for($i=0; $i<=13; $i++) {
		$text = str_replace($uni[$i],$chars[$i],$text);
		}	
		return $text;
	}
}

?>
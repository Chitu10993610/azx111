<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|-----------------------------------------------------------------------------
| User Authenication Configuration
|-----------------------------------------------------------------------------
|
| 'login_expiration' = number of seconds inactive before a login expires.
| 'remember_me_life' = number of seconds a "Remember Me" cookie lasts
|
*/

$config['login_expiration'] = 3600;		// 60 minutes
$config['remember_me_life'] = 7257600;	// 12 weeks

/*
|-----------------------------------------------------------------------------
| UserAuth Mini-App configure languages
|-----------------------------------------------------------------------------
|
| Mapping browser's primary language id to language name 
| Mapping language name to a character set
| Mapping language name to language id
|
*/

// If FALSE, disables language detect & user select
$config['ua_multi_language']  = TRUE;

// Mini-App's views/template needs encoding setting

$config['ua_language_en']     = 'english';
//$config['ua_charset_english'] = 'iso-8859-1';
$config['ua_charset_english'] = 'utf-8';
$config['ua_lang_english']    = 'en';


//array permission: Application => group permission => permission
$config['ua_perm']    = array(
								"Hệ thống"	=>array(
										'Administration' 			=> array(
																'PERMISSION'=>PERMISSION,													
																//'Assign group',										
																),
										'Quản lý user' 			=> array(
																'ADD_USER'=>ADD_USER,													
																'EDIT_USER'=>EDIT_USER,													
																'DELETE_USER'=>DELETE_USER,													
																'LIST_USER'=>LIST_USER,													
																),
										'Quản lý group' 			=> array(
																'ADD_GROUP'=>ADD_GROUP,
																'EDIT_GROUP'=>EDIT_GROUP,
																'DELETE_GROUP'=>DELETE_GROUP,
																'LIST_GROUP'=>LIST_GROUP,
																'ASSIGN_GROUP'=>ASSIGN_GROUP,
																),
												),
								"Site content"=>array(
										'Quản lý News' 			=> array(
																'ADD_NEWS'=>ADD_NEWS,
																'EDIT_NEWS'=>EDIT_NEWS,
																'PUBLISH_NEWS'=>PUBLISH_NEWS,
																'DELETE_NEWS'=>DELETE_NEWS,
																'DELETE_NEWS_UNPUBLISH'=>DELETE_NEWS_UNPUBLISH,
																'VIEW_LIST_NEWS'=>VIEW_LIST_NEWS,
																'VIEW_ALL_NEWS'=>VIEW_ALL_NEWS,
																),
																
										'Quản lý tin rao' 		=> array(
																'ADD_ADS'=>ADD_ADS,
																'EDIT_ADS'=>EDIT_ADS,
																'PUBLISH_ADS'=>PUBLISH_ADS,
																'DELETE_ADS'=>DELETE_ADS,
																'DELETE_ADS_UNPUBLISH'=>DELETE_ADS_UNPUBLISH,
																'VIEW_LIST_ADS'=>VIEW_LIST_ADS,
																'VIEW_ALL_ADS'=>VIEW_ALL_ADS,
																),
							'Quản lý chuyên mục tin tức' 		=> array('ADD_CATEGORY'=>ADD_CATEGORY,
																'EDIT_CATEGORY'=>EDIT_CATEGORY,
																'DELETE_CATEGORY'=>DELETE_CATEGORY,
																'VIEW_LIST_CATEGORY'=>VIEW_LIST_CATEGORY,
																),
							'Quản lý chuyên mục tin rao' 		=> array('ADD_CATEGORY_ADS'=>ADD_CATEGORY_ADS,
																'EDIT_CATEGORY_ADS'=>EDIT_CATEGORY_ADS,
																'DELETE_CATEGORY_ADS'=>DELETE_CATEGORY_ADS,
																'VIEW_LIST_CATEGORY_ADS'=>VIEW_LIST_CATEGORY_ADS,
																),
																
										'Quản lý video' 		=> array('LIST_VIDEO'=>LIST_VIDEO,
																'ADD_VIDEO'=>ADD_VIDEO,
																'EDIT_VIDEO'=>EDIT_VIDEO,
																'DELETE_VIDEO'=>DELETE_VIDEO,
																),
										'Quản lý quảng cáo' 		=> array(
																'ADD_PROMO'=>ADD_PROMO,
																'EDIT_PROMO'=>EDIT_PROMO,
																'DELETE_PROMO'=>DELETE_PROMO,
																'VIEW_LIST_PROMO'=>VIEW_LIST_PROMO,
																),
										'Quản lý menu' 			=> array(
																'ADD_MENU'=>ADD_MENU,
																'EDIT_MENU'=>EDIT_MENU,
																'DELETE_MENU'=>DELETE_MENU,
																'VIEW_LIST_MENU'=>VIEW_LIST_MENU,
																),
										'Quản lý comment' 		=> array(
																'VIEW_COMMENT_DETAIL'=>VIEW_COMMENT_DETAIL,
																'DELETE_COMMENT'=>DELETE_COMMENT,
																'VIEW_LIST_COMMENT'=>VIEW_LIST_COMMENT,
																),
										'Quản lý contact' 		=> array(
																'VIEW_LIST_CONTACT'=>VIEW_LIST_CONTACT,
																'DELETE_CONTACT'=>DELETE_CONTACT,
																'VIEW_CONTACT_DETAIL'=>VIEW_CONTACT_DETAIL,
																),
														
										'Congfig' 		=> array(
																'CONFIG'=>CONFIG,
																),
														
								
										),
							);
							
$config['property_type'] = array(
			"1"=>"Chung cư",
			"2"=>"Biệt thự",
			"3"=>"Liền kề",
			"4"=>"Đất dự án",
			"5"=>"Đất đấu giá",
			"6"=>"Nhà mặt phố",
			"7"=>"Nhà tập thể",
			"8"=>"Nhà chia lô",
			"9"=>"Nhà trong ngõ",
			"10"=>"Đất chia lô",
			"11"=>"Đất thổ cư",
			"12"=>"Kho xưởng",
			"13"=>"BĐS khác"
		);
									
$config['property_currence'] = array(
								"1"=>"Triệu VNĐ",
								"2"=>"Tỷ VNĐ",
								"3"=>"USD",
								"4"=>"Nghìn VNĐ",

									);
							
$config['news_type'] = array(
									"news"=>"Tin tức BĐS",
									"dichvu"=>"Dịch vụ BĐS",
									"about"=>"Giới thiệu",
									"camnang"=>"Cẩm nang BĐS",
									"project"=>"Dự án BĐS",
								);
								
$config['pos_adv'] = array(
									'header'=>'Header (Tren top site)',
						//			'main'=>'Main (Ngay phia duoi menu chinh)',	
						//			'center'=>'Center (Phia duoi ban tin tuan)',	
									'left'=>'Vị trí quảng cáo của chi tiết tin',
									'right_raovat'=>'Quảng cáo rao vặt',	
									'right'=>'Right',	
									'bottom'=>'Ảnh chạy ở dưới trang',	
									'quangcao1'=>'Vị trí quảng cáo 1',
									'quangcao2'=>'Vị trí quảng cáo 2',
									'quangcao3'=>'Vị trí quảng cáo 3',
									'main1_level2'=>'Vị trí 1 trang chuyên mục',
									'right_level2'=>'Vị trí bên phải trang chuyên mục',	
);

$config['site_name'] = 'tapchiphunu.net';

$config['doc_type'] = array(
									"1"=>"Download hợp đồng mẫu",
									"2"=>"Download bảng giá đất",
									"3"=>"Download văn bản pháp luất liên quan đến BĐS",
								);

?>
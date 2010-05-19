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
										'Manage user' 			=> array(
																'ADD_USER'=>ADD_USER,													
																'EDIT_USER'=>EDIT_USER,													
																'DELETE_USER'=>DELETE_USER,													
																'LIST_USER'=>LIST_USER,													
																),
										'Manage group' 			=> array(
																'ADD_GROUP'=>ADD_GROUP,
																'EDIT_GROUP'=>EDIT_GROUP,
																'DELETE_GROUP'=>DELETE_GROUP,
																'LIST_GROUP'=>LIST_GROUP,
																'ASSIGN_GROUP'=>ASSIGN_GROUP,
																),
												),
								"Site content"=>array(
										'Manage News' 			=> array(
																'ADD_NEWS'=>ADD_NEWS,
																'EDIT_NEWS'=>EDIT_NEWS,
																'PUBLISH_NEWS'=>PUBLISH_NEWS,
																'DELETE_NEWS'=>DELETE_NEWS,
																'DELETE_NEWS_UNPUBLISH'=>DELETE_NEWS_UNPUBLISH,
																'VIEW_LIST_NEWS'=>VIEW_LIST_NEWS,
																'VIEW_ALL_NEWS'=>VIEW_ALL_NEWS,
																),
										
										'Manage News crawler' 	=> array(
																'VIEW_LIST_NEWS_CRAWLER'=>VIEW_LIST_NEWS_CRAWLER,
																'EDIT_NEWS_CRAWLER'=>EDIT_NEWS_CRAWLER,
																'DELETE_NEWS_CRAWLER'=>DELETE_NEWS_CRAWLER,
																),
										'Manage album' 		=> array('LIST_ALBUM'=>LIST_ALBUM,
																'ADD_ALBUM'=>ADD_ALBUM,
																'EDIT_ALBUM'=>EDIT_ALBUM,
																'DELETE_ALBUM'=>DELETE_ALBUM,
																'VIEW_IMAGE_ALBUM'=>VIEW_IMAGE_ALBUM,
																'ADD_IMAGE'=>ADD_IMAGE,
																'EDIT_IMAGE'=>EDIT_IMAGE,
																'DELETE_ADS'=>DELETE_ADS,
																),
										'Manage video' 		=> array('LIST_VIDEO'=>LIST_VIDEO,
																'ADD_VIDEO'=>ADD_VIDEO,
																'EDIT_VIDEO'=>EDIT_VIDEO,
																'DELETE_VIDEO'=>DELETE_VIDEO,
																),
										'Manage category' 		=> array('ADD_CATEGORY'=>ADD_CATEGORY,
																'EDIT_CATEGORY'=>EDIT_CATEGORY,
																'DELETE_CATEGORY'=>DELETE_CATEGORY,
																'VIEW_LIST_CATEGORY'=>VIEW_LIST_CATEGORY,
																),
										'Manage Ads' 			=> array(
																'ADD_ADS'=>ADD_ADS,
																'EDIT_ADS'=>EDIT_ADS,
																'DELETE_ADS'=>DELETE_ADS,
																'VIEW_LIST_ADS'=>VIEW_LIST_ADS,
																),
										'Manage menu' 			=> array(
																'ADD_POLL'=>ADD_POLL,
																'EDIT_POLL'=>EDIT_POLL,
																'DELETE_POLL'=>DELETE_POLL,
																'VIEW_LIST_POLL'=>VIEW_LIST_POLL,
																),
										'Manage comment' 		=> array(
																'VIEW_COMMENT_DETAIL'=>VIEW_COMMENT_DETAIL,
																'DELETE_COMMENT'=>DELETE_COMMENT,
																'VIEW_LIST_COMMENT'=>VIEW_LIST_COMMENT,
																),
										'Manage contact' 		=> array(
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
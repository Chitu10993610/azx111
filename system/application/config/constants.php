<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

//album images
define('IMG_NEWS_PATH', './images/news/');

//img news path
define('IMG_VIDEO_PATH', 'images/video/');
define('IMG_THUMB_VIDEO_PATH', IMG_VIDEO_PATH.'thumb/');

//permission
//news
define('VIEW_LIST_NEWS', 'Quản lý bài viết của mình');
define('VIEW_ALL_NEWS', 'Quản lý tất cả bài viết');
define('ADD_NEWS', 'Viết bài');
define('EDIT_NEWS', 'Sửa bài');
define('PUBLISH_NEWS', 'Xuất bản bài viết');
define('DELETE_NEWS_UNPUBLISH', 'Chỉ xóa bài chưa xuất bản');
define('DELETE_NEWS', 'Xóa tất cả các bài viết');
define('VIEW_LIST_CATEGORY', 'List danh mục');
define('ADD_CATEGORY', 'Thêm danh mục');
define('EDIT_CATEGORY', 'Sửa danh mục');
define('DELETE_CATEGORY', 'Xóa danh mục');

//ads
define('VIEW_LIST_ADS', 'Quản lý tin rao của mình');
define('VIEW_ALL_ADS', 'Quản lý tất cả tin rao');
define('ADD_ADS', 'Đăng tin');
define('EDIT_ADS', 'Sửa tin');
define('PUBLISH_ADS', 'Xuất bản tin rao');
define('DELETE_ADS_UNPUBLISH', 'Chỉ xóa tin chưa xuất bản');
define('DELETE_ADS', 'Xóa tất cả tin rao');
define('VIEW_LIST_CATEGORY_ADS', 'List danh mục tin rao');
define('ADD_CATEGORY_ADS', 'Thêm danh mục tin rao');
define('EDIT_CATEGORY_ADS', 'Sửa danh mục tin rao');
define('DELETE_CATEGORY_ADS', 'Xóa danh mục tin rao');

//ads
define('ADD_PROMO', 'Tạo quảng cáo');
define('EDIT_PROMO', 'Sửa quảng cáo');
define('DELETE_PROMO', 'Xóa quảng cáo');
define('VIEW_LIST_PROMO', 'List quảng cáo');

//poll
define('VIEW_LIST_POLL', 'List thăm dò');
define('ADD_POLL', 'Thêm mới thăm dò');
define('EDIT_POLL', 'Sửa thăm dò');
define('DELETE_POLL', 'Xóa thăm dò');

//menu
define('VIEW_LIST_MENU', 'List menu');
define('ADD_MENU', 'Thêm mới menu');
define('EDIT_MENU', 'Sửa menu');
define('DELETE_MENU', 'Xóa menu');

//comment
define('VIEW_LIST_COMMENT', 'List bình luận');
define('VIEW_COMMENT_DETAIL', 'Xem chi tiết bình luận');
define('DELETE_COMMENT', 'Xóa bình luận');

//comment
define('VIEW_LIST_CONTACT', 'List liên hệ');
define('VIEW_CONTACT_DETAIL', 'Xem chi tiết liên hệ');
define('DELETE_CONTACT', 'Xóa liên hệ');

//news crawler
define('VIEW_LIST_NEWS_CRAWLER', 'List tin crawler');
define('EDIT_NEWS_CRAWLER', 'Sửa tin crawler');
define('DELETE_NEWS_CRAWLER', 'Xóa tin crawler');

//user
define('LIST_USER', 'List user');
define('ADD_USER', 'Thêm mới user');
define('EDIT_USER', 'Sửa user');
define('DELETE_USER', 'Xóa user');

//user group
define('LIST_GROUP', 'List nhóm user');
define('ADD_GROUP', 'Thêm mới nhóm user');
define('EDIT_GROUP', 'Sửa nhóm user');
define('DELETE_GROUP', 'Xóa nhóm user');
define('ASSIGN_GROUP', 'Phân nhóm user');
define('PERMISSION', 'Phân quyền');

//images
define('LIST_ALBUM', 'List album');
define('ADD_ALBUM', 'Thêm mới album');
define('EDIT_ALBUM', 'Sửa album');
define('DELETE_ALBUM', 'Xóa album');
define('VIEW_IMAGE_ALBUM', 'Xem ảnh của album');
define('ADD_IMAGE', 'Thêm ảnh');
define('EDIT_IMAGE', 'Sửa ảnh');
define('DELETE_IMAGE', 'Xóa ảnh');

//video
define('LIST_VIDEO', 'List video');
define('ADD_VIDEO', 'Thêm mới video');
define('EDIT_VIDEO', 'Sửa video');
define('DELETE_VIDEO', 'Xóa video');

//config
define('CONFIG', 'Cấu hình hệ thống');

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */
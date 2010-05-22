<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	www.your-site.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://www.codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you se t a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.
|
*/

$route['default_controller'] = 'front';
$route['scaffolding_trigger'] = 'scaffoldingtakeout';

// Define your own routes below -------------------------------------------

// route documents from view/pages folder
//chi tiet nha dat
$route['front'] = 'front/nhaban';
$route['front/:num'] = 'front/detail';
$route['front/:num/:any'] = 'front/detail';
//end chi tiet nha dat 

//chi tiet tin rao
$route['tin-rao/:num/:num'] = 'front/detail';
$route['tin-rao/:num/:num/:any'] = 'front/detail';

//danh muc tin rao
$route['tin-rao'] = 'front/tin_rao';
$route['tin-rao/:num'] = 'front/tin_rao';
$route['tin-rao/:num/:any'] = 'front/tin_rao';
//end chi tiet nha dat 

//chi tiet tin tuc
$route['tin-tuc/:num/:num'] = 'front/news';
$route['tin-tuc/:num/:num/:any'] = 'front/news';

//danh muc
$route['tin-tuc'] = 'front/tin_tuc';
$route['tin-tuc/:num'] = 'front/tin_tuc';
$route['tin-tuc/:num/:any'] = 'front/tin_tuc';
//end chi tiet tin tuc

$route['config/:any'] = 'config/modify';
$route['my-info'] = 'admin/usergroups/myInfo';
$route['dang-ky'] = 'front/register';
$route['myadmin'] = 'user/login';
$route['quan-ly-tin-rv'] = 'properties';
$route['quan-ly-tin'] = 'news/browse';
$route['dang-tin'] = 'properties/add';
$route['cau-hinh'] = 'config/modify';
$route['file-manage'] = 'iht_upload';
$route['upload'] = 'iht_upload/add';
//$route['gioi-thieu'] = 'front/gioi_thieu';
//$route['gioi-thieu'] = 'front/tin_tuc/about';
?>
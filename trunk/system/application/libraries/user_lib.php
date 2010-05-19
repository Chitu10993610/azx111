<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class user_lib {
	/**
	 * contruction
	 *
	 * @param unknown_type
	 */
	public function __construct() {
		$this->obj =& get_instance();
	}
   
   function _clear_user_form() {
		$data['groupid'] 			= '';
		$data['userid']			= '';
		$data['username']		= '';
		$data['fullname']		= '';
		$data['email']			= '';
		$data['password']		= '';
		$data['lastlogin']		= '';
		$data['enabled']		= '';
		$data['site_id']		= '';
		$data['phone']			= '';
		$data['address']		= '';
		$data['mobile_phone']	= '';
		$data['create_date']	= '';
		$data['edit_date']		= '';
		$data['last_login']		= '';
		$data['birthday']		= '';
		$data['information']	= '';
		$data['type']			= '';

      return $data;

   }
   
   	public  function showListLang($def_lang = 'vi', $class='list_lang') {
		$this->obj->load->model('ci_languagesmodel');
		$aryLangs = $this->obj->ci_languagesmodel->findAll();
		
		$str = '<select onchange="submit();" class="'.$class.'" name="lang_id">';
		foreach ($aryLangs as $lang) {
			$selected = ($lang['code'] == $def_lang) ? 'selected="selected"' : '';
			$str .= '<option value="'.$lang['code'].'" '.$selected.'>'.$lang['name'].'</option>';
		}
		
		$str .= '</select>';
		
		return $str;
	}
}

?>
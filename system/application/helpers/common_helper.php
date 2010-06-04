<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * check permission of login user
 *
 * @param string $perm
 */function access($perm, $redirect = false, $redirect_uri = 'user/auth_error') {
		$result = false;
		$result = ($_SESSION['userdata']['userid'] == 1 || (is_array($_SESSION['userdata']['perm']) && in_array($perm, $_SESSION['userdata']['perm'])));
		if(!$result && $redirect) {
			redirect($redirect_uri); 
			exit;
		}
		else return $result;
 }
 
 /**
 * format number by price
 *
 * @param int number
 */
 function price_format($number) {
		return trim(trim(number_format($number, 3, ',', '.'), '0'), ',');
 }
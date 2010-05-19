<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * check permission of login user
 *
 * @param string $perm
 */function access($perm) {
		return ($_SESSION['userdata']['userid'] == 1 || (is_array($_SESSION['userdata']['perm']) && in_array($perm, $_SESSION['userdata']['perm'])));
 }
<?php
session_start();
if($_SESSION['userdata']['groupid'] == 1 || $_SESSION['userdata']['groupid'] == 2) {
		
//	global $base_dir;
if(isset($_GET['f'])) {
	$_SESSION['base_dir'] = ($_GET['f'])? $_GET['f'] : 'common';
}
//	echo $base_dir;
	require_once('config_admin.inc.php');
}
else {
	require_once('config_common.inc.php');
}
?>
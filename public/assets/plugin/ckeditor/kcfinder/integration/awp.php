<?php
/* echo '<pre>';
print_r($_SERVER);
echo '</pre>';
echo '<pre>'; */
/*
print_r($_COOKIE);
echo '</pre>'; */
//echo dirname($_SERVER['SCRIPT_FILENAME']);
//echo '<br>';

 $sas_path = dirname(dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))));
define("uploadPath",$sas_path );

//ECHO uploadPath.'/editor/';
//echo $_SERVER['DOCUMENT_URI'];

/* require $sas_path.'/config/config.php';
require $sas_path.'/constants.php';
require $sas_path.'/load.php';
 */
//$sas = new system;

function checkAuth() {
	
	//if($sas->auth->admin()){

		if(!isset($_SESSION['KCFINDER']['disabled'])) {
			$_SESSION['KCFINDER']['disabled'] = false;
		}
		$_SESSION['KCFINDER']['_check4htaccess'] = false;
		$_SESSION['KCFINDER']['uploadURL'] = $_SERVER['SERVER_NAME'].'/assets/editor/';
		$_SESSION['KCFINDER']['uploadDir'] = uploadPath.'/editor/';
		$_SESSION['KCFINDER']['theme'] = 'default';
	//}
	//else{
	//	@$_SESSION['KCFINDER'] = array();
	//}
}
 checkAuth();
 /* echo '<pre>';
 print_r(checkAuth());
 exit();  */

?>
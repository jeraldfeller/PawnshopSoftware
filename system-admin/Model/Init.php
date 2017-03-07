<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
session_start();
define('DB_USER_MAIN', 'cashmax229');
define('DB_PWD_MAIN', 'Pawn4223626');
define('DB_NAME_MAIN', 'pawnshop_db_main');
define('DB_HOST_MAIN', 'localhost');
define('DB_DSN_MAIN', 'mysql:host=' . DB_HOST_MAIN . ';dbname=' . DB_NAME_MAIN .'');
define('SERVER_ROOT_MAIN', $_SERVER['DOCUMENT_ROOT']);
define('HOST', 'http://correllsoftware.com/');
date_default_timezone_set('America/New_York');

 if (isset($_SESSION['systemadmin_login']) && $_SESSION['systemadmin_login']) {
	 $USER = 'System Admin';
 }else{
	 Header('Location: login');
 }

 

?> 
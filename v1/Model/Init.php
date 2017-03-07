<?php
ob_start();
session_start();
date_default_timezone_set('America/New_York');
header("Access-Control-Allow-Origin: *");
if (isset($_SESSION['company_login']) && $_SESSION['company_login'] != null) {

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    define('DB_USER', 'cashmax229');
    define('DB_PWD', 'Pawn4223626');
    define('DB_NAME', $_SESSION['company']['db']);
    define('DB_HOST', 'localhost');
    define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME .'');

    DEFINE('ROOT', 'http://app.correllsoftware.com/');
    DEFINE('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT']);
    DEFINE('PATH', '');
    DEFINE('VERSION', $_SESSION['company']['version']);
	$host = ROOT;

    if (isset($_SESSION['login']) && $_SESSION['login']) {

		$userType = $_SESSION['user_name']['type'];
        $user_name = $_SESSION['user_name']['user_name'];
        $user_full_name = $_SESSION['user_name']['first_name'] . ' ' . $_SESSION['user_name']['last_name'];
        $customer_page = $_SESSION['user_name']['customer_page'];
        $general_page = $_SESSION['user_name']['general_pawn_page'];
        $title_page = $_SESSION['user_name']['title_pawn_page'];
        $scrap_page = $_SESSION['user_name']['scrap_page'];
        $repair_page = $_SESSION['user_name']['repair_page'];
        $refill_page = $_SESSION['user_name']['refill_page'];
        $rto_page = $_SESSION['user_name']['rto_page'];
        $inventory_page = $_SESSION['user_name']['inventory_page'];
        $outright_page = $_SESSION['user_name']['outright_page'];
        $pos_page = $_SESSION['user_name']['pos_page'];
        $check_page = $_SESSION['user_name']['check_page'];
        $petty_page = $_SESSION['user_name']['petty_page'];
        $void_page = $_SESSION['user_name']['void_page'];
        $layaway_page = $_SESSION['user_name']['layaway_page'];

        $log_status = $_SESSION['user_name']['log_status'];
        $USER_ID = $_SESSION['user_name']['id'];


    } else {
       Header('Location:  ' . $host . '');
    }


}else{
   Header('Location:  http://app.correllsoftware.com/');
}





?>

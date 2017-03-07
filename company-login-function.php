<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'Model/Init.php';
require 'includes/require.php';

$companyUserClass = new CompanyUsers();

// check to see if login
if (isset($_POST['data'])) {
// take security precautions: filter all incoming data!
	$companyId =  (isset($_POST['data']['comp_id'])) 		? strip_tags($_POST['data']['comp_id']) 		: '';
    $user_name 		= (isset($_POST['data']['user_name'])) 		? strip_tags($_POST['data']['user_name']) 		: '';
    $password 	= (isset($_POST['data']['password'])) 	? strip_tags($_POST['data']['password']) 	: '';
	
	var_dump($companyId);
	var_dump($user_name);
	var_dump($password);
    if ($companyId && $user_name && $password) {
        $result = $companyUserClass->companyLoginByAccountNo($companyId);
        if ($result) {
// store user info in session
            $_SESSION['company'] = $result;
            $_SESSION['company_login'] = TRUE;
		
            Header('Location: ' . $result['version'] . '/login-function?user_login=' . $user_name . '&pass_login=' . $password . '');
// redirect back home
        } else {
            $_SESSION['login'] = FALSE;
            Header('Location: login.php?msg=Login failed');

        }

        exit;
    }
	
}



?>
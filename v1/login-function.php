<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'Model/Init.php';
require 'includes/require.php';

$userTable = new Users();

// check to see if login

// take security precautions: filter all incoming data!
    $user_name 		= (isset($_GET['user_login'])) 	? strip_tags($_GET['user_login']) 		: '';
    $password 	= (isset($_GET['pass_login'])) 	? strip_tags($_GET['pass_login']) 	: '';


    if ($user_name && $password) {
        $result = $userTable->loginByName($user_name, $password);
        if ($result) {
// store user info in session
            $_SESSION['user_name'] = $result;
            $_SESSION['login'] = TRUE;
            Header('Location: index');
// redirect back home
        } else {
            $_SESSION['login'] = FALSE;
			
			var_dump($result);
            Header('Location: login?msg=Login failed');

        }

        exit;
    }




?>
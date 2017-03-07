<?php
require ('Model/Init.php');
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';


$userTable = new Users();

$userTable->logout();


?>
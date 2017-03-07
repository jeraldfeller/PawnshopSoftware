<?php
require ('Model/Init.php');
require  SERVER_ROOT_MAIN . '/includes/require.php';


$companyUserClass = new CompanyUsers();

$companyUserClass->logout();


?>
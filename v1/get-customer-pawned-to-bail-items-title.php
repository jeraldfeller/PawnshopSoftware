<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';




$data = $_POST['data'];
$split = explode("|", $data);
$data = $split[0];
$type = $split[1];

$employeeClass = new Employee();



$title_items = $employeeClass->getCustomerTitlePawnedItems($data);

$view = new View();


echo $view->displayCustomerTitlePawnedItems($title_items[0]);




?>



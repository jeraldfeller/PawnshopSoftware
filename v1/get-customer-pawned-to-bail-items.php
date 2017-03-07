<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';




$data = $_POST['data'];
$split = explode("|", $data);
$data = $split[0];
$type = $split[1];

$employeeClass = new Employee();

$pawns = $employeeClass->getCustomerPawns($data);


$view = new View();


echo $view->displayCustomerPawnedItems($pawns);



?>



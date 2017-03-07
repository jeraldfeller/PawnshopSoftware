<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';

if (isset($_GET['status'])){
	$status= $_GET['status'];
}
else {
	$status = '';
}
$data = $_POST['data'];

$employeeClass = new Employee();
$item = $employeeClass->getPawnItemTmp($data, $status);

$view = new View();
if($status == 'pending')
{
	echo $view->displayPawnedItemTmp($item);
}
else {
	echo $view->displayAddedItemTmp($item);
}


?>



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
$item = $employeeClass->getOutrightItemTmp($data, $status);

$view = new View();
if($status == 'pending')
{
	echo $view->displayOutrightItemTmp($item);
}
else {
	echo $view->displayOutrightAddedItemTmp($item);
}

?>



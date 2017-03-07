<?php
error_reporting(0);
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';




$data = $_POST['data'];
if ($data == null || $data == ' ')
{
	$id = 0;
}
else{
$split = explode("-", $data);
$id = $split[1];
}

$cid = 0;
$employeeClass = new Employee();

$employeeClass->removeTmpPawnItems($id);
$employeeClass->removeTmpOutrigtItems($id);
$employeeClass->removeAddedParts($id);
$employeeClass->removeAddedScrap($id);

$customer = $employeeClass->getCustomerByInfo($id);

$view = new View();

	
echo $view->displayCustomerInfo($customer);


?>



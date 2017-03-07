<?php
error_reporting(0);
require ('Model/Init.php');
require ('Model/Employee.php');
require ('View/View.php');




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

$customer = $employeeClass->getCustomerByInfo($id);
$pawns = $employeeClass->getCustomerByIdDash($id);
$title_pawns = $employeeClass->getCustomerByIdTitlePawnDisplay($id);
$repairs = $employeeClass->getCustomerByIdRepair($id);
$refills = $employeeClass->getCustomerByIdRefills($id);
$rto = $employeeClass->getCustomerByIdRTODisplay($id);
$pos = $employeeClass->getCustomerByIdPOS($id);
$notes = $employeeClass->getCustomerByIdNotes($id);


$view = new View();

echo $view->displayViewCustomer($customer, $pawns, $title_pawns, $repairs, $refills, $rto, $pos, $notes);



?>



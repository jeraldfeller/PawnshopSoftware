<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';



$data = $_POST['data'];
if ($data == null || $data == ' ')
{
    $id = 1;
}
else{
    $split = explode("-", $data);
    $id = $split[1];
}



$employeeClass = new Employee();
$customer = $employeeClass->getCustomerByIdLayawayDisplay($id);

$view = new View();


echo $view->displayCustomerLayaway($customer);



?>



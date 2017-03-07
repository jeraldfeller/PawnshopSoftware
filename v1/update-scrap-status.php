<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';



$data = $_POST['data'];
$split = explode('|', $data);
$id = $split[0];
$status = $split[1];


$employeeClass = new Employee();
$view = new View();
$employeeClass->updateScrapStatus($id, $status);
$scrap = $employeeClass->getAllScrapItem('hold');

echo $view->displayScrapInventory($scrap, 'hold');

?>


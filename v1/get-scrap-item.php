<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';



$data = $_POST['data'];

$employeeClass = new Employee();
$view = new View();
$scrap = $employeeClass->getAllScrapItem($data);

echo $view->displayScrapInventory($scrap, 'hold');

?>


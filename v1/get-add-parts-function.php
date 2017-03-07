<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';


$data = $_POST['data'];

$employeeClass = new Employee();
$item = $employeeClass->getAddParts($data);

$view = new View();

echo $view->displayAddedParts($item);
?>



<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';




$employeeTable = new Employee();



$data = $_POST['data'];
$split = explode('|', $data);

$id = $split[0];
$status = $split[1];

$employeeTable->repoPawn($id, $status);


?>


<?php
require 'Model/Init.php';
require 'includes/require.php';




$employeeTable = new Employee();



$data = $_POST['data'];
$split = explode('|', $data);

$id = $split[0];
$title = $split[1];

$employeeTable->closePawn($id, $title);








?>


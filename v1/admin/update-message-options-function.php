<?php
require '../Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';



$data = $_POST['data'];

$split = explode("|", $data);
$mId = $split[0];
$bool = $split[1];


$adminClass = new Admin();
$adminClass->updateActivePreNotification($mId, $bool);
?>


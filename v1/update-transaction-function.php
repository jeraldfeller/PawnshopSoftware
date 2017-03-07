<?php
require ('Model/Init.php');
require ('Model/Employee.php');


$adminClass = new Employee();


if($_GET['type'] == 'transaction'){

    $data = $_POST['data'];
    $split = explode('|', $data);
    $id = $split[0];
    $state = $split[1];
    $type = $split[2];
    $cid = $split[3];
    $reason = $split[4];
    $adminClass->updateTransactionStatus($id, $state, $type, $cid, $reason);

}
else if($_GET['type'] == 'payment'){

    $data = $_POST['data'];
    $split = explode('|', $data);
    $id = $split[0];
    $state = $split[1];
    $type = $split[2];
    $cid = $split[3];
    $reason = $split[4];
    $amount = $split[5];
    $interest = $split[6];
    $transaction_type = $split[7];
    $tid = $split[8];
    $due = $split[9];
    $adminClass->updateTransactionStatusPayment($id, $state, $type, $cid, $reason, $amount, $interest, $transaction_type, $tid, $due);

}






?>



<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';

$employeeClass = new Employee();
$view = new View();


$data  = $_POST['data'];
$split = explode("|", $data);
$item_id = $split[0];
$item_name = $split[1];
$id = $split[2];
$page = $split[3];

$employeeClass->removeItems($item_id, $item_name, $page);

if ($page == 'add-pawn') {
    $item = $employeeClass->getPawnItemTmp($id, 'pending');
    echo $view->displayAddedItemTmp($item);
}

if ($page == 'buy-item-outright'){
    $item = $employeeClass->getOutrightItemTmp($id, 'pending');
    echo $view->displayOutrightAddedItemTmp($item);

}

if ($page == 'repair-invoice'){
    $item = $employeeClass->getAddParts($id);
    echo $view->displayAddedParts($item);

}

if ($page == 'scrap-buying'){
    $item = $employeeClass->getScrapItemTmp($id);
    echo $view->displayScrapAddedItemTmp($item);

}






?>


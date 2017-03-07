<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';


$employeeClass = new Employee();

$items = $_POST['choice'];
$quantity = $_POST['quantity'];
$customer_id = $_POST['customerId'];
$c_id = $_POST['customer_id'];
$sub_total = $_POST['sub_total'];
$sub_total = str_replace(',','', '' . $sub_total . '');
$tax = $_POST['tax'];
$total = $_POST['total'];
$total = str_replace(',','', '' . $total . '');
$payment = $_POST['payment'];
$date_added = $_POST['date_added'];

$count = $_POST['count'];

if(isset($_POST['submit'])) {


    $last_id = $employeeClass->addVehicleSale($c_id, $sub_total, $tax, $total, $payment, 'sold', $date_added);

    for($i = 1; $i <= $count; $i++){
        $lastId[] = $last_id;
    }

    $values = array_map(function ($customer_id, $items, $quantity, $lastId) {
        return "('$customer_id', '$items', '$quantity', '$lastId')";
    }, array_map('stripcslashes', $customer_id), array_map('stripcslashes', $items), array_map('stripcslashes', $quantity), array_map('stripcslashes', $lastId));

    $employeeClass->addVehicleSoldItem($values);

    foreach ($items as $key => $value) {
        $item_no = $value;
        $qty = $quantity[$key];
        $employeeClass->updateVehicleItemQuantity($item_no, $qty);
    }


    $query = array('customer_id' => $c_id,
        'sale_id' => $last_id);


    header('Location: print-vehicle-sale-ticket.php?' . http_build_query($query));
    exit;
}


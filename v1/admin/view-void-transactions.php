<?php
require '../Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Void Transactions';

$employeeClass = new Employee();
$adminClass = new Admin();
$view = new adminView();

$cur_date = date('Y-m-d');

if(isset($_POST['submit'])){

    $from_d = $_POST['from'];
    $timestamp = DateTime::createFromFormat('m/d/Y', $from_d);
    $from = $timestamp->format('Y-m-d');

    $to_d = $to = $_POST['to'];
    $timestamp = DateTime::createFromFormat('m/d/Y', $to_d);
    $to = $timestamp->format('Y-m-d');


}
else{
    $from = date('Y-m-01', strtotime($cur_date));
    $timestamp = DateTime::createFromFormat('Y-m-d', $from);
    $from_d = $timestamp->format('m/d/Y');
    $to = date('Y-m-t', strtotime($cur_date));
    $timestamp = DateTime::createFromFormat('Y-m-d', $to);
    $to_d = $timestamp->format('m/d/Y');
}


// Admin
$pawns = $adminClass->getGeneralPawnsByMonthVoid($from, $to);
$pawn_payment = $adminClass->getGeneralPawnsPaymentByMonthVoid($from, $to);
$forfeited_pawns = $adminClass->getForfeitedGeneralPawnsByMonthVoid($from, $to);
$title_pawns = $adminClass->getTitlePawnsByMonthVoid($from, $to); 
$title_payment = $adminClass->getTitlePawnsPaymentByMonthVoid($from, $to);
$pos = $adminClass->getPointOfSaleByMonthVoid($from, $to);
$repair = $adminClass->getRepairInvoiceByMonthVoid($from, $to);
$refill = $adminClass->getRefillByMonthVoid($from, $to);
$rto = $adminClass->getRTOByMonthVoid($from, $to);
$layaway = $adminClass->getLayawayByMonthVoid($from, $to);
$layaway_payment = $adminClass->getLayawayPaymentByMonthVoid($from, $to);
$scrap = $adminClass->getScrapByMonthVoid($from, $to);






require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-gear"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Void Transactions</li>
                                </ul>
                                <h4>Void Transactions</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                        <div class="row">


                             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <div class="col-lg-3">

                                    <div class="input-group">
                                            <span class="input-group-addon">From</span>
                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker_from" value="<?php echo $from_d; ?>" name="from">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="input-group">
                                            <span class="input-group-addon">To</span>
                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker_to" value="<?php echo $to_d; ?>" name="to">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-group">
                                            <button style="height: 40px;" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>



                                </form>

                            </div>

                        <div class="row">

                            <div class="col-md-12">
                            <!-- Nav tabs -->
							
                                <ul class="nav nav-tabs nav-line">
                                    <li class="active"><a href="#general-pawns" data-toggle="tab"><strong>General Pawns</strong></a></li>
                                    <li><a href="#title-pawns" data-toggle="tab"><strong>Title Pawns</strong></a></li>
                                    <li><a href="#point_of_sale" data-toggle="tab"><strong>Point of Sale</strong></a></li>
                                    <li><a href="#repair" data-toggle="tab"><strong>Repair Order/Invoice</strong></a></li>
                                    <li><a href="#refill" data-toggle="tab"><strong>Wireless Refill Pin</strong></a></li>
                                    <li><a href="#rto" data-toggle="tab"><strong>RTO</strong></a></li>
                                    <li><a href="#layaway" data-toggle="tab"><strong>Layaway</strong></a></li>
                                    <li><a href="#scrap" data-toggle="tab"><strong>Scrap</strong></a></li>
                                </ul>

                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="general-pawns">
                                        <ul class="nav nav-tabs nav-line">
                                            <li class="active"><a href="#general_pawns_second_level" data-toggle="tab">Pawns</a></li>
                                            <li><a href="#general_pawn_payments" data-toggle="tab">Payments</a></li>
											<li><a href="#general_pawn_forfeit" data-toggle="tab">Forfeited Pawns</a></li>
                                        </ul>
                                             <div class="tab-content nopadding noborder">
                                                    <div id="general_pawns_second_level" class="tab-pane active">
                                                     <table class="table table-hover table-primary mb30">
                                                        <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Item Description</th>
                                                            <th>Loan Matrix</th>
                                                            <th>Loan Amount</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php

                                                                foreach($pawns as $row){


                                                                    echo '<tr>';
                                                                    echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                    $customer_id = $row['customer_id'];
                                                                    $loan_id = $row['loan_info_id'];

                                                                    $items = $employeeClass->getCustomerPawnedItemsPop($customer_id, $loan_id);
                                                                    echo '<td>';

                                                                    foreach($items as $item){
                                                                        echo $item['item_description'] . ',';

                                                                    }
                                                                    $v = array_map('array_pop' , $items);
                                                                    $x = implode(',', $v);
                                                                    echo '</td>';
                                                                    echo '<td>' . $row['title'] . '</td>';
                                                                    echo '<td>$' . number_format($row['loan_amount'], 2) . '</td>';
                                                                    echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                                    echo '<td>' . $row['void_reason'] . '</td>';
                                                                    echo '</tr>';


                                                                }

                                                            ?>
                                                        </tbody>

                                                    </table>
                                                    </div>

                                                    <div id="general_pawn_payments" class="tab-pane">
                                                    <table class="table table-hover table-primary mb30">
                                                        <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Item Description</th>
                                                            <th>Loan Amount</th>
                                                            <th>Amount Paid</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>

                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $i = 0;
                                                            foreach($pawn_payment as $row){


                                                                $status = $row['status'];
                                                                if($status == 'void'){
                                                                    $disabled = 'disabled';
                                                                }
                                                                else{

                                                                    $disabled = '';

                                                                }

                                                                echo '<tr>';
                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                $customer_id = $row['customer_id'];
                                                                $loan_id = $row['loan_info_id'];

                                                                $items = $employeeClass->getCustomerPawnedItemsPop($customer_id, $loan_id);
                                                                echo '<td>';

                                                                foreach($items as $item){
                                                                    echo $item['item_description'] . ',';

                                                                }
                                                                $v = array_map('array_pop' , $items);
                                                                $x = implode(',', $v);
                                                                echo '</td>';
                                                                echo '<td>$' . number_format($row['loan_amount'], 2) . '</td>';
                                                                echo '<td>$' . number_format($row['total_amount'], 2) . '</td>';
                                                                echo '<td>' . date('m/d/Y', strtotime($row['datePaid'])) . '</td>' . PHP_EOL;
                                                                echo '<td>' . $row['void_reason'] . '</td>';

                                                                echo '</tr>';

                                                                $i++;
                                                            }

                                                            ?>
                                                        </tbody>

                                                    </table>
                                                    </div>
													
													<div id="general_pawn_forfeit" class="tab-pane">
                                                     <table class="table table-hover table-primary mb30">
                                                        <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Item Description</th>
                                                            <th>Loan Matrix</th>
                                                            <th>Loan Amount</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php

                                                                foreach($forfeited_pawns as $row){


                                                                    echo '<tr>';
                                                                    echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                    $customer_id = $row['customer_id'];
                                                                    $loan_id = $row['loan_info_id'];

                                                                    $items = $employeeClass->getCustomerPawnedItemsPop($customer_id, $loan_id);
                                                                    echo '<td>';

                                                                    foreach($items as $item){
                                                                        echo $item['item_description'] . ',';

                                                                    }
                                                                    $v = array_map('array_pop' , $items);
                                                                    $x = implode(',', $v);
                                                                    echo '</td>';
                                                                    echo '<td>' . $row['title'] . '</td>';
                                                                    echo '<td>$' . number_format($row['loan_amount'], 2) . '</td>';
                                                                    echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                                    echo '<td>' . $row['void_reason'] . '</td>';
                                                                    echo '</tr>';


                                                                }

                                                            ?>
                                                        </tbody>

                                                    </table>
                                                    </div>

                                        </div>
                                    </div>

                                   <div class="tab-pane" id="title-pawns">
                                        <ul class="nav nav-tabs nav-line">
                                            <li class="active"><a href="#title_pawns_second_level" data-toggle="tab">Pawns</a></li>
                                                <li><a href="#title_pawn_payments" data-toggle="tab">Payments</a></li>
                                        </ul>
                                             <div class="tab-content nopadding noborder">
                                                    <div id="title_pawns_second_level" class="tab-pane active">
                                                     <table class="table table-hover table-primary mb30">
                                                        <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Vin #</th>
                                                            <th>Year</th>
                                                            <th>Model</th>
                                                            <th>Title #</th>
                                                            <th>Loan Matrix</th>
                                                            <th>Loan Amount</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php

                                                            foreach($title_pawns as $row){

                                                                echo '<tr>';
                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                echo '<td>' . $row['vin_no'] . '</td>';
                                                                echo '<td>' . $row['year'] . '</td>';
                                                                echo '<td>' . $row['model'] . '</td>';
                                                                echo '<td>' . $row['title_no'] . '</td>';
                                                                echo '<td>' . $row['title'] . '</td>';
                                                                echo '<td>' . $row['total_loan_amount'] . '</td>';
                                                                echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                                echo '<td>' . $row['void_reason'] . '</td>';
                                                                echo '</tr>';


                                                            }


                                                            ?>
                                                        </tbody>

                                                    </table>
                                                    </div>

                                                    <div id="title_pawn_payments" class="tab-pane">
                                                    <table class="table table-hover table-primary mb30">
                                                        <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Vin #</th>
                                                            <th>Year</th>
                                                            <th>Model</th>
                                                            <th>Title #</th>
                                                            <th>Loan Amount</th>
                                                            <th>Amount Paid</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>

                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $i = 0;
                                                            foreach($title_payment as $row){


                                                                $status = $row['status'];
                                                                if($status == 'void'){
                                                                    $disabled = 'disabled';
                                                                }
                                                                else{

                                                                    $disabled = '';

                                                                }

                                                                echo '<tr>';
                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                echo '<td>' . $row['vin_no'] . '</td>';
                                                                echo '<td>' . $row['year'] . '</td>';
                                                                echo '<td>' . $row['model'] . '</td>';
                                                                echo '<td>' . $row['title_no'] . '</td>';
                                                                echo '<td>$' . number_format($row['total_loan_amount'], 2) . '</td>';
                                                                echo '<td>$' . number_format($row['total_amount'], 2) . '</td>';
                                                                echo '<td>' . date('m/d/Y', strtotime($row['datePaid'])) . '</td>' . PHP_EOL;
                                                                echo '<td>' . $row['void_reason'] . '</td>';
                                                                echo '</tr>';

                                                                $i++;
                                                            }

                                                            ?>
                                                        </tbody>

                                                    </table>
                                                    </div>


                                        </div>
                                    </div>


                                    <div class="tab-pane" id="point_of_sale">
                                        <table class="table table-hover table-primary mb30">
                                            <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Item Description</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                                <th>Reason</th>
                                            </tr>
                                            </thead>
                                                        <tbody>
                                                        <?php
                                                $i = 0;
                                                foreach($pos as $row){


                                                    $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];


                                                    echo '<tr>';
                                                    echo '<td>' . $full_name . '</td>';

                                                    echo '</td>';
                                                    $customer_id = $row['customer_id'];
                                                    $sale_id = $row['sale_id'];
                                                    $items = $adminClass->getCustomerPOSItemsVoid($customer_id, $sale_id);


                                                    echo '<td>';
                                                    foreach($items as $row){
                                                        echo $row['description'] . '(' . $row['quantity'] . '),';


                                                    }
                                                    echo '</td>';
                                                    echo '<td>$' . $row['total'] . '</td>';
                                                    echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                    echo '<td>' . $row['void_reason'] . '</td>';
                                                    echo '</tr>';


                                                }

                                                ?>
                                            </tbody>
                                            </table>

                                        </div>


                                        <div class="tab-pane" id="repair">
                                        <table class="table table-hover table-primary mb30">
                                            <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Repair Description</th>
                                                <th>Price</th>
                                                <th>Date</th>
                                                <th>Reason</th>
                                            </tr>
                                            </thead>
                                             <tbody>
                                                <?php

                                                    foreach($repair as $row){

                                                        echo '<tr>';
                                                        echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                        echo '<td>' . $row['repair_item_description'] . '</td>';
                                                        echo '<td>$' . number_format($row['total_cost'], 2) . '</td>';
                                                        echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                        echo '<td>' . $row['void_reason'] . '</td>';
                                                        echo '</tr>';


                                                    }


                                                    ?>
                                             </tbody>
                                            </table>

                                        </div>



                                        <div class="tab-pane" id="refill">
                                        <table class="table table-hover table-primary mb30">
                                            <thead>
                                            <tr>
                                                            <th>Customer Name</th>
                                                            <th>Plan</th>
                                                            <th>PIN</th>
                                                            <th>Price</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php

                                                        foreach($refill as $row){

                                                            echo '<tr>';
                                                            echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                            echo '<td>' . $row['plan_name'] . '</td>';
                                                            echo '<td>' . $row['pin_no'] . '</td>';
                                                            echo '<td>$' . number_format($row['grand_total'], 2) . '</td>';
                                                            echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                            echo '<td>' . $row['void_reason'] . '</td>';
                                                            echo '</tr>';


                                                        }




                                                        ?>
                                             </tbody>
                                            </table>

                                        </div>


                                        <div class="tab-pane" id="rto">
                                        <table class="table table-hover table-primary mb30">
                                            <thead>
                                            <tr>
                                                            <th>Customer Name</th>
                                                            <th>Model #</th>
                                                            <th>Description</th>
                                                            <th>Condition</th>
                                                            <th>Cash Price</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php

                                                        foreach($rto as $row){
                                                            echo '<tr>';
                                                            echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                            echo '<td>' . $row['model_no'] . '</td>';
                                                            echo '<td>' . $row['description'] . '</td>';
                                                            echo '<td>' . $row['item_condition'] . '</td>';
                                                            echo '<td>$' . number_format($row['cash_price'], 2) . '</td>';
                                                            echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                            echo '<td>' . $row['void_reason'] . '</td>';
                                                            echo '</tr>';


                                                        }


                                                        ?>
                                             </tbody>
                                            </table>

                                        </div>


                                        <div class="tab-pane" id="layaway">
                                        <ul class="nav nav-tabs nav-line">
                                            <li class="active"><a href="#layaway_second_level" data-toggle="tab">Layaway</a></li>
                                            <li><a href="#layaway_payments" data-toggle="tab">Payments</a></li>
                                        </ul>
                                             <div class="tab-content nopadding noborder">
                                                    <div id="general_pawns_second_level" class="tab-pane active">
                                                     <table class="table table-hover table-primary mb30 align-center">
                                                        <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Items</th>
                                                            <th>Total</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php

                                                            foreach($layaway as $row){


                                                                echo '<tr>';
                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                $items = $employeeClass->getCustomerLayawayItems($row['customer_id'], $row['lid']);
                                                                echo '<td>';
                                                                $itemArr = array();
                                                                foreach($items as $item){
                                                                    echo $item['description'] . ', ';
                                                                    $itemArr[] = array($item['description']);

                                                                }
                                                                $v = array_map('array_pop' , $items);
                                                                $x = implode(',', $v);
                                                                echo '</td>';
                                                                echo '<td>' . $row['total'] . '</td>';
                                                                echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                                echo '<td>' . $row['void_reason'] . '</td>';
                                                                echo '</tr>';


                                                            }

                                                            ?>
                                                        </tbody>

                                                    </table>
                                                    </div>

                                                    <div id="layaway_payments" class="tab-pane">
                                                    <table class="table table-hover table-primary mb30 align-center">
                                                        <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Items</th>
                                                            <th>Total</th>
                                                            <th>Amount Paid</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                        </tr>

                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                                $i = 0;
                                                                foreach($layaway_payment as $row){


                                                                    $status = $row['status'];
                                                                    if($status == 'void'){
                                                                        $disabled = 'disabled';
                                                                    }
                                                                    else{

                                                                        $disabled = '';

                                                                    }

                                                                    echo '<tr>';
                                                                    echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                    echo '<td>';
                                                                    $itemArr = array();
                                                                    foreach($items as $item){
                                                                        echo $item['description'] . ', ';
                                                                        $itemArr[] = array($item['description']);

                                                                    }
                                                                    $v = array_map('array_pop' , $items);
                                                                    $x = implode(',', $v);
                                                                    echo '</td>';
                                                                    echo '<td>$' . number_format($row['total'], 2) . '</td>';
                                                                    echo '<td>$' . number_format($row['total_amount'], 2) . '</td>';
                                                                    echo '<td>' . date('m/d/Y', strtotime($row['datePaid'])) . '</td>' . PHP_EOL;
                                                                    echo '<td>' . $row['void_reason'] . '</td>';

                                                                    echo '</tr>';

                                                                    $i++;
                                                                }

                                                                ?>
                                                        </tbody>

                                                    </table>
                                                    </div>


                                        </div>
                                    </div>


                                        <div class="tab-pane" id="scrap">
                                        <table class="table table-hover table-primary mb30">
                                            <thead>
                                            <tr>
                                                            <th>Customer Name</th>
                                                            <th>Item Description</th>
                                                            <th>Price</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php

                                                    foreach($scrap as $row){
                                                        echo '<tr>';
                                                        echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                        echo '<td>';
                                                        $customer_id = $row['customer_id'];
                                                        $scrap_id = $row['scrap_info_id'];
                                                        $items = $employeeClass->getCustomerScrapItemsPop($customer_id, $scrap_id);


                                                        foreach($items as $item){
                                                            echo $item['description'] . '(' . $item['weight'] . 'g), ';

                                                        }
                                                        echo '</td>';
                                                        echo '<td>$' . number_format($row['amount_paid'], 2) . '</td>';
                                                        echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>';
                                                        echo '<td>' . $row['void_reason'] . '</td>';
                                                        echo '</tr>';


                                                    }


                                                    ?>
                                             </tbody>
                                            </table>

                                        </div>


                                    </div>


                                </div>
                            </div><!-- col-md-6 -->
                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->
<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<!-- switch -->

        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap-timepicker.min.js"></script>


<script>
            jQuery(document).ready(function() {
                // Date Picker
                jQuery('#datepicker_from').datepicker();
                jQuery('#datepicker_to').datepicker();


            });
        </script>


<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
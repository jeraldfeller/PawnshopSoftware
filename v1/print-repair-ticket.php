<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Repair Order Ticket';


$id = $_GET['customer_id'];
$last_id = $_GET['repair_id'];
$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomerByIdRepairInvoice($id, $last_id);
$items = $employeeClass->getRepairInvoiceParts($id, $last_id);


foreach($customer as $row)
{


    $name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
    $address = $row['address'];
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $dl_no = $row['drivers_license_no'];
    $dob = $row['birth_date'];
    $contact_phone = $row['cell_no'];
    $height = $row['height'];
    $weight = $row['weight'];
    $sub_total = $row['total_cost'];
    $sales_tax = $row['tax'];
    $repair_description = $row['repair_item_description'];
    $labor_charge = $row['labor_charge'];
    $deposit = $row['deposit'];

}

$taxs = $adminClass->getSalesTax();
foreach ($taxs as $tax){
    $tax = $tax['flat_tax'];
}

$grand_total = $sub_total + $sales_tax;

$currentDateTime = date('Y-m-d H:i:s A T');
$timestamp = DateTime::createFromFormat('Y-m-d H:i:s A T', $currentDateTime);
$currentDate = $timestamp->format('m/d/Y');
$currentTime = $timestamp->format('H:i:s A T');


include "includes/header.php";
?>

<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-list"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Repair Order Ticket/li>
                </ul>
                <h4>Repair Order Ticket</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

        <!-- CONTENT GOES HERE -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="row">
                            <div id="printablediv">
                                <div class="col-lg-12 print-table">

                                    <table class="border-thin header-table-1">
                                        <tr class="table-padding-left">
                                            <td class="border-thin align-left" width="293" rowspan="6">Company <br> <br> The Pawn Shop <br> 20 W MAIN ST <br> LAKELAND, GA 31635</td>
                                            <td class="border-thin"><span class="big-txt-2">CELL PHONE <br> REPAIR RECIEPT</span> <br> Date: <?php echo $currentDate; ?> <br> Time: <?php echo $currentTime; ?></td>
                                            <td class="border-thin align-left" width="293" rowspan="6">Purchaser <br> <br> <?php echo $name; ?> <br> <?php echo $address; ?> <br> <?php echo $city . ',' . $state . ' ' . $zip; ?></td>
                                        </tr>

                                    </table>


                                    <table class="body-table item-display">
                                        <thead>
                                        <tr class="border-thin">
                                            <th class="border-thin">ITEMS</th>
                                            <th class="border-thin">Price</th>
                                            <th class="border-thin">Quantity</th>
                                            <th class="border-thin">Total</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border-thin">
                                            <td class="border-thin"><?php echo $repair_description; ?> Labor</td>
                                            <td class="border-thin">$<?php echo number_format($labor_charge, 2); ?></td>
                                            <td class="border-thin"></td>
                                            <td class="border-thin">$<?php echo number_format($labor_charge, 2); ?></td>
                                        </tr>
                                        <?php

                                        $count = 0;
                                        $output = ' ';
                                        foreach ($items as $item){

                                            echo '<tr class="border-thin">' . PHP_EOL;
                                            echo '<td class="border-thin">' . $item['description'] . '</td>' . PHP_EOL;
                                            echo '<td class="border-thin">$' . number_format($item['cost'], 2) . '</td>' . PHP_EOL;
                                            echo '<td class="border-thin">' . $item['quantity'] . '</td>' . PHP_EOL;
                                            echo '<td class="border-thin">$' . number_format($item['cost'] * $item['quantity'],2 ) . '</td>' . PHP_EOL;
                                            echo '</tr>' . PHP_EOL;

                                            $count++;

                                        }

                                        ?>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Sub Total</td><td class="border-thin">$<?php echo number_format($sub_total, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Sales Tax</td><td class="border-thin">$<?php echo number_format($sales_tax, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Grand Total</td><td class="border-thin">$<?php echo number_format($grand_total, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Deposit Paid Down</td><td class="border-thin">$<?php echo number_format($deposit, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right"><span class="bold">BALANCE DUE AT PICKUP</span></td><td class="border-thin"><span class="bold">$<?php echo number_format($grand_total - $deposit, 2); ?></span></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Amount Paid At Pickup</td><td class="border-thin"></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right"><span class="bold">ENDING BALANCE</span></td><td class="border-thin"></td>
                                        </tr>



                                        </tbody>
                                    </table>
                                    <br><br><br><br>
                                    <div class="disclosure body-table">
                                        <p>All sales are final and we do not accept returns. We do however offer a 30 day warranty against any defects on all new and used cell phones. Refunds are not an option on warranty claims. We will only fix or exchange for the same, similar, or equal value item at our discretion. Cell phone pins are absolutely non refundable. Special Order items are non refundable unless we make a mistake. Sim Cards and Activation Fees are non refundable once purchased. Cell Phone cases are non refundable and non exchangeable once purchased and opened. Cell Phone Repair Deposits are non refundable. If the item you purchased is not listed in these terms then it is non refundable once purchased.</p>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="align-center">
                                            <span class="big-txt-2 align-center"> Thank You!</span>
                                            <br>
                                            <span class="big-txt-2 align-center">  Have a nice day! </span>
                                            <br>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end of printable div -->
                        </div><!-- row -->
                    </div><!-- panel-body -->

                    <div class="panel-footer">
                        <button class="btn btn-primary" onclick="printDiv('printablediv')">Print Repair Order Ticket</button>
                    </div><!-- panel-footer -->
                </div><!-- panel -->

            </div><!-- col-md-6 -->
        </div>


    </div><!-- contentpanel -->

</div>
</div><!-- mainwrapper -->


<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<?php include "includes/footer.php"; ?>




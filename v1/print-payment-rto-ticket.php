<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'RTO Payment Ticket';


$adminClass = new Admin();

$info = $adminClass->getCompanyInfo();

foreach($info as $row){

    $company_name = $row['company_name'];
    $company_address = $row['company_address'];
    $company_city = $row['city'];
    $company_state = $row['state'];
    $company_zip = $row['zip'];
    $company_phone_no = $row['phone_no'];
}



$id = $_GET['customer_id'];
$last_id = $_GET['rto_id'];

$employeeClass = new Employee();

$customer = $employeeClass->getCustomerByIdPaymentRTO($id, $last_id);
$sums = $employeeClass->getCustomerPaymentHistorySumRTO($last_id);
foreach($sums as $row){
    $amount_sum = $row['amount_sum'];
    $penalty_sum = $row['penalty_sum'];
}


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

    $term = $row['payment_term'];
    $remaining_count = $row['remaining_count'];
    $amount_of_each_payment = $row['amount_of_each_payment'];
    $total_no_of_payments = $row['total_no_of_payments'];
    $other_charges = $row['other_charges'];
    $sales_tax = $row['sales_tax'];
    $cash_price = $row['cash_price'];
    $model_no = $row['model_no'];
    $description = $row['description'];
    $serial_no = $row['serial_no'];
    $condition = $row['item_condition'];
    $due_date = $row['due_date'];
    $downpayment = $row['downpayment'];


    $amount_paid = $row['amount_paid'];
    $penalty = $row['penalty'];

}

$taxs = $adminClass->getSalesTax();
foreach ($taxs as $tax){
    $tax = $tax['general_tax'];
}

$grand_total = $amount_of_each_payment + $penalty;
$grand_total_no_penalty = $amount_of_each_payment;
$total_cost_to_own = ($amount_of_each_payment) * $total_no_of_payments;

if($remaining_count == 0) {$remaining_counter = 1; $downpayment_calc = $downpayment;} else if($remaining_count == 1){$remaining_counter = 2; $downpayment_calc = 0;} else {$remaining_counter = $total_no_of_payments; $downpayment_calc = 0;}
$original_total_cost = ($amount_of_each_payment) * $remaining_counter;
$total_cost = $original_total_cost + $downpayment;

$over_all = $total_cost - $grand_total_no_penalty - $downpayment_calc;

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
                    <li><a href="rto-payment">RTO Payment</a></li>
                    <li>RTO Payment Ticket</li>
                </ul>
                <h4>RTO Payment Ticket</h4>
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
                                            <td class="border-thin align-left" width="293" rowspan="6">LESSOR <br> <br> <?php echo $company_name; ?> <br> <?php echo $company_address; ?> <br> <?php echo $company_city . ', ' . $company_state . ' ' . $company_zip; ?></td>
                                            <td class="border-thin"><span class="big-txt-2">RTO PAYMENT<br>  RECIEPT</span> <br> Date: <?php echo $currentDate; ?> <br> Time: <?php echo $currentTime; ?></td>
                                            <td class="border-thin align-left" width="293" rowspan="6">RENTOR <br> <br> <?php echo $name; ?> <br> <?php echo $address; ?> <br> <?php echo $city . ',' . $state . ' ' . $zip; ?></td>
                                        </tr>

                                    </table>


                                    <table class="body-table item-display">
                                        <thead>
                                        <tr class="border-thin">
                                            <th class="border-thin">ITEM INFO</th>
                                            <th class="border-thin"># OF PAYMENTS REMAINING</th>
                                            <th class="border-thin">DUE DATE</th>
                                            <th class="border-thin">COST</th>

                                            <th class="border-thin">PENALTY</th>
                                            <th class="border-thin">SALES TAX</th>

                                            <th class="border-thin">TOTAL</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border-thin">
                                            <td class="border-thin"><?php echo $model_no . ' ' . $description; ?></td>
                                            <td class="border-thin"><?php echo $remaining_count; ?></td>
                                            <td class="border-thin"><?php echo date('m/d/Y', strtotime($due_date)); ?></td>
                                            <td class="border-thin">$<?php echo number_format($amount_of_each_payment, 2); ?></td>
                                            <td class="border-thin">$<?php echo number_format($penalty, 2); ?></td>
                                            <td class="border-thin">$<?php echo number_format($sales_tax, 2); ?></td>
                                            <td class="border-thin">$<?php echo number_format($grand_total, 2); ?></td>
                                        </tr>

                                        <tr class="sum-border">
                                            <td colspan="6" class="no-border align-right table-padding-right">Amount Paid</td><td class="border-thin">$<?php echo number_format($grand_total, 2); ?></td>
                                        </tr>
                                        <?php if($remaining_count == 0){
                                            echo '<tr class="sum-border">';
                                            echo '<td colspan="6" class="no-border align-right table-padding-right">Downpayment</td><td class="border-thin">$' . $downpayment . '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                        <tr class="sum-border">
                                            <td colspan="6" class="no-border align-right table-padding-right">Total Cost To Own</td><td class="border-thin">$<?php echo number_format($total_cost, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="6" class="no-border align-right table-padding-right"><span class="bold"> Total Balance Remaining</span></td><td class="border-thin"><span class="bold">$<?php echo number_format($over_all, 2); ?></span></td>
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
                        <button class="btn btn-primary" onclick="printDiv('printablediv')">Print Payment Ticket</button>
                    </div><!-- panel-footer -->
                </div><!-- panel -->

            </div><!-- col-md-6 -->
        </div>


    </div><!-- contentpanel -->

</div>
</div><!-- mainwrapper -->


<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<?php include "includes/footer.php"; ?>




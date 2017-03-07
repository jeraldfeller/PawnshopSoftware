<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Pawn Ticket';
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
$last_id = $_GET['loan_id'];

$employeeClass = new Employee();
$customer = $employeeClass->getCustomerById($id, $last_id);
$items = $employeeClass->getPawnItem($id,$last_id, 'pawned');

$forfiet = $employeeClass->getForfietDays();
foreach($forfiet as $value){
    $gp_f = $value['general_pawns'];
}

foreach($customer as $row)
{

    $loan_number = $row['loan_info_id'];
    $name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
    $dob = $row['birth_date'];
    $address = $row['address'];
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $cell_no = $row['cell_no'];
    $dl = $row['drivers_license_no'];
    $dl_expire = $row['dl_expire_date'];
    $loan_amount = $row['loan_amount'];
    $loan_matrix_title = $row['title'];
    $rate_first = $row['rate_first'];
    $rate_second = $row['rate_second'];
    $total_loan = $row['total_loan'];
    $interest_rate = $row['interest_rate'];
    $apr = $row['apr'];
    $terms_of_loan = $row['terms_of_loan'];
    $due_date = $row['due_date'];



}
$currentDateTime = date('Y-m-d H:i:s A');
$timestamp = DateTime::createFromFormat('Y-m-d H:i:s A', $currentDateTime);
$currentDate = $timestamp->format('m/d/Y');
$currentTime = $timestamp->format('H:i:s A');

$timestamp = DateTime::createFromFormat('Y-m-d', $dob);
$dob = $timestamp->format('m/d/Y');

$timestamp = DateTime::createFromFormat('Y-m-d', $due_date);
$due_date = $timestamp->format('m/d/Y');

$timestamp = DateTime::createFromFormat('Y-m-d', $dl_expire);
$dl_expire = $timestamp->format('m/d/Y');

$forfiet_date = date('m/d/Y', strtotime('+' . $gp_f . ' days', strtotime($due_date)));



$charge = $loan_amount * $rate_first / 100;
$charge = number_format($charge, 2);

$total_payback = $loan_amount + $charge;
$total_payback = $total_payback;
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
                    <li>Pawn Ticket</li>
                </ul>
                <h4>Pawn Ticket</h4>
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

                                    <table class="border-thick header-table">
                                        <tr>
                                            <td class="t-heading" width="293" rowspan="6">PAWN CONTRACT</td>
                                            <td class="company-title"><?php echo $company_name; ?></td>
                                            <td class="t-heading"width="293" rowspan="6">PAWN # <?php echo $loan_number; ?></td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td><?php echo $company_address; ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo $company_city . ', ' . $company_state . ' ' . $company_zip; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $company_phone_no; ?></td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>

                                    </table>

                                    <table class="border-thin pledgor" border="1">
                                        <thead>
                                        <tr>
                                            <th>PLEDGOR</th>
                                            <th>PLEDGOR IDENTIFICATION</th>
                                            <th>DL EXP.</th>
                                            <th>DATE</th>
                                            <th>TIME</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td rowspan="3"><?php echo $name; ?><br> <?php echo $address . ' ' . $city; ?> ,<br> <?php echo $state . ' ' . $zip; ?></td>
                                            <td>DL #: <?php echo $dl; ?></td>
                                            <td><?php echo $dl_expire; ?></td>
                                            <td><?php echo $currentDate; ?></td>
                                            <td><?php echo $currentTime; ?></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">D.O.B.: <?php echo $dob; ?></td>
                                            <td rowspan="2" colspan="3">Phone #: <?php echo $cell_no; ?></td>
                                        </tr>

                                        </tbody>

                                    </table>

                                    <table class="body-table" border="1">
                                        <tr class="border-thick">
                                            <td class="border-thick" rowspan="2"><span class="big-txt">ANNUAL <br> PERCENTAGE RATE </span><br><small>The cost of your credit as a yearly rate.</small> <br><span class="big-txt"> <?php echo $apr; ?>%</span></td>
                                            <td class="border-thick" rowspan="2"><span class="big-txt">MONTHLY  <br>PERCENTAGE RATE </span><br><small>The cost of your credit as a monthly rate.</small> <br><span class="big-txt"> <?php echo $rate_first; ?>%</span></td>
                                            <td class="border-thick" rowspan="2"><span class="big-txt">FINANCE <br>   CHARGE </span><br><small>The dollar amount this credit will cost you.</small> <br><span class="big-txt">$<?php echo number_format($charge, 2); ?></span></td>
                                            <td class="border-thick"> <span class="bold">Amount Financed</span> <br> The Amount You Receive Today <br> $<?php echo number_format($loan_amount, 2); ?></td>
                                        </tr>
                                        <tr class="border-thick">
                                            <td><span class="bold">Total of Payments</span><br> The total you must pay back <br>$<?php echo number_format($total_payback, 2); ?></td>

                                        </tr>
                                        <tr class="border-thin">
                                            <td colspan="2"><span class="bold">Payment Schedule: </span><br> 1 Payment of $<?php echo number_format($total_payback, 2); ?> Due on <?php echo $due_date; ?></td>
                                            <td><span class="bold">Due Date: </span><br> <?php echo $due_date; ?></td>
                                            <td><span class="bold">Forfeit Date: </span><br> <?php echo $forfiet_date; ?> </td>
                                        </tr>
                                        <tr class="border-thin">
                                            <td colspan="4"><span class="bold">Prepayment :</span> If you pay early you are not entitled to a refund of any part of the finance charge. If you pay late you are responsible for the following periods full interest as well.</td>
                                        </tr>

                                    </table>

                                    <table class="body-table item-display" border="1">
                                        <thead>
                                        <tr>
                                            <th class="heading" colspan="5">YOU ARE GIVING SECURITY INTEREST IN THE FOLLOWING ITEMS</th>
                                        </tr>
                                        <tr>
                                            <th>ITEM #</th>
                                            <th>DESCRIPTION</th>
                                            <th>SERIAL #</th>
                                            <th>LOAN AMOUNT</th>
                                            <th>STATED VALUE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        foreach($items as $item){
                                            echo '<tr>' . PHP_EOL;
                                            echo '<td>' . $item['id'] . '</td>' . PHP_EOL;
                                            echo '<td>' . $item['item_description'] . '</td>' . PHP_EOL;
                                            echo '<td>' . $item['serial_number'] . '</td>' . PHP_EOL;
                                            echo '<td>$' . $item['loan_amount'] . '</td>' . PHP_EOL;
                                            echo '<td>$' . number_format($item['retail'],2 ) . '</td>' . PHP_EOL;
                                            echo '</tr>' . PHP_EOL;
                                        }
                                        ?>



                                        </tbody>
                                    </table>
                                    <br><br><br><br>
                                    <div class="disclosure body-table">
                                        CONSUMER DISCLOSURE(S):

                                        <br>  •	This is a pawn transaction. Failure to make your payments as described in this document can result in the loss of the pawned item. The pawnbroker can sell or keep the item if you have not made all payments by the specified maturity date.
                                        <br>  •	The length of the pawn transaction is 30 days and that it can only be renewed with the agreement of both parties and only for 30 day incremental periods.
                                        <br>  •	After the grace period the pledged goods become the property of the pawnbroker
                                        <br>  •	Any costs to ship the pledged items to the pledgor or seller can be charged to the pledgor or seller, along with a handling fee to equal no more than 50 percent of the actual costs to ship the pledged items; and
                                        <br>  •	A statement that a fee of up to $2.00 can be charged for each lost or destroyed pawn ticket.
                                    </div>

                                    <table class="border-thick footer-table" border="2">
                                        <tr>
                                            <td><span class="bold"> Lenders Signature </span></td>
                                            <td><span class="bold"> Borrowers Signature</span></td>
                                        </tr>
                                    </table>

                                </div>
                                </div> <!-- end of printable div -->
                            </div><!-- row -->
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button class="btn btn-primary" onclick="printDiv('printablediv')">Print Pawn Ticket</button>
                        </div><!-- panel-footer -->
                    </div><!-- panel -->

                </div><!-- col-md-6 -->
            </div>


    </div><!-- contentpanel -->

</div>
</div><!-- mainwrapper -->


<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<?php include "includes/footer.php"; ?>




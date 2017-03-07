<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Title Pawn Ticket';
$adminClass = new Admin();

$info = $adminClass->getCompanyInfo();


foreach($info as $row) {

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
$customer = $employeeClass->getCustomerByIdTitlePawn($id, $last_id);

$forfiet = $employeeClass->getForfietDays();
foreach($forfiet as $value){
    $gp_f = $value['general_pawns'];
}

foreach($customer as $row)
{
	
	$name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
    $cid = $row['customer_id'];
    $home_no = $row['home_no'];
    $cell_no = $row['cell_no'];
    $address = $row['address'];
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $fname = $row['first_name'];
    $dl = $row['drivers_license_no'];
    $issue_date = $row['dl_issue_date'];
    $expire_date = $row['dl_expire_date'];
    $dob = $row['birth_date'];
    $height = $row['height'];
    $weight = $row['weight'];
    $eye_color = $row['eye_color'];
	$vin = $row['vin_no'];
	$year = $row['year'];
	$model = $row['model'];
	$color = $row['color'];
	$mileage = $row['no_of_doors'];
	$condition = $row['vehicle_condition'];
	$title_no = $row['title_no'];
	$tag_no = $row['tag_no'];
	$loan_amount = $row['total_loan_amount'];
	$loan_matrix_title = $row['title'];
	$amount_behalf = $row['amount_behalf'];
    $interest_accured = $row['interest_accured'];
	$rate_first = $row['rate_first'];
	$rate_second = $row['rate_second'];
	$total_loan = $row['total_loan'];
	$interest_rate = $row['interest_rate'];
	$apr = $row['apr'];
	$terms_of_loan = $row['terms_of_loan'];
	$due_date = $row['due_date'];

    $exempt = $row['exempt'];
}

$timestamp = DateTime::createFromFormat('Y-m-d', $dob);
$dob = $timestamp->format('m/d/Y');



$timestamp = DateTime::createFromFormat('Y-m-d', $issue_date);
$issue_date = $timestamp->format('m/d/Y');

$timestamp = DateTime::createFromFormat('Y-m-d', $expire_date);
$expire_date = $timestamp->format('m/d/Y');

	
	$timestamp = DateTime::createFromFormat('Y-m-d', $due_date);
	$due_date = $timestamp->format('m/d/Y');

$currentDateTime = date('Y-m-d H:i:s A T');
$timestamp = DateTime::createFromFormat('Y-m-d H:i:s A T', $currentDateTime);
$currentDate = $timestamp->format('m/d/Y');
$currentTime = $timestamp->format('H:i A');


$grand_total = $loan_amount + $interest_accured + $amount_behalf;
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
                    <li>Title Pawn Ticket</li>
                </ul>
                <h4>Title Pawn Ticket</h4>
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

                                    <div class="align-center"><span class="big-txt-2">TITLE PAWN CONTRACT</span></div>
                                    <table class="border-thin header-table-1">
                                        <tr class="table-padding-left">
                                            <td class="border-thin align-left" colspan="5">Pledgor's Name <br> <br><?php echo $name; ?></td>
                                            <td class="border-thin align-left" colspan="2">Contract Number <br> <br> <?php echo $last_id; ?></td>
                                        </tr>
                                        <tr class="table-padding-left">
                                            <td class="border-thin align-left" rowspan="2" colspan="3">Pledgor's Address, City, State, Zipcode.<br><?php echo $address; ?><br><?php echo $city . ',' . $state . ' ' . $zip; ?></td>
                                            <td class="border-thin align-left" rowspan="2" colspan="2">Phone Number <br>Home: <?php echo $home_no; ?> <br> Cell: <?php echo $cell_no; ?></td>
                                            <td class="border-thin align-left" colspan="2">Time Made  <?php echo $currentTime; ?></td>
                                        </tr>
                                        <tr class="table-padding-left">
                                            <td class="border-thin align-left" colspan="2">Date Made  <?php echo $currentDate; ?></td>
                                        </tr>
                                        <tr class="table-padding-left">
                                            <td class="border-thin align-left">Drivers License # <br><?php echo $dl; ?></td>
                                            <td class="border-thin align-left">Issue date <br><?php echo $issue_date; ?></td>
                                            <td class="border-thin align-left">Expiration Date <br><?php echo $expire_date; ?></td>
                                            <td class="border-thin align-left">Date of Birth <br><?php echo $dob; ?></td>
                                            <td class="border-thin align-left">Height <br><?php echo $height; ?></td>
                                            <td class="border-thin align-left">Weight <br><?php echo $weight; ?></td>
                                            <td class="border-thin align-left">Eye Color <br><?php echo $eye_color; ?></td>
                                        </tr>

                                        <tr  class="table-padding-left" style="border-right: 0;">
                                            <td valign="top" class="border-thin align-left" style="border-right: 0; "colspan="2">Creditor/Lender <br><?php echo $company_name; ?><br><?php echo $company_address; ?><br><?php echo $company_city . ', ' . $company_state . ' ' . $company_zip; ?></td>
                                            <td valign="top" class="border-thin align-left" style="border-left: 0;" colspan="1">Creditor Contact Number<br><?php echo $company_phone_no; ?></td>
                                            <td valign="top" style="border: 0;" colspan="4" rowspan="5" >
                                                <table border="1" style="width: 100%; margin-top: 10px;">
                                                    <tr class="table-padding-left align-left">
                                                        <td>DUE DATE <br><?php echo $due_date; ?></td>
                                                    </tr>
                                                    <tr class="table-padding-left align-left">
                                                        <td>AMOUNT FINANCED <br>
                                                                  The amount of credit provided to you on your behalf.
                                                            <br>
                                                                  $<?php echo number_format($loan_amount + $amount_behalf, 2); ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-padding-left align-left">
                                                        <td><span class="bold">FINANCE CHARGE</span><br>
                                                            The dollar amount the credit will cost you.
                                                            <br>
                                                            $<?php echo number_format($interest_accured, 2); ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-padding-left align-left">
                                                        <td>TOTAL OF PAYMENTS<br>
                                                            The amount required to redeem pawn on Due Date.
                                                            <br>
                                                            $<?php echo number_format($loan_amount + $amount_behalf + $interest_accured, 2); ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-padding-left align-left">
                                                        <td><span class="bold">ANNUAL PERCENTAGE RATE</span><br>
                                                            The cost of your credit as a yearly rate.
                                                            <br>
                                                            <?php echo $apr; ?>%
                                                        </td>
                                                    </tr>
                                                    <tr class="table-padding-left align-left">
                                                        <td>PAYMENT SCHEDULE<br>
                                                            The cost of your credit as a yearly rate.
                                                            <br>
                                                            1 @ $<?php echo number_format($loan_amount + $interest_accured + $amount_behalf, 2); ?>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </td>
                                        </tr>
                                        <tr class="table-padding-left border-thin">
                                            <td class="border-thin align-left" style="border-right: 0; "colspan="2">Vehicle Identification Number<br><?php echo $vin; ?></td>
                                            <td class="border-thin align-left" style="border-left: 0; "colspan="1">Title Certificate Number<br><?php echo $title_no; ?></td>
                                        </tr>
                                        <tr class="table-padding-left border-thin">
                                            <td class="border-thin align-left" colspan="3"><span class="bold"> SECURITY:</span> You are giving security interest in the above pledged goods. <br>
                                                                                           <span class="bold">PREPAYMENT: </span> If you pay off early, you will not be entitled to a refund of part of the finance charge. <br>
                                                                                           <span class="bold">ADDITIONAL INFORMATION: </span> See your contract for any additional information concerning nonpayment and default and prepayment refunds or penalties.
                                            </td>

                                        </tr>
                                        <tr class="table-padding-left border-thin" colspan="3">
                                            <td class="border-thin align-left">Amount given to you directly<br>$<?php echo number_format($loan_amount, 2); ?></td>
                                            <td class="border-thin align-left">Amount paid to others on your behalf<br>$<?php echo number_format($amount_behalf, 2); ?></td>
                                            <td class="border-thin align-left">Total Amount <br>Financed<br>$<?php echo number_format($loan_amount + $amount_behalf, 2); ?></td>
                                        </tr>
                                    </table>

                                    <br>
                                    <div class="align-center">
                                        <span class="big-txt align-center"> Terms and Conditions of Agreement</span>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="disclosure body-table">
                                        <p>Amount you must pay to redeem this transaction on or before the maturity date: $<?php echo number_format($grand_total, 2); ?>. During the grace period following this transaction or following the 1st or 2nd extension, you may redeem this transaction for $<?php echo number_format($grand_total, 2); ?> if all other charges and fees are current. During the grace period following any extension after the 2nd, you may redeem this transaction for $920.25, if all other charges and fees are current. The Parties agree as follows: A pledger shall have no obligation to redeem pledged goods or make any payment on a pawn transaction. This is a pawn transaction. A fee of up to $2.00 can be charged for each lost or destroyed pawn ticket. Failure to make your payments a described in this document can result in the loss of the pawned item. The pawnbroker can sell or keep the item if you have not made all payments by the specified maturity date. THE LENGTH OF THE PAWN TRANSACTION IS 30 DAYS AND IT CAN ONLY BE RENEWED WITH THE AGREEMENT OF BOTH PARTIES AND ONLY FOR 30 DAY INCREMENTAL PERIODS.. During this transaction or the 1st or 2nd extension of this transaction there can be a minimum charge of up to $10.00 per 30 day period. If this transaction is continued or extended beyond 90 days, there can be a minimum charge of $5.00 per 30 day period. Unless this pawn transaction involves a motor vehicle or motor vehicle title, you have a ten (10) day grace period after the maturity date within which you can redeem this transaction. in the event the last day of the grace period falls on a day in which the pawnbroker is not open for business, the grace period shall be extended through the first day following upon which the pawnbroker is open for business. The pawnbroker shall not sell the pledged goods during the grace period. Pledged goods may be redeemed by the pledger or seller within the grace period by the payment of any unpaid accrued fees and charges, and additional interest not to exceed 12.5 percent of the principal. If you do not redeem the pledged goods before the expiration of the grace period, and if we do not agree to renew this transaction, the pledged goods become the property of the pawnbroker. Any costs to ship the pledged items to the pledger or seller can be charged to the pledger or seller, along with a handling fee to equal no more than 50 percent of the actual cost to ship the pledged items. If this pawn ticket is lost, destroyed or stolen, customer should immediately so advise the issuing pawnbroker, in writing. By signing this agreement, you are telling us that you are at least 18 years of age and that you are the true owner of the item(s pledged, and acknowledge that you have been given a copy of this agreement. You agree that whoever properly identifies himself or her self and presents this pawn ticket is presumed to be the pledger and is entitled to redeem the item(s) pledged. Failure to make your payment as described in this document can result in the loss of your motor vehicle. The pawnbroker can also charge you certain fees if he or she actually repossesses the motor vehicle. If this transaction does involve a motor vehicle or motor vehicle certificate of title, you have a thirty (30) day grace period after the maturity date within which you can redeem this transaction. In the event the last day of the grace period falls on a day in which the pawnbroker is not open for business, the grace period shall be extended through the first day following upon which the pawnbroker is open for business. The pawnbroker may not charge a storage fee for the motor vehicle unless the pawnbroker repossesses the motor vehicle pursuant to a default. If the pawnbroker repossesses and actually must store the motor vehicle, the pawnbroker may charge a storage fee for the repossessed vehicle not to exceed $5.00 per day. If the pawnbroker actually repossesses the motor vehicle, the THE FOLLOWING INFORMATION APPLIES ONLY TO PAWN TRANSACTIONS INVOLVING MOTOR VEHICLES CERTIFICATE OF TlTLE: may charge a storage fee for the repossessed vehicle not to exceed $5.00 per day. If the pawnbroker actually repossesses the motor vehicle, the pawnbroker may charge a repossession fee not to exceed $50.00*. The pawnbroker may charge a fee to register a lien upon the motor vehicle certificate of title not to exceed any fee actually charged by the appropriate state to register a lien upon a motor vehicle certificate of title, but only if the pawnbroker actually places such a lien upon the motor vehicle certificate of title. The pawnbroker has the right upon default to take possession of the motor vehicle. In taking possession, the pawnbroker or his agent may proceed without judicial process if this can be done without breach of the peace or may proceed by action. *NOTE: Repossession fee of more than $50.00 may be charged if actual repossession of the vehicle takes place more than 50 miles from the office where the pawn originated.</p>
                                        <br>
                                        <p><span class="bold">
                                            •	VERBAL AGREEMENTS FOR ADDITIONAL DAYS ARE NOT BINDING.<br>
                                            •	NO GOODS SHOWN FOR REDEMPTION UNLESS PAID IN ADVANCE.<br>
                                            •	NO GOODS SENT C.O.D.<br>
                                            •	NO PERSONAL CHECKS ACCEPTED.<br>
                                            •	PAWNED FOR 30 DAYS ONLY.
                                                </span>
                                        </p>
                                        <br>
                                        <p>Pledger(s) acknowledges receipt of a signed copy of this document</p>
                                        <br>
                                        <br>
                                        <table>
                                            <tr>
                                                <td>X__________________________________________________</td>
                                                <td>X__________________________________________________</td>
                                            </tr>
                                            <tr>
                                                <td>Pawnbroker's Signature</td>
                                                <td>Pledgor/Seller's Signature</td>
                                            </tr>
                                        </table>


                                    </div>


                                  

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

    <script>
        var cid = '<?php echo $cid; ?>';
        var lid = '<?php echo $last_id; ?>';

        window.open('FPDM/MV1-Form.php?cid='+cid+'&lid='+lid, '_blank');
    </script>

<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<?php include "includes/footer.php"; ?>




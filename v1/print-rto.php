<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'RTO Ticket';


$id = $_GET['customer_id'];
$last_id = $_GET['rto_id'];

if(isset($_GET['penalty'])){
    $penalty = $_GET['penalty'];
}
else{
    $penalty = 0;
}

$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomerByIdRTO($id, $last_id);


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
    $downpayment = $row['downpayment'];
    $total_no_payments = $row['total_no_of_payments'];
    $amount_of_each_payment = $row['amount_of_each_payment'];
    $other_charges = $row['other_charges'];
	$amount_behalf = $row['amount_behalf'];
    $sales_tax = $row['sales_tax'];
    $cash_price = $row['cash_price'];
    $model_no = $row['model_no'];
    $description = $row['description'];
    $serial_no = $row['serial_no'];
    $condition = $row['item_condition'];
    $due_date = $row['due_date'];

}
$ab = $amount_behalf / $total_no_payments;
$amount_of_each_payment = $amount_of_each_payment - $sales_tax - $other_charges;
$rental_payment_amount = $amount_of_each_payment + $sales_tax;
$rental_payment_amount_breakdown = $amount_of_each_payment + $sales_tax + $other_charges;

$grand_total = ($amount_of_each_payment + $sales_tax + $other_charges) * $total_no_payments + $downpayment;


$currentDateTime = date('Y-m-d H:i:s A T');
$timestamp = DateTime::createFromFormat('Y-m-d H:i:s A T', $currentDateTime);
$currentDate = $timestamp->format('m/d/Y');
$currentTime = $timestamp->format('H:i:s A T');

$timestamp_due = DateTime::createFromFormat('Y-m-d', $due_date);
$due_date =  $timestamp_due->format('m/d/Y');



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
                    <li>RTO Ticket</li>
                </ul>
                <h4>RTO Ticket</h4>
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

                                    <div class="align-center">
                                        <span class="big-txt-2 align-center">RENTAL LEASE PURCHASE AGREEMENT</span>
                                    </div>
                                    <table class="border-thin header-table-1">
                                        <tr class="table-padding-left">
                                            <td class="border-thin align-left"><span class="bold"> LESSOR </span> <br> The Pawn Shop <br> 20 W MAIN ST <br> LAKELAND, GA 31635</td>

                                            <td class="border-thin align-left"><span class="bold"> RENTER </span> <br> <?php echo $name; ?> <br> <?php echo $address; ?> <br> <?php echo $city . ',' . $state . ' ' . $zip; ?></td>
                                        </tr>

                                    </table>

                                        <table style="margin-top: -10px; margin-bottom: -15px;" class="body-table">
                                            <tr>
                                                <td><span class="bold align-center">TERMS OF AGREEMENT</span>
                                                    <br>
                                                    As used in this agreement “you” and “your” mean the person or persons signing this agreement as renter, “We” and “our” mean the Lessor/Owner (The Rental Company). “Lease” means this Rental Purchase Agreement including all attachments and disclosures.
                                                </td>
                                            </tr>
                                        </table>


                                    <table class="body-table">
                                        <tbody>
                                        <tr class="border-thin">
                                            <td class="border-thin"><span class="bold"> Rental Term </span>  <br> <?php echo $term; ?></td>
                                            <td class="border-thin" colspan="3"><span class="bold"> Rental Payment Amount </span>  <br> $<?php echo number_format($rental_payment_amount ,2); ?></td>
                                            <td class="border-thin"><span class="bold"> Next Due Date </span>  <br> <?php echo $due_date; ?></td>

                                        </tr>

                                        <tr>
                                            <td colspan="5">Rental Payments are due at the beginning of each term for which you choose to rent. There are no refunds on Rental Payments Paid, if you return the property before the end of the term.</td>
                                        </tr>
                                        <tr class="border-thin">
                                            <td colspan="5"><span class="bold">Description of Property and Rental Rates </span> </td>
                                        </tr>
                                        <tr class="border-thin">
                                            <td><span class="bold">Model #</span></td>
                                            <td><span class="bold">Description</span></td>
                                            <td><span class="bold">Serial #</span></td>
                                            <td><span class="bold">Condiion</span></td>
                                            <td><span class="bold">Rent Amount</span></td>
                                        </tr>
                                        <tr class="border-thin">
                                            <td class="border-thin"><?php echo $model_no; ?></td>
                                            <td class="border-thin"><?php echo $description; ?></td>
                                            <td class="border-thin"><?php echo $serial_no; ?></td>
                                            <td class="border-thin"><?php echo $condition; ?></td>
                                            <td class="border-thin">$<?php echo number_format($rental_payment_amount, 2); ?></td>
                                        </tr>

                                        <tr class="border-thin">
                                            <td colspan="5"><span class="bold">Rental Payment Breakdown</span> Your rental payments will include the following charges.</td>
                                        </tr>

                                        <tr class="border-thin">
                                            <td class="border-thin"><span class="bold">Base Rent</span><br>$<?php echo number_format($amount_of_each_payment - $ab, 2); ?></td>
                                            <td class="border-thin"><span class="bold">Other Charges</span><br>$<?php echo number_format($other_charges, 2); ?></td>
                                            <td class="border-thin"><span class="bold">Sales Tax</span><br>$<?php echo number_format($sales_tax, 2); ?></td>
											
                                            <td class="border-thin" colspan="2"><span class="bold">Total</span><br>$<?php echo number_format($rental_payment_amount_breakdown - $ab, 2); ?></td>

                                        </tr>

                                        <tr class="border-thin">
                                            <td colspan="5"><span class="bold">Late Fees & Collection Charges</span> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-thin"><span class="bold">Late Payments / Reinstatement Fee </span> <br>
                                                $5.00 will be added for any payment that is more than two days past due.
                                            </td>
                                            <td colspan="3" class="border-thin"><span class="bold">Collection Charges </span> <br>
                                                If a home visit is required to try to collect a payment or to recover the merchandise a $10 fee per trip will be added to the amount due.
                                            </td>

                                        </tr>

                                        <tr class="border-thin">
                                            <td colspan="5"><span class="bold">Total Cost To Own</span> </td>
                                        </tr>
                                        <tr class="border-thin">
                                            <td colspan="5">To own the merchandise you are renting you must make all payments as laid out in this agreement, and you must pay all late fees and/or collection fees if any are due. Until such time you are only renting the merchandise and have no right to ownership of said merchandise.</td>
                                        </tr>

                                        <tr class="border-thin">
                                            <td class="border-thin"><span class="bold">Down Payment</span><br>$<?php echo number_format($downpayment, 2); ?></td>
                                            <td class="border-thin"><span class="bold">Total # of Periodic Payments</span><br><?php echo $total_no_payments; ?></td>
											<td class="border-thin"><span class="bold">Amount paid to others on your behalf</span><br>$<?php echo number_format($amount_behalf, 2); ?></td>
                                            <td class="border-thin"><span class="bold">Rental Payment Amount</span><br>$<?php echo number_format($rental_payment_amount_breakdown, 2); ?></td>
											
                                            <td class="border-thin" colspan="2"><span class="bold">Total Cost To Own</span><br>$<?php echo number_format($grand_total, 2); ?></td>

                                        </tr>

                                        <tr class="border-thin table-padding-left">
                                                <td colspan="5" class="border-thin align-left">
                                                    <span class="bold">Our cash price for this property is: </span> $<?php echo number_format($cash_price, 2); ?>
                                                    <br>
                                                    <span class="bold">Early Purchase Option: </span>If you wish to purchase this merchandise you may do so by paying all of the remaining payments of this agreement. There will be no discount on said payments.
                                                    <br>
                                                    <span class="bold">Risk of Loss:  </span>You are responsible for the merchandise and/or property while it is in your possession. This includes destruction, theft, loss, and/or any damage in excess of normal wear and tear. Even if the merchandise gets damaged, lost, or stolen you will still be responsible for all of the payments in this agreement. The only way to get out of this agreement is to turn in the merchandise in perfect working condition, with the exception of normal wear and tear. Failure to turn in the merchandise, or failure to turn in the merchandise in an acceptable condition and failure to make payments as laid out in this contract will result in you being charged to the full extent of the law, which possibly will be the charge of some form of Criminal Theft. In such event you will be liable for any and all cost associated with such proceedings, court fillings, and lawyer fees.
                                                    <br>
                                                    <span class="bold">Reinstatement:  </span>If you voluntarily return the merchandise timely upon request you will be given the option to reinstate this agreement within 60 days, and pickup where you left off for a Reinstatement Fee of $5.00.
                                                    <br>
                                               
                                                <span class="bold">Type of Transaction </span> This is a Rental Transaction. You may use the property for the term of the lease. At your option, you may renew this lease. To do this, you must make a rental payment in advance for each term you wish to rent the property. The rental rates are shown above. Time is of the essence. There are no grace periods.
                                                <br>
                                                <span class="bold">Assignment: </span>We may sell, transfer, or assign this lease without notice to you.
                                                <br>
                                                <span class="bold">Title, Maintenance and Taxes: </span>We retain all ownership and title to the property at all times and will pay any taxes which might be levied on the property.
                                                <br>
                                                <span class="bold">Our rights to take possession: </span>If you do not renew this lease, we have the right to take possession of the property. If you do not allow us to take possession of the property to agree to pay all attorneys and collection fees associated with us taking possession of said property. You also understand that you can be held criminally liable for theft.
                                                <br>
                                                <span class="bold">Intent: </span>By signing this agreement you agree you would rather rent than purchase said property.
                                                By signing this agreement you agree that you understand all aspects of this agreement, and you agree to be bound by all the terms and conditions of this agreement.
                                            </td>
                                        </tr>


                                        </tbody>
                                    </table>

                                    <table>
                                        <tr>
                                            <td  class="align-left">________________________________________________</td>
											<td style="width: 50%;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td  class="align-right">_______________________________________________</td>
                                        </tr>
                                        <tr>
                                            <td  class="align-left">Witness/Lessor Signature</td>
											<td style="width: 50%;">&nbsp;</td>
                                            <td  class="align-right">Renter Signature</td>
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




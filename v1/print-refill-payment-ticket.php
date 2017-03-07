<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Refill Payment Ticket';


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
$last_id = $_GET['refill_id'];
$employeeClass = new Employee();

$customer = $employeeClass->getCustomerByIdRefill($id, $last_id);

$taxs = $adminClass->getSalesTax();


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
    $plan_name = $row['plan_name'];
    $pin = $row['pin_no'];
    $cp_number = $row['cp_number'];
    $cost = $row['cost'];
    $quantity = $row['quantity'];
    $sub_total = $row['total_cost'];
    $grand_total = $row['grand_total'];


}

if($id == 1){
    $name = 'Guest';
    $address = '';
    $city = '';
    $state = '';
    $zip = '';

}

$taxs = $adminClass->getSalesTax();
foreach ($taxs as $tax){
    $tax = $tax['flat_tax'];
}


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
                    <li><a href="view-edit-repair-orders">View/Edit/Repair Orders</a></li>
                    <li>Repair Payment Ticket</li>
                </ul>
                <h4>Repair Payment Ticket</h4>
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
                                            <td class="border-thin"><span class="big-txt-2">WIRELESS PIN REFILL <br> RECIEPT</span> <br> Date: <?php echo $currentDate; ?> <br> Time: <?php echo $currentTime; ?></td>
                                            <td class="border-thin align-left" width="293" rowspan="6">Purchaser <br> <br> <?php echo $name; ?> <br> <?php echo $address; ?> <br> <?php echo $city . ',' . $state . ' ' . $zip; ?></td>
                                        </tr>

                                    </table>


                                    <div class="disclosure body-table">
                                        <div class="align-center">
                                            <p class="align-center">The pin number listed below has been refilled to your account for the phone number listed below:<p>
                                                <br>
                                                <span class="big-txt-2 align-center">  Your Phone Number: <?php echo $cp_number; ?></span>
                                                <br>
                                            <p class="align-center">This has extended your plans expiration date by 30 calendar days.<p>

                                        </div>
                                    </div>


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
                                            <td class="border-thin"><?php echo $plan_name; ?> - <br> Pin # <?php echo $pin; ?></td>
                                            <td class="border-thin">$<?php echo number_format($cost, 2); ?></td>
                                            <td class="border-thin"><?php echo $quantity; ?></td>
                                            <td class="border-thin">$<?php echo number_format($sub_total, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Sub Total</td><td class="border-thin">$<?php echo number_format($sub_total, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Sales Tax</td><td class="border-thin">$<?php echo number_format($tax * $quantity, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right"><span class="bold">Grand Total</span> </td><td class="border-thin"><span class="bold"> $<?php echo number_format($grand_total, 2); ?></span> </td>
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




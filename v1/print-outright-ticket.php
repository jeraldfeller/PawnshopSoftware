<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Outright Ticket';


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
$last_id = $_GET['outright_id'];

$employeeClass = new Employee();
$customer = $employeeClass->getCustomerByIdOutright($id, $last_id);
$items = $employeeClass->getOutrightItem($id, $last_id, 'Paid');
$sub_total = $employeeClass->getOutrightSum($id, $last_id);

$taxs = $adminClass->getSalesTax();
foreach ($taxs as $tax){
    $tax = $tax['general_tax'];
}

$calc_tax = $sub_total * $tax / 100;
$grand_total = $sub_total + $calc_tax;

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
	$purchase_amount = $row['purchase_amount'];
	$retail_price = $row['retail_price'];


}


$currentDateTime = date('Y-m-d H:i:s A T');
$timestamp = DateTime::createFromFormat('Y-m-d H:i:s A T', $currentDateTime);
$currentDate = $timestamp->format('m/d/Y');
$currentTime = $timestamp->format('H:i:s A T');


$timestamp = DateTime::createFromFormat('Y-m-d', $dob);
$dob = $timestamp->format('m/d/Y');
include "includes/header.php";
?>

<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="buy-item-outright">Buy Item Outright</a></li>
                    <li>Outright Ticket</li>
                </ul>
                <h4>Outright Ticket</h4>
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
                                            <td class="border-thin align-left" width="293" rowspan="6">PURCHASER <br> <br> <?php echo $company_name; ?> <br> <?php echo $company_address; ?> <br> <?php echo $company_city . ', ' . $company_state . ' ' . $company_zip; ?></td>
                                            <td class="border-thin"><span class="big-txt-2">PURCHASE</span> <br> Date: <?php echo $currentDate; ?> <br> Time: <?php echo $currentTime; ?></td>
                                            <td class="border-thin align-left" width="293" rowspan="6">SELLER <br> <br> <?php echo $name; ?> <br> <?php echo $address; ?> <br> <?php echo $city . ',' . $state . ' ' . $zip; ?></td>
                                        </tr>

                                    </table>

                                    <table class="border-thin pledgor" border="1">

                                        <tbody>
                                        <tr>
                                            <td><b>Sellers Drivers License Number</b> <br><br> <?php echo $dl_no; ?></td>
                                            <td><b>Sellers DOB</b> <br><br> <?php echo $dob; ?></td>
                                            <td><b>Contact Phone #</b> <br><br> <?php echo $contact_phone; ?></td>
                                            <td><b>Height/Weight</b> <br><br> <?php echo $height . ' / ' . $weight; ?></td>
                                        </tr>

                                        </tbody>

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
                                        <?php

                                        $count = 0;
                                        $output = ' ';
                                        foreach ($items as $item){

                                            echo '<tr class="border-thin">' . PHP_EOL;
                                            echo '<td class="border-thin">' . $item['item_description'] . '</td>' . PHP_EOL;
                                            echo '<td class="border-thin">$' . number_format($item['purchase_price'], 2) . '</td>' . PHP_EOL;
                                            echo '<td class="border-thin">' . $item['quantity'] . '</td>' . PHP_EOL;
                                            echo '<td class="border-thin">$' . number_format($item['purchase_price'],2 ) . '</td>' . PHP_EOL;
                                            echo '</tr>' . PHP_EOL;

                                            $count++;

                                        }

                                        ?>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Sub Total</td><td class="border-thin">$<?php echo number_format($sub_total, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Sales Tax</td><td class="border-thin">$<?php echo number_format($calc_tax, 2); ?></td>
                                        </tr>
                                        <tr class="sum-border">
                                            <td colspan="3" class="no-border align-right table-padding-right">Grand Total</td><td class="border-thin">$<?php echo number_format($grand_total, 2); ?></td>
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
                                                <br>
                                                <span class="big-txt-2">Sellers Signature: ____________________________</span>
                                            </div>

                                    </div>
                                </div>
                            </div> <!-- end of printable div -->
                        </div><!-- row -->
                    </div><!-- panel-body -->

                    <div class="panel-footer">
                        <button class="btn btn-primary" onclick="printDiv('printablediv')">Print Outright Ticket</button>
                    </div><!-- panel-footer -->
                </div><!-- panel -->

            </div><!-- col-md-6 -->
        </div>


    </div><!-- contentpanel -->

</div>
</div><!-- mainwrapper -->


<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<?php include "includes/footer.php"; ?>




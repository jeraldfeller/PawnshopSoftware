<?php
require 'Model/Init.php';
require 'includes/require.php';
$title = 'Redeem Repair Order/Invoice';

$customer_id = $_GET['customer_id'];
$repair_id = $_GET['repair_id'];

$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomerInfo($customer_id);
$invoice = $employeeClass->getCustomerByIdRepairInvoice($customer_id, $repair_id);
$items = $employeeClass->getRepairInvoiceParts($customer_id, $repair_id);
$statuses = $employeeClass->getRepairStatus();
$view = new View();
$taxs = $adminClass->getSalesTax();
foreach ($taxs as $tax){
    $sales_tax = $tax['general_tax'];
}
$date = date('Y-m-d');


foreach($customer as $row){
    $name = $row['first_name'] . ' ' . $row['middle_name'] .  ' ' . $row['last_name'];
}



foreach($invoice as $row){
    $repair_item_description = $row['repair_item_description'];
    $repair_serial_number = $row['repair_serial_number'];
    $desc_to_completed = $row['description_to_completed'];
    $labor_charge = $row['labor_charge'];
    $total_cost = $row['total_cost'];
    $tax = $row['tax'];
    $deposit = $row['deposit'];
    $balance = $row['balance'];
    $repair_status = $row['repair_status'];
}

if(isset($_POST['submit'])){
    $employeeClass->addRepairInvoicePayment();
}
require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left" style="padding-top: 5px;">
                <i class="fa fa-wrench"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="index"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="view-edit-repair-orders">View/Edit/Repair Orders</a></li>
                    <li>Redeem Repair Order/Invoice</li>
                </ul>
                <h4>Redeem Repair Order/Invoice</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

 
        <div class="row">
            <div class="col-md-12">
                    <h1 class="box-heading"><?php echo $name; ?> Repair Invoice</h1>
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">


                                            <input name="customer_id" type="hidden" id="selectCustomer" value="<?php echo $customer_id; ?>">

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <h4 class="box-heading">Repair Item Description</h4>
                                        <h5><?php echo $repair_item_description; ?></h5>
                                        <div class="mbl"></div>
                                    </div>

                                </div>



                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h4 class="box-heading">Repair Item Serial #</h4>
                                        <h5><?php echo $repair_serial_number; ?></h5>
                                        <div class="mbl"></div>
                                    </div>
                                </div>
                                </div>





                        </div> <!-- end of panel body -->



                        </div> <!-- end of panel -->

                        <div class="panel panel-default">
                        <div class="panel-heading"><h4>Parts</h4></div>
                            <div class="panel-body">
                            <div class="row">

                                        <table class="table table-striped table-hover table-primary mb30 align-center" id="theTable">
                                            <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Cost</th>
                                                <th>Retail</th>
                                                <th>Quantity</th>
                                                <th>Total</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $totalArr = array();
                                                foreach($items as $item){
                                                    echo '<tr>';
                                                    echo '<td>' . $item['description'] . '</td>';
                                                    echo '<td>$' . number_format($item['cost'], 2) . '</td>';
                                                    echo '<td>$' . number_format($item['retail'], 2) . '</td>';
                                                    echo '<td>' . $item['quantity'] . '</td>';
                                                    echo '<td>$' . number_format($item['cost'] * $item['quantity'], 2) . '</td>';
                                                    echo '</tr>';

                                                    $totalArr[] = $item['cost'] * $item['quantity'];
                                                }

                                                ?>
                                            </tbody>
                                        </table>

                            </div>
                            </div><!-- end of panel body -->
                        </div>

                        <!-- next well -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <input type="hidden" id="pasteDesc" name="repair_item_description" value="<?php echo $repair_item_description; ?>">
                            <input type="hidden" id="pasteSerial" name="serial_number" value="<?php echo $repair_serial_number; ?>">
                            <input type="hidden" class="form-control" name="customer_id" id="customer_id_ref" value="<?php echo $customer_id; ?>">
                            <input type="hidden" class="form-control" name="repair_id" id="repair_id" value="<?php echo $repair_id; ?>">
                            <input type="hidden" id="tax" name="tax" value="<?php echo $tax; ?>">

                            <div class="panel panel-default">

                                <div class="panel-body">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">

                                            <h4>Description of Repair To be Completed</h4>
                                            <div class="form-group">


                                                <input type="text" class="form-control" id="description_to_complete" name="description_to_complete" value="<?php echo $desc_to_completed; ?>" readonly>



                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <table class="table mb30">
                                            <tr>
                                                <td><b>Total Cost of Parts</b></td>
                                                <td>$<?php echo array_sum($totalArr); ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Labor Charge</b></td>
                                                <td>$<?php echo number_format($labor_charge, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Total Cost</b></td>
                                                <td>$<?php echo number_format($total_cost, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Deposited Amount</b></td>
                                                <td>$<?php echo number_format($deposit, 2); ?></td>
                                            </tr>

                                            <tr>
                                                <td><b>Balance Due</b></td>
                                                <td>$<?php echo number_format($balance, 2); ?></td>
                                            </tr>
                                             <tr>
                                                <td><b>Sales Tax</b></td>
                                                <td>$<?php echo number_format($tax, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Grand Total</b></td>
                                                <td><b>$<?php echo number_format($tax + $balance, 2); ?></b></td>
                                            </tr>

                                        </table>



                                                <div class="col-lg-6">

                                                    <h5 class="box-heading">Amount</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id ="amount_paid" name="amount_paid" onchange="formatCurrency(this)" title="Amount to paid <?php echo number_format($tax + $balance, 2) ?>" pattern="<?php echo number_format($tax + $balance, 2); ?>"/>
                                                    </div>
                                                </div>


                                    </div>

                                    </div>

                    </div>
<div class="panel-footer">
                    <input type="hidden" value="<?php echo $date; ?>" name="date_added">


                                       <input type="submit" name="submit" class="btn btn-primary" value="Complete & Print Ticket">

                        </form>
                </div>
                </div><!-- end of panel-body-->

            </div>
            </div>

        </div>

        


    </div><!-- contentpanel -->

</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>

<script type="text/javascript">

    $(document).ready(function() {


        $('table#theTable tbody#displayItems').on('click', 'button', function () {

            var $id = $(this).closest('tr').find('td:first').text();
            var $parts_id = $('#parts_id_' + $id).val();
            var $image_name = " ";
            var $page = 'repair-invoice';
            removeItems($parts_id, $image_name, $page);



            setTimeout(function () {
                sumTotal();
            }, 500)

        });
    });
</script>

<script>
    function postDesc(elem){
        var desc = elem.value;
        document.getElementById('pasteDesc').value = desc;
    }
    function postSerial(elem){
        var serial = elem.value;
        document.getElementById('pasteSerial').value = serial;
    }
    function sumTotal(){

        var tds = document.getElementById('theTable').getElementsByTagName('td');
        var labor_charge = document.getElementById('labor_charge').value;
        var sum = 0;
        var quantity = 0;
        var tax = <?php echo $sales_tax; ?>;
        var item_count = 0;
        for(var i = 0; i < tds.length; i ++) {

            if(tds[i].className == 'amount') {


                sum += isNaN(tds[i].innerHTML) ? 0 : parseFloat(tds[i].innerHTML);
                item_count++;
            }
        }



        document.getElementById('tax').value = (sum * parseFloat(tax)) / 100;



        sum = sum + parseFloat(labor_charge.replace(/\,/g,''));

        var total = document.getElementById('total_cost_display');

        total.value = sum;


        document.getElementById('total_cost').value = sum;
        // document.getElementById('total_loan_amount_hidden').value = sum;
        formatCurrency(total);
    }

    function calcBalance(elem){
        var deposit = elem.value;
        var total_cost = document.getElementById('total_cost').value;
        var balance = parseFloat(total_cost) - parseFloat(deposit.replace(/\,/g,''));

        var remaining = document.getElementById('balance_display');

        remaining.value = balance;
        document.getElementById('balance').value = balance;


        formatCurrency(remaining);

    }
</script>


<?php

require SERVER_ROOT . '/' . VERSION . '/includes/footer.php';
?>
<?php
require 'Model/Init.php';
require 'includes/require.php';
$title = 'Edit Repair Order/Invoice';
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
    $employeeClass->updateRepairInvoice();
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
                    <li>Edit Repair Order/Invoice</li>
                </ul>
                <h4>Edit Repair Order/Invoice</h4>
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
                                            <label class="control-label">Enter Repair Item Description</label>
                                            <input type="text" placeholder="" class="form-control" id="repair_item_description" onchange="postDesc(this);" value="<?php echo $repair_item_description; ?>" required/>
                                            <div class="mbl"></div>
                                        </div>

                                    </div>



                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Enter Repair Item Serial #</label>
                                            <input type="text" placeholder="" class="form-control" id="serial_number" onchange="postSerial(this);" value="<?php echo $repair_serial_number; ?>" required>
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

                                                foreach($items as $item){
                                                    echo '<tr>';
                                                    echo '<td>' . $item['description'] . '</td>';
                                                    echo '<td>$' . number_format($item['cost'], 2) . '</td>';
                                                    echo '<td>$' . number_format($item['retail'], 2) . '</td>';
                                                    echo '<td>' . $item['quantity'] . '</td>';
                                                    echo '<td>$' . number_format($item['cost'] * $item['quantity'], 2) . '</td>';
                                                    echo '</tr>';
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


                                                <input type="text" class="form-control" id="description_to_complete" name="description_to_complete" value="<?php echo $desc_to_completed; ?>">



                                            </div>

                                            <div class="mbl"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <h4 class="box-heading">Labor $ Charge Amount</h4>

                                            <div class="input-group input-group-md">

                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" id="labor_charge" name="labor_charge" value="<?php echo $labor_charge; ?>" onchange="formatCurrency(this); sumTotal();" required>



                                            </div>

                                            <div class="mbl"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <h4 class="box-heading">Total Cost</h4>

                                            <div class="input-group input-group-md">

                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" id="total_cost_display" value="<?php echo number_format($total_cost, 2); ?>" onchange="formatCurrency(this);" readonly>
                                                <input type="hidden" class="form-control" id="total_cost" name="total_cost" value="<?php echo $total_cost; ?>" onchange="formatCurrency(this);">



                                            </div>

                                            <div class="mbl"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <h4 class="box-heading">Deposit Amount</h4>

                                            <div class="input-group input-group-md">

                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" id="deposit" name="deposit" value="<?php echo $deposit; ?>" onchange="formatCurrency(this); calcBalance(this);" required>



                                            </div>

                                            <div class="mbl"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <h4 class="box-heading">Balance Due At Pick Up</h4>

                                            <div class="input-group input-group-md">

                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" id="balance_display" value="<?php echo number_format($balance, 2); ?>" onchange="formatCurrency(this);" readonly>
                                                <input type="hidden" class="form-control" id="balance" name="balance" value="<?php echo $balance; ?>" onchange="formatCurrency(this);">



                                            </div>

                                            <div class="mbl"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <h4 class="box-heading">Repair Status </h4>

                                            <div class="form-group">

                                                <select class="form-control" name="repair_status">
                                                    <option>-- select repair status --</option>
                                                    <?php
                                                        foreach ($statuses as $row){
                                                            if($row['status'] == 'in_progress') {$s = 'In Progress';}
                                                            if($row['status'] == 'awaiting_parts') {$s = 'Awaiting Parts';}
                                                            if($row['status'] == 'fixed') {$s = 'Fixed A.C.P.';}
                                                            if($row['status'] == 'completed') {$s = 'Completed';}
                                                            if($row['status'] == $repair_status){
                                                                $selected = 'selected';
                                                            }
                                                            else {
                                                                $selected ='';
                                                            }
                                                            echo '<option value="' . $row['status'] . '" ' . $selected . '>' . $s . '</option>';
                                                        }



                                                        ?>
                                                </select>


                                            </div>

                                        </div>

                                    </div>

                    </div>

                </div><!-- end of panel-body-->
                <div class="panel-footer">
                <input type="hidden" value="<?php echo $date; ?>" name="date_added">


                                        <input type="submit" name="submit" class="btn btn-success" value="Update Record">


                        </form>
            </div>
            </div>
            </div>

        </div>

        


    </div><!-- contentpanel -->

</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>


<?php

require SERVER_ROOT . '/' . VERSION . '/includes/footer.php';
?>
<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'View RTO';

$customer_id = $_GET['customer_id'];
$rto_id = $_GET['rto_id'];

$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomerByIdRTO($customer_id, $rto_id);
$payment_history = $employeeClass->getCustomerPaymentHistoryRTO($customer_id, $rto_id);
$sums = $employeeClass->getCustomerPaymentHistorySumRTO($rto_id);
foreach($sums as $row){
    $amount_sum = $row['amount_sum'];
    $penalty_sum = $row['penalty_sum'];
    $sales_tax_sum = $row['tax_sum'];
}



$view = new View();

foreach($customer as $row){
    $name = $row['first_name'] . ' ' . $row['middle_name'] .  ' ' . $row['last_name'];
    $term = $row['payment_term'];
    $total_no_of_payments = $row['total_no_of_payments'];
    $downpayment = $row['downpayment'];
    $amount_of_each_payment = $row['amount_of_each_payment'];
    $deposit = $row['downpayment'];
    $other_charges = $row['other_charges'];
	$amount_behalf = $row['amount_behalf'];
    $sales_tax = $row['sales_tax'];
    $cash_price = $row['cash_price'];
    $model_no = $row['model_no'];
    $description = $row['description'];
    $serial_no = $row['serial_no'];
    $condition = $row['item_condition'];
    $due_date = $row['due_date'];
    $remaining_count = $row['remaining_count'];

}

if($amount_sum == 0){
    $total_sum = 0;
}
else{
    $total_sum = $amount_sum + $penalty_sum;
    $amount_paid = $amount_of_each_payment; 
}

$grand_total = ($amount_of_each_payment) * $total_no_of_payments + $deposit;
$remaining = $grand_total - $total_sum - $penalty_sum;
$date = date('Y-m-d');

if(isset($_POST['submit'])){
	$employeeClass->updateRTO();
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left" style="padding-top: 5px;">
                                <i class="icon icon-screen-smartphone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li><a href="rto-payment">RTO Payment</a></li>
									<li>View RTO</li>
                                </ul>
                                <h4>View RTO</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
						<div class="col-lg-12">
							<div class="row">
								<div class="panel panel-default">
									<div class="panel-heading"><h4 class="panel-title"><?php echo $name ; ?> RTO</h4></div>
									<div class="table-responsive">
										 <table class="table table-hover table-striped table-primary mb30 align-center">
											<thead>
											<tr>


												<th>Date</th>
												<th>Base Rent</th>
												<th>Sales Tax</th>
												<th>Penalty</th>
												<th>Amount Paid</th>

											</tr>
											</thead>
											<tbody>

											<?php
											$count = 1;
											foreach($payment_history as $row){
												echo '<tr>';
												//  echo '<td>' . $row['model_no'] . ' ' . $row['description'] .'</td>';


												echo '<td>' . date('m/d/Y H:i:s', strtotime($row['dateAdded'])) .'</td>';
												echo '<td>$' . number_format($row['amount_of_each_payment'], 2) .'</td>';
												echo '<td>$' . number_format($row['sales_tax'], 2) .'</td>';
												echo '<td>$' . number_format($row['penalty'], 2) .'</td>';
												echo '<td>$' . number_format($amount_paid, 2) .'</td>';
												echo '</tr>';

												$count++;
											}
											?>

											<tr>
												<td colspan="4" style="text-align: right;">Total Amount Paid</td>
												<td>$<?php echo number_format($total_sum, 2); ?></td>
											</tr>


											<tr>
												<td colspan="4" style="text-align: right;">Total Cost to Own</td>
												<td>$<?php echo number_format($grand_total, 2); ?></td>
											</tr>

											<tr>
												<td colspan="4" style="text-align: right;">Downpayment</td>
												<td>$<?php echo number_format($downpayment, 2); ?></td>
											</tr>

											<tr>
												<td colspan="4" style="text-align: right;">Remaining Balance</td>
												<td>$<?php echo number_format($remaining, 2); ?></td>
											</tr>

											<tr>
												<td colspan="4" style="text-align: right;">Remaining # of Payments</td>
												<td><?php echo $remaining_count; ?></td>
											</tr>

											</tbody>
										 </table>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-body">
										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
											<div class="row">


												<div class="col-lg-12">
													<div class="form-group">
														<h4 class="box-heading">Payment Term</h4>

														<div class="form-group">

															<input type="text" class="form-control" value="<?php echo $term; ?>" readonly>


														</div>


													</div>
												</div>

												<div class="form-group col-lg-4">
													<h4 class="box-heading">Downpayment</h4>
													<div class="input-group input-group-md">

														<span class="input-group-addon">$</span>
														<input type="text" class="form-control" value="<?php echo number_format($downpayment, 2); ?>" readonly>

													</div>

												</div>


												<div class="col-lg-3">
													<div class="form-group">
														<h4 class="box-heading">Total # of Payments</h4>

														<div class="form-group">

															<input type="number" class="form-control" value="<?php echo $total_no_of_payments; ?>" readonly>
														</div>


													</div>
												</div>


												<div class="form-group col-lg-5">
													<h4 class="box-heading">Amount of each payment</h4>
													<div class="input-group input-group-md">

														<span class="input-group-addon">$</span>
														<input type="text" class="form-control" value="<?php echo number_format($amount_of_each_payment, 2); ?>" readonly>

													</div>

												</div>

												<div class="form-group col-lg-3">
													<h4 class="box-heading">Other Charges Field</h4>
													<div class="input-group input-group-md">

														<span class="input-group-addon">$</span>
														<input type="text" class="form-control" value="<?php echo number_format($other_charges, 2); ?>" readonly>

													</div>

												</div>
												
												<div class="col-lg-4">
                                                    <h4 class="box-heading">Amount paid to others on your behalf</h4>
                                                    <div class="input-group col-lg-12">
                                                        <span class="input-group-addon">$</span>
														<input type="text" value="<?php echo number_format($amount_behalf, 2); ?>" class="form-control" id="amount_behalf" name="amount_behalf" onchange="formatCurrency(this)" readonly>
                                                    </div>
                                                </div>

												<div class="form-group col-lg-2">
													<h4 class="box-heading">Sales Tax</h4>
													<div class="input-group input-group-md">

														<span class="input-group-addon">$</span>
														<input type="text" class="form-control" value="<?php echo number_format(($sales_tax * 100) / $amount_of_each_payment, 2); ?>" readonly>



													</div>

												</div>

												<div class="form-group col-lg-3">
													<h4 class="box-heading">Cash Price of Merchandise</h4>
													<div class="input-group input-group-md">

														<span class="input-group-addon">$</span>
														<input type="text" class="form-control"  value="<?php echo $cash_price; ?>" readonly>



													</div>

												</div>

												<div class="form-group col-lg-6">
													<h4 class="box-heading">Model #</h4>
													<div class="form-group">


														<input type="text" class="form-control" value="<?php echo $model_no; ?>" readonly>



													</div>

												</div>

												<div class="form-group col-lg-6">
													<h4 class="box-heading">Description</h4>
													<div class="form-group">


														<input type="text" class="form-control" value="<?php echo $description; ?>" readonly>



													</div>

												</div>


												<div class="form-group col-lg-6">
													<h4 class="box-heading">Serial #</h4>
													<div class="form-group">


														<input type="text" class="form-control" value="<?php echo $serial_no; ?>" readonly>



													</div>

												</div>

												<div class="form-group col-lg-6">
													<h4 class="box-heading">Condition</h4>
													<div class="form-group">


														<input type="text" class="form-control" value="<?php echo $condition; ?>" readonly>



													</div>

												</div>





												<input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">
												<input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
												<input type="hidden" name="rto_id" value="<?php echo $rto_id; ?>">
												<input type="hidden" name="term" value="<?php echo $term; ?>">
												<input type="hidden" name="amount" value="<?php echo $amount_of_each_payment; ?>">
												<input type="hidden" name="due_date" value="<?php echo $due_date; ?>">
												<input type="hidden" name="remaining_count" value="<?php echo $remaining_count; ?>">
												<input type="hidden" name="downpayment" value="<?php echo $downpayment; ?>">
												<input type="hidden" name="sales_tax" value="<?php echo $sales_tax; ?>">

												<input type="hidden" value="<?php echo $date; ?>" name="date">
									</div>
									</div>
									<div class="panel-footer">
										<input type="submit" name="submit" class="btn btn-primary" value="Take Payment & Print RTO Ticket">
									</div>
								</div>
							</div>
						</div>

                        


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->
<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
   <script src="<?php echo ROOT; ?>js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo ROOT; ?>js/bootstrap-timepicker.min.js"></script>


<script>

        $(document).ready(function() {
            $('#openRepairTable').DataTable({
                responsive: true,
                "order": [[ 0, "asc" ]]
            });

            $('#closeRepairTable').DataTable({
                responsive: true,
                "order": [[ 0, "asc" ]]
            });
			
			$('#datepicker_from').datepicker();
                $('#datepicker_to').datepicker();
			
		
        });
    </script>


<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
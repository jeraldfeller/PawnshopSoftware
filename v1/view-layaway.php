<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'View RTO';

$customer_id = $_GET['customer_id'];
$layaway_id = $_GET['layaway_id'];

$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomerByIdLayaway($customer_id, $layaway_id);
$payment_history = $employeeClass->getCustomerPaymentHistoryLayaway($customer_id, $layaway_id);
$sums = $employeeClass->getCustomerPaymentHistorySumLayaway($layaway_id);
foreach($sums as $row){
    $amount_sum = $row['amount_sum'];
    $penalty_sum = $row['penalty_sum'];
    $sales_tax_sum = $row['tax_sum'];
}




$view = new View();

foreach($customer as $row){
    $name = $row['first_name'] . ' ' . $row['middle_name'] .  ' ' . $row['last_name'];
	$tax = $row['tax'];
	$minimum_required = $row['minimum_required'];
	$grace_period = $row['grace_period'];
	$downpayment = $row['down_payment'];
	$maximum_holding_days = $row['maximum_days'];
	$fixed_total = $row['fixed_total'];
	$remaining_total = $row['total'];
	$due_date = $row['due_date'];
}

$fixed_total = $fixed_total + $downpayment;
$minimum_required_converted = ($fixed_total * $tax) / 100;

$date = date('Y-m-d');

if(isset($_POST['submit'])){
	$employeeClass->updateLayaway();
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left" style="padding-top: 5px;">
                                <i class="fa fa-exchange"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li><a href="rto-payment">Layaway Payment</a></li>
									<li>View Layaway</li>
                                </ul>
                                <h4>View Layaway</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
						<div class="col-lg-12">
							<div class="row">
								<div class="panel panel-default">
									<div class="panel-heading"><h4 class="panel-title"><?php echo $name ; ?> Layaway</h4></div>
									<div class="table-responsive">
								
										 <table class="table table-hover table-striped table-primary mb30 align-center">
											<thead>
											<tr>


												<th>Date</th>
												<th>Minimum Required Payment</th>
												
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
												echo '<td>$' . number_format($minimum_required_converted, 2) .'</td>';
												echo '<td>$' . number_format($row['amount_paid'], 2) .'</td>';
									
												echo '</tr>';

												$count++;
											}
											?>

											<tr>
												<td colspan="2" style="text-align: right;">Total Amount Paid</td>
												<td>$<?php  echo number_format($amount_sum, 2); ?></td>
											</tr>


											<tr>
												<td colspan="2" style="text-align: right;">Total Cost to Own</td>
												<td>$<?php echo number_format($fixed_total, 2);   ?></td>
											</tr>

											<tr>
												<td colspan="2" style="text-align: right;">Downpayment</td>
												<td>$<?php echo number_format($downpayment, 2); ?></td>
											</tr>

											<tr>
												<td colspan="2" style="text-align: right;">Remaining Balance</td>
												<td>$<?php echo number_format($remaining_total, 2);  ?></td>
											</tr>

											

											</tbody>
										 </table>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-body">
										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
											<div class="row">
				

												<div class="col-lg-4">
													<div class="form-group">
														<h4 class="box-heading">Maximum Days</h4>

														<div class="form-group">

															<input type="text" class="form-control" value="<?php echo $maximum_holding_days; ?>" readonly>


														</div>


													</div>
												</div>

												<div class="col-lg-4">
													<div class="form-group">
														<h4 class="box-heading">Grace Period</h4>

														<div class="form-group">

															<input type="text" class="form-control" value="<?php echo $grace_period; ?>" readonly>


														</div>


													</div>
												</div>
												
												<div class="col-lg-4">
													<div class="form-group">
														<h4 class="box-heading">Due Date</h4>

														<div class="form-group">

															<input type="text" class="form-control" value="<?php echo date('m/d/Y', strtotime($due_date)); ?>" readonly>


														</div>


													</div>
												</div>
												
												
												<div class="col-lg-4">
													<div class="form-group">
														<h4 class="box-heading">Minimum Payment Required</h4>

														<div class="input-group input-group-md">
															<span class="input-group-addon">$</span>
															<input type="text" class="form-control" value="<?php echo number_format($minimum_required_converted, 2); ?>" readonly>


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
												
												<div class="form-group col-lg-4">
													<h4 class="box-heading">Amount Paid</h4>
													<div class="input-group input-group-md">

														<span class="input-group-addon">$</span>
														<input type="text" class="form-control" name="amount_paid" onchange="formatCurrency(this)">

													</div>

												</div>


												





												<input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">
												<input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
												<input type="hidden" name="lid" value="<?php echo $layaway_id; ?>">

												<input type="hidden" value="<?php echo $date; ?>" name="date">
												<input type="hidden" value="<?php echo $due_date; ?>" name="due_date">
												
									</div>
									</div>
									<div class="panel-footer">
										<input type="submit" name="submit" class="btn btn-primary" value="Take Payment & Print Layaway Ticket">
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
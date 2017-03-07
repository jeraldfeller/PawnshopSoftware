<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'View Title Pawns';

$curDate = date('Y-m-d');
$customer_id = $_GET['customer_id'];
$pawn_id = $_GET['pawn_id'];

$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomerByIdTitlePawn($customer_id, $pawn_id);
$items = $employeeClass->getTitlePawnImages($pawn_id);
$payment_history = $employeeClass->getCustomerPaymentHistoryPawns($customer_id, $pawn_id, 'title_pawns');
//$sums = $employeeClass->getCustomerPaymentHistorySumRTO($rto_id);
/*
foreach($sums as $row){
    $amount_sum = $row['amount_sum'];
    $penalty_sum = $row['penalty_sum'];
    $sales_tax_sum = $row['tax_sum'];
}

*/

$view = new View();

foreach($customer as $row){
    $customer_name = $row['first_name'] . ' ' . $row['middle_name'] .  ' ' . $row['last_name'];
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
    $interest_accured = $row['interest_accured'];
    $rate_first = $row['rate_first'];
    $rate_second = $row['rate_second'];
    $total_loan = $row['total_loan'];
    $interest_rate = $row['interest_rate'];
    $apr = $row['apr'];
    $terms_of_loan = $row['terms_of_loan'];
    $due_date = $row['due_date'];

    $make = $row['make'];
    $style = $row['style'];
    $no_of_door = $row['no_of_doors'];
    $exempt = $row['exempt'];

	$penalty = $row['penalty'];
}
$accured = ($loan_amount * $interest_rate) / 100;
$total_loan_with_interest = $loan_amount + $accured;

if($total_loan <= 0){
    $interest_accured = 0;
}


$total_loan = $total_loan + $penalty;
/*
if($amount_sum == 0){
    $total_sum = 0;
}
else{
    $total_sum = $amount_sum + $penalty_sum;
    $amount_paid = $amount_of_each_payment + $sales_tax;
}

$grand_total = ($amount_of_each_payment + $sales_tax) * $total_no_of_payments + $deposit;
$remaining = $grand_total - $total_sum - $penalty_sum;
$date = date('Y-m-d');


*/
require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left" style="padding-left: 15px;">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Title Pawns</li>
                                </ul>
                                <h4>Title Pawns</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                      
                        <div class="row">

                            <br>
                            <div class="col-md-12">
								<div class="panel panel-default">
								<div class="panel-heading"><h4 class="panel-title">Payment History</h4></div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-hover table-primary mb30 align-center">
												<thead>
														<tr>


															<th>Date</th>
															<th>Payment Type</th>
															<th>Amount Paid</th>

														</tr>
														</thead>
														<tbody>
														<?php

														$count = 1;
														$sumArray = array();
														foreach($payment_history as $row){
															echo '<tr>';
															//  echo '<td>' . $row['model_no'] . ' ' . $row['description'] .'</td>';


															echo '<td>' . date('m/d/Y', strtotime($row['date_added'])) .'</td>';
															echo '<td>' . $row['payment_method'] . '</td>';
															echo '<td>$' . number_format($row['total_amount'], 2) .'</td>';
															echo '</tr>';
															$sumArray[] = $row['total_amount'];

															$count++;
														}

														?>

														<tr>
															<td colspan="2" style="text-align: right;">Total Amount Paid</td>
															<td>$<?php echo number_format(array_sum($sumArray), 2); ?></td>
														</tr>



														<tr>
															<td colspan="2" style="text-align: right;">Total Loaned</td>
															<td>$<?php echo number_format($total_loan_with_interest, 2); ?></td>
														</tr>

														
														<tr>
															<td colspan="2" style="text-align: right;">Period Interest</td>
															<td>$<?php echo number_format($interest_accured, 2); ?></td>
														</tr>
														<tr>
															<td colspan="2" style="text-align: right;">Penalty</td>
															<td>$<?php echo number_format($penalty, 2); ?></td>
														</tr>
														<tr>
															<td colspan="2" style="text-align: right;"><b>Total Balance</b></td>
															<td><b>$<?php echo number_format($total_loan, 2); ?></b></td>
														</tr>

														</tbody>
											</table>
											</div>
										</div> <!-- panel body -->
								</div>
								
                            </div>
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading"><h4 class="panel-title">Pawn Details</h4></div>
									<div class="panel-body">
										<div class="row">
                            <?php
                            foreach($items as $item){
								if(!isset($item['pawn_image']) || $item['pawn_image'] == '' || $item['pawn_image'] == null){
									$src = '<img src="images/pawned_items/NO ID.jpg" style="width: 200px; height: 200px;">';
								}else{
									$src = '<img src="images/pawned_items/' . $item['pawn_image'] . '" style="width: 200px; height: 200px;">';
								}
                                echo '<div class="col-lg-3 col-sm-6 col-md-3">';
                                echo '<div class="thumbnail" style="width: 200px; height: 260px;">' . $src . '';

                                echo '<div class="caption align-center"><p>' . $item['title_image_file'] . '</p>';

                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }

                            ?>

                        </div>
                        <hr>
                        <div class="row">
						<div class="col-lg-4">
                            <div class="form-group">
                                    <h4 class="box-heading">Loan Amount</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo '$' . number_format($loan_amount, 2); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Interest Rate</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo '$' . number_format($accured, 2); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Total Amount</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo '$' . number_format($total_loan_with_interest, 2); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Loan Matrix</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo $loan_matrix_title; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Terms of Loan</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $terms_of_loan; ?>" readonly>
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
                                    <h4 class="box-heading">Vin #</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $vin; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Year</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $year; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Model</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $model; ?>" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Color</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $color; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Make</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $make; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Style</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $style; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Mileage</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $mileage; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading"># of Door</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $no_of_door; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Condition</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $condition; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Title #</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $title_no; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4 class="box-heading">Tag #</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo  $tag_no; ?>" readonly>
                                    </div>
                                </div>
                            </div>


                        </div>
									</div>
								</div>
							</div>


                            </div><!-- col-md-6 -->
                     


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->
<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
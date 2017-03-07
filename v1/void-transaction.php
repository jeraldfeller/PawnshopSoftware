<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Void Transaction';
$employeeClass = new Employee();
$adminClass = new Admin();
$view = new adminView();

$date = date("Y-m-d");


// Employee

// Admin
$pawns = $adminClass->getGeneralPawnsByDay($date);
$pawn_payment = $adminClass->getGeneralPawnsPaymentByDay($date);
$forfeited_pawns = $adminClass->getForfeitedGeneralPawnsByDay($date);
$title_pawn_payment = $adminClass->getTitlePawnsPaymentByDay($date);
$title_pawns = $adminClass->getTitlePawnsByDay($date);
$pos = $adminClass->getPointOfSaleByDay($date);
$repair = $employeeClass->getRepairInvoiceByDay($date);
$refill = $employeeClass->getRefillByDay($date);
$rto = $employeeClass->getRTOByDay($date);
$layaway = $employeeClass->getLayawayByDay($date);
$layaway_payment = $adminClass->getTakePaymentSalesByDay($date, 'layaway_tbl');
$scrap = $employeeClass->getScrapByDay($date);


require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-ban"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Void Transaction</li>
                                </ul>
                                <h4>Void Transaction</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->

                        <div class="row">

                            <div class="col-md-12">
                            <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-line">
											<li class="active"><a href="#general_pawns" data-toggle="tab"><strong>General Pawns</strong></a></li>
                                            <li><a href="#title_pawns" data-toggle="tab"><strong>Title Pawns</strong></a></li>
                                            <li><a href="#point_of_sale" data-toggle="tab"><strong>Point of Sale</strong></a></li>
                                            <li><a href="#repair" data-toggle="tab"><strong>Repair Order/Invoice</strong></a></li>
                                            <li><a href="#refill" data-toggle="tab"><strong>Wireless Refill Pin</strong></a></li>
                                            <li><a href="#rto" data-toggle="tab"><strong>RTO</strong></a></li>
                                            <li><a href="#layaway" data-toggle="tab"><strong>Layaway</strong></a></li>
                                            <li><a href="#scrap" data-toggle="tab"><strong>Scrap</strong></a></li>
								</ul>

                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="general_pawns">
												
													<ul class="nav nav-tabs nav-line">
														<li class="active"><a href="#general_pawns_second_level" data-toggle="tab">Pawns</a></li>
														<li><a href="#general_pawn_payments" data-toggle="tab">Payments</a></li>
														<li><a href="#general_pawns_forfeit" data-toggle="tab">Forfieted Pawns</a></li>
													</ul>
													<div class="tab-content nopadding noborder">
														<div class="tab-pane active" id="general_pawns_second_level">
															<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                                <thead class="align-center bold">
                                                                    <tr>
                                                                        <th>Customer Name</th>
                                                                        <th>Item Description</th>
                                                                        <th>Loan Matrix</th>

                                                                        <th>Loan Amount</th>
                                                                        <th>Action</th>
                                                                    </tr>

                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $i = 0;
                                                                        foreach($pawns as $row){


                                                                                $status = $row['status'];
                                                                                if($status == 'void'){
                                                                                    $disabled = 'disabled';
                                                                                }
                                                                                else{

                                                                                    $disabled = '';

                                                                                }

                                                                                echo '<tr>';
                                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                                $customer_id = $row['customer_id'];
                                                                                $loan_id = $row['loan_info_id'];

                                                                                $items = $employeeClass->getCustomerPawnedItemsPop($customer_id, $loan_id);
                                                                                echo '<td>';

                                                                                foreach($items as $item){
                                                                                    echo $item['item_description'] . ',';

                                                                                }
                                                                                $v = array_map('array_pop' , $items);
                                                                                $x = implode(',', $v);
                                                                                echo '</td>';
                                                                                echo '<td>' . $row['title'] . '</td>';
                                                                                echo '<td>$' . number_format($row['loan_amount'], 2) . '</td>';
                                                                                echo '<td><button id="btn_' . $i . '" data-btnId="btn_'.$i.'" data-cid="' . $customer_id . '" data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '" data-items="' . $x . '" data-matrix="' . $row['title'] . '" data-amount="$' . number_format($row['loan_amount'], 2) . '" data-type="loan_info_tbl"  class="btn btn-info btn-xs" data-value="' . $row['loan_info_id'] . '" data-toggle="modal" data-target="#general_pawn_modal" onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                                echo '</tr>';

                                                                            $i++;
                                                                        }

                                                                    ?>
                                                                </tbody>




                                                            </table>
															
															
															<div class="modal fade" id="general_pawn_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <span class="bold">Transaction Details:</span>
                                                                            <br>
                                                                            <br>
                                                                            <input type="hidden" id="modal_type">
                                                                            <input type="hidden" id="modal_value">
                                                                            <input type="hidden" id="modal_cid">
                                                                            <input type="hidden" id="modal_btnId">
                                                                            <table class="table-align-center table>
                                                                                <thead class="align-center bold">
                                                                                <tr>
                                                                                    <th>Customer Name</th>
                                                                                    <th>Item Description</th>
                                                                                    <th>Loan Matrix</th>

                                                                                    <th>Loan Amount</th>

                                                                                </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="modal_customer_name"></td>
                                                                                        <td id="modal_items"></td>
                                                                                        <td id="modal_matrix"></td>
                                                                                        <td id="modal_amount"></td>
                                                                                    </tr>
                                                                                </tbody>




                                                                            </table>
                                                                            <br>
                                                                            <br>
                                                                            <span class="bold">Reason:</span>
                                                                            <br>
                                                                            <br>
                                                                            <input type="text" class="col-lg-12 form-control" id="modal_reason">
                                                                            <br>
                                                                            <br>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtn()">Yes</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                        </div>
														
														
														<div class="tab-pane" id="general_pawn_payments">
															<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                                    <thead class="align-center bold">
                                                                    <tr>
                                                                        <th>Customer Name</th>
                                                                        <th>Item Description</th>
                                                                        <th>Loan Amount</th>
                                                                        <th>Amount Paid</th>
                                                                        <th>Action</th>
                                                                    </tr>

                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $i = 0;
                                                                    foreach($pawn_payment as $row){


                                                                        $status = $row['status'];
                                                                        if($status == 'void'){
                                                                            $disabled = 'disabled';
                                                                        }
                                                                        else{

                                                                            $disabled = '';

                                                                        }

                                                                        echo '<tr>';
                                                                        echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                        $customer_id = $row['customer_id'];
                                                                        $loan_id = $row['loan_info_id'];

                                                                        $items = $employeeClass->getCustomerPawnedItemsPop($customer_id, $loan_id);
                                                                        echo '<td>';

                                                                        foreach($items as $item){
                                                                            echo $item['item_description'] . ',';

                                                                        }
                                                                        $v = array_map('array_pop' , $items);
                                                                        $x = implode(',', $v);
                                                                        echo '</td>';
                                                                        echo '<td>$' . number_format($row['loan_amount'], 2) . '</td>';
                                                                        echo '<td>$' . number_format($row['total_amount'], 2) . '</td>';
                                                                        echo '<td><button id="btn_payment_' . $i . '"
                                                                                    data-btnId="btn_payment_'.$i.'"
                                                                                    data-cid="' . $customer_id . '"
                                                                                    data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
                                                                                    data-items="' . $x . '"
                                                                                    data-matrix="' . $row['title'] . '"
                                                                                    data-interest="' . $row['interest_accured'] . '"
                                                                                    data-amount="$' . number_format($row['loan_amount'], 2) . '"
                                                                                    data-amount-data="' . $row['total_amount'] . '"
                                                                                    data-amount-paid="$' . number_format($row['total_amount'], 2) . '"
                                                                                    data-due-date = "' . $row['due_date'] . '"
                                                                                    data-tid="' . $row['loan_info_id'] . '"
                                                                                    data-type="payment_tbl"
                                                                                    data-transaction-type="general"  class="btn btn-info btn-xs" data-value="' . $row['payment_id'] . '"
                                                                                    data-toggle="modal"
                                                                                    data-target="#general_pawn_payment_modal"
                                                                                    onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                        echo '</tr>';

                                                                        $i++;
                                                                    }

                                                                    ?>
                                                                    </tbody>




                                                                </table>


                                                                <div class="modal fade" id="general_pawn_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header info">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <span class="bold">Transaction Details:</span>
                                                                                <br>
                                                                                <br>
                                                                                <input type="hidden" id="modal_payment_type">
                                                                                <input type="hidden" id="modal_payment_value">
                                                                                <input type="hidden" id="modal_payment_cid">
                                                                                <input type="hidden" id="modal_payment_interest">
                                                                                <input type="hidden" id="modal_payment_amount_paid">
                                                                                <input type="hidden" id="modal_payment_btnId">
                                                                                <input type="hidden" id="modal_payment_tid">
                                                                                <input type="hidden" id="modal_payment_due_date">
                                                                                <input type="hidden" id="modal_payment_transaction_type">
                                                                                <table class="table-align-center table>
                                                                                <thead class="align-center bold">
                                                                                <tr>
                                                                                    <th>Customer Name</th>
                                                                                    <th>Item Description</th>
                                                                                    <th>Loan Amount</th>
                                                                                    <th>Amount Paid</th>

                                                                                </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="modal_payment_customer_name"></td>
                                                                                    <td id="modal_payment_items"></td>
                                                                                    <td id="modal_payment_amount"></td>
                                                                                    <td id="modal_payment_paid"></td>
                                                                                </tr>
                                                                                </tbody>




                                                                                </table>
                                                                                <br>
                                                                                <br>
                                                                                <span class="bold">Reason:</span>
                                                                                <br>
                                                                                <br>
                                                                                <input type="text" class="col-lg-12 form-control" id="modal_payment_reason">
                                                                                <br>
                                                                                <br>


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnPayment()">Yes</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
														</div>
														
														
														<div class="tab-pane" id="general_pawns_forfeit">
															<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                                <thead class="align-center bold">
                                                                    <tr>
                                                                        <th>Customer Name</th>
                                                                        <th>Item Description</th>
                                                                        <th>Loan Matrix</th>

                                                                        <th>Loan Amount</th>
                                                                        <th>Action</th>
                                                                    </tr>

                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $i = 0;
                                                                        foreach($forfeited_pawns as $row){


                                                                                $status = $row['status'];
                                                                                if($status == 'active'){
                                                                                    $disabled = 'disabled';
                                                                                }
                                                                                else{

                                                                                    $disabled = '';

                                                                                }

                                                                                echo '<tr>';
                                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                                $customer_id = $row['customer_id'];
                                                                                $loan_id = $row['loan_info_id'];

                                                                                $items = $employeeClass->getCustomerPawnedItemsPop($customer_id, $loan_id);
                                                                                echo '<td>';

                                                                                foreach($items as $item){
                                                                                    echo $item['item_description'] . ',';

                                                                                }
                                                                                $v = array_map('array_pop' , $items);
                                                                                $x = implode(',', $v);
                                                                                echo '</td>';
                                                                                echo '<td>' . $row['title'] . '</td>';
                                                                                echo '<td>$' . number_format($row['loan_amount'], 2) . '</td>';
                                                                                echo '<td><button id="btn_payment_' . $i . '" 
																						  data-btnId="btn_payment_'.$i.'" 
																						  data-cid="' . $customer_id . '" 
																						  data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '" 
																						  data-items="' . $x . '" data-matrix="' . $row['title'] . '" 
																						  data-amount="$' . number_format($row['loan_amount'], 2) . '" 
																						  data-type="loan_info_tbl_forfeit" 
																						  class="btn btn-info btn-xs" 
																						  data-value="' . $row['loan_info_id'] . '" 
																						  data-toggle="modal" 
																						  data-target="#general_forfeited_pawn_modal" 
																						  onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                                echo '</tr>';

                                                                            $i++;
                                                                        }

                                                                    ?>
                                                                </tbody>




                                                            </table>
															
															
															<div class="modal fade" id="general_forfeited_pawn_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <span class="bold">Transaction Details:</span>
                                                                            <br>
                                                                            <br>
                                                                            <input type="hidden" id="modal_forfeit_type">
                                                                            <input type="hidden" id="modal_forfeit_value">
                                                                            <input type="hidden" id="modal_forfeit_cid">
                                                                            <input type="hidden" id="modal_forfeit_btnId">
                                                                            <table class="table-align-center table>
                                                                                <thead class="align-center bold">
                                                                                <tr>
                                                                                    <th>Customer Name</th>
                                                                                    <th>Item Description</th>
                                                                                    <th>Loan Matrix</th>

                                                                                    <th>Loan Amount</th>

                                                                                </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="modal_forfeit_customer_name"></td>
                                                                                        <td id="modal_forfeit_items"></td>
                                                                                        <td id="modal_forfeit_matrix"></td>
                                                                                        <td id="modal_forfeit_amount"></td>
                                                                                    </tr>
                                                                                </tbody>




                                                                            </table>
                                                                            <br>
                                                                            <br>
                                                                            <span class="bold">Reason:</span>
                                                                            <br>
                                                                            <br>
                                                                            <input type="text" class="col-lg-12 form-control" id="modal_forfeit_reason">
                                                                            <br>
                                                                            <br>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnForfeit()">Yes</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                        </div>
														
														
															
														</div>
													
												
                                
									</div>
									<div class="tab-pane" id="title_pawns">
										<ul class="nav nav-tabs nav-line">
														<li class="active"><a href="#title_pawns_second_level" data-toggle="tab">Title Pawns</a></li>
														<li><a href="#title_pawn_payments" data-toggle="tab">Title Pawn Payments</a></li>
										</ul>
										<div class="tab-content nopadding noborder">
											<div class="tab-pane active" id="title_pawns_second_level">
												<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                            <thead>
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Vin #</th>
                                                                <th>Year</th>
                                                                <th>Model</th>
                                                                <th>Title #</th>
                                                                <th>Loan Matrix</th>
                                                                <th>Loan Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 0;
                                                                    foreach($title_pawns as $row){

                                                                        $status = $row['status'];
                                                                        if($status == 'void'){
                                                                            $disabled = 'disabled';
                                                                        }
                                                                        else{

                                                                            $disabled = '';

                                                                        }

                                                                        echo '<tr>';
                                                                        echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                        echo '<td>' . $row['vin_no'] . '</td>';
                                                                        echo '<td>' . $row['year'] . '</td>';
                                                                        echo '<td>' . $row['model'] . '</td>';
                                                                        echo '<td>' . $row['title_no'] . '</td>';
                                                                        echo '<td>' . $row['title'] . '</td>';
                                                                        echo '<td>' . $row['total_loan_amount'] . '</td>';
                                                                        echo '<td><button id="btn_title_' . $i . '" data-btnId="btn_title_'.$i.'" data-cid="' . $row['customer_id'] . '" data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '" data-vin="' . $row['vin_no'] . '" data-model="' . $row['model'] . '" data-matrix="' . $row['title'] . '" data-amount="$' . number_format($row['total_loan_amount'], 2) . '" data-type="title_pawn_tbl"  class="btn btn-info btn-xs" data-value="' . $row['tittle_pawn_id'] . '" data-toggle="modal" data-target="#title_pawn_modal" onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                        echo '</tr>';

                                                                        $i++;
                                                                    }


                                                                ?>

                                                            </tbody>


                                                        </table>
														
														<div class="modal fade" id="title_pawn_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="bold">Transaction Details:</span>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" id="modal_title_type">
                                                            <input type="hidden" id="modal_title_value">
                                                            <input type="hidden" id="modal_title_cid">
                                                            <input type="hidden" id="modal_title_btnId">
                                                            <table class="table-align-center table">
                                                                            <thead class="align-center bold">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Vin #</th>
                                                                <th>Model</th>
                                                                <th>Matrix</th>
                                                                <th>Loan Amount</th>

                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td id="modal_title_customer_name"></td>
                                                                <td id="modal_title_l_vin"></td>
                                                                <td id="modal_title_l_model"></td>
                                                                <td id="modal_title_matrix"></td>
                                                                <td id="modal_title_amount"></td>
                                                            </tr>
                                                            </tbody>




                                                            </table>
                                                            <br>
                                                            <br>
                                                            <span class="bold">Reason:</span>
                                                            <br>
                                                            <br>
                                                            <input type="text" class="col-lg-12 form-control" id="modal_title_reason">
                                                            <br>
                                                            <br>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnTitle()">Yes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->

											</div>
											<div class="tab-pane" id="title_pawn_payments">
											
												<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                                    <thead class="align-center bold">
                                                                    <tr>
                                                                        <th>Customer Name</th>
                                                                        <th>Vin #</th>
                                                                        <th>Year</th>
                                                                        <th>Model</th>
                                                                        <th>Title #</th>
                                                                        <th>Loan Amount</th>
                                                                        <th>Amount Paid</th>
                                                                        <th>Action</th>
                                                                    </tr>

                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $i = 0;
                                                                    foreach($title_pawn_payment as $row){


                                                                        $status = $row['status'];
                                                                        if($status == 'void'){
                                                                            $disabled = 'disabled';
                                                                        }
                                                                        else{

                                                                            $disabled = '';

                                                                        }

                                                                        echo '<tr>';
                                                                        echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                        echo '<td>' . $row['vin_no'] . '</td>';
                                                                        echo '<td>' . $row['year'] . '</td>';
                                                                        echo '<td>' . $row['model'] . '</td>';
                                                                        echo '<td>' . $row['title_no'] . '</td>';
                                                                        echo '<td>$' . number_format($row['total_loan_amount'], 2) . '</td>';
                                                                        echo '<td>$' . number_format($row['total_amount'], 2) . '</td>';
                                                                        echo '<td><button id="btn_title_payment_' . $i . '"
                                                                                    data-btnId="btn_title_payment_'.$i.'"
                                                                                    data-cid="' . $row['customer_id'] . '"
                                                                                    data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
                                                                                    data-vin="' . $row['vin_no'] . '"
                                                                                    data-year="' . $row['year'] . '"
                                                                                    data-model="' . $row['model'] . '"
                                                                                    data-title-no="' . $row['title_no'] . '"
                                                                                    data-matrix="' . $row['title'] . '"
                                                                                    data-interest="' . $row['interest_accured'] . '"
                                                                                    data-amount="$' . number_format($row['total_loan_amount'], 2) . '"
                                                                                    data-amount-data="' . $row['total_amount'] . '"
                                                                                    data-amount-paid="$' . number_format($row['total_amount'], 2) . '"
                                                                                    data-due-date="' . $row['due_date'] . '"
                                                                                    data-tid="' . $row['tittle_pawn_id'] . '"
                                                                                    data-type="payment_tbl"
                                                                                    data-transaction-type="title"  class="btn btn-info btn-xs" data-value="' . $row['payment_id'] . '"
                                                                                    data-toggle="modal"
                                                                                    data-target="#general_title_pawn_payment_modal"
                                                                                    onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                        echo '</tr>';

                                                                        $i++;
                                                                    }

                                                                    ?>
                                                                    </tbody>




                                                                </table>


                                                                <div class="modal fade" id="general_title_pawn_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header info">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <span class="bold">Transaction Details:</span>
                                                                                <br>
                                                                                <br>
                                                                                <input type="hidden" id="modal_title_payment_type">
                                                                                <input type="hidden" id="modal_title_payment_value">
                                                                                <input type="hidden" id="modal_title_payment_cid">
                                                                                <input type="hidden" id="modal_title_payment_interest">
                                                                                <input type="hidden" id="modal_title_payment_amount_paid">
                                                                                <input type="hidden" id="modal_title_payment_btnId">
                                                                                <input type="hidden" id="modal_title_payment_tid">
                                                                                <input type="hidden" id="modal_title_payment_due_date">
                                                                                <input type="hidden" id="modal_title_payment_transaction_type">
                                                                                <table class="table-align-center table>
                                                                                <thead class="align-center bold">
                                                                                <tr>
                                                                                    <th>Customer Name</th>
                                                                                    <th>Vin #</th>
                                                                                    <th>Model</th>

                                                                                    <th>Loan Amount</th>
                                                                                    <th>Amount Paid</th>

                                                                                </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="modal_title_payment_customer_name"></td>
                                                                                    <td id="modal_title_vin"></td>
                                                                                    <td id="modal_title_model"></td>
                                                                                    <td id="modal_title_payment_amount"></td>
                                                                                    <td id="modal_title_payment_paid"></td>
                                                                                </tr>
                                                                                </tbody>




                                                                                </table>
                                                                                <br>
                                                                                <br>
                                                                                <span class="bold">Reason:</span>
                                                                                <br>
                                                                                <br>
                                                                                <input type="text" class="col-lg-12 form-control" id="modal_title_payment_reason">
                                                                                <br>
                                                                                <br>


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnTitlePayment()">Yes</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
											</div>
										</div>
									</div>
									<div class="tab-pane" id="point_of_sale">
										<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                            <thead class="align-center bold">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Item Description</th>
                                                                <th>Price</th>
                                                                <th>Void</th>
                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $i = 0;
                                                            foreach($pos as $row){


                                                                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                                                                $status = $row['status'];
                                                                if($status == 'void'){
                                                                    $disabled = 'disabled';
                                                                }
                                                                else{

                                                                    $disabled = '';

                                                                }

                                                                echo '<tr>';
                                                                echo '<td>' . $full_name . '</td>';

                                                                echo '</td>';
                                                                $customer_id = $row['customer_id'];
                                                                $sale_id = $row['sale_id'];
                                                                $items = $employeeClass->getCustomerPOSItemsVoid($customer_id, $sale_id);


                                                                echo '<td>';
                                                                    foreach($items as $row){
                                                                        echo $row['description'] . '(' . $row['quantity'] . '),';
                                                                    }
                                                                $item_modal = $employeeClass->getCustomerPOSItemsPOP($customer_id, $sale_id);
                                                                $v = array_map('array_pop' , $item_modal);
                                                                $x = implode(',', $v);
                                                                echo '</td>';
                                                                echo '<td>$' . $row['total'] . '</td>';
                                                                echo '<td><button id="btn_pos_' . $i . '" data-btnId="btn_pos_'.$i.'" data-cid="' . $customer_id . '" data-customer="' . $full_name . '" data-items="' . $x . '" data-amount="$' . number_format($row['total'], 2) . '" data-type="point_of_sale_tbl"  class="btn btn-info btn-xs" data-value="' . $row['sale_id'] . '" data-toggle="modal" data-target="#pos_modal" onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                echo '</tr>';

                                                                $i++;
                                                            }

                                                            ?>
                                                            </tbody>




                                                        </table>
                                               
                                            <div class="modal fade" id="pos_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="bold">Transaction Details:</span>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" id="modal_pos_type">
                                                            <input type="hidden" id="modal_pos_value">
                                                            <input type="hidden" id="modal_pos_cid">
                                                            <input type="hidden" id="modal_pos_btnId">
                                                            <table class="table-align-center table>
                                                                            <thead class="align-center bold">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Iten Description</th>
                                                                <th>Price</th>
                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td id="modal_pos_customer_name"></td>
                                                                <td id="modal_pos_items"></td>
                                                                <td id="modal_pos_amount"></td>

                                                            </tr>
                                                            </tbody>




                                                            </table>
                                                            <br>
                                                            <br>
                                                            <span class="bold">Reason:</span>
                                                            <br>
                                                            <br>
                                                            <input type="text" class="col-lg-12 form-control" id="modal_pos_reason">
                                                            <br>
                                                            <br>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnPos()">Yes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
									</div>
									
									
									<div class="tab-pane" id="repair">
									<table class="table-align-center table table-hover table-primary btn-xs" id="theTable">
                                                            <thead>
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Repair Description</th>
                                                                <th>Price</th>
                                                                <th>Void</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $i = 0;
                                                            foreach($repair as $row){

                                                                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                                                                $status = $row['invoice_status'];
                                                                if($status == 'void'){
                                                                    $disabled = 'disabled';
                                                                }
                                                                else{

                                                                    $disabled = '';

                                                                }
                                                                echo '<tr>';
                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                echo '<td>' . $row['repair_item_description'] . '</td>';
                                                                echo '<td>$' . number_format($row['total_cost'], 2) . '</td>';
                                                                echo '<td><button id="btn_repair_' . $i . '" data-btnId="btn_repair_'.$i.'" data-cid="' . $row['customer_id'] . '" data-customer="' . $full_name . '" data-items="' . $row['repair_item_description'] . '" data-amount="$' . number_format($row['total_cost'], 2) . '" data-type="repair_invoice_tbl"  class="btn btn-info btn-xs" data-value="' . $row['repair_invoice_id'] . '" data-toggle="modal" data-target="#repair_modal" onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                echo '</tr>';

                                                                $i++;
                                                            }


                                                            ?>

                                                            </tbody>


                                                        </table>
														
														<div class="modal fade" id="repair_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="bold">Transaction Details:</span>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" id="modal_repair_type">
                                                            <input type="hidden" id="modal_repair_value">
                                                            <input type="hidden" id="modal_repair_cid">
                                                            <input type="hidden" id="modal_repair_btnId">
                                                            <table class="table-align-center table>
                                                                            <thead class="align-center bold">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Repair Description</th>
                                                                <th>Price</th>

                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td id="modal_repair_customer_name"></td>
                                                                <td id="modal_repair_items"></td>
                                                                <td id="modal_repair_amount"></td>
                                                            </tr>
                                                            </tbody>




                                                            </table>
                                                            <br>
                                                            <br>
                                                            <span class="bold">Reason:</span>
                                                            <br>
                                                            <br>
                                                            <input type="text" class="col-lg-12 form-control" id="modal_repair_reason">
                                                            <br>
                                                            <br>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnRepair()">Yes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
										
									</div>
									
									<div class="tab-pane" id="refill">
									
										<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                            <thead>
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Plan</th>
                                                                <th>PIN</th>
                                                                <th>Price</th>
                                                                <th>Void</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $i = 0;
                                                            foreach($refill as $row){
                                                                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                                                                $status = $row['status'];
                                                                if($status == 'void'){
                                                                    $disabled = 'disabled';
                                                                }
                                                                else{

                                                                    $disabled = '';

                                                                }
                                                                echo '<tr>';
                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                echo '<td>' . $row['plan_name'] . '</td>';
                                                                echo '<td>' . $row['pin_no'] . '</td>';
                                                                echo '<td>$' . number_format($row['grand_total'], 2) . '</td>';
                                                                echo '<td><button id="btn_refill_' . $i . '" data-btnId="btn_refill_'.$i.'" data-cid="' . $row['customer_id'] . '" data-customer="' . $full_name . '" data-items="' . $row['plan_name'] . '" data-pin="' . $row['pin_no'] . '" data-amount="$' . number_format($row['grand_total'], 2) . '" data-type="refill_tbl"  class="btn btn-info btn-xs" data-value="' . $row['refill_id'] . '" data-toggle="modal" data-target="#refill_modal" onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                echo '</tr>';

                                                                $i++;
                                                            }




                                                            ?>

                                                            </tbody>


                                                        </table>
														
														<div class="modal fade" id="refill_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="bold">Transaction Details:</span>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" id="modal_refill_type">
                                                            <input type="hidden" id="modal_refill_value">
                                                            <input type="hidden" id="modal_refill_cid">
                                                            <input type="hidden" id="modal_refill_btnId">
                                                            <table class="table-align-center table>
                                                                            <thead class="align-center bold">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Plan</th>
                                                                <th>Pin</th>
                                                                <th>Price</th>

                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td id="modal_refill_customer_name"></td>

                                                                <td id="modal_refill_items"></td>
                                                                <td id="modal_refill_pin"></td>
                                                                <td id="modal_refill_amount"></td>
                                                            </tr>
                                                            </tbody>




                                                            </table>
                                                            <br>
                                                            <br>
                                                            <span class="bold">Reason:</span>
                                                            <br>
                                                            <br>
                                                            <input type="text" class="col-lg-12 form-control" id="modal_refill_reason">
                                                            <br>
                                                            <br>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnRefill()">Yes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
										
									</div>
									
									<div class="tab-pane" id="rto">
										<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                            <thead>
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Model #</th>
                                                                <th>Description</th>
                                                                <th>Condition</th>
                                                                <th>Cash Price</th>
                                                                <th>Void</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $i = 0;
                                                            foreach($rto as $row){
                                                                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                                                                $status = $row['status'];
                                                                if($status == 'void'){
                                                                    $disabled = 'disabled';
                                                                }
                                                                else{

                                                                    $disabled = '';

                                                                }
                                                                echo '<tr>';
                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                echo '<td>' . $row['model_no'] . '</td>';
                                                                echo '<td>' . $row['description'] . '</td>';
                                                                echo '<td>' . $row['item_condition'] . '</td>';
                                                                echo '<td>$' . number_format($row['cash_price'], 2) . '</td>';
                                                                echo '<td><button id="btn_rto_' . $i . '" data-btnId="btn_rto_'.$i.'" data-cid="' . $row['customer_id'] . '" data-customer="' . $full_name . '" data-items="' . $row['model_no'] . '" data-description="' . $row['description'] . '" data-condition="' . $row['item_condition'] .'" data-amount="$' . number_format($row['cash_price'], 2) . '" data-type="rto_tbl"  class="btn btn-info btn-xs" data-value="' . $row['rto_id'] . '" data-toggle="modal" data-target="#rto_modal" onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                echo '</tr>';

                                                                $i++;
                                                            }


                                                            ?>

                                                            </tbody>


                                                        </table>
														
														
														<div class="modal fade" id="rto_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="bold">Transaction Details:</span>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" id="modal_rto_type">
                                                            <input type="hidden" id="modal_rto_value">
                                                            <input type="hidden" id="modal_rto_cid">
                                                            <input type="hidden" id="modal_rto_btnId">
                                                            <table class="table-align-center table>
                                                                            <thead class="align-center bold">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Model #</th>
                                                                <th>Description</th>
                                                                <th>Condition</th>
                                                                <th>Cash Price</th>

                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td id="modal_rto_customer_name"></td>

                                                                <td id="modal_rto_items"></td>
                                                                <td id="modal_rto_description"></td>
                                                                <td id="modal_rto_condition"></td>
                                                                <td id="modal_rto_amount"></td>
                                                            </tr>
                                                            </tbody>




                                                            </table>
                                                            <br>
                                                            <br>
                                                            <span class="bold">Reason:</span>
                                                            <br>
                                                            <br>
                                                            <input type="text" class="col-lg-12 form-control" id="modal_rto_reason">
                                                            <br>
                                                            <br>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnRto()">Yes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
									</div>

									<div class="tab-pane" id="layaway">

													<ul class="nav nav-tabs nav-line">
														<li class="active"><a href="#layaway_second_level" data-toggle="tab">Layaway</a></li>
														<li><a href="#layaway_payments" data-toggle="tab">Payments</a></li>
													</ul>
													<div class="tab-content nopadding noborder">
														<div class="tab-pane active" id="layaway_second_level">
															<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                                <thead class="align-center bold">
                                                                    <tr>
                                                                        <th>Customer Name</th>
                                                                        <th>Items</th>
                                                                        <th>Total Amount</th>
                                                                        <th>Action</th>
                                                                    </tr>

                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $i = 0;
                                                                    foreach($layaway as $row){


                                                                        $status = $row['status'];
                                                                        if($status == 'void'){
                                                                            $disabled = 'disabled';
                                                                        }
                                                                        else{

                                                                            $disabled = '';

                                                                        }

                                                                        echo '<tr>';
                                                                        echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                        $items = $employeeClass->getCustomerLayawayItems($row['customer_id'], $row['lid']);
                                                                        echo '<td>';
                                                                        $itemArr = array();
                                                                        foreach($items as $item){
                                                                            echo $item['description'] . ', ';
                                                                            $itemArr[] = array($item['description']);

                                                                        }



                                                                        $v = array_map('array_pop' , $itemArr);
                                                                        $x = implode(',', $v);
                                                                        echo '</td>';
                                                                        echo '<td>$' . number_format($row['total'], 2) . '</td>';
                                                                        echo '<td><button id="btn_layaway_' . $i . '"
                                                                                    data-btnId="btn_layaway_'.$i.'"
                                                                                    data-cid="' . $row['customer_id'] . '"
                                                                                    data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
                                                                                    data-items="' . $x . '"
                                                                                    data-amount="$' . number_format($row['total'], 2) . '"
                                                                                    data-type="layaway_tbl"  class="btn btn-info btn-xs"
                                                                                    data-value="' . $row['lid'] . '"
                                                                                    data-toggle="modal"
                                                                                    data-target="#layaway_modal" onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                        echo '</tr>';

                                                                        $i++;
                                                                    }

                                                                    ?>
                                                                </tbody>




                                                            </table>


															<div class="modal fade" id="layaway_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <span class="bold">Transaction Details:</span>
                                                                            <br>
                                                                            <br>
                                                                            <input type="hidden" id="modal_layaway_type">
                                                                            <input type="hidden" id="modal_layaway_value">
                                                                            <input type="hidden" id="modal_layaway_cid">
                                                                            <input type="hidden" id="modal_layaway_btnId">
                                                                            <table class="table-align-center table>
                                                                                <thead class="align-center bold">
                                                                                <tr>
                                                                                    <th>Customer Name</th>
                                                                                    <th>Items</th>
                                                                                    <th>Total</th>

                                                                                </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="modal_layaway_customer_name"></td>
                                                                                        <td id="modal_layaway_items"></td>
                                                                                        <td id="modal_layaway_amount"></td>

                                                                                    </tr>
                                                                                </tbody>




                                                                            </table>
                                                                            <br>
                                                                            <br>
                                                                            <span class="bold">Reason:</span>
                                                                            <br>
                                                                            <br>
                                                                            <input type="text" class="col-lg-12 form-control" id="modal_layaway_reason">
                                                                            <br>
                                                                            <br>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnLayaway()">Yes</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                        </div>


														<div class="tab-pane" id="layaway_payments">

															<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                                    <thead class="align-center bold">
                                                                    <tr>
                                                                        <th>Customer Name</th>
                                                                        <th>Items</th>
                                                                        <th>Total</th>
                                                                        <th>Amount Paid</th>
                                                                        <th>Action</th>
                                                                    </tr>

                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                            $i = 0;

                                                            foreach($layaway_payment as $key){

                                                                $layaway = $employeeClass->getCustomerLayawayItems($key['customer_id'], $key['transaction_id']);
                                                                foreach($layaway as $row) {
                                                                        $status = $key['status'];
                                                                        if ($status == 'void') {
                                                                            $disabled = 'disabled';
                                                                        } else {

                                                                            $disabled = '';

                                                                        }

                                                                        echo '<tr>';
                                                                        echo '<td>' . $key['first_name'] . ' ' . $key['middle_name'] . ' ' . $key['last_name'] . '</td>';


                                                                        $items = $employeeClass->getCustomerLayawayItems($key['customer_id'], $key['transaction_id']);
                                                                        $transaction = $employeeClass->getCustomerByIdLayaway($key['customer_id'], $key['transaction_id']);
                                                                        echo '<td>';

                                                                        $itemArr = array();
                                                                        foreach($items as $item){
                                                                            echo $item['description'] . ', ';
                                                                            $itemArr[] = array($item['description']);

                                                                        }



                                                                        $v = array_map('array_pop' , $itemArr);
                                                                        $x = implode(',', $v);
                                                                        echo '</td>';
                                                                        echo '<td>$' . number_format($transaction[0]['total'], 2) . '</td>';
                                                                        echo '<td>$' . number_format($key['total_amount'], 2) . '</td>';
                                                                        echo '<td><button id="btn_layaway_payment_' . $i . '"
                                                                                        data-btnId="btn_layaway_payment_' . $i . '"
                                                                                        data-cid="' . $key['customer_id'] . '"
                                                                                        data-customer="' . $transaction[0]['first_name'] . ' ' . $transaction[0]['middle_name'] . ' ' . $transaction[0]['last_name'] . '"
                                                                                        data-items="' . $x . '"
                                                                                        data-amount="$' . number_format($transaction[0]['total'], 2) . '"
                                                                                        data-amount-data="' . $key['total_amount'] . '"
                                                                                        data-amount-paid="$' . number_format($key['total_amount'], 2) . '"
                                                                                        data-due-date="' . $transaction[0]['due_date'] . '"
                                                                                        data-tid="' . $transaction[0]['lid'] . '"
                                                                                        data-type="payment_tbl"
                                                                                        data-transaction-type="layaway"  class="btn btn-info btn-xs" data-value="' . $key['payment_id'] . '"
                                                                                        data-toggle="modal"
                                                                                        data-target="#layaway_payment_modal"
                                                                                        onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                        echo '</tr>';

                                                                        $i++;
                                                                    }
                                                                    }

                                                                    ?>
                                                                    </tbody>




                                                                </table>


                                                                <div class="modal fade" id="layaway_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header info">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <span class="bold">Transaction Details:</span>
                                                                                <br>
                                                                                <br>
                                                                                <input type="hidden" id="modal_layaway_payment_type">
                                                                                <input type="hidden" id="modal_layaway_payment_value">
                                                                                <input type="hidden" id="modal_layaway_payment_cid">

                                                                                <input type="hidden" id="modal_layaway_payment_amount_paid">
                                                                                <input type="hidden" id="modal_layaway_payment_btnId">
                                                                                <input type="hidden" id="modal_layaway_payment_tid">

                                                                                <input type="hidden" id="modal_layaway_payment_transaction_type">
                                                                                 <input type="hidden" id="modal_layaway_payment_due_date">
                                                                                <table class="table-align-center table>
                                                                                <thead class="align-center bold">
                                                                                <tr>
                                                                                    <th>Customer Name</th>
                                                                                    <th>Items</th>
                                                                                    <th>Total</th>
                                                                                    <th>Amount Paid</th>

                                                                                </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="modal_layaway_payment_customer_name"></td>
                                                                                    <td id="modal_layaway_payment_items"></td>
                                                                                    <td id="modal_layaway_payment_amount"></td>
                                                                                    <td id="modal_layaway_payment_paid"></td>
                                                                                </tr>
                                                                                </tbody>




                                                                                </table>
                                                                                <br>
                                                                                <br>
                                                                                <span class="bold">Reason:</span>
                                                                                <br>
                                                                                <br>
                                                                                <input type="text" class="col-lg-12 form-control" id="modal_layaway_payment_reason">
                                                                                <br>
                                                                                <br>


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnLayawayPayment()">Yes</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
														</div>

														</div>



									</div>
									
									<div class="tab-pane" id="scrap">
									
										<table class="table-align-center table table-hover table-primary mb30" id="theTable">
                                                            <thead>
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Item Description</th>
                                                                <th>Price</th>
                                                                <th>Void</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $i = 0;
                                                            foreach($scrap as $row){
                                                                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                                                                $status = $row['status'];
                                                                if($status == 'void'){
                                                                    $disabled = 'disabled';
                                                                }
                                                                else{

                                                                    $disabled = '';

                                                                }
                                                                echo '<tr>';
                                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                                echo '<td>';
                                                                $customer_id = $row['customer_id'];
                                                                $scrap_id = $row['scrap_info_id'];

                                                                $items = $employeeClass->getCustomerScrapItemsPop($customer_id, $scrap_id);


                                                                foreach($items as $item){
                                                                    echo $item['description'] . '(' . $item['weight'] . 'g), ';

                                                                }
                                                                $v = array_map('array_pop' , $items);
                                                                $x = implode(', ', $v);
                                                                echo '</td>';

                                                                echo '<td>$' . number_format($row['amount_paid'], 2) . '</td>';
                                                                echo '<td><button id="btn_scrap_' . $i . '" data-btnId="btn_scrap_'.$i.'" data-cid="' . $row['customer_id'] . '" data-customer="' . $full_name . '" data-items="' . $x . '"  data-amount="$' . number_format($row['amount_paid'], 2) . '" data-type="scrap_info_tbl"  class="btn btn-info btn-xs" data-value="' . $row['scrap_info_id'] . '" data-toggle="modal" data-target="#scrap_modal" onClick="pushData(this)" ' . $disabled . '>VOID</button>';
                                                                echo '</tr>';

                                                                $i++;
                                                            }


                                                            ?>

                                                            </tbody>


                                                        </table>
														
														<div class="modal fade" id="scrap_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Are you sure do want to void this transaction?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="bold">Transaction Details:</span>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" id="modal_scrap_type">
                                                            <input type="hidden" id="modal_scrap_value">
                                                            <input type="hidden" id="modal_scrap_cid">
                                                            <input type="hidden" id="modal_scrap_btnId">
                                                            <table class="table-align-center table>
                                                                            <thead class="align-center bold">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Item Description</th>

                                                                <th>Price</th>


                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td id="modal_scrap_customer_name"></td>

                                                                <td id="modal_scrap_items"></td>

                                                                <td id="modal_scrap_amount"></td>
                                                            </tr>
                                                            </tbody>




                                                            </table>
                                                            <br>
                                                            <br>
                                                            <span class="bold">Reason:</span>
                                                            <br>
                                                            <br>
                                                            <input type="text" class="col-lg-12 form-control" id="modal_scrap_reason">
                                                            <br>
                                                            <br>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="disableBtnScrap()">Yes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->

										
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
<script>


    function disableBtn(){


        voidTransaction();

        var btn = document.getElementById('modal_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }


    function voidTransaction(){

        var id = document.getElementById('modal_value').value;
        var type = document.getElementById('modal_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_cid').value;
        var reason = document.getElementById('modal_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }
	
	 function disableBtnForfeit(){


        voidTransactionForfeit();

        var btn = document.getElementById('modal_forfeit_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }


    function voidTransactionForfeit(){

        var id = document.getElementById('modal_forfeit_value').value;
        var type = document.getElementById('modal_forfeit_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_forfeit_cid').value;
        var reason = document.getElementById('modal_forfeit_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }


    function disableBtnPayment(){


        voidTransactionPayment();

        var btn = document.getElementById('modal_payment_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }


    function voidTransactionPayment(){

        var id = document.getElementById('modal_payment_value').value;
        var type = document.getElementById('modal_payment_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_payment_cid').value;
        var reason = document.getElementById('modal_payment_reason').value;
        var transaction_type = document.getElementById('modal_payment_transaction_type').value;


        var amount = document.getElementById('modal_payment_amount_paid').value;
        var interest = document.getElementById('modal_payment_interest').value;
        var tid = document.getElementById('modal_payment_tid').value;
        var due = document.getElementById('modal_payment_due_date').value;

        updateTransactionStatusPayment(id, state, type, cid, reason, amount, interest, transaction_type, tid, due);

    }

    function disableBtnTitlePayment(){


        voidTransactionTitlePayment();

        var btn = document.getElementById('modal_title_payment_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }


    function voidTransactionTitlePayment(){

        var id = document.getElementById('modal_title_payment_value').value;
        var type = document.getElementById('modal_title_payment_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_title_payment_cid').value;
        var reason = document.getElementById('modal_title_payment_reason').value;
        var transaction_type = document.getElementById('modal_title_payment_transaction_type').value;


        var amount = document.getElementById('modal_title_payment_amount_paid').value;
        var interest = document.getElementById('modal_title_payment_interest').value;
        var tid = document.getElementById('modal_title_payment_tid').value;
        var due = document.getElementById('modal_title_payment_due_date').value;

        updateTransactionStatusPayment(id, state, type, cid, reason, amount, interest, transaction_type, tid, due);

    }

    function disableBtnLayawayPayment(){


        voidTransactionLayawayPayment();

        var btn = document.getElementById('modal_layaway_payment_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }


    function voidTransactionLayawayPayment(){

        var id = document.getElementById('modal_layaway_payment_value').value;
        var type = document.getElementById('modal_layaway_payment_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_layaway_payment_cid').value;
        var reason = document.getElementById('modal_layaway_payment_reason').value;
        var transaction_type = document.getElementById('modal_layaway_payment_transaction_type').value;


        var amount = document.getElementById('modal_layaway_payment_amount_paid').value;
        var interest = 0;
        var tid = document.getElementById('modal_layaway_payment_tid').value;
        var due = document.getElementById('modal_layaway_payment_due_date').value;

        updateTransactionStatusPayment(id, state, type, cid, reason, amount, interest, transaction_type, tid, due);

    }


    function disableBtnTitle(){


        voidTransactionTitle();

        var btn = document.getElementById('modal_title_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }

    function voidTransactionTitle(){

        var id = document.getElementById('modal_title_value').value;
        var type = document.getElementById('modal_title_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_title_cid').value;
        var reason = document.getElementById('modal_title_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }


    function disableBtnPos(){


        voidTransactionPos();

        var btn = document.getElementById('modal_pos_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }

    function voidTransactionPos(){

        var id = document.getElementById('modal_pos_value').value;
        var type = document.getElementById('modal_pos_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_pos_cid').value;
        var reason = document.getElementById('modal_pos_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }

    function disableBtnRepair(){


        voidTransactionRepair();

        var btn = document.getElementById('modal_repair_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }

    function voidTransactionRepair(){

        var id = document.getElementById('modal_repair_value').value;
        var type = document.getElementById('modal_repair_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_repair_cid').value;
        var reason = document.getElementById('modal_repair_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }


    function disableBtnRefill(){


        voidTransactionRefill();

        var btn = document.getElementById('modal_refill_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }

    function voidTransactionRefill(){

        var id = document.getElementById('modal_refill_value').value;
        var type = document.getElementById('modal_refill_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_refill_cid').value;
        var reason = document.getElementById('modal_refill_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }


    function disableBtnRto(){


        voidTransactionRto();

        var btn = document.getElementById('modal_rto_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }

    function voidTransactionRto(){

        var id = document.getElementById('modal_rto_value').value;
        var type = document.getElementById('modal_rto_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_rto_cid').value;
        var reason = document.getElementById('modal_rto_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }


    function disableBtnLayaway(){


        voidTransactionLayaway();

        var btn = document.getElementById('modal_layaway_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }

    function voidTransactionLayaway(){

        var id = document.getElementById('modal_layaway_value').value;
        var type = document.getElementById('modal_layaway_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_layaway_cid').value;
        var reason = document.getElementById('modal_layaway_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }


    function disableBtnScrap(){


        voidTransactionScrap();

        var btn = document.getElementById('modal_scrap_btnId').value;
        var button = document.getElementById(btn);
        button.disabled = true;

    }

    function voidTransactionScrap(){

        var id = document.getElementById('modal_scrap_value').value;
        var type = document.getElementById('modal_scrap_type').value;
        var state = 'true';
        var cid = document.getElementById('modal_scrap_cid').value;
        var reason = document.getElementById('modal_scrap_reason').value;


        updateTransactionStatus(id, state, type, cid, reason);

    }



    function pushData(elem){


        var type = elem.getAttribute('data-type');
        var value = elem.getAttribute('data-value');
        var cid = elem.getAttribute('data-cid');
        var customer_name = elem.getAttribute('data-customer');

        if(type == 'loan_info_tbl') {

            var items = elem.getAttribute('data-items');
            var matrix = elem.getAttribute('data-matrix');
            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');

            var modal_type = document.getElementById('modal_type');
            var modal_value = document.getElementById('modal_value');
            var modal_cid = document.getElementById('modal_cid');
            var modal_customer = document.getElementById('modal_customer_name');
            var modal_items = document.getElementById('modal_items');
            var modal_matrix = document.getElementById('modal_matrix');
            var modal_amount = document.getElementById('modal_amount');
            var modal_btnId = document.getElementById('modal_btnId');


            modal_type.value = type;
            modal_value.value = value;
            modal_cid.value = cid;
            modal_customer.innerHTML = customer_name;
            modal_items.innerHTML = items;
            modal_matrix.innerHTML = matrix;
            modal_amount.innerHTML = amount;
            modal_btnId.value = btn_id;
        }
		else if(type == 'loan_info_tbl_forfeit') {

            var items = elem.getAttribute('data-items');
            var matrix = elem.getAttribute('data-matrix');
            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');

            document.getElementById('modal_forfeit_type').value = type;
            document.getElementById('modal_forfeit_value').value = value;
            document.getElementById('modal_forfeit_cid').value = cid;
            document.getElementById('modal_forfeit_customer_name').innerHTML = customer_name;
            document.getElementById('modal_forfeit_items').innerHTML = items;
            document.getElementById('modal_forfeit_matrix').innerHTML = matrix;
            document.getElementById('modal_forfeit_amount').innerHTML = amount;
            document.getElementById('modal_forfeit_btnId').value = btn_id;

        }
        else if (type == 'title_pawn_tbl'){

            var vin = elem.getAttribute('data-vin');
            var model = elem.getAttribute('data-model');
            var matrix = elem.getAttribute('data-matrix');
            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');

            document.getElementById('modal_title_type').value = type;
            document.getElementById('modal_title_value').value = value;
            document.getElementById('modal_title_cid').value = cid;
            document.getElementById('modal_title_btnId').value = btn_id;

            document.getElementById('modal_title_customer_name').innerHTML = customer_name;
            document.getElementById('modal_title_l_vin').innerHTML = vin;
            document.getElementById('modal_title_l_model').innerHTML = model;
            document.getElementById('modal_title_matrix').innerHTML = matrix;
            document.getElementById('modal_title_amount').innerHTML = amount;

        }
        else if(type == 'point_of_sale_tbl'){

            var items = elem.getAttribute('data-items');
            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');

            document.getElementById('modal_pos_type').value = type;
            document.getElementById('modal_pos_value').value = value;
            document.getElementById('modal_pos_cid').value = cid;
            document.getElementById('modal_pos_btnId').value = btn_id;




            document.getElementById('modal_pos_customer_name').innerHTML = customer_name;
            document.getElementById('modal_pos_items').innerHTML = items;
            document.getElementById('modal_pos_amount').innerHTML = amount;

        }

        else if (type == 'repair_invoice_tbl'){

            var items = elem.getAttribute('data-items');
            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');

            document.getElementById('modal_repair_type').value = type;
            document.getElementById('modal_repair_value').value = value;
            document.getElementById('modal_repair_cid').value = cid;
            document.getElementById('modal_repair_btnId').value = btn_id;




            document.getElementById('modal_repair_customer_name').innerHTML = customer_name;
            document.getElementById('modal_repair_items').innerHTML = items;
            document.getElementById('modal_repair_amount').innerHTML = amount;
        }
        else if (type == 'refill_tbl'){

            var items = elem.getAttribute('data-items');
            var pin = elem.getAttribute('data-pin');
            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');

            document.getElementById('modal_refill_type').value = type;
            document.getElementById('modal_refill_value').value = value;
            document.getElementById('modal_refill_cid').value = cid;
            document.getElementById('modal_refill_btnId').value = btn_id;




            document.getElementById('modal_refill_customer_name').innerHTML = customer_name;
            document.getElementById('modal_refill_items').innerHTML = items;
            document.getElementById('modal_refill_pin').innerHTML = pin;
            document.getElementById('modal_refill_amount').innerHTML = amount;
        }

        else if (type == 'rto_tbl'){

            var items = elem.getAttribute('data-items');
            var desc = elem.getAttribute('data-description');
            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');
            var condition = elem.getAttribute('data-condition');

            document.getElementById('modal_rto_type').value = type;
            document.getElementById('modal_rto_value').value = value;
            document.getElementById('modal_rto_cid').value = cid;
            document.getElementById('modal_rto_btnId').value = btn_id;




            document.getElementById('modal_rto_customer_name').innerHTML = customer_name;
            document.getElementById('modal_rto_items').innerHTML = items;
            document.getElementById('modal_rto_description').innerHTML = desc;
            document.getElementById('modal_rto_condition').innerHTML = condition;
            document.getElementById('modal_rto_amount').innerHTML = amount;
        }
        else if (type == 'scrap_info_tbl'){

            var items = elem.getAttribute('data-items');

            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');


            document.getElementById('modal_scrap_type').value = type;
            document.getElementById('modal_scrap_value').value = value;
            document.getElementById('modal_scrap_cid').value = cid;
            document.getElementById('modal_scrap_btnId').value = btn_id;




            document.getElementById('modal_scrap_customer_name').innerHTML = customer_name;
            document.getElementById('modal_scrap_items').innerHTML = items;

            document.getElementById('modal_scrap_amount').innerHTML = amount;

        }
        else if(type == 'payment_tbl'){

            var transaction_type = elem.getAttribute('data-transaction-type');
            if(transaction_type == 'general'){


                var items = elem.getAttribute('data-items');
                var interest = elem.getAttribute('data-interest');
                var amount = elem.getAttribute('data-amount');
                var amount_data = elem.getAttribute('data-amount-data');
                var amount_paid = elem.getAttribute('data-amount-paid');
                var btn_id = elem.getAttribute('data-btnId');
                var tid = elem.getAttribute('data-tid');
                var due = elem.getAttribute('data-due-date');


                var modal_type = document.getElementById('modal_payment_type');
                var modal_value = document.getElementById('modal_payment_value');
                var modal_cid = document.getElementById('modal_payment_cid');
                var modal_customer = document.getElementById('modal_payment_customer_name');
                var modal_items = document.getElementById('modal_payment_items');

                var modal_interest = document.getElementById('modal_payment_interest');
                var modal_amount = document.getElementById('modal_payment_amount');
                var modal_paid = document.getElementById('modal_payment_paid');
                var modal_amount_paid = document.getElementById('modal_payment_amount_paid');
                var modal_btnId = document.getElementById('modal_payment_btnId');
                var modal_payment_type = document.getElementById('modal_payment_transaction_type');

                var modal_tid = document.getElementById('modal_payment_tid');
                var modal_due = document.getElementById('modal_payment_due_date');



                modal_type.value = type;
                modal_value.value = value;
                modal_cid.value = cid;
                modal_customer.innerHTML = customer_name;
                modal_items.innerHTML = items;
                modal_payment_type.value = transaction_type;
                modal_interest.value = interest;
                modal_amount.innerHTML = amount;
                modal_paid.innerHTML = amount_paid;
                modal_amount_paid.value = amount_data;
                modal_btnId.value = btn_id;
                modal_tid.value = tid;
                modal_due.value = due;
            }
            else if (transaction_type == 'title'){
                var items = elem.getAttribute('data-items');
                var interest = elem.getAttribute('data-interest');
                var amount = elem.getAttribute('data-amount');
                var amount_data = elem.getAttribute('data-amount-data');
                var amount_paid = elem.getAttribute('data-amount-paid');
                var btn_id = elem.getAttribute('data-btnId');
                var tid = elem.getAttribute('data-tid');
                var due = elem.getAttribute('data-due-date');
                var vin = elem.getAttribute('data-vin');
                var model = elem.getAttribute('data-model');


                var modal_type = document.getElementById('modal_title_payment_type');
                var modal_value = document.getElementById('modal_title_payment_value');
                var modal_cid = document.getElementById('modal_title_payment_cid');
                var modal_customer = document.getElementById('modal_title_payment_customer_name');
                var modal_vin = document.getElementById('modal_title_vin');
                var modal_model = document.getElementById('modal_title_model');

                var modal_interest = document.getElementById('modal_title_payment_interest');
                var modal_amount = document.getElementById('modal_title_payment_amount');
                var modal_paid = document.getElementById('modal_title_payment_paid');
                var modal_amount_paid = document.getElementById('modal_title_payment_amount_paid');
                var modal_btnId = document.getElementById('modal_title_payment_btnId');
                var modal_payment_type = document.getElementById('modal_title_payment_transaction_type');

                var modal_tid = document.getElementById('modal_title_payment_tid');
                var modal_due = document.getElementById('modal_title_payment_due_date');



                modal_type.value = type;
                modal_value.value = value;
                modal_cid.value = cid;
                modal_customer.innerHTML = customer_name;
                modal_vin.innerHTML = vin;
                modal_model.innerHTML = model;
                modal_payment_type.value = transaction_type;
                modal_interest.value = interest;
                modal_amount.innerHTML = amount;
                modal_paid.innerHTML = amount_paid;
                modal_amount_paid.value = amount_data;
                modal_btnId.value = btn_id;
                modal_tid.value = tid;
                modal_due.value = due;
            }
            if(transaction_type == 'layaway'){


                var items = elem.getAttribute('data-items');
                var amount = elem.getAttribute('data-amount');
                var amount_data = elem.getAttribute('data-amount-data');
                var amount_paid = elem.getAttribute('data-amount-paid');
                var btn_id = elem.getAttribute('data-btnId');
                var tid = elem.getAttribute('data-tid');
                var due = elem.getAttribute('data-due-date');


                document.getElementById('modal_layaway_payment_type').value = type;
                document.getElementById('modal_layaway_payment_value').value = value;
                document.getElementById('modal_layaway_payment_cid').value = cid;
                document.getElementById('modal_layaway_payment_customer_name').innerHTML = customer_name;
                document.getElementById('modal_layaway_payment_items').innerHTML = items;


                document.getElementById('modal_layaway_payment_amount').innerHTML = amount;
                document.getElementById('modal_layaway_payment_paid').innerHTML = amount_paid;
                document.getElementById('modal_layaway_payment_amount_paid').value = amount_data;
                document.getElementById('modal_layaway_payment_btnId').value = btn_id;
                document.getElementById('modal_layaway_payment_transaction_type').value = transaction_type;

                document.getElementById('modal_layaway_payment_tid').value = tid;
                document.getElementById('modal_layaway_payment_due_date').value = due;



            }
            }


        else if (type == 'layaway_tbl'){


            var items = elem.getAttribute('data-items');
            var amount = elem.getAttribute('data-amount');
            var btn_id = elem.getAttribute('data-btnId');

            document.getElementById('modal_layaway_type').value = type;
            document.getElementById('modal_layaway_value').value = value;
            document.getElementById('modal_layaway_cid').value = cid;
            document.getElementById('modal_layaway_customer_name').innerHTML = customer_name;
            document.getElementById('modal_layaway_items').innerHTML = items;

            document.getElementById('modal_layaway_amount').innerHTML = amount;
            document.getElementById('modal_layaway_btnId').value = btn_id;


        }

        else {
            null;
        }



}




</script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
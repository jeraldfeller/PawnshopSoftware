<?php
require '../Model/Init.php';
require SERVER_ROOT . '/includes/require.php';
$title = 'End of Day Report';

$date = date("Y-m-d");
$displayDate = date("d/m/Y", strtotime($date));

$adminClass = new Admin();
$pawns = $adminClass->getGeneralPawnsByDay($date);
$title_pawns = $adminClass->getTitlePawnsByDay($date);
$total_pawns = $adminClass->getGeneralPawnsByDayTotalSum($date);
$total_title_pawns = $adminClass->getTitlePawnsByDayTotalSum($date);

$take_payment_sales_pawn = $adminClass->getTakePaymentSalesByDay($date, "loan_info_tbl");
$total_payment_sales_pawn = $adminClass->getTakePaymentSalesByDayTotalSum($date, "loan_info_tbl");

$take_payment_sales_title = $adminClass->getTakePaymentSalesByDay($date, "title_pawn_tbl");
$total_payment_sales_title = $adminClass->getTakePaymentSalesByDayTotalSum($date, "title_pawn_tbl");

$take_payment_sales_repair = $adminClass->getTakePaymentSalesByDay($date, "repair_invoice_tbl");
$total_payment_sales_repair = $adminClass->getTakePaymentSalesByDayTotalSum($date, "repair_invoice_tbl");

$take_payment_sales_refill = $adminClass->getTakePaymentSalesByDay($date, "refill_tbl");
$total_payment_sales_refill = $adminClass->getTakePaymentSalesByDayTotalSum($date, "refill_tbl");

$take_payment_sales_rto = $adminClass->getTakePaymentSalesByDay($date, "rto_tbl");
$total_payment_sales_rto = $adminClass->getTakePaymentSalesByDayTotalSum($date, "rto_tbl");

$take_payment_sales_layaway = $adminClass->getTakePaymentSalesByDay($date, "layaway_tbl");
$total_payment_sales_layaway = $adminClass->getTakePaymentSalesByDayTotalSum($date, "layaway_tbl");

$point_of_sale = $adminClass->getPointOfSaleByDay($date);
$total_point_of_sale = $adminClass->getPointOfSaleByDayTotalSum($date);

$cash_loaned_out = $adminClass->getCashLoanedOutByDay($date);
$total_cash_loaned_out = $adminClass->getCashLoanedOutTotalSum($date);
$total_cash_loaned_out_title = $adminClass->getCashLoanedOutTitleTotalSum($date);
$total_loaned_out = $total_cash_loaned_out + $total_cash_loaned_out_title;

$cost_of_goods = $adminClass->getCostOfGoodsByDay($date);
$total_cost_of_goods = $adminClass->getCostOfGoodsTotalSum($date);

$scrap_purchase = $adminClass->getScrapPurchaseByDay($date);
$total_scrap_purchase = $adminClass->getScrapPurchaseTotalSum($date);


$info = $adminClass->getCompanyInfo();

foreach($info as $row){

    $company_name = $row['company_name'];
    $company_address = $row['company_address'];
    $company_city = $row['city'];
    $company_state = $row['state'];
    $company_zip = $row['zip'];
    $company_phone_no = $row['phone_no'];
}


$view = new adminView();

$total_sales = $total_payment_sales_pawn + $total_payment_sales_title + $total_point_of_sale + $total_payment_sales_repair + $total_payment_sales_refill + $total_payment_sales_rto + $total_payment_sales_layaway;



require SERVER_ROOT . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-clipboard"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>End of Day Report</li>
                                </ul>
                                <h4>End of Day Report</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->

                        <div class="row">

                            <div class="col-md-12">
                            <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-line">
                                    <li class="active"><a href="#general-pawns" data-toggle="tab"><strong>Total Money Loaned Outs</strong></a></li>
                                    <li><a href="#total-sales" data-toggle="tab"><strong>Total Sales</strong></a></li>
                                    <li><a href="#expenses" data-toggle="tab"><strong>Total Expenses</strong></a></li>
                                    <li class="pull-right"><a href="#events" data-toggle="tab" onclick="printDiv('printablediv')"><strong><i class="fa fa-print"></i> Print End of Day Report</strong></a></li>
                                </ul>

                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="general-pawns">
                                        <table class="table table-hover table-primary mb30">

                                            <tr class="info align-center big-txt">
                                                <td colspan="8">General Pawns</td>
                                            </tr>
                                            <tr class="align-center bold">
                                                <td colspan="3">Customer Name</td>
                                                <td colspan="3">Item Description</td>
                                                <td>Loan Matrix</td>
                                                <td>Loan Amount</td>
                                            </tr>
                                            <?php echo $view->displayTotalGeneralPawnsByDay($pawns); ?>
                                            <tr class="bold">
                                                <td class="align-right" colspan="7">Total General Pawns:</td>
                                                <td>$ <?php echo number_format($total_pawns, 2); ?></td>
                                            </tr>
                                            <tr class="info align-center big-txt">
                                                <td colspan="8">Title Pawns</td>
                                            </tr>
                                            <tr class="align-center bold">
                                                <td>Customer Name</td>
                                                <td>VIN</td>
                                                    <td>Year</td>
                                                    <td>Model</td>
                                                    <td>Title #</td>
                                                    <td>Loan Matrix</td>
                                                    <td>Retail</td>
                                                    <td>Loan Amount</td>
                                            </tr>
                                            <?php echo $view->displayTotalTitlePawnsByDay($title_pawns); ?>
                                            <tr class="bold">
                                                <td class="align-right" colspan="7">Total Title Pawns:</td>
                                                <td>$ <?php echo number_format($total_title_pawns, 2); ?></td>
                                            </tr>
                                            <tr class="big-txt warning">
                                                <td class="align-right" colspan="7">Total Money Loaned Outs:</td>
                                                <td>$ <?php echo number_format($total_pawns + $total_title_pawns, 2); ?></td>
                                            </tr>

										</table>
                                    </div>

                                    <div class="tab-pane" id="total-sales">
                                    <table class="table table-hover table-primary mb30">
                                                    <thead>
                                                    <tr class="info align-center big-txt">
                                                        <td colspan="3">General Pawns</td>
                                                    </tr>
                                                    <tr class="align-center bold">
                                                        <td>Customer Name</td>
                                                        <td>Payment Method</td>
                                                        <td>Amount Paid</td>

                                                    </tr>
                                                    </thead>

                                                    <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_pawn); ?>
                                                    <tr class="bold">
                                                        <td class="align-right" colspan="2">Total General Pawn Sales:</td>
                                                        <td>$<?php echo number_format($total_payment_sales_pawn, 2); ?></td>
                                                    </tr>

                                                    <tr class="info align-center big-txt">
                                                        <td colspan="3">Title Pawns</td>
                                                    </tr>
                                                    <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_title); ?>
                                                    <tr class="bold">
                                                        <td class="align-right" colspan="2">Total Title Pawn Sales:</td>
                                                        <td>$<?php echo number_format($total_payment_sales_title, 2); ?></td>
                                                    </tr>

                                                    <tr class="info align-center big-txt">
                                                        <td colspan="3">Point of Sale</td>
                                                    </tr>
                                                    <?php echo $view->displayPointOfSaleByDay($point_of_sale); ?>
                                                    <tr class="bold">
                                                        <td class="align-right" colspan="2">Total POS Sales:</td>
                                                        <td>$<?php echo number_format($total_point_of_sale, 2); ?></td>
                                                    </tr>

                                                    <tr class="info align-center big-txt">
                                                        <td colspan="3">Repair Order/Invoice</td>
                                                    </tr>
                                                    <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_repair); ?>
                                                    <tr class="bold">
                                                        <td class="align-right" colspan="2">Total Repair Order/Invoice Sales:</td>
                                                        <td>$<?php echo number_format($total_payment_sales_repair, 2); ?></td>
                                                    </tr>

                                                    <tr class="info align-center big-txt">
                                                        <td colspan="3">Refill Pins</td>
                                                    </tr>
                                                    <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_refill); ?>
                                                    <tr class="bold">
                                                        <td class="align-right" colspan="2">Total Refill Pins Sales:</td>
                                                        <td>$<?php echo number_format($total_payment_sales_refill, 2); ?></td>
                                                    </tr>


                                                    <tr class="info align-center big-txt">
                                                        <td colspan="3">RTO</td>
                                                    </tr>
                                                    <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_rto); ?>
                                                    <tr class="bold">
                                                        <td class="align-right" colspan="2">Total RTO Sales:</td>
                                                        <td>$<?php echo number_format($total_payment_sales_rto, 2); ?></td>
                                                    </tr>
													
													<tr class="info align-center big-txt">
                                                        <td colspan="3">Layaway</td>
                                                    </tr>
                                                    <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_layaway); ?>
                                                    <tr class="bold">
                                                        <td class="align-right" colspan="2">Total Layaway Sales:</td>
                                                        <td>$<?php echo number_format($total_payment_sales_layaway, 2); ?></td>
                                                    </tr>



                                                    <tr class="big-txt warning">
                                                        <td class="align-right" colspan="2">Total Sales:</td>
                                                        <td>$ <?php echo number_format($total_sales, 2); ?></td>
                                                    </tr>

                                                </table>
                                    </div>


                                    <div class="tab-pane" id="expenses">
                                        <table class="table table-hover table-primary mb30">
                                        <tr class="info align-center big-txt">
                                                        <td colspan="2">Cash Loaned Out</td>
                                                    </tr>
                                                    <tr class="align-center bold">
                                                        <td>Customer Name</td>
                                                        <td>Loan Amount</td>

                                                    </tr>
                                                    <?php echo $view->displayCashLoanedOutByDay($cash_loaned_out); ?>
                                                    <tr class="bold">
                                                        <td class="align-right">Total Cash Loaned Out:</td>
                                                        <td>$<?php echo number_format($total_loaned_out, 2); ?></td>
                                                    </tr>

                                                    <tr class="info align-center big-txt">
                                                        <td colspan="2">Cost Of Goods Sold</td>
                                                    </tr>
                                                    <tr class="align-center bold">
                                                        <td>Customer Name</td>
                                                        <td>Cost of Goods</td>

                                                    </tr>
                                                    <?php echo $view->displayCostOfGoodsByDay($cost_of_goods); ?>
                                                    <tr class="bold">
                                                        <td class="align-right">Total Cost of Goods:</td>
                                                        <td>$<?php echo number_format($total_cost_of_goods, 2); ?></td>
                                                    </tr>
                                                    <tr class="info align-center big-txt">
                                                        <td colspan="2">Scrap Purchases</td>
                                                    </tr>
                                                    <tr class="align-center bold">
                                                        <td>Customer Name</td>
                                                        <td>Cost</td>

                                                    </tr>
                                                    <?php echo $view->displayScrapPurchaseByDay($scrap_purchase); ?>
                                                    <tr class="bold">
                                                        <td class="align-right">Total Scrap Purchases:</td>
                                                        <td>$<?php echo number_format($total_scrap_purchase, 2); ?></td>
                                                    </tr>



                                                    <tr class="big-txt warning">
                                                        <td class="align-right">Total Expenses:</td>
                                                        <td>$ <?php echo number_format($total_loaned_out + $total_cost_of_goods + $total_scrap_purchase, 2); ?></td>
                                                    </tr>
                                        </table>
                                    </div>



                                    <div id="printablediv" class="tab-pane fade in">
                                <div class="panel panel-default col-md-12 print-table">



                                    <table class="border-thick header-table">
                                        <tr>
                                            <td class="t-heading" width="293" rowspan="6"></td>
                                            <td class="company-title"><?php echo $company_name; ?></td>
                                            <td class="t-heading"width="293" rowspan="6"></td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td><?php echo $company_address; ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo $company_city . ', ' . $company_state . ' ' . $company_zip; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $company_phone_no; ?></td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>

                                    </table>

                                    <div class="text-center">
                                        <h2>END OF DAY REPORT</h2>
                                        <p><?php echo $displayDate; ?></p>
                                    </div>

                                    <table class="body-table" border="1">
                                        <tr class="border-thick">
                                            <td colspan="8"><span class="big-txt">EXPENSES</span></td>
                                        </tr>


                                        <tr class="info align-center big-txt">
                                            <td colspan="2">Cash Loaned Out</td>
                                        </tr>
                                        <tr class="align-center bold">
                                            <td>Customer Name</td>
                                            <td>Loan Amount</td>

                                        </tr>
                                        <?php echo $view->displayCashLoanedOutByDay($cash_loaned_out); ?>
                                        <tr class="bold">
                                            <td class="align-right">Total Cash Loaned Out:</td>
                                            <td>$<?php echo number_format($total_loaned_out, 2); ?></td>
                                        </tr>

                                        <tr class="info align-center big-txt">
                                            <td colspan="2">Cost Of Goods Sold</td>
                                        </tr>
                                        <tr class="align-center bold">
                                            <td>Customer Name</td>
                                            <td>Cost of Goods</td>

                                        </tr>
                                        <?php echo $view->displayCostOfGoodsByDay($cost_of_goods); ?>
                                        <tr class="bold">
                                            <td class="align-right">Total Cost of Goods:</td>
                                            <td>$<?php echo number_format($total_cost_of_goods, 2); ?></td>
                                        </tr>

                                        <tr class="info align-center big-txt">
                                            <td colspan="2">Scrap Purchases</td>
                                        </tr>
                                        <tr class="align-center bold">
                                            <td>Customer Name</td>
                                            <td>Price</td>

                                        </tr>
                                        <?php echo $view->displayScrapPurchaseByDay($scrap_purchase); ?>
                                        <tr class="bold">
                                            <td class="align-right">Total Scrap Purchases:</td>
                                            <td>$<?php echo number_format($total_scrap_purchase, 2); ?></td>
                                        </tr>

                                        <tr class="big-txt warning">
                                            <td class="align-right">Total Expenses:</td>
                                            <td>$ <?php echo number_format($total_loaned_out + $total_cost_of_goods + $total_scrap_purchase, 2); ?></td>
                                        </tr>



                                    </table>


                                    <table class="body-table" border="1">
                                        <tr class="border-thick">
                                            <td colspan="3"><span class="big-txt">SALES</span></td>
                                        </tr>
                                        <tr class="align-center bold">
                                            <th>Customer Name</th>
                                            <th>Payment Method</th>
                                            <th>Amount Paid</th>

                                        </tr>
                                        </thead>

                                        <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_pawn); ?>
                                        <tr class="bold">
                                            <td class="align-right" colspan="2">Total General Pawn Sales:</td>
                                            <td>$<?php echo number_format($total_payment_sales_pawn, 2); ?></td>
                                        </tr>

                                        <tr class="info align-center big-txt">
                                            <td colspan="3">Title Pawns</td>
                                        </tr>
                                        <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_title); ?>
                                        <tr class="bold">
                                            <td class="align-right" colspan="2">Total Title Pawn Sales:</td>
                                            <td>$<?php echo number_format($total_payment_sales_title, 2); ?></td>
                                        </tr>

                                        <tr class="info align-center big-txt">
                                            <td colspan="3">Point of Sale</td>
                                        </tr>
                                        <?php echo $view->displayPointOfSaleByDay($point_of_sale); ?>
                                        <tr class="bold">
                                            <td class="align-right" colspan="2">Total POS Sales:</td>
                                            <td>$<?php echo number_format($total_point_of_sale, 2); ?></td>
                                        </tr>

                                        <tr class="info align-center big-txt">
                                            <td colspan="3">Repair Order/Invoice</td>
                                        </tr>
                                        <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_repair); ?>
                                        <tr class="bold">
                                            <td class="align-right" colspan="2">Total Repair Order/Invoice Sales:</td>
                                            <td>$<?php echo number_format($total_payment_sales_repair, 2); ?></td>
                                        </tr>

                                        <tr class="info align-center big-txt">
                                            <td colspan="3">Refill Pins</td>
                                        </tr>
                                        <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_refill); ?>
                                        <tr class="bold">
                                            <td class="align-right" colspan="2">Total Refill Pins Sales:</td>
                                            <td>$<?php echo number_format($total_payment_sales_refill, 2); ?></td>
                                        </tr>


                                        <tr class="info align-center big-txt">
                                            <td colspan="3">RTO</td>
                                        </tr>
                                        <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_rto); ?>
                                        <tr class="bold">
                                            <td class="align-right" colspan="2">Total RTO Sales:</td>
                                            <td>$<?php echo number_format($total_payment_sales_rto, 2); ?></td>
                                        </tr>
										
										 <tr class="info align-center big-txt">
                                            <td colspan="3">Layaway</td>
                                        </tr>
                                        <?php echo $view->displayTakePaymentSalesByDay($take_payment_sales_layaway); ?>
                                        <tr class="bold">
                                            <td class="align-right" colspan="2">Total Layaway Sales:</td>
                                            <td>$<?php echo number_format($total_payment_sales_layaway, 2); ?></td>
                                        </tr>



                                        <tr class="big-txt warning">
                                            <td class="align-right" colspan="2">Total Sales:</td>
                                            <td>$ <?php echo number_format($total_sales, 2); ?></td>
                                        </tr>

                                    </table>




                                </div>

                        </div> <!-- end of printable div -->



                                </div>
                            </div><!-- col-md-6 -->
                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->
<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<?php require SERVER_ROOT . '/includes/footer.php'; ?>
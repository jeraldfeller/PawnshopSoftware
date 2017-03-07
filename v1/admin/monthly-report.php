<?php
require '../Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Monthly Report';

$cur_date = date('Y-m-d');

if(isset($_POST['submit'])){

    $from_d = $_POST['from'];
    $timestamp = DateTime::createFromFormat('m/d/Y', $from_d);
    $from = $timestamp->format('Y-m-d');

    $to_d = $to = $_POST['to'];
    $timestamp = DateTime::createFromFormat('m/d/Y', $to_d);
    $to = $timestamp->format('Y-m-d');


}
else{
    $from = date('Y-m-01', strtotime($cur_date));
    $timestamp = DateTime::createFromFormat('Y-m-d', $from);
    $from_d = $timestamp->format('m/d/Y');
    $to = date('Y-m-t', strtotime($cur_date));
    $timestamp = DateTime::createFromFormat('Y-m-d', $to);
    $to_d = $timestamp->format('m/d/Y');
}





$adminClass = new Admin();
$pawns = $adminClass->getGeneralPawnsByMonth($from, $to);
$title_pawns = $adminClass->getTitlePawnsByMonth($from, $to);
$total_pawns = $adminClass->getGeneralPawnsByMonthTotalSum($from, $to);
$total_title_pawns = $adminClass->getTitlePawnsByMonthTotalSum($from, $to);


$take_payment_sales_pawn = $adminClass->getTakePaymentSalesByMonth($from, $to, "loan_info_tbl");
$total_payment_sales_pawn = $adminClass->getTakePaymentSalesByMonthTotalSum($from, $to, "loan_info_tbl");

$take_payment_sales_title = $adminClass->getTakePaymentSalesByMonth($from, $to, "title_pawn_tbl");
$total_payment_sales_title = $adminClass->getTakePaymentSalesByMonthTotalSum($from, $to, "title_pawn_tbl");

$take_payment_sales_repair = $adminClass->getTakePaymentSalesByMonth($from, $to, "repair_invoice_tbl");
$total_payment_sales_repair = $adminClass->getTakePaymentSalesByMonthTotalSum($from, $to, "repair_invoice_tbl");

$take_payment_sales_refill = $adminClass->getTakePaymentSalesByMonth($from, $to, "refill_tbl");
$total_payment_sales_refill = $adminClass->getTakePaymentSalesByMonthTotalSum($from, $to, "refill_tbl");

$take_payment_sales_rto = $adminClass->getTakePaymentSalesByMonth($from, $to, "rto_tbl");
$total_payment_sales_rto = $adminClass->getTakePaymentSalesByMonthTotalSum($from, $to, "rto_tbl");

$take_payment_sales_layaway = $adminClass->getTakePaymentSalesByMonth($from, $to, "layaway_tbl");
$total_payment_sales_layaway = $adminClass->getTakePaymentSalesByMonthTotalSum($from, $to, "layaway_tbl");

$point_of_sale = $adminClass->getPointOfSaleByMonth($from, $to);
$total_point_of_sale = $adminClass->getPointOfSaleByMonthTotalSum($from, $to);

$cash_loaned_out = $adminClass->getCashLoanedOutByMonth($from, $to);
$total_cash_loaned_out = $adminClass->getCashLoanedOutTotalSumMonth($from, $to);
$total_cash_loaned_out_title = $adminClass->getCashLoanedOutTitleTotalSumMonth($from, $to);
$total_loaned_out = $total_cash_loaned_out + $total_cash_loaned_out_title;

$cost_of_goods = $adminClass->getCostOfGoodsByMonth($from, $to);
$total_cost_of_goods = $adminClass->getCostOfGoodsTotalSumMonth($from, $to);


$scrap_purchases = $adminClass->getScrapPurchasesByMonth($from, $to);
$total_scrap_purchases = $adminClass->getScrapPurchasesTotalSumMonth($from, $to);


$view = new adminView();


$total_sales = $total_payment_sales_pawn + $total_payment_sales_title + $total_point_of_sale + $total_payment_sales_repair + $total_payment_sales_refill + $total_payment_sales_rto + $total_payment_sales_layaway;


$info = $adminClass->getCompanyInfo();

foreach($info as $row) {

    $company_name = $row['company_name'];
    $company_address = $row['company_address'];
    $company_city = $row['city'];
    $company_state = $row['state'];
    $company_zip = $row['zip'];
    $company_phone_no = $row['phone_no'];
}


require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Monthly Report</li>
                                </ul>
                                <h4>Monthly Report</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->

                        <div class="row">


                             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <div class="col-lg-3">

                                    <div class="input-group">
                                            <span class="input-group-addon">From</span>
                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker_from" value="<?php echo $from_d; ?>" name="from">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>


                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="input-group">
                                            <span class="input-group-addon">To</span>
                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker_to" value="<?php echo $to_d; ?>" name="to">



                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-group">
                                            <button style="height: 40px;" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>



                                </form>

                            </div>
                                <div class="row">
                                <div class="col-md-12">
                            <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-line">
                                    <li class="active"><a href="#general-pawns" data-toggle="tab"><strong>Total Money Loaned Outs</strong></a></li>
                                    <li><a href="#total-sales" data-toggle="tab"><strong>Total Sales</strong></a></li>
                                    <li><a href="#expenses" data-toggle="tab"><strong>Total Expenses</strong></a></li>
                                    <li class="pull-right"><a href="#events" data-toggle="tab" onclick="printDiv('printablediv')"><strong><i class="fa fa-print"></i> Print Monthly Report</strong></a></li>
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
                                                <td>Price</td>

                                            </tr>
                                            <?php echo $view->displayScrapPurchaseByDay($scrap_purchases); ?>
                                            <tr class="bold">
                                                <td class="align-right">Total Scrap Purchases:</td>
                                                <td>$<?php echo number_format($total_scrap_purchases, 2); ?></td>
                                            </tr>

                                            <tr class="big-txt warning">
                                                <td class="align-right">Total Expenses:</td>
                                                <td>$ <?php echo number_format($total_loaned_out + $total_cost_of_goods + $total_scrap_purchases, 2); ?></td>
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
                                <h2>CUSTOM DATE REPORT</h2>
                                <p><?php echo $from_d . ' - ' . $to_d; ?></p>
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
                                <?php echo $view->displayScrapPurchaseByDay($scrap_purchases); ?>
                                <tr class="bold">
                                    <td class="align-right">Total Scrap Purchases:</td>
                                    <td>$<?php echo number_format($total_scrap_purchases, 2); ?></td>
                                </tr>

                                <tr class="big-txt warning">
                                    <td class="align-right">Total Expenses:</td>
                                    <td>$ <?php echo number_format($total_loaned_out + $total_cost_of_goods + $total_scrap_purchases, 2); ?></td>
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
                                </div>
                            </div><!-- col-md-6 -->
                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->
<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>


        <script src="<?php echo ROOT; ?>js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo ROOT; ?>js/jquery-ui-1.10.3.min.js"></script>
        <script src="<?php echo ROOT; ?>js/bootstrap.min.js"></script>


        <script src="<?php echo ROOT; ?>js/jquery.autogrow-textarea.js"></script>
        <script src="<?php echo ROOT; ?>js/jquery.mousewheel.js"></script>
        <script src="<?php echo ROOT; ?>js/jquery.tagsinput.min.js"></script>
        <script src="<?php echo ROOT; ?>js/toggles.min.js"></script>
        <script src="<?php echo ROOT; ?>js/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo ROOT; ?>js/jquery.maskedinput.min.js"></script>
        <script src="<?php echo ROOT; ?>js/select2.min.js"></script>
        <script src="<?php echo ROOT; ?>js/colorpicker.js"></script>
        <script src="<?php echo ROOT; ?>js/dropzone.min.js"></script>

<script>
            jQuery(document).ready(function() {
                // Date Picker
                jQuery('#datepicker_from').datepicker();
                jQuery('#datepicker_to').datepicker();


            });
        </script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
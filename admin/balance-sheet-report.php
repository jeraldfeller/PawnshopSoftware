<?php
require '../Model/Init.php';
require SERVER_ROOT . '/includes/require.php';
$title = 'Balance Sheet Report';

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
$total_pawns_interest = $adminClass->getInterestGeneralPawnsByMonthTotalSum($from, $to);
$total_title_pawns = $adminClass->getTitlePawnsByMonthTotalSum($from, $to);
$total_title_pawns_interest = $adminClass->getInterestTitlePawnsByMonthTotalSum($from, $to);


$view = new adminView();

require SERVER_ROOT . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-book"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Balance Sheet Report</li>
                                </ul>
                                <h4>Balance Sheet Report</h4>
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
                            <br>
                                <div class="row">

                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-primary mb30">
                                             <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Total Capital Loaned Out</th>
                                                        <th>Total Interest</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>General Pawn</td>
                                                        <td>$<?php echo number_format($total_pawns, 2); ?></td>
                                                        <td>$<?php echo number_format($total_pawns_interest, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Title Pawn</td>
                                                        <td>$<?php echo number_format($total_title_pawns, 2); ?></td>
                                                        <td>$<?php echo number_format($total_title_pawns_interest, 2); ?></td>
                                                    </tr>
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>

                                </div><!-- row -->
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
<?php require SERVER_ROOT . '/includes/footer.php'; ?>
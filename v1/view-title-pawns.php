<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'View Pawns';

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
	$from = '2016-01-01';
    $fromx = date('Y-m-01', strtotime($cur_date));
    $timestamp = DateTime::createFromFormat('Y-m-d', $fromx);
    $from_d = $timestamp->format('m/d/Y');
    $to = date('Y-m-t', strtotime($cur_date));
    $timestamp = DateTime::createFromFormat('Y-m-d', $to);
    $to_d = $timestamp->format('m/d/Y');
}


$adminClass = new Admin();
$view = new View();

$title_pawns = $adminClass->getTitlePawnsByMonthView($from, $to);

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

                            <br>
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table table-hover table-primary mb30 align-center" id="dataTables-example">
                                        <thead>
                                                <tr class="bg-primary">
                                                    <th style="color: #fff;">Customer Name</th>
                                                    <th style="color: #fff;">VIN</th>
                                                    <th style="color: #fff;">Year</th>
                                                    <th style="color: #fff;">Model</th>
                                                    <th style="color: #fff;">Images</th>
                                                    <th style="color: #fff;">Title #</th>
                                                    <th style="color: #fff;">Loan Matrix</th>
                                                    <th style="color: #fff;">Retail</th>
                                                    <th style="color: #fff;">Loan Amount</th>
                                                    <th style="color: #fff;">Date Added</th>
													<th style="color: #fff;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php echo $view->displayTitlePawns($title_pawns); ?>
                                                </tbody>
                                    </table>
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

<!-- switch -->

        <script src="<?php echo ROOT; ?>js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo ROOT; ?>js/bootstrap-timepicker.min.js"></script>


<script>
            jQuery(document).ready(function() {
				
				 jQuery('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 9, "desc" ]]
				});
                // Date Picker
                jQuery('#datepicker_from').datepicker();
                jQuery('#datepicker_to').datepicker();
				
				jQuery('#gallery a').fancybox({
                type: 'image',
                overlayColor: '#000',
                overlayOpacity: .3,
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                easingIn: 'easeInSine',
                easingOut: 'easeOutSine',
                titlePosition: 'outside' ,
                cyclic: true
				});

            });
        </script>
		
		<!-- fancy box -->
	<script src="<?php echo ROOT; ?>js/fancybox/jquery.fancybox-1.3.4.min.js"></script>
<script src="<?php echo ROOT; ?>js/jquery.easing.1.3.js"></script>


<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
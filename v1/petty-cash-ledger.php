<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Petty Cash Ledger';

$cur_date = date('Y-m-d');
if(isset($_POST['submit'])){
    $from = $_POST['from'];
    $timestamp = DateTime::createFromFormat('Y-m-d', $from);
    $from_d = $timestamp->format('m/d/Y');

    $to = $_POST['to'];
    $timestamp = DateTime::createFromFormat('Y-m-d', $to);
    $to_d = $timestamp->format('m/d/Y');

    $_SESSION['session_from'] = $from;
    $_SESSION['session_to'] = $to;

}
else if(isset($_SESSION['session_from'])){

    $from =  $_SESSION['session_from'];
    $timestamp = DateTime::createFromFormat('Y-m-d', $from);
    $from_d = $timestamp->format('m/d/Y');

    $to = $_SESSION['session_to'];
    $timestamp = DateTime::createFromFormat('Y-m-d', $to);
    $to_d = $timestamp->format('m/d/Y');

}


else{
    $from = date('Y-m-01', strtotime($cur_date));
    $timestamp = DateTime::createFromFormat('Y-m-d', $from);
    $from_d = $timestamp->format('m/d/Y');
    $to = date('Y-m-t', strtotime($cur_date));
    $timestamp = DateTime::createFromFormat('Y-m-d', $to);
    $to_d = $timestamp->format('m/d/Y');
}


$miscClass = new Miscellaneous();
$view = new View();

if(isset($_POST['submit_ledger'])){
	$miscClass->addPettyCash();
}


$ledger = $miscClass->getPettyCashByDate($from, $to);
require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Petty Cash Ledger</li>
                                </ul>
                                <h4>Petty Cash Ledger</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">
					
					
					 <!-- start modal -->
        <div class="modal  fade" id="petty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header info">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add Payin / Payout</h4>
                    </div>
                    <div class="modal-body">

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <h4 class="box-heading">Description</h4>
                                <input class="form-control" type="text" name="description" id="description" required="">
                                <div class="mbl"></div>
                            </div>

						
							<h4 class="box-heading">Amount</h4>
                            <div class="input-group">
								<span class="input-group-addon">$</span>
                                <input class="form-control" type="text" onchange="formatCurrency(this)" name="amount" id="amount" required="">

                            </div>

                            <div class="form-group">
                                <h4 class="box-heading">Type</h4>
                                <select name="type" id="type" class="form-control">
                                    <option value="Pay In">Pay In</option>
                                    <option value="Pay Out">Pay Out</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <h4 class="box-heading">Receipt Image</h4>
                                <input type="file" name="image" id="image">

                            </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" name="submit_ledger" value="Add Ledger">
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

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
								
								<div class="col-lg-3">
                                    <div class="input-group">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#petty"><span class="fa fa-plus fa"></span> Add Payin / Payout </button>
                                    </div>
                                </div>

                            </div>

                        <div class="row">

                            <br>
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table table-hover table-primary mb30 align-center">
                                        <thead>
                                                <tr class="bg-primary">
													<th style="display: none;"></th>
                                                    <th style="color: #fff;">Description</th>
                                                    <th style="color: #fff;">Amount</th>
                                                    <th style="color: #fff;">Type</th>
                                                    <th style="color: #fff;">Image</th>
                                                    <th style="color: #fff;">Date</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                 <?php echo $view->displayPettyCashLedger($ledger); ?>
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
<script src="<?php echo ROOT; ?>js/fancybox/jquery.fancybox-1.3.4.min.js"></script>
<script src="<?php echo ROOT; ?>js/jquery.easing.1.3.js"></script>

<script>

       $(document).ready(function(){


           $('#dataTables-example').DataTable({
               responsive: true,
               "order": [[ 0, "desc" ]]
           });



       });


	
		</script>	
		<!-- fancy box -->
<script>
setInterval(function(){
        $('#gallery a').fancybox({
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
    }, 1000);
</script>



<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
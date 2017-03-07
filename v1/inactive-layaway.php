<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Inactive Layaway';
$employeeClass = new Employee();

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


if(isset($_POST['cancel_submit'])){
    $employeeClass->cancelLayaway();
}

$employeeClass = new Employee();
$view = new View();

$layaway = $employeeClass->getInactiveLayawayByMonth($from, $to);



require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-exchange"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Inactive Layaway</li>
                                </ul>
                                <h4>Inactive Layaway</h4>
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
                                    <table class="table table-hover table-primary mb30 align-center">
                                        <thead>
                                                <tr class="bg-primary">
                                                    <th style="color: #fff;">Customer Name</th>
                                                    <th style="color: #fff;">Items</th>
													<th style="color: #fff;">Total Amount</th>
                                                    <th style="color: #fff;">Date Added</th>
													<th style="color: #fff;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php echo $view->displayLayaway($layaway, 'inactive'); ?>
                                                </tbody>
                                    </table>


                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header info">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" ><i class="fa fa-warning"></i> Warning</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <p class="align-center">Do you really want to cancel <span class="bold" id="modal-title-customer"></span> contract?</p>
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                <input type="hidden" id="cid" name="cid">
                                                <input type="hidden" id="lid" name="lid">

                                                <button type="submit" name="cancel_submit" class="btn btn-primary" >Ok</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->


                                </div>
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
                "order": [[ 1, "asc" ]]
				});
                // Date Picker
                jQuery('#datepicker_from').datepicker();
                jQuery('#datepicker_to').datepicker();


            });
        </script>

        <script>
            function pushData(elem){
                var customer = elem.getAttribute('data-customer');
                var lid = elem.getAttribute('data-lid');
                var cid = elem.getAttribute('data-customerId');

                document.getElementById('modal-title-customer').innerHTML = customer + "'s";
                document.getElementById('lid').value = lid;
                document.getElementById('cid').value = cid;
            }
        </script>




<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
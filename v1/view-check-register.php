<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'View Check Register';

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
$employeeClass = new Employee();
$view = new View();

$check_registers = $employeeClass->getCheckRegisterByDateRange($from, $to);
require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>View Check Register</li>
                                </ul>
                                <h4>View Check Register</h4>
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
                                                    <th style="color: #fff;">Date</th>
                                                    <th style="color: #fff;">Number</th>
                                                    <th style="color: #fff;">Payee</th>
                                                    <th style="color: #fff;">Memo</th>
                                                    <th style="color: #fff;">Amount</th>
                                                    <th style="color: #fff;">Action</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                 <?php echo $view->displayCheckRegister($check_registers); ?>
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
$(document).ready(function() {
       $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 4, "desc" ]]
            });
		
		$('#datepicker_from').datepicker();
                $('#datepicker_to').datepicker();


    });
        </script>


<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
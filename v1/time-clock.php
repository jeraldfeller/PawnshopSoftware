<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Time Clock';

$usersTable = new Users();
$view = new View();

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

$attendance = $usersTable->getUserAttendanceById($USER_ID, $from, $to);


if(isset($_POST['clock_out'])){
    $usersTable->clockManagement(0);
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Time Clock</li>
                                </ul>
                                <h4>Time Clock</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->

                        <div class="row">
					
									<div class="col-lg-12 col-lg-offset-9">
										<button type="submit" class="btn btn-primary" <?php echo ($log_status == 1 ? 'disabled' : ''); ?>><i class="fa fa-clock-o"></i> Clock In</button>
										<button class="btn btn-primary" onClick="$('#logout_reminder').modal('show')"><i class="fa fa-clock-o"></i> Clock Out</button>

										<div class="modal fade" id="logout_reminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header info">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"> <i class="fa fa-info-circle"></i> Notice</h4>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-lg-12">
																<p>You are about to clock out, please confirm by clicking YES.</p>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
															<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
															<button type="submit" class="btn btn-primary">Yes</button>
															<input type="hidden" value="<?php echo $USER_ID;?>" name="user_id">
															<input type="hidden" value="0" name="clock_out">
														</form>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- /.modal -->


									</div>
								</div>
					
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
								<br>
								<br>
								<br>
						</div>
					
                   
				 
				
				 
				
                    <div class="col-lg-12">  
  
                        <div class="row">
                            <div class="table-responsive">
                            <table class="table table-hover table-primary mb30">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Time in</th>
                                                <th>Time out</th>
                                                <th>Total Hours</th>
                                            </tr>
                                            </thead>
                                            <tbody class="align-center">
                                            <?php echo $view->displayUserAttendance($attendance); ?>
                                            </tbody>
                                        </table>
                                </div>

						</div>


                    </div> <!-- end of col-lg-12-->
                        </div>

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
     
		

                $('#datepicker_from').datepicker();
                $('#datepicker_to').datepicker();


    });
        </script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
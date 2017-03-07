<?php
require '../Model/Init.php';
require SERVER_ROOT . '/includes/require.php';
$title = 'Loan Matrix';
$adminClass = new Admin();

$matrix = $adminClass->getLoanMatrix();
$view = new View();
if(isset($_POST['add_new_submit'])){
    $adminClass->addLoanMatrix();
}
if(isset($_POST['delete_submit'])){
    $adminClass->removeLoanMatrix();
}
if(isset($_POST['eTitle'])){
    $adminClass->updateLoanMatrix();
}
require SERVER_ROOT . '/includes/header.php';
?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-share-alt"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Loan Matrix</a></li>

                </ul>
                <h4>Loan Matrix</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

        <!-- CONTENT GOES HERE -->
        <div class="row">

            <div class="col-md-12">
            <button class="btn btn-primary pull-right" onClick="$('#modal_add_matrix').modal('show');"><i class="fa fa-plus"></i> Add Loan Matrix</button>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_add_matrix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Add New Loan Matrix</h4>
                                                                        </div>
                                                                        <div class="modal-body">

																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Description/Title</h5>
																				<div class="input-group col-lg-12">
																					<input type="text" class="form-control" name="data[title]" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Terms of Loan</h5>
																				<div class="input-group col-lg-12">
																					<input type="text" class="form-control" name="data[terms_of_loan]" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-6">
																				<h5 class="box-heading">Interest Rate For 1st 3 - 30 Day Period</h5>
																				<div class="input-group col-lg-12">
																					<input type="number" min="0" step="0.01" class="form-control" name="data[rate_first]" required/>
																					<span class="input-group-addon">%</span>

																				</div>
																				<div class="mbl"></div>
																				</div>
																				<div class="col-lg-6">
																				<h5 class="box-heading">Interest Rate Starting 4th 30 Day Period</h5>
																				<div class="input-group col-lg-12">
																					<input type="number" min="0" step="0.01" class="form-control" name="data[rate_second]" required/>
																					<span class="input-group-addon">%</span>
																				</div>
																				<div class="mbl"></div>
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Occur Late Fees</h5>
																				<div class="input-group col-lg-12">
																					<select name="data[late_fees]" class="form-control">
																						<option value="fixed">Fixed 30 days</option>
																						<option value="daily">Daily</option>
																					</select>
																					</div>
																				<div class="mbl"></div>
																				</div>
																			</div>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <input type="hidden" name="eId" id="eId">
                                                                            <button type="submit" name="add_new_submit" class="btn btn-primary">Add</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
															</form>


                                <div class="table-responsive">
                                    <br><br><br>
                                        <table class="table table-primary mb30">
											<thead>
											<tr>
												<th>Description/Title</th>
                                                <th>Terms of Loan</th>
												<th>Interest Rate For 1st 3 - 30 Day Loan Period</th>
												<th>Interest Rate Starting 4th 30 Day Period</th>
												<th>Occur Late Fees</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
												 <?php echo $view->displayLoanMatrix($matrix); ?>
											</tbody>
										</table>

										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Loan Matrix Information</h4>
                                                                        </div>
                                                                        <div class="modal-body">

																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Description/Title</h5>
																				<div class="input-group col-lg-12">
																					<input type="text" class="form-control" name="eTitle"  id="eTitle" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Terms of Loan</h5>
																				<div class="input-group col-lg-12">
																					<input type="text" class="form-control" name="eTerms"  id="eTerms" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-6">
																				<h5 class="box-heading">Interest Rate For 1st 3 - 30 Day Period</h5>
																				<div class="input-group col-lg-12">
																					<input type="text" class="form-control" name="eFirstRate"  id="eFirstRate" required/>
																					<span class="input-group-addon">%</span>

																				</div>
																				<div class="mbl"></div>
																				</div>
																				<div class="col-lg-6">
																				<h5 class="box-heading">Interest Rate Starting 4th 30 Day Period</h5>
																				<div class="input-group col-lg-12">
																					<input type="text" class="form-control" name="eSecondRate"  id="eSecondRate" required/>
																					<span class="input-group-addon">%</span>
																				</div>
																				<div class="mbl"></div>
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Occur Late Fees</h5>
																				<div class="input-group col-lg-12">
																					<select name="eLateFees" id="eLateFees" class="form-control">
																						<option value="fixed">Fixed 30 days</option>
																						<option value="daily">Daily</option>
																					</select>
																					</div>
																				<div class="mbl"></div>
																				</div>
																			</div>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <input type="hidden" name="eId" id="eId">
                                                                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
															</form>

                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> Warning</h4>
                                                                        </div>
                                                                        <div class="modal-body">

																			<p>Are you sure do want to remove <b><span id="display_title"></span></b>?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <input type="hidden" name="dId" id="dId">
                                                                            <button type="submit" name="delete_submit" class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
															</form>
                                </div><!-- table-responsive -->
                            </div>
        </div>

    </div><!-- contentpanel -->

</div>
</div><!-- mainwrapper -->
<script>
		function pushData(elem){
		    var type = elem.getAttribute('data-type');
			var id = elem.getAttribute('data-id');
			var title = elem.getAttribute('data-title');
			var term = elem.getAttribute('data-term');
			var rate_first = elem.getAttribute('data-rate_first');
			var rate_second = elem.getAttribute('data-rate_second');
			var occur = elem.getAttribute('data-occur');

			if(type == 'edit'){
                document.getElementById('eId').value = id;
                document.getElementById('eTitle').value = title;
                document.getElementById('eTerms').value = term;
                document.getElementById('eFirstRate').value = rate_first;
                document.getElementById('eSecondRate').value = rate_second;
                document.getElementById('eLateFees').value = occur;
			}else{

			    document.getElementById('dId').value = id;
			    document.getElementById('display_title').innerHTML = title;

			}



		}
	</script>

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<?php require SERVER_ROOT . '/includes/footer.php'; ?>
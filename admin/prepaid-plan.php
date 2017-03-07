<?php
require '../Model/Init.php';
require SERVER_ROOT . '/includes/require.php';
$title = 'Prepaid Plan';
$adminClass = new Admin();

$plans = $adminClass->getPrepaidPlan();
$view = new View();

if(isset($_POST['add_new_submit'])){
    $adminClass->addPrepaidPlan();
}
if(isset($_POST['edit_submit'])){
    $adminClass->editPrepaidPlan();
}
if(isset($_POST['delete_submit'])){
    $adminClass->deletePrepaidPlan();
}
require SERVER_ROOT . '/includes/header.php';
?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="icon icon-screen-smartphone"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li><a href="">Prepaid Plan</a></li>

                </ul>
                <h4>Prepaid Plan</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

        <!-- CONTENT GOES HERE -->
        <div class="row">

            <div class="col-md-12">
            <button class="btn btn-primary pull-right" onClick="$('#modal_add_plan').modal('show');"><i class="fa fa-plus"></i> Add Prepaid Plan</button>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_add_plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Add New Prepaid Plan</h4>
                                                                        </div>
                                                                        <div class="modal-body">

																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Plan Name</h5>
																				<div class="input-group col-lg-12">
																					<input type="text" class="form-control" name="plan_name" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-6">
																				<h5 class="box-heading">Cost</h5>
																				<div class="input-group col-lg-12">
																					<span class="input-group-addon">$</span>
                                                                                    <input type="text" class="form-control" name="cost" onchange="formatCurrency(this)" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>

																				<div class="col-lg-6">
																				<h5 class="box-heading">Retail</h5>
																				<div class="input-group col-lg-12">
																					<span class="input-group-addon">$</span>
                                                                                    <input type="text" class="form-control" name="retail" onchange="formatCurrency(this)" required/>

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
                                                <th>Prepaid Name</th>
                                                <th>Cost</th>
                                                <th>Retail</th>
                                                <th style="width: 20%;">Action</th>

                                            </tr>
											</thead>
											<tbody>
												 <?php
                                                    foreach ($plans as $row){
                                                        echo '<tr>';
                                                        echo '<td>' . $row['plan_name'] . '</td>';
                                                        echo '<td>$' . number_format($row['cost'], 2) . '</td>';
                                                        echo '<td>$' . number_format($row['retail'], 2) . '</td>';
                                                        echo '<td>';
                                                            echo '<button class="btn btn-success btn-xs"
                                                                  data-type="edit"
                                                                  data-id="' . $row['prepaid_id'] . '"
                                                                  data-name="' . $row['plan_name'] . '"
                                                                  data-cost="' . number_format($row['cost'], 2) . '"
                                                                  data-retail="' . number_format($row['retail'], 2) . '"
                                                                  data-toggle="modal"
                                                                  data-target="#modal_edit"
                                                                  onClick="pushData(this)">
                                                                  <i class="fa fa-edit"></i> Edit </button> ';
                                                        echo ' <button class="btn btn-danger btn-xs"
                                                                  data-type="delete"
                                                                  data-id="' . $row['prepaid_id'] . '"
                                                                  data-name="' . $row['plan_name'] . '"
                                                                  data-toggle="modal"
                                                                  data-target="#modal_delete"
                                                                  onClick="pushData(this)">
                                                                  <i class="fa fa-trash-o"></i> Delete </button>';
                                                        echo '</td>';
                                                        echo '</tr>';
                                                    }
                                                    ?>
											</tbody>
										</table>

										<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Edit Prepaid Plan</h4>
                                                                        </div>
                                                                        <div class="modal-body">

																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Plan Name</h5>
																				<div class="input-group col-lg-12">
																					<input type="text" class="form-control" name="plan_name" id="e_plan_name" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-6">
																				<h5 class="box-heading">Cost</h5>
																				<div class="input-group col-lg-12">
																					<span class="input-group-addon">$</span>
                                                                                    <input type="text" class="form-control" name="cost" id="e_cost" onchange="formatCurrency(this)" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>

																				<div class="col-lg-6">
																				<h5 class="box-heading">Retail</h5>
																				<div class="input-group col-lg-12">
																					<span class="input-group-addon">$</span>
                                                                                    <input type="text" class="form-control" name="retail" id="e_retail" onchange="formatCurrency(this)" required/>

																				</div>
																				<div class="mbl"></div>
																				</div>

																			</div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <input type="hidden" name="pid" id="epid">
                                                                            <button type="submit" name="edit_submit" class="btn btn-primary">Save</button>
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
                                                                        <input type="hidden" name="dpid" id="dpid">
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
			var name = elem.getAttribute('data-name');
			var cost = elem.getAttribute('data-cost');
			var retail = elem.getAttribute('data-retail');

			if(type == 'edit'){
                document.getElementById('epid').value = id;
                document.getElementById('e_plan_name').value = name;
                document.getElementById('e_cost').value = cost;
                document.getElementById('e_retail').value = retail;

			}else{

			    document.getElementById('dpid').value = id;
			    document.getElementById('display_title').innerHTML = name;

			}



		}
	</script>

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<?php require SERVER_ROOT . '/includes/footer.php'; ?>
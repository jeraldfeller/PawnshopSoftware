<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Collections';

$miscTable = new Miscellaneous();
$employeeClass = new Employee();
$view = new View();

$past_due = $miscTable->getPastDuePawnsCol();
$past_due_title = $miscTable->getPastDueTitlePawnsCol();


if(isset($_POST['collection_attempt'])){
    $employeeClass->addAttemptCollection($_POST['collection_attempt']);
}
if(isset($_POST['title_collection_attempt'])){
    $employeeClass->addAttemptCollection($_POST['title_collection_attempt']);
}
if(isset($_POST['forfiet'])){
    $employeeClass->closePawnCol('pawn');
}
if(isset($_POST['title_forfiet'])){
    $employeeClass->closePawnCol('title');
}


require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-dropbox"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Collections</li>
                                </ul>
                                <h4>Collections</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                        <h5 class="md-title mt0 mb10">Pawns</h5>
                        <div class="table-responsive">
                            <table class="table table-success mb30 align-center" id="generalPawn">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Item Description</th>
                                        <th>Loan Amount</th>
                                        <th>Amount Due</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php	echo $view->displayPastDuePawnsCol($past_due); ?>
                                </tbody>
                            </table>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="modal fade" id="modalGeneral" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header info">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="modal-title-general">Customer Information</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="text-center mbl" id="avatar"></div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <h3 id="customer_name"></h3>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p id="home_no"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p id="cell_no"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p id="address"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p id="address_complete"></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Items</th>
                                                                <th>Amount Due</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="align-center">
                                                                <td id="items"></td>
                                                                <td id="amount_due"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="note" class="control-label">
                                                                Notes</label>

                                                            <input id="note" type="text" name="note" placeholder="" class="form-control" />

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-5">
                                                            <label for="date" class="control-label">
                                                                Payment Arrangement Date</label>
                                                                <div class="input-group">
                                                                        <input type="date" id="date" class="form-control" name="arrangement_date">
                                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">

                                                <input type="hidden" id="cid" name="cid">
                                                <input type="hidden" id="lid" name="lid">
                                                <input type="hidden" id="lid" name="collection_attempt" value="attempt">
                                                <button type="submit" class="btn btn-primary" >Save</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->


                                </div>
                            </form>


                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="modal fade" id="modalGeneralForfiet" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header info">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="modal-title-general">Customer Information</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="text-center mbl" id="favatar"></div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <h3 id="fcustomer_name"></h3>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p id="fhome_no"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p id="fcell_no"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p id="faddress"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <p id="faddress_complete"></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Items</th>
                                                                <th>Amount Due</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="align-center">
                                                                <td id="fitems"></td>
                                                                <td id="famount_due"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">

                                                <input type="hidden" id="fcid" name="cid">
                                                <input type="hidden" id="flid" name="lid">
                                                <input type="hidden" name="forfiet" value="forfiet">
                                                <button type="submit" class="btn btn-danger" >Forfiet</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->


                                </div>
                            </form>


                         </div><!-- table-responsive -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
                </div>



            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                        <h5 class="md-title mt0 mb10">Title Pawns</h5>
                        <div class="table-responsive">
                            <table class="table table-success mb30 align-center" id="titlePawn">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Vehicle Description</th>
                                        <th>Loan Amount</th>
                                        <th>Amoun Due</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $view->displayPastDueTitlePawnsCol($past_due_title); ?>
                                </tbody>
                            </table>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="modal fade" id="modalTitlePawn"" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="modal-title-general">Customer Information</h4>
                                                        </div>
                                                        <div class="modal-body">

															<div class="row">
																<div class="col-lg-6">
																	<div class="text-center mbl" id="tavatar"></div>
																</div>
																<div class="col-lg-6">
																	<div class="row">
																		<div class="col-lg-12">
																			<h3 id="tcustomer_name"></h3>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<p id="thome_no"> </p>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<p id="tcell_no"></p>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<p id="taddress"></p>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<p id="taddress_complete"></p>
																		</div>
																	</div>
																</div>

															</div>
															<div class="row">
																<div class="col-lg-12">
																	<table class="table table-hover">
																		<thead>
																		<tr>
																			<th>Vin</th>
																			<th>Year</th>
																			<th>Model</th>
																			<th>Amount Due</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr class="align-center">
																			<td id="vin"></td>
																			<td id="year"></td>
																			<td id="model"></td>
																			<td id="tamount_due"></td>
																		</tr>
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="row">
																<div class="col-lg-12">
																	<div class="form-group">
																		<label for="note" class="control-label">
																			Notes</label>

																			<input id="note" type="text" name="note" placeholder="" class="form-control" />

																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-5">
																	<div class="form-group">
																		<label for="note" class="control-label">
																			Payment Arrangement Date</label>
																			<div class="input-group">
                                                                        <input type="date" id="date" class="form-control" name="arrangement_date">
                                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                         </div>

																	</div>
																</div>
															</div>

                                                        </div>
                                                        <div class="modal-footer">

															<input type="hidden" id="tcid" name="cid">
															<input type="hidden" id="tlid" name="lid">
															<input type="hidden" name="title_collection_attempt" value="title_attempt">
                                                            <button type="submit" class="btn btn-primary" >Save</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->


                        </div>
						</form>


						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="modal fade" id="modalTitleForfiet" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="modal-title-general">Customer Information</h4>
                                                        </div>
                                                        <div class="modal-body">

															<div class="row">
																<div class="col-lg-6">
																	<div class="text-center mbl" id="ftavatar"></div>
																</div>
																<div class="col-lg-6">
																	<div class="row">
																		<div class="col-lg-12">
																			<h3 id="ftcustomer_name"></h3>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<p id="fthome_no"> </p>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<p id="ftcell_no"></p>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<p id="ftaddress"></p>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<p id="ftaddress_complete"></p>
																		</div>
																	</div>
																</div>

															</div>
															<div class="row">
																<div class="col-lg-12">
																	<table class="table table-hover">
																		<thead>
																		<tr>
																			<th>Vin</th>
																			<th>Year</th>
																			<th>Model</th>
																			<th>Amount Due</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr class="align-center">
																			<td id="fvin"></td>
																			<td id="fyear"></td>
																			<td id="fmodel"></td>
																			<td id="ftamount_due"></td>
																		</tr>
																		</tbody>
																	</table>
																</div>
															</div>


                                                        </div>
                                                        <div class="modal-footer">

															<input type="hidden" id="ftcid" name="cid">
															<input type="hidden" id="ftlid" name="lid">
															<input type="hidden" name="title_forfiet" value="title_forfiet">
                                                            <button type="submit" class="btn btn-danger" >Repo</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->


                        </div>
						</form>

                         </div><!-- table-responsive -->
                    </div><!-- panel-body -->
                </div><!-- panel -->


        </div>

                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<script>

	function pushData(elem){

		var id = elem.getAttribute('data-id');
		var cid = elem.getAttribute('data-cid');
		var type = elem.getAttribute('data-type');
		var action = elem.getAttribute('data-action');
		var name = elem.getAttribute('data-customer');
		var phoneNo = elem.getAttribute('data-home-no');
		var cpNo = elem.getAttribute('data-cell-no');
		var address = elem.getAttribute('data-address');
		var city = elem.getAttribute('data-city');
		var state = elem.getAttribute('data-state');
		var zip = elem.getAttribute('data-zip');
		var avatarBaseCode = elem.getAttribute('data-customer-photo');
        if(avatarBaseCode == ' ' || avatarBaseCode == null || avatarBaseCode.length < 30){
            var avatar = '<img src="../images/avatar/no_photo.jpg" class="img-responsive" alt="avatar"/>';
        }else{
            var avatar = '<img src="data:image/jpeg;base64,'+ avatarBaseCode + '" class="img-responsive" alt="customer_photo"/>';
        }


		if(type == 'general'){

			var items = elem.getAttribute('data-items');
			var due = elem.getAttribute('data-due');


			if(action == 'attempt'){

				$('#customer_name').html(name);
				$('#home_no').html('<b>Home no: </b>' +phoneNo);
				$('#cell_no').html('<b>Cell no: </b>' +cpNo);
				$('#address').html('<b>Address: </b>' +address);
				$('#address_complete').html(city + ', ' + state + ' ' + zip);
				$('#avatar').html(avatar);

				$('#items').html(items);
				$('#amount_due').html('$' + due);

				$('#cid').val(cid);
				$('#lid').val(id);

			}
			else if(action == 'forfiet'){


				$('#fcustomer_name').html(name);
				$('#fhome_no').html('<b>Home no: </b>' +phoneNo);
				$('#fcell_no').html('<b>Cell no: </b>' +cpNo);
				$('#faddress').html('<b>Address: </b>' +address);
				$('#faddress_complete').html(city + ', ' + state + ' ' + zip);
				$('#favatar').html(avatar);

				$('#fitems').html(items);
				$('#famount_due').html('$' + due);

				$('#fcid').val(cid);
				$('#flid').val(id);



			}
		}

		else if(type == 'title_pawn'){

			var vin = elem.getAttribute('data-vin');
			var year = elem.getAttribute('data-year');
			var model = elem.getAttribute('data-model');
			var title_due = elem.getAttribute('data-due');


			if(action == 'attempt'){
				$('#tcustomer_name').html(name);
				$('#thome_no').html('<b>Home no: </b>' +phoneNo);
				$('#tcell_no').html('<b>Cell no: </b>' +cpNo);
				$('#taddress').html('<b>Address: </b>' +address);
				$('#taddress_complete').html(city + ', ' + state + ' ' + zip);
				$('#tavatar').html(avatar);


				$('#vin').html(vin);
				$('#year').html(year);
				$('#model').html(model);
				$('#tamount_due').html('$' + title_due);

				$('#tcid').val(cid);
				$('#tlid').val(id);
			}
			else if(action == 'forfiet'){

				$('#ftcustomer_name').html(name);
				$('#fthome_no').html('<b>Home no: </b>' +phoneNo);
				$('#ftcell_no').html('<b>Cell no: </b>' +cpNo);
				$('#ftaddress').html('<b>Address: </b>' +address);
				$('#ftaddress_complete').html(city + ', ' + state + ' ' + zip);
				$('#ftavatar').html(avatar);


				$('#fvin').html(vin);
				$('#fyear').html(year);
				$('#fmodel').html(model);
				$('#ftamount_due').html('$' + title_due);

				$('#ftcid').val(cid);
				$('#ftlid').val(id);
			}
			}


	}


    </script>


<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
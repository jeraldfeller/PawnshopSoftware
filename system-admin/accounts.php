<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../Model/Init.php';
require SERVER_ROOT_MAIN . '/includes/require.php';
$title = 'Accounts';

$companyUserClass = new CompanyUsers();
$systemClass = new CompanySystem();
$view = new CompanyUsersView();
$company = $companyUserClass->getAllCompany();
if(isset($_POST['add_fee'])){
    $companyUserClass->updateFee('Monthly Charges');
}

require SERVER_ROOT_MAIN . '/includes/header.php';

?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="fa fa-home"></i></a></li>
                    <li><a href="">Accounts</a></li>

                </ul>
                <h4>Accounts</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

        <!-- CONTENT GOES HERE -->
        <div class="row">

            <div class="col-md-12">
         
                                <div class="table-responsive">

                                        <table class="table table-primary mb30 align-center"  id="datatable-responsive">
											<thead>
											 <tr class="bg-primary">
												<th style="color: #fff;">Account No</th>
												<th style="color: #fff;">Company Name</th>
												<th style="color: #fff;">Software Version</th>
												<th>Monthly Charge</th>
												<th>Date Added</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											    <?php echo $view->displayCompanyUsersAccounts($company, $systemClass); ?>
											</tbody>
										</table>


									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_add_charges" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                                                        </div>
                                                                        <div class="modal-body">

																			 
																				<h5 class="box-heading">Amount</h5>
																				<div class="input-group col-lg-12">
																				<span class="input-group-addon">$</span>
																				<input type="text" class="form-control" id="fee" name="fee" onchange="formatCurrency(this);" required>
																				</div>
																			
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <input type="hidden" name="cuid" id="fee_cuid">
																		<input type="hidden" name="feeType" id="feeType">
																		<input type="hidden" name="company" id="company">
                                                                            <button type="submit" name="add_fee" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
									</form>





                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_view_company" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabelView"></h4>
                                                                        </div>
                                                                        <div class="modal-body">
		
																			<div class="row">
																				<div class="col-lg-12">
																					<div class="table-responsive">
																						   <table class="table table-bordered table-dark table-invoice">
																							<thead>
																							 <tr>
																								<th>Charge Type</th>
																								<th>Period</th>
																								<th>Amount</th>
																							</tr>
																							</thead>
																							<tbody  id="appendCharges">
																								
																							</tbody>
																						</table>
																					</div>
																					
																					 <table class="table table-total">
																						<tbody id="appendTotal">
																							
																						</tbody>
																					</table>
																				</div>
																			</div>
																		
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

<script src="<?php echo $host; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo $host; ?>js/notify.js"></script>

<script type="text/javascript">
        $(document).ready(function() {
			$('#datatable-responsive').DataTable({
                fixedHeader: true
			});
			$('.editFee').tooltip({title: "Edit", placement: "top", trigger: "hover"});
		});
</script>

<script>

	function pushData(elem){
		var type = elem.getAttribute('data-type');
		var companyName = elem.getAttribute('data-name');
		var cuid = elem.getAttribute('data-id');
		if(type == 'addCharge'){
			
			document.getElementById('myModalLabel').innerHTML = companyName;
			document.getElementById('fee_cuid').value = cuid;
			document.getElementById('company').value = companyName;
			document.getElementById('feeType').value = 'add';
			
		}else if(type == 'editCharge'){
			var fee = elem.getAttribute('data-charge');
			document.getElementById('myModalLabel').innerHTML = companyName;
			document.getElementById('fee_cuid').value = cuid;
			document.getElementById('company').value = companyName;
			document.getElementById('feeType').value = 'add';
			document.getElementById('fee').value = fee;
		}else if(type == 'view'){
				
			$('#appendCharges').empty();
			$('#appendTotal').empty();
			var fee = elem.getAttribute('data-charge');
			var unpaidCharge = elem.getAttribute('data-unpaidCharge');
			var parsedData = $.parseJSON(unpaidCharge);
			document.getElementById('myModalLabelView').innerHTML = companyName;
			var contents = "";
			var chargeSum = [];
			$.each(parsedData, function(index, value){
				contents += '<tr>';
				contents += '<td>' + value['transaction'] + '</td>';
				contents += '<td>' + value['period'] + '</td>';
				contents += '<td>$' + value['fee'] + '</td>';
				contents += '</tr>';
				chargeSum.push(value['fee']);
			});
			
			var total = 0;
			for(var i in chargeSum) { total += parseFloat(chargeSum[i]); }
			/*
			for(var i = 0, len = chargeSum.lenght; i < len; i++){
				total += chargeSum[i][1];
			}
			*/
			
			var summaryContents = '';
				summaryContents += '<tr>';
				summaryContents += '<td style="vertical-align: middle;">Total</td>';
				summaryContents += '<td>$' + total + '</td>';
				summaryContents += '</tr>';
			
			$('#appendCharges').append(contents);
			$('#appendTotal').append(summaryContents);
			
			//document.getElementById('appendCharges')append = contents;
		
			
		}
				
	}


</script>

      
<?php require SERVER_ROOT_MAIN . '/includes/footer.php'; ?>
<?php
 ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
require '../Model/Init.php';
require SERVER_ROOT_MAIN . '/includes/require.php';
$title = 'Add/View Company';

$companyUserClass = new CompanyUsers();

$systemClass = new CompanySystem();

$xmlapiClass = new xmlapi('superadmin.correllsoftware.com');

$view = new CompanyUsersView();

$company = $companyUserClass->getAllCompany();

if(isset($_POST['add_new_user'])){
    $companyUserClass->addCompany($xmlapiClass);
}

require SERVER_ROOT_MAIN . '/includes/header.php';

?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-users"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="fa fa-bank"></i></a></li>
                    <li><a href="">Add/View Company</a></li>

                </ul>
                <h4>Users</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

        <!-- CONTENT GOES HERE -->
        <div class="row">

            <div class="col-md-12">
            <button class="btn btn-primary pull-right" onClick="$('#modal_add_user').modal('show');"><i class="fa fa-plus"></i> Add New Company</button>
            <br><br><br>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Add New Company</h4>
                                                                        </div>
                                                                        <div class="modal-body">

																			<div class="row">
																				<div class="col-lg-12">
																				<h5 class="box-heading">Company Name</h5>
																				<div class="input-group col-lg-12">
																					<input id="inputName" type="text" placeholder="" class="form-control" name="data[company]" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>

																				<div class="col-lg-6">
																				<h5 class="box-heading">Username</h5>
																				<div class="input-group col-lg-12">
																					<input id="inputName" type="text" placeholder="" class="form-control" name="data[username]" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>

																				<div class="col-lg-6">
																				<h5 class="box-heading">Password</h5>
																				<div class="input-group col-lg-12">
																					<input id="inputName" type="password" placeholder="" class="form-control" name="data[password]" required/>

																				</div>
																				<div class="mbl"></div>
																				</div>
																				
																				<div class="col-lg-3">
																				<h5 class="box-heading">Account No.</h5>
																				<div class="input-group col-lg-12">
																					<input id="companyNo" type="text" placeholder="" class="form-control" name="data[account_no]" required/>

																				</div>
																				<div class="mbl"></div>
																				</div>
																				
																				<div class="col-lg-4">
																				<h5 class="box-heading">&nbsp;</h5>
																				<div class="input-group col-lg-12">
																					<button type="button" style="height: 40px;" class="btn btn-success" onClick="makeid()">Generate Account No</button>
																				</div>
																				<div class="mbl"></div>
																				</div>

																			</div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="add_new_user" class="btn btn-primary">Add User</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
															</form>



															<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_edit_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header info">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                                                                        </div>
                                                                        <div class="modal-body">

																			<div class="row">
																				<div class="col-lg-6">
																				<h5 class="box-heading">Company Name</h5>
																				<div class="input-group col-lg-12">
																					<input id="eFirstName" type="text" placeholder="" class="form-control" name="data[company]" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>

																				<div class="col-lg-6">
																				<h5 class="box-heading">Username</h5>
																				<div class="input-group col-lg-12">
																					<input id="eLastName" type="text" placeholder="" class="form-control" name="data[username]" required/>
																				</div>
																				<div class="mbl"></div>
																				</div>

																				<div class="col-lg-6">
																				<h5 class="box-heading">Password</h5>
																				<div class="input-group col-lg-12">
																					<input id="eUsername" type="text" placeholder="" class="form-control" name="data[password]" required/>

																				</div>
																				<div class="mbl"></div>
																				</div>

																			</div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" id="cuid" name="data[cuid]">
                                                                            <button type="submit" name="edit_user" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
															</form>







                                <div class="table-responsive">

                                        <table class="table table-primary mb30 align-center">
											<thead>
											<tr>
												<th>Account No</th>
												<th>Company Name</th>
                                                <th>Username</th>
												<th>Password</th>
												<th>Software Version</th>
												<th>Date Added</th>

												<th style="width: 30%;">Action</th>
											</tr>
											</thead>
											<tbody>
											    <?php echo $view->displayCompanyUsers($company, $systemClass); ?>
											</tbody>
										</table>








                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="modal fade" id="modal_delete_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                        <input type="hidden" name="cuid" id="cuid">
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
function makeid()
{
    var text = "";
    var possible = "0123456789";

    for( var i=0; i < 6; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));
	
	document.getElementById('companyNo').value = text;
}
		function pushData(elem){
		        var type = elem.getAttribute('data-type');

		        if(type == 'manage'){

                    var id = elem.getAttribute('data-id');
                       var user = elem.getAttribute('data-user');
                       var customer = elem.getAttribute('data-customer');
                       var general = elem.getAttribute('data-general');
                       var title = elem.getAttribute('data-title');
                       var scrap = elem.getAttribute('data-scrap');
                       var repair = elem.getAttribute('data-repair');
                       var refill = elem.getAttribute('data-refill');
                       var rto = elem.getAttribute('data-rto');
                       var inventory = elem.getAttribute('data-inventory');
                       var outright = elem.getAttribute('data-outright');
                       var pos = elem.getAttribute('data-pos');
                       var petty = elem.getAttribute('data-petty');
                       var check = elem.getAttribute('data-check');
                       var void_page = elem.getAttribute('data-void');


                       document.getElementById('myModalLabelPages').innerHTML = user;
                       document.getElementById('uid').value = id;

                       if(customer == 1){
                           document.getElementById("customer_page").checked = true;
                       }
                       else{
                           document.getElementById("customer_page").checked = false;
                       }
                       if(general == 1){
                           document.getElementById("general_pawns").checked = true;
                       }
                       else{
                           document.getElementById("general_pawns").checked = false;
                       }
                       if(title == 1){
                           document.getElementById("title_pawns").checked = true;
                       }
                       else{
                           document.getElementById("title_pawns").checked = false;
                       }
                       if(scrap == 1){
                           document.getElementById("scrap").checked = true;
                       }
                       else{
                           document.getElementById("scrap").checked = false;
                       }
                       if(repair == 1){
                           document.getElementById("repair").checked = true;
                       }
                       else{
                           document.getElementById("repair").checked = false;
                       }
                       if(refill == 1){
                           document.getElementById("refill").checked = true;
                       }
                       else{
                           document.getElementById("refill").checked = false;
                       }
                       if(rto == 1){
                           document.getElementById("rto").checked = true;
                       }
                       else{
                           document.getElementById("rto").checked = false;
                       }
                       if(inventory == 1){
                           document.getElementById("inventory").checked = true;
                       }
                       else{
                           document.getElementById("inventory").checked = false;
                       }
                       if(outright == 1){
                           document.getElementById("outright").checked = true;
                       }
                       else{
                           document.getElementById("outright").checked = false;
                       }
                       if(pos == 1){
                           document.getElementById("pos").checked = true;
                       }
                       else{
                           document.getElementById("pos").checked = false;
                       }
                       if(petty == 1){
                           document.getElementById("petty").checked = true;
                       }
                       else{
                           document.getElementById("petty").checked = false;
                       }
                       if(check == 1){
                           document.getElementById("check").checked = true;
                       }
                       else{
                           document.getElementById("check").checked = false;
                       }
                       if(void_page == 1){
                           document.getElementById("void").checked = true;
                       }
                       else{
                           document.getElementById("void").checked = false;
                       }
               }else if(type == 'edit'){

                    var id = elem.getAttribute('data-id');
                    var first_name = elem.getAttribute('data-first-name');
                    var last_name = elem.getAttribute('data-last-name');
                    var user = elem.getAttribute('data-user');
                    var password = elem.getAttribute('data-password');

                    document.getElementById('eFirstName').value = first_name;
                    document.getElementById('eLastName').value = last_name;
                    document.getElementById('eUsername').value = user;
                    document.getElementById('ePassword').value = password;
                    document.getElementById('eUid').value = id;

               }else if(type == 'delete'){
                    var id = elem.getAttribute('data-id');
                    var first_name = elem.getAttribute('data-first-name');
                    var last_name = elem.getAttribute('data-last-name');

                    document.getElementById('display_title').innerHTML = first_name + ' ' + last_name;
                    document.getElementById('dUid').value = id;
               }

		}
	</script>

<script src="<?php echo $host; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo $host; ?>js/notify.js"></script>
<?php require SERVER_ROOT_MAIN . '/includes/footer.php'; ?>
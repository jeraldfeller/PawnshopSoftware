<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Add Customer';



$employeeTable = new Employee();
$view = new View();

$state = $employeeTable->getState();

if(isset($_POST['submit'])){
    $employeeTable->addCustomer();
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Add Customer</li>
                                </ul>
                                <h4>Add Customer</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Customer Information</h4>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <h4 class="box-heading">Add Photo</h4>
                                                                <input type="file" name="customer_photo" id="customer_photo">
                                                        <div class="mbl"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <h5 class="box-heading">First Name</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input id="inputName" type="text" placeholder="" class="form-control" name="first_name" required/>

                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <h5 class="box-heading">Middle Name</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input id="inputMiddleName" type="text" placeholder="" class="form-control" name="middle_name"/>

                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <h5 class="box-heading">Last Name</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input id="inputLastName" type="text" placeholder="" class="form-control" name="last_name" required/>

                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <h5 class="box-heading">Date of Birth</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker_dob"  name="date_birth">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-9">
                                                    <h5 class="box-heading">Address</h5>
                                                    <div class="input-group col-lg-12">
                                                         <textarea id="inputAddress" placeholder="" class="form-control" name="address"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">City</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputCity" type="text" placeholder="" class="form-control" name="city">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">State</h5>
                                                    <div class="input-group col-lg-12">
                                                        <select class="form-control" name="state">
                                                            <option value="N/A">-- Select State --</option>
                                                            <?php echo $view->displayState($state, ''); ?>
													    </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Zip Code</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputZipCode" type="text" placeholder="" class="form-control" name="zip">
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Home Phone #</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputHomePhone" type="text" placeholder="000-000-0000" class="form-control" name="home_number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="000-000-0000">
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Cell Phone #</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputCellPhone" type="text" placeholder="" class="form-control" name="cell_number">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <h5 class="box-heading">Drivers License</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputDL" type="text" placeholder="" class="form-control" name="dl_number"/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <h5 class="box-heading">Date Issued</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker_di"  name="dl_issue_date">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <h5 class="box-heading">Expiry Date</h5>
                                                    <div class="input-group col-lg-12">
                                                          <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker_de"  name="dl_expire_date" >
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <h5 class="box-heading">Drivers License Photo</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input type="file" name="dl_photo" id="dl_photo">
                                                    </div>
                                                </div>


                                                <div class="col-lg-5">
                                                    <h5 class="box-heading">Social Security #</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputSSS" type="text" placeholder="" class="form-control" name="sss_no">
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <h5 class="box-heading">Height(in)</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputHeight" type="number" placeholder="" class="form-control" name="height">
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <h5 class="box-heading">Weight(lbs)</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputWeight" type="number" placeholder="" class="form-control" name="weight">
                                                    </div>
                                                </div>

                                                 <div class="col-lg-3">
                                                    <h5 class="box-heading">Eye Color</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input id="inputEyeColor" type="text" placeholder="" class="form-control" name="eye_color">
                                                    </div>
                                                </div>

                                                 <div class="col-lg-12">
                                                    <h5 class="box-heading">SSS Photo</h5>
                                                    <div class="input-group col-lg-12">
                                                         <input type="file" name="sss_photo" id="sss_photo">
                                                    </div>
                                                </div>







                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">

                                            <input type="submit" id="submit_btn" name="submit" class="btn btn-primary" value="Add Customer">
                                            <input type="reset" class="btn btn-warning" value="RESET FIELDS">


									<?php

                                    $date = date('Y-m-d');



                                    ?>
									<input type="hidden" value="<?php echo $date; ?>" name="date">

                                        </div><!-- panel-footer -->
                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->
                        </div>
                        </form>

                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>

 <script src="<?php echo ROOT; ?>js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo ROOT; ?>js/bootstrap-timepicker.min.js"></script>
         <script src="<?php echo ROOT; ?>js/automask.js"></script>


<script>
            jQuery(document).ready(function() {
                // Date Picker
                 jQuery('#inputHomePhone').mask('000-000-0000');
                jQuery('#datepicker_dob').datepicker();
                  jQuery('#datepicker_di').datepicker();
                    jQuery('#datepicker_de').datepicker();



            });
        </script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
<?php
require '../Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Company Info';

$adminClass = new Admin();
if (isset($_POST['submit'])){

    $adminClass->updateCompanyInfo();
}

$info = $adminClass->getCompanyInfo();

foreach($info as $row){

    $company_name = $row['company_name'];
    $company_address = $row['company_address'];
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $phone_no = $row['phone_no'];
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Company Info</li>
                                </ul>
                                <h4>Company Info</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Edit Company Information</h4>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Company Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $company_name; ?>" name="data[company_name]"/>
                                                    </div><!-- form-group -->
                                                </div><!-- col-sm-6 -->

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Address</label>
                                                       <textarea class="form-control" name="data[address]"><?php echo $company_address; ?></textarea>
                                                    </div><!-- form-group -->
                                                </div><!-- col-sm-6 -->
                                            </div><!-- row -->

                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label class="control-label">City</label>
                                                        <input type="text" class="form-control" value="<?php echo $city; ?>" name="data[city]"/>
                                                    </div><!-- form-group -->
                                                </div><!-- col-sm-6 -->

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label class="control-label">State</label>
                                                         <input type="text" class="form-control" value="<?php echo $state; ?>" name="data[state]"/>
                                                    </div><!-- form-group -->
                                                </div><!-- col-sm-6 -->

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Zip Code</label>
                                                         <input type="text" class="form-control" value="<?php echo $zip; ?>" name="data[zip]"/>
                                                    </div><!-- form-group -->
                                                </div><!-- col-sm-6 -->

                                                 <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Phone #</label>
                                                         <input type="text" class="form-control" value="<?php echo $phone_no; ?>" name="data[phone_no]"/>
                                                    </div><!-- form-group -->
                                                </div><!-- col-sm-6 -->
                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Edit/Change</button>

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
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
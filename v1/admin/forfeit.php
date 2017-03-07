<?php
require '../Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Forfeit Days';

$adminClass = new Admin();
if (isset($_POST['submit'])){

    $adminClass->updateForfietDays();
}

$f_days = $adminClass->getForfietDays();
foreach($f_days as $row){
    $gp_f = $row['general_pawns'];
    $tp_f = $row['title_pawns'];
}




require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-gear"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Forfeit Days</li>
                                </ul>
                                <h4>Forfeit Days</h4>
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
                                            <h4 class="panel-title">Edit Forfeit Days</h4>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">General Pawns Forfeit Days</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="number" class="form-control" value="<?php echo $gp_f; ?>" name="data[general_pawns]"/>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Title Pawns Forfeit Days</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="number" class="form-control" value="<?php echo $tp_f; ?>" name="data[title_pawns]"/>

                                                    </div>
                                                </div>

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
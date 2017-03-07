<?php
require 'Model/Init.php';
require SERVER_ROOT_MAIN . '/includes/require.php';
$title = 'Dashboard';
require  SERVER_ROOT_MAIN . '/includes/header.php';
?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-tachometer"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Dashboard</li>
                </ul>
                <h4>Dashboard</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

        <div class="row row-stat">
        <div class="col-md-3">
                <div class="panel panel-info-alt noborder">
                    <div class="panel-heading noborder">
                        <div class="panel-btns">
                            <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                        </div><!-- panel-btns -->
                        <div class="panel-icon"><i class="fa">#</i></div>
                        <div class="media-body">
                            <h5 class="md-title nomargin">Total # of Pawns</h5>
                            <h1 class="mt5"><?php echo 0; ?></h1>
                        </div><!-- media-body -->
                        <hr>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->

            <div class="col-md-3">
                <div class="panel panel-primary noborder">
                    <div class="panel-heading noborder">
                        <div class="panel-btns">
                            <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                        </div><!-- panel-btns -->
                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                        <div class="media-body">
                            <h5 class="md-title nomargin">Principle Loaned</h5>
                            <h1 class="mt5"><?php echo 0; ?></h1>
                        </div><!-- media-body -->
                        <hr>


                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->

            <div class="col-md-3">
                <div class="panel panel-success-alt noborder">
                    <div class="panel-heading noborder">
                        <div class="panel-btns">
                            <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                        </div><!-- panel-btns -->
                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                        <div class="media-body">
                            <h5 class="md-title nomargin">Interest Accured</h5>
                            <h1 class="mt5"><?php echo 0; ?></h1>
                        </div><!-- media-body -->
                        <hr>


                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->

            <div class="col-md-3">
                <div class="panel panel-dark noborder">
                    <div class="panel-heading noborder">
                        <div class="panel-btns">
                            <a href="" class="panel-close tooltips" data-toggle="tooltip" data-placement="left" title="Close Panel"><i class="fa fa-times"></i></a>
                        </div><!-- panel-btns -->
                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                        <div class="media-body">
                            <h5 class="md-title nomargin">Value of All Pawns</h5>
                            <h1 class="mt5"><?php echo 0; ?></h1>
                        </div><!-- media-body -->
                        <hr>

                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->
        </div><!-- row -->



    </div><!-- contentpanel -->

</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>
<script src="../js/jquery.gritter.min.js"></script>
<script src="../js/notify.js"></script>
<?php

require  SERVER_ROOT_MAIN . '/includes/footer.php';
?>
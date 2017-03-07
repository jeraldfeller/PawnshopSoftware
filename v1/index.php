<?php
require 'Model/Init.php';
require 'includes/require.php';
$title = 'Dashboard';

$miscTable = new Miscellaneous();
$view = new View();
$pawn_count = $miscTable->getPawnCount();
$pawn_title_count = $miscTable->getTitlePawnCount();
$total_pawn = $pawn_count + $pawn_title_count;
$pawn_sum = $miscTable->getPawnSum();
$title_pawn_sum = $miscTable->getTitlePawnSum();
$total_pawn_sum = $pawn_sum + $title_pawn_sum;
$pawn_interest_accured = $miscTable->getPawnInterestAccuredSum();
$title_pawn_interest_accured = $miscTable->getTitlePawnInterestAccuredSum();
$total_interest_accured = $pawn_interest_accured + $title_pawn_interest_accured;

$total_value_of_all_pawns = $total_pawn_sum + $total_interest_accured;

$past_due = $miscTable->getPastDuePawns();
$past_due_title = $miscTable->getPastDueTitlePawns();
require  SERVER_ROOT . '/' . VERSION . '/includes/header.php';

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
                            <h1 class="mt5"><?php echo $total_pawn; ?></h1>
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
                            <h1 class="mt5"><?php echo number_format($total_pawn_sum, 2); ?></h1>
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
                            <h1 class="mt5"><?php echo number_format($total_interest_accured, 2); ?></h1>
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
                            <h1 class="mt5"><?php echo number_format($total_value_of_all_pawns, 2); ?></h1>
                        </div><!-- media-body -->
                        <hr>

                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->
        </div><!-- row -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                        <h5 class="md-title mt0 mb10">Pawns Past Due and coming due in the next 5 days</h5>
                        <div class="table-responsive">
                            <table class="table table-success mb30" id="generalPawn">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Loan Amount</th>
                                        <th>Loan Title</th>
                                        <th>Terms of Loan</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="displayItems">

                                </tbody>
                            </table>
                         </div><!-- table-responsive -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                        <h5 class="md-title mt0 mb10">Title Pawns Past Due and coming due in the next 5 days</h5>
                        <div class="table-responsive">
                            <table class="table table-success mb30" id="titlePawn">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Loan Amount</th>
                                        <th>Loan Title</th>
                                        <th>Terms of Loan</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="displayItemsTitle">

                                </tbody>
                            </table>
                         </div><!-- table-responsive -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div>
        </div>


    </div><!-- contentpanel -->

</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>

<script>

        function refreshTablePawns(){
            getPastDuePawns();
        }
        function refreshTableTitlePawns(){
            getPastDueTitlePawns();
        }

        setTimeout(function(){

            getPastDuePawns();

        },3000)
        setTimeout(function(){

            getPastDueTitlePawns();

        },6000)

    </script>

<script>
        $(document).ready(function(){



            $('table#generalPawn tbody#displayItems').on('click', '.mark', function() {


                var $id = $(this).closest('tr').find('td:first').text();
                var $loan_id = $('#loan_id_'+$id).text();


                closePawn($loan_id);
            });


            $('table#titlePawn tbody#displayItemsTitle').on('click', '.mark_title', function() {

                var $id = $(this).closest('tr').find('td:first').text();
                var $loan_id = $('#title_id_'+$id).text();

                closeTitlePawn($loan_id);
            });

        });

    </script>
<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<?php

require  SERVER_ROOT . '/' . VERSION . '/includes/footer.php';
?>
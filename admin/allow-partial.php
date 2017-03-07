<?php
require '../Model/Init.php';
require SERVER_ROOT . '/includes/require.php';
$title = 'Allow Partial';

$adminClass = new Admin();
$pawns = $adminClass->getGeneralPawns();
$title_pawns = $adminClass->getTitlePawns();
$view = new View();

require SERVER_ROOT . '/includes/header.php';
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
                                    <li>Allow Partial</li>
                                </ul>
                                <h4>Allow Partial</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->

                        <div class="row">

                            <div class="col-md-12">
                            <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-line">
                                    <li class="active"><a href="#general-pawns" data-toggle="tab"><strong>General Pawns</strong></a></li>
                                    <li><a href="#title-pawns" data-toggle="tab"><strong>Title Pawns</strong></a></li>
                                </ul>

                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="general-pawns">
                                    <table id="general-table" class="align-center table table-striped table-hover responsive mb30">
                                            <thead>
                                            <tr class="bg-primary">
                                                <th style="color: #ffffff !important;">Customer Name</th>
                                                <th style="color: #ffffff !important;">Loan Amount</th>
                                                <th style="color: #ffffff !important;">Interest</th>
                                                <th style="color: #ffffff !important;">Terms</th>
                                                <th style="color: #ffffff !important;">Due Date</th>
                                                <th style="color: #ffffff !important;">Allow Partial</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                foreach($pawns as $row){
                                                    $interest = $row['interest_rate'];
                                                    $loan_amount = $row['total_loan'];
                                                    $interest = ($loan_amount * $interest) / 100;
                                                    $state = $row['allow_partial'];
                                                    if($state == 1){
                                                        $checked = 'checked';
                                                    }
                                                    else{

                                                        $checked = '';

                                                    }
                                                    if($state == 2){
                                                        $disabled = 'disabled';
                                                    }
                                                    else {
                                                        $disabled = '';
                                                    }

                                                    echo '<tr>';
                                                    echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                    echo '<td>$' . number_format($loan_amount, 2) . '</td>';
                                                    echo '<td>$' . number_format($interest, 2) . '</td>';
                                                    echo '<td>' . $row['title'] . '</td>';
                                                    echo '<td>' . date('m/d/Y' , strtotime($row['due_date'])) . '</td>';
                                                    echo '<td><div class="ckbox ckbox-success"><input id="checkboxSuccess" data-type="loan_info_tbl" class="allow_button" type="checkbox" value="' . $row['loan_info_id'] . '" onChange="updateAllow(this)" ' . $checked . $disabled . '><label for="checkboxSuccess"> </label></div>';
                                                    echo '</tr>';
                                                }



                                                ?>

                                            </tbody>

										</table>

                                    </div>

                                    <div class="tab-pane" id="title-pawns">
                                    <table id="title-table" class="align-center table table-striped table-hover responsive mb30">
                                                    <thead>
                                        <tr class="bg-primary">
                                            <th style="color: #ffffff !important;">Customer Name</th>
                                            <th style="color: #ffffff !important;">Vin #</th>
                                            <th style="color: #ffffff !important;">Loan Amount</th>
                                            <th style="color: #ffffff !important;">Interest</th>
                                            <th style="color: #ffffff !important;">Terms</th>
                                            <th style="color: #ffffff !important;">Due Date</th>
                                            <th style="color: #ffffff !important;">Allow Partial</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                            foreach($title_pawns as $row){

                                                $interest = $row['interest_rate'];
                                                $loan_amount = $row['total_loan'];
                                                $interest = ($loan_amount * $interest) / 100;

                                                $state = $row['allow_partial'];
                                                if($state == 1){
                                                    $checked = 'checked';
                                                }
                                                else{

                                                    $checked = '';

                                                }
                                                if($state == 2){
                                                    $disabled = 'disabled';
                                                }
                                                else {
                                                    $disabled = '';
                                                }

                                                echo '<tr>';
                                                echo '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>';
                                                echo '<td>' . $row['vin_no'] . '</td>';
                                                echo '<td>$' . number_format($row['total_loan'], 2) . '</td>';
                                                echo '<td>$' . number_format($row['interest_accured'], 2) . '</td>';
                                                echo '<td>' . $row['title'] . '</td>';
                                                echo '<td>' . date('m/d/Y' , strtotime($row['due_date'])) . '</td>';
                                                echo '<td><div class="switch-wrapper"><input data-type="title_pawn_tbl" data-on-color="success" data-off-color="danger" data-on-text="YES" data-off-text="NO" class="allow_button" type="checkbox" value="' . $row['tittle_pawn_id'] . '" onChange="updateAllow(this)" ' . $checked . $disabled . '></div>';
                                                echo '</tr>';
                                            }



                                            ?>

                                        </tbody>
                                    </table>
                                    </div>


                                </div>
                            </div><!-- col-md-6 -->
                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->
<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<!-- switch -->


<script>
            jQuery(document).ready(function(){

                jQuery('#general-table').DataTable({
                    responsive: true
                });
                 jQuery('#title-table').DataTable({
                    responsive: true
                });
                });
</script>

<script>

    function updateAllow(elem){

        var id = elem.value;
        var state = elem.checked;
        var type = elem.getAttribute('data-type');
        updateAllowPartial(id, state, type);

    }

</script>
<?php require SERVER_ROOT . '/includes/footer.php'; ?>
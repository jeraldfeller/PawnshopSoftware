<?php
require 'Model/Init.php';
require 'includes/require.php';
$title = 'Scrap Awaiting Melting';



$employeeClass = new Employee();
$view = new View();

$items = $employeeClass->getAllScrapItem('melting');
require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left" style="padding-top: 5px;">
                <i class="icon icon-diamond"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Scrap Awaiting Melting</li>
                </ul>
                <h4>Scrap Awaiting Melting</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

 
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                      
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-primary align-center">

                                                <thead>
                                                <tr>
                                                    <th>Item Description</th>
                                                    <th>Weight(in grams)</th>
                                                    <th>Retail</th>
                                                    <th>Date Added</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php echo $view->displayScrapInventory($items, 'melting'); ?>
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

        $(document).ready(function() {
            $('#dataTables-example, #dataTables-title').DataTable({
                responsive: true,
                "order": [[ 3, "desc" ]]
            });



        });
    </script>


<?php

require SERVER_ROOT . '/' . VERSION . '/includes/footer.php';
?>
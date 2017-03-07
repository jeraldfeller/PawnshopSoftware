<?php
require 'Model/Init.php';
require 'includes/require.php';
$title = 'Scrap On Hold';


$employeeClass = new Employee();
$view = new View();

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
                    <li>Scrap On Hold</li>
                </ul>
                <h4>Scrap On Hold</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

 
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                      
                        <div class="table-responsive">
                            <table class="table table-primary table-hover align-center mb30">
                                <thead>
                                                <tr>
                                                    <th>Item Description</th>
                                                    <th>Weight(in grams)</th>
                                                    <th>Retail</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="displayScrapItems">

                                                </tbody>
                            </table>
							
							<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="bold">Item Details</span>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" id="modal_inventory_id">
                                                            <input type="hidden" id="modal_inventory_status">
                                                            <table class="table-align-center table>
                                                                            <thead class="align-center bold">
                                                            <tr>
                                                                <th>Description</th>
                                                                <th>Weight(in grams)</th>
                                                                <th>Price</th>

                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>

                                                                <td id="modal_inventory_description"></td>
                                                                <td id="modal_inventory_weight"></td>
                                                                <td id="modal_inventory_retail"></td>

                                                            </tr>
                                                            </tbody>




                                                            </table>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="updateScrap()">Yes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
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
        function pushData(elem) {
            var si_id = elem.getAttribute('data-id');
            var desc = elem.getAttribute('data-description');
            var weight = elem.getAttribute('data-weight');
            var price = elem.getAttribute('data-amount');
            var status = elem.getAttribute('data-status');

            if(status == 'inventory'){
                document.getElementById('myModalLabel').innerHTML = "Are you sure do want to move this item into inventory?";
            }
            else{
                document.getElementById('myModalLabel').innerHTML = "Are you sure do want to move this item into melting?";
            }

            document.getElementById('modal_inventory_id').value = si_id;
            document.getElementById('modal_inventory_status').value = status;
            document.getElementById('modal_inventory_description').innerHTML = desc;
            document.getElementById('modal_inventory_weight').innerHTML = weight;
            document.getElementById('modal_inventory_retail').innerHTML = "$"+price;


        }

        function updateScrap(){

            var id = document.getElementById('modal_inventory_id').value;
            var status = document.getElementById('modal_inventory_status').value;

            updateScrapStatus(id, status);

        }
    </script>


    <script>

        $(document).ready(function() {

            displayScrapItems();
            $('#dataTables-example, #dataTables-title').DataTable({
                responsive: true,
                "order": [[ 3, "desc" ]]
            });



        });
    </script>


<?php

require SERVER_ROOT . '/' . VERSION . '/includes/footer.php';
?>
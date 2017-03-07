<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'View Inventory';

$adminClass = new Admin();
$employeeClass = new Employee();
$customer = $employeeClass->getCustomer();
if(isset($_GET['flt'])){
    $items = $employeeClass->getInventoryItems($_GET['flt']);
}else{
    $items = $employeeClass->getInventoryItems('All');
}

$view = new View();


if(isset($_POST['edit'])){

    $employeeClass->updateInventoryItem('edit');
}
if(isset($_POST['delete'])){
    $employeeClass->updateInventoryItem('delete');
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-database"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>View Inventory</li>
                                </ul>
                                <h4>View Inventory</h4>
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
                                           
                                            <?php
											$classAll = 'btn-success';
											$classNumber = 'btn-info';
											$class = 'btn-info';
											if(isset($_GET['flt'])){
												if($_GET['flt'] == 'All'){
													$classAll = 'btn-success';
												}
												else{
													$classAll = 'btn-info';
												}

												if($_GET['flt'] == '0-9'){
													$classNumber = 'btn-success';
												}
												else{
													$classNumber = 'btn-info';
												}


											}
											echo '<a href="view-inventory?flt=All"<button class="btn btn-md ' . $classAll . '" style="font-size: .7em;">All</button></a>';
											echo '<a href="view-inventory?flt=0-9"<button class="btn btn-md ' . $classNumber . '" style="font-size: .7em;">#</button></a>';
											for($x=65; $x < (65+26); $x++){
												if(isset($_GET['flt'])){
													if($_GET['flt'] == Chr($x)){
														$class = 'btn-success';
													}
													else{
														$class = 'btn-info';
													}
												}

												echo '<a href="view-inventory?flt='.Chr($x).'"<button class="btn ' . $class . ' btn-md" style="font-size: .7em;">' . Chr($x) . '</button></a>';
											}
											?>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-striped table-hover align-center" id="dataTables-example">
                                                <thead>
                                                <tr class="bg-primary">

                                                    <th style="color: #fff;">Item #</th>
													<th style="color: #fff;">Image</th>
                                                    <th style="color: #fff;">Description</th>

                                                    <th style="color: #fff;">Cost</th>

                                                    <th style="color: #fff;">Retail</th>
                                                    <th style="color: #fff;">Quantity</th>
                                                    <th style="color: #fff;">Action</th>

                                                </tr>
                                                </thead>
                                                <tbody id="displayItems">
                                                <?php echo $view->displayInventoryItems($items, 'view'); ?>
                                                </tbody>
                                            </table>


                                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form action="view-inventory.php" method="post">
                                                                <div class="row">
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <h4 class="box-heading">Item #</h4>
                                                                            <input type="text" placeholder="" class="form-control" id="item_no" name="item_no" required/>
                                                                            <div class="mbl"></div>
                                                                        </div>

                                                                    </div>


                                                                    <div class="col-lg-7">
                                                                        <div class="form-group">
                                                                            <h4 class="box-heading">Description</h4>
                                                                            <input type="text" placeholder="" class="form-control" id="description" name="description" required/>
                                                                            <div class="mbl"></div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <h4 class="box-heading">Cost</h4>
                                                                            <div class="input-group input-group-md">

                                                                                <span class="input-group-addon">$</span>
                                                                                <input type="text" placeholder="" class="form-control" id="cost" name="cost" onchange="formatCurrency(this)" required/>
                                                                            </div>
                                                                            <div class="mbl"></div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <h4 class="box-heading">Retail</h4>
                                                                            <div class="input-group input-group-md">

                                                                                <span class="input-group-addon">$</span>
                                                                                <input type="text" placeholder="" class="form-control" id="retail" name="retail" onchange="formatCurrency(this)" required/>
                                                                            </div>
                                                                            <div class="mbl"></div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <h4 class="box-heading">Quantity</h4>
                                                                            <input type="number" placeholder="" class="form-control" id="quantity" name="quantity" required/>
                                                                            <div class="mbl"></div>
                                                                        </div>

                                                                    </div>

                                                                </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" id="iid" name="iid">
                                                            <input type="hidden" name="edit" value="edit">
                                                            <input type="submit" class="btn btn-success" name="update" value="Update">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->


                                            <div class="modal fade" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabelDel"></h4>
                                                        </div>
                                                        <div class="modal-body">


                                                                Do you realy want to delete this item?


                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="view-inventory.php" method="post">
                                                                <input type="hidden" id="iiddel" name="iiddel">
                                                                <input type="hidden" name="delete" value="delete">
                                                            <input type="submit" class="btn btn-danger" value="Delete">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->

                                                </div>
                                               

                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                       
                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->
                        </div>
                        </form>

                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>

<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 1, "asc" ]]
            });
        });
    </script>


    <script>
        function pushData(elem) {
            var id = elem.getAttribute('data-id');
            var type = elem.getAttribute('data-type');
            if (type == 'edit'){
                var item_no = elem.getAttribute('data-item-no');
                var desc = elem.getAttribute('data-desc');
                var cost = elem.getAttribute('data-cost');
                var retail = elem.getAttribute('data-retail');
                var qty = elem.getAttribute('data-qty');

                document.getElementById('iid').value = id;
                document.getElementById('myModalLabel').innerHTML = desc;
                document.getElementById('item_no').value = item_no;
                document.getElementById('description').value = desc;
                document.getElementById('cost').value = cost;
                document.getElementById('retail').value = retail;
                document.getElementById('quantity').value = qty;

            }
            else {
                var desc = elem.getAttribute('data-desc');
                document.getElementById('myModalLabelDel').innerHTML = desc;
                document.getElementById('iiddel').value = id;
            }
                }
    </script>
	
	


<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
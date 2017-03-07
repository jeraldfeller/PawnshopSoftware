<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
header("Access-Control-Allow-Origin: *");
$title = 'Add Inventory';

$employeeClass = new Employee();
if(isset($_POST['submit'])){
	$employeeClass->addInventory();
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
                                    <li>Add Inventory</li>
                                </ul>
                                <h4>Add Inventory</h4>
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
                                            <h4 class="panel-title">Add Item Information</h4>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Item #</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" placeholder="" class="form-control" id="item_no" name="item_no" required/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <h5 class="box-heading">UPC</h5>
                                                    <div class="input-group col-lg-12">
                                                    <div class="ckbox ckbox-success">
                                                        <input type="checkbox" id="upc" name="upc" onchange="getUPC()" />
                                                        <label for="upc"> </label>
                                                    </div>
                                                    </div>
                                                </div>
												<div class="col-lg-7">
                                                    <h5 class="box-heading">Description</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" placeholder="" class="form-control" id="description" name="description" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Cost</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
													<input type="text" placeholder="" class="form-control" id="cost" name="cost" onchange="formatCurrency(this)" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Retail</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
													<input type="text" placeholder="" class="form-control" id="retail" name="retail" onchange="formatCurrency(this)" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Quantity</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="number" placeholder="" class="form-control" id="vin" name="quantity" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Image</h5>
                                                    <div class="input-group col-lg-12">
														 <input type="file" name="item_photo" id="item_photo">
                                                    </div>
                                                </div>
												
												

                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                            
											<?php 
												$date = date("Y-m-d");
											?>
												
													<input type="hidden" value="<?php echo $date; ?>" name="date_added">
													
													
															
																<input type="submit" name="submit" class="btn btn-primary" value="Add to Database">
															
																					
								
                                        </div><!-- panel-footer -->
                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->
                        </div>
                        </form>

                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="js/jquery.gritter.min.js"></script>
<script src="js/notify.js"></script>
<script>
	
	function getUPC() {
            var item_no = document.getElementById('item_no').value;
            var checkbox = document.getElementById('upc');
			var description = document.getElementById('description');
			var cost = document.getElementById('cost');
			var retail = document.getElementById('retail');
			var upc = document.getElementById('item_no').value;
            if(checkbox.checked){




                // Using jQuery
                $.ajax({
                    type: "POST",
                    url: "getUpc.php?upc="+ upc
                }).done(function (data) {
					var data = JSON.parse(data);
					
					
					try {
						description.value = data[0].productname;
						cost.value = data[0].price;
						retail.value = data[0].saleprice;
					}
					catch(e){
						description.value = '';
						cost.value = '';
						retail.value = '';
					}
                    
                });
            /*
                // Using XMLHttpRequest
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "http://www.searchupc.com/handlers/upcsearch.ashx?request_type=3&access_token=C7C6738E-C172-4390-82DF-10375CF07DBC&upc=0049000024685", true);
                xhr.withCredentials = true;
                xhr.onload = function () {
                    console.log(xhr.responseText);
                };
                xhr.send();
                */
            }
            else{
                description.value = '';
						cost.value = '';
						retail.value = '';
            }

        }
		
	
	</script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
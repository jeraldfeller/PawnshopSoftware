<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Vehicle Inventory';

$adminClass = new Admin();
$employeeClass = new Employee();
$customer = $employeeClass->getCustomer();
$vehicle= $employeeClass->getVehicleInventory();


$taxs = $adminClass->getSalesTax();
foreach ($taxs as $tax){
    $tax = $tax['general_tax'];
}

$view = new View();

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left" style="padding-left: 15px;">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Vehicle Inventory</li>
                                </ul>
                                <h4>Vehicle Inventory</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
							<form name="listForm" action="add-vehicle-sale-function.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Select Customer</h4>

                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control" name="customer_id" id="customer_name" placeholder="Enter customer name" onfocusout="getCustomerIdPoint()">
                                                        <br>


                                                            <div class="panel panel-default">
                                                                <div class="panel-body">
                                                                    <div class="row" id="display_info">

                                                                    </div>
                                                                </div>
                                                            </div><!-- panel -->
                                                </div>
                                            </div><!-- row -->
                                        </div><!-- panel-body -->


                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->



                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                      
                                       <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-primary mb30 align-center">
                                                            <thead>
                                                                <tr class="bg-primary">
                                                                    <th style="color: #fff;">VIN #</th>
																	<th style="color: #fff;">YEAR</th>

																	<th style="color: #fff;">MODEL</th>

																	<th style="color: #fff;">COLOR</th>
																	<th style="color: #fff;">MILEAGE</th>

																	<th># OF DOORS</th>
																	<th style="color: #fff;">CONDITION</th>
																	<th style="color: #fff;">TITLE #</th>
																	<th style="color: #fff;">TAG #</th>
																	<th style="color: #fff;">PRICE</th>
																	<th style="color: #fff;">ACTION</th>
																	<th style="display: none;">&nbsp;</th>
																	<th style="display: none;">&nbsp;</th>
																	<th style="display: none;">&nbsp;</th>
																	<th style="display: none;">&nbsp;</th>
																	<th style="display: none;">&nbsp;</th>
																	<th style="display: none;">&nbsp;</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody id="displayItems">
															<?php echo $view->displayVehicleInventory($vehicle); ?>
															</tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->

                            
                           
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                    
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">

                                                    <h5 class="box-heading">Sub Total</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="hidden" id="count" name="count">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control" value="0" id="total_amount" name="sub_total" readonly/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Sales Tax</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">%</span>
													<input type="text" class="form-control" value="<?php echo $tax; ?>" id="tax" onchange="calcGrandTotal();" name="tax" readonly/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Grand Total</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
													<input type="text" class="form-control" id="grand_total" name="total" readonly/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Take Payment </h5>
                                                    <div class="input-group col-lg-12">
                                                    <select class="form-control" name="payment">
														<option> -- select payment method -- </option>
														<option value="cash"> Cash </option>
														<option value="card"> Credit Card </option>
														<option value="check"> Check </option>
													</select>
                                                    </div>
                                                </div>





                                               
                                            </div>
                                            </div><!-- panel-body -->
                                            <div class="panel-footer">
                                                <?php

												$date = new DateTime();
												$date = $date->format('Y-m-d H:i:s');


												?>

												<input type="hidden" value="<?php echo $date; ?>" name="date_added">
												<input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">

												<div class="form-group col-lg-3">
													<input type="submit" name="submit" class="btn btn-success" value="Complete & Print Sale Receipt">

												</div>
                                            </div><!-- panel-footer -->


                                    </div><!-- panel -->

                                    </form>

                            </div><!-- col-md-6 -->



                            </div>

                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<script>




        $(document).ready(function(){


            $('table#dataTables-example tbody#displayItems').on('change', 'td', function() {

                var $id = $(this).closest('tr').find('td:first').text();
                var $cost = $('#cost_' + $id).text();
                var $quantity = $('#quantity_'+ $id +' input').val();

                var $checkbox = $('#checkbox_'+ $id +' input');
                var $checkbox_price = $('#checkbox_price_'+ $id).text();
                var $count = $('#count_'+ $id).text();
                var $target = parseFloat($('#total_amount').val());
                var $cid = $('#selectCustomer').val();
                var $c_id = $('#cid_' + $id +' input');


                if ($quantity == 0 || $quantity == null)
                {
                    $quantity = 1;
                }


                if($checkbox.prop('checked'))
                {
                    if($cid == ' ' || $cid == null || $cid == 'undefined') {$cid = 0;}
                    $c_id.val($cid);
                    $checkbox_price = $('#checkbox_price_'+ $id).addClass('sum');
                    $count = $('#count_'+ $id).addClass('count');
                    $sum = $cost * $quantity;
                    $checkbox_price = $('#checkbox_price_'+ $id).text($sum);
                    sumLoan();
                    calcGrandTotal();
                }
                else {
                    $c_id.val(0);
                    $checkbox_price = $('#checkbox_price_'+ $id).removeClass('sum');
                    $checkbox_price = $('#checkbox_price_'+ $id).text($cost);
                    $count = $('#count_'+ $id).removeClass('count');
                    sumLoan();
                    calcGrandTotal();

                }


            });


        });
    </script>


    <script>

        function sumLoan(){

            var tds = document.getElementById('dataTables-example').getElementsByTagName('td');
            var sum = 0;
            var count = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'sum') {


                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }

            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count') {


                    count += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }

            document.getElementById('count').value = count;
            document.getElementById('total_amount').value = sum;
            var $val = document.getElementById('total_amount');
            var $format = formatCurrency($val);
        }




        function calcGrandTotal(){

            var tax = document.getElementById('tax').value;

            var sub_total =  document.getElementById('total_amount').value;


            sub_total = parseFloat(sub_total.replace(/[^\d\.]/, ''));

            sum = tax * sub_total / 100;
            total = +sum + +sub_total;
            total.toFixed(2);

            document.getElementById('grand_total').value = total;
            var $val = document.getElementById('grand_total');
            formatCurrency($val);

        }



        
    </script>

    <script>

        (function( $ ) {
var proto = $.ui.autocomplete.prototype,
    initSource = proto._initSource;

function filter( array, term ) {
    var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
    return $.grep( array, function(value) {
        return matcher.test( $( "<div>" ).html( value.label || value.value || value ).text() );
    });
}

$.extend( proto, {
    _initSource: function() {
        if ( this.options.html && $.isArray(this.options.source) ) {
            this.source = function( request, response ) {
                response( filter( this.options.source, request.term ) );
            };
        } else {
            initSource.call( this );
        }
    },

    _renderItem: function( ul, item) {
        return $( "<li style='background: #fff;' class='autoList'></li>" )
            .data( "item.autocomplete", item )
            .append( $( "<a></a>" )[ this.options.html ? "html" : "text" ]( item.label ) )
            .appendTo( ul );
    }
});
})( jQuery );

$(function() {
        var availableTags = [
           <?php
echo $view->displayCustomerForAutoComplete($customer);
?>
        ];
        $( "#customer_name" ).autocomplete({
            source: availableTags,
            html: 'html'
        });
    });
    </script>

    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
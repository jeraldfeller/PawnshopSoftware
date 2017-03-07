<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Scrap Buying';

$employeeClass = new Employee();
$customer = $employeeClass->getCustomer();


$view = new View();


if(isset($_POST['submit'])){
	
	$id = $_POST['customer_id'];
	$employeeClass->addScrap($id);
	
}


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
                                    <li>Scrap Buying</li>
                                </ul>
                                <h4>Scrap Buying</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                        <form id="dataScrap">
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
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Add Items</h4>

                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h5 class="box-heading">Description</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" placeholder="" class="form-control" id="item_description" name="item_description" required/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Wight(in grams)</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="number" placeholder="" class="form-control" id="weight" name="weight" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Amount Paid To Seller</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
													<input type="text" placeholder="" class="form-control" id="retail" name="retail" onchange="formatCurrency(this)" required>
                                                    </div>
                                                </div>
                                                
                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                                <input onClick="setTimeout(function(){ getScrapItem();}, 1000);" type="submit" name="submit" class="btn btn-success" value="Add Items">
												<input type="reset" class="btn btn-warning" value="RESET FIELDS">
                                        </div><!-- panel-footer -->
                                         </form>

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-primary mb30 align-center" id="theTable">
                                                            <thead>
                                                                <tr>
																	<th>Description</th>
																	<th>Weight(in grams)</th>
																	<th>Amount Paid To Seller</th>
																	<th>Action</th>
																</tr>
																</thead>
																<tbody id="displayItems">

																</tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"/>
                            <input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Purchase Information</h4>

                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <h5 class="box-heading">Amount Paid to Seller</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
													<input type="text" class="form-control" id="purchase_amount" readonly>
													<input type="text" class="form-control hidden" name="purchase_amount" id="purchase_amount_hidden">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Retail Value</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
													<input type="text" class="form-control" id="amount_paid" name="amount_paid"  onChange="formatCurrency(this)">
                                                    </div>
                                                </div>



                                               
                                            </div>
                                            </div><!-- panel-body -->
                                            <div class="panel-footer">
                                                <?php

												$date = new DateTime();
												$date = $date->format('Y-m-d H:i:s');


												?>

												<input type="hidden" value="<?php echo $date; ?>" name="date">

												<div class="form-group col-lg-3">
													<input type="submit" name="submit" class="btn btn-primary" value="Complete & Print Sale Reciept">

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
<script type="text/javascript">

        function getCustomerId(){


            var cid = document.getElementById("selectCustomer").value;
            document.getElementById("customer_id_ref").value = cid;

        }

        function sumLoan(){

            var tds = document.getElementById('theTable').getElementsByTagName('td');
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'amount') {


                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }

            document.getElementById('purchase_amount').value = sum;
            document.getElementById('purchase_amount_hidden').value = sum;

        }



    </script>

    <script type="text/javascript">

        $(document).ready(function(){

            $('#loan_matrix').change(function(){

                $percent = $(this).find(':selected').data('percentage');

                if ($percent != undefined){

                    $apr = $percent * 12;
                    $('#interest_rate').val($percent);
                    $('#annual_percentage_rate').val($apr);
                }
                else {
                    $('#interest_rate').val(null);
                    $('#annual_percentage_rate').val(null);
                }

            });



            $('table#theTable tbody#displayItems').on('keyup', 'td', function() {

                var $id = $(this).closest('tr').find('td:first').text();
                var $price = $('#price_' + $id).text();
                var $quantity = $('#quantity_'+ $id +' input').val();

                if ($quantity == 0 || $quantity == null)
                {
                    $quantity = 1;
                }
                var $sum = $price * $quantity;


                $('#amount_' + $id).text($sum);
                sumLoan();

            });


            $('table#theTable tbody#displayItems').on('click', 'button', function() {


                var $id = $(this).closest('tr').find('td:first').text();
                var $item_id = $('#item_id_' + $id).val();
                var $image_name = '';
                var $page = 'scrap-buying';
                removeItems($item_id, $image_name, $page);
                setTimeout(function(){
                    sumLoan();
                }, 500)

            });

            setInterval(function(){
                var $val = document.getElementById('purchase_amount');
                var $format = formatCurrency($val);

            }, 500)



        });


        function getAdvanceDate(){
            var future = new Date();

            var due = future.setDate(future.getDate() + 30);

            document.getElementById('due_date').value = due;
        }






        function formatCurrency(elem) {

            var num = elem.value;

            // Remove any characters other than numbers and periods from the string, then parse the number
            var nNumberToFormat = parseFloat( String(num).replace(/[^0-9\.]/g, '') );
            // Escape when this number is invalid (parseFloat returns NaN on failure, we can detect this with isNaN)
            if( isNaN(nNumberToFormat) ) { nNumberToFormat = 0; }

            // Split number string by decimal separator (.)
            var aNumberParts = nNumberToFormat.toFixed(2).split('.');

            // Get first part = integer part
            var sFirstPart = aNumberParts[0];
            // Determine the position after which to start grouping
            var nGroupingStart = sFirstPart.length % 3;
            // Shift three to the right when first group is empty
            nGroupingStart += (nGroupingStart == 0) ? 3 : 0;
            // Start first result with ungrouped first part
            var sFirstResult = sFirstPart.substr(0, nGroupingStart);
            // Add grouped parts by looping through the remaining numbers
            for(var i=nGroupingStart, len=sFirstPart.length; i < len; i += 3) {
                sFirstResult += ',' + sFirstPart.substr(i, 3);
            }

            // Get second part = fractional part
            var sSecondResult = aNumberParts[1] ? '.' + aNumberParts[1] : '';

            // Combine the parts and return the result
            s = sFirstResult + sSecondResult;

            elem.value = s;


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

<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
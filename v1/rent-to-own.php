<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Rent to Own';


$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomer();
$term = $adminClass->getPaymentTerm();
$taxs = $adminClass->getSalesTax();


$view = new View();

$date = date('Y-m-d H:i:s');

foreach($taxs as $row){
    $tax = $row['general_tax'];
}


if(isset($_POST['submit'])){
    $employeeClass->addRTO();
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left" style="padding-top: 5px;">
                                <i class="icon icon-screen-smartphone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Rent to Own</li>
                                </ul>
                                <h4>Rent to Own</h4>
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


                                    </div><!-- col-md-6 -->



							</div>
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h5 class="box-heading">Payment Term</h5>
                                                    <div class="input-group col-lg-12">
                                                        <select  class="form-control" name="term" id="term" required>
															<option>-- select term --</option>
															<?php
															foreach($term as $row){
																echo '<option value="' . $row['term'] . '">' . $row['term'] . '</option>';
															}
															?>
														</select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Downpayment</h5>
                                                    <div class="input-group col-lg-12">
                                                        
													<span class="input-group-addon">$</span>
													<input type="text" class="form-control" id="downpayment" name="downpayment" onchange="formatCurrency(this)" required>
                                                    </div>
                                                </div>
												
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Total # of Payments</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="number" class="form-control" name="number_of_payments" id="number_of_payments" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Amount of Each Payment</h5>
                                                    <div class="input-group col-lg-12">
                                                       <span class="input-group-addon">$</span>
														<input type="text" class="form-control" id="amount_each_payment" name="amount_each_payment" onchange="formatCurrency(this)" required>
                                                    </div>
                                                </div>
												
												<div class="col-lg-3">
                                                    <h5 class="box-heading">Other Charges Field</h5>
                                                    <div class="input-group col-lg-12">
                                                        <span class="input-group-addon">$</span>
														<input type="text" class="form-control" id="other_charges" name="other_charges" onchange="formatCurrency(this)" required>
                                                    </div>
                                                </div>
												
												<div class="col-lg-3">
                                                    <h5 class="box-heading">Amount paid to others on your behalf</h5>
                                                    <div class="input-group col-lg-12">
                                                        <span class="input-group-addon">$</span>
														<input type="text" value="0" class="form-control" id="amount_behalf" name="amount_behalf" onchange="formatCurrency(this)" required>
                                                    </div>
                                                </div>

												
												<div class="col-lg-3">
                                                    <h5 class="box-heading">Sales Tax</h5>
                                                    <div class="input-group col-lg-12">
                                                        <span class="input-group-addon">%</span>
														<input type="text" class="form-control" id="tax" name="tax" value="<?php echo $tax; ?>" readonly>

                                                    </div>
                                                </div>
												
												<div class="col-lg-3">
                                                    <h5 class="box-heading">Cash Price of Merchandise</h5>
                                                    <div class="input-group col-lg-12">
                                                        <span class="input-group-addon">$</span>
														<input type="text" class="form-control" id="merchandise" name="merchandise" required>

                                                    </div>
                                                </div>
												
												<div class="col-lg-6">
                                                    <h5 class="box-heading">Model</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" id="model_no" name="model_no" required>

                                                    </div>
                                                </div>
												
												<div class="col-lg-6">
                                                    <h5 class="box-heading">Description</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" id="description" name="description" required>

                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Serial #</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" id="serial_no" name="serial_no" required>

                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Condition</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" id="condition" name="condition" required>

                                                    </div>
                                                </div>
												
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Due Date</h5>
                                                    <div class="input-group col-lg-12">
													
											
													
													<input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker_from" name="due_date" required>
													<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                   
                                                      

                                                    </div>
                                                </div>
												
												
                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
										<input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">
                                                <input type="hidden" value="<?php echo $date; ?>" name="date">



                                                        <input type="submit" name="submit" class="btn btn-primary" value="Complete & Print RTO Ticket">


                                                </div>
                                        </div><!-- panel-footer -->
                                         </form>


                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->


                            </div>

                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<script>
    $(document).ready(function() {

        $('#plan_name').change(function () {

            var cost = $(this).find(':selected').data('cost');
            document.getElementById('cost').value = cost;
            document.getElementById('hidden_cost').value = cost;

            var cost_field = document.getElementById('cost');
            var qty = document.getElementById('quantity');
            formatCurrency(cost_field);
            sumTotal(qty);


        });

    });

</script>


    <script type="text/javascript">

        function getDetails(){

            setTimeout(function(){getCustomerIdPoint();},500);

        }

        function sumTotal(elem){
            var qty = elem.value;
            var cost = document.getElementById('hidden_cost').value;
            var input = document.getElementById('cost')

            document.getElementById('cost').value = cost * qty;

            formatCurrency(input);
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

            var availableTagsNumber = [
                <?php
echo $view->displayCustomerNumberForAutoComplete($customer);
?>
            ];
            $( "#customer_name" ).autocomplete({
                source: availableTags,
                html: 'html'
            });

            $( "#customer_cp_number" ).autocomplete({
                source: availableTagsNumber,
                html: 'html'
            });
        });
    </script>
	
	
	<script>
$(document).ready(function() {
     
                $('#datepicker_from').datepicker();
              

    });
        </script>

<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
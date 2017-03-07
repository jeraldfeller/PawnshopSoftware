<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Add Title Pawn';

$employeeClass = new Employee();
$customer = $employeeClass->getCustomer();
$matrix = $employeeClass->getLoanMatrix();

$view = new View();
$date = date("Y-m-d");

if(isset($_POST['submit'])){
	$employeeClass->addTitlePawn();  
}

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
                                    <li>Add Title Pawn</li>
                                </ul>
                                <h4>Add Title Pawn</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                        <form action="add-title-pawn.php" method="post" enctype="multipart/form-data">
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
                                            <h4 class="panel-title">Add Vehicle Information</h4>

                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-3">
									
                                                    <h5 class="box-heading">Vin #</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" placeholder="" class="form-control" id="vin" name="vin_no" required/>
														<input type="hidden" id="style_id">
														<input type="hidden" id="style" name="style">
														<input type="hidden" id="make" name="make">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="box-heading">Mileage</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="number" placeholder="" class="form-control" id="mileage" name="mileage" required/>
                                                    </div>
                                                </div>
												
                                                <div class="col-lg-2">
                                                    <h5 class="box-heading">&nbsp;</h5>
                                                    <div class="input-group col-lg-12">
													
													<div class="ckbox ckbox-success">
                                                        <input type="checkbox" value="0" id="exempt" name="exempt" />
                                                        <label for="exempt">Exempt</label>
                                                    </div>
                                                    
												
                                                    </div>
                                                </div>
                                                
												
												
                                                 <div class="col-lg-4">
                                                    <h5 class="box-heading">Year</h5>
                                                    <div class="input-group col-lg-12">
                                                    <i class="loading fa fa-spinner fa-spin"></i>
													<input type="text" placeholder="" class="form-control to-hide" id="year" name="year" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Condition</h5>
                                                    <div class="input-group col-lg-12">
                                                    
													<select class="form-control" id="condition" name="vehicle_condition" required/>
													<option>-- choose vehicle conditon --</option>
													<option value="Outstanding">Outstanding</option>
													<option value="Clean">Clean</option>
													<option value="Average">Average</option>
													<option value="Rough">Rough</option>
													<option value="Damaged">Damaged</option>
													</select>
													
                                                    </div>
                                                </div>
												
												
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Model</h5>
                                                    <div class="input-group col-lg-12">
                                                    <i class="loading fa fa-spinner fa-spin"></i>
													<input type="text" placeholder="" class="form-control to-hide" id="model" name="model" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Color</h5>
                                                    <div class="input-group col-lg-12">
                                                    <i class="loading fa fa-spinner fa-spin"></i>
													<input type="text" placeholder="" class="form-control to-hide" id="color" name="color" required/>
                                                    </div>
                                                </div>
												
												
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading"># of Doors</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="number" placeholder="" class="form-control" id="door" name="no_of_doors" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Title #</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" placeholder="" class="form-control" id="title" name="title_no" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-4">
                                                    <h5 class="box-heading">Tag #</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" placeholder="" class="form-control" id="tag" name="tag_no" required/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-3">
                                                    <h5 class="box-heading">Images</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="file" name="title_pawn_image[]" multiple>
                                                    </div>
                                                </div>
												
												
												
												
												
                                            </div><!-- row -->
											<br>
											<div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="row" id="results_body">

														</div>
                                                    </div>
                                                </div><!-- panel -->
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
                                            <h4 class="panel-title">Loan Information</h4>

                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-3">

                                                    <h5 class="box-heading">Loan Amount</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
													<input type="text" class="form-control" id="total_loan_amount" name="total_loan_amount" onchange="formatCurrency(this)">
                                                    </div>
                                                </div>
												
												<div class="col-lg-3">

                                                    <h5 class="box-heading">Retail Amount</h5>
                                                    <div class="input-group col-lg-12">
                                                     <span class="input-group-addon">$</span>
													 <input type="text" class="form-control" id="retail" name="retail" onchange="formatCurrency(this)">
													 
                                                    </div>
                                                </div>
												
												<div class="col-lg-3">

                                                    <h5 class="box-heading">Amount paid to others on your behalf</h5>
                                                    <div class="input-group col-lg-12">
                                                     <span class="input-group-addon">$</span>
													 <input type="text" value="0.00" class="form-control" id="aBehalf" name="aBehalf" onchange="formatCurrency(this)">
													 
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <h5 class="box-heading">Loan Matrix</h5>
                                                    <div class="input-group col-lg-12">
                                                    <select class="form-control" id="loan_matrix" name="loan_matrix_id">
                                                    <option>-- choose loan matrix --</option>
                                                    <?php echo $view->displayMatrix($matrix); ?>
													</select>
                                                    </div>
                                                </div>



                                                 <div class="col-md-12">
                                                 <br><br>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <div class="panel-btns">
                                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                                            </div><!-- panel-btns -->
                                                            <h4 class="panel-title">Display Figures For Pawn Below</h4>

                                                        </div>


                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-lg-4">

                                                                    <h5 class="box-heading">Total Being Loaned</h5>
                                                                    <div class="input-group col-lg-12">
                                                                    <span class="input-group-addon">$</span>
                                                                    <input type="text" class="form-control" id="total_loaned" name="total_loan" onchange="formatCurrency(this)" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <h5 class="box-heading">Interest Rate</h5>
                                                                    <div class="input-group col-lg-12">
                                                                    <input type="number" class="form-control" name="interest_rate" id="interest_rate" readonly>
																	<input type="hidden" class="form-control" id="interest_accured" name="interest_accured" readonly>
                                                                    <span class="input-group-addon">%</span>
                                                                    </div>
                                                                </div>

                                                                 <div class="col-lg-2">
                                                                    <h5 class="box-heading">APR</h5>
                                                                    <div class="input-group col-lg-12">
                                                                    <input type="number" class="form-control" name="apr" id="annual_percentage_rate" readonly>
                                                                    <span class="input-group-addon">%</span>
                                                                    </div>
                                                                </div>

                                                                 <div class="col-lg-6">
                                                                    <h5 class="box-heading">Terms of Loan</h5>
                                                                    <div class="input-group col-lg-12">
                                                                     <input type="text" class="form-control" name="terms_of_loan" id="terms_of_loan" readonly>
                                                                    </div>
                                                                 </div>

                                                                 <div class="col-lg-3">
                                                                    <h5 class="box-heading">Due Date</h5>
                                                                    <div class="input-group col-lg-12">
                                                                    <input type="text" value="<?php echo date('Y-m-d', strtotime("+30 days")); ?>" class="form-control" name="due_date" id="due_date" readonly>
                                                                    </div>
                                                                 </div>



                                                            </div><!-- row -->
                                                        </div><!-- panel-body -->


                                                    </div><!-- panel -->
                                                    </div>

                                            </div>
                                            </div><!-- panel-body -->
                                            <div class="panel-footer">
                                                <input type="hidden" value="<?php echo $date; ?>" name="date_added">
												 <input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">
                                                <div class="form-group col-lg-3">
                                                    <input type="submit" name="submit" class="btn btn-primary" value="Complete & Print Pawn Ticket">
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


    </script>


    <script type="text/javascript">

        $(document).ready(function(){
				
            $('#loan_matrix').change(function(){
                $percent = $(this).find(':selected').data('percentage');
                $terms = $(this).find(':selected').data('terms');
				
                $total_loan = $('#total_loan_amount').val();
				$aBehalf = $('#aBehalf').val();


                $total_loan_double = (parseFloat($total_loan.replace(/,/g, '')) + parseFloat($aBehalf.replace(/,/g, '')));
				
                if ($percent != undefined){
					
                    $apr = $percent * 12;
                    $('#interest_rate').val($percent);
                    $('#annual_percentage_rate').val($apr);
                    $('#terms_of_loan').val($terms);
                    $interest_accured = $percent * $total_loan_double / 100;
                    $('#interest_accured').val($interest_accured);
                    $('#total_loaned').val($total_loan_double);
                }
                else {
                    $('#interest_rate').val(null);
                    $('#annual_percentage_rate').val(null);
                    $('#terms_of_loan').val(null);
                    $('#interest_accured').val(null);
                    $('#total_loaned').val(null);
                }
            });


        });


        function getAdvanceDate(){
            var future = new Date();

            var due = future.setDate(future.getDate() + 30);

            document.getElementById('due_date').value = due;
        }


        function sumLoan(){

            var tds = document.getElementById('theTable').getElementsByTagName('td');
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'amount') {


                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }

            document.getElementById('total_loan_amount').value = sum;
            document.getElementById('total_loaned_hidden').value = sum;
            document.getElementById('total_loan_amount_hidden').value = sum;

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


        $(document).ready(function(){

            window.sdkAsyncInit = function () {
                $('#vin').change(function(){
					
                    var myElements = document.querySelectorAll(".loading");
                    var textBox = document.querySelectorAll(".to-hide");
                    var warning = document.querySelectorAll(".warning-msg");

                    for (var i = 0; i < myElements.length; i++) {
                        myElements[i].style.display = 'inline-block';
                    }

                    for (var i = 0; i < textBox.length; i++) {
                        textBox[i].style.opacity = 0;
                    }

                    for (var i = 0; i < warning.length; i++) {
                        warning[i].style.display = 'inline-block';
                    }

                    var vin = $('#vin').val();

                    // Instantiate the SDK
                    var res = new EDMUNDSAPI('bshwx7ehqe3f3dvuvnvgmhpy');
                    // Optional parameters
                    var options = {};
                    // Callback function to be called when the API response is returned
                    function success(res) {


                        var year = document.getElementById('year');
                        var model = document.getElementById('model');
                        var color = document.getElementById('color');
                        var id = document.getElementById('style_id');
                        var make = document.getElementById('make');
                        var style = document.getElementById('style');

                        try {

                            var year_value = res.years[0].year;
                            var model_value = res.model.id;
                            var color_value = res.colors[0].options[0].name;
                            var id_value = res.years[0].styles[0].id;
                            var style_value = res.years[0].styles[0].name;
                            var make_value = res.make.name;

                            for (var i = 0; i < myElements.length; i++) {
                                myElements[i].style.display = 'none';

                            }
                            for (var i = 0; i < textBox.length; i++) {
                                textBox[i].style.opacity = 1;
                            }

                            for (var i = 0; i < warning.length; i++) {
                                warning[i].style.display = 'none';
                            }


                        }
                        catch (e) {
                            var year_value = 'No data found';
                            var model_value = 'No data found';
                            var color_value = 'No data found';
                            var id_value = 'No data found';
                            var style_value = 'No data found';
                            var make_value = 'No data found';

                            for (var i = 0; i < myElements.length; i++) {
                                myElements[i].style.display = 'none';

                            }
                            for (var i = 0; i < textBox.length; i++) {
                                textBox[i].style.opacity = 1;
                            }

                            for (var i = 0; i < warning.length; i++) {
                                warning[i].style.display = 'none';
                            }
                        }

                        year.value = year_value;
                        model.value = model_value;
                        color.value = color_value;
                        id.value = id_value;
                        style.value = style_value;
                        make.value = make_value;


                    }

                    // Oops, Houston we have a problem!
                    function fail(data) {
                        console.log(data);

                    }

                    // Fire the API call
                    res.api('/api/vehicle/v2/vins/' + vin + '', options, success, fail);
                    // Additional initialization code such as adding Event Listeners goes here

                });







                $('#condition').change(function(){


                    var exempt = $('#exempt');

                    if(exempt.is(':checked')){
                        exempt.val('1');
                        var  mileage = 0;
                        $('#mileage').attr('placeholder', 'MV-1');
                        $('#mileage').removeAttr('required');
                    }
                    else{
                        var mileage = $('#mileage').val();
                        exempt.val('0');
                    }


                    var condition = $('#condition').val();

                    var id = $('#style_id').val();
                    // Instantiate the SDK
                    var res_tmv = new EDMUNDSAPI('bshwx7ehqe3f3dvuvnvgmhpy');
                    // Optional parameters
                    var options = {
                        "styleid": id,
                        "condition": condition,
                        "mileage": mileage,
                        "zip": 90019
                    };
                    // Callback function to be called when the API response is returned
                    function success(res_tmv) {

                        var base_price = res_tmv.tmv.nationalBasePrice.usedPrivateParty;
                        var mileage = res_tmv.tmv.mileageAdjustment.usedPrivateParty;
                        var condition = res_tmv.tmv.conditionAdjustment.usedPrivateParty;
                        var total_with_option = res_tmv.tmv.totalWithOptions.usedPrivateParty;
                        var quote = (base_price + mileage) - condition;
                        var body = document.getElementById('results_body');
                        body.innerHTML = '<div class="col-lg-12"><div class="form-group"><h3 class="box-heading">The used TMV® price is: $' + total_with_option + '</h3><img src="../images/edmunds.png">';

                    }

                    // Oops, Houston we have a problem!
                    function fail(data) {
                        console.log(data);
                    }

                    // Fire the API call
                    res_tmv.api('/v1/api/tmv/tmvservice/calculateusedtmv', options, success, fail);
                    // Additional initialization code such as adding Event Listeners goes here

                });




            };

        });




        // Load the SDK asynchronously
        (function (d, s, id) {
            var js, sdkjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "<?php echo ROOT . '/' . VERSION . '/'; ?>js/edmunds.api.sdk.js";
            sdkjs.parentNode.insertBefore(js, sdkjs);
        }(document, 'script', 'edmunds-jssdk'));


    </script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
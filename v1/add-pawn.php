<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Add Pawn';

$employeeClass = new Employee();
$customer = $employeeClass->getCustomer();
$matrix = $employeeClass->getLoanMatrix();

$view = new View();
$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');


if(isset($_POST['submit'])){
    $id = $_POST['customer_id'];


    $employeeClass = new Employee();

    $last_id = $employeeClass->addPawn($id);
    $employeeClass->transferPawnItems($id, $last_id);
    $employeeClass->removeTmpPawnItems($id, $last_id);

    $query = array('customer_id' => $id,
        'loan_id' => $last_id);
    header('Location: print-pawn-ticket.php?' . http_build_query($query));
    exit;

}


require SERVER_ROOT . '/' . VERSION . '/includes/header.php';

?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left" style="padding-left: 15px;">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Add Pawns</li>
                                </ul>
                                <h4>Add Pawns</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">
	
				
                        <!-- CONTENT GOES HERE -->
                        <form id="data">
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
                                                    <h5 class="box-heading">Item Description</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" placeholder="" class="form-control" id="item_description" name="item_description" required/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="box-heading">Serial Number</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" placeholder="" class="form-control" id="serial_number" name="serial_number" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Loan Amount</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="loan_amount" name="loan_amount" onchange="formatCurrency(this);" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Retail</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="retail" name="retail" onchange="formatCurrency(this);" required>
                                                    </div>
                                                </div>
                                                 <div class="col-lg-12">
                                                    <h5 class="box-heading">Upload Picture</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="hidden" name="date_added" value="<?php echo $date; ?>">
													<input type="file" name="fileToUpload" id="fileToUpload">
                                                    </div>
                                                </div>
                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                                <input onClick="setTimeout(function(){ getItemPawn();}, 1000);" type="submit" name="submit" id="addPawnItem" class="btn btn-primary" value="Add Items">
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
                                                                    <th>Item Description</th>
                                                                    <th>Serial #</th>
                                                                    <th>Loan Amount</th>
                                                                    <th>Retail</th>
                                                                    <th>Pawn Image</th>
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
                                            <h4 class="panel-title">Loan Information</h4>

                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4">

                                                    <h5 class="box-heading">Loan Amount</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="total_loan_amount" readonly>
                                                    <input type="text" class="form-control hidden" name="data[total_loan_amount]" id="total_loan_amount_hidden">
                                                    </div>
                                                </div>

                                                <div class="col-lg-8">
                                                    <h5 class="box-heading">Loan Matrix</h5>
                                                    <div class="input-group col-lg-12">
                                                    <select class="form-control" id="loan_matrix" name="data[loan_matrix_id]">
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
                                                                    <input type="text" class="form-control" id="total_loaned_hidden" name="data[total_loaned]" readonly>
                                                                    <input type="hidden" class="form-control" id="interest_accured" name="data[interest_accured]" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <h5 class="box-heading">Interest Rate</h5>
                                                                    <div class="input-group col-lg-12">
                                                                    <input type="text" class="form-control" name="data[interest_rate]" id="interest_rate" readonly>
                                                                    <span class="input-group-addon">%</span>
                                                                    </div>
                                                                </div>

                                                                 <div class="col-lg-2">
                                                                    <h5 class="box-heading">APR</h5>
                                                                    <div class="input-group col-lg-12">
                                                                    <input type="text" class="form-control" name="data[annual_percentage_rate]" id="annual_percentage_rate" readonly>
                                                                    <span class="input-group-addon">%</span>
                                                                    </div>
                                                                </div>

                                                                 <div class="col-lg-6">
                                                                    <h5 class="box-heading">Terms of Loan</h5>
                                                                    <div class="input-group col-lg-12">
                                                                    <input type="text" class="form-control" name="data[terms_of_loan]" id="terms_of_loan" readonly>
                                                                    </div>
                                                                 </div>

                                                                 <div class="col-lg-3">
                                                                    <h5 class="box-heading">Due Date</h5>
                                                                    <div class="input-group col-lg-12">
                                                                    <input type="text" value="<?php echo date('Y-m-d', strtotime("+30 days")); ?>" class="form-control" name="data[due_date]" id="due_date" readonly>
                                                                    </div>
                                                                 </div>



                                                            </div><!-- row -->
                                                        </div><!-- panel-body -->


                                                    </div><!-- panel -->
                                                    </div>

                                            </div>
                                            </div><!-- panel-body -->
                                            <div class="panel-footer">
                                                <input type="hidden" value="<?php echo $date; ?>" name="data[date]">
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

	$(document).ready(function(){



        $('table#theTable tbody#displayItems').on('click', 'button', function() {

            var $id = $(this).closest('tr').find('td:first').text();
            var $item_id = $('#item_id_' + $id).val();
            var $image_name = $('#image_name_' + $id).text();
            var $page = 'add-pawn';
            removeItems($item_id, $image_name, $page);

            setTimeout(function(){
                sumLoan();
            }, 500)

        });

		$('#loan_matrix').change(function(){

			$percent = $(this).find(':selected').data('percentage');
            $terms = $(this).find(':selected').data('terms');
            $total_loan = $('#total_loan_amount_hidden').val();


			if ($percent != undefined){

				$apr = $percent * 12;

				$('#interest_rate').val($percent);
				$('#annual_percentage_rate').val($apr);
                $('#terms_of_loan').val($terms);

                $interest_accured = $percent * $total_loan / 100;

                $total_loan_interest = parseFloat($total_loan) + parseFloat($interest_accured);

                $('#interest_accured').val($interest_accured);
                $('#total_loaned_hidden').val($total_loan_interest);
			}
			else {
				$('#interest_rate').val(null);
				$('#annual_percentage_rate').val(null);
                $('#terms_of_loan').val(null);
                $('#interest_accured').val(null);
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
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
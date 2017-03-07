<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Take Payment';

$employeeClass = new Employee();
$customer = $employeeClass->getCustomer();
$matrix = $employeeClass->getLoanMatrix();

$view = new View();


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
                                    <li>Take Payment</li>
                                </ul>
                                <h4>Take Payment</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->

                        <div class="row">
                        <form name="listForm" action="add-payment-functions" method="post" />
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
                                                    <input type="text" class="form-control" name="customer_id" id="customer_name" placeholder="Enter customer name" onfocusout="getCustomerInfoIdPawend()">
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



                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            <div class="row">

                                                <ul class="nav nav-tabs nav-line">
                                                    <li><a href="#general-pawns" data-toggle="tab"><strong>General Pawn</strong></a></li>
                                                    <li class="active"><a href="#title-pawns" data-toggle="tab"><strong>Title PAwn</strong></a></li>
                                                </ul>

                                                <div class="tab-content nopadding noborder">
                                                    <div class="tab-pane" id="general-pawns">
                                                        <table class="table table-hover table-primary mb30 align-center" id="theTable">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: 40%;">Items Description</th>

                                                                <th>Loan Amount</th>
                                                                <th>Interest Due</th>
                                                                <th>Penalty</th>
                                                                <th>Due Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                          <tbody id="displayItemsPawn">

                                                          </tbody>

                                                        </table>
                                                    </div>

                                                    <div class="tab-pane active" id="title-pawns">
                                                        <table class="table table-hover table-primary mb30 align-center" id="theTable">
                                                            <thead>
                                                            <tr>
                                                                <th>Vin #</th>
                                                                <th>Model</th>
                                                                <th>Loan Amount</th>
                                                                <th>Interest Due</th>
                                                                <th>Penalty</th>
                                                                <th>Due Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="displayItemsPawnTitle">

                                                            </tbody>

                                                        </table>
                                                    </div>

                                                </div>

                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                    </div><!-- panel -->


                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Total Amount</h4>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" style="width: 40%;" class="form-control" id ="amount_paid" name="amount_paid" onkeyup="checkAmount(this)"/>
                                                    <input type="hidden" class="form-control" id ="total_amount" name="total_amount"/>
                                                    <input type="hidden" class="form-control" id ="due_date" name="due_date"/>
                                                    <input type="hidden" class="form-control" id ="interest_rate" name="interest_rate"/>
                                                    <input type="hidden" class="form-control" id ="interest_accured" name="interest_accured"/>
                                                    <input type="hidden" class="form-control" id ="percent" name="percent"/>
                                                    <input type="hidden" class="form-control" id ="pawn_type" name="pawn_type"/>
                                                    <input type="hidden" class="form-control" id ="tid" name="tid"/>
                                                    <input type="hidden" class="form-control" id ="pass_due" name="pass_due"/>
                                                    <input type="hidden" class="form-control" id ="penalty" name="penalty"/>
                                                    <input type="hidden" class="form-control" id ="occur" name="occur"/>
                                                    <input type="hidden" class="form-control" id ="allowed" name="allowed"/>
                                                    </div>
                                                </div>

                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                            <?php $date = date('Y-m-d'); ?>
                                            <input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">
                                            <input type="hidden" value="<?php echo $date; ?>" name="date">

											<input type="submit" id="submit" name="submit" class="btn btn-primary" value="Complete & Print Pawn Ticket" disabled>


                                        </div><!-- panel-footer -->
                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->
                            </form>
                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
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

<script type="text/javascript">


    $(document).ready(function(){

        $('table#theTable').on('change', 'td', function() {


            var $id = $(this).closest('tr').find('td:first').text();

            var $loan_id = $('#loan_info_id_' + $id +' input');
            var $loan_idT = $('#loan_title_id_' + $id +' input');
            var $checkbox = $('#checkbox_'+ $id +' input');
            var $checkboxT = $('#checkboxT_'+ $id +' input');


            if($checkbox.prop('checked'))
            {
               $loan_id.prop('disabled', false);


            }
            else {

                $loan_id.prop('disabled', true);
                document.getElementById("submit").disabled = true;
            }

            if($checkboxT.prop('checked'))
            {
                $loan_idT.prop('disabled', false);


            }
            else {

                $loan_idT.prop('disabled', true);
                document.getElementById("submit").disabled = true;

            }




        });


    });


	function getCustomerId(){


		var cid = document.getElementById("selectCustomer").value;
		document.getElementById("customer_id_ref").value = cid;

	}

    var amount = 0;

    function updateTotal(element){

        var price = parseFloat(element.getAttribute('data-price'));
        var interest = parseFloat(element.getAttribute('data-interest'));
        var due_date = element.getAttribute('data-due');
        var accured = element.getAttribute('data-accured');
        var percent = element.getAttribute('data-percent');
        var pawn_type = element.getAttribute('data-pawnType');
        var tid = element.getAttribute('data-tid');
        var allowed_partial = element.getAttribute('data-allowed');

		var pass_due = element.getAttribute('data-pass-due');
		var penalty = element.getAttribute('data-penalty');
		var occur = element.getAttribute('data-occur');


        amount += element.checked ? price : price*-1;

        document.getElementById('total_amount').value = amount;
        document.getElementById('due_date').value = due_date;
        document.getElementById('interest_rate').value = interest;
        document.getElementById('interest_accured').value = accured;
        document.getElementById('pawn_type').value = pawn_type;
        document.getElementById('tid').value = tid;
        document.getElementById('allowed').value = allowed_partial;

		document.getElementById('pass_due').value = pass_due;
		document.getElementById('penalty').value = penalty;
		document.getElementById('occur').value = occur;



    }


    function checkAmount(elem){

        var element = elem;
        var accured = parseFloat(document.getElementById('interest_accured').value);
        var state = document.getElementById('allowed').value;
		var pass_due = document.getElementById('pass_due').value;
		var penalty = parseFloat(document.getElementById('penalty').value) + parseFloat(accured);
		var occur = document.getElementById('occur').value;


        if(state == 0){
			if(pass_due == 1){
				if(occur == 'fixed'){
				   // element.value = accured;
					   if(accured != parseFloat(element.value)){
						   if(parseFloat(element.value) < penalty){
							   $('#amount_paid').tooltip({title: "Please pay the minimum amount of <b>$" + accured + "</b> or <b>$" + penalty + "</b> above", html: true, placement: "right", trigger: "hover"});
							   $('#amount_paid').tooltip('show');
							   document.getElementById("submit").disabled = true;
						   }else if(element.value == ''){
									document.getElementById("submit").disabled = true;
								}
								else{
									$('#amount_paid').tooltip('destroy');
									document.getElementById("submit").disabled = false;
								}


					   }else if(element.value == ''){
									document.getElementById("submit").disabled = true;
								}
								else{
									$('#amount_paid').tooltip('destroy');
									document.getElementById("submit").disabled = false;
								}
				   }else{
					   if(parseFloat(element.value) < penalty){
						   $('#amount_paid').tooltip({title: "Please pay the minimum amount of <b>$" + penalty + "</b>", html: true, placement: "right", trigger: "hover"});
								$('#amount_paid').tooltip('show');
								document.getElementById("submit").disabled = true;
							}
								else if(element.value == ''){
									document.getElementById("submit").disabled = true;
								}
								else{
									$('#amount_paid').tooltip('destroy');
									document.getElementById("submit").disabled = false;
								}
					   }
				   }
            else if(pass_due == 0){
                if(accured > parseFloat(element.value)){
                    $('#amount_paid').tooltip({title: "Please pay the minimum amount of <b>$" + accured + "</b>", html: true, placement: "right", trigger: "hover"});
                    $('#amount_paid').tooltip('show');
                    document.getElementById("submit").disabled = true;
                }
                else if(element.value == ''){
                    document.getElementById("submit").disabled = true;
                }
                else{
                    $('#amount_paid').tooltip('destroy');
                    document.getElementById("submit").disabled = false;
                }

            }
				}



		}

</script>


<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
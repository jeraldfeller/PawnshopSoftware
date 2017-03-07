<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Layaway Payment';


$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomer();
$term = $adminClass->getPaymentTerm();


$view = new View();

$date = date('Y-m-d');


if(isset($_POST['submit'])){
    $employeeClass->addRTO();
}


require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left" style="padding-top: 5px;">
                                <i class="fa fa-exxhange"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Layaway Payment</li>
                                </ul>
                                <h4>Layaway Payment</h4>
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
                                                    <input type="text" class="form-control" name="customer_id" id="customer_name" placeholder="Enter customer name" onfocusout="getData()">
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
										<div class="panel-heading"><h5>Items</h5></div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="responsive-table">
													<table class="table table-hover table-primary mb30 align-center" id="theTable">
														<thead>
														<tr>
														
															<th>Items</th>
															<th>Total Amount</th>
															<th>Date Added</th>
															<th>Action</th>
														</tr>
														</thead>
														<tbody id="displayLayaway">

														</tbody>
													</table>
													
													
												<input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">



												<input type="hidden" value="<?php echo $date; ?>" name="date">

												</div>
												
                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                      
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
    function getData(){
        getCustomerIdPoint();
        setTimeout(function(){
            getCustomerLayaway();
        }, 1000);
    }
</script>

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

    function focusSelect(){
        document.getElementById('plan_name').focus();
    }

    function sumTotal(elem){
        var qty = elem.value;
        var cost = document.getElementById('hidden_cost').value;
        var input = document.getElementById('cost')

        document.getElementById('cost').value = cost * qty;

        formatCurrency(input);
    }

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
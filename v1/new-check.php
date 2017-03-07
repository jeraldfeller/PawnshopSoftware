<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'New Check';


$employeeClass = new Employee();
$view = new View();
$customer = $employeeClass->getCustomer();
$state = $employeeClass->getState();

if(isset($_POST['submit'])){


   $employeeClass->addNewCheck();
 
   //Header('Location: FPDM/check-voucher.php?transaction_id=' . $tid .'');
}
if(isset($_GET['checkid'])){
	 echo '<script>window.open("FPDM/check-voucher.php?transaction_id=' . $_GET['checkid'] .'", "_blank");</script>'; 
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>New Check</li>
                                </ul>
                                <h4>New Check</h4>
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
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Amount</h5>
                                                    <div class="input-group col-lg-12">
														<span class="input-group-addon">$</span>
                                                        <input type="text" class="form-control" id="amount" name="amount" onchange="formatCurrency(this)" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <h5 class="box-heading">Memo</h5>
                                                    <div class="input-group col-lg-12">
                                                        
													<input type="text" class="form-control" id="memo" name="memo" required="">
                                                    </div>
                                                </div>
												
                                                
												
						
                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
										
                                    <input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">

                                    <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date">



                                                        <input type="submit" name="submit" class="btn btn-primary" value="Complete and Print Check">


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
	


<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
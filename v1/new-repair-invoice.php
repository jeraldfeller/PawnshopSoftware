<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'New Repair Invoice';

$employeeClass = new Employee();
$adminClass = new Admin();
$customer = $employeeClass->getCustomer();
$view = new View();
$taxs = $adminClass->getSalesTax();
foreach ($taxs as $tax){
    $sales_tax = $tax['general_tax'];
}
$date = date('Y-m-d');

if(isset($_POST['submit'])){
    $employeeClass->addNewRepairInvoice();
}

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left" style="padding-left: 15px;">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>New Repair Order/Invoice</li>
                                </ul>
                                <h4>New Repair Order/Invoice</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                        <form id="dataRepair">
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
                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Enter Repair Item Description</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" placeholder="" class="form-control" id="repair_item_description" onchange="postDesc(this);" required/>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Enter Repair Item Serial #</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" placeholder="" class="form-control" id="serial_number" onchange="postSerial(this);" required>
                                                    </div>
                                                </div>
                                        </div>

                                        </div>
                                    </div>
                            </div>



                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Add Parts</h4>

                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h5 class="box-heading">Description</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" id="parts_description" name="parts_description"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Cost</h5>
                                                    <div class="input-group col-lg-12">
                                                        <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="parts_cost" name="parts_cost" onchange="formatCurrency(this);" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Retail</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="parts_retail" name="parts_retail" onchange="formatCurrency(this);" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h5 class="box-heading">Quantity</h5>
                                                    <div class="input-group col-lg-12">
                                                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                                                    </div>
                                                </div>

                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                                <input onClick="setTimeout(function(){ getAddParts();}, 1000);" type="submit" name="submit" class="btn btn-success" value="Add Parts">
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
                                                                <th>Cost</th>
                                                                <th>Retail</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
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
                            <input type="hidden" id="pasteDesc" name="repair_item_description">
                            <input type="hidden" id="pasteSerial" name="serial_number">
                            <input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">
                            <input type="hidden" id="tax" name="tax">
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Description of Repair To be Completed</h4>

                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <h5 class="box-heading">Labor & Charge Amount</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="labor_charge" name="labor_charge" value="0" onchange="formatCurrency(this); sumTotal();" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Total Cost</h5>
                                                    <div class="input-group col-lg-12">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="total_cost_display" onchange="formatCurrency(this);" readonly>
                                                    <input type="hidden" class="form-control" id="total_cost" name="total_cost" onchange="formatCurrency(this);">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Deposit Amount</h5>
                                                    <div class="input-group col-lg-12">
                                                     <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="deposit" name="deposit" onchange="formatCurrency(this); calcBalance(this);" value="0" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Balance Due At Pick Up</h5>
                                                    <div class="input-group col-lg-12">
                                                     <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="balance_display" onchange="formatCurrency(this);" readonly>
                                                    <input type="hidden" class="form-control" id="balance" name="balance" onchange="formatCurrency(this);">
                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <h5 class="box-heading">Repair Status</h5>
                                                    <div class="input-group col-lg-12">
                                                    <select class="form-control" name="repair_status">
                                                        <option>-- select repair status --</option>
                                                        <option value="in_progress">In Progress</option>
                                                        <option value="awaiting_parts">Awaiting Parts</option>
                                                        <option value="fixed">Fixed A.C.P.</option>
                                                        <option value="completed">Completed</option>
                                                    </select>
                                                    </div>
                                                </div>







                                            </div>
                                            </div><!-- panel-body -->
                                            <div class="panel-footer">
                                                <input type="hidden" value="<?php echo $date; ?>" name="date_added">


                                                    <input type="submit" name="submit" class="btn btn-primary" value="Complete & Print">


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

        $(document).ready(function() {


            $('table#theTable tbody#displayItems').on('click', 'button', function () {

                var $id = $(this).closest('tr').find('td:first').text();
                var $parts_id = $('#parts_id_' + $id).val();
                var $image_name = " ";
                var $page = 'repair-invoice';
                removeItems($parts_id, $image_name, $page);



                setTimeout(function () {
                    sumTotal();
                }, 500)

            });
        });
    </script>

    <script>
        function postDesc(elem){
            var desc = elem.value;
            document.getElementById('pasteDesc').value = desc;
        }
        function postSerial(elem){
            var serial = elem.value;
            document.getElementById('pasteSerial').value = serial;
        }
        function sumTotal(){

            var tds = document.getElementById('theTable').getElementsByTagName('td');
            var labor_charge = document.getElementById('labor_charge').value;
            var sum = 0;

            var tax = <?php echo $sales_tax; ?>;
            var item_count = 0;
            for(var i = 0; i < tds.length; i ++) {

                if(tds[i].className == 'amount') {


                    sum += isNaN(tds[i].innerHTML) ? 0 : parseFloat(tds[i].innerHTML);
                    item_count++;
                }
            }

            document.getElementById('tax').value = (sum * parseFloat(tax)) / 100;



            sum = sum + parseFloat(labor_charge.replace(/\,/g,''));

            var total = document.getElementById('total_cost_display');


            total.value = sum;

            document.getElementById('total_cost').value = sum;

            var remaining = document.getElementById('balance_display');

            remaining.value = sum;
            document.getElementById('balance').value = sum;
           // document.getElementById('total_loan_amount_hidden').value = sum;
           formatCurrency(total);
            setTimeout(function(){
                formatCurrency(remaining);
            }, 300);
        }

        function calcBalance(elem){
            var deposit = elem.value;
            var total_cost = document.getElementById('total_cost').value;
            var balance = parseFloat(total_cost) - parseFloat(deposit.replace(/\,/g,''));

            var remaining = document.getElementById('balance_display');

            remaining.value = balance;
            document.getElementById('balance').value = balance;


            formatCurrency(remaining);

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
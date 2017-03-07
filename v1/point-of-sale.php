<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Point of Sale';

$adminClass = new Admin();
$employeeClass = new Employee();
$customer = $employeeClass->getCustomer();
$items = $employeeClass->getInventoryItems('No Image');

$taxs = $adminClass->getSalesTax();
foreach ($taxs as $tax){
    $tax = $tax['general_tax'];
}

$view = new View();

$posArr = array();
$posArrDesc = array();
foreach($items as $row){
    $posArr[$row['item_no']] = array($row);
}
foreach($items as $row){
    $posArrDesc[$row['description']] = array($row);
}

if(isset($_POST['submit'])){
	$items = $_POST['choice'];
$quantity = $_POST['quantity'];
$customer_id = $_POST['customerId'];

    $c_id = $_POST['customer_id'];

$sub_total = $_POST['sub_total'];
$sub_total = str_replace(',','', '' . $sub_total . '');
$tax = $_POST['tax'];
$total = $_POST['total'];
$total = str_replace(',','', '' . $total . '');
$payment = $_POST['payment'];
$date_added = $_POST['date_added'];



$count = $_POST['count'];

if(isset($_POST['submit'])) {


    $last_id = $employeeClass->addPointOfSale($c_id, $sub_total, $tax, $total, $payment, 'sold', $date_added);

    for($i = 1; $i <= $count; $i++){
        $lastId[] = $last_id;
    }

    $values = array_map(function ($customer_id, $items, $quantity, $lastId) {
        return "('$customer_id', '$items', '$quantity', '$lastId')";
    }, array_map('stripcslashes', $customer_id), array_map('stripcslashes', $items), array_map('stripcslashes', $quantity), array_map('stripcslashes', $lastId));

   $employeeClass->addSoldItem($values);

    foreach ($items as $key => $value) {
        $item_no = $value;
        $qty = $quantity[$key];
        $employeeClass->updateItemQuantity($item_no, $qty);
    }


    $query = array('customer_id' => $c_id,
        'sale_id' => $last_id);


  header('Location: print-point-of-sale-ticket.php?' . http_build_query($query));
    exit;
}

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
                                    <li>Point of Sale</li>
                                </ul>
                                <h4>Point of Sale</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
						
                       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"/>
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
                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Item Name</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" id="posCodeDesc" onfocusout="getPosItemDesc(this)">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="box-heading">Barcode</h5>
                                                    <div class="input-group col-lg-12">
                                                        <input type="text" class="form-control" id="posCode" onfocusout="getPosItem(this)">
                                                    </div>
													<br>
                                                </div>
												
												
												<table class="table table-striped table-primary mb30 table-hover" id="posTable">
                                                <thead>
                                                <tr>

                                                    <th>Item #</th>
                                                    <th>Description</th>
                                                    <th>Retail</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>



                                                </tr>
                                                </thead>
                                                <tbody id="displayPosItems">

                                                </tbody>
                                            </table>
											
											
											<div class="col-lg-4">
                                                    <h5 class="box-heading">Subtotal</h5>
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
											
											
											<div class="col-lg-12">
                                                    <h5 class="box-heading">Take Payment</h5>
                                                    <div class="input-group col-lg-12">
                                                        <select class="form-control" name="payment">
														<option> -- select payment method -- </option>
														<option value="cash"> Cash </option>
														<option value="card"> Credit Card </option>
														<option value="check"> Check </option>
													</select>
                                                    </div>
                                            </div>
												
                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                                 <?php

													$date = new DateTime();
													$date = $date->format('Y-m-d H:i:s');


													?>

													<input type="hidden" value="<?php echo $date; ?>" name="date_added">
													<input type="hidden" class="form-control" name="customer_id" id="customer_id_ref">

													
														<input type="submit" name="submit" class="btn btn-primary" value="Complete & Print Sale Receipt">

												

                                        </div><!-- panel-footer -->
                                        

                                      

                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->

							</form>



                            </div>

                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<script>




        $(document).on('ready', (function(){


            $('table#posTable tbody#displayPosItems').on('change', 'td', function() {


                var $id = $(this).closest('tr').find('td:first').text();
                var $cost = $('#cost_' + $id).text();
                var $quantity = $('#quantity_'+ $id +' input').val();



                var $count = $('#count_'+ $id).text();

                if ($quantity == 0 || $quantity == null)
                {
                    $quantity = 1;
                }

                    $sum = $cost * $quantity;
                    $('#costPrice_'+ $id).text($sum);
                    sumLoan();
                    calcGrandTotal();


            });


        }));
    </script>


    <script>

        function sumLoan(){

            var tds = document.getElementById('posTable').getElementsByTagName('td');

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

            var posTags = [
                <?php
                         echo $view->displayInventoryItems($items, 'barcode');
                 ?>
            ];

            var posTagsDesc = [
                <?php
                         echo $view->displayInventoryItems($items, 'description');
                 ?>
            ];

            $( "#customer_name" ).autocomplete({
                source: availableTags,
                html: 'html'
            });

            $( "#posCode" ).autocomplete({
                source: posTags,
                html: 'html'
            });

            $( "#posCodeDesc" ).autocomplete({
                source: posTagsDesc,
                html: 'html'
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 1, "asc" ]]
            });
        });
    </script>


    <script>

        var posID = document.getElementById('posCode');
        $('#posCode').on('paste', function(e){
            setTimeout(function(){
                getPosItem(posID);
            }, 200);


        });
        var posIDDesc = document.getElementById('posCodeDesc');
        $('#posCodeDesd').on('paste', function(e){
            setTimeout(function(){
                getPosItemDesc(posIDDesc);
            }, 200);


        });
        var x = 0;
        var posItems = <?php echo json_encode($posArr); ?>;
            function getPosItem(elem){
                var barcode = elem.value;

                if(barcode.length > 0) {
                    var appendItems = new Array();
                    $.each(posItems, function (key, value) {
                        if (key == barcode) {
                            $.each(value, function (key_in, value_in) {
                                $.each(value_in, function (key_inner, value_inner) {
                                    appendItems.push(value_inner);

                                });
                            });
                        }
                    });


                    if(appendItems.length > 0) {
                        var $cid = $('#selectCustomer').val();
                        if(typeof $cid == 'undefined'){
                            $cid = 1;
                        }
                        $('#customer_id_ref').val($cid);

                        $('#displayPosItems').append('<tr class="append align-center" id="row_' + x +'">' +
                            '<td style="display: none;">' + x + '</td>' +
                            '<td>' + appendItems[1] + '</td>' +
                            '<td>' + appendItems[2] + '</td>' +
                            '<td>$' + appendItems[4] + '</td>' +
                            '<td style="display: none;" id="cost_'+x+'">' + appendItems[4] + '</td>' +
                                '<td class="count" id="count_' + x + '" style="display:none">1</td>' +
                            '<td id="quantity_' + x + '"><div class="col-lg-12"><input class="form-control col-lg-1" type="number" value="1" name="quantity[]"></div></td>' +
                                '<td style="display: none;" id="costPrice_' +x+ '"  class="sum">' +  appendItems[4] + '</td>' +
                                '<td style="display: none;"  id="cid_' +x+ '"><input type="text" name="customerId[]" value="' + $cid + '"></td>'+
                                '<td style="display: none;"><input type="text" name="choice[]" value="' + appendItems[0] + '"></td>'+
                            '<td><button type="button" class="removeItem btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></td>'
                        );
                        x++;
                        $('.append').slideDown(500);

                        $('#posCode').val('');
                        $('#posCode').focus();

                        $('.append').on('click', '.removeItem', function () {

                            $(this).parent().animate({
                                height: "0px"
                            }, 500, function () {

                                $(this).parent().remove();
                                // Animation complete.

                            });

                            setTimeout(function(){
                                sumLoan();
                                calcGrandTotal();
                            }, 700);

                            x--;
                        });

                        sumLoan();
                        calcGrandTotal();




                    }
                }
            }


        var i = 0;
        var posItemsDesc = <?php echo json_encode($posArrDesc); ?>;
        function getPosItemDesc(elem){
            var desc = elem.value;

            if(desc.length > 0) {
                var appendItems = new Array();
                $.each(posItemsDesc, function (key, value) {
                    if (key == desc) {
                        $.each(value, function (key_in, value_in) {
                            $.each(value_in, function (key_inner, value_inner) {
                                appendItems.push(value_inner);

                            });
                        });
                    }
                });


                if(appendItems.length > 0) {
                    var $cid = $('#selectCustomer').val();
                    if(typeof $cid == 'undefined'){
                        $cid = 1;
                    }
                    $('#customer_id_ref').val($cid);

                    $('#displayPosItems').append('<tr class="append align-center" id="row_' + i +'">' +
                        '<td style="display: none;">' + i + '</td>' +
                        '<td>' + appendItems[1] + '</td>' +
                        '<td>' + appendItems[2] + '</td>' +
                        '<td>$' + appendItems[4] + '</td>' +
                        '<td style="display: none;" id="cost_'+i+'">' + appendItems[4] + '</td>' +
                        '<td class="count" id="count_' + i + '" style="display:none">1</td>' +
                        '<td id="quantity_' + i + '"><div class="col-lg-12"><input class="form-control col-lg-1" type="number" value="1" name="quantity[]"></div></td>' +
                        '<td style="display: none;" id="costPrice_' +i+ '"  class="sum">' +  appendItems[4] + '</td>' +
                        '<td style="display: none;"  id="cid_' +i+ '"><input type="text" name="customerId[]" value="' + $cid + '"></td>'+
                        '<td style="display: none;"><input type="text" name="choice[]" value="' + appendItems[0] + '"></td>'+
                        '<td><button type="button" class="removeItem btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></td>'
                    );
                    i++;
                    $('.append').slideDown(500);

                    $('#posCodeDesc').val('');
                    $('#posCodeDesc').focus();

                    $('.append').on('click', '.removeItem', function () {

                        $(this).parent().animate({
                            height: "0px"
                        }, 500, function () {

                            $(this).parent().remove();
                            // Animation complete.

                        });

                        setTimeout(function(){
                            sumLoan();
                            calcGrandTotal();
                        }, 700);

                        i--;
                    });

                    sumLoan();
                    calcGrandTotal();




                }
            }
        }






    </script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'View Customer';
$employeeClass = new Employee();
$customer = $employeeClass->getCustomer();
$matrix = $employeeClass->getLoanMatrix();

$view = new View();
$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li><a href="">View Customer</a></li>
                                </ul>
                                <h4>View Customer</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->

                         <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">

                                <input type="text" class="form-control" value="<?php if(isset($_GET['name'])){echo $_GET['name'] . ' - ' . $_GET['cid'];} ?>" name="customer_id" id="customer_name" placeholder="Enter customer name" onfocusout="getViewCustomerInfo()">
								<?php
                                    if(isset($_GET['name']))
                                    {
                                        if($_GET['action'] == 'successful')
                                        {
                                            ?>
                                            <script>

                                                setTimeout(function(){getViewCustomerInfo();},500);
                                            </script>
                                        <?php
                                        }
                                    }
                                    ?>
                                <div class="mbl"></div>
                            </div>
                            <div class="row" id="display_info">
                            </div>
                        </div>

                </div>


                    </div><!-- contentpanel -->

                </div>
            </div><!-- mainwrapper -->
        </section>



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
                    return $( "<li></li>" )
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
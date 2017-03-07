<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Our for Repossession';

$miscTable = new Miscellaneous();
$employeeClass = new Employee();
$view = new View();

$unredeemed_pawns = $miscTable->getPastDueTitlePawns();
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
                                    <li>Our for Repossession</li>
                                </ul>
                                <h4>Our for Repossession</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
                  

                        <div class="row">

                            <br>
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table table-hover table-primary mb30 align-center">
                                        <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>VIN</th>
                                                    <th>Year</th>
                                                    <th>Model</th>
                                                    <th>Images</th>
                                                    <th>Balance</th>
													<th>Due Date</th>
                                                    <th>Action</th>
                                                   
                                                </tr>
                                                </thead>
                                               <tbody id="displayItemsTitle">
													
                                                </tbody>
                                    </table>
									
									<div class="modal fade" id="title_pawn_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header info">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="modalLabel"></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="bold">Title Pawn Details:</span>
                                                            <br>
                                                            <br>

                                                            <input type="hidden" id="modal_title_value">
                                                            <input type="hidden" id="modal_title_status">

                                                            <table class="table-align-center table">
                                                              <thead class="align-center bold">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <th>Vin #</th>
                                                                <th>Year</th>
                                                                <th>Model</th>
                                                                <th>Balance</th>

                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td id="modal_title_customer_name"></td>
                                                                <td id="modal_title_vin"></td>
                                                                <td id="modal_title_model"></td>
                                                                <td id="modal_title_year"></td>
                                                                <td id="modal_title_amount"></td>
                                                            </tr>
                                                            </tbody>




                                                            </table>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="outForRepo()">Yes</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                    </div>
                                </div>


                            </div><!-- col-md-6 -->
                        </div>


                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->


<script src="<?php echo ROOT; ?>js/print-function.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>

<!-- switch -->

        <script src="<?php echo ROOT; ?>js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo ROOT; ?>js/bootstrap-timepicker.min.js"></script>


<script>
         function repo(){
             var tid = document.getElementById('modal_title_value').value;
             var status = document.getElementById('modal_title_status').value;
             repoTitlePawn(tid, status);
             refreshTable();

         }

 
		 function outForRepo(){
			 var id = document.getElementById('modal_title_value').value;
			 closeTitlePawn(id);
		 }

         function pushData(elem) {

             var value = elem.getAttribute('data-value');
             var customer_name = elem.getAttribute('data-customer');
             var vin = elem.getAttribute('data-vin');
             var model = elem.getAttribute('data-model');
             var year = elem.getAttribute('data-year');
             var amount = elem.getAttribute('data-amount');
             var status = elem.getAttribute('data-status');

            
                 var msg = 'Are you sure do you want to out for repo this vehicle?';
            

             document.getElementById('modalLabel').innerHTML = msg;

             document.getElementById('modal_title_value').value = value;
             document.getElementById('modal_title_status').value = status;

             document.getElementById('modal_title_customer_name').innerHTML = customer_name;
             document.getElementById('modal_title_vin').innerHTML = vin;
             document.getElementById('modal_title_model').innerHTML = model;
             document.getElementById('modal_title_year').innerHTML = year;
             document.getElementById('modal_title_amount').innerHTML = amount;
			 
		
         }
		 


     </script>

	 <script src="<?php echo ROOT; ?>js/fancybox/jquery.fancybox-1.3.4.min.js"></script>
<script src="<?php echo ROOT; ?>js/jquery.easing.1.3.js"></script>
    <script>
	
		setTimeout(function(){

            getPastDueTitlePawnsRepo();

        }, 2000)
		
		 function refreshTableTitlePawns(){
            setTimeout(function(){
				getPastDueTitlePawnsRepo();
			}, 500)
			
			
			setTimeout(function(){
                 $('#gallery a').fancybox({
                     type: 'image',
                     overlayColor: '#000',
                     overlayOpacity: .3,
                     transitionIn: 'elastic',
                     transitionOut: 'elastic',
                     easingIn: 'easeInSine',
                     easingOut: 'easeOutSine',
                     titlePosition: 'outside' ,
                     cyclic: true
                 });



             }, 1000);
        }
		
        setTimeout(function(){
            $('#gallery a').fancybox({
                type: 'image',
                overlayColor: '#000',
                overlayOpacity: .3,
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                easingIn: 'easeInSine',
                easingOut: 'easeOutSine',
                titlePosition: 'outside' ,
                cyclic: true
            });



        }, 3000);

    </script>

  

		
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
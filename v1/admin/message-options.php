<?php
require '../Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$title = 'Add New Message & Rule';

$adminClass = new Admin();
if (isset($_POST['submit'])){

    $adminClass->updateSalesTax();
}

$tax = $adminClass->getSalesTax();
foreach($tax as $row){
    $general_tax = $row['general_tax'];
    $flat_tax = $row['flat_tax'];
}
$queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
if(isset($_GET['transaction'])){
	if($_GET['transaction'] == 'generalPawns'){
		$preMessageOptions = $adminClass->getMessageOptions('preNotification', 'generalPawns');
		$onMessageOptions = $adminClass->getMessageOptions('onNotification', 'generalPawns');
		$postMessageOptions = $adminClass->getMessageOptions('postNotification', 'generalPawns');
		$transactionTitle = 'General Pawns';
		
		
		$preMid = (isset($preMessageOptions[0]['mId']) ? $preMessageOptions[0]['mId'] : '');
		$preDays = (isset($preMessageOptions[0]['days']) ? $preMessageOptions[0]['days'] : '');
		$preFrequency = (isset($preMessageOptions[0]['frequency']) ? $preMessageOptions[0]['frequency'] : '');
		$preMessage = (isset($preMessageOptions[0]['message']) ? $preMessageOptions[0]['message'] : '');
		$preType = (isset($preMessageOptions[0]['type']) ? $preMessageOptions[0]['type'] : 'preNotification');
		$preTransaction = (isset($preMessageOptions[0]['transaction']) ? $preMessageOptions[0]['transaction'] : 'generalPawns');
		$preActive = (isset($preMessageOptions[0]['active']) ? $preMessageOptions[0]['active'] : '1');
		
		
		
		
		$onMid = (isset($onMessageOptions[0]['mId']) ? $onMessageOptions[0]['mId'] : '');
	
		$onFrequency = (isset($onMessageOptions[0]['frequency']) ? $onMessageOptions[0]['frequency'] : '');
		$onMessage = (isset($onMessageOptions[0]['message']) ? $onMessageOptions[0]['message'] : '');
		$onType = (isset($onMessageOptions[0]['type']) ? $onMessageOptions[0]['type'] : 'onNotification');
		$onTransaction = (isset($onMessageOptions[0]['transaction']) ? $onMessageOptions[0]['transaction'] : 'generalPawns');
		$onActive = (isset($onMessageOptions[0]['active']) ? $onMessageOptions[0]['active'] : '1');
		
		
		$postMid = (isset($postMessageOptions[0]['mId']) ? $postMessageOptions[0]['mId'] : '');
		$postDays = (isset($postMessageOptions[0]['days']) ? $postMessageOptions[0]['days'] : '');
		$postFrequency = (isset($postMessageOptions[0]['frequency']) ? $postMessageOptions[0]['frequency'] : '');
		$postMessage = (isset($postMessageOptions[0]['message']) ? $postMessageOptions[0]['message'] : '');
		$postType = (isset($postMessageOptions[0]['type']) ? $postMessageOptions[0]['type'] : 'postNotification');
		$postTransaction = (isset($postMessageOptions[0]['transaction']) ? $postMessageOptions[0]['transaction'] : 'generalPawns');
		$postActive = (isset($postMessageOptions[0]['active']) ? $postMessageOptions[0]['active'] : '1');
	}
	
	else if($_GET['transaction'] == 'titlePawns'){
		$preMessageOptions = $adminClass->getMessageOptions('preNotification', 'titlePawns');
		$onMessageOptions = $adminClass->getMessageOptions('onNotification', 'titlePawns');
		$postMessageOptions = $adminClass->getMessageOptions('postNotification', 'titlePawns');
		$transactionTitle = 'Title Pawns';
		
		$preMid = (isset($preMessageOptions[0]['mId']) ? $preMessageOptions[0]['mId'] : '');
		$preDays = (isset($preMessageOptions[0]['days']) ? $preMessageOptions[0]['days'] : '');
		$preFrequency = (isset($preMessageOptions[0]['frequency']) ? $preMessageOptions[0]['frequency'] : '');
		$preMessage = (isset($preMessageOptions[0]['message']) ? $preMessageOptions[0]['message'] : '');
		$preType = (isset($preMessageOptions[0]['type']) ? $preMessageOptions[0]['type'] : 'preNotification');
		$preTransaction = (isset($preMessageOptions[0]['transaction']) ? $preMessageOptions[0]['transaction'] : 'titlePawns');
		$preActive = (isset($preMessageOptions[0]['active']) ? $preMessageOptions[0]['active'] : '1');
		
		
		
		
		$onMid = (isset($onMessageOptions[0]['mId']) ? $onMessageOptions[0]['mId'] : '');
	
		$onFrequency = (isset($onMessageOptions[0]['frequency']) ? $onMessageOptions[0]['frequency'] : '');
		$onMessage = (isset($onMessageOptions[0]['message']) ? $onMessageOptions[0]['message'] : '');
		$onType = (isset($onMessageOptions[0]['type']) ? $onMessageOptions[0]['type'] : 'onNotification');
		$onTransaction = (isset($onMessageOptions[0]['transaction']) ? $onMessageOptions[0]['transaction'] : 'titlePawns');
		$onActive = (isset($onMessageOptions[0]['active']) ? $onMessageOptions[0]['active'] : '1');
		
		
		$postMid = (isset($postMessageOptions[0]['mId']) ? $postMessageOptions[0]['mId'] : '');
		$postDays = (isset($postMessageOptions[0]['days']) ? $postMessageOptions[0]['days'] : '');
		$postFrequency = (isset($postMessageOptions[0]['frequency']) ? $postMessageOptions[0]['frequency'] : '');
		$postMessage = (isset($postMessageOptions[0]['message']) ? $postMessageOptions[0]['message'] : '');
		$postType = (isset($postMessageOptions[0]['type']) ? $postMessageOptions[0]['type'] : 'postNotification');
		$postTransaction = (isset($postMessageOptions[0]['transaction']) ? $postMessageOptions[0]['transaction'] : 'titlePawns');
		$postActive = (isset($postMessageOptions[0]['active']) ? $postMessageOptions[0]['active'] : '1');
	}
	else if($_GET['transaction'] == 'rto'){
		$preMessageOptions = $adminClass->getMessageOptions('preNotification', 'rto');
		$onMessageOptions = $adminClass->getMessageOptions('onNotification', 'rto');
		$postMessageOptions = $adminClass->getMessageOptions('postNotification', 'rto');
		$transactionTitle = 'RTO';
		
		$preMid = (isset($preMessageOptions[0]['mId']) ? $preMessageOptions[0]['mId'] : '');
		$preDays = (isset($preMessageOptions[0]['days']) ? $preMessageOptions[0]['days'] : '');
		$preFrequency = (isset($preMessageOptions[0]['frequency']) ? $preMessageOptions[0]['frequency'] : '');
		$preMessage = (isset($preMessageOptions[0]['message']) ? $preMessageOptions[0]['message'] : '');
		$preType = (isset($preMessageOptions[0]['type']) ? $preMessageOptions[0]['type'] : 'preNotification');
		$preTransaction = (isset($preMessageOptions[0]['transaction']) ? $preMessageOptions[0]['transaction'] : 'rto');
		$preActive = (isset($preMessageOptions[0]['active']) ? $preMessageOptions[0]['active'] : '1');
		
		
		
		
		$onMid = (isset($onMessageOptions[0]['mId']) ? $onMessageOptions[0]['mId'] : '');
	
		$onFrequency = (isset($onMessageOptions[0]['frequency']) ? $onMessageOptions[0]['frequency'] : '');
		$onMessage = (isset($onMessageOptions[0]['message']) ? $onMessageOptions[0]['message'] : '');
		$onType = (isset($onMessageOptions[0]['type']) ? $onMessageOptions[0]['type'] : 'onNotification');
		$onTransaction = (isset($onMessageOptions[0]['transaction']) ? $onMessageOptions[0]['transaction'] : 'rto');
		$onActive = (isset($onMessageOptions[0]['active']) ? $onMessageOptions[0]['active'] : '1');
		
		
		$postMid = (isset($postMessageOptions[0]['mId']) ? $postMessageOptions[0]['mId'] : '');
		$postDays = (isset($postMessageOptions[0]['days']) ? $postMessageOptions[0]['days'] : '');
		$postFrequency = (isset($postMessageOptions[0]['frequency']) ? $postMessageOptions[0]['frequency'] : '');
		$postMessage = (isset($postMessageOptions[0]['message']) ? $postMessageOptions[0]['message'] : '');
		$postType = (isset($postMessageOptions[0]['type']) ? $postMessageOptions[0]['type'] : 'postNotification');
		$postTransaction = (isset($postMessageOptions[0]['transaction']) ? $postMessageOptions[0]['transaction'] : 'rto');
		$postActive = (isset($postMessageOptions[0]['active']) ? $postMessageOptions[0]['active'] : '1');
	}
	
	else if($_GET['transaction'] == 'layaway'){
		$preMessageOptions = $adminClass->getMessageOptions('preNotification', 'layaway');
		$onMessageOptions = $adminClass->getMessageOptions('onNotification', 'layaway');
		$postMessageOptions = $adminClass->getMessageOptions('postNotification', 'layaway');
		$transactionTitle = 'Layaway';
		
		$preMid = (isset($preMessageOptions[0]['mId']) ? $preMessageOptions[0]['mId'] : '');
		$preDays = (isset($preMessageOptions[0]['days']) ? $preMessageOptions[0]['days'] : '');
		$preFrequency = (isset($preMessageOptions[0]['frequency']) ? $preMessageOptions[0]['frequency'] : '');
		$preMessage = (isset($preMessageOptions[0]['message']) ? $preMessageOptions[0]['message'] : '');
		$preType = (isset($preMessageOptions[0]['type']) ? $preMessageOptions[0]['type'] : 'preNotification');
		$preTransaction = (isset($preMessageOptions[0]['transaction']) ? $preMessageOptions[0]['transaction'] : 'layaway');
		$preActive = (isset($preMessageOptions[0]['active']) ? $preMessageOptions[0]['active'] : '1');
		
		
		
		
		$onMid = (isset($onMessageOptions[0]['mId']) ? $onMessageOptions[0]['mId'] : '');
	
		$onFrequency = (isset($onMessageOptions[0]['frequency']) ? $onMessageOptions[0]['frequency'] : '');
		$onMessage = (isset($onMessageOptions[0]['message']) ? $onMessageOptions[0]['message'] : '');
		$onType = (isset($onMessageOptions[0]['type']) ? $onMessageOptions[0]['type'] : 'onNotification');
		$onTransaction = (isset($onMessageOptions[0]['transaction']) ? $onMessageOptions[0]['transaction'] : 'layaway');
		$onActive = (isset($onMessageOptions[0]['active']) ? $onMessageOptions[0]['active'] : '1');
		
		
		$postMid = (isset($postMessageOptions[0]['mId']) ? $postMessageOptions[0]['mId'] : '');
		$postDays = (isset($postMessageOptions[0]['days']) ? $postMessageOptions[0]['days'] : '');
		$postFrequency = (isset($postMessageOptions[0]['frequency']) ? $postMessageOptions[0]['frequency'] : '');
		$postMessage = (isset($postMessageOptions[0]['message']) ? $postMessageOptions[0]['message'] : '');
		$postType = (isset($postMessageOptions[0]['type']) ? $postMessageOptions[0]['type'] : 'postNotification');
		$postTransaction = (isset($postMessageOptions[0]['transaction']) ? $postMessageOptions[0]['transaction'] : 'layaway');
		$postActive = (isset($postMessageOptions[0]['active']) ? $postMessageOptions[0]['active'] : '1');
	}
	
}


if(isset($_POST['preNotificationButton'])){
	$adminClass->updateMessageNotification($queryString); 
}
if(isset($_POST['onNotificationButton'])){
	$adminClass->updateMessageNotification($queryString);
}
if(isset($_POST['postNotificationButton'])){
	$adminClass->updateMessageNotification($queryString);
}
$cp = $adminClass->getNumber();
if(isset($_POST['cp'])){
	$adminClass->changeNumber($queryString);
}

/*
$customerName = 'John';
$amountDue = 5;
$due = '2016-08-29';

$string = array('{$name}', '{$amount}', '{$dueDate}');
$replace = array($customerName, $amountDue, $due);
$convertedMessage = str_replace($string, $replace, $preMessageOptions[0]['message']);
*/

require SERVER_ROOT . '/' . VERSION . '/includes/header.php';
?>

<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Add New Message & Rule</li>
                                </ul>
                                <h4>Add New Message & Rule (<?php echo $transactionTitle; ?>)</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->

                    <div class="contentpanel">

                        <!-- CONTENT GOES HERE -->
						<form action="<?php echo $_SERVER['PHP_SELF'] . '?' . $queryString; ?>" method="post">
							Cell no: (I set a dummy transaction that is before, on and after duedate, please change your number here so that the message will be send to you)
							<Br>
							*this will work only with the current setting, 2 days before and after. that will match the due date of the dummy transaction
							<input type="text" class="form-control" value="<?php echo $cp[0]['cell_no']; ?>" id="c" name="cp_no"/>
							<input type="submit" name="cp" value="change">
							<br>
							<br>
						</form>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?' . $queryString; ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
											<div class="ckbox ckbox-success">
                                                            <input id="preNotification" class="styled" type="checkbox" value="1" name="preNotification" data-mId="<?php echo $preMid; ?>">
															  <label for="preNotification">
                                                                Enable
                                                            </label>
                                                           <h4 for="title_pawns" class="panel-title">Pre Notification Message</h4>

                                                        </div>
                                           
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <h5 class="box-heading"># of days before due date</h5>
													
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" class="form-control" value="<?php echo $preDays; ?>" id="daysBeforeDueDate" name="days" disabled/>
													<!-- <i class="small">* to set multiple days, seperate it by (,) ex. 5, 3, 2</i> -->
                                               
                                                    </div>
                                                </div>
												
												<div class="col-lg-3">
                                                    <h5 class="box-heading"># of message per day</h5>
						
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" class="form-control" value="<?php echo $preFrequency; ?>" id="preFrequency" name="frequency" disabled/>
                                               
                                                    </div>
                                                </div>
												
												<div class="col-lg-12">
                                                    <h5 class="box-heading">Message</h5>
						
                                                    <div class="input-group col-lg-12">
                                                   
													<textarea  rowspan="3" class="form-control" name="message" id="preMessage" disabled><?php echo $preMessage; ?></textarea>
													<code>
														variables
														{name} = customer name
														{amount} = amount due 
														{dueDate} = due date
													</code>
                                                    </div>
                                                </div>
                                                
                                                

                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
											<input type="hidden" value="<?php echo $preType; ?>" name="type">
											<input type="hidden" value="<?php echo $preTransaction; ?>" name="transaction">
											<input type="hidden" value="<?php echo $preMid; ?>" name="mId" id="mId">
											
                                            <button type="submit" id="preNotificationButton" name="preNotificationButton" class="btn btn-primary" disabled>Edit/Change</button>

                                        </div><!-- panel-footer -->
                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->
                        </div>
                        </form>
						
						  <form action="<?php echo $_SERVER['PHP_SELF'] . '?' . $queryString; ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
											<div class="ckbox ckbox-success">
                                                            <input id="onNotification" class="styled" type="checkbox" value="1" name="onNotification" data-mId="<?php echo $onMid; ?>">
															  <label for="onNotification">
                                                                Enable
                                                            </label>
                                                           <h4 class="panel-title">On Notification Message</h4>

                                                        </div>
                                           
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                             
												<div class="col-lg-3">
                                                    <h5 class="box-heading"># of message per day</h5>
						
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" class="form-control" value="<?php echo $onFrequency; ?>" id="onFrequency" name="frequency" disabled/>
													   <input type="hidden" class="form-control" value="0" name="days" disabled/>
                                                    </div>
                                                </div>
												
												<div class="col-lg-12">
                                                    <h5 class="box-heading">Message</h5>
						
                                                    <div class="input-group col-lg-12">
                                                   
													<textarea  rowspan="3" class="form-control" name="message" id="onMessage" disabled><?php echo $onMessage ; ?></textarea>
													<code>
														variables
														{name} = customer name
														{amount} = amount due 
														{dueDate} = due date
													</code>
                                                    </div>
                                                </div>
                                                
                                                

                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
											<input type="hidden" value="<?php echo $onType; ?>" name="type">
											<input type="hidden" value="<?php echo $onTransaction; ?>" name="transaction">
											<input type="hidden" value="<?php echo $onMid; ?>" name="mId" id="mId">
                                            <button type="submit" id="onNotificationButton" name="onNotificationButton" class="btn btn-primary" disabled>Edit/Change</button>

                                        </div><!-- panel-footer -->
                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->
                        </div>
                        </form>
						
						
						 <form action="<?php echo $_SERVER['PHP_SELF'] . '?' . $queryString; ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-btns">
                                                <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                                <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
											<div class="ckbox ckbox-success">
                                                            <input id="postNotification" class="styled" type="checkbox" value="1" name="postNotification" data-mId="<?php echo $postMid; ?>">
															  <label for="postNotification">
                                                                Enable
                                                            </label>
                                                           <h4 for="title_pawns" class="panel-title">Post Notification Message</h4>

                                                        </div>
                                           
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <h5 class="box-heading"># of days after due date</h5>
													
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" class="form-control" value="<?php echo $postDays; ?>" id="daysAfterDueDate" name="days" disabled/>
													<!--<i class="small">* to set multiple days, seperate it by (,) ex. 5, 3, 2</i> -->
                                               
                                                    </div>
                                                </div>
												
												<div class="col-lg-3">
                                                    <h5 class="box-heading"># of message per day</h5>
						
                                                    <div class="input-group col-lg-12">
                                                    <input type="text" class="form-control" value="<?php echo $postFrequency; ?>" id="postFrequency" name="frequency" disabled/>
                                               
                                                    </div>
                                                </div>
												
												<div class="col-lg-12">
                                                    <h5 class="box-heading">Message</h5>
						
                                                    <div class="input-group col-lg-12">
                                                   
													<textarea  rowspan="3" class="form-control" name="message" id="postMessage" disabled><?php echo $postMessage; ?></textarea>
													<code>
														variables
														{name} = customer name
														{amount} = amount due 
														{dueDate} = due date
													</code>
                                                    </div>
                                                </div>
                                                
                                                

                                            </div><!-- row -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
											<input type="hidden" value="<?php echo $postType; ?>" name="type">
											<input type="hidden" value="<?php echo $postTransaction; ?>" name="transaction">
											<input type="hidden" value="<?php echo $postMid; ?>" name="mId" id="mId">
                                            <button type="submit" id="postNotificationButton" name="postNotificationButton" class="btn btn-primary" disabled>Edit/Change</button>

                                        </div><!-- panel-footer -->
                                    </div><!-- panel -->

                            </div><!-- col-md-6 -->
                        </div>
                        </form>

                    </div><!-- contentpanel -->

                </div>
</div><!-- mainwrapper -->

<script>
	$(document).ready(function(){
		
		var preNotification = "<?php echo $preActive;?>";
		var onNotification = "<?php echo $onActive;?>";
		var postNotification = "<?php echo $postActive;?>";
		if(preNotification == 1){
			document.getElementById("preNotification").checked = true;
			document.getElementById("daysBeforeDueDate").disabled = false;
			document.getElementById("preMessage").disabled = false;
			document.getElementById("preFrequency").disabled = false;
			document.getElementById("preNotificationButton").disabled = false;
			
		}else{
				document.getElementById("preNotification").checked = false;
				document.getElementById("daysBeforeDueDate").disabled = true;
				document.getElementById("preMessage").disabled = true;
				document.getElementById("preFrequency").disabled = true;
				document.getElementById("preNotificationButton").disabled = true;
		}
		
		$('#preNotification').click(function(){
			var elem = document.getElementById('preNotification');
			var mId = elem.getAttribute('data-mId');
			
			if(document.getElementById("preNotification").checked == true){
			var bool = 1;
			document.getElementById("daysBeforeDueDate").disabled = false;
			document.getElementById("preMessage").disabled = false;
			document.getElementById("preFrequency").disabled = false;
			document.getElementById("preNotificationButton").disabled = false;

			}else{
				var bool = 0;
				document.getElementById("daysBeforeDueDate").disabled = true;
				document.getElementById("preMessage").disabled = true;
				document.getElementById("preFrequency").disabled = true;
				document.getElementById("preNotificationButton").disabled = true;
			}
			
			updateMessageActive(mId, bool);
		});
		
		
		
		if(onNotification == 1){
			document.getElementById("onNotification").checked = true;
			
			document.getElementById("onMessage").disabled = false;
			document.getElementById("onFrequency").disabled = false;
			document.getElementById("onNotificationButton").disabled = false;
			
		}else{
				document.getElementById("onNotification").checked = false;
				
				document.getElementById("onMessage").disabled = true;
				document.getElementById("onFrequency").disabled = true;
				document.getElementById("onNotificationButton").disabled = true;
		}
		
		$('#onNotification').click(function(){
			var elem = document.getElementById('onNotification');
			var mId = elem.getAttribute('data-mId');
			
			if(document.getElementById("onNotification").checked == true){
			var bool = 1;
			document.getElementById("onMessage").disabled = false;
			document.getElementById("onFrequency").disabled = false;
			document.getElementById("onNotificationButton").disabled = false;
			}else{
				var bool = 0;
				document.getElementById("onNotification").checked = false;
				document.getElementById("onMessage").disabled = true;
				document.getElementById("onFrequency").disabled = true;
				document.getElementById("onNotificationButton").disabled = true;
			}
			
			updateMessageActive(mId, bool);
		});
		
		
		if(postNotification == 1){
			document.getElementById("postNotification").checked = true;
			document.getElementById("daysAfterDueDate").disabled = false;
			document.getElementById("postMessage").disabled = false;
			document.getElementById("postFrequency").disabled = false;
			document.getElementById("postNotificationButton").disabled = false;
			
		}else{
				document.getElementById("postNotification").checked = false;
				document.getElementById("daysBeforeDueDate").disabled = true;
				document.getElementById("preMessage").disabled = true;
				document.getElementById("preFrequency").disabled = true;
				document.getElementById("preNotificationButton").disabled = true;
		}
		
		$('#postNotification').click(function(){
			var elem = document.getElementById('postNotification');
			var mId = elem.getAttribute('data-mId');
			
			if(document.getElementById("postNotification").checked == true){
			var bool = 1;
			document.getElementById("daysAfterDueDate").disabled = false;
			document.getElementById("postMessage").disabled = false;
			document.getElementById("postFrequency").disabled = false;
			document.getElementById("postNotificationButton").disabled = false;

			}else{
				var bool = 0;
				document.getElementById("daysAfterDueDate").disabled = true;
				document.getElementById("postMessage").disabled = true;
				document.getElementById("postFrequency").disabled = true;
				document.getElementById("postNotificationButton").disabled = true;
			}
			
			updateMessageActive(mId, bool);
		});
		
	});
</script>

<script src="<?php echo ROOT; ?>js/jquery.gritter.min.js"></script>
<script src="<?php echo ROOT; ?>js/notify.js"></script>
<?php require SERVER_ROOT . '/' . VERSION . '/includes/footer.php'; ?>
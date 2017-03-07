<?php
$userClass = new Users();

if(isset($_POST['clock_in'])){
    $userClass->clockManagement(1);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>

    <link href="<?php echo ROOT; ?>css/style.default.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>css/morris.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>css/select2.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>css/simple-line-icons.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>css/jquery.gritter.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="<?php echo ROOT; ?>css/bootstrap-switch.min.css" rel="stylesheet" />
    <script src="<?php echo ROOT; ?>js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo ROOT; ?>js/jquery-ui-1.10.3.min.js"></script>
    <link href="<?php echo ROOT; ?>css/style.datatables.css" rel="stylesheet">
    <link href="//cdn.datatables.net/responsive/1.0.1/css/dataTables.responsive.css" rel="stylesheet">
	<link href="<?php echo ROOT; ?>js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

    <![endif]-->
	
	
	<?php
	if($userType != 'Admin'){
		if($log_status == 0){
        echo '<script>
                $(document).ready(function(){
                $("#login_reminder").modal("show");
                });

                </script>';
    }
	}
    

    ?>
</head>

<body>

<div class="modal fade" id="login_reminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header info">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-info-circle"></i> Notice</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <p>Good day <b><?php echo $user_full_name; ?></b>,</p>
                        <p>You havent clocked in yet, please click YES to start your time.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
                <input type="hidden" value="<?php echo $USER_ID;?>" name="user_id">
                <input type="hidden" value="1" name="clock_in">
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<header>
    <div class="headerwrapper">
        <div class="header-left">
            <a href="index.html" class="logo">
                <img src="images/logo.png" alt="" />
            </a>
            <div class="pull-right">
                <a href="" class="menu-collapse">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div><!-- header-left -->

        <div class="header-right">

            <div class="pull-right">

                <form class="form form-search" action="search-results.html">
                    <input type="search" class="form-control" placeholder="Search" />
                </form>

                <div class="btn-group btn-group-list btn-group-notification">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge">5</span>
                    </button>
                    <div class="dropdown-menu pull-right">
                        <a href="" class="link-right"><i class="fa fa-search"></i></a>
                        <h5>Notification</h5>
                        <ul class="media-list dropdown-list">
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user1.png" alt="">
                                <div class="media-body">
                                    <strong>Nusja Nawancali</strong> likes a photo of you
                                    <small class="date"><i class="fa fa-thumbs-up"></i> 15 minutes ago</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user2.png" alt="">
                                <div class="media-body">
                                    <strong>Weno Carasbong</strong> shared a photo of you in your <strong>Mobile Uploads</strong> album.
                                    <small class="date"><i class="fa fa-calendar"></i> July 04, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user3.png" alt="">
                                <div class="media-body">
                                    <strong>Venro Leonga</strong> likes a photo of you
                                    <small class="date"><i class="fa fa-thumbs-up"></i> July 03, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user4.png" alt="">
                                <div class="media-body">
                                    <strong>Nanterey Reslaba</strong> shared a photo of you in your <strong>Mobile Uploads</strong> album.
                                    <small class="date"><i class="fa fa-calendar"></i> July 03, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user1.png" alt="">
                                <div class="media-body">
                                    <strong>Nusja Nawancali</strong> shared a photo of you in your <strong>Mobile Uploads</strong> album.
                                    <small class="date"><i class="fa fa-calendar"></i> July 02, 2014</small>
                                </div>
                            </li>
                        </ul>
                        <div class="dropdown-footer text-center">
                            <a href="" class="link">See All Notifications</a>
                        </div>
                    </div><!-- dropdown-menu -->
                </div><!-- btn-group -->

                <div class="btn-group btn-group-list btn-group-messages">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge">2</span>
                    </button>
                    <div class="dropdown-menu pull-right">
                        <a href="" class="link-right"><i class="fa fa-plus"></i></a>
                        <h5>New Messages</h5>
                        <ul class="media-list dropdown-list">
                            <li class="media">
                                <span class="badge badge-success">New</span>
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user1.png" alt="">
                                <div class="media-body">
                                    <strong>Nusja Nawancali</strong>
                                    <p>Hi! How are you?...</p>
                                    <small class="date"><i class="fa fa-clock-o"></i> 15 minutes ago</small>
                                </div>
                            </li>
                            <li class="media">
                                <span class="badge badge-success">New</span>
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user2.png" alt="">
                                <div class="media-body">
                                    <strong>Weno Carasbong</strong>
                                    <p>Lorem ipsum dolor sit amet...</p>
                                    <small class="date"><i class="fa fa-clock-o"></i> July 04, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user3.png" alt="">
                                <div class="media-body">
                                    <strong>Venro Leonga</strong>
                                    <p>Do you have the time to listen to me...</p>
                                    <small class="date"><i class="fa fa-clock-o"></i> July 03, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user4.png" alt="">
                                <div class="media-body">
                                    <strong>Nanterey Reslaba</strong>
                                    <p>It might seem crazy what I'm about to say...</p>
                                    <small class="date"><i class="fa fa-clock-o"></i> July 03, 2014</small>
                                </div>
                            </li>
                            <li class="media">
                                <img class="img-circle pull-left noti-thumb" src="images/photos/user1.png" alt="">
                                <div class="media-body">
                                    <strong>Nusja Nawancali</strong>
                                    <p>Hey I just met you and this is crazy...</p>
                                    <small class="date"><i class="fa fa-clock-o"></i> July 02, 2014</small>
                                </div>
                            </li>
                        </ul>
                        <div class="dropdown-footer text-center">
                            <a href="" class="link">See All Messages</a>
                        </div>
                    </div><!-- dropdown-menu -->
                </div><!-- btn-group -->

                <div class="btn-group btn-group-option">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                        <li><a href="time-clock.php"><i class="fa fa-clock-o"></i>Time Clock</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo ROOT; ?>logout"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a></li>
                    </ul>
                </div><!-- btn-group -->

            </div><!-- pull-right -->

        </div><!-- header-right -->

    </div><!-- headerwrapper -->
</header>

<section>
    <div class="mainwrapper">
        <div class="leftpanel">
            <div class="media profile-left">
                <a class="pull-left profile-thumb" href="profile.html">
                    <img class="img-circle" src="images/photos/profile.png" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $user_full_name; ?></h4>
                    <small class="text-muted"><?php echo $user_name; ?></small>
                </div>
            </div><!-- media -->

            <h5 class="leftpanel-title">Navigation</h5>
            <ul class="nav nav-pills nav-stacked">
                <?php
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/index.php'){$index_class = 'class="active"';}else{$index_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/company-info.php'){$company_info_class = 'class="active"';}else{$company_info_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/check-settings.php'){$check_settings_class = 'class="active"';}else{$check_settings_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/loan-matrix.php'){$loan_matrix_class = 'class="active"';}else{$loan_matrix_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/users.php'){$manage_user_class = 'class="active"';}else{$manage_user_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/prepaid-plan.php'){$prepaid_class = 'class="active"';}else{$prepaid_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/sales-tax.php'){$tax_class = 'class="active"';}else{$tax_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/end-of-day-report.php'){$report_class = 'class="active"';}else{$report_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/monthly-report.php'){$monthly_report_class = 'class="active"';}else{$monthly_report_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/balance-sheet-report.php'){$balance_sheet_class = 'class="active"';}else{$balance_sheet_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/message-options.php'){$message_class = 'class="parent active"';}else{$message_class = 'class="parent"';}
				if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/time-clock.php'){$time_class = 'class="active"';}else{$time_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/allow-partial.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/view-void-transactions.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/forfeit.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/scrap-metal-settings.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/admin/lien-holder.php'){$misc_class = 'class="parent active"';}else{$misc_class= 'class="parent"';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/collections.php'){$collection_class = 'class="active"';}else{$collection_class= '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-customer.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/add-customer.php'){$customer_class = 'class="parent active"';}else{$customer_class= 'class="parent"';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-pawns.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/add-pawn.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/take-payment.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/forfeited-pawns.php'){$pawn_class = 'class="parent active"';}else{$pawn_class= 'class="parent"';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-title-pawns.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/add-title-pawn.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/out-of-repossession.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/repoed.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/vehicle-inventory.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/take-payment-title.php'){$title_pawn_class = 'class="parent active"';}else{$title_pawn_class= 'class="parent"';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/scrap-buying.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/scrap-on-hold.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/scrap-current-inventory.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/scrap-awaiting-melting.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/scrap-value-calculator.php'){$scrap_class = 'class="parent active"';}else{$scrap_class= 'class="parent"';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-edit-repair-orders.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/new-repair-invoice.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/edit-repair-orders.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/print-repair-ticket.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/redeem-repair-orders.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/print-repair-payment-ticket.php' ){$repair_class = 'class="parent active"';}else{$repair_class = 'class="parent"';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-pins.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/new-refill.php'){$refill_class = 'class="parent active"';}else{$refill_class = 'class="parent"';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-rto-agreements.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/rent-to-own.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/rto-payment.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/view-rto.php'){$rto_class = 'class="parent active"';}else{$rto_class = 'class="parent"';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-inventory.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/add-inventory.php'){$inventory_class = 'class="parent active"';}else{$inventory_class= 'class="parent"';}
				if($_SERVER['PHP_SELF'] == '/' . VERSION . '/buy-item-outright.php'){$outright_class = 'class="active"';}else{$outright_class = '';}
				if($_SERVER['PHP_SELF'] == '/' . VERSION . '/point-of-sale.php'){$pos_class = 'class="active"';}else{$pos_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-check-register.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/new-check.php'){$check_class = 'class="parent active"';}else{$check_class = 'class="parent"';}
				if($_SERVER['PHP_SELF'] == '/' . VERSION . '/petty-cash-ledger.php'){$petty_class = 'class="active"';}else{$petty_class = '';}
				if($_SERVER['PHP_SELF'] == '/' . VERSION . '/void-transaction.php'){$void_class = 'class="active"';}else{$void_class = '';}
                if($_SERVER['PHP_SELF'] == '/' . VERSION . '/view-layaway-agreement.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/view-layaway.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/add-layaway.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/inactive-layaway.php' || $_SERVER['PHP_SELF'] == '/' . VERSION . '/layaway-payment.php'){$layaway_class = 'class="parent active"';}else{$layaway_class = 'class="parent"';}
 
				?>

                <li <?php echo $index_class; ?>><a href="http://app.correllsoftware.com/v1/index"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
                <?php if($userType == 'Admin'){ ?>
                    <li <?php echo $company_info_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/company-info"><i class="fa fa-home"></i><span class="menu-title">Company Information</span></a></li>
                    <li <?php echo $check_settings_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/check-settings"><i class="fa fa-list-alt"></i><span class="menu-title">Check Settings</span></a></li>
                    <li <?php echo $loan_matrix_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/loan-matrix"><i class="fa fa-share-alt"></i><span class="menu-title">Loan Matrix</span></a></li>
                    <li <?php echo $manage_user_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/users"><i class="fa fa-users"></i><span class="menu-title">Manage User</span></a></li>
                    <li <?php echo $prepaid_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/prepaid-plan"><i class="icon icon-screen-smartphone"></i><span class="menu-title">Prepaid Plan</span></a></li>
                    <li <?php echo $tax_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/sales-tax"><i class="icon icon-calculator"></i><span class="menu-title">Sales Tax</span></a></li>
                    <li <?php echo $report_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/end-of-day-report.php"><i class="fa fa-clipboard"></i><span class="menu-title">End of Day Report</span></a></li>
                    <li <?php echo $monthly_report_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/monthly-report"><i class="fa fa-file-text"></i><span class="menu-title">Monthly Report</span></a></li>
                    <li <?php echo $balance_sheet_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/balance-sheet-report"><i class="fa fa-book"></i><span class="menu-title">Balance Sheet Report</span></a></li>
                 
					<li <?php echo $message_class; ?>><a href=""><i class="fa fa-envelope-o"></i><span class="menu-title">Add New Message & Rule</span></a>
						<ul class="children">
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/message-options?transaction=generalPawns">General Pawns</a></li>
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/message-options?transaction=titlePawns">Title Pawns</a></li>
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/message-options?transaction=rto">RTO</a></li>
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/message-options?transaction=layaway">Layaway</a></li>
                           
                        </ul>
					</li>
					<li <?php echo $time_class; ?>><a href="<?php echo ROOT . VERSION; ?>/admin/time-clock"><i class="fa fa-clock-o"></i><span class="menu-title">Time Clock</span></a></li>
                    <li <?php echo $misc_class; ?>><a href=""><i class="fa fa-gear"></i> <span>Miscelaneous</span></a>
                        <ul class="children">
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/allow-partial.php">Allow Partial Payment</a></li>
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/view-void-transactions.php">View Void Transactions</a></li>
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/forfeit.php">Forfiet Days</a></li>
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/scrap-metal-settings.php">Scrap Metal Settings</a></li>
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/lien-holder.php">Lien Holder Info</a></li>
                            <li><a href="<?php echo ROOT . VERSION; ?>/admin/layaway-settings.php">Layaway Settings</a></li>
                        </ul>
                    </li>
                <?php }else{?>

                <li <?php echo $collection_class; ?>><a href="collections"><i class="icon icon-social-dropbox"></i><span class="menu-title">Collections</span></a></li>
                <?php if($customer_page == 1){?>
                    <li <?php echo $customer_class; ?>><a href="#"><i class="fa fa-users"></i>Customers</span></a>
                        <ul class="children">
                            <li><a href="view-customer">View Customer</a></li>
                            <li><a href="add-customer">Add Customer</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if($general_page == 1){?>
                    <li <?php echo $pawn_class; ?>><a href="#"><i class="fa fa-dollar"></i><span class="menu-title">General Pawns</span></a>
                        <ul class="children">
                            <li><a href="view-pawns">View Pawns</a></li>
                            <li><a href="add-pawn">Add New Pawn</a></li>
                            <li><a href="take-payment">Take Payment</a></li>
							<li><a href="forfeited-pawns">Forfeited Pawns</a></li>
							
                        </ul>
                    </li>
                <?php } ?>
                <?php if($title_page == 1){?>
                    <li <?php echo $title_pawn_class; ?>><a href="#"><i class="fa fa-file-text"></i><span class="menu-title">Title Pawns</span></a>
                        <ul class="children">
                            <li><a href="view-title-pawns">View Title Pawns</a></li>
                            <li><a href="add-title-pawn">Add Title Pawn</a></li>
                            <li><a href="take-payment-title">Take Payment</a></li>
                            <li><a href="out-of-repossession">Out of Repoossession</a></li>
                            <li><a href="repoed">Repoed – In/Out</a></li>
                            <li><a href="vehicle-inventory">Vehicle Inventory</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if($scrap_page == 1){?>
                    <li <?php echo $scrap_class; ?>><a href="#"><i class="icon icon-diamond"></i><span class="menu-title">Scrap & Precious Metals</span></a>
                        <ul class="children">
                            <li><a href="scrap-buying">New Purchase</a></li>
                            <li><a href="scrap-on-hold">Scrap On Hold</a></li>
                            <li><a href="scrap-current-inventory">Current Inventory</a></li>
                            <li><a href="scrap-awaiting-melting">Scrap Awaiting Melting</a></li>
                            <li><a href="scrap-value-calculator">Scrap Value Calculator</a></li>
                        </ul>
                    </li>

                <?php } ?>
                <?php if($repair_page == 1){?>
                    <li <?php echo $repair_class; ?>><a href="#"><i class="fa fa-wrench"></i><span class="menu-title">Repair Orders</span></a>
                        <ul class="children">
                            <li><a href="view-edit-repair-orders">View/Edit Repair Orders</a></li>
                            <li><a href="new-repair-invoice">New Repair Order/Invoice</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if($refill_page == 1){?>
                    <li <?php echo $refill_class; ?>><a href="#"><i class="icon icon-screen-smartphone"></i><span class="menu-title">Prepaid Refills</span></a>
                        <ul class="children"><li><a href="view-pins">View Recent Pin Sales</a></li>
                            <li><a href="new-refill">New Refill / Pin Sale</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if($rto_page == 1){?>
                    <li <?php echo $rto_class; ?>>
                        <a href="#"><i class="icon icon-briefcase"></i><span class="menu-title">Rent To Own</span></a>
                        <ul class="children">
                            <li><a href="view-rto-agreements">View RTO Agreements</a></li>
                            <li><a href="rent-to-own">Add New RTO Agreement</a></li>
                            <li><a href="rto-payment">Take RTO Payment</a></li>
                        </ul>
                    </li>
                <?php } ?>

                    <?php if($layaway_page == 1){?>
                        <li <?php echo $layaway_class; ?>>
                            <a href="#"><i class="fa fa-exchange"></i><span class="menu-title">LayAway</span></a>
                            <ul class="children">
                                <li><a href="view-layaway-agreement">View Layaway Agreements</a></li>
                                <li><a href="add-layaway">Add Layaway Agreement</a></li>
                                <li><a href="layaway-payment">Take Layaway Payment</a></li>
                                <li><a href="inactive-layaway">Inactive Layaway</a></li>

                            </ul>
                        </li>
                    <?php } ?>

                <?php if($inventory_page == 1){?>
                    <li <?php echo $inventory_class; ?>>
                        <a href="#"><i class="fa fa-database"></i><span class="menu-title">Inventory Management</span></a>
                        <ul class="children">
                            <li><a href="view-inventory">View Inventory</a></li>
                            <li><a href="add-inventory">Add Inventory</a></li>
                        </ul>
                    </li>

                <?php } ?>

                <?php if($outright_page == 1){?>
                    <li <?php echo $outright_class; ?>><a href="buy-item-outright"><i class="fa fa-shopping-cart"></i><span class="menu-title">Buy Item Outright</span></a></li>
                <?php } ?>

                <?php if($pos_page == 1){?>
                    <li <?php echo $pos_class; ?>><a href="point-of-sale"><i class="fa fa-file-text-o"></i><span class="menu-title">Point of Sale</span></a>

                    </li>
                <?php } ?>
                <?php if($check_page == 1){?>
                    <li <?php echo $check_class; ?>><a href="#"><i class="fa fa-list-alt"></i><span class="menu-title">Check Register</span></a>
                        <ul class="children">
                            <li><a href="view-check-register">View Check Register</a></li>
                            <li><a href="new-check">Print New Check</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if($petty_page == 1){?>
                    <li <?php echo $petty_class; ?>><a href="petty-cash-ledger"><i class="fa fa-money"></i><span class="menu-title">Petty Cash Ledger</span></a></li>
                <?php }?>
                <?php if($void_page == 1){?>
                    <li <?php echo $void_class; ?>><a href="void-transaction"><i class="fa fa-ban"></i><span class="menu-title">Void Transaction</span></a></li>

                <?php }} ?>
            </ul>

        </div><!-- leftpanel -->
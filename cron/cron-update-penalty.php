<?php 
//require '/home/cashmax229/public_html/Model/Init.php';
//require '/home/cashmax229/public_html/Model/Admin.php';
require '../Model/Init.php';
require SERVER_ROOT . '/includes/require.php';

$adminClass = new Admin();
$employeeClass = new Employee();

$date = date('Y-m-d');

$pawns = $adminClass->getGeneralPawns();
$titlePawns = $adminClass->getTitlePawns();
$layaway = $adminClass->getLayaway();



foreach($pawns as $row){
	if($row['due_date'] <= $date){
		if($row['occur_late_fees']  == 'daily'){
			$date1 = date_create(date('Y-m-d'));
			$date2 = date_create($row['due_date']);
			$diff = date_diff($date1, $date2);
			$days = $diff->format("%a");
			
			$interestDaily = $row['interest_accured'] / 30;
			$penalty = $days * $interestDaily;
			
		}else{
			$penalty = $row['interest_accured'];
		}
		$adminClass->updateLoanPenalty($row['loan_info_id'], $penalty, 'general');
		echo $row['first_name'] . ' - ' . $penalty . ' | ' . $row['occur_late_fees'] . ' ' . $interestDaily  . ' x ' . $days . '<br>';
	}
}

foreach($titlePawns as $row){
	if($row['due_date'] <= $date){
		if($row['occur_late_fees']  == 'daily'){
			$date1 = date_create(date('Y-m-d'));
			$date2 = date_create($row['due_date']);
			$diff = date_diff($date1, $date2);
			$days = $diff->format("%a");
			
			$interestDaily = $row['interest_accured'] / 30;
			$penalty = $days * $interestDaily;
			
			
		}else{
			$penalty = $row['interest_accured'];
		}
		$adminClass->updateLoanPenalty($row['tittle_pawn_id'], $penalty, 'title');
		
		echo $row['first_name'] . ' - ' . $penalty . ' | ' . $row['occur_late_fees'] . ' ' . $interestDaily  . ' x ' . $days . '<br>';
		
	}
}

foreach($layaway as $row){
    $date_due = date('Y-m-d', strtotime($row['due_date'] . '+ ' . $row['grace_period'] . ' days'));
    $date_now = date('Y-m-d');

    if($date_now >= $date_due){
        $items = $employeeClass->getCustomerLayawayItems($row['customer_id'], $row['lid']);
        $response = $adminClass->updateLayawayNotComplete($row['lid']);
    }
}


?>
<?php
require '../Model/Init.php';
require SERVER_ROOT_MAIN . '/includes/require.php';


require 'vendor/autoload.php';
use Plivo\RestAPI;
$auth_id = "MAZDVKZTHIMDYYNWQXYT";
$auth_token = "NThkNTY1ZmY4Nzk2NjRhMGYxNzYwZWYwNWMyMGE2";

$p = new RestAPI($auth_id, $auth_token);
$systemClass = new CompanySystem();
$databases = $systemClass->getDatabases();
$dateNow = date('Y-m-d');
	

foreach($databases as $db){
	//$systemClass->useDb($db['db']);
	//$preMessageNotifications[] = $systemClass->getMessageNotification($db['db'], 'preNotification');
	$generalPawnsPreDueDateNotification[] = array($db['db'] => $systemClass->getMessageNotification($db['db'], 'preNotification', 'generalPawns'), 'company' => $db['company'], 'companyId' => $db['cuid']); 
	$generalPawnsDueDateNotification[] = array($db['db'] => $systemClass->getMessageNotification($db['db'], 'onNotification', 'generalPawns'), 'company' => $db['company'], 'companyId' => $db['cuid']); 
	$generalPawnsPostDueDateNotification[] = array($db['db'] => $systemClass->getMessageNotification($db['db'], 'postNotification', 'generalPawns'), 'company' => $db['company'], 'companyId' => $db['cuid']); 
	
	$titlePawnsPreDueDateNotification[] = array($db['db'] => $systemClass->getMessageNotification($db['db'], 'preNotification', 'titlePawns'), 'company' => $db['company'], 'companyId' => $db['cuid']); 
	$titlePawnsDueDateNotification[] = array($db['db'] => $systemClass->getMessageNotification($db['db'], 'onNotification', 'titlePawns'), 'company' => $db['company'], 'companyId' => $db['cuid']); 
	$titlePawnsPostDueDateNotification[] = array($db['db'] => $systemClass->getMessageNotification($db['db'], 'postNotification', 'titlePawns'), 'company' => $db['company'], 'companyId' => $db['cuid']); 
								   
									
//	$systemClass->closeDb(); 
}

foreach($generalPawnsDueDateNotification as $row => $key){
	foreach($key as $value => $data){
			$arrKeys = array_keys($key); 
			$db = $arrKeys[0];
			$company = $key['company'];
			$companyId = $key['companyId'];
		if(isset($data[0]['active'])){
			if($data[0]['active'] == 1){
				
				$generalPawnsDueDate = $systemClass->getGeneralPawns($dateNow, $db);
				
				
				foreach($generalPawnsDueDate as $row){
					$customerName = $row['first_name'] . ' ' . $row['last_name'];
					$amountDue = '$' . number_format($row['total_loan'],2);
					$due = date('m/d/Y', strtotime($row['due_date']));
					$dst = $row['cell_no'];
					$string = array('{name}', '{amount}', '{dueDate}');
					$replace = array($customerName, $amountDue, $due);
					$txt = str_replace($string, $replace, $data[0]['message']);
					echo $customerName . ' ' . $due . ' ' . $dateNow . ' ' . $data[0]['days'] .  ' ' . $data[0]['type'] . ' ' . $company . '<br>';
					$response[] = $systemClass->sendMessage($p, $dst, $txt, $companyId, $company, $db, $customerName); 
				}
					
			
			}
	//	echo '<pre>' , var_dump($data[0]['days']) , '</pre>';
		}
	}
}

foreach($generalPawnsPreDueDateNotification as $row => $key){
	foreach($key as $value => $data){
			$arrKeys = array_keys($key); 
			$db = $arrKeys[0];
			$company = $key['company'];
			$companyId = $key['companyId'];
		if(isset($data[0]['active'])){
			if($data[0]['active'] == 1){
				
					$preDate = date('Y-m-d', strtotime($dateNow . '+' . $data[0]['days'] . ' days'));
					$generalPrePawnsDueDate = $systemClass->getGeneralPawns($preDate, $db);
					foreach($generalPrePawnsDueDate as $row){
					$customerName = $row['first_name'] . ' ' . $row['last_name'];
					$amountDue = '$' . number_format($row['total_loan'],2);
					$due = date('m/d/Y', strtotime($row['due_date']));
					$dst = $row['cell_no'];
					$string = array('{name}', '{amount}', '{dueDate}');
					$replace = array($customerName, $amountDue, $due);
					$txt = str_replace($string, $replace, $data[0]['message']);
					echo $customerName . ' ' . $due . ' ' . $dateNow . ' ' . $data[0]['days'] .  ' ' . $data[0]['type'] . ' ' . $company . '<br>';
					$response[] = $systemClass->sendMessage($p, $dst, $txt, $companyId, $company, $db, $customerName); 
					}
						
			}
	//	echo '<pre>' , var_dump($data[0]['days']) , '</pre>';
		}
	}
	
	
}

foreach($generalPawnsPostDueDateNotification as $row => $key){ 
	foreach($key as $value => $data){
			$arrKeys = array_keys($key); 
			$db = $arrKeys[0];
			$company = $key['company'];
			$companyId = $key['companyId'];
		if(isset($data[0]['active'])){
			if($data[0]['active'] == 1){
				
					$postDate = date('Y-m-d', strtotime($dateNow . '-' . $data[0]['days'] . ' days'));
					$generalPrePawnsDueDate = $systemClass->getGeneralPawns($postDate, $db);
					foreach($generalPrePawnsDueDate as $row){
					$customerName = $row['first_name'] . ' ' . $row['last_name'];
					$amountDue = '$' . number_format($row['total_loan'],2);
					$due = date('m/d/Y', strtotime($row['due_date']));
					$dst = $row['cell_no'];
					$string = array('{name}', '{amount}', '{dueDate}');
					$replace = array($customerName, $amountDue, $due);
					$txt = str_replace($string, $replace, $data[0]['message']);
					echo $customerName . ' ' . $due . ' ' . $dateNow . ' ' . $data[0]['days'] .  ' ' . $data[0]['type'] . ' ' . $company . '<br>';
					$response[] = $systemClass->sendMessage($p, $dst, $txt, $companyId, $company, $db, $customerName); 
					}
						
			}
	//	echo '<pre>' , var_dump($data[0]['days']) , '</pre>';
		}
	}
}


foreach($titlePawnsDueDateNotification as $row => $key){
	foreach($key as $value => $data){
			$arrKeys = array_keys($key); 
			$db = $arrKeys[0];
			$company = $key['company'];
			$companyId = $key['companyId'];
		if(isset($data[0]['active'])){
			if($data[0]['active'] == 1){
				
	
				$titlePawnsDueDate = $systemClass->getTitlePawns($dateNow, $db);
				
				foreach($titlePawnsDueDate as $row){
					$customerName = $row['first_name'] . ' ' . $row['last_name'];
					$amountDue = '$' . number_format($row['total_loan'],2);
					$due = date('m/d/Y', strtotime($row['due_date']));
					$dst = $row['cell_no'];
					$string = array('{name}', '{amount}', '{dueDate}');
					$replace = array($customerName, $amountDue, $due);
					$txt = str_replace($string, $replace, $data[0]['message']);
					echo $customerName . ' ' . $due . ' ' . $dateNow . ' ' . $data[0]['days'] .  ' ' . $data[0]['type'] . ' ' . $company . '<br>';
					$response[] = $systemClass->sendMessage($p, $dst, $txt, $companyId, $company, $db, $customerName); 
				}
					
			
			}
	//	echo '<pre>' , var_dump($data[0]['days']) , '</pre>';
		}
	}
}

foreach($titlePawnsPreDueDateNotification as $row => $key){
	foreach($key as $value => $data){
		$arrKeys = array_keys($key); 
			$db = $arrKeys[0];
			$company = $key['company'];
			$companyId = $key['companyId'];
		if(isset($data[0]['active'])){
			if($data[0]['active'] == 1){
					$preDate = date('Y-m-d', strtotime($dateNow . '+' . $data[0]['days'] . ' days'));
					$titlePrePawnsDueDate = $systemClass->getGeneralPawns($preDate, $db);
					foreach($titlePrePawnsDueDate as $row){
					$customerName = $row['first_name'] . ' ' . $row['last_name'];
					$amountDue = '$' . number_format($row['total_loan'],2);
					$due = date('m/d/Y', strtotime($row['due_date']));
					$dst = $row['cell_no'];
					$string = array('{name}', '{amount}', '{dueDate}');
					$replace = array($customerName, $amountDue, $due);
					$txt = str_replace($string, $replace, $data[0]['message']);
					echo $customerName . ' ' . $due . ' ' . $dateNow . ' ' . $data[0]['days'] .  ' ' . $data[0]['type'] . ' ' . $company . '<br>';
					$response[] = $systemClass->sendMessage($p, $dst, $txt, $companyId, $company, $db, $customerName); 
					}
						
			}
	//	echo '<pre>' , var_dump($data[0]['days']) , '</pre>';
		}
	}
} 

foreach($titlePawnsPostDueDateNotification as $row => $key){
	foreach($key as $value => $data){
		$arrKeys = array_keys($key); 
			$db = $arrKeys[0];
			$company = $key['company'];
			$companyId = $key['companyId'];
		if(isset($data[0]['active'])){
			if($data[0]['active'] == 1){
				
					$postDate = date('Y-m-d', strtotime($dateNow . '-' . $data[0]['days'] . ' days'));
					$titlePrePawnsDueDate = $systemClass->getGeneralPawns($postDate, $value);
					foreach($titlePrePawnsDueDate as $row){
					$customerName = $row['first_name'] . ' ' . $row['last_name'];
					$amountDue = '$' . number_format($row['total_loan'],2);
					$due = date('m/d/Y', strtotime($row['due_date']));
					$dst = $row['cell_no'];
					$string = array('{name}', '{amount}', '{dueDate}');
					$replace = array($customerName, $amountDue, $due);
					$txt = str_replace($string, $replace, $data[0]['message']);
					echo $customerName . ' ' . $due . ' ' . $dateNow . ' ' . $data[0]['days'] .  ' ' . $data[0]['type'] . ' ' . $company . '<br>';
					$response[] = $systemClass->sendMessage($p, $dst, $txt, $companyId, $company, $db, $customerName); 
					}
						
			} 
	//	echo '<pre>' , var_dump($data[0]['days']) , '</pre>';
		}
	}
}

//echo '<pre>' , var_dump($data) , '</pre>';

?>
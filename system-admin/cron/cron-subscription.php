<?php
require '../Model/Init.php';
require SERVER_ROOT_MAIN . '/includes/require.php';

$systemClass = new CompanySystem();
$userClass = new CompanyUsers();
$databases = $systemClass->getDatabases();
$prevMonth = date('Y-m', strtotime('-1 month'));
$chargePerMessage = 0.6;
foreach($databases as $db){
	$messagesCount[] = array($db['cuid'] => $systemClass->getMessagesCountByMonth($db['cuid'], $prevMonth)); 
}

foreach($messagesCount as $row => $key){
	foreach($key as $value => $data){
		if($data != 0){
			$messageFee = $data * $chargePerMessage;
			$systemClass->addMessageFee($value, 'Messages Charge', $messageFee);
		}
		
		
	}
}



?>
<?php
/**
 * Created by PhpStorm.
 * User: Grabe Grabe
 * Date: 8/9/2016
 * Time: 10:39 PM
 */

class CompanySystem {
	
	public $debug = TRUE;
	protected $db_pdo;
	protected $change_db_pdo;
	

    public function makeHash($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = '6f36a4b004fd3198dd1490311e300c94';
        $secret_iv = '33651529664930d3';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
	
	
	public function getGeneralPawns($date, $db){ 
		
        $pdo = $this->changePdo($db);
        $sql = 'SELECT customer_tbl.*, loan_info_tbl.*, loan_matrix_tbl.* FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
                WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.status = "active" AND loan_info_tbl.due_date = "' . $date . '" ORDER BY loan_info_tbl.date_added DESC
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	
	public function getTitlePawns($date, $db)
	{
		$pdo = $this->changePdo($db);
		$sql = 'SELECT customer_tbl.*, loan_matrix_tbl.title, loan_matrix_tbl.terms_of_loan, loan_matrix_tbl.rate_first,loan_matrix_tbl.rate_second, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.color, title_pawn_tbl.mileage, title_pawn_tbl.no_of_doors, title_pawn_tbl.vehicle_condition, title_pawn_tbl.title_no, title_pawn_tbl.tag_no, title_pawn_tbl.total_loan_amount, title_pawn_tbl.retail, title_pawn_tbl.total_loan, title_pawn_tbl.interest_rate, title_pawn_tbl.apr, title_pawn_tbl.terms_of_loan, title_pawn_tbl.date_added, title_pawn_tbl.due_date, title_pawn_tbl.interest_accured, title_pawn_tbl.exempt, title_pawn_tbl.make, title_pawn_tbl.style, title_pawn_tbl.penalty, title_pawn_tbl.amount_behalf
			    FROM `customer_tbl`, `loan_matrix_tbl`, title_pawn_tbl
				WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id AND title_pawn_tbl.due_date = "' . $date . '"';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	

	public function getMessageNotification($db, $type, $transaction){ 
		
        $pdo = $this->changePdo($db);
        $sql = 'SELECT * FROM `message_options` WHERE `type` = "' . $type . '" AND `transaction` = "' . $transaction . '"';
 

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	public function sendMessage($p, $dst, $txt, $companyId, $company, $db, $customer_name){
		$params = array(
		'src' => '+639072529211', // Sender's phone number with country code
		'dst' => $dst, // Receiver's phone number with country code
		'text' => $txt, // Your SMS text message
		// To send Unicode text
		//'text' => 'こんにちは、元気ですか？' # Your SMS Text Message - Japanese
		//'text' => 'Ce est texte généré aléatoirement' # Your SMS Text Message - French
		'url' => 'http://example.com/report/', // The URL to which with the status of the message is sent
		'method' => 'POST' // The method used to call the url
			);
			// Send message
			$response = $p->send_message($params);
			 
			if($response['status'] == 202){
				$this->auditMessages($companyId, $company, $db, $dst, $customer_name);
			}

			// Print the response
			$returnResponse ='';
			$returnResponse .= "Response : ";
			$returnResponse .= print_r($response['response']);

			// Print the Api ID
			$returnResponse .= "<br> Api ID : {$response['response']['api_id']} <br>";

			// Print the Message UUID
			$returnResponse .= "Message UUID : {$response['response']['message_uuid'][0]} <br>";
			
			return $returnResponse; 
	}
	
	public function auditMessages($cuid, $company, $db, $dst, $customer_name){
	
		$time = time();
		$date = date('Y-m-d');
		$pdo = $this->getPdo();
        $sql = 'INSERT INTO `audit_messages` (`cuid`, `company`, `database`, `customer_cell_no`, `customer_name`, `date_sent`, `date`)
				VALUES ("' . $cuid . '", "' . $company . '", "' . $db . '", "' . $dst . '", "' . $customer_name . '", "' . $time . '", "' . $date . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
	}
	
	
	public function getDatabases(){
        $pdo = $this->getPdo();
        $sql = 'SELECT `cuid`, `db`, `company` FROM `company_user` WHERE `db` != "pawnshop_db_main"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
   
	}
	
	
	public function getMessagesCountByMonth($companyId, $date){
		$pdo = $this->getPdo();
        $sql = 'SELECT `aMid` FROM `audit_messages` WHERE `cuid` = ' . $companyId . ' AND `date` LIKE "' . $date . '%"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
	}
	
	
	public function updateFee($transaction){
		$date = date('Y-m-d');
		$lastDayOfMoth = date('Y-m-t');
		$midDate = date('Y-m-d', strtotime($lastDayOfMoth . '-15 days'));
		if($date == $midDate){
			$fee = $_POST['fee'] / 2;
		}else if($date > $midDate){
			if($date < $lastDayOfMoth){
				$fee = $_POST['fee'] / 2;
			}
		}else{
			$fee = $_POST['fee'];
		}
		if($_POST['feeType'] == 'add'){
			
			$sql = 'INSERT INTO `subscription` (`cuid`, `transaction`, `period`, `fee`)
					VALUES (' . $_POST['cuid'] . ', "' . $transaction . '", "' . $date . '" , "' . $fee . '")';
		}else{
			$sql = 'UPDATE `subscription` SET `fee` = "' . $fee . '" WHERE `cuid` = ' . $_POST['cuid'] . '';
	}

		
		try{
			 $pdo = $this->getPdo();
			 $stmt = $pdo->prepare($sql);
			 $stmt->execute();
			 $location = $_SERVER['PHP_SELF'] .'?success=true&msg=' . $_POST['company']. ' successfully updated';
        }catch (Exception $e){
               $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
			  
        } 

        header('Location: ' . $location . '');
	}
	
			
	public function addMessageFee($cuid, $transaction, $fee){
		$date = date('Y-m-d-');
			 $pdo = $this->getPdo();
			 $sql = 'INSERT INTO `subscription` (`cuid`, `transaction`, `period`, `fee`)
					VALUES (' . $cuid . ', "' . $transaction . '", "' . $date . '" , "' . $fee . '")';
			 $stmt = $pdo->prepare($sql);
			 $stmt->execute();
	}
		
	
	 /*
     * Database functions
     */
	 
	 public function useDB($db){
        $pdo = $this->getPdo();
        $sql = "USE $db";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }
	
	public function useChangeDB($db){
        $pdo = $this->changePdo($db);
        $sql = "USE $db";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
		
		return $pdo;

    }
	
	public function closeDb(){
		$pdo = $this->getPdo();
		$pdo = null;
	}


    public function pdoQuoteValue($value)
	{
		$pdo = $this->getPdo();
		return $pdo->quote($value);
	}


	
	public function getPdo()
	{
		if (!$this->db_pdo)
		{
			if ($this->debug)
			{
				$this->db_pdo = new PDO(DB_DSN_MAIN, DB_USER_MAIN, DB_PWD_MAIN, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			}
			else
			{
				$this->db_pdo = new PDO(DB_DSN_MAIN, DB_USER_MAIN, DB_PWD_MAIN);
			}
		}
		return $this->db_pdo;
	}
	
	public function changePdo($db)
	{	
			try{
				 $db = new PDO('mysql:dbname=' . $db .';host=localhost', 'cashmax229', 'Pawn4223626');
			}
			catch (PDOException $ex) {
			  $db = 'Connection failed: ' . $ex->getMessage();
			}
			
			return $db;
	}

}
<?php
/**
 * Created by PhpStorm.
 * User: Grabe Grabe
 * Date: 3/4/2016
 * Time: 9:25 AM
 */

class Miscellaneous {

    public $debug = TRUE;
    protected $db_pdo;


    public function getPawnCount()
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `loan_info_tbl`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function getTitlePawnCount()
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `title_pawn_tbl`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function getPawnSum(){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(loan_amount) as totalPawns FROM `loan_info_tbl` WHERE `status` = "active"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPawns = $result['totalPawns'];

        return $totalPawns;
    }

    public function getTitlePawnSum(){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(total_loan_amount) as totalTitlePawns FROM `title_pawn_tbl` WHERE `status` = "active"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalTitlePawns = $result['totalTitlePawns'];

        return $totalTitlePawns;
    }

    public function getPawnInterestAccuredSum()
    {

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(interest_accured) as totalInterestAccured FROM `loan_info_tbl` WHERE `status` = "active"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalInterestAccured = $result['totalInterestAccured'];

        return $totalInterestAccured;
    }

    public function getTitlePawnInterestAccuredSum()
    {

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(interest_accured) as totalTitleInterestAccured FROM `title_pawn_tbl` WHERE `status` = "active"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalTitleInterestAccured = $result['totalTitleInterestAccured'];

        return $totalTitleInterestAccured;
    }

    public function getPastDuePawns(){

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d', strtotime('+5 days'));
        /*
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime2->diff($datetime1);
        $date_diff = $interval->format('%a');
        */
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, loan_info_tbl.*, loan_info_tbl.due_date, loan_matrix_tbl.*
			    FROM `customer_tbl`, `loan_matrix_tbl`, `loan_info_tbl`
				WHERE  loan_info_tbl.status = "active" AND loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND (loan_info_tbl.due_date <= "' . $date1 . '" OR loan_info_tbl.due_date <= "' . $date2 . '")
				ORDER BY loan_info_tbl.due_date DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getPastDueTitlePawns(){

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d', strtotime('+5 days'));
        /*
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime2->diff($datetime1);
        $date_diff = $interval->format('%a');
        */
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, title_pawn_tbl.*, loan_matrix_tbl.*
			    FROM `customer_tbl`, `loan_matrix_tbl`, `title_pawn_tbl`
				WHERE  title_pawn_tbl.status = "active" AND title_pawn_tbl.customer_id = customer_tbl.customer_id AND title_pawn_tbl.loan_matrix_id = loan_matrix_tbl.id AND (title_pawn_tbl.due_date <= "' . $date1 . '" OR title_pawn_tbl.due_date <= "' . $date2 . '")
				ORDER BY title_pawn_tbl.due_date DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }
	
	public function getPastDuePawnsCol(){

        $date = date('Y-m-d');
    
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, loan_info_tbl.*, loan_info_tbl.due_date, loan_matrix_tbl.*
			    FROM `customer_tbl`, `loan_matrix_tbl`, `loan_info_tbl`
				WHERE  (loan_info_tbl.status = "active" OR loan_info_tbl.status = "collection")  AND loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.due_date <= "' . $date . '"
				ORDER BY loan_info_tbl.due_date DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }
	
	

    public function getPastDueTitlePawnsCol(){

        $date = date('Y-m-d');
       
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, title_pawn_tbl.*, loan_matrix_tbl.*
			    FROM `customer_tbl`, `loan_matrix_tbl`, `title_pawn_tbl`
				WHERE  (title_pawn_tbl.status = "active" OR title_pawn_tbl.status = "collection") AND title_pawn_tbl.customer_id = customer_tbl.customer_id AND title_pawn_tbl.loan_matrix_id = loan_matrix_tbl.id AND title_pawn_tbl.due_date <= "' . $date . '"
				ORDER BY title_pawn_tbl.due_date DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getPettyCashByDate($from, $to){
		
		
		
			$pdo = $this->getPdo();
            $sql = 'SELECT * FROM `petty_cash_tbl`
				    WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '" ORDER BY `petty_cash_id` DESC
				';


            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $content = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $content[] = $row;
            }
            return $content;
			
            
    }



    // Add


    public function addPettyCash(){

        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $amount = str_replace(',','', '' . $amount . '');
        $type = $_POST['type'];
        $date = date('Y-m-d');
        $imgFile = '';
        $imgData = '';

        if(isset($_FILES['image']['tmp_name'])) {
            if (is_uploaded_file($_FILES['image']['tmp_name']) && getimagesize($_FILES['image']['tmp_name']) != false) {
                $imgFile = addslashes($_FILES['image']['name']);
                $imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            }
        }


        try{
            $pdo = $this->getPdo();
            $sql = 'INSERT INTO `petty_cash_tbl` (`description`, `amount`, `type`, `image`, `image_name`, `date_added`) VALUES ("' . $description . '", ' . $amount . ', "' . $type . '", "' . $imgData . '","' . $imgFile . '", "' . $date . '")';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Petty cash successfully added.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');






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
                $this->db_pdo = new PDO(DB_DSN, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            }
            else
            {
                $this->db_pdo = new PDO(DB_DSN, DB_USER, DB_PWD);
            }
        }
        return $this->db_pdo;
    }


}
<?php
// PHP and MySQL Project
// Admin Class

class Admin Extends System
{
	public $debug = TRUE;
	protected $db_pdo;
	
	
	public function getLoanMatrix()
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `loan_matrix_tbl`';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}


    public function getSalesTax()
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `sales_tax_tbl`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	public function getLayawaySettings()
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `layaway_settings`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getGeneralPawns(){
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, loan_info_tbl.*, loan_matrix_tbl.* FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
                WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.status = "active" ORDER BY loan_info_tbl.date_added DESC
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getTitlePawns(){
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, title_pawn_tbl.*, loan_matrix_tbl.* FROM `customer_tbl`, `title_pawn_tbl`, `loan_matrix_tbl`
                WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND title_pawn_tbl.loan_matrix_id = loan_matrix_tbl.id AND title_pawn_tbl.status = "active" ORDER BY title_pawn_tbl.date_added DESC
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getLayaway(){
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, layaway_tbl.* FROM `customer_tbl`, `layaway_tbl`
                WHERE layaway_tbl.customer_id = customer_tbl.customer_id
                AND layaway_tbl.status = "active" ORDER BY layaway_tbl.date_added DESC
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }




    public function getGeneralPawnsByDay($date){

    $pdo = $this->getPdo();
    $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.loan_amount, loan_info_tbl.status, loan_matrix_tbl.title
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.date_added = "' . $date . '" AND loan_info_tbl.status != "void"
				';


    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $content = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $content[] = $row;
    }
    return $content;
}

 public function getForfeitedGeneralPawnsByDay($date){ 

    $pdo = $this->getPdo();
    $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.loan_amount, loan_info_tbl.status, loan_matrix_tbl.title
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.date_forfeited = "' . $date . '" AND loan_info_tbl.status = "unredeemed"
				';


    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $content = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $content[] = $row;
    }
    return $content;
}
    public function getGeneralPawnsPaymentByDay($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.due_date, loan_info_tbl.loan_amount, loan_info_tbl.interest_accured, loan_matrix_tbl.title, payment_tbl.total_amount, payment_tbl.date_added as datePaid, payment_tbl.transaction_id, payment_tbl.status, payment_tbl.payment_id
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`, `payment_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id
				AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id
				AND loan_info_tbl.loan_info_id = payment_tbl.transaction_id
				AND payment_tbl.date_added = "' . $date . '"
                AND payment_tbl.status != "void"
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getGeneralPawnsByDayTotalSum($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(loan_amount) as totalPawns FROM `loan_info_tbl` WHERE `date_added` = "' . $date . '" AND loan_info_tbl.status != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPawns = $result['totalPawns'];

        return $totalPawns;
    }


    public function getTitlePawnsByDay($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, title_pawn_tbl.tittle_pawn_id, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.title_no, title_pawn_tbl.retail, title_pawn_tbl.total_loan_amount, title_pawn_tbl.status, loan_matrix_tbl.title
				FROM `customer_tbl`, `title_pawn_tbl`, `loan_matrix_tbl`
				WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id AND title_pawn_tbl.date_added = "' . $date . '" AND title_pawn_tbl.status != "void"
				GROUP BY title_pawn_tbl.tittle_pawn_id';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getTitlePawnsPaymentByDay($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, title_pawn_tbl.tittle_pawn_id, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.title_no, title_pawn_tbl.retail, title_pawn_tbl.total_loan_amount, title_pawn_tbl.status, title_pawn_tbl.interest_accured, title_pawn_tbl.due_date, loan_matrix_tbl.title,payment_tbl.total_amount, payment_tbl.date_added as datePaid, payment_tbl.transaction_id, payment_tbl.status, payment_tbl.payment_id
				FROM `customer_tbl`, `title_pawn_tbl`, `loan_matrix_tbl`, `payment_tbl`
				WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id
				AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id
				AND title_pawn_tbl.tittle_pawn_id = payment_tbl.transaction_id
				AND payment_tbl.date_added = "' . $date . '"
                AND payment_tbl.status != "void"';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }



    public function getTitlePawnsByDayTotalSum($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(total_loan_amount) as totalTitlePawns FROM `title_pawn_tbl` WHERE `date_added` = "' . $date . '" AND title_pawn_tbl.status != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalTitlePawns = $result['totalTitlePawns'];

        return $totalTitlePawns;
    }

    public function getTakePaymentSalesByDay($date, $transaction){

        if($transaction == 'loan_info_tbl'){
            $id = 'loan_info_id';
            $status = 'status';
        }
        else if($transaction == 'title_pawn_tbl'){
            $id = 'tittle_pawn_id';
            $status = 'status';
        }
        else if($transaction == 'repair_invoice_tbl'){
            $id = 'repair_invoice_id';
            $status = 'invoice_status';
        }
        else if($transaction == 'refill_tbl'){
            $id = 'refill_id';
            $status = 'status';
        }
        else if($transaction == 'rto_tbl'){
            $id = 'rto_id';
            $status = 'status';
        }
		else if($transaction == 'layaway_tbl'){
            $id = 'lid';
            $status = 'status';
        }
        else {
            null;
        }
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, payment_tbl.total_amount, payment_tbl.payment_method, payment_tbl.transaction_id, payment_tbl.transaction, payment_tbl.payment_id, ' . $transaction . '.' . $status .'
				FROM `customer_tbl`, `payment_tbl`, `' . $transaction . '`
				WHERE payment_tbl.customer_id = customer_tbl.customer_id AND payment_tbl.transaction = "' . $transaction . '" AND payment_tbl.date_added LIKE "' . $date . '%" AND ' . $transaction . '.customer_id = payment_tbl.customer_id AND payment_tbl.transaction_id = ' . $transaction . '.' . $id . ' AND ' . $transaction . '.' . $status . ' != "void" AND payment_tbl.status != "void"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;


    }

    public function getTakePaymentSalesByDayTotalSum($date, $transaction){


        if($transaction == 'loan_info_tbl'){
            $id = 'loan_info_id';
            $status = 'status';
        }
        else if($transaction == 'title_pawn_tbl'){
            $id = 'tittle_pawn_id';
            $status = 'status';
        }
        else if($transaction == 'repair_invoice_tbl'){
            $id = 'repair_invoice_id';
            $status = 'invoice_status';
        }
        else if($transaction == 'refill_tbl'){
            $id = 'refill_id';
            $status = 'status';
        }
        else if($transaction == 'rto_tbl'){
            $id = 'rto_id';
            $status = 'status';
        }
		else if($transaction == 'layaway_tbl'){
            $id = 'lid';
            $status = 'status';
        }
        else {
            null;
        }

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(total_amount) as totalPawnPayment FROM `payment_tbl`, `' . $transaction . '` WHERE `transaction` = "' . $transaction . '" AND payment_tbl.date_added LIKE "' . $date . '%" AND payment_tbl.transaction_id = ' . $transaction . '.' . $id . ' AND ' . $transaction . '.' . $status . ' != "void" AND payment_tbl.status != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPawnPayment = $result['totalPawnPayment'];

        return $totalPawnPayment;
    }

    public function getPointOfSaleByDay($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, point_of_sale_tbl.sale_id, point_of_sale_tbl.total, point_of_sale_tbl.payment, point_of_sale_tbl.status
				FROM `customer_tbl`, `point_of_sale_tbl`
				WHERE point_of_sale_tbl.customer_id = customer_tbl.customer_id AND point_of_sale_tbl.date_added = "' . $date . '" AND point_of_sale_tbl.status != "void"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getPointOfSaleByDayTotalSum($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(total) as totalPointOfSale FROM `point_of_sale_tbl` WHERE `date_added` = "' . $date . '" AND `status` != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPointOfSale = $result['totalPointOfSale'];

        return $totalPointOfSale;
    }


    public function getCashLoanedOutByDay($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_amount
				FROM `customer_tbl`, `loan_info_tbl`
				    WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.date_added = "' . $date . '"
				UNION
				SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, title_pawn_tbl.total_loan AS loan_amount
				FROM `customer_tbl`,`title_pawn_tbl`
				    WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND title_pawn_tbl.date_added = "' . $date . '"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getCashLoanedOutTotalSum($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(loan_amount) as totalLoan FROM `loan_info_tbl` WHERE `date_added` = "' . $date . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalLoan = $result['totalLoan'];

        return $totalLoan;
    }

    public function getCashLoanedOutTitleTotalSum($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(total_loan) as totalLoan FROM `title_pawn_tbl` WHERE `date_added` = "' . $date . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalLoan = $result['totalLoan'];

        return $totalLoan;
    }

    public function getCostOfGoodsByDay($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, outright_info_tbl.purchase_amount
				FROM `customer_tbl`, `outright_info_tbl`
				WHERE outright_info_tbl.customer_id = customer_tbl.customer_id AND outright_info_tbl.date_added = "' . $date . '"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCostOfGoodsTotalSum($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(purchase_amount) as purchaseAmount FROM `outright_info_tbl` WHERE `date_added` = "' . $date . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $purchaseAmount = $result['purchaseAmount'];

        return $purchaseAmount;
    }






    public function getScrapPurchaseByDay($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, scrap_info_tbl.amount_paid
				FROM `customer_tbl`, `scrap_info_tbl`
				WHERE scrap_info_tbl.customer_id = customer_tbl.customer_id AND scrap_info_tbl.date_added = "' . $date . '" AND scrap_info_tbl.status != "void"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getScrapPurchaseTotalSum($date){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(amount_paid) as purchaseAmount FROM `scrap_info_tbl` WHERE `date_added` = "' . $date . '" AND `status` != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $purchaseAmount = $result['purchaseAmount'];

        return $purchaseAmount;
    }


    public function getGeneralPawnsByMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.loan_amount, loan_matrix_tbl.title
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.date_added >= "' . $from . '" AND loan_info_tbl.date_added <= "' . $to . '" AND loan_info_tbl.status != "void"
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
    public function getGeneralPawnsByMonthView($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.loan_amount, loan_matrix_tbl.title
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.date_added >= "' . $from . '" AND loan_info_tbl.date_added <= "' . $to . '" AND loan_info_tbl.status = "active"
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	 public function getForfeitedGeneralPawnsByMonthView($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.loan_amount, loan_matrix_tbl.title
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.date_added >= "' . $from . '" AND loan_info_tbl.date_added <= "' . $to . '" AND loan_info_tbl.status = "unredeemed"
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	

    public function getGeneralPawnsByMonthTotalSum($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(loan_amount) as totalPawns FROM `loan_info_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '" AND `status` != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPawns = $result['totalPawns'];

        return $totalPawns;
    }

    public function getInterestGeneralPawnsByMonthTotalSum($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(interest_accured) as interest FROM `loan_info_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '" AND `status` != "void" ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $interest = $result['interest'];

        return $interest;
    }


    public function getTitlePawnsByMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.title_no, title_pawn_tbl.retail, title_pawn_tbl.total_loan_amount, loan_matrix_tbl.title, title_pawn_tbl.tittle_pawn_id, title_pawn_tbl.date_added
				FROM `customer_tbl`, `title_pawn_tbl`, `loan_matrix_tbl`
				WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id AND title_pawn_tbl.date_added >= "' . $from . '" AND title_pawn_tbl.date_added <= "' . $to . '" AND title_pawn_tbl.status != "void" ORDER BY title_pawn_tbl.date_added DESC
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getTitlePawnsByMonthView($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.title_no, title_pawn_tbl.retail, title_pawn_tbl.total_loan_amount, loan_matrix_tbl.title, title_pawn_tbl.tittle_pawn_id, title_pawn_tbl.date_added
				FROM `customer_tbl`, `title_pawn_tbl`, `loan_matrix_tbl`
				WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id AND title_pawn_tbl.date_added >= "' . $from . '" AND title_pawn_tbl.date_added <= "' . $to . '" AND title_pawn_tbl.status = "active" ORDER BY title_pawn_tbl.date_added DESC
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }




    public function getTitlePawnsByMonthTotalSum($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(total_loan_amount) as totalTitlePawns FROM `title_pawn_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '" AND `status` != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalTitlePawns = $result['totalTitlePawns'];

        return $totalTitlePawns;
    }

    public function getInterestTitlePawnsByMonthTotalSum($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(interest_accured) as interest FROM `title_pawn_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $interest = $result['interest'];

        return $interest;
    }

    public function getTakePaymentSalesByMonth($from, $to, $transaction){


        if($transaction == 'loan_info_tbl'){
            $id = 'loan_info_id';
            $status = 'status';
        }
        else if($transaction == 'title_pawn_tbl'){
            $id = 'tittle_pawn_id';
            $status = 'status';
        }
        else if($transaction == 'repair_invoice_tbl'){
            $id = 'repair_invoice_id';
            $status = 'invoice_status';
        }
        else if($transaction == 'refill_tbl'){
            $id = 'refill_id';
            $status = 'status';
        }
        else if($transaction == 'rto_tbl'){
            $id = 'rto_id';
            $status = 'status';
        }
		 else if($transaction == 'layaway_tbl'){
            $id = 'lid';
            $status = 'status';
        }
        else {
            null;
        }

        $pdo = $this->getPdo();

        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, payment_tbl.total_amount, payment_tbl.payment_method, payment_tbl.transaction, ' . $transaction . '.' . $status .'
				FROM `customer_tbl`, `payment_tbl`, `' . $transaction . '`
				WHERE payment_tbl.customer_id = customer_tbl.customer_id AND payment_tbl.transaction = "' . $transaction . '" AND payment_tbl.date_added >= "' . $from . '" AND payment_tbl.date_added <= "' . $to. '" AND ' . $transaction . '.customer_id = payment_tbl.customer_id AND payment_tbl.transaction_id = ' . $transaction . '.' . $id . ' AND ' . $transaction . '.' . $status . ' != "void" AND payment_tbl.status != "void"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;


    }

    public function getTakePaymentSalesByMonthTotalSum($from, $to, $transaction){


        if($transaction == 'loan_info_tbl'){
            $id = 'loan_info_id';
            $status = 'status';
        }
        else if($transaction == 'title_pawn_tbl'){
            $id = 'tittle_pawn_id';
            $status = 'status';
        }
        else if($transaction == 'repair_invoice_tbl'){
            $id = 'repair_invoice_id';
            $status = 'invoice_status';
        }
        else if($transaction == 'refill_tbl'){
            $id = 'refill_id';
            $status = 'status';
        }
        else if($transaction == 'rto_tbl'){
            $id = 'rto_id';
            $status = 'status';
        }
		else if($transaction == 'layaway_tbl'){
            $id = 'lid';
            $status = 'status';
        }
        else {
            null;
        }


        $pdo = $this->getPdo();

        $sql = 'SELECT SUM(total_amount) as totalPawnPayment FROM `payment_tbl`, `' . $transaction . '` WHERE `transaction` = "' . $transaction . '" AND payment_tbl.date_added >= "' . $from . '" AND payment_tbl.date_added <= "' . $to . '" AND payment_tbl.transaction_id = ' . $transaction . '.' . $id . ' AND ' . $transaction . '.' . $status . ' != "void" AND payment_tbl.status != "void"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPawnPayment = $result['totalPawnPayment'];

        return $totalPawnPayment;
    }

    public function getPointOfSaleByMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, point_of_sale_tbl.total, point_of_sale_tbl.payment
				FROM `customer_tbl`, `point_of_sale_tbl`
				WHERE point_of_sale_tbl.customer_id = customer_tbl.customer_id AND point_of_sale_tbl.date_added >= "' . $from . '" AND point_of_sale_tbl.date_added <= "' . $to . '" AND point_of_sale_tbl.status != "void"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getPointOfSaleByMonthTotalSum($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(total) as totalPointOfSale FROM `point_of_sale_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '" AND `status` != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPointOfSale = $result['totalPointOfSale'];

        return $totalPointOfSale;
    }


    public function getCashLoanedOutByMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_amount
				FROM `customer_tbl`, `loan_info_tbl`
				    WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.date_added >= "' . $from . '" AND loan_info_tbl.date_added <= "' . $to . '" AND loan_info_tbl.status != "void"
				UNION
				SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, title_pawn_tbl.total_loan AS loan_amount
				FROM `customer_tbl`,`title_pawn_tbl`
				    WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND title_pawn_tbl.date_added >= "' . $from . '"  AND title_pawn_tbl.date_added <= "' . $to . '" AND title_pawn_tbl.status != "void"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getCashLoanedOutTotalSumMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(loan_amount) as totalLoan FROM `loan_info_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '" AND `status` != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalLoan = $result['totalLoan'];

        return $totalLoan;
    }

    public function getCashLoanedOutTitleTotalSumMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(total_loan) as totalLoan FROM `title_pawn_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '" AND `status` != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalLoan = $result['totalLoan'];

        return $totalLoan;
    }

    public function getCostOfGoodsByMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, outright_info_tbl.purchase_amount
				FROM `customer_tbl`, `outright_info_tbl`
				WHERE outright_info_tbl.customer_id = customer_tbl.customer_id AND outright_info_tbl.date_added >= "' . $from . '" AND outright_info_tbl.date_added <= "' . $to . '"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCostOfGoodsTotalSumMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(purchase_amount) as purchaseAmount FROM `outright_info_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $purchaseAmount = $result['purchaseAmount'];

        return $purchaseAmount;
    }

    public function getScrapPurchasesByMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, scrap_info_tbl.amount_paid
				FROM `customer_tbl`, `scrap_info_tbl`
				WHERE scrap_info_tbl.customer_id = customer_tbl.customer_id AND scrap_info_tbl.date_added >= "' . $from . '" AND scrap_info_tbl.date_added <= "' . $to . '" AND scrap_info_tbl.status != "void"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getScrapPurchasesTotalSumMonth($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(amount_paid) as purchaseAmount FROM `scrap_info_tbl` WHERE `date_added` >= "' . $from . '" AND `date_added` <= "' . $to . '" AND `status` != "void"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $purchaseAmount = $result['purchaseAmount'];

        return $purchaseAmount;
    }



    public function getPrepaidPlan(){

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `prepaid_plan_tbl`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getPaymentTerm(){
        $pdo = $this->getPdo();
        $sql = 'SELECT *
					FROM `payment_term`
					';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getCompanyInfo(){
    $pdo = $this->getPdo();
    $sql = 'SELECT *
					FROM `company_info_tbl`
					';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $content = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $content[] = $row;
    }
    return $content;
}
    public function getCheckInfo(){
        $pdo = $this->getPdo();
        $sql = 'SELECT *
					FROM `check_info_tbl`
					';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getLienInfo(){
        $pdo = $this->getPdo();
        $sql = 'SELECT *
					FROM `lien_holder`
					';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }



    public function getGeneralPawnsByMonthVoid($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.loan_amount, loan_info_tbl.status, loan_matrix_tbl.title, loan_info_tbl.void_reason
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.date_added >= "' . $from . '" AND loan_info_tbl.date_added <= "' . $to . '" AND loan_info_tbl.status = "void"
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	 public function getForfeitedGeneralPawnsByMonthVoid($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.loan_amount, loan_info_tbl.status, loan_matrix_tbl.title, loan_info_tbl.void_reason
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.date_forfeited >= "' . $from . '" AND loan_info_tbl.date_forfeited <= "' . $to . '" AND loan_info_tbl.status = "active" AND loan_info_tbl.void_reason != ""
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getGeneralPawnsPaymentByMonthVoid($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, loan_info_tbl.loan_info_id, loan_info_tbl.date_added, loan_info_tbl.due_date, loan_info_tbl.loan_amount, loan_info_tbl.interest_accured, loan_matrix_tbl.title, payment_tbl.total_amount, payment_tbl.date_added as datePaid, payment_tbl.transaction_id, payment_tbl.status, payment_tbl.payment_id, payment_tbl.void_reason
				FROM `customer_tbl`, `loan_info_tbl`, `loan_matrix_tbl`, `payment_tbl`
				WHERE loan_info_tbl.customer_id = customer_tbl.customer_id
				AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id
				AND loan_info_tbl.loan_info_id = payment_tbl.transaction_id
				AND payment_tbl.date_added >= "' . $from . '"
				AND payment_tbl.date_added <= "' . $to . '"
                AND payment_tbl.status = "void"
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getLayawayPaymentByMonthVoid($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, layaway_tbl.*, payment_tbl.total_amount, payment_tbl.date_added as datePaid, payment_tbl.transaction_id, payment_tbl.status, payment_tbl.payment_id, payment_tbl.void_reason
				FROM `customer_tbl`, `layaway_tbl`, `payment_tbl`
				WHERE layaway_tbl.customer_id = customer_tbl.customer_id
				AND layaway_tbl.lid = payment_tbl.transaction_id
				AND payment_tbl.date_added >= "' . $from . '"
				AND payment_tbl.date_added <= "' . $to . '"
                AND payment_tbl.status = "void"
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getTitlePawnsByMonthVoid($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, title_pawn_tbl.tittle_pawn_id, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.title_no, title_pawn_tbl.retail, title_pawn_tbl.total_loan_amount, title_pawn_tbl.status, loan_matrix_tbl.title, title_pawn_tbl.void_reason, title_pawn_tbl.date_added
				FROM `customer_tbl`, `title_pawn_tbl`, `loan_matrix_tbl`
				WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id AND title_pawn_tbl.date_added >= "' . $from . '" AND title_pawn_tbl.date_added <= "' . $to . '" AND title_pawn_tbl.status = "void"
				GROUP BY title_pawn_tbl.tittle_pawn_id';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getTitlePawnsPaymentByMonthVoid($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, title_pawn_tbl.tittle_pawn_id, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.title_no, title_pawn_tbl.retail, title_pawn_tbl.total_loan_amount, payment_tbl.total_amount, payment_tbl.date_added as datePaid, payment_tbl.transaction_id, payment_tbl.status, payment_tbl.payment_id, payment_tbl.void_reason
				FROM `customer_tbl`, `title_pawn_tbl`, `loan_matrix_tbl`, `payment_tbl`
				WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id
				AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id
				AND title_pawn_tbl.tittle_pawn_id = payment_tbl.transaction_id
				AND payment_tbl.date_added >= "' . $from . '"
				AND payment_tbl.date_added <= "' . $to . '"
                AND payment_tbl.status = "void"
				';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getPointOfSaleByMonthVoid($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, point_of_sale_tbl.sale_id, point_of_sale_tbl.total, point_of_sale_tbl.payment, point_of_sale_tbl.status, point_of_sale_tbl.void_reason
				FROM `customer_tbl`, `point_of_sale_tbl`
				WHERE point_of_sale_tbl.customer_id = customer_tbl.customer_id AND point_of_sale_tbl.date_added >= "' . $from . '" AND point_of_sale_tbl.date_added <= "' . $to . '" AND point_of_sale_tbl.status = "void"
				';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getRepairInvoiceByMonthVoid($from, $to){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, repair_invoice_tbl.*
					FROM  `customer_tbl`, `repair_invoice_tbl`
					WHERE customer_tbl.customer_id = repair_invoice_tbl.customer_id AND repair_invoice_tbl.invoice_status = "void" AND repair_invoice_tbl.date_added >= "' . $from . '" AND repair_invoice_tbl.date_added <= "' . $to . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getRefillByMonthVoid($from, $to){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, refill_tbl.*
					FROM  `customer_tbl`, `refill_tbl`
					WHERE customer_tbl.customer_id = refill_tbl.customer_id AND refill_tbl.status = "void" AND refill_tbl.date_added >= "' . $from . '" AND refill_tbl.date_added <= "' . $to . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getRTOByMonthVoid($from, $to){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, rto_tbl.*
					FROM  `customer_tbl`, `rto_tbl`
					WHERE customer_tbl.customer_id = rto_tbl.customer_id AND rto_tbl.status = "void" AND rto_tbl.date_added >= "' . $from . '" AND rto_tbl.date_added <= "' . $to . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getLayawayByMonthVoid($from, $to){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, layaway_tbl.*
					FROM  `customer_tbl`, `layaway_tbl`
					WHERE customer_tbl.customer_id = layaway_tbl.customer_id AND layaway_tbl.status = "void" AND layaway_tbl.date_added >= "' . $from . '" AND layaway_tbl.date_added <= "' . $to . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getRTOByMonth($from, $to){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, rto_tbl.*
					FROM  `customer_tbl`, `rto_tbl`
					WHERE customer_tbl.customer_id = rto_tbl.customer_id AND rto_tbl.status != "void" AND rto_tbl.date_added >= "' . $from . '" AND rto_tbl.date_added <= "' . $to . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getScrapByMonthVoid($from, $to){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*,scrap_info_tbl.*
					FROM  `customer_tbl`, `scrap_info_tbl`
					WHERE customer_tbl.customer_id = scrap_info_tbl.customer_id AND scrap_info_tbl.status = "void" AND scrap_info_tbl.date_added >= "' . $from . '" AND scrap_info_tbl.date_added <= "' . $to . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getCustomerPOSItemsVoid($id, $sale_id)
    {

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, inventory_tbl.*, point_of_sale_item_sold.*, point_of_sale_tbl.* FROM `customer_tbl`, `inventory_tbl`, `point_of_sale_item_sold`, `point_of_sale_tbl` WHERE customer_tbl.customer_id = ' . $id . ' AND point_of_sale_item_sold.sale_id = ' . $sale_id . ' AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id AND point_of_sale_tbl.customer_id = ' . $id . ' GROUP BY inventory_tbl.item_no ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getForfietDays(){

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `forfiet_days`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getScrapHoldingDays(){

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `scrap_holding_days`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	
	 public function getMessageOptions($type, $transaction)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `message_options` WHERE `type` = "' . $type .'" AND `transaction` = "' . $transaction . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	public function getNumber()
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `customer_tbl` WHERE `customer_id` = 17';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	public function changeNumber($queryString)
    {	
	try{
        $pdo = $this->getPdo();
        $sql = 'UPDATE `customer_tbl` SET `cell_no` = "' . $_POST['cp_no'] . '"
					WHERE `customer_id` = 17';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
		$location = $_SERVER['PHP_SELF'] .'?' . $queryString . '&success=true&msg=Message options successfully updated.';
			
			
		}
		catch(Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?' . $queryString . 'success=false&msg=Something went wrong, please try again';
            }
            Header('Location: ' . $location . '');
        
    }
	
	public function updateMessageNotification($queryString){
		
		try{
			$pdo = $this->getPdo();
			if($_POST['mId'] != ''){
				$sql = 'UPDATE `message_options` SET `days` = "' . $_POST['days'] . '", `message` =  "' . addslashes($_POST['message']) . '", `frequency` = "' . $_POST['frequency'] . '"                
					WHERE `type` = "' . $_POST['type'] . '" AND `transaction` = "' . $_POST['transaction'] . '"';
			}else{
				
				if($queryString == 'transaction=generalPawns'){
						$transaction = 'generalPawns';
				}else if($queryString == 'transaction=titlePawns'){
						$transaction = 'titlePawns';
				}else if($queryString == 'transaction=rto'){
						$transaction = 'rto';
				}else if($queryString == 'transaction=layaway'){
						$transaction = 'layaway';
				}
				
				if(isset($_POST['preNotificationButton'])){
						$type = 'preNotification';	
				}else if(isset($_POST['onNotificationButton'])){
						$type = 'onNotification';	
				}else if(isset($_POST['postNotificationButton'])){
						$type = 'postNotification';	
				}
				
				
				$sql = 'INSERT INTO `message_options`
								(`type`, `transaction`, `days`, `message`, `frequency`, `active`) VALUES
								("' . $type . '", "' . $transaction . '", "' . $_POST['days'] . '", "' . addslashes($_POST['message']) . '", "' . $_POST['frequency'] . '", 1)';
			}
			
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$location = $_SERVER['PHP_SELF'] .'?' . $queryString . '&success=true&msg=Message options successfully updated.';
			
			
		}
		catch(Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?' . $queryString . 'success=false&msg=Something went wrong, please try again';
            }
            Header('Location: ' . $location . '');
		
	}

	
	public function updateActivePreNotification($mId, $bool){
		
		try{
			$pdo = $this->getPdo();
			$sql = 'UPDATE `message_options` SET `active` = "' . $bool . '"           
					WHERE `mId` = ' . $mId . '';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			
			
			
		}
		catch(Exception $e){
              
            }
           
		
	}



    // Add function

    public function addLoanMatrix()
	{
		$data = array('title' => 'title',
                      'terms_of_loan' => 'terms_of_loan',
					  'rate_first' => 'rate_first',
					  'rate_second' => 'rate_second',
					  'late_fees' => 'late_fees',);
					  
		$data = $_POST['data'];
					  
		if (isset($_POST['data']))
		{
            try{
                $pdo = $this->getPdo();
                $sql = 'INSERT INTO `loan_matrix_tbl` (`title`,`terms_of_loan`, `rate_first`, `rate_second`,`occur_late_fees`) VALUES (:title, :terms_of_loan, :rate_first, :rate_second, :late_fees)';
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute($data);
                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=New loan matrix successfully added.';
            }catch(Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');

		}
		
	}


    public function addPrepaidPlan(){

    $name = addslashes($_POST['plan_name']);
    $cost = $_POST['cost'];
    $cost = str_replace(',','', '' . $cost . '');
    $retail = $_POST['retail'];
    $retail = str_replace(',','', '' . $retail . '');

    try{
        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `prepaid_plan_tbl` (`plan_name`,`cost`, `retail`) VALUES ("' . $name . '", "' . $cost . '", "' .$retail . '")';
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
        $location = $_SERVER['PHP_SELF'] .'?success=true&msg=New prepaid plan successfully added.';
    }catch(Exception $e){
        $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
    }

    header('Location: ' . $location . '');
}

    public function editPrepaidPlan(){

        $id = $_POST['pid'];
        $name = addslashes($_POST['plan_name']);
        $cost = $_POST['cost'];
        $cost = str_replace(',','', '' . $cost . '');
        $retail = $_POST['retail'];
        $retail = str_replace(',','', '' . $retail . '');

        try{
            $pdo = $this->getPdo();
            $sql = 'UPDATE `prepaid_plan_tbl` SET `plan_name` = "' . $name . '", `cost` = "' . $cost . '", `retail` = "' . $retail . '" WHERE `prepaid_id` = ' . $id. '';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();
            $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Prepaid plan successfully updated.';
        }catch(Exception $e){
            $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
        }

        header('Location: ' . $location . '');
    }

    public function deletePrepaidPlan(){

        $id = $_POST['dpid'];

        try{
            $pdo = $this->getPdo();
            $sql = 'DELETE FROM `prepaid_plan_tbl` WHERE `prepaid_id` = ' . $id . '';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();
            $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Prepaid plan successfully delete';
        }catch(Exception $e){
            $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
        }

        header('Location: ' . $location . '');
    }



    // Edit Function
	
	
	public function updateLoanPenalty($id, $penalty, $type){
		if($type == 'general'){
			$table = "`loan_info_tbl`";
			$table_id = "`loan_info_id`";
		}
		else{
			$table = "`title_pawn_tbl`";
			$table_id = "`tittle_pawn_id`";
		}
		$pdo = $this->getPdo();
		$sql = 'UPDATE ' . $table . ' SET `penalty` = "' . $penalty . '" WHERE ' . $table_id . ' = ' . $id . '';
		$stmt = $pdo->prepare($sql);
        $stmt->execute();
	}
	public function updateLoanMatrix()
    {

        try{
            $pdo = $this->getPdo();
            $sql = 'UPDATE `loan_matrix_tbl` SET `title` = "' . $_POST['eTitle'] . '",
												 `terms_of_loan` = "' . $_POST['eTerms'] . '",
												 `occur_late_fees` = "' . $_POST['eLateFees'] . '",
												 `rate_first` = "' . $_POST['eFirstRate'] . '",
												 `rate_second` = "' . $_POST['eSecondRate'] . '"
					WHERE `id` = ' . $_POST['eId'] . '';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Loan matrix successfully updated.';
        }catch(Exception $e){
            $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
        }

        header('Location: ' . $location . '');

    }

    public function removeLoanMatrix(){
        $id = $_POST['dId'];
        try{
            $pdo = $this->getPdo();
            $sql = 'DELETE FROM `loan_matrix_tbl` WHERE `id` = ' . $id . '';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Loan matrix successfully deleted.';

        }catch (Exception $e){
            $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
        }

        header('Location: ' . $location . '');
    }

    public function updateSalesTax()
    {
        $data = array('general_tax' => 'general_tax',
            'flat_tax' => 'flat_tax');

        $data = $_POST['data'];

        if (isset($_POST['data'])) {

            try{
                $pdo = $this->getPdo();
                $sql = 'UPDATE `sales_Tax_tbl` SET `general_tax` = :general_tax, `flat_tax` = :flat_tax';
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);
                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Sales tax successfully updated.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');

        }

    }

    public function updateCompanyInfo()
    {

        $data = array('company_name' => 'company_name',
                      'address' => 'address',
                      'city' => 'city',
                      'state' => 'state',
                      'zip' => 'zip',
                      'phone_no' => 'phone_no'
                        );

        $data = $_POST['data'];
        try{
            if (isset($_POST['data'])) {

                $pdo = $this->getPdo();
                $sql = 'UPDATE `company_info_tbl` SET
                   `company_name` = :company_name,
                   `company_address` = :address,
                   `city` = :city,
                   `state` = :state,
                   `zip` = :zip,
                   `phone_no` = :phone_no
                   ';
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);
                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Company info successfully updated.';
            }
        }catch(Exception $e){
            $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
        }

        Header('Location: ' . $location . '');


    }

    public function updateCheckInfo()
    {
        $data = array('check_name' => 'check_name',
            'routing_number' => 'routing_number',
			'fraction_number' => 'fraction_number',
            'address' => 'address',
            'city' => 'city',
            'state' => 'state',
            'zip' => 'zip'
        );

        $data = $_POST['data'];
        $accountNo = $_POST['accountNo'];

        if (isset($_POST['data'])) {

            try{
                $pdo = $this->getPdo();
                $sql = 'UPDATE `check_info_tbl` SET
                   `check_name` = :check_name,
                   `routing_no` = :routing_number,
                   `account_no` = "' . $this->makeHash('encrypt', $accountNo) . '",
				   `fraction_no` = :fraction_number,
                   `address` = :address,
                   `city` = :city,
                   `state` = :state,
                   `zip` = :zip
                   ';
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);
                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Check info successfully updated.';
            }catch(Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }
            Header('Location: ' . $location . '');
        }

    }


    public function updateLienInfo()
    {
        $data = array('fname' => 'fname',
            'lname' => 'lname',
            'address' => 'address',
            'elt' => 'elt'
        );

        $data = $_POST['data'];

        if (isset($_POST['data'])) {

            try{

                $pdo = $this->getPdo();
                $sql = 'UPDATE `lien_holder` SET
                   `first_name` = :fname,
                   `last_name` = :lname,
                   `address` = :address,
                   `elt` = :elt
                   ';
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);
                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Lien information successfully updated.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');

        }

    }


    public function updateAllowPartial($id, $state, $type)
    {

            if($type == 'loan_info_tbl'){
                $loan_id = 'loan_info_id';
            }
            else{
                $loan_id = 'tittle_pawn_id';

            }
            $pdo = $this->getPdo();
            $sql = 'UPDATE `' . $type . '` SET `allow_partial` = ' . $state . ' WHERE `' . $loan_id . '` = ' . $id . '';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();


    }

    public function updateForfietDays()
    {
        $data = array('general_pawns' => 'general_pawns',
            'title_pawns' => 'title_pawns');

        $data = $_POST['data'];

        if (isset($_POST['data'])) {

            try{
                $pdo = $this->getPdo();
                $sql = 'UPDATE `forfiet_days` SET `general_pawns` = :general_pawns, `title_pawns` = :title_pawns';
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);
                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Forfeit days successfully updated.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');

        }

    }

    public function updateScrapHoldingDays(){

            try{
                $days = $_POST['days'];
                $max_payout = $_POST['max_payout'];
                $pdo = $this->getPdo();
                $sql = 'UPDATE `scrap_holding_days` SET `days` = ' . $days . ', `max` = "' . $max_payout . '"';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Scrap metal settinfs successfully updated.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

        header('Location: ' . $location . '');


    }
	
	
	 public function updateLayawaySettings()
    {
        $data = array('maximum_days' => 'maximum_days',
            'grace_period' => 'grace_period',
			'minimum_required' => 'minimum_required');

        $data = $_POST['data'];

        if (isset($_POST['data'])) {

            try{
                $pdo = $this->getPdo();
                $sql = 'UPDATE `layaway_settings` SET `maximum_days` = :maximum_days, `grace_period` = :grace_period, `minimum_required` = :minimum_required';
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);
                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Layaway settings successfully updated.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');

        }

    }


    public function updateLayawayNotComplete($lid){

        $pdo = $this->getPdo();
        $sql = 'UPDATE `layaway_tbl` SET `status` = "inactive" WHERE `lid` = ' . $lid . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();


/*
        foreach($items as $row){
            $sql = 'UPDATE `inventory_tbl` SET `quantity` = (`quantity` + ' . $row['quantity'] . ')
                                WHERE `inventory_id` = ' . $row['inventory_id'] . '';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

        }
*/

    }



    function getMondays($year, $month)
    {
        $mondays = array();
        # First weekday in specified month: 1 = monday, 7 = sunday
        $firstDay = date('N', mktime(0, 0, 0, $month, 1, $year));
        /* Add 0 days if monday ... 6 days if tuesday, 1 day if sunday
            to get the first monday in month */
        $addDays = (8 - $firstDay);
        $mondays[] = date('r', mktime(0, 0, 0, $month, 1 + $addDays, $year));

        $nextMonth = mktime(0, 0, 0, $month + 1, 1, $year);

        # Just add 7 days per iteration to get the date of the subsequent week
        for ($week = 1, $time = mktime(0, 0, 0, $month, 1 + $addDays + $week * 7, $year);
             $time < $nextMonth;
             ++$week, $time = mktime(0, 0, 0, $month, 1 + $addDays + $week * 7, $year))
        {
            $mondays[] = date('r', $time);
        }

        return $mondays;
    }

    function createDateRangeArray($strDateFrom,$strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return $aryRange;
    }


	/*
	 * Returns database row for 1 member
	 * @param string $email
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function loginByName($email, $password)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `user` WHERE `email` = ? AND `password` = SHA(?)';
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($email, $password));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
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

?>
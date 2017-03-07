<?php
// PHP and MySQL Project



class Employee
{
	public $debug = TRUE;
	protected $db_pdo;
	
		private function registerPayment($customer_id, $total_amount, $transaction, $date, $tid){						$pdo = $this->getPdo();				$sql = 'INSERT INTO `payment_tbl` (`customer_id`, `total_amount`, `payment_method`, `transaction`, `date_added`, `transaction_id`) VALUES ("' . $customer_id . '", "' . $total_amount . '", "Cash", "' . $transaction . '",  "' . $date . '", "' . $tid . '")';				$stmt = $pdo->prepare($sql);				$stmt->execute();              	}
	
	/* Fetch Data */
	public function getCustomer()
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `customer_tbl` WHERE `customer_id` != 1';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}

    public function getCustomerInfo($id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `customer_tbl` WHERE `customer_id` = ' . $id .'';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCustomerById($id, $last_id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name, customer_tbl.middle_name, customer_tbl.last_name, customer_tbl.birth_date, customer_tbl.address, customer_tbl.city, customer_tbl.state, customer_tbl.zip, customer_tbl.cell_no, customer_tbl.drivers_license_no, customer_tbl.dl_expire_date,  loan_matrix_tbl.title, loan_matrix_tbl.rate_first,loan_matrix_tbl.rate_second, loan_info_tbl.loan_info_id, loan_info_tbl.loan_amount, loan_info_tbl.total_loan, loan_info_tbl.interest_rate, loan_info_tbl.apr, loan_info_tbl.terms_of_loan, loan_info_tbl.due_date, loan_info_tbl.loan_matrix_id, loan_info_tbl.interest_accured, loan_info_tbl.penalty
			    FROM `customer_tbl`, `loan_matrix_tbl`, `loan_info_tbl`
				WHERE customer_tbl.customer_id = ' . $id . ' AND loan_matrix_tbl.id = loan_info_tbl.loan_matrix_id AND loan_info_tbl.loan_info_id = '. $last_id . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCustomerByIdStaggard($id, $last_id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name, customer_tbl.middle_name, customer_tbl.last_name, customer_tbl.birth_date, customer_tbl.address, customer_tbl.city, customer_tbl.state, customer_tbl.zip, customer_tbl.cell_no, customer_tbl.drivers_license_no, customer_tbl.dl_expire_date,  loan_matrix_tbl.title, loan_matrix_tbl.rate_first,loan_matrix_tbl.rate_second, loan_info_tbl.loan_info_id, loan_info_tbl.loan_amount, loan_info_tbl.total_loan, loan_info_tbl.interest_rate, loan_info_tbl.apr, loan_info_tbl.terms_of_loan, loan_info_tbl.due_date, loan_info_tbl.penalty, payment_tbl.total_amount as amountPaid, loan_info_tbl.interest_accured, loan_info_tbl.partial_payment
			    FROM `customer_tbl`, `loan_matrix_tbl`, `loan_info_tbl`, `payment_tbl`
				WHERE customer_tbl.customer_id = ' . $id . ' AND loan_matrix_tbl.id = loan_info_tbl.loan_matrix_id AND loan_info_tbl.loan_info_id = '. $last_id . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCustomerByIdStaggardTitle($id, $last_id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, title_pawn_tbl.*, loan_matrix_tbl.title, loan_matrix_tbl.rate_first,loan_matrix_tbl.rate_second, payment_tbl.total_amount as amountPaid
			    FROM `customer_tbl`, `loan_matrix_tbl`, `title_pawn_tbl`, `payment_tbl`
				WHERE customer_tbl.customer_id = ' . $id . ' AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id AND title_pawn_tbl.tittle_pawn_id = '. $last_id . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getCustomerByIdDash($id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name, customer_tbl.middle_name, customer_tbl.last_name, loan_matrix_tbl.title, loan_matrix_tbl.rate_first,loan_matrix_tbl.rate_second,loan_matrix_tbl.terms_of_loan, loan_info_tbl.customer_id, loan_info_tbl.loan_info_id, loan_info_tbl.loan_amount, loan_info_tbl.total_loan, loan_info_tbl.interest_rate, loan_info_tbl.apr, loan_info_tbl.terms_of_loan , loan_info_tbl.due_date, loan_info_tbl.date_added
			    FROM `customer_tbl`, `loan_matrix_tbl`, `loan_info_tbl`
				WHERE loan_info_tbl.customer_id = ' . $id . ' AND loan_info_tbl.customer_id = customer_tbl.customer_id AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.status = "active"' ;

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }




    public function getCustomerIdByPoint($id)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT `customer_id` FROM `customer_tbl` WHERE `customer_id` = ' . $id . ''; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}


    public function getCustomerIdByNumber($id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT `cell_no` FROM `customer_tbl` WHERE `customer_id` = "' . $id . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	public function getCustomerByInfo($id)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `customer_tbl` WHERE `customer_id` = ' . $id . '';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}

    public function getCustomerByIdRepair($id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `repair_invoice_tbl` WHERE `customer_id` = ' . $id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCustomerByIdRefills($id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `refill_tbl` WHERE `customer_id` = ' . $id . ' ORDER BY `date_added` DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCustomerByIdPOS($id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT point_of_sale_item_sold.*, point_of_sale_item_sold.quantity as qty, inventory_tbl.* FROM `point_of_sale_item_sold`, `inventory_tbl` WHERE point_of_sale_item_sold.customer_id = ' . $id . ' AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	 public function getCustomerByIdNotes($id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `collection_attempt` WHERE customer_id = ' . $id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function cleanTable($id)
	{
		$pdo = $this->getPdo();
		$sql = 'DELETE FROM `pawn_items_tmp` WHERE `customer_id` = ' . $id . ''; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	
	public function getCustomerByIdTitlePawn($id, $last_id)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT customer_tbl.*, loan_matrix_tbl.title, loan_matrix_tbl.terms_of_loan, loan_matrix_tbl.rate_first,loan_matrix_tbl.rate_second, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.color, title_pawn_tbl.mileage, title_pawn_tbl.no_of_doors, title_pawn_tbl.vehicle_condition, title_pawn_tbl.title_no, title_pawn_tbl.tag_no, title_pawn_tbl.total_loan_amount, title_pawn_tbl.retail, title_pawn_tbl.total_loan, title_pawn_tbl.interest_rate, title_pawn_tbl.apr, title_pawn_tbl.terms_of_loan, title_pawn_tbl.date_added, title_pawn_tbl.due_date, title_pawn_tbl.interest_accured, title_pawn_tbl.exempt, title_pawn_tbl.make, title_pawn_tbl.style, title_pawn_tbl.penalty, title_pawn_tbl.amount_behalf
			    FROM `customer_tbl`, `loan_matrix_tbl`, title_pawn_tbl
				WHERE customer_tbl.customer_id = ' . $id . ' AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id AND title_pawn_tbl.customer_id = ' . $id . ' AND title_pawn_tbl.tittle_pawn_id = ' . $last_id . '';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}

    public function getCustomerByIdTitlePawnDisplay($id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, loan_matrix_tbl.title, loan_matrix_tbl.terms_of_loan, loan_matrix_tbl.rate_first,loan_matrix_tbl.rate_second, title_pawn_tbl.vin_no, title_pawn_tbl.year, title_pawn_tbl.model, title_pawn_tbl.color, title_pawn_tbl.mileage, title_pawn_tbl.no_of_doors, title_pawn_tbl.vehicle_condition, title_pawn_tbl.title_no, title_pawn_tbl.tag_no, title_pawn_tbl.total_loan_amount, title_pawn_tbl.retail, title_pawn_tbl.total_loan, title_pawn_tbl.interest_rate, title_pawn_tbl.apr, title_pawn_tbl.terms_of_loan, title_pawn_tbl.date_added, title_pawn_tbl.due_date, title_pawn_tbl.interest_accured, title_pawn_tbl.status, title_pawn_tbl.tittle_pawn_id
			    FROM `customer_tbl`, `loan_matrix_tbl`, title_pawn_tbl
				WHERE customer_tbl.customer_id = ' . $id . ' AND loan_matrix_tbl.id = title_pawn_tbl.loan_matrix_id AND title_pawn_tbl.customer_id = ' . $id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


	public function getCustomerByIdOutright($id, $last_id)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT customer_tbl.*, outright_info_tbl.purchase_amount, outright_info_tbl.retail_price
			    FROM `customer_tbl`, `outright_info_tbl`
				WHERE customer_tbl.customer_id = ' . $id . ' AND outright_info_tbl.customer_id = ' . $id . ' AND `outright_id` = ' . $last_id . '';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}

    public function getCustomerByIdScrap($id, $last_id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, scrap_info_tbl.purchase_amount, scrap_info_tbl.amount_paid
			    FROM `customer_tbl`, `scrap_info_tbl`
				WHERE customer_tbl.customer_id = ' . $id . ' AND scrap_info_tbl.customer_id = ' . $id . ' AND scrap_info_tbl.scrap_info_id = ' . $last_id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	public function getCustomerByIdPayment($id)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT customer_tbl.first_name, customer_tbl.middle_name, customer_tbl.last_name, payment_tbl.total_amount
			    FROM `customer_tbl`, `payment_tbl`
				WHERE customer_tbl.customer_id = ' . $id . '';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	
	public function getCustomerByIdPointOfSale($id)
	{
		$pdo = $this->getPdo();
		
		
		$sql = 'SELECT customer_tbl.*, point_of_sale_tbl.sub_total, point_of_sale_tbl.tax, point_of_sale_tbl.total, point_of_sale_tbl.payment
					FROM `customer_tbl`, `point_of_sale_tbl`
					WHERE customer_tbl.customer_id = ' . $id . '';
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}


    public function getPointOfSaleItemSold($id, $last_id){
        $pdo = $this->getPdo();
        $sql = 'SELECT inventory_tbl.*, point_of_sale_item_sold.quantity as quantity_sold, point_of_sale_tbl.* FROM `inventory_tbl`, `point_of_sale_item_sold`, `point_of_sale_tbl`
                WHERE point_of_sale_tbl.customer_id = ' . $id . ' AND inventory_tbl.inventory_id = point_of_sale_item_sold.item_id AND point_of_sale_tbl.sale_id = ' . $last_id . ' AND point_of_sale_item_sold.sale_id = ' . $last_id . '
                GROUP BY inventory_tbl.inventory_id;
                ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }




    public function getPointOfSaleSum($id, $last_id){
        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(sub_total) as subTotal FROM `point_of_sale_tbl` WHERE `customer_id` = ' . $id . ' AND `sale_id` = ' . $last_id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $subTotal = $result['subTotal'];

        return $subTotal;
    }
	
	
	
	public function getPawnItem($id, $last_id, $action)
	{
		$pdo = $this->getPdo();
		
		if ($action == 'Paid' ){
			$sql = 'SELECT * FROM `pawn_items` WHERE `customer_id` = ' . $id . ' AND `loan_info_id` = ' . $last_id . ' AND `status` = "Paid"';
		}
		else if ($action == 'pawned' ){
			$sql = 'SELECT * FROM `pawn_items` WHERE `customer_id` = ' . $id . ' AND `loan_info_id` = ' . $last_id . ' AND `status` = "pawned"';
		}
		else {
			$sql = 'SELECT * FROM `pawn_items` WHERE `customer_id` = ' . $id . ' AND `status` = "pending"';
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	
	public function getPawnItemTmp($id, $action)
	{
		$pdo = $this->getPdo();
		if (!is_numeric($id)){
			$id = '0';
		}
		
		if ($action == 'Paid' ){
			$sql = 'SELECT * FROM `pawn_items_tmp` WHERE `customer_id` = ' . $id . ' AND `status` = "Paid"';
		}
		else {
			$sql = 'SELECT * FROM `pawn_items_tmp` WHERE `customer_id` = ' . $id . ' AND `status` = "pending"';
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	
	
	public function getOutrightItemTmp($id, $action)
	{
		$pdo = $this->getPdo();
		if (!is_numeric($id)){
			$id = '0';
		}
		
		if ($action == 'Paid' ){
			$sql = 'SELECT * FROM `outright_items_tmp` WHERE `customer_id` = ' . $id . ' AND `status` = "Paid"';
		}
		else {
			$sql = 'SELECT * FROM `outright_items_tmp` WHERE `customer_id` = ' . $id . ' AND `status` = "pending"';
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}



	
	public function getOutrightItem($id, $last_id, $status)
	{
		$pdo = $this->getPdo();
		if ($status == 'Paid' ){
			$sql = 'SELECT * FROM `outright_items` WHERE `customer_id` = ' . $id . ' AND `outright_id` = ' . $last_id . ' AND `status` = "Paid"';
		}
		else {
			$sql = 'SELECT * FROM `outright_items` WHERE `customer_id` = ' . $id . ' AND `status` = "pending"';
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}

    public function getOutrightSum($id, $last_id){
        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(purchase_amount) as purchaseAmount FROM `outright_info_tbl` WHERE `customer_id` = ' . $id . ' AND `outright_id` = ' . $last_id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $purchaseAmount = $result['purchaseAmount'];

        return $purchaseAmount;
    }


    public function getScrapItem($id, $last_id)
    {
        $pdo = $this->getPdo();

        $sql = 'SELECT * FROM `scrap_inventory` WHERE `customer_id` = ' . $id . ' AND `scrap_id` = ' . $last_id . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getAllScrapItem($status)
    {
        $pdo = $this->getPdo();

        $sql = 'SELECT * FROM `scrap_inventory` WHERE `status` = "' . $status . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
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
	
	public function getPaidItems($id, $status)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `pawn_items` WHERE `customer_id` = ' . $id . ' AND `status` = "' . $status . '"';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	
	public function getInventoryItems($flt)
	{
        if($flt == 'All'){
            $condition = "";
			$columns = "*";
        }
        else if($flt == '0-9'){
            $condition = "AND `description` LIKE '1%'
                                            OR `description` LIKE '1%'
                                            OR `description` LIKE '2%'
                                            OR `description` LIKE '3%'
                                            OR `description` LIKE '4%'
                                            OR `description` LIKE '5%'
                                            OR `description` LIKE '6%'
                                            OR `description` LIKE '7%'
                                            OR `description` LIKE '8%'
                                            OR `description` LIKE '9%'
                                            ";
        }else if($flt == 'No Image'){
			$condition = "";
			$columns = "`inventory_id`, `item_no`, `description`, `cost`, `retail`, `quantity`";
		}
        else {
            $condition = "AND `description` LIKE '".$flt."%'";
			$columns = "*";
        }
		
		
		$pdo = $this->getPdo();
		$sql = 'SELECT ' . $columns . ' FROM `inventory_tbl` WHERE `quantity` != 0 ' . $condition . '';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}


	public function getSoldItems($id)
	{
        $date = date("Y-m-d");
		$pdo = $this->getPdo();
		$sql = 'SELECT inventory_tbl.*, point_of_sale_item_sold.*, point_of_sale_tbl.* FROM `inventory_tbl`, `point_of_sale_item_sold`, `point_of_sale_tbl` WHERE point_of_sale_item_sold.customer_id = ' . $id . ' AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id AND point_of_sale_tbl.customer_id = ' . $id . ' AND point_of_sale_tbl.date_added = "' . $date . '" GROUP BY inventory_tbl.item_no';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}

    public function getCustomerPOSItems($id, $sale_id)
    {

        $pdo = $this->getPdo();
        $sql = 'SELECT inventory_tbl.*, point_of_sale_item_sold.*, point_of_sale_tbl.* FROM `inventory_tbl`, `point_of_sale_item_sold`, `point_of_sale_tbl` WHERE point_of_sale_item_sold.sale_id = ' . $sale_id . ' AND  point_of_sale_item_sold.customer_id = ' . $id . ' AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id AND point_of_sale_tbl.customer_id = ' . $id . '';
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
        $sql = 'SELECT customer_tbl.*, inventory_tbl.*, point_of_sale_item_sold.*, point_of_sale_tbl.* FROM `customer_tbl`, `inventory_tbl`, `point_of_sale_item_sold`, `point_of_sale_tbl` WHERE customer_tbl.customer_id = ' . $id . ' AND point_of_sale_item_sold.sale_id = ' . $sale_id . ' AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id AND point_of_sale_tbl.customer_id = ' . $id . ' AND point_of_sale_tbl.date_added LIKE "' . date('Y-m-d') . '%" GROUP BY inventory_tbl.item_no ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }



    public function getCustomerPOSItemsPop($id, $sale_id)
    {

        $pdo = $this->getPdo();
        $sql = 'SELECT inventory_tbl.description FROM  `inventory_tbl`, `customer_tbl`, `point_of_sale_tbl`, `point_of_sale_item_sold` WHERE customer_tbl.customer_id = ' . $id . ' AND point_of_sale_item_sold.sale_id = ' . $sale_id . ' AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id AND point_of_sale_tbl.customer_id = ' . $id . ' AND point_of_sale_tbl.date_added LIKE "' . date('Y-m-d') . '%" GROUP BY inventory_tbl.item_no ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

	
	
	public function getCustomerPawnedItems($data, $loan_id)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT pawn_items.* FROM `pawn_items` WHERE pawn_items.customer_id =' . $data . ' AND  pawn_items.loan_info_id = ' . $loan_id. '';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}

        $return = $content;
		return $return;
	}

    public function getCustomerPawnedItemsPop($data, $loan_id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT pawn_items.item_description FROM `pawn_items` WHERE pawn_items.customer_id =' . $data . ' AND  pawn_items.loan_info_id = ' . $loan_id. '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }

        $return = $content;
        return $return;
    }

    public function getCustomerScrapItemsPop($data, $loan_id)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT `weight`, `description` FROM `scrap_inventory` WHERE `customer_id` =' . $data . ' AND  `scrap_id` = ' . $loan_id. '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }

        $return = $content;
        return $return;
    }


    public function getCustomerPawns($data)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT loan_info_tbl.loan_info_id, loan_info_tbl.allow_partial, loan_info_tbl.customer_id, loan_info_tbl.interest_rate, loan_info_tbl.interest_accured, loan_info_tbl.due_date, loan_info_tbl.total_loan AS totalLoan, loan_info_tbl.partial_payment, loan_info_tbl.penalty, loan_matrix_tbl.* FROM `loan_info_tbl`, `loan_matrix_tbl` WHERE loan_info_tbl.customer_id =' . $data . ' AND loan_info_tbl.loan_matrix_id = loan_matrix_tbl.id AND loan_info_tbl.status = "active"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getCustomerTitlePawnedItems($data)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT title_pawn_tbl.*, loan_matrix_tbl.* FROM `title_pawn_tbl`, `loan_matrix_tbl` WHERE `customer_id` =' . $data . ' AND title_pawn_tbl.loan_matrix_id = loan_matrix_tbl.id AND status = "active"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        $return = array($content, $row_count);
        return $return;
    }

    public function getState(){

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `state`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getAddParts($id)
    {
        $pdo = $this->getPdo();
        if (!is_numeric($id)){
            $id = '0';
        }


            $sql = 'SELECT * FROM `repair_parts` WHERE `customer_id` = ' . $id . ' AND `status` = "pending"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getCustomerByIdRepairInvoice($id, $last_id)
    {
        $pdo = $this->getPdo();


        $sql = 'SELECT customer_tbl.*, repair_invoice_tbl.*
					FROM `customer_tbl`, `repair_invoice_tbl`, `repair_parts`
					WHERE customer_tbl.customer_id = ' . $id . ' AND repair_invoice_tbl.customer_id = ' . $id .' AND repair_invoice_tbl.repair_invoice_id = ' . $last_id . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getRepairInvoiceParts($id, $last_id){

        $pdo = $this->getPdo();
        $sql = 'SELECT repair_parts.*
					FROM `repair_parts`
					WHERE `customer_id` = ' . $id . ' AND `repair_invoice_id` = ' . $last_id .' AND `status` = "active"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }



    public function getOpenRepairOrders($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, repair_invoice_tbl.*
				FROM `customer_tbl`, `repair_invoice_tbl`
				WHERE repair_invoice_tbl.customer_id = customer_tbl.customer_id AND repair_invoice_tbl.date_added >= "' . $from . '" AND repair_invoice_tbl.date_added <= "' . $to . '" AND `invoice_status` = "open"
				GROUP BY repair_invoice_tbl.repair_invoice_id';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getClosedRepairOrders($from, $to) {

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.customer_id, customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, repair_invoice_tbl.*
				FROM `customer_tbl`, `repair_invoice_tbl`
				WHERE repair_invoice_tbl.customer_id = customer_tbl.customer_id AND repair_invoice_tbl.date_added >= "' . $from . '" AND repair_invoice_tbl.date_added <= "' . $to . '" AND (`invoice_status` = "closed" OR `invoice_status` = "complete")
				GROUP BY repair_invoice_tbl.repair_invoice_id';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getRepairStatus() {

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `repair_status`';


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    function getCustomerByIdRefill($id, $last_id){


        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, refill_tbl.*
					FROM `customer_tbl`, `refill_tbl`
					WHERE customer_tbl.customer_id = ' . $id . ' AND refill_tbl.refill_id = ' . $last_id .'';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getCustomerByIdRTO($id, $last_id){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, rto_tbl.*
					FROM `customer_tbl`, `rto_tbl`
					WHERE customer_tbl.customer_id = ' . $id . ' AND rto_tbl.rto_id = ' . $last_id .'';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }
	
	public function getCustomerByIdLayaway($id, $last_id){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, layaway_tbl.*
					FROM `customer_tbl`, `layaway_tbl`
					WHERE customer_tbl.customer_id = ' . $id . ' AND layaway_tbl.lid = ' . $last_id .'';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getCustomerByIdPaymentRTO($id, $last_id){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, rto_tbl.*, rto_payment_tbl.*
					FROM `customer_tbl`, `rto_tbl`, `rto_payment_tbl`
					WHERE customer_tbl.customer_id = ' . $id . ' AND rto_tbl.rto_id = ' . $last_id .' AND rto_payment_tbl.rto_id = ' . $last_id . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getCustomerByIdRTODisplay($id){

    $pdo = $this->getPdo();
    $sql = 'SELECT  *
					FROM  `rto_tbl`
					WHERE `customer_id` = ' . $id . ' AND `remaining_count` != 0 ORDER BY `date_added` DESC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $content = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $content[] = $row;
    }
    return $content;

}

    public function getCustomerPaymentHistoryRTO($id, $rto_id){

        $pdo = $this->getPdo();
        $sql = 'SELECT  rto_tbl.*, rto_payment_tbl.*, rto_payment_tbl.date_added as dateAdded
					FROM  `rto_tbl`, `rto_payment_tbl`
					WHERE rto_tbl.customer_id = ' . $id . ' AND rto_tbl.rto_id = ' . $rto_id . ' AND rto_payment_tbl.rto_id = ' . $rto_id . ' ORDER BY rto_payment_tbl.date_added DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getCustomerPaymentHistorySumRTO($rto_id){


        $pdo = $this->getPdo();
        $sql = 'SELECT  SUM(rto_payment_tbl.amount_paid) AS amount_sum, SUM(rto_payment_tbl.penalty) AS penalty_sum, SUM(rto_tbl.sales_tax) AS tax_sum
					FROM  `rto_payment_tbl`, `rto_tbl`
					WHERE rto_payment_tbl.rto_id = ' . $rto_id . ' AND rto_tbl.rto_id = ' . $rto_id . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }
	
	public function getCustomerByIdLayawayDisplay($id){

		$pdo = $this->getPdo();
		$sql = 'SELECT  *
						FROM  `layaway_tbl`
						WHERE `customer_id` = ' . $id . ' AND `status` = "active" ORDER BY `date_added` DESC';

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	
	public function getCustomerPaymentHistoryLayaway($id, $lid){

        $pdo = $this->getPdo();
        $sql = 'SELECT  layaway_tbl.*, layaway_payment_tbl.*, layaway_payment_tbl.date_added as dateAdded
					FROM  `layaway_tbl`, `layaway_payment_tbl`
					WHERE layaway_tbl.customer_id = ' . $id . ' AND layaway_tbl.lid = ' . $lid . ' AND layaway_payment_tbl.lid = ' . $lid . ' ORDER BY layaway_payment_tbl.date_added DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }
	
	public function getCustomerPaymentHistorySumLayaway($lid){


        $pdo = $this->getPdo();
        $sql = 'SELECT  SUM(layaway_payment_tbl.amount_paid) AS amount_sum, SUM(layaway_payment_tbl.penalty) AS penalty_sum, SUM(layaway_tbl.tax) AS tax_sum
					FROM  `layaway_payment_tbl`, `layaway_tbl`
					WHERE layaway_payment_tbl.lid = ' . $lid . ' AND layaway_tbl.lid = ' . $lid . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getCustomerPaymentHistoryPawns($id, $pawn_id, $type){

        if($type == 'general_pawns'){
            $transaction = 'loan_info_tbl';
        }
        else{
            $transaction = 'title_pawn_tbl';
        }
        $pdo = $this->getPdo();
        $sql = 'SELECT  *
					FROM  `payment_tbl`
					WHERE `customer_id` = ' . $id . ' AND `transaction_id` = ' . $pawn_id . ' AND `transaction` = "' . $transaction . '" ORDER BY date_added DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getCustomerByIdPawns($id, $pawn_id){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, loan_info_tbl.*
					FROM `customer_tbl`, `loan_info_tbl`
					WHERE customer_tbl.customer_id = ' . $id . ' AND loan_info_tbl.loan_info_id = ' . $pawn_id .'';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getCustomerPins($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, refill_tbl.*
					FROM  `customer_tbl`, `refill_tbl`
					WHERE customer_tbl.customer_id = refill_tbl.customer_id AND refill_tbl.date_added >= "' . $from . '" AND refill_tbl.date_added <= "' . $to . '" ORDER BY refill_tbl.date_added DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getRepairInvoiceByDay($date){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, repair_invoice_tbl.*
					FROM  `customer_tbl`, `repair_invoice_tbl`
					WHERE customer_tbl.customer_id = repair_invoice_tbl.customer_id AND repair_invoice_tbl.date_added = "' . $date . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }



    public function getRefillByDay($date){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, refill_tbl.*
					FROM  `customer_tbl`, `refill_tbl`
					WHERE customer_tbl.customer_id = refill_tbl.customer_id AND refill_tbl.date_added LIKE "' . $date . '%"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }



    public function getRTOByDay($date){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, rto_tbl.*
					FROM  `customer_tbl`, `rto_tbl`
					WHERE customer_tbl.customer_id = rto_tbl.customer_id AND rto_tbl.date_added LIKE "' . $date . '%"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getLayawayByDay($date){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, layaway_tbl.*
					FROM  `customer_tbl`, `layaway_tbl`
					WHERE customer_tbl.customer_id = layaway_tbl.customer_id AND layaway_tbl.date_added LIKE "' . $date . '%"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }

    public function getScrapByDay($date){
        $pdo = $this->getPdo();
        $sql = 'SELECT  customer_tbl.*, scrap_info_tbl.*
					FROM  `customer_tbl`, `scrap_info_tbl`
					WHERE customer_tbl.customer_id = scrap_info_tbl.customer_id AND scrap_info_tbl.date_added = "' . $date . '"';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getTitlePawnImages($pawn_id){
        $pdo = $this->getPdo();
        $sql = 'SELECT  * FROM `title_pawn_images`
					WHERE `title_pawn_id` = ' . $pawn_id . '';

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


    public function getUnredeemedTitlePawns(){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, title_pawn_tbl.* FROM `title_pawn_tbl`, `customer_tbl` WHERE title_pawn_tbl.customer_id = customer_tbl.customer_id AND  (title_pawn_tbl.status = "unredeemed" OR title_pawn_tbl.status = "repoed")  ORDER BY title_pawn_tbl.date_added DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    public function getVehicleInventory(){

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `vehicle_inventory_tbl` WHERE `quantity` != 0';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }


    public function getCustomerByIdVehicleSale($id)
    {
        $pdo = $this->getPdo();


        $sql = 'SELECT customer_tbl.*, vehicle_sale_tbl.sub_total, vehicle_sale_tbl.tax, vehicle_sale_tbl.total, vehicle_sale_tbl.payment
					FROM `customer_tbl`, `vehicle_sale_tbl`
					WHERE customer_tbl.customer_id = ' . $id . '';

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getVehicleSaleItemSold($id, $last_id){
        $pdo = $this->getPdo();
        $sql = 'SELECT vehicle_inventory_tbl.*, vehicle_sale_item_sold.quantity as quantity_sold, vehicle_sale_tbl.* FROM `vehicle_inventory_tbl`, `vehicle_sale_item_sold`, `vehicle_sale_tbl`
                WHERE vehicle_sale_tbl.customer_id = ' . $id . ' AND vehicle_inventory_tbl.vi_id = vehicle_sale_item_sold.vi_id AND vehicle_sale_tbl.vehicle_sale_id = ' . $last_id . ' AND vehicle_sale_item_sold.vehicle_sale_id = ' . $last_id . '
                GROUP BY vehicle_inventory_tbl.vi_id;
                ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }



    public function getVehicleSaleSum($id, $last_id){
        $pdo = $this->getPdo();
        $sql = 'SELECT SUM(sub_total) as subTotal FROM `vehicle_sale_tbl` WHERE `customer_id` = ' . $id . ' AND `vehicle_sale_id` = ' . $last_id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $subTotal = $result['subTotal'];

        return $subTotal;
    }


    public function getScrapItemTmp($id)
    {
        $pdo = $this->getPdo();
        if (!is_numeric($id)){
            $id = '0';
        }

        $sql = 'SELECT * FROM `scrap_inventory` WHERE `customer_id` = ' . $id . ' AND `status` = "tmp"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getScrapDaysOnHold(){

        $pdo = $this->getPdo();

        $sql = 'SELECT `days` FROM `scrap_holding_days`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;

    }



    public function getCheckTransactionByTID($tid){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, customer_tbl.customer_id, check_register_tbl.*
                FROM `customer_tbl`, `check_register_tbl`
                WHERE check_register_tbl.check_id = ' . $tid . '
                AND check_register_tbl.customer_id = customer_tbl.customer_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCheckRegisterByDateRange($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.first_name,customer_tbl.middle_name, customer_tbl.last_name, customer_tbl.customer_id, check_register_tbl.*
                FROM `customer_tbl`, `check_register_tbl`
                WHERE check_register_tbl.customer_id = customer_tbl.customer_id
                AND check_register_tbl.date_added >= "' . $from . '"
                AND check_register_tbl.date_added <= "' . $to . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getLayawayByMonth($from, $to){
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, layaway_tbl.*
                FROM `customer_tbl`, `layaway_tbl`
                WHERE layaway_tbl.customer_id = customer_tbl.customer_id
                AND layaway_tbl.date_added >= "' . $from . '"
                AND layaway_tbl.date_added <= "' . $to . '"
                AND layaway_tbl.status = "active"
                ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getInactiveLayawayByMonth($from, $to){
        $pdo = $this->getPdo();
        $sql = 'SELECT customer_tbl.*, layaway_tbl.*
                FROM `customer_tbl`, `layaway_tbl`
                WHERE layaway_tbl.customer_id = customer_tbl.customer_id
                AND layaway_tbl.date_added >= "' . $from . '"
                AND layaway_tbl.date_added <= "' . $to . '"
                AND layaway_tbl.status = "inactive"
                ';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getCustomerLayawayItems($customer_id, $lid){
        $pdo = $this->getPdo();
        $sql = 'SELECT inventory_tbl.*, point_of_sale_item_sold.*
                FROM `inventory_tbl`, `point_of_sale_item_sold`
                WHERE point_of_sale_item_sold.customer_id = ' . $customer_id .'
                AND point_of_sale_item_sold.sale_id = ' . $lid . '
                AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    /* Add Data*/
	public function addCustomer()
	{
		if ($_POST['submit']){
	
			$first_name =  addslashes($_POST['first_name']);
			$middle_name =  (isset($_POST['middle_name']) ? addslashes($_POST['middle_name']) : ' ');
			$last_name =  addslashes($_POST['last_name']);
			$address =  (isset($_POST['address']) ? addslashes($_POST['address']) : 'N/A');
			if(isset($_POST['date_birth'])){
				if($_POST['date_birth'] != '' || $_POST['date_birth'] != null){
					$dob = $_POST['date_birth'];
				$timestamp = DateTime::createFromFormat('m/d/Y', $dob);
				$dob  = $timestamp->format('Y-m-d');
				}else{
					$dob = '0000-00-00';
				}
				
			}else{
				$dob = '0000-00-00';
			}
			
			if(isset($_POST['dl_issue_date'])){
				if($_POST['dl_issue_date'] != '' || $_POST['dl_issue_date'] != null){
					$dl_issue_date =  addslashes($_POST['dl_issue_date']);
					$timestamp = DateTime::createFromFormat('m/d/Y', $dl_issue_date);
					$dl_issue_date  = $timestamp->format('Y-m-d');
				}else{
					$dl_issue_date = '0000-00-00';
				}
				
			}else{
				$dl_issue_date = '0000-00-00';
			}
			
			if(isset($_POST['dl_expire_date'])){
				if($_POST['dl_expire_date'] != '' || $_POST['dl_expire_date'] != null){
					$dl_expire_date =  addslashes($_POST['dl_expire_date']);
					$timestamp = DateTime::createFromFormat('m/d/Y', $dl_expire_date);
					$dl_expire_date  = $timestamp->format('Y-m-d');

				}else{
					$dl_expire_date = '0000-00-00';
				}
				
			}else{
				$dl_expire_date = '0000-00-00';
			}
           
			$city =  (isset($_POST['city']) ? addslashes($_POST['city']) : 'N/A');
			$state =  (isset($_POST['state']) ? addslashes($_POST['state']) : 'N/A');
			$zip =  (isset($_POST['zip']) ? addslashes($_POST['zip']) : '0000');
			$home_no =  (isset($_POST['home_number']) ? addslashes($_POST['home_number']) : '0');
			$cell_no =  (isset($_POST['cell_number']) ? addslashes($_POST['cell_number']) : '0');
			$dl_number =  (isset($_POST['dl_number']) ? addslashes($_POST['dl_number']) : '0');
			
			

			$sss_no = (isset($_POST['sss_no']) ? addslashes($_POST['sss_no']) : '0');
			$height =  (isset($_POST['height']) ? addslashes($_POST['height']) : '0');
			$weight =  (isset($_POST['weight']) ? addslashes($_POST['weight']) : '0');
			$eye_color =  (isset($_POST['eye_color']) ? addslashes($_POST['eye_color']) : 'N/A');
			$date_added =  (isset($_POST['date']) ? addslashes($_POST['date']) : ' ');




		if(isset($_FILES["customer_photo"]['tmp_name'])){
			if($_FILES["customer_photo"]['tmp_name'] != '' || $_FILES["customer_photo"]['tmp_name'] != null){
				 $customer_photo = addslashes(file_get_contents($_FILES["customer_photo"]['tmp_name']));
			}else{
				$customer_photo = null;
			}
		}else{
			$customer_photo = null;
		}
		
		if(isset($_FILES["dl_photo"]['tmp_name'])){
			if($_FILES["dl_photo"]['tmp_name'] != '' || $_FILES["dl_photo"]['tmp_name'] != null){
				$dl_photo = addslashes(file_get_contents($_FILES["dl_photo"]['tmp_name']));
			}else{
				$dl_photo = null;
			}
		}else{
			$dl_photo = null;
		}
		
		if(isset($_FILES["sss_photo"]['tmp_name'])){
			if($_FILES["sss_photo"]['tmp_name'] != '' || $_FILES["sss_photo"]['tmp_name'] != null){
				  $sss_photo = addslashes(file_get_contents($_FILES["sss_photo"]['tmp_name']));
			}else{
				$sss_photo = null;
			}
		}else{
			$sss_photo = null;
		}



          


            try{

                $pdo = $this->getPdo();
                $sql = 'INSERT INTO `customer_tbl` (`first_name`, `middle_name`, `last_name`,`birth_date`, `address`, `city`, `state`, `zip`, `home_no`, `cell_no`, `drivers_license_no`, `dl_issue_date`, `dl_expire_date`, `height`, `weight`, `eye_color`, `date_added`, `sss_no`, `customer_photo`, `dl_photo`, `sss_photo`) VALUES ("' . $first_name . '", "' . $middle_name . '", "' . $last_name . '", "' . $dob . '", "' . $address . '", "' . $city . '", "' . $state . '", "' . $zip . '", "' . $home_no . '", "' . $cell_no . '", "' . $dl_number . '", "' . $dl_issue_date . '", "' . $dl_expire_date . '", "' . $height . '", "' . $weight . '", "' . $eye_color . '", "' . $date_added . '", "' . $sss_no . '", "' . $customer_photo . '", "' . $dl_photo . '", "' . $sss_photo . '")';
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute();

                $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Customer successfully added.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');

		}
		
	}
	
	
	public function addPawnItemTmp()
	{
		
		$customer_id = $_POST['customer_id'];
		$item_description = addslashes($_POST['item_description']);
		$serial_number = $_POST['serial_number'];
		$loan_amount = $_POST['loan_amount'];
		$retail = $_POST['retail'];
        $date_added = $_POST['date_added'];
		
		
		$loan_amount = str_replace(',','', '' . $loan_amount . '');
		$retail = str_replace(',','', '' . $retail . '');
		
		$image_name =  addslashes($_FILES["fileToUpload"]["name"]);
		$target_dir = "images/pawned_items/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		if(isset($_FILES["fileToUpload"]['tmp_name'])){
			if($_FILES["fileToUpload"]['tmp_name'] != '' || $_FILES["fileToUpload"]['tmp_name'] != null){
				 $item_photo = addslashes(file_get_contents($_FILES["fileToUpload"]['tmp_name']));
			}else{
				$item_photo = null;
			}
		}else{
			$item_photo = null;
		}




        if(isset($_POST["submit"])) {

            if($image_name == '') {

                $image_name = '';
            }
            else {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo '<div class="alert alert-danger">';
                    echo "File is not an image.";
                    echo '</div>';
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (empty($_FILES["fileToUpload"]["name"])) {
                    echo '<div class="alert alert-danger">';
                    echo "No image uploaded.";
                    echo '</div>';
                    $uploadOk = 0;
                } else {
                    if (file_exists($target_file)) {
                        echo '<div class="alert alert-danger">';
                        echo "Sorry, file already exists.";
                        echo '</div>';
                        $uploadOk = 0;

                    }
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo '<div class="alert alert-danger">';
                    echo "Sorry, your file is too large.";
                    echo '</div>';
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo '<div class="alert alert-danger">';
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    echo '</div>';
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo '<div class="alert alert-info">';
                    echo "Sorry, your file was not uploaded.";
                    echo '</div>';
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                    }
                }
            }

            $pdo = $this->getPdo();
            $sql = 'INSERT INTO `pawn_items_tmp` (`customer_id`, `item_description`, `serial_number`, `loan_amount`, `retail`, `pawn_image`, `blob_image`, `quantity`, `status`, `type`, `date_added`) VALUES ("' . $customer_id . '", "' . $item_description . '", "' . $serial_number . '", "' . $loan_amount . '", "' . $retail . '", "' . $image_name . '","' . $item_photo . '", 1, "pending", "tmp", "' . $date_added . '")';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();

        }

    }
	
	public function addOutrightItemTmp()
	{
		
		$customer_id = $_POST['customer_id'];
		$item_description =  addslashes($_POST['item_description']);
		$serial_number = $_POST['serial_number'];
		$purchase_price = $_POST['purchase_price'];
		$purchase_price = str_replace(',','', '' . $purchase_price . '');
		$retail = $_POST['retail'];
		$retail = str_replace(',','', '' . $retail . '');
        $quantity = $_POST['quantity'];
        $total = $purchase_price * $quantity;
		$image_name =  addslashes($_FILES["fileToUpload"]["name"]);
		$target_dir = "images/outright_items/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);




        if(isset($_POST["submit"])) {

            if($image_name == '') {

                $image_name = '';
            }
            else {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo '<div class="alert alert-danger">';
                    echo "File is not an image.";
                    echo '</div>';
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (empty($_FILES["fileToUpload"]["name"])) {
                    echo '<div class="alert alert-danger">';
                    echo "No image uploaded.";
                    echo '</div>';
                    $uploadOk = 0;
                } else {
                    if (file_exists($target_file)) {
                        echo '<div class="alert alert-danger">';
                        echo "Sorry, file already exists.";
                        echo '</div>';
                        $uploadOk = 0;

                    }
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo '<div class="alert alert-danger">';
                    echo "Sorry, your file is too large.";
                    echo '</div>';
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo '<div class="alert alert-danger">';
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    echo '</div>';
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo '<div class="alert alert-info">';
                    echo "Sorry, your file was not uploaded.";
                    echo '</div>';
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                    }
                }
            }

            $pdo = $this->getPdo();
            $sql = 'INSERT INTO `outright_items_tmp` (`customer_id`, `item_description`, `serial_number`, `purchase_price`, `retail`, `quantity`,`total`, `pawn_image`,`status`, `type`) VALUES ("' . $customer_id . '", "' . $item_description . '", "' . $serial_number . '", "' . $purchase_price . '", "' . $retail . '", ' . $quantity . ', ' . $total. ', "' . $image_name . '","pending", "tmp")';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

        }
				
	
		
	}
	
	public function transferOutrightItems($id, $last_id){
	
				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `outright_items` SELECT * FROM `outright_items_tmp` WHERE `customer_id` = ' . $id . '';
				$sql_update = 'UPDATE `outright_items` SET `type` = "moved", `status` = "Paid", `outright_id` = ' . $last_id . ' WHERE `customer_id` = ' . $id . ' AND type = "tmp"';
				$stmt = $pdo->prepare($sql);
				$stmt_update  = $pdo->prepare($sql_update);
				$result = $stmt->execute();
				$result_update = $stmt_update->execute();
				
	
	}
	
	public function removeTmpOutrigtItems($id){
		
		/*
					$files = glob("../images/pawned_items/*"); 
					$attachment = $this->getFileNameFromTmp($id);
					foreach ($files as $v)
					{
						foreach ($attachment as $row)
						{
							$image = "../images/pawned_items/" . $row['pawn_image'];
							if ($v === $image){
								
								unlink($v);
							}
							
						}
						
								
								
					}
	*/
				$pdo = $this->getPdo();
				$sql = 'DELETE FROM `outright_items_tmp` WHERE `customer_id` = ' . $id . '';
				$stmt = $pdo->prepare($sql);
				$result = $stmt->execute();
				
					
		
	}
    public function removeAddedParts($id){

        $pdo = $this->getPdo();
        $sql = 'DELETE FROM `repair_parts` WHERE `customer_id` = ' . $id . ' AND `status` = "pending"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }

    public function removeAddedScrap($id){

        $pdo = $this->getPdo();
        $sql = 'DELETE FROM `scrap_inventory` WHERE `customer_id` = ' . $id . ' AND `status` = "tmp"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }

	
	public function addOutright($id)
	{

        $purchase_amount = $_POST['purchase_amount'];
        $purchase_amount = str_replace(',','', '' . $purchase_amount . '');
        $retail_price = $_POST['retail_price'];
        $date = $_POST['date'];
        $retail_price = str_replace(',','', '' . $retail_price . '');

					  
		if (isset($_POST['submit']))
		{
				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `outright_info_tbl` (`customer_id`, `purchase_amount`, `retail_price`, `date_added`) VALUES (' . $id . ', ' . $purchase_amount . ', ' . $retail_price . ', "' . $date . '")';
				$stmt = $pdo->prepare($sql);
				$result = $stmt->execute();
                $lastId = $pdo->lastInsertId();

                return $lastId;

		}
	}
	
	
	
	
	public function addPawn($id)
	{
		$data = array('total_loan_amount' => 'total_loan_amount',
					  'loan_matrix_id' => 'loan_matrix_id',
					  'total_loaned' => 'total_loaned',
					  'interest_rate' => 'interest_rate',
                      'interest_accured' => 'interest_accured',
					  'annual_percentage_rate' => 'annual_percentage_rate',
					  'terms_of_loan' => 'terms_of_loan',
					  'due_date' => 'due_date',
					  'date' => 'date');
					  
		
		$data = array_map( 'addslashes', $_POST['data'] );
					  
		
		if (isset($_POST['data']))
		{

				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `loan_info_tbl` (`customer_id`, `loan_amount`, `loan_matrix_id`, `total_loan`, `interest_rate`, `interest_accured`, `apr`, `terms_of_loan`, `due_date`, `date_added`, `status`, `accured_before`) VALUES (' . $id . ', :total_loan_amount, :loan_matrix_id, :total_loaned, :interest_rate, :interest_accured, :annual_percentage_rate, :terms_of_loan, :due_date, :date, "active", :interest_accured)';
				$stmt = $pdo->prepare($sql);
				$result = $stmt->execute($data);
                $lastId = $pdo->lastInsertId();


                return $lastId;

		}
	}
	
	public function transferPawnItems($id, $last_id){
	
				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `pawn_items`(pawn_items.customer_id, pawn_items.loan_info_id, pawn_items.item_description, pawn_items.serial_number, pawn_items.loan_amount, pawn_items.retail, pawn_items.pawn_image, pawn_items.blob_image, pawn_items.quantity, pawn_items.status, pawn_items.type, pawn_items.date_added) SELECT pawn_items_tmp.customer_id, pawn_items_tmp.loan_info_id, pawn_items_tmp.item_description, pawn_items_tmp.serial_number, pawn_items_tmp.loan_amount, pawn_items_tmp.retail, pawn_items_tmp.pawn_image, pawn_items_tmp.blob_image, pawn_items_tmp.quantity, pawn_items_tmp.status, pawn_items_tmp.type, pawn_items_tmp.date_added FROM `pawn_items_tmp` WHERE `customer_id` = ' . $id . '';
				$sql_update = 'UPDATE `pawn_items` SET `type` = "moved", `status` = "pawned", `loan_info_id` = ' . $last_id . ' WHERE `customer_id` = ' . $id . ' AND type = "tmp"';
				$stmt = $pdo->prepare($sql);
				$stmt_update  = $pdo->prepare($sql_update);
				$result = $stmt->execute();
				$result_update = $stmt_update->execute();
				
	
	}
	
	public function removeTmpPawnItems($id){
		
		/*
					$files = glob("../images/pawned_items/*"); 
					$attachment = $this->getFileNameFromTmp($id);
					foreach ($files as $v)
					{
						foreach ($attachment as $row)
						{
							$image = "../images/pawned_items/" . $row['pawn_image'];
							if ($v === $image){
								
								unlink($v);
							}
							
						}
						
								
								
					}
	*/
				$pdo = $this->getPdo();
				$sql = 'DELETE FROM `pawn_items_tmp` WHERE `customer_id` = ' . $id . '';
				$stmt = $pdo->prepare($sql);
				$result = $stmt->execute();
				

		
	}
	
	public function getFileNameFromTmp($id){
	
				$pdo = $this->getPdo();
				$sql = 'SELECT `pawn_image` FROM `pawn_items_tmp` WHERE `customer_id` = ' . $id . ' AND `type` = "tmp"';
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				$content = array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$content[] = $row;
				}
				return $content;
	}
	
	
	
	public function addTitlePawn()
	{
		
				$customer_id = $_POST['customer_id'];
				$vin = $_POST['vin_no'];
				$year = $_POST['year'];
				$model = $_POST['model'];
				$color = $_POST['color'];
                $make = $_POST['make'];
                $style = $_POST['style'];
				$mileage = $_POST['mileage'];
				$no_of_doors = $_POST['no_of_doors'];
				$vehicle_condition = $_POST['vehicle_condition'];
				$title_no = $_POST['title_no'];
				$tag_no = $_POST['tag_no'];
				$total_loan_amount = $_POST['total_loan_amount'];
				$retail = $_POST['retail'];
				
				$total_loan_amount = str_replace(',','', '' . $total_loan_amount . '');
				$retail = str_replace(',','', '' . $retail . '');
				
				$loan_matrix_id = $_POST['loan_matrix_id'];
				$total_loan = $_POST['total_loan'];
				$total_loan = str_replace(',','', '' . $total_loan . '');
				$amount_behalf = $_POST['aBehalf'];
				$amount_behalf = str_replace(',','', '' . $amount_behalf . '');
				$interest_rate = $_POST['interest_rate'];
                $interest_accured = $_POST['interest_accured'];
                $total_loan = $total_loan_amount + $interest_accured;
				$apr = $_POST['apr'];
				$terms_of_loan = $_POST['terms_of_loan']; 
				$due_date = $_POST['due_date'];
				$date_added = $_POST['date_added'];


                if(isset($_POST['exempt'])){
                    $exempt = $_POST['exempt'];
                }
                else { 
                    $exempt = 0;
                }


				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `title_pawn_tbl` (`customer_id`, `vin_no`, `year`, `model`, `color`, `make`, `style`, `mileage`, `no_of_doors`, `vehicle_condition`, `title_no`, `tag_no`, `total_loan_amount`, `retail`, `loan_matrix_id`, `total_loan`, `amount_behalf`, `interest_rate`, `interest_accured`, `accured_before`, `apr`, `terms_of_loan`, `due_date`, `date_added`, `status`, `exempt`) VALUES (' . $customer_id . ', "' . $vin . '",' . $year . ',"' . $model . '","' . $color . '", "' . $make .'", "' . $style . '", ' . $mileage . ',' . $no_of_doors . ',"' . $vehicle_condition . '","' . $title_no . '","' . $tag_no . '",' . $total_loan_amount . ',' . $retail . ',' . $loan_matrix_id . ',' . $total_loan .', ' . $amount_behalf . ', ' . $interest_rate . ', ' . $interest_accured . ', ' . $interest_accured . ', ' . $apr . ',"' . $terms_of_loan . '","' . $due_date . '","' . $date_added . '", "active", "' . $exempt . '")';
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
                $last_id = $pdo->lastInsertId();


                if(isset($_FILES['title_pawn_image']['tmp_name'])) {
                    for ($i = 0; $i < count($_FILES['title_pawn_image']['tmp_name']); $i++) {

                        if (is_uploaded_file($_FILES['title_pawn_image']['tmp_name'][$i]) && getimagesize($_FILES['title_pawn_image']['tmp_name'][$i]) != false) {
                            $imgFile = addslashes($_FILES['title_pawn_image']['name'][$i]);
                            $imgData = addslashes(file_get_contents($_FILES['title_pawn_image']['tmp_name'][$i]));
                            $imageProperties = getimageSize($_FILES['title_pawn_image']['tmp_name'][$i]);
                            $sql = 'INSERT INTO `title_pawn_images` (`title_pawn_id`, `title_image_file`, `title_image_properties`, `title_image_name`) VALUES (' . $last_id . ', "' . $imgFile . '", "' . $imageProperties['mime'] . '", "' . $imgData . '")';
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                        }


                    }
                }





               $query = array('customer_id' => $customer_id,
                    'loan_id' => $last_id,);
                 header('Location: print-title-pawn-ticket.php?' . http_build_query($query));
                exit;


				

				
				
	}
	
	
	
	public function addPayment($loan_id, $customer_id, $total_amount, $date, $interest, $transaction, $state, $tid, $penalty)
	{

				$total_amount = str_replace(',','', '' . $total_amount . '');
		
				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `payment_tbl` (`customer_id`, `total_amount`, `payment_method`, `transaction`, `date_added`, `transaction_id`) VALUES ("' . $customer_id . '", "' . $total_amount . '", "Cash", "' . $transaction . '",  "' . $date . '", "' . $tid . '")';
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
                $lastId = $pdo->lastInsertId();


                $query = array('customer_id' => $customer_id,
                               'loan_id' => $loan_id,
                               'payment_id' => $lastId,
                               'interest' => $interest,
							   'penalty' => $penalty,
                               'state' => $state
                               );

                if ($transaction == 'loan_info_tbl'){header('Location: print-payment-ticket.php?' . http_build_query($query));}
                if ($transaction == 'title_pawn_tbl'){header('Location: print-title-payment-ticket.php?' . http_build_query($query));}
                exit;
			
		
		
	}
	
	public function addInventory()
	{
		$item_no = addslashes($_POST['item_no']);
		$description = addslashes($_POST['description']);
		$cost = $_POST['cost'];
		$cost = str_replace(',','', '' . $cost . '');
		$retail = $_POST['retail'];
		$retail = str_replace(',','', '' . $retail . '');
		$quantity = $_POST['quantity'];
		$data_added = $_POST['date_added'];
		
		if(isset($_FILES["item_photo"]['tmp_name'])){
			if($_FILES["item_photo"]['tmp_name'] != '' || $_FILES["item_photo"]['tmp_name'] != null){
				 $item_photo = addslashes(file_get_contents($_FILES["item_photo"]['tmp_name']));
			}else{
				$item_photo = null;
			}
		}else{
			$item_photo = null;
		}
				
		if (isset($_POST['submit']))
		{
				try{
					$pdo = $this->getPdo();
				$sql = 'INSERT INTO `inventory_tbl` (`item_no`, `description`, `cost`, `retail`, `quantity`, `date_added`, `image`) VALUES ("' . $item_no . '", "' . $description . '", "' . $cost . '", "' . $retail . '", "' . $quantity . '", "' . $data_added . '", "' . $item_photo . '")';
				$stmt = $pdo->prepare($sql);
				$result = $stmt->execute();
				
				 $location = $_SERVER['PHP_SELF'] . '?success=true&msg=Item successfully added.';

        }catch (Exception $e){
            $location = $_SERVER['PHP_SELF'] . '?success=false&msg=Something went wrong, please try again';
        }

        header('Location: ' . $location . '');
				
		}
		
		
	}
	
	public function addSoldItem($values)
	{

				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `point_of_sale_item_sold` (`customer_id`, `item_id`,  `quantity`, `sale_id`) VALUES ' . implode(',', $values). '';
				$stmt = $pdo->prepare($sql);
				$stmt->execute();

	}
	
	public function updateItemQuantity($item_no, $qty)
	{
		
	
				$pdo = $this->getPdo();
				$sql = 'UPDATE `inventory_tbl` SET `quantity` = (`quantity` - ' . $qty . ') WHERE `inventory_id` = ' . $item_no . '';
				$stmt = $pdo->prepare($sql);
				$result = $stmt->execute();
			
	}
	
	public function addPointOfSale($customer_id, $sub_total, $tax, $total, $payment, $status, $date_added)
	{
	
				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `point_of_sale_tbl` (`customer_id`, `sub_total`, `tax`, `total`, `payment`, `status`, `date_added`) VALUES (' . $customer_id . ',' . $sub_total . ',' . $tax . ',' . $total. ',"' . $payment . '" , "' . $status . '", "' . $date_added . '")';
				$stmt = $pdo->prepare($sql);
				$result = $stmt->execute();
                $lastId = $pdo->lastInsertId();

                return $lastId;

	}
	
	public function addLayaway($customer_id, $sub_total, $tax, $total, $downpayment, $status, $date_added, $maximum_days, $grace_period, $minimum_required)
	{

                $due_date = date('Y-m-d', strtotime($date_added . '+30 days'));
				$pdo = $this->getPdo();
				$sql = 'INSERT INTO `layaway_tbl` (`customer_id`, `sub_total`, `tax`, `total`, `fixed_total`, `down_payment`, `status`, `date_added`, `maximum_days`, `grace_period`, `minimum_required`, `due_date`) VALUES (' . $customer_id . ',' . $sub_total . ',' . $tax . ',' . $total. ',"' . $total . '", "' . $downpayment . '", "' . $status . '", "' . $date_added . '", "' . $maximum_days . '", "' . $grace_period . '", "' . $minimum_required . '", "' . $due_date . '")';
				$stmt = $pdo->prepare($sql);
				$result = $stmt->execute();
                $lastId = $pdo->lastInsertId();
				if($downpayment > 0){
					$this->registerPayment($customer_id, $downpayment, 'layaway_tbl', $date_added, $lastId);
				}
                return $lastId;

	}

    public function addParts(){
            $customer_id = $_POST['customer_id'];
            $description = addslashes($_POST['parts_description']);
            $cost = $_POST['parts_cost'];
            $cost = str_replace(',','', '' . $cost . '');

            $retail = $_POST['parts_retail'];
            $retail = str_replace(',','', '' . $retail . '');
            $quantity = $_POST['quantity'];



        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `repair_parts` (`customer_id`, `description`,  `cost`, `retail`, `quantity`, `status`) VALUES ("' . $customer_id . '", "' . $description . '", "' . $cost . '", "' . $retail . '", "' . $quantity . '", "pending")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    public function addNewRepairInvoice(){

        $customer_id = $_POST['customer_id'];
        $repair_item_description = addslashes($_POST['repair_item_description']);
        $repair_serial_number = $_POST['serial_number'];
        $description_to_complete = addslashes($_POST['description_to_complete']);
        $labor_charge = $_POST['labor_charge'];
        $labor_charge = str_replace(',','', '' . $labor_charge . '');
        $total_cost = $_POST['total_cost'];
        $total_cost = str_replace(',','', '' . $total_cost . '');
        $tax = $_POST['tax'];
        $tax = str_replace(',','', '' . $tax . '');
        $deposit = $_POST['deposit'];
        $deposit = str_replace(',','', '' . $deposit . '');
        $balance = $_POST['balance'];
        $balance = str_replace(',','', '' . $balance . '');
        $repair_status = $_POST['repair_status'];
        $date_added = $_POST['date_added'];


        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `repair_invoice_tbl` (`customer_id`, `repair_item_description`,  `repair_serial_number`, `description_to_completed`, `labor_charge`, `total_cost`, `tax`, `deposit`, `balance`, `repair_status`, `invoice_status`, `date_added` ) VALUES ("' . $customer_id . '", "' . $repair_item_description . '", "' . $repair_serial_number . '", "' . $description_to_complete . '", "' . $labor_charge . '", "' . $total_cost . '", "' . $tax . '", "' . $deposit . '", "' . $balance . '", "' . $repair_status . '", "open", "' . $date_added . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $lastId = $pdo->lastInsertId();


        $sql_update = 'UPDATE `repair_parts` SET `status` = "active", `repair_invoice_id` = ' . $lastId . ' WHERE `customer_id` = ' . $customer_id . ' AND `status` = "pending"';
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute();

        if($deposit > 0){
            $pdo = $this->getPdo();
            $sql = 'INSERT INTO `payment_tbl` (`customer_id`, `total_amount`,  `payment_method`, `transaction`, `date_added`, `transaction_id`) VALUES ("' . $customer_id . '", "' . $deposit . '", "cash", "repair_invoice_tbl", "' . $date_added . '", "' . $lastId . '")';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }

        $query = array('customer_id' => $customer_id,
            'repair_id' => $lastId);

        header('Location: print-repair-ticket.php?' . http_build_query($query));
        exit;


    }

    public function addRepairInvoicePayment(){

        $customer_id = $_POST['customer_id'];
        $repair_id = $_POST['repair_id'];
        $amount_paid = $_POST['amount_paid'];
        $amount_paid = str_replace(',','', '' . $amount_paid . '');
        $date_added = $_POST['date_added'];


        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `payment_tbl` (`customer_id`, `total_amount`,  `payment_method`, `transaction`, `date_added`, `transaction_id`) VALUES ("' . $customer_id . '", "' . $amount_paid . '", "cash", "repair_invoice_tbl", "' . $date_added . '", "' . $repair_id . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql_update = 'UPDATE `repair_invoice_tbl` SET `balance` = 0, `invoice_status` = "complete" WHERE `customer_id` = ' . $customer_id . ' AND `repair_invoice_id` = ' . $repair_id . '';
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute();


        $query = array('customer_id' => $customer_id,
            'repair_id' => $repair_id);

        header('Location: print-repair-payment-ticket.php?' . http_build_query($query));
        exit;



    }

    public function addNewRefill(){
        $customer_id = $_POST['customer_id'];

        $cost = $_POST['cost'];
        $cost_hidden = $_POST['hidden_cost'];
        $amount_paid = str_replace(',','', '' . $cost . '');
        $qty = $_POST['quantity'];
        $plan_name = addslashes($_POST['plan_name']);
        $pin = $_POST['pin'];
        $date_added = $_POST['date'];
        $tax = $_POST['tax'];
        $tax = $tax * $qty;
        $grand_total = $amount_paid + $tax;


        if($customer_id == 0){
            $customer_id = 1;
        }

        $cp_number = $_POST['customer_cp_number_input'];


        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `refill_tbl` (`customer_id`, `plan_name`, `pin_no`, `cp_number`, `cost`, `quantity`, `total_cost`, `grand_total`, `date_added`) VALUES ("' . $customer_id . '", "' . $plan_name . '", "' . $pin . '", "' . $cp_number . '", "' . $cost_hidden . '", "' . $qty .'", "' . $amount_paid . '", "' . $grand_total . '", "' . $date_added . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $lastId = $pdo->lastInsertId();

        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `payment_tbl` (`customer_id`, `total_amount`,  `payment_method`, `transaction`, `date_added`, `transaction_id`) VALUES ("' . $customer_id . '", "' . $amount_paid . '", "cash", "refill_tbl", "' . $date_added . '", "' . $lastId . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();


        $query = array('customer_id' => $customer_id,
            'refill_id' => $lastId);

        header('Location: print-refill-payment-ticket.php?' . http_build_query($query));
        exit;

    }

    public function addRTO(){

        $customer_id = $_POST['customer_id'];
        $term = addslashes($_POST['term']);
        $downpayment = $_POST['downpayment'];
        $number_of_payments = $_POST['number_of_payments'];
        $amount_each_payment = $_POST['amount_each_payment'];
        $other_charges = $_POST['other_charges'];
		$amount_behalf = $_POST['amount_behalf'];
        $tax = $_POST['tax'];
        $merchandise = $_POST['merchandise'];

        $model_no = addslashes($_POST['model_no']);
        $descriptiom = addslashes($_POST['description']);
        $serial_no = addslashes($_POST['serial_no']);
        $condtion = addslashes($_POST['condition']);
        $due_date = $_POST['due_date'];
        $due_date = date('Y-m-d', strtotime($due_date));
        $date_added = $_POST['date'];




        $downpayment = str_replace(',','', '' . $downpayment . '');
        $amount_each_payment = str_replace(',','', '' . $amount_each_payment . '');
        $other_charges = str_replace(',','', '' . $other_charges . '');
		$amount_behalf = str_replace(',','', '' . $amount_behalf . '');
        $merchandise = str_replace(',','', '' . $merchandise . '');
        $tax = ($tax * $amount_each_payment) / 100;
		
		$ab_each = $amount_behalf / $number_of_payments; 
		
		$amount_each_payment = $amount_each_payment + $other_charges + $tax + $ab_each;


        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `rto_tbl` (`customer_id`, `payment_term`, `total_no_of_payments`, `downpayment`, `amount_of_each_payment`, `other_charges`, `amount_behalf`, `sales_tax`, `cash_price`, `model_no`, `description`, `serial_no`, `item_condition`, `due_date`,`remaining_count`, `date_added`) VALUES ("' . $customer_id . '", "' . $term . '", "' . $number_of_payments . '", "' . $downpayment . '", "' . $amount_each_payment . '", "' . $other_charges .'", "' . $amount_behalf .'", "' . $tax . '", "' . $merchandise . '", "' . $model_no . '", "' . $descriptiom . '", "' . $serial_no . '", "' . $condtion . '", "' . $due_date . '", "' . $number_of_payments . '", "' . $date_added . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $lastId = $pdo->lastInsertId();


        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `payment_tbl` (`customer_id`, `total_amount`,  `payment_method`, `transaction`, `date_added`, `transaction_id`) VALUES ("' . $customer_id . '", "' . $downpayment . '", "cash", "rto_tbl", "' . $date_added . '", "' . $lastId . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $query = array('customer_id' => $customer_id,
            'rto_id' => $lastId);

        header('Location: print-rto.php?' . http_build_query($query));
        exit;

    }


    public function addVehicleSale($customer_id, $sub_total, $tax, $total, $payment, $status, $date_added)
    {

        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `vehicle_sale_tbl` (`customer_id`, `sub_total`, `tax`, `total`, `payment`, `status`, `date_added`) VALUES (' . $customer_id . ',' . $sub_total . ',' . $tax . ',' . $total. ',"' . $payment . '" , "' . $status . '", "' . $date_added . '")';
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
        $lastId = $pdo->lastInsertId();

        return $lastId;

    }

    public function addVehicleSoldItem($values)
    {

        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `vehicle_sale_item_sold` (`customer_id`, `vi_id`,  `quantity`, `vehicle_sale_id`) VALUES ' . implode(',', $values). '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }

    public function updateVehicleItemQuantity($item_no, $qty)
    {


        $pdo = $this->getPdo();
        $sql = 'UPDATE `vehicle_inventory_tbl` SET `quantity` = (`quantity` - ' . $qty . ') WHERE `vi_id` = ' . $item_no . '';
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();

    }



    public function addScrapItemTmp(){

        $customer_id = $_POST['customer_id'];
        $item_description =  addslashes($_POST['item_description']);
        $retail = $_POST['retail'];
        $retail = str_replace(',','', '' . $retail . '');
        $weight = $_POST['weight'];

        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `scrap_inventory` (`customer_id`, `description`, `weight`, `retail`, `status`) VALUES ("' . $customer_id . '", "' . $item_description . '", "' . $weight . '", "' . $retail . '", "tmp")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }



    public function addScrap($id)
    {

        $purchase_amount = $_POST['purchase_amount'];
        $purchase_amount = str_replace(',','', '' . $purchase_amount . '');
        $amount_paid = $_POST['amount_paid'];
        $amount_paid = str_replace(',','', '' . $amount_paid . '');

        $date = $_POST['date'];



        if (isset($_POST['submit']))
        {
            $pdo = $this->getPdo();
            $sql = 'INSERT INTO `scrap_info_tbl` (`customer_id`, `purchase_amount`, `amount_paid`, `date_added`) VALUES (' . $id . ', ' . $purchase_amount . ', ' . $amount_paid . ', "' . $date . '")';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();
            $lastId = $pdo->lastInsertId();


            $sql = 'UPDATE `scrap_inventory` SET `scrap_id` = ' . $lastId . ', `status` = "hold", `date_added` = "' . $date . '" WHERE `customer_id` = ' . $id . ' AND `status` = "tmp"';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();

            $query = array('customer_id' => $id,
                'scrap_id' => $lastId);

            header('Location: print-scrap-ticket.php?' . http_build_query($query));
            exit;

        }
    }



    public function addNewCheck(){

        $customer_id = $_POST['customer_id'];
      //  $institution = $_POST['institution'];
      //  $address = $_POST['address'];
      //  $city = $_POST['city'];
      //  $state = $_POST['state'];
      //  $zip = $_POST['zip'];
        $amount = $_POST['amount'];
        $amount = str_replace(',','', '' . $amount . '');
        $memo = $_POST['memo'];
  //      $code = $_POST['code'];
        $date = $_POST['date'];
		try{
			
			
			$pdo = $this->getPdo();
			$sql = 'INSERT INTO `check_register_tbl` (`customer_id`, `amount`, `memo`, `date_added`, `status`) VALUES (' . $customer_id . ', ' . $amount . ', "' . $memo . '", "' . $date . '", "active")';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$lastId = $pdo->lastInsertId();

			
			$location = $_SERVER['PHP_SELF'] .'?checkid=' . $lastId . '&success=true&msg=New check successfully added.';

        }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');
      
    }
	
	public function addAttemptCollection($action){

		
       
		try{
			
			if($action == 'attempt'){
			
			$cid = $_POST['cid'];
			$lid = $_POST['lid'];
			$note = $_POST['note'];
			$date_arranged = $_POST['arrangement_date'];
			//$timestamp = DateTime::createFromFormat('m/d/Y', $date_arranged);
			//$date_arranged = $timestamp->format('Y-m-d');
			$date = date('Y-m-d');
			
			
			
			$sql = 'INSERT INTO `collection_attempt` (`customer_id`, `type`, `type_id`, `note`, `arranged_date`, `date_added`) VALUES (' . $cid . ', "loan_info_tbl", "' . $lid . '", "' . $note . '", "' . $date_arranged . '", "' . $date . '")';
			
			// update status
			
			$pdo = $this->getPdo();
			$sql_u = 'UPDATE `loan_info_tbl` SET `status` = "collection" WHERE `loan_info_id` = ' . $lid . '';
			$stmt_u = $pdo->prepare($sql_u);
			$stmt_u->execute();
	
			
			}
			else if($action == 'title_attempt'){
			
			$cid = $_POST['cid'];
			$lid = $_POST['lid'];
			$note = $_POST['note'];
			$date_arranged = $_POST['arrangement_date'];
			//$timestamp = DateTime::createFromFormat('m/d/Y', $date_arranged);
			//$date_arranged = $timestamp->format('Y-m-d');
			$date = date('Y-m-d');
			
			
			
			$sql = 'INSERT INTO `collection_attempt` (`customer_id`, `type`, `loan_info_id`, `note`, `arranged_date`, `date_added`) VALUES (' . $cid . ', "title_pawn_tbl", "' . $lid . '", "' . $note . '", "' . $date_arranged . '", "' . $date . '")';
			
			// update status
			
			$pdo = $this->getPdo();
			$sql_u = 'UPDATE `title_pawn_tbl` SET `status` = "collection" WHERE `tittle_pawn_id` = ' . $lid . '';
			$stmt_u = $pdo->prepare($sql_u);
			$stmt_u->execute();
	
			
			}
			
			$pdo = $this->getPdo();
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			Header('Location: collections.php?msg=success');
		}
		catch(Exception $e){
			Header('Location: collections.php?msg=error');
		}
       
        
    }
	
	public function getCollectionAttemptById($id){
		
		$pdo = $this->getPdo();
        $sql = 'SELECT * FROM `collection_attempt` WHERE `type_id` = ' . $id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       

        return $result['arranged_date'];
		
	}

	



    /* Update Data */
	
	public function updatePawnItem($id, $pawn_id)
	{
			$pdo = $this->getPdo();
			$sql = 'UPDATE `pawn_items` SET `status` = "Paid" WHERE `customer_id` = ' . $id . ' AND `id` = ' . $pawn_id . '';
			$stmt = $pdo->prepare($sql);
			$result = $stmt->execute();
			
		
	}




    public function updateCustomerProfile()
	{
		if(isset($_POST['submit']))
		{
			$first_name = $_POST['first_name'];
			$middle_name = $_POST['middle_name'];
			$last_name = $_POST['last_name'];
			$address = $_POST['address'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			$home_no = $_POST['home_no'];
			$cell_no = $_POST['cell_no'];
			$dl_number = $_POST['dl_no'];
			$sss_no = $_POST['security_no'];
			$height = addslashes($_POST['height']);
			$weight = $_POST['weight'];
			$eye_color = $_POST['eye_color'];
			$id = $_POST['cid'];
			
			
			$pdo = $this->getPdo();
			$sql = 'UPDATE `customer_tbl` SET `first_name` = "' . $first_name . '", `middle_name` = "' . $middle_name . '", `last_name` = "' . $last_name . '", `address` = "' . $address . '", `city` = "' . $city .'", `state` = "' . $state . '", `zip` = "' . $zip . '", `home_no` = "' . $home_no . '", `cell_no` = "' . $cell_no . '", `drivers_license_no` = "' . $dl_number . '", `sss_no` = "' . $sss_no . '", `height` = "' . $height . '", `weight` = "' . $weight . '", `eye_color` = "' . $eye_color . '"
				    WHERE `customer_id` = ' . $id . '';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			
			Header('Location: view-customer.php?name=' . $first_name . ' ' . $middle_name . ' ' . $last_name .'&cid=' . $id . '&action=successful');
			
			
		}

    }
    public function updateLoanStatus($loan_id, $total, $iterest, $due_date, $state, $ifover, $interest_accured, $pass_due, $paidPenalty, $penalty){



        $pdo = $this->getPdo();
        if ($total == '0'){
            $sql = 'UPDATE `loan_info_tbl` SET `status` = "finished", `total_loan` = ' . $total . '
				    WHERE `loan_info_id` = ' . $loan_id . '';
            $sql1 = 'UPDATE `pawn_items` SET `loan_amount` = ' . $total . '
				    WHERE `loan_info_id` = ' . $loan_id . '';
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute();
        }
        else {
            $sql = 'UPDATE `pawn_items` SET `loan_amount` = ' . $total . '
				    WHERE `loan_info_id` = ' . $loan_id . '';

            if ($state == 1){
                $sql1 = 'UPDATE `loan_info_tbl` SET `partial_payment` = (`partial_payment` + ' . $total . '), `due_date` = "' . $due_date . '", `allow_partial` = 2
				    WHERE `loan_info_id` = ' . $loan_id . '';
            }
            else if ($state == 2){

                if($ifover == true){
                    $sql1 = 'UPDATE `loan_info_tbl` SET `total_loan` = ' . $total . ', `interest_accured` = ' . $iterest . ', `due_date` = "' . $due_date . '", `allow_partial` = false, `partial_payment` = 0
				    WHERE `loan_info_id` = ' . $loan_id . '';
                }
                else {
                    $sql1 = 'UPDATE `loan_info_tbl` SET `partial_payment` = (`partial_payment` + ' . $total . '), `due_date` = "' . $due_date . '", `allow_partial` = false
				    WHERE `loan_info_id` = ' . $loan_id . '';
                    }
            }
            else {
				if($pass_due == 1){
					if($paidPenalty == 0){
						$sql1 = 'UPDATE `loan_info_tbl` SET `due_date` = "' . $due_date . '", `allow_partial` = false, `partial_payment` = 0, `penalty` = 0
				    WHERE `loan_info_id` = ' . $loan_id . '';
					}else{
						$sql1 = 'UPDATE `loan_info_tbl` SET `total_loan` = ' . $total . ', `interest_accured` = ' . $iterest . ', `due_date` = "' . $due_date . '", `allow_partial` = false, `partial_payment` = 0, `accured_before` = ' . $interest_accured . ', `penalty` = 0
				    WHERE `loan_info_id` = ' . $loan_id . '';
					}
					
				}else{
					$sql1 = 'UPDATE `loan_info_tbl` SET `total_loan` = ' . $total . ', `interest_accured` = ' . $iterest . ', `due_date` = "' . $due_date . '", `allow_partial` = false, `partial_payment` = 0, `accured_before` = ' . $interest_accured . '
				    WHERE `loan_info_id` = ' . $loan_id . '';
				}
                
            }
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute();

        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    public function flushPartial($id, $last_id, $table){

        if($table == 'loan_info_tbl'){
            $loan_id = 'loan_info_id';
        }
        else {
            $loan_id = 'tittle_pawn_id';
        }
        $pdo = $this->getPdo();
        $sql = 'UPDATE `' . $table . '` SET `partial_payment` = 0
				    WHERE `customer_id` = ' . $id . ' AND `' . $loan_id . '` = ' . $last_id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }



    public function updateTitleLoanStatus($loan_id, $total, $iterest, $due_date,  $state, $ifover, $interest_accured, $pass_due, $paidPenalty, $penalty){


        $pdo = $this->getPdo();
        if ($total == 0 || $total < 0){
            $sql = 'UPDATE `title_pawn_tbl` SET `status` = "finished", `total_loan` = ' . $total . '
				    WHERE `tittle_pawn_id` = ' . $loan_id . '';

        }
        else {

            if ($state == 1){
                $sql = 'UPDATE `title_pawn_tbl` SET `partial_payment` = (`partial_payment` + ' . $total . '), `due_date` = "' . $due_date . '", `allow_partial` = 2
				    WHERE `tittle_pawn_id` = ' . $loan_id . '';
            }
            else if ($state == 2){

                if($ifover == true){
                    $sql = 'UPDATE `title_pawn_tbl` SET `total_loan` = ' . $total . ', `interest_accured` = ' . $iterest . ', `due_date` = "' . $due_date . '", `allow_partial` = false, `partial_payment` = 0
				    WHERE `tittle_pawn_id` = ' . $loan_id . '';
                }
                else {
                    $sql = 'UPDATE `title_pawn_tbl` SET `partial_payment` = (`partial_payment` + ' . $total . '), `due_date` = "' . $due_date . '", `allow_partial` = false
				    WHERE `tittle_pawn_id` = ' . $loan_id . '';
                }
            }
            else {
				
				if($pass_due == 1){
					if($paidPenalty == 0){
						$sql = 'UPDATE `title_pawn_tbl` SET `due_date` = "' . $due_date . '", `allow_partial` = false, `partial_payment` = 0, `penalty` = 0 WHERE `tittle_pawn_id` = ' . $loan_id . '';
					}else{
						$sql = 'UPDATE `title_pawn_tbl` SET `total_loan` = ' . $total . ', `interest_accured` = ' . $iterest . ', `due_date` = "' . $due_date . '", `allow_partial` = false, `partial_payment` = 0, `accured_before` = ' . $interest_accured . ', `penalty` = 0
				    WHERE `tittle_pawn_id` = ' . $loan_id . '';
					}
					
				}else{
					$sql = 'UPDATE `title_pawn_tbl` SET `total_loan` = ' . $total . ', `interest_accured` = ' . $iterest . ', `due_date` = "' . $due_date . '", `allow_partial` = false, `partial_payment` = 0, `accured_before` = ' . $interest_accured . '
				    WHERE `tittle_pawn_id` = ' . $loan_id . '';
				}


  
            }

        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }


    public function closePawn($loan_id, $title)
    {
        $pdo = $this->getPdo();
        if($title == 'pawn') {
            $sql = 'UPDATE `loan_info_tbl` SET `status` = "unredeemed"
				    WHERE `loan_info_id` = ' . $loan_id . '';
            $this->transferRemovePawnsToInventory($loan_id);
        }
        if($title == 'title'){
            $sql = 'UPDATE `title_pawn_tbl` SET `status` = "unredeemed"
				    WHERE `tittle_pawn_id` = ' . $loan_id . '';
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }
	
	public function closePawnCol($title)
    { 
		$loan_id = $_POST['lid'];
		$date = date('Y-m-d');
        $pdo = $this->getPdo();
		try{
			
			if($title == 'pawn') {
				$sql = 'UPDATE `loan_info_tbl` SET `status` = "unredeemed", `date_forfeited` = "' . $date . '"
						WHERE `loan_info_id` = ' . $loan_id . '';
				$this->transferRemovePawnsToInventory($loan_id);
			}
			if($title == 'title'){
				$sql = 'UPDATE `title_pawn_tbl` SET `status` = "unredeemed"
						WHERE `tittle_pawn_id` = ' . $loan_id . '';
			}

			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			
			 $location = 'collections?success=true&msg=Pawn successfully updated.';

        }catch (Exception $e){
            $location = 'collections?success=false&msg=Something went wrong, please try again';
        }

        header('Location: ' . $location . '');

	
    }


    public function transferRemovePawnsToInventory($id){

        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `inventory_tbl`(`item_no`, `description`, `cost`, `retail`,`quantity`, `image`, `transaction_id`) SELECT `serial_number`,`item_description`, `loan_amount`, `retail`, `quantity`, `blob_image`, `loan_info_id` FROM `pawn_items` WHERE `loan_info_id` = ' . $id . '';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();


    }

    public function updateRepairInvoice(){

        $customer_id = $_POST['customer_id'];
        $repair_id = $_POST['repair_id'];
        $repair_item_description = $_POST['repair_item_description'];
        $repair_serial_number = $_POST['serial_number'];
        $desc_to_completed = $_POST['description_to_complete'];
        $labor_charge = $_POST['labor_charge'];
        $labor_charge = str_replace(',','', '' . $labor_charge . '');
        $total_cost = $_POST['total_cost'];
        $total_cost = str_replace(',','', '' . $total_cost . '');
        $tax = $_POST['tax'];
        $tax = str_replace(',','', '' . $tax . '');
        $deposit = $_POST['deposit'];
        $deposit = str_replace(',','', '' . $deposit . '');
        $balance = $_POST['balance'];
        $balance = str_replace(',','', '' . $balance . '');
        $repair_status = $_POST['repair_status'];

        try{
            $pdo = $this->getPdo();
            $sql = 'UPDATE `repair_invoice_tbl` SET `repair_item_description` = "' . $repair_item_description . '", `repair_serial_number` = "' . $repair_serial_number . '", `description_to_completed` = "' . $desc_to_completed . '", `labor_charge` = "' . $labor_charge . '", `total_cost` = "' . $total_cost .'", `tax` = "' . $tax .'", `deposit` = "' . $deposit .'", `balance` = "' . $balance . '", `repair_status` = "' . $repair_status . '"
				    WHERE `customer_id` = ' . $customer_id . ' AND `repair_invoice_id` = ' . $repair_id . '';

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $location = 'view-edit-repair-orders?success=true&msg=Repair Order successfully updated.';

        }catch (Exception $e){
            $location = 'view-edit-repair-orders?success=false&msg=Something went wrong, please try again';
        }

        header('Location: ' . $location . '');


    }


    public function updateRTO(){

        $customer_id = $_POST['customer_id'];
        $rto_id = $_POST['rto_id'];
        $term = $_POST['term'];
        $payment = $_POST['amount'];
        $due_date = $_POST['due_date'];
        $remaining_count = $_POST['remaining_count'];
        $downpayment = $_POST['downpayment'];
        $sales_tax = $_POST['sales_tax'];
        $date = date('Y-m-d');
        $date2 = date('Y-m-d', strtotime($due_date . '+2 days'));

        if($date >= $date2){
            $penalty = 5;
        }
        else {
            $penalty = 0;
        }

        if($term == 'Weekly'){$due_date_ex = date('Y-m-d', strtotime($due_date . '+7 days'));}
        if($term == 'Bi-Weekly'){$due_date_ex = date('Y-m-d', strtotime($due_date  . '+15 days'));}
        if($term == 'Monthly'){$due_date_ex = date('Y-m-d', strtotime($due_date  . '+30 days'));}


        if($remaining_count == 1) {
            $amount_paid = $payment + $downpayment;
            $payment = $payment + $penalty + $downpayment;
        }
        else {
            $amount_paid = $payment;
            $payment = $payment + $penalty;
        }


        $date_added_payment = date('Y-m-d H:i:s');
        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `rto_payment_tbl` (`rto_id`, `customer_id`, `penalty`, `amount_paid`, `date_added`) VALUES ("' . $rto_id . '", "' . $customer_id . '", "' . $penalty . '", "' . $amount_paid . '", "' . $date_added_payment . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();


        $pdo = $this->getPdo();
        $sql = 'UPDATE `rto_tbl` SET `remaining_count` = (`remaining_count` - 1), `due_date` = "' . $due_date_ex . '"
				    WHERE `customer_id` = ' . $customer_id . ' AND `rto_id` = ' . $rto_id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `payment_tbl` (`customer_id`, `total_amount`,  `payment_method`, `transaction`, `date_added`, `transaction_id`) VALUES ("' . $customer_id . '", "' . $payment . '", "cash", "rto_tbl", "' . $date . '", ' . $rto_id . ')';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $query = array('customer_id' => $customer_id,
            'rto_id' => $rto_id
            );

        header('Location: print-payment-rto-ticket.php?' . http_build_query($query));
        exit;
    }



    public function updateTransactionStatus($id, $state, $type, $customer_id, $reason)
    {
        $status_field = 'status';

        if($state == 'true'){
            $status = 'void';
        }
        else {
            $status = 'active';
        }

        if ($type == 'loan_info_tbl'){
            $loan_id = 'loan_info_id';
        }
        else if ($type == 'loan_info_tbl_forfeit'){
            $loan_id = 'loan_info_id';
			$status = 'active';
			
			 $pdo = $this->getPdo();
			 $sql = 'DELETE FROM `inventory_tbl` WHERE `transaction_id` = ' . $id . '';
             $stmt = $pdo->prepare($sql);
             $stmt->execute();
			
			$type = 'loan_info_tbl';
			
        }
        else if($type == 'title_pawn_tbl') {
            $loan_id = 'tittle_pawn_id';
        }
        else if ($type == 'point_of_sale_tbl'){
            $loan_id = 'sale_id';


            $pdo = $this->getPdo();
            $sql = 'SELECT point_of_sale_item_sold.item_id, point_of_sale_item_sold.quantity as qty , point_of_sale_item_sold.sale_id FROM `inventory_tbl`, `point_of_sale_item_sold` WHERE point_of_sale_item_sold.sale_id = ' . $id . ' AND point_of_sale_item_sold.customer_id = ' . $customer_id . ' AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $content = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $content[] = $row;
            }

            $data = $content;




                    if($status == 'void') {

                        foreach($data as $row){
                            $sql = 'UPDATE `inventory_tbl` SET `quantity` = (`quantity` + ' . $row['qty'] . ')
                                WHERE `inventory_id` = ' . $row['item_id'] . '';
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();

                        }

                    }
                    else {
                        foreach($data as $row){
                            $sql = 'UPDATE `inventory_tbl` SET `quantity` = (`quantity` - ' . $row['qty'] . ')
                                WHERE `inventory_id` = ' . $row['item_id'] . '';
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();

                        }
                    }


        }
        else if($type == 'repair_invoice_tbl'){
            $loan_id = 'repair_invoice_id';
            $status_field = 'invoice_status';
            if($state != 'true'){
                $status = 'in_progress';

            }
        }
        else if ($type == 'refill_tbl'){
            $loan_id = 'refill_id';
            if($state != 'true'){
                $status = '';
            }
        }
        else if ($type == 'rto_tbl'){
            $loan_id = 'rto_id';
            if($state != 'true'){
                $status = '';
            }
        }
        else if ($type == 'layaway_tbl'){
            $loan_id = 'lid';


            $pdo = $this->getPdo();
            $sql = 'SELECT point_of_sale_item_sold.item_id, point_of_sale_item_sold.quantity as qty , point_of_sale_item_sold.sale_id FROM `inventory_tbl`, `point_of_sale_item_sold` WHERE point_of_sale_item_sold.sale_id = ' . $id . ' AND point_of_sale_item_sold.customer_id = ' . $customer_id . ' AND point_of_sale_item_sold.item_id = inventory_tbl.inventory_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $content = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $content[] = $row;
            }

            $data = $content;




            if($status == 'void') {

                foreach($data as $row){
                    $sql = 'UPDATE `inventory_tbl` SET `quantity` = (`quantity` + ' . $row['qty'] . ')
                                WHERE `inventory_id` = ' . $row['item_id'] . '';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                }

            }
            else {
                foreach($data as $row){
                    $sql = 'UPDATE `inventory_tbl` SET `quantity` = (`quantity` - ' . $row['qty'] . ')
                                WHERE `inventory_id` = ' . $row['item_id'] . '';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                }
            }


        }
        else if ($type == 'scrap_info_tbl'){
            $loan_id = 'scrap_info_id';
            if($state != 'true'){
                $status = '';
            }
        }
        else {
            null;
        }

        $pdo = $this->getPdo();
        $sql = 'UPDATE `' . $type . '` SET `' . $status_field . '` = "' . $status . '", `void_reason` = "' . $reason . '"
				    WHERE `' . $loan_id . '` = ' . $id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }


    public function updateTransactionStatusPayment($id, $state, $type, $customer_id, $reason, $amount, $interest, $transaction_type, $tid, $due)
    {
        $status_field = 'status';

        if ($state == 'true') {
            $status = 'void';
        } else {
            $status = 'active';
        }

        if ($type == 'payment_tbl') {
            $loan_id = 'payment_id';
            if($transaction_type == 'general'){

                $rollback_amount = $amount - $interest;
                $rollback_amount = number_format($rollback_amount, 2, '.', '');
                $rollback_due =  date('Y-m-d', strtotime('-30 days', strtotime($due)));
                $pdo = $this->getPdo();
                $sql = 'UPDATE `loan_info_tbl` SET `total_loan` = (`total_loan` + ' . $rollback_amount . '), `interest_accured` = ' . $interest . ', `due_date` = "' . $rollback_due . '" WHERE `loan_info_id` = ' . $tid . '';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();


                $sql = 'SELECT `total_loan`, `interest_rate`, `loan_amount`, `accured_before` FROM `loan_info_tbl` WHERE `loan_info_id` = ' . $tid . '';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $accured_before = $result['accured_before'];
                $loan_amount = $result['loan_amount'];
                $total = $result['total_loan'];
                $rate = $result['interest_rate'];

                if((($loan_amount * $rate) / 100) + $loan_amount == $total){
                    $rollback_interest = ($loan_amount * $rate) / 100;
                }
                else{
                    $rollback_interest = $accured_before;

                }

                $rollback_interest = number_format($rollback_interest, 2, '.', '');


                $sql = 'UPDATE `loan_info_tbl` SET `interest_accured` = ' . $rollback_interest . ' WHERE `loan_info_id` = ' . $tid . '';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();



            }

            else if($transaction_type == 'title'){

                $rollback_amount = $amount - $interest;
                $rollback_amount = number_format($rollback_amount, 2, '.', '');
                $rollback_due =  date('Y-m-d', strtotime('-30 days', strtotime($due)));
                $pdo = $this->getPdo();
                $sql = 'UPDATE `title_pawn_tbl` SET `total_loan` = (`total_loan` + ' . $rollback_amount . '), `interest_accured` = ' . $interest . ', `due_date` = "' . $rollback_due . '" WHERE `tittle_pawn_id` = ' . $tid . '';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();


                $sql = 'SELECT `total_loan`, `interest_rate`, `total_loan_amount`, `accured_before` FROM `title_pawn_tbl` WHERE `tittle_pawn_id` = ' . $tid . '';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $accured_before = $result['accured_before'];
                $loan_amount = $result['total_loan_amount'];
                $total = $result['total_loan'];
                $rate = $result['interest_rate'];

                if((($loan_amount * $rate) / 100) + $loan_amount == $total){
                    $rollback_interest = ($loan_amount * $rate) / 100;
                }
                else{
                    $rollback_interest = $accured_before;

                }

                $rollback_interest = number_format($rollback_interest, 2, '.', '');


                $sql = 'UPDATE `title_pawn_tbl` SET `interest_accured` = ' . $rollback_interest . ' WHERE `tittle_pawn_id` = ' . $tid . '';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();



            }

            if($transaction_type == 'layaway'){

                $rollback_amount = $amount;
                $rollback_amount = number_format($rollback_amount, 2, '.', '');
                $rollback_due =  date('Y-m-d', strtotime('-30 days', strtotime($due)));
                $pdo = $this->getPdo();
                $sql = 'UPDATE `layaway_tbl` SET `total` = (`total` + ' . $rollback_amount . '), `due_date` = "' . $rollback_due . '" WHERE `lid` = ' . $tid . '';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

            }
        }

        $pdo = $this->getPdo();
        $sql = 'UPDATE `' . $type . '` SET `' . $status_field . '` = "' . $status . '", `void_reason` = "' . $reason . '"
				    WHERE `' . $loan_id . '` = ' . $id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    public function repoPawn($tid, $status){



        $date = date('Y-m-d');
        $pdo = $this->getPdo();
        if($status == 'repoed'){
            $sql = 'UPDATE `title_pawn_tbl` SET `status` = "repoed", `date_repoed` = "' . $date. '" WHERE `tittle_pawn_id` = ' . $tid . '';

        }
        else {
            $sql = 'UPDATE `title_pawn_tbl` SET `status` = "not redeemed" WHERE `tittle_pawn_id` = ' . $tid . '';

            $sql_t = 'INSERT INTO `vehicle_inventory_tbl` (`vehicle_id`, `vin_no`, `year`, `model`, `color`, `mileage`, `no_of_doors`, `vehicle_condition`, `title_no`, `tag_no`, `cost`, `quantity`)
                      SELECT ' . $tid . ', `vin_no`, `year`, `model`, `color`, `mileage`, `no_of_doors`, `vehicle_condition`, `title_no`, `tag_no`, `total_loan_amount`, 1
                      FROM `title_pawn_tbl` WHERE `tittle_pawn_id` = ' . $tid . '';
            $stmt_t = $pdo->prepare($sql_t);
            $stmt_t->execute();

        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }

    public function updateScrapStatus($id, $status){
        $pdo = $this->getPdo();
        $sql = 'UPDATE `scrap_inventory` SET `status` = "' . $status . '" WHERE `si_id` = ' . $id .'';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
	
	
	
	public function updateLayaway(){

        $customer_id = $_POST['customer_id'];
        $lid = $_POST['lid'];
        $due_date = $_POST['due_date'];
        $amount_paid = $_POST['amount_paid'];
        $date_added_payment = date('Y-m-d H:i:s');
		$due_date_ex = date('Y-m-d', strtotime($due_date  . '+30 days'));
		
		
        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `layaway_payment_tbl` (`lid`, `customer_id`, `amount_paid`, `date_added`) VALUES ("' . $lid . '", "' . $customer_id . '", "' . $amount_paid . '", "' . $date_added_payment . '")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();


        $pdo = $this->getPdo();
        $sql = 'UPDATE `layaway_tbl` SET `total` = (`total` - ' . $amount_paid . '), `due_date` = "' . $due_date_ex . '"
				    WHERE `customer_id` = ' . $customer_id . ' AND `lid` = ' . $lid . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $pdo = $this->getPdo();
        $sql = 'INSERT INTO `payment_tbl` (`customer_id`, `total_amount`,  `payment_method`, `transaction`, `date_added`, `transaction_id`) VALUES ("' . $customer_id . '", "' . $amount_paid . '", "cash", "layaway_tbl", "' . $date_added_payment . '", ' . $lid . ')';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $query = array('customer_id' => $customer_id,
            'layaway_id' => $lid
            );

        header('Location: print-payment-layaway-ticket.php?' . http_build_query($query));
        exit;
    }


    public function cancelLayaway(){

        try{

            $items = $this->getCustomerLayawayItems($_POST['cid'], $_POST['lid']);
            $pdo = $this->getPdo();
            $sql = 'UPDATE `layaway_tbl` SET `status` = "not complete" WHERE `lid` = ' . $_POST['lid'] . '';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();



            foreach($items as $row){
                $sql = 'UPDATE `inventory_tbl` SET `quantity` = (`quantity` + ' . $row['quantity'] . ')
                                        WHERE `inventory_id` = ' . $row['inventory_id'] . '';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

            }

            $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Layaway contract successfully canceled.';

        }catch (Exception $e){
            $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
        }

            header('Location: ' . $location . '');
    }







    /* Delete Data */



    public function removeItems($item_id, $image_name, $page){

        $pdo = $this->getPdo();

        if ($page == 'add-pawn'){
            $sql = 'DELETE FROM `pawn_items_tmp` WHERE `id` = ' . $item_id . '';
        }
        if ($page == 'buy-item-outright'){
            $sql = 'DELETE FROM `outright_items_tmp` WHERE `id` = ' . $item_id . '';
        }
        if ($page == 'repair-invoice'){
            $sql = 'DELETE FROM `repair_parts` WHERE `parts_id` = ' . $item_id . '';
        }
        if ($page == 'scrap-buying'){
            $sql = 'DELETE FROM `scrap_inventory` WHERE `si_id` = ' . $item_id . '';
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        If(strlen($image_name) > 1)
        {
            unlink($image_name);
        }




    }


    public function updateInventoryItem($action)
    {
        try {
            $pdo = $this->getPdo();
            if ($action == 'edit') {
                $iid = $_POST['iid'];
                $desc = $_POST['description'];
                $cost = $_POST['cost'];
                $cost = str_replace(',','', '' . $cost . '');
                $retail = $_POST['retail'];
                $retail = str_replace(',','', '' . $retail . '');
                $qty = $_POST['quantity'];
                $location = 'view-inventory.php?msg=success&type=update';
                $sql = 'UPDATE `inventory_tbl` SET `description` = "' . $desc . '",
                        `cost` = "' . $cost . '",
                        `retail` = "' . $retail . '",
                        `quantity` = "' . $qty . '"
                        WHERE `inventory_id` = ' . $iid . '';

            }
            if ($action == 'delete') {
                $location = 'view-inventory.php?msg=success&type=delete';
                $iid = $_POST['iiddel'];
                $sql = 'DELETE FROM `inventory_tbl` WHERE `inventory_id` = ' . $iid . '';
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

             $location = $_SERVER['PHP_SELF'] .'?success=true&msg=Item successfully updated.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');
    }


    function convertUnix($unix){
        $unix = round(($unix / 60 / 60),2);
        $time = $this->convertTime($unix);

        return $time;
    }

    private function convertTime($dec)
    {
        // start by converting to seconds
        $seconds = ($dec * 3600);
        // we're given hours, so let's get those the easy way
        $hours = floor($dec);
        // since we've "calculated" hours, let's remove them from the seconds variable
        $seconds -= $hours * 3600;
        // calculate minutes left
        $minutes = floor($seconds / 60);
        // remove those from seconds as well
        $seconds -= $minutes * 60;
        // return the time formatted HH:MM:SS
        return $this->lz($hours).":".$this->lz($minutes);
    }

    // lz = leading zero
    private function lz($num)
    {
        return (strlen($num) < 2) ? "0{$num}" : $num;
    }


    /*
     * Database functions
     */


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
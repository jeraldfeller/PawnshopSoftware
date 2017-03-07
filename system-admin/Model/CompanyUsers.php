<?php
/**
 * Created by PhpStorm.
 * User: Grabe Grabe
 * Date: 8/9/2016
 * Time: 10:37 PM
 */

class CompanyUsers Extends CompanySystem{

    public $debug = TRUE;
    protected $db_pdo;

    public function companyLogin($user, $password)
    {

        $password = $this->makeHash('encrypt', $password);
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `company_user` WHERE `user` = "' . $user . '" AND `pass` = "' . $password . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user, $password));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllCompany(){
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `company_user` WHERE `user` != "systemadmin"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	public function getCompanySubscriptionByMonth($cuid, $date){
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `subscription` WHERE `cuid` = ' . $cuid . ' AND `period` LIKE "' . $date . '%"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }
	
	public function getCompanySubscriptionUnpaid($cuid){
        $pdo = $this->getPdo();
        $sql = 'SELECT `transaction`, DATE_FORMAT(`period`, "%M, %Y") as period, `fee` FROM `subscription` WHERE `cuid` = ' . $cuid . ' AND `status` != "paid"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
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

    public function addCompany($xmlapi)
    {
        $date_added = date('Y-m-d');
        $data = array('company' => 'company',
            'username' => 'username',
            'password' => 'password',
			'account_no' => 'account_no');

        $data = $_POST['data'];

        if (isset($_POST['data']))
        {
            try{
                if ($data["username"] == null || $data["password"] == null)
                {
                    header('Location: users?success=false&msg=Something went wrong, please try again');
                }
                else {
                    $encPass = $this->makeHash('encrypt', $data['password']);
					$encAccountNo = $this->makeHash('encrypt', $data['account_no']);
                    $date = date("Y-m-d");
                    $database = 'pawnshop_db_' . str_replace(' ', '_', $data['company']) . '';
                    $pdo = $this->getPdo();
                    $sql = 'INSERT INTO `company_user` (`companyId`, `company`, `user`, `pass`, `db`, `version`, `date_added`) VALUES ("' . $encAccountNo . '", "' . $data["company"] . '", "' . $data["username"] . '", "' . $encPass . '", "' . $database . '", "v1", "' . $date_added . '")';
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute();
					
					$state = $this->getState();

                    $newDatabase = $this->duplicate(str_replace(' ', '_', $data['company']), $xmlapi);
					
					
					$this->createCompanyAdminAccount($data["username"], $encPass, $newDatabase);
					$this->generateState($state);
					$this->generateGuestCustomer();

                    $location = $_SERVER['PHP_SELF'] .'?success=true&msg=User successfully added.';
                }
            }catch (Exception $e){
               $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
			  
            } 

            header('Location: ' . $location . '');

        }

    }
	
	public function generateState($state){
		foreach($state as $row){
			$pdo = $this->getPdo();
            $sql = 'INSERT INTO `state` (`state`) VALUES ("' . $row["state"] . '")';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();
		}
	}
	
	public function generateGuestCustomer(){
		
			$pdo = $this->getPdo();
            $sql = 'INSERT INTO `customer_tbl` (`first_name`, `last_name`) VALUES ("GUEST", "GUEST")'; 
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();
		
	}

    public function logout()
    {

        unset($_SESSION['systemadmin']);
        unset($_SESSION['systemadmin_login']);
        session_unset();
        session_destroy();
        header('Location: login.php');

    }

    function duplicate($company, $xmlapi) {
            $originalDB = 'pawnshop_db';
            $newDB = 'pawnshop_db_' . $company . '';
            $getTables =  $this->getTables();

            $this->createDatabase($newDB, $xmlapi);
			
            foreach( $getTables as $key => $tab ) {


                $this->useDB($newDB);
                $this->createTable($tab, $originalDB);
            }
			
           return $newDB;
    }

    public function getTables(){
        $pdo = $this->getPdo();
        $sql = 'SHOW TABLES IN pawnshop_db';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function createDatabase($newDB, $xmlapi){
		
		
		$xmlapi->password_auth(DB_USER_MAIN,DB_PWD_MAIN);    
		$xmlapi->set_port(2083);
		$xmlapi->set_debug(1);//output actions in the error log 1 for true and 0 false  
		$xmlapi->set_output('array');//set this for browser output  
		//create database    
		$createdb = $xmlapi->api1_query(DB_USER_MAIN, "Mysql", "adddb", array($newDB));  
		/*
        $pdo = $this->getPdo();
        $sql_create_db = "CREATE DATABASE $newDB";
        $stmt = $pdo->prepare($sql_create_db);
        $stmt->execute();
		*/
		
    }

    public function useDB($newDB){
        $pdo = $this->getPdo();
        $sql = "USE $newDB";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }

    public function createTable($tab, $originalDB){

        foreach($tab as $row => $tabs){
            $pdo = $this->getPdo();
            $sql = "CREATE TABLE $tabs  LIKE $originalDB.$tabs";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
        /*

        $pdo = $this->getPdo();
        $sql = 'CREATE TABLE "' . $tab . '" LIKE "'.$originalDB.'"."'.$tab.'")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
*/
    }
	
	
	public function createCompanyAdminAccount($userName, $password, $db){
		
		$localhost = 'localhost';
		$username = 'cashmax229';
		$pass = 'Pawn4223626';
		$conn = new PDO("mysql:host=$localhost;dbname=$db", $username, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'INSERT INTO `users_tbl` (`type`, `user_name`, `password`) VALUES ("Admin", "' . $userName . '", "' . $password . '")';
		$stmt = $conn->prepare($sql);
        $stmt->execute();
		
		
		
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

}
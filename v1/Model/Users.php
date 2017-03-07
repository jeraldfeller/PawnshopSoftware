<?php
// PHP and MySQL Project
// members table data class
class Users Extends System
{
	public $debug = TRUE;
	protected $db_pdo;
	
	
	public function getAllUsers()
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `users_tbl` WHERE `user_name` != "Admin"';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	
	   public function checkAdminExist()
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users_tbl` WHERE `user_name` = "Admin"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getUsers($user, $password)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users_tbl` WHERE `user_name` = "' . $user . '", `password` = "' . $password . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function getUserById($uid)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users_tbl` WHERE `id` = ' . $uid . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }


    /*
     * Returns database row for 1 member
     * @param int $id = member ID
     * @return array $row[] = array('title' => title, 'description' => description, etc.)
     */
	public function addUser()
	{
		$data = array('first_name' => 'first_name',
                      'last_name' => 'last_name',
                      'username' => 'username',
					  'password' => 'password');
					  
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
                    $date = date("Y-m-d");
                    $pdo = $this->getPdo();
                    $sql = 'INSERT INTO `users_tbl` (`first_name`, `last_name`, `user_name`, `password`, `date_added`) VALUES ("' . $data["first_name"] . '", "' . $data["last_name"] . '", "' . $data["username"] . '", "' . $encPass . '", "' . $date . '")';
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute();

                    $location = $_SERVER['PHP_SELF'] .'?success=true&msg=User successfully added.';
                }
            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');

		}
		
	}

    public function editUser()
    {
        $data = array('e_first_name' => 'e_first_name',
            'e_last_name' => 'e_last_name',
            'e_username' => 'e_username',
            'e_password' => 'e_password',
            'e_uid' => 'e_uid');

        $data = $_POST['data'];

        if (isset($_POST['data']))
        {
            try{
                if ($data["e_username"] == null || $data["e_password"] == null)
                {
                    header('Location: users?success=false&msg=Something went wrong, please try again');
                }
                else {
                    $encPass = $this->makeHash('encrypt', $data['e_password']);
                    $date = date("Y-m-d");
                    $pdo = $this->getPdo();
                    $sql =  'UPDATE `users_tbl` SET `first_name` = "' . $data["e_first_name"] . '", `last_name` = "' . $data["e_last_name"] . '", `user_name` = "' . $data["e_username"] . '", `password` = "' . $encPass . '" WHERE id = ' . $data["e_uid"] .'';
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute();

                    $location = $_SERVER['PHP_SELF'] .'?success=true&msg=User successfully updated.';
                }
            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');

        }

    }


    public function deleteUser()
    {


            try{

                    $pdo = $this->getPdo();
                    $sql =  'DELETE FROM `users_tbl` WHERE `id` = ' . $_POST['dUid'] . '';
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute();

                    $location = $_SERVER['PHP_SELF'] .'?success=true&msg=User successfully deleted.';

            }catch (Exception $e){
                $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
            }

            header('Location: ' . $location . '');



    }
	/*
	 * Returns database row for 1 member
	 * @param string $email
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function loginByName($user, $password)
	{

        $password = $this->makeHash('encrypt', $password);
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `users_tbl` WHERE `user_name` = "' . $user . '" AND `password` = "' . $password . '"';
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($user, $password));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


    public function updateUserPages(){

        $uid = $_POST['uid'];
        $customer = (isset($_POST['customer']) ? $_POST['customer'] : 0 );
        $general = (isset($_POST['general']) ? $_POST['general'] : 0 );
        $title = (isset($_POST['title']) ? $_POST['title'] : 0 );
        $scrap = (isset($_POST['scrap']) ? $_POST['repair'] : 0 );
        $repair = (isset($_POST['repair']) ? $_POST['repair'] : 0 );
        $refill = (isset($_POST['refill']) ? $_POST['refill'] : 0 );
        $rto = (isset($_POST['rto']) ? $_POST['rto'] : 0 );
        $inventory = (isset($_POST['inventory']) ? $_POST['inventory'] : 0 );
        $outright = (isset($_POST['outright']) ? $_POST['outright'] : 0 );
        $pos = (isset($_POST['pos']) ? $_POST['pos'] : 0 );
        $petty = (isset($_POST['petty']) ? $_POST['petty'] : 0 );
        $check = (isset($_POST['check']) ? $_POST['check'] : 0 );
        $void = (isset($_POST['void']) ? $_POST['void'] : 0 );

        try{


        $pdo = $this->getPdo();
        $sql = 'UPDATE `users_tbl` SET `customer_page` = "' . $customer . '",
                                        `general_pawn_page` = "' . $general . '",
                                        `title_pawn_page` = "' . $title . '",
                                        `scrap_page` = "' . $scrap . '",
                                        `repair_page` = "' . $repair . '",
                                        `refill_page` = "' .$refill . '",
                                        `rto_page` = "' . $rto . '",
                                        `inventory_page` = "' . $inventory . '",
                                        `outright_page` = "' . $outright . '",
                                        `pos_page` = "' . $pos . '",
                                        `check_page` = "' . $check . '",
                                        `petty_page` = "' . $petty . '",
                                        `void_page` = "' . $void . '"
                WHERE `id` = ' . $uid . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
            $location = $_SERVER['PHP_SELF'] .'?success=true&msg=User successfully updated.';
        }
        catch (Exception $e){
            $location = $_SERVER['PHP_SELF'] .'?success=false&msg=Something went wrong, please try again';
        }

        header('Location: ' . $location . '');

    }

    public function clockManagement($status){

        $uid = $_POST['user_id'];
        $pdo = $this->getPdo();
        $time = time();
        $date = date('Y-m-d');
        if($status == 1){
            $time_in_sql = 'INSERT INTO `attendance_tbl` (`user_id`, `time_in`, `date`)
                            VALUES (' . $uid . ', ' . $time . ', "' . $date . '")';
            $header_location = Header('Location: index.php?success=true&msg=You successfully timed in.');

            $_SESSION['user_name']['log_status'] = 1;

        }else{
            $time_in_sql = 'UPDATE `attendance_tbl` SET `time_out` = "' . $time . '"';
            $header_location = Header('Location: index.php?success=true&msg=You successfully timed out.');
        }

        $stmt_time = $pdo->prepare($time_in_sql);
        $stmt_time->execute();



        $sql = 'UPDATE `users_tbl` SET `log_status` = "' . $status . '"
                WHERE `id` = ' . $uid . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $header_location;
    }

    public function getUserAttendanceById($uid, $from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `attendance_tbl` WHERE `user_id` = ' . $uid. '
                AND `date` >= "' . $from . '"
                AND `date` <= "' . $to . '" ORDER BY `date` DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;


    }

    public function getAllUserAttendance($from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `attendance_tbl` WHERE `date` >= "' . $from . '"
                AND `date` <= "' . $to . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;


    }

    public function getAllUserAttendanceById($id, $from, $to){

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `attendance_tbl` WHERE `user_id` = ' . $id . ' AND `date` >= "' . $from . '"
                AND `date` <= "' . $to . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;


    }


    public function getTimeClockPeriod()
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `time_clock_period`';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $content = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }
        return $content;
    }

    public function updateTimeClockPeriod()
    {

        $pdo1 = $this->getPdo();
        $sql1 = 'SELECT * FROM `time_clock_period`';
        $stmt1 = $pdo1->prepare($sql1);
        $stmt1->execute();
        $content = array();
        while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $content[] = $row;
        }


        $period = $_POST['period'];
        $starting_day = $_POST['starting_day'];
        $no_days = $_POST['no_days'];

        if($period == $content[0]['period']){

            if($no_days != $content[0]['no_days']){

                if($no_days == '7'){
                    $period = 'weekly';
                }else{
                    $period = 'biweekly';
                }
            }
        }else{
            if($period == 'weekly'){
                $no_days = 7;
            }else if($period =='biweekly'){
                $no_days = 14;
            }
        }


        $id = $_POST['id'];

        $pdo = $this->getPdo();
        $sql = 'UPDATE `time_clock_period` SET `period` = "' . $period .'" , `starting_day` = "' . $starting_day . '", `no_days` = "' . $no_days . '" WHERE `id` = ' . $id . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

    }







    public function logout()
	{
		session_start();
		unset($_SESSION['user_name']);
        unset($_SESSION['company']);
		session_unset();
		session_destroy();
        header('Location: app.' . $_SERVER['DOCUMENT_ROOT'] . '/company-login.php');
		
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
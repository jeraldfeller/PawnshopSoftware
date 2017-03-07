<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';
$employeeClass = new Employee();

$curDate = date('Y-m-d');
if(!isset($_POST['choice']))
{
    header ('Location: take-payment.php');
}
else {
    if(isset($_POST['submit']))
    {
        if($_POST['pawn_type'] == 'General Pawn'){


            $pawn_type = 'loan_info_tbl';
            $tid = $_POST['tid'];
            $id = $_POST['choice'];
            $customer_id = $_POST['customer_id'];
            $total_amount = $_POST['total_amount'];
            $amount_paid = $_POST['amount_paid'];
            $date = $_POST['date'];
            $loan_id = $_POST['info_id'];
            $due_date = $_POST['due_date'];
            $interest_rate = $_POST['interest_rate'];
            $interest_accured = $_POST['interest_accured'];
            $state = $_POST['allowed'];
            $pass_due = $_POST['pass_due'];
            $penalty = $_POST['penalty'];
            $occur = $_POST['occur'];

            if($pass_due == 1){

                if($amount_paid >= ($interest_accured + $penalty)){
                    $total = $total_amount - ($amount_paid - $penalty);
                }

            }else{
                $total = $total_amount - $amount_paid;
            }


            $ifover = false;



            if($total == '0' || $total < 0){
                foreach ($id as $row){
                    $interest = 0;
                    $employeeClass->updatePawnItem($customer_id, $row);
                }
            }

            foreach ($loan_id as $row) {

                if($total == '0' || $total < 0){
                    $due_date = null;
                    $total = 0;
                }
                else if ($state == 1){
                    $total = $amount_paid;
                    $interest = $interest_accured - $amount_paid;
                }

                else if($state == 2){

                    if($amount_paid > $interest_accured){
                        $interest = $total * $interest_rate / 100;
                        $total = $total + $interest;
                        $due_date = date('Y-m-d', strtotime('+30 days', strtotime($due_date)));
                        $ifover = true;

                    }
                    else{
                        $total = $amount_paid;
                        $due_date = date('Y-m-d', strtotime('+30 days', strtotime($due_date)));
                        $interest = 0;

                    }

                }

                else {

                    if($pass_due == 1){
                        if($amount_paid >= $interest_accured + $penalty){
                            $interest = $total * $interest_rate / 100;
                            $total = $total + $interest;
                            $paidPenalty = 1;
                        }
                        else{
                            $interest = $total * $interest_rate / 100;
                            $paidPenalty = 0;
                            $total = '1';
                        }
                    }else{
                        $interest = $total * $interest_rate / 100;
                        $total = $total + $interest;
                    }


                    if($occur == 'daily'){
                        $due_date = date('Y-m-d', strtotime($curDate . '+ 30 days'));
                    }else{
                        $due_date = date('Y-m-d', strtotime('+30 days', strtotime($due_date)));
                    }


                }

                $employeeClass->updateLoanStatus($row, $total, $interest, $due_date, $state, $ifover, $interest_accured, $pass_due, $paidPenalty, $penalty);
            }




            foreach ($loan_id as $row) {
                $employeeClass->addPayment($row, $customer_id, $amount_paid, $date, $interest, $pawn_type, $state, $tid, $penalty);
            }

        }


        if($_POST['pawn_type'] == 'Title Pawn') {

            $pawn_type = 'title_pawn_tbl';
            $tid = $_POST['tid'];
            $id = $_POST['choice'];
            $customer_id = $_POST['customer_id'];
            $total_amount = $_POST['total_amount'];
            $amount_paid = $_POST['amount_paid'];
            $date = $_POST['date'];
            $loan_id = $_POST['title_id'];
            $due_date = $_POST['due_date'];
            $interest_rate = $_POST['interest_rate'];
            $interest_accured = $_POST['interest_accured'];
            $pass_due = $_POST['pass_due'];
            $penalty = $_POST['penalty'];
            $occur = $_POST['occur'];

            if($pass_due == 1){
                if($amount_paid >= ($interest_accured + $penalty)){
                    $total = $total_amount - ($amount_paid - $penalty);
                }
            }else{
                $total = $total_amount - $amount_paid;
            }



            $ifover = false;



            $state = $_POST['allowed'];

            foreach ($loan_id as $row) {

                if($total == '0' || $total < 0){
                    $due_date = null;
                    $total = 0;
                    $interest = 0;
                }
                else if ($state == 1){
                    $total = $amount_paid;
                    $interest = $interest_accured - $amount_paid;
                }

                else if($state == 2){

                    if($amount_paid > $interest_accured){
                        $interest = $total * $interest_rate / 100;
                        $total = $total + $interest;
                        $due_date = date('Y-m-d', strtotime('+30 days', strtotime($due_date)));
                        $ifover = true;

                    }
                    else{
                        $total = $amount_paid;
                        $due_date = date('Y-m-d', strtotime('+30 days', strtotime($due_date)));
                        $interest = 0;

                    }

                }


                else {

                    if($pass_due == 1){
                        if($amount_paid >= $interest_accured + $penalty){
                            $interest = $total * $interest_rate / 100;
                            $total = $total + $interest;
                            $paidPenalty = 1;
                        }
                        else{
                            $interest = $total * $interest_rate / 100;
                            $paidPenalty = 0;
                            $total = '1';
                        }
                    }else{
                        $interest = $total * $interest_rate / 100;
                        $total = $total + $interest;
                    }



                    if($occur == 'daily'){
                        $due_date = date('Y-m-d', strtotime($curDate . '+ 30 days'));
                    }else{
                        $due_date = date('Y-m-d', strtotime('+30 days', strtotime($due_date)));
                    }


                }
                $employeeClass->updateTitleLoanStatus($row, $total, $interest, $due_date, $state, $ifover, $interest_accured, $pass_due, $paidPenalty, $penalty);
            }


            foreach ($loan_id as $row) {
                $employeeClass->addPayment($row, $customer_id, $amount_paid, $date, $interest, $pawn_type, $state, $tid, $penalty);
            }



        }
    }
}




?>


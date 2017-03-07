<?php
class adminView extends Employee
{
    public $companyName = 'Pawnshop Software';




    public function displayTotalGeneralPawnsByDay($pawns)
    {
        $count = 0;
        $output = ' ';
        foreach ($pawns as $pawn)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }

            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td colspan="3">' . $pawn['first_name'] . ' ' . $pawn['middle_name'] . ' ' . $pawn['last_name'] . '</td>' . PHP_EOL;


            $output .= '<td colspan="3">' . PHP_EOL;

            $customer_id = $pawn['customer_id'];
            $loan_id = $pawn['loan_info_id'];

            $items = $this->getCustomerPawnedItems($customer_id, $loan_id);
            foreach($items as $item){
                $output .= $item['item_description'] . ', ' . PHP_EOL;
            }
            $output .= '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['title'] . '</td>' . PHP_EOL;

            $output .= '<td>$' . number_format($pawn['loan_amount'], 2) . '</td>' . PHP_EOL;




            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }


    public function displayTotalTitlePawnsByDay($pawns)
    {
        $count = 0;
        $output = ' ';
        foreach ($pawns as $pawn)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }

            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $pawn['first_name'] . ' ' . $pawn['middle_name'] . ' ' . $pawn['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['vin_no'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['year'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['model'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['title_no'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['title'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($pawn['retail'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($pawn['total_loan_amount'], 2) . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }


    public function displayTakePaymentSalesByDay($take_payment_sales)
    {
        $count = 0;
        $output = ' ';
        foreach ($take_payment_sales as $row)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }

            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . strtoupper($row['payment_method']) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['total_amount'], 2) . '</td>' . PHP_EOL;


            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }

    public function displayPointOfSaleByDay($point_of_sale)
    {
        $count = 0;
        $output = ' ';
        foreach ($point_of_sale as $row)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }

            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . strtoupper($row['payment']) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['total'], 2) . '</td>' . PHP_EOL;


            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }




    public function displayCashLoanedOutByDay($cash_loaned_out)
    {
        $count = 0;
        $output = ' ';
        foreach ($cash_loaned_out as $row)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }

            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['loan_amount'], 2) . '</td>' . PHP_EOL;


            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }


    public function displayCostOfGoodsByDay($cost_of_goods)
    {
        $count = 0;
        $output = ' ';
        foreach ($cost_of_goods as $row)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }

            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['purchase_amount'], 2) . '</td>' . PHP_EOL;


            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }

    public function displayScrapPurchaseByDay($scrap)
    {
        $count = 0;
        $output = ' ';
        foreach ($scrap as $row)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }

            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['amount_paid'], 2) . '</td>' . PHP_EOL;


            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }

    public function displayGeneralPawn($pawn){

        $count = 0;
        $output = ' ';
        $link = "update-allow-partial-payment.php?";
        foreach ($pawn as $row)
        {

            $interest = $row['interest_rate'];
            $loan_amount = $row['loan_amount'];
            $interest = ($loan_amount * $interest) / 100;


            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;

            $output .= '<td>$' . number_format($row['loan_amount'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($interest, 2) . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['title'] . '</td>' . PHP_EOL;
            $output .= '<td><a href="' . $link .'loan_id=' . $row['loan_info_id'] . '"><span class="label label-success "><i class="fa fa-thumbs-o-up"></i> Allow Partial</span></a></td>' . PHP_EOL;

            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;

    }


    public function displayUserAttendanceInitial($attendance, $dateArr, $userClass, $vertical){
        $output = '';

        foreach($attendance as $key => $row) {
            $name = $userClass->getUserById($key);
            if($vertical == 0){
                $output .= '<tr>' . PHP_EOL;
                $output .= '<td>' . $name[0]['first_name'] . ' ' . $name[0]['last_name'] . '</td>' . PHP_EOL;
                $totalDuration = array();
                foreach ($dateArr as $key => $range) {
                    $output .= '<td>' . PHP_EOL;
                    foreach ($row as $date => $value) {
                        if ($value['time_out'] == 0 || $value['time_out'] == '') {
                            $contest_timeout = time();
                        } else {
                            $contest_timeout = $value['time_out'];
                        }

                        $duration = $contest_timeout - $value['time_in'];

                        if ($range == $date) {
                            $output .= $this->convertUnix($duration) . PHP_EOL;
                            $totalDuration[] = $duration;

                        } else {
                            $output .= '' . PHP_EOL;

                        }
                    }
                    $output .= '</td>' . PHP_EOL;

                }

                $output .= '<td><b>' . $this->convertUnix(array_sum($totalDuration)) . '</b></td>' . PHP_EOL;
                $output .= '</tr>' . PHP_EOL;
            }else{
                $totalDuration = array();
                foreach ($dateArr as $key => $range) {

                    foreach ($row as $date => $value) {
                        if ($value['time_out'] == 0 || $value['time_out'] == '') {
                            $contest_timeout = time();
                        } else {
                            $contest_timeout = $value['time_out'];
                        }

                        $duration = $contest_timeout - $value['time_in'];

                        if ($range == $date) {
                            $output .= '<tr>' . PHP_EOL;
                            $output .= '<td>' . date('D, M d', strtotime($range)) . '</td>' . PHP_EOL;
                            $output .= '<td>' . PHP_EOL;
                            $output .= $this->convertUnix($duration) . PHP_EOL;
                            $totalDuration[] = $duration;
                            $output .= '</td>' . PHP_EOL;
                            $output .= '</tr>' . PHP_EOL;

                        } else {
                            $output .= '' . PHP_EOL;

                        }


                    }


                }
                $output .= '<tr>';
                $output .= '<td colspan="1"><b>Total Hours</b></td>';
                $output .= '<td><b>' . $this->convertUnix(array_sum($totalDuration)) . '</b></td>' . PHP_EOL;
                $output .= '</tr>';


            }

                unset($totalDuration);

            }




        return $output;
    }


}






?>
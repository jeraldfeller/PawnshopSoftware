<?php
/**
 * Created by PhpStorm.
 * User: Grabe Grabe
 * Date: 8/10/2016
 * Time: 8:27 AM
 */

class CompanyUsersView extends CompanyUsers {

    public function displayCompanyUsers($company, $system)
    {
        $count = 0;
        $output = ' ';
        foreach ($company as $row)
        {
            $password = $system->makeHash('decrypt', $row['pass']);
			$accountNo = $system->makeHash('decrypt', $row['companyId']);

            $output .= '<tr>' . PHP_EOL;
			$output .= '<td>' . $accountNo . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['company'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['user'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $password . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['version'] . '</td>' . PHP_EOL;
            $output .= '<td>' . date("m/d/Y", strtotime($row['date_added'])) . '</td>' . PHP_EOL;
            $output .= '<td>
                        <button class="btn btn-success btn-xs"
                        data-type="edit"
                        data-id="' . $row['cuid'] . '"
                        data-first-name="' . $row['company'] . '"
                        data-last-name="' . $row['user'] . '";
                        data-password="' . $password . '"
                        data-toggle="modal"
                        data-target="#modal_edit_user" onclick="pushData(this)"><i class="fa fa-edit"></i> Edit</button>

                        <button class="btn btn-danger btn-xs"
                        data-type="delete"
                        data-id="' . $row['cuid'] . '"
                        data-first-name="' . $row['company'] . '"
                        data-user="' . $row['user'] . '"
                        data-password="' . $row['pass'] . '"
                        data-toggle="modal"
                        data-target="#modal_delete_user" onclick="pushData(this)"><i class="fa fa-trash-o"></i> Delete</button>
                        </td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }
	
	public function displayCompanyUsersAccounts($company, $system)
    {
        
        $output = ' ';
        foreach ($company as $row)
        {
			$date = date('Y-m');
			$monthlyCharge = $this-> getCompanySubscriptionByMonth($row['cuid'], $date);
			$unpaidCharges = $this->getCompanySubscriptionUnpaid($row['cuid']);
			$unpaidCharge = htmlspecialchars(json_encode($unpaidCharges));
			
			if($monthlyCharge){
				$charge = '<a href="" class="editFee" onClick="pushData(this)" data-type="editCharge" data-charge="' . $monthlyCharge[0]['fee'] . '" data-id="' . $row['cuid'] . '"  data-name="' . $row['company'] . '" data-toggle="modal" data-target="#modal_add_charges">$' . number_format($monthlyCharge[0]['fee'], 2) . '</a>';
			}else{
				$charge = '<a href="" onClick="pushData(this)" data-type="addCharge" data-id="' . $row['cuid'] . '"  data-name="' . $row['company'] . '" data-toggle="modal" data-target="#modal_add_charges">[Add Charge]<a>';
			}
			$accountNo = $system->makeHash('decrypt', $row['companyId']);
            $output .= '<tr>' . PHP_EOL;
			$output .= '<td>' . $accountNo . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['company'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['version'] . '</td>' . PHP_EOL;
			$output .= '<td>' . $charge . '</td>' . PHP_EOL;
			$output .= '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>' . PHP_EOL;
            $output .= '<td>
                        <button class="btn btn-success btn-xs"
                        data-type="view"
                        data-id="' . $row['cuid'] . '"
                        data-name="' . $row['company'] . '"
						data-unpaidCharge="' . $unpaidCharge . '";
                        data-toggle="modal"
                        data-target="#modal_view_company" onclick="pushData(this)"><i class="fa fa-eye"></i> View</button>
                        </td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

           

        }
        return $output;
    }

}
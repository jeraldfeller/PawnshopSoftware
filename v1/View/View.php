<?php
class View extends Employee
{
	public $companyName = 'Pawnshop Software';

	

	public function displayUsers($user, $system)
	{
		$count = 0;
		$output = ' ';
		foreach ($user as $row)
		{
            $password = $system->makeHash('decrypt', $row['password']);
		if ($count % 2 == 0) {
				
			$class = 'even';
		}
		
		else {
			$class = 'odd';
		}
		$output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['user_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $password . '</td>' . PHP_EOL;
            $output .= '<td>' . date("m/d/Y", strtotime($row['date_added'])) . '</td>' . PHP_EOL;
            $output .= '<td><button class="btn btn-primary btn-xs"
                        data-type="manage"
                        data-id="' . $row['id'] . '"
                        data-user="' . $row['user_name'] . '"
                        data-customer="' . $row['customer_page'] . '"
                        data-general="' . $row['general_pawn_page'] . '"
                        data-title="' . $row['title_pawn_page'] . '"
                        data-scrap="' . $row['scrap_page'] . '"
                        data-repair="' . $row['repair_page'] . '"
                        data-refill="' . $row['refill_page'] . '"
                        data-rto="' . $row['rto_page'] . '"
                        data-inventory="' . $row['inventory_page'] . '"
                        data-outright="' . $row['outright_page'] . '"
                        data-pos="' . $row['pos_page'] . '"
                        data-petty="' . $row['petty_page'] . '"
                        data-check="' . $row['check_page'] . '"
                        data-void="' . $row['void_page'] . '"
                        data-toggle="modal"
                        data-target="#pages_modal"
                        onclick="pushData(this)"><i class="fa fa-file"></i> Manage Pages</button>

                        <button class="btn btn-success btn-xs"
                        data-type="edit"
                        data-id="' . $row['id'] . '"
                        data-first-name="' . $row['first_name'] . '"
                        data-last-name="' . $row['last_name'] . '"
                        data-user="' . $row['user_name'] . '"
                        data-password="' . $password . '"
                        data-toggle="modal"
                        data-target="#modal_edit_user" onclick="pushData(this)"><i class="fa fa-edit"></i> Edit</button>

                        <button class="btn btn-danger btn-xs"
                        data-type="delete"
                        data-id="' . $row['id'] . '"
                        data-first-name="' . $row['first_name'] . '"
                        data-last-name="' . $row['last_name'] . '"
                        data-user="' . $row['user_name'] . '"
                        data-password="' . $row['password'] . '"
                        data-toggle="modal"
                        data-target="#modal_delete_user" onclick="pushData(this)"><i class="fa fa-trash-o"></i> Delete</button>
                        </td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
		
		$count++;
		
		}
		return $output;
	}
	
	public function displayLoanMatrix($matrix) {
		
		$count = 0;
		$output = ' ';
		foreach ($matrix as $row)
		{
			
		if ($count % 2 == 0) {
				
			$class = 'even';
		}
		
		else {
			$class = 'odd';
		}
		if($row['occur_late_fees'] == 'fixed'){
			$occur = 'Fixed 30 days';
		}else if ($row['occur_late_fees'] == 'daily') {
			$occur = 'Daily';
		}else{
			$occur = '';
		}
		
            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $row['title'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['terms_of_loan'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['rate_first'] . '&#37;</td>' . PHP_EOL;
            $output .= '<td>' . $row['rate_second'] . '&#37;</td>' . PHP_EOL;
			$output .= '<td>' . $occur . '</td>' . PHP_EOL;
			$output .= '<td>
                        <button class="btn btn-success btn-xs"
                        data-type="edit"
						data-id="' . $row['id'] . '"
						data-title="' . $row['title'] . '"
						data-term="' . $row['terms_of_loan'] . '"
						data-rate_first="' . $row['rate_first'] . '"
						data-rate_second="' . $row['rate_second'] . '"
						data-occur="' .  $row['occur_late_fees'] . '"
						data-toggle="modal" data-target="#modal"
						onClick="pushData(this)"><i class="fa fa-edit"></i> Edit</button>

						<button class="btn btn-danger btn-xs"
						data-type="delete"
						data-id="' . $row['id'] . '"
						data-title="' . $row['title'] . '"
						data-term="' . $row['terms_of_loan'] . '"
						data-rate_first="' . $row['rate_first'] . '"
						data-rate_second="' . $row['rate_second'] . '"
						data-occur="' .  $row['occur_late_fees'] . '"
						data-toggle="modal" data-target="#modal_delete"
						onClick="pushData(this)"><i class="fa fa-trash-o"></i> Delete</button>

						</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
		
		$count++;
		
		}
		return $output;
		
		
	}
	
	
	public function displayGetCustomer($customer)
	{
		$output = ' ';
		foreach ($customer as $row)
		{
	
		$output .= '<option value=' . $row['customer_id'] . '>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</option>' . PHP_EOL;
		
		}
		return $output;
	}
	
	
	public function displayAddedItem($item) {
		
		$count = 0;
		$output = ' ';
		foreach ($item as $row)
		{
			
		if ($count % 2 == 0) {
				
			$class = 'even';
		}
		
		else {
			$class = 'odd';
		}
		$output .= '<tr class="sum ' . $class . '">' . PHP_EOL;
        $output .= '<td>' . $row['item_description'] . '</td>' . PHP_EOL;
        $output .= '<td>' . $row['serial_number'] . '</td>' . PHP_EOL;
        $output .= '<td>$' . $row['loan_amount'] . '</td>' . PHP_EOL;
		$output .= '<td id="hidden" class="amount">' . $row['loan_amount'] . '</td>' . PHP_EOL;
		$output .= '<td>$' . $row['retail'] . '</td>' . PHP_EOL;
		$output .= '<td id="hidden" class="retail">' . $row['loan_amount'] . '</td>' . PHP_EOL;
		$output .= '<td><img src="../images/pawned_items/' . $row['pawn_image'] . '" class="thumbnail"></td>' . PHP_EOL;
        $output .= '</tr>' . PHP_EOL;
		
		$count++;
		
		}
		return $output;
		
		
	}
	
	public function displayAddedItemTmp($item) {
		
		$count = 0;
		$output = ' ';
		foreach ($item as $row)
		{
			
            if ($count % 2 == 0) {

                $class = 'even';
		}
		
		else {
			$class = 'odd';
		}
            $output .= '<tr id="row_'.$count.'" class="' . $class . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['item_description'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['serial_number'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . $row['loan_amount'] . '</td>' . PHP_EOL;
            $output .= '<td id="hidden" class="amount">' . $row['loan_amount'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . $row['retail'] . '</td>' . PHP_EOL;
            $output .= '<td id="hidden" class="retail">' . $row['loan_amount'] . '</td>' . PHP_EOL;
            if ($row['pawn_image'] == ' '  || $row['pawn_image'] == null){
                $output .= '<td><div class="pageicon"><img width="45" height="45" src="images/thumbs/no-id.png"></div></td>' . PHP_EOL;
                $output .= '<td style="display: none;" id="image_name_'.$count.'" class="retail"> </td>' . PHP_EOL;
            }
            else{
                $output .= '<td><div class="pageicon"><img width="45" height="45" src="images/pawned_items/' . $row['pawn_image'] . '"></div></td>' . PHP_EOL;
                $output .= '<td style="display: none;" id="image_name_'.$count.'" class="retail">../images/pawned_items/' . $row['pawn_image'] . '</td>' . PHP_EOL;
            }
            $output .= '<td><button id="item_id_'.$count.'" value="' . $row['id'] . '" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

            $count++;
		
		}
		return $output;
		
		
	}
	
	public function displayOutrightAddedItemTmp($item) {
		
		$count = 0;
		$output = ' ';
		foreach ($item as $row)
		{
			
		if ($count % 2 == 0) {
				
			$class = 'even';
		}
		
		else {
			$class = 'odd';
		}
            $output .= '<tr id="row_'.$count.'" class="' . $class . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td id="description_'.$count.'">' . $row['item_description'] . '</td>' . PHP_EOL;
            $output .= '<td id="serial_'.$count.'">' . $row['serial_number'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['purchase_price'], 2) . '</td>' . PHP_EOL;

            $output .= '<td style="display:none" id="price_'.$count.'" class="price">' . $row['purchase_price'] . '</td>' . PHP_EOL;
            $output .= '<td id="retail_'.$count.'">$' . $row['retail'] . '</td>' . PHP_EOL;
            $output .= '<td id="quantity_'.$count.'">' . $row['quantity'] . '</td>' . PHP_EOL;
            $output .= '<td id="total_'.$count.'">$' . number_format($row['total'], 2) . '</td>' . PHP_EOL;
            $output .= '<td style="display:none" id="amount_'.$count.'" class="amount">' . $row['total'] . '</td>' . PHP_EOL;
            if ($row['pawn_image'] == ' '  || $row['pawn_image'] == null){
                $output .= '<td><img src="images/thumbs/no-id.png" class="thumbnail"></td>' . PHP_EOL;
                $output .= '<td style="display: none;" id="image_name_'.$count.'" class="retail"> </td>' . PHP_EOL;
            }
            else {
                $output .= '<td id="image_'.$count.'"><img src="../images/outright_items/' . $row['pawn_image'] . '" class="thumbnail"></td>' . PHP_EOL;
                $output .= '<td style="display: none;" id="image_name_'.$count.'" class="retail">images/outright_items/' . $row['pawn_image'] . '</td>' . PHP_EOL;
            }


            $output .= '<td><button id="item_id_'.$count.'" value="' . $row['id'] . '" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
		
		$count++;
		
		}
		return $output;
		
		
	}
	
	public function displayPawnedItem($item) {
		
		$count = 0;
		$output = ' ';
		foreach ($item as $row)
		{
			
		if ($count % 2 == 0) {
				
			$class = 'even';
		}
		
		else {
			$class = 'odd';
		}
		$output .= '<tr class="sum ' . $class . '">' . PHP_EOL;
        $output .= '<td>' . $row['item_description'] . '</td>' . PHP_EOL;
        $output .= '<td>' . $row['serial_number'] . '</td>' . PHP_EOL;
        $output .= '<td>$' . $row['loan_amount'] . '</td>' . PHP_EOL;
		$output .= '<td id="hidden" class="amount">' . $row['loan_amount'] . '</td>' . PHP_EOL;
		$output .= '<td>' . $row['retail'] . '</td>' . PHP_EOL;
		$output .= '<td><img src="../images/pawned_items/' . $row['pawn_image'] . '" class="thumbnail"></td>' . PHP_EOL;
		/*$output .= '<td><div class="checkbox"><input tabindex="5" type="checkbox" name="choice" value="' . $row['loan_amount'] . '" onChange="checkTotal()" /></div></div></td>' . PHP_EOL;*/
		$output .= '<td><div class="checkbox"><input id="list" class="amount" data-price="' . $row['loan_amount'] . '" tabindex="5" type="checkbox" name="choice[]" value="' . $row['id'] . '" onChange="updateTotal(this);" /></div></div></td>' . PHP_EOL;
        
        $output .= '</tr>' . PHP_EOL;
		
		$count++;
		
		}
		return $output;
		
		
	}
	
	
	
	
	public function displayOutrightItem($item) {
		
		$count = 0;
		$output = ' ';
		foreach ($item as $row)
		{
			
		if ($count % 2 == 0) {
				
			$class = 'even';
		}
		
		else {
			$class = 'odd';
		}
		$output .= '<tr id="row_'.$count.'" class="' . $class . '">' . PHP_EOL;
		$output .= '<td style="display:none">' . $count . '</td>';
        $output .= '<td id="description_'.$count.'">' . $row['item_description'] . '</td>' . PHP_EOL;
        $output .= '<td id="serial_'.$count.'">' . $row['serial_number'] . '</td>' . PHP_EOL;
        $output .= '<td>$' . $row['purchase_price'] . '</td>' . PHP_EOL;
		$output .= '<td style="display:none" id="amount_'.$count.'" class="amount">' . $row['purchase_price'] . '</td>' . PHP_EOL;
		$output .= '<td style="display:none" id="price_'.$count.'" class="price">' . $row['purchase_price'] . '</td>' . PHP_EOL;
		$output .= '<td id="retail_'.$count.'">' . $row['retail'] . '</td>' . PHP_EOL;
		$output .= '<td id="image_'.$count.'"><img src="../images/outright_items/' . $row['pawn_image'] . '" class="thumbnail"></td>' . PHP_EOL;
		$output .= '<td id="quantity_'.$count.'"><input style="width: 60px;" class="form-control" type="text" value="1"></td>' . PHP_EOL;
        $output .= '</tr>' . PHP_EOL;
		
		$count++;
		
		}
		return $output;
		
		
	}
	
	public function displayMatrix($matrix)
	{
		$output = ' ';
		foreach ($matrix as $row)
		{
	
		$output .= '<option data-terms="' . $row['terms_of_loan'] . '" data-percentage="' . $row['rate_first'] . '" value="' . $row['id'] . '">' . $row['title'] . '</option>' . PHP_EOL;
		
		}
		return $output;
	}
	
	public function displayCustomerForAutoComplete($customer)
	{
		$output = ' ';
		foreach ($customer as $row)
		{
	
			$output .= '{label: "' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' - ' . $row['customer_id'] . '", value: "' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' - ' . $row['customer_id'] . '"},' . PHP_EOL;
			
		
		}
		return html_entity_decode($output);
	}
	
	public function displayCustomerIdAutoComplete($customer)
	{
		$output = ' ';
		foreach ($customer as $row)
		{
	
			$output = $row['customer_id'];
		
		}
		return $output;
	}


    public function displayCustomerNumberForAutoComplete($customer)
    {
        $output = ' ';
        foreach ($customer as $row)
        {

            $output .= '{label: "' . $row['cell_no'] . '", value: "' . $row['cell_no'] . '"},' . PHP_EOL;


        }
        return html_entity_decode($output);
    }

	public function displayCustomerInfo($customer)
	{
		$output = ' ';


		foreach ($customer as $row)
		{

            $output .= '<div class="col-lg-12">' . PHP_EOL;
            $output .= '<div class="form-group">' . PHP_EOL;
            $output .= '<h3 class="box-heading">' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</h3>' . PHP_EOL;
            $output .= '<div class="mbl"></div>' . PHP_EOL;
            $output .= '</div></div>' . PHP_EOL;
            $output .= '<div class="col-lg-4"><label>Address: ' . $row['address'] . '</label> </div>' . PHP_EOL;
            $output .= '<div class="col-lg-3"><label>City: ' . $row['city'] . '</label> </div>' . PHP_EOL;
            $output .= '<div class="col-lg-2"><label>State: ' . $row['state'] . '</label></div>' . PHP_EOL;
            $output .= '<div class="col-lg-3"><label>Zip: ' . $row['zip'] . '</label></div>' . PHP_EOL;
            $output .= '<div class="col-lg-4"><label>Home Phone #: ' . $row['home_no'] . '</label></div>' . PHP_EOL;
            $output .= '<div class="col-lg-3"><label>Cell Phone #: ' . $row['cell_no'] . '</label></div>' . PHP_EOL;
            //$output .= '<div style="display:none;" class="col-lg-3"><input type="text" name="customer_cp_number" value="' . $row['cell_no'] . '"></div>' . PHP_EOL;
            $output .= '<input style="display:none;" name="customer_id" type="text" id="selectCustomer" value="' . $row['customer_id'] . '">' . PHP_EOL;
		}
		return $output;
	}
	
	public function displayInventoryItems($items, $type)
	{
		$count = 1;
		$output = ' ';
		foreach ($items as $row)
		{
			if(isset($row['image'])){
				if($row['image'] != ''){
                $image = '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="75" height="75" class="img-responsive"/>' . PHP_EOL;
				}else{
					$image = '<img src="images/customers/NO ID.jpg" width="75" height="75" class="img-responsive"/>' . PHP_EOL;
				}
			}
			
			

		if ($count % 2 == 0) {

			$class = 'even';
		}

		else {
			$class = 'odd';
		}
            if($type == 'pos') {
                $output .= '<tr id="row_' . $count . '" class="' . $class . '">' . PHP_EOL;
                $output .= '<td style="display:none">' . $count . '</td>';
                $output .= '<td style="display:none" id="cid_' . $count . '"><input type="hidden" name="customerId[]" value="0"></td>' . PHP_EOL;
                $output .= '<td id="item_no_' . $count . '">' . $row['item_no'] . '</td>' . PHP_EOL;
                $output .= '<td id="description_' . $count . '">' . $row['description'] . '</td>' . PHP_EOL;
                $output .= '<td style="display:none" id="cost_' . $count . '">' . $row['retail'] . '</td>' . PHP_EOL;
                $output .= '<td>$' . $row['cost'] . '</td>' . PHP_EOL;
                $output .= '<td style="display:none" id="retail_' . $count . '">' . $row['retail'] . '</td>' . PHP_EOL;
                $output .= '<td>$' . $row['retail'] . '</td>' . PHP_EOL;
                $output .= '<td id="qty_' . $count . '">' . $row['quantity'] . '</td>' . PHP_EOL;
                $output .= '<td id="count_' . $count . '" style="display:none">1</td>' . PHP_EOL;
                $output .= '<td style="display:none" id="checkbox_price_' . $count . '">' . $row['retail'] . '</td>' . PHP_EOL;
                //	$output .= '<td><input id="list" class="amount" data-price="' . $row['cost'] . '" tabindex="5" type="checkbox" name="choice[]" value="' . $row['item_no'] . '" onChange="updateTotal(this);" /></td>' . PHP_EOL;
                $output .= '<td id="checkbox_' . $count . '" class="table-input"><input style="display: inline;" id="list" class="amount" data-count="1" data-price="' . $row['retail'] . '" tabindex="5" type="checkbox" name="choice[]" value="' . $row['inventory_id'] . '" data-toggle="tooltip" data-toggle="tooltip" data-placement="left" title="Check to select item"></td>' . PHP_EOL;
                $output .= '<td id="quantity_' . $count . '"><input style="width: 60px;" class="form-control" type="text" value="1" name="quantity[]"></td>' . PHP_EOL;
                $output .= '</tr>' . PHP_EOL;
            }
            else if($type == 'view'){
                $output .= '<tr>' . PHP_EOL;
                $output .= '<td>' . $row['item_no'] . '</td>' . PHP_EOL;
				 $output .= '<td>' . $image . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['description'] . '</td>' . PHP_EOL;
                $output .= '<td>$' . $row['cost'] . '</td>' . PHP_EOL;
                $output .= '<td>$' . $row['retail'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['quantity'] . '</td>' . PHP_EOL;
                $output .= '<td>' . PHP_EOL;
                $output .= '<div class="btn-group">' . PHP_EOL;
                $output .= '<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs">Action' . PHP_EOL;
                $output .= '&nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
                $output .= '<ul role="menu" class="dropdown-menu">' . PHP_EOL;
                $output .= '<li><a href="#" data-id="' . $row['inventory_id'] . '" data-item-no="' . $row['item_no'] . '" data-desc="' . $row['description'] . '" data-cost="' . $row['cost'] . '" data-retail="' . $row['retail'] . '" data-qty="' . $row['quantity'] . '" data-type="edit" data-toggle="modal" data-target="#modal" onClick="pushData(this)"><span class="label label-info"><i class="fa fa-edit"></i></span>&nbsp; Edit</span></a></li>' . PHP_EOL;
                $output .= '<li><a href="#" data-id="' . $row['inventory_id'] . '" data-desc="' . $row['description'] . '" data-type="delete" data-toggle="modal" data-target="#modal_del" onClick="pushData(this)"><span class="label label-danger"><i class="fa fa-times"></i></span>&nbsp; Delete</span></a></li>' . PHP_EOL;
                $output .= '</ul>' . PHP_EOL;
                $output .= '</div>' . PHP_EOL;
                $output .= '</td>' . PHP_EOL;
                $output .= '</tr>' . PHP_EOL;
            }
            else if($type == 'barcode'){
                $output .= '{label: "' . $row['item_no'] . '", value: "' . $row['item_no'] . '"},' . PHP_EOL;
            }
            else if($type == 'description'){
                $output .= '{label: "' . $row['description'] . '", value: "' . $row['description'] . '"},' . PHP_EOL;
            }

		$count++;
		}
		return $output;
	}
	
	
	public function displayCustomerPawnedItems($pawns) {
		
		$count = 0;
		$output = ' ';
		foreach ($pawns as $row)
		{
            $state = $row['allow_partial'];
            if($state == 2){
                $interest_accured = $row['interest_accured'] - $row['partial_payment'];
            }
            else {
                $interest_accured = $row['interest_accured'];
            }
            $dueClass = ' ';
            $due = '0';
			
            if($row['occur_late_fees'] == 'fixed' || $row['occur_late_fees'] == 'daily' ){
                if($row['due_date'] <= date('Y-m-d')){
                  
                    $due = '1';
                    $dueClass = 'class="label label-danger"';
                }
            }


            $output .= '<tr id="row_'.$count.'">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>';
            $output .= '<td><div class="col-lg-12">' . PHP_EOL;

                $customer_id = $row['customer_id'];
                $loan_id = $row['loan_info_id'];

                $items = $this->getCustomerPawnedItems($customer_id, $loan_id);
                foreach($items as $item){
                    $item_id = $item['id'];
                    if ($item['pawn_image'] == ' '  || $item['pawn_image'] == null){
                        $x = '<img width="75" height="75" src="../images/thumbs/no-id.png">';
                    }
                    else {
                        $x = '<img width="75" height="75" src="../images/pawned_items/' . $item['pawn_image'] . '">';
                    }
                    //output .= $x $item['item_description'] . ' - ' . $item['serial_number']  . ' ' . $x . '<br>' . PHP_EOL;
                    $output .= '<div class="col-lg-6">' . PHP_EOL;
                     $output .= '<div class="panel panel-default">' . PHP_EOL;
                     $output .= '<div class="panel-heading">' . PHP_EOL;
                     $output .=  '<div class="panel-btns">' . PHP_EOL;
                     $output .=  '<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>' . PHP_EOL;
                     $output .=  '<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>' . PHP_EOL;
                     $output .=  '</div><!-- panel-btns -->' . PHP_EOL;
                     $output .=  '<h5 class="panel-title">' . $item['item_description'] . '</h5>' . PHP_EOL;
                     $output .=   '</div>' . PHP_EOL;
                     $output .=   '<div class="panel-body">' . PHP_EOL;
                     $output .=    $x . PHP_EOL;
                     $output .=   '</div>' . PHP_EOL;
                     $output .=   '</div>' . PHP_EOL;

                    $output .=   '</div>' . PHP_EOL;
                }
            $output .= '</div></td>' . PHP_EOL;

            $output .= '<td>$' . number_format($row['totalLoan'] + $row['penalty'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($interest_accured, 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['penalty'], 2) . '</td>' . PHP_EOL;

            /*$output .= '<td><div class="checkbox"><input tabindex="5" type="checkbox" name="choice" value="' . $row['loan_amount'] . '" onChange="checkTotal()" /></div></div></td>' . PHP_EOL;*/
            $output .= '<td><span ' . $dueClass . '>' . date("m/d/Y", strtotime($row['due_date'])) . '</span></td>' . PHP_EOL;
            $output .= '<td id="checkbox_'.$count.'"><div class="ckbox ckbox-success"><input id="list'.$count.'" class="amount styled" data-tid="' . $row['loan_info_id'] . '" data-allowed="' . $row['allow_partial'] . '" data-pawnType="General Pawn" data-accured="' . number_format($interest_accured, 2) . '" data-interest="' . $row['interest_rate'] . '" data-due="' . $row['due_date'] . '" data-price="' . $row['totalLoan'] . '" data-pass-due="' . $due . '" data-penalty ="' . $row['penalty'] . '" data-occur="' . $row['occur_late_fees'] . '" tabindex="5" type="checkbox" name="choice[]" value="' . $item_id . '" onChange="updateTotal(this);" /><label for="list'.$count.'"></label></div></td>' . PHP_EOL;
            //$output .= '<td id="checkbox_'.$count.'"><input id="list" class="amount" data-tid="' . $row['loan_info_id'] . '" data-allowed="' . $row['allow_partial'] . '" data-pawnType="General Pawn" data-accured="' . number_format($interest_accured, 2) . '" data-interest="' . $row['interest_rate'] . '" data-due="' . $row['due_date'] . '" data-price="' . $row['totalLoan'] . '" data-pass-due="' . $due . '" data-penalty ="' . $row['penalty'] . '" data-occur="' . $row['occur_late_fees'] . '" tabindex="5" type="checkbox" name="choice[]" value="' . $item_id . '" onChange="updateTotal(this);" /></td>' . PHP_EOL;
            $output .= '<td style="display:none" id="loan_info_id_'.$count.'" class="loan_info_id"><input type="text" name="info_id[]" value="' . $row['loan_info_id'] . '" disabled/></td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

		
		$count++;
		
		}
		return $output;
		
		
	}



    public function displayCustomerTitlePawnedItems($items) {

        $count = 0;
        $output = ' ';
        foreach ($items as $row)
        {

            $state = $row['allow_partial'];
            if($state == 2){
                $interest_accured = $row['interest_accured'] - $row['partial_payment'];
            }
            else {
                $interest_accured = $row['interest_accured'];
            }

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }
			
			$dueClass = ' ';
            $due = '0';
			
            if($row['occur_late_fees'] == 'fixed' || $row['occur_late_fees'] == 'daily' ){
                if($row['due_date'] <= date('Y-m-d')){
                  
                    $due = '1';
                    $dueClass = 'class="label label-danger"';
                }
            }



            $output .= '<tr id="row_'.$count.'" class="sum ' . $class . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>';
            $output .= '<td>' . $row['vin_no'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['model'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['total_loan'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($interest_accured, 2) . '</td>' . PHP_EOL;
			$output .= '<td>$' . number_format($row['penalty'], 2) . '</td>' . PHP_EOL;
            /*$output .= '<td><div class="checkbox"><input tabindex="5" type="checkbox" name="choice" value="' . $row['loan_amount'] . '" onChange="checkTotal()" /></div></div></td>' . PHP_EOL;*/
            $output .= '<td><span ' . $dueClass . '>' . date("m/d/Y", strtotime($row['due_date'])) . '</span></td>' . PHP_EOL;
            $output .= '<td id="checkboxT_'.$count.'"><input id="list" class="amount" data-tid="' . $row['tittle_pawn_id'] . '" data-allowed="' . $row['allow_partial'] . '" data-pawnType="Title Pawn" data-accured="' . number_format($interest_accured, 2) . '" data-interest="' . $row['interest_rate'] . '" data-due="' . $row['due_date'] . '" data-price="' . $row['total_loan'] . '" data-pass-due="' . $due . '" data-penalty ="' . $row['penalty'] . '" tabindex="5" type="checkbox" name="choice[]" value="' . $row['tittle_pawn_id'] . '" onChange="updateTotal(this);" /></td>' . PHP_EOL;
            $output .= '<td style="display:none" id="loan_title_id_'.$count.'" class="loan_title_id"><input type="text" name="title_id[]" value="' . $row['tittle_pawn_id'] . '" disabled/></td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;



            $count++;

        }
        return $output;


    }


    /**
     * @param $id
     */

    function displayState($state, $selected_state){
        $output = ' ';
        foreach ($state as $row){
            if($row['state'] == $selected_state){
                $selected = 'selected';
            }
            else {
                $selected ='';
            }
            $output .= '<option value="' . $row['state'] . '" ' . $selected . '>' . $row['state'] . '</option>' . PHP_EOL;
        }

        return $output;
    }

        function displayViewCustomer($customer, $pawns, $title_pawns, $repairs, $refills, $rto, $pos, $notes){

        $state = $this->getState();

        $output = ' ';
        foreach ($customer as $row)
        {
            $cid = $row['customer_id'];
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];
            $address = $row['address'];
            $city = $row['city'];
            $state_v = $row['state'];
            $zip = $row['zip'];
            $home_no = $row['home_no'];
            $cell_no = $row['cell_no'];
            $dl = $row['drivers_license_no'];
            $dl_issue_date = $row['dl_issue_date'];
            $dl_expire_date = $row['dl_expire_date'];
            $sss_no = $row['sss_no'];
            $height = $row['height'];
            $weight = $row['weight'];
            $eye_color = $row['eye_color'];

            $output .= '<div class="col-md-12"><h2>Profile: ' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</h2>' . PHP_EOL;
            $output .= '<div class="row mtl">' . PHP_EOL;
            $output .= '<div class="col-md-3">' . PHP_EOL;
            $output .= '<div class="form-group">' . PHP_EOL;
            if($row['customer_photo'] != ''){
                $output .= '<div class="text-center mbl"><img src="data:image/jpeg;base64,'.base64_encode( $row['customer_photo'] ).'" class="img-responsive"/></div>' . PHP_EOL;
            }else{
                $output .= '<div class="text-center mbl"><img src="../images/customers/NO ID.jpg" class="img-responsive"/></div>' . PHP_EOL;
            }

            $output .= '</div>' . PHP_EOL;
            $output .= '<table class="table table-striped table-hover">' . PHP_EOL;
            $output .= '<tbody>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Address</td>' . PHP_EOL;
            $output .= '<td>' . $row['address'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>City</td>' . PHP_EOL;
            $output .= '<td>' . $row['city'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>State</td>' . PHP_EOL;
            $output .= '<td>' . $row['state'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Zip Code</td>' . PHP_EOL;
            $output .= '<td>' . $row['zip'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Home #</td>' . PHP_EOL;
            $output .= '<td>' . $row['home_no'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Cell #</td>' . PHP_EOL;
            $output .= '<td>' . $row['cell_no'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Drivers License #</td>' . PHP_EOL;
            $output .= '<td>' . $row['drivers_license_no'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Issue Date</td>' . PHP_EOL;
            $output .= '<td>' . $row['dl_issue_date'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Expire Date</td>' . PHP_EOL;
            $output .= '<td>' . $row['dl_expire_date'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Social Security Number#</td>' . PHP_EOL;
            $output .= '<td>' . $row['sss_no'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Height</td>' . PHP_EOL;
            $output .= '<td>' . $row['height'] . ' Inches</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Weight</td>' . PHP_EOL;
            $output .= '<td>' . $row['weight'] . ' Lbs</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>Eye Color</td>' . PHP_EOL;
            $output .= '<td>'. $row['eye_color'] . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '</tbody>' . PHP_EOL;
            $output .= '</table>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="col-md-9">' . PHP_EOL;
            $output .= '<ul class="nav nav-tabs nav-primary">' . PHP_EOL;
            $output .= '<li  class="active"><a href="#tab-pawns" data-toggle="tab">Customer Pawn History</a></li>' . PHP_EOL;
            $output .= '<li><a href="#tab-edit" data-toggle="tab">Edit Profile</a></li>' . PHP_EOL;
            $output .= '</ul>' . PHP_EOL;
            $output .= '<div id="generalTabContent" class="tab-content">' . PHP_EOL;
            $output .= '<div id="tab-pawns" class="tab-pane fade in active">' . PHP_EOL;



            $output .= '<ul class="nav nav-tabs nav-line">' . PHP_EOL;
            $output .= '<li  class="active"><a href="#general-pawns" data-toggle="tab">General Pawns</a></li>' . PHP_EOL;
            $output .= '<li><a href="#title-pawns" data-toggle="tab">Title Pawns</a></li>' . PHP_EOL;
            $output .= '<li><a href="#repair-invoice" data-toggle="tab">Repairs</a></li>' . PHP_EOL;
            $output .= '<li><a href="#refills" data-toggle="tab">Refills</a></li>' . PHP_EOL;
            $output .= '<li><a href="#rto" data-toggle="tab">RTO</a></li>' . PHP_EOL;
            $output .= '<li><a href="#purchases" data-toggle="tab">Purchases</a></li>' . PHP_EOL;
			$output .= '<li><a href="#notes" data-toggle="tab">Account Notes</a></li>' . PHP_EOL;
            $output .= '</ul>' . PHP_EOL;

            $output .= '<ul class="tab-content nopadding noborder">' . PHP_EOL;
            $output .= '<li class="tab-pane fade in active" id="general-pawns">' . PHP_EOL;

            $output .= '<table class="table table-striped table-hover align-center">' . PHP_EOL;
            $output .= '<thead>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<th>Item Description</th>' . PHP_EOL;
            $output .= '<th>Loan Amount</th>' . PHP_EOL;

            $output .= '<th>Loan Title</th>' . PHP_EOL;
            $output .= '<th>Terms of Loan</th>' . PHP_EOL;
            $output .= '<th>Date Pawned</th>' . PHP_EOL;
            $output .= '<th>Due Date</th>' . PHP_EOL;
            $output .= '<th>Action</th>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '</thead>' . PHP_EOL;
            $output .= '<tbody>' . PHP_EOL;

            foreach($pawns as $pawn) {
                $date = date('Y-m-d');
                $due_date = date('Y-m-d', strtotime($pawn['due_date']));
                $datetime1 = new DateTime($date);
                $datetime2 = new DateTime($due_date);
                $interval = $datetime2->diff($datetime1);
                $date_diff = $interval->format('%a');

                $output .= '<tr>' . PHP_EOL;
                $output .= '<td>'. PHP_EOL;
                $customer_id = $pawn['customer_id'];
                $loan_id = $pawn['loan_info_id'];

                $items = $this->getCustomerPawnedItems($customer_id, $loan_id);
                foreach ($items as $item) {
                    $output .= $item['item_description'] . ' - ' . $item['serial_number'] .  '<br>';
                }

                $output .= '</td>' . PHP_EOL;
                $output .= '<td>$' . number_format($pawn['loan_amount'], 2) . '</td>' . PHP_EOL;

                $output .= '<td>' . $pawn['title'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $pawn['terms_of_loan'] . '</td>' . PHP_EOL;
                $output .= '<td>' . date("m/d/Y", strtotime($pawn['date_added'])) . '</td>' . PHP_EOL;
                if($date_diff == 5){
                    $output .= '<td><span class="label label-warning">' . date('m/d/Y', strtotime($pawn['due_date'])) . '</span></td>' . PHP_EOL;
                }
                else if ($date_diff < 5){
                    $output .= '<td><span class="label label-red">' . date('m/d/Y', strtotime($pawn['due_date'])) . '</span></td>' . PHP_EOL;
                }

                else{
                    $output .= '<td><span class="label label-success">' . date('m/d/Y', strtotime($pawn['due_date'])) . '</span></td>' . PHP_EOL;
                }
                $output .= '<td><a href="view-customer-pawns.php?customer_id=' . $pawn['customer_id'] . '&pawn_id=' . $pawn['loan_info_id'] . '"><span class="label label-info "><i class="fa fa-eye"></i>View Pawn</span></a></td>' . PHP_EOL;


                $output .= '</tr>' . PHP_EOL;
            }
            $output .= '</tbody>' . PHP_EOL;
            $output .= '</table>' . PHP_EOL;

            $output .= '</li>' . PHP_EOL;
            $output .= '<li class="tab-pane fade in" id="title-pawns">' . PHP_EOL;
            $output .= '<table class="table table-striped table-hover align-center">' . PHP_EOL;
            $output .= '<thead>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;

            $output .= '<th>Model</th>' . PHP_EOL;
            $output .= '<th>Loan Amount</th>' . PHP_EOL;
            $output .= '<th>Retail</th>' . PHP_EOL;
            $output .= '<th>Loan Title</th>' . PHP_EOL;
            $output .= '<th>Terms of Loan</th>' . PHP_EOL;
            $output .= '<th>Date Pawned</th>' . PHP_EOL;
            $output .= '<th>Due Date</th>' . PHP_EOL;
            $output .= '<th>Status</th>' . PHP_EOL;
            $output .= '<th>Action</th>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;
            $output .= '</thead>' . PHP_EOL;
            $output .= '<tbody>' . PHP_EOL;
            foreach($title_pawns as $pawn){
                $date = date('Y-m-d');
                $due_date = date('Y-m-d', strtotime($pawn['due_date']));
                $datetime1 = new DateTime($date);
                $datetime2 = new DateTime($due_date);
                $interval = $datetime2->diff($datetime1);
                $date_diff = $interval->format('%a');

                $output .= '<tr>' . PHP_EOL;

                $output .= '<td>' . $pawn['model'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $pawn['total_loan_amount'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $pawn['retail'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $pawn['title'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $pawn['terms_of_loan'] . '</td>' . PHP_EOL;
                $output .= '<td>' . date("m/d/Y", strtotime($pawn['date_added'])) . '</td>' . PHP_EOL;
                if($date_diff == 5){
                    $output .= '<td><span class="label label-warning">' . date('m/d/Y', strtotime($pawn['due_date'])) . '</span></td>' . PHP_EOL;
                }
                else if ($date_diff < 5 || $pawn['status'] == 'not redeemed'){
                    $output .= '<td><span class="label label-danger">' . date('m/d/Y', strtotime($pawn['due_date'])) . '</span></td>' . PHP_EOL;
                }

                else{
                    $output .= '<td><span class="label label-success">' .date('m/d/Y', strtotime($pawn['due_date'])) . '</span></td>' . PHP_EOL;
                }

                $output .= '<td>' . $pawn['status'] . '</td>' . PHP_EOL;
                $output .= '<td><a href="view-customer-title-pawns.php?customer_id=' . $pawn['customer_id'] . '&pawn_id=' . $pawn['tittle_pawn_id'] . '"><span class="label label-info "><i class="fa fa-eye"></i>View Pawn</span></a></td>' . PHP_EOL;

                $output .= '</tr>' . PHP_EOL;
            }
            $output .= '</tbody>' . PHP_EOL;
            $output .= '</table>' . PHP_EOL;
            $output .= '</li>' . PHP_EOL;

            $output .= '<li class="tab-pane fade in" id="repair-invoice">' . PHP_EOL;
            $output .= '<table class="table table-striped table-hover align-center">' . PHP_EOL;
            $output .= '<thead>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<th>Repair Item Description</th>' . PHP_EOL;
            $output .= '<th>Serial #</th>' . PHP_EOL;
            $output .= '<th>Repair Status</th>' . PHP_EOL;
            $output .= '<th>Invoice Status</th>' . PHP_EOL;

            $output .= '<th>Action</th>' . PHP_EOL;
            $link = "edit-repair-orders.php?";
            $link_pay = "redeem-repair-orders.php?";
            foreach($repairs as $repair){
                if($repair['repair_status'] == 'in_progress') {$s = 'In Progress';}
                if($repair['repair_status'] == 'awaiting_parts') {$s = 'Awaiting Parts';}
                if($repair['repair_status'] == 'fixed') {$s = 'Fixed A.C.P.';}
                if($repair['repair_status'] == 'completed') {$s = 'Completed';}
                $output .= '<tr>' . PHP_EOL;
                $output .= '<td>' . $repair['repair_item_description'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $repair['repair_serial_number'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $s . '</td>' . PHP_EOL;
                $output .= '<td>' . strtoupper($repair['invoice_status']) . '</td>' . PHP_EOL;
                $output .= '<td>' . PHP_EOL;
                $output .= '<div class="btn-group">' . PHP_EOL;
                $output .= '<button type="button" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true" class="btn btn-primary btn-xs dropdown-toggle">Action &nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
                $output .= '<ul class="dropdown-menu">' . PHP_EOL;
                $output .= '<li><a href="' . $link .'customer_id=' . $repair['customer_id'] . '&repair_id=' . $repair['repair_invoice_id'] . '"><span class="label label-info"><i class="fa fa-eye"></i></span>&nbsp; View/Edit</span></a></li>' .PHP_EOL;

                $output .= '<li><a href="' . $link_pay .'customer_id=' . $repair['customer_id'] . '&repair_id=' . $repair['repair_invoice_id'] . '"><span class="label label-success"><i class="fa fa-dollar"></i></span>&nbsp; Redeem</span></a></li>' .PHP_EOL;
                $output .= '</ul>' . PHP_EOL;
                $output .= '</div>' . PHP_EOL;
                $output .= '</td>' . PHP_EOL;
                $output .= '</tr>' . PHP_EOL;
            }

            $output .= '</tr>' . PHP_EOL;
            $output .= '</thead>' . PHP_EOL;
            $output .= '<tbody>' . PHP_EOL;
            $output .= '</tbody>' . PHP_EOL;
            $output .= '</table>' . PHP_EOL;

            $output .= '</li>' . PHP_EOL;



            $output .= '<li class="tab-pane fade in" id="refills">' . PHP_EOL;
            $output .= '<table class="table table-striped table-hover align-center">' . PHP_EOL;
            $output .= '<thead>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<th>Plan Name</th>' . PHP_EOL;
            $output .= '<th>Pin #</th>' . PHP_EOL;
            $output .= '<th>Phone #</th>' . PHP_EOL;
            $output .= '<th>Date</th>' . PHP_EOL;
            $output .= '<th>Action</th>' . PHP_EOL;
            $link = "view-refill.php?";

            foreach($refills as $row){

                $output .= '<tr>' . PHP_EOL;
                $output .= '<td>' . $row['plan_name'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['pin_no'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['cp_number'] . '</td>' . PHP_EOL;
                $output .= '<td>' . date('m/d/Y H:i:s', strtotime($row['date_added'])) . '</td>' . PHP_EOL;
                $output .= '<td><a href="' . $link .'customer_id=' . $row['customer_id'] . '&refill_id=' . $row['refill_id'] . '"><span class="label label-info "><i class="fa fa-eye"></i>View refill</span></a></td>' . PHP_EOL;

                $output .= '</tr>' . PHP_EOL;
            }

            $output .= '</tr>' . PHP_EOL;
            $output .= '</thead>' . PHP_EOL;
            $output .= '<tbody>' . PHP_EOL;
            $output .= '</tbody>' . PHP_EOL;
            $output .= '</table>' . PHP_EOL;

            $output .= '</li>' . PHP_EOL;


            $output .= '<li class="tab-pane fade in" id="rto">' . PHP_EOL;
            $output .= '<table class="table table-striped table-hover align-center">' . PHP_EOL;
            $output .= '<thead>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<th>Model #</th>' . PHP_EOL;
            $output .= '<th>Desc</th>' . PHP_EOL;
            $output .= '<th>Serial #</th>' . PHP_EOL;
            $output .= '<th>Total <br> # of <br> payments</th>' . PHP_EOL;
            $output .= '<th>Base <br> Rent</th>' . PHP_EOL;
            $output .= '<th>Sales <br> Tax</th>' . PHP_EOL;
            $output .= '<th>Total</th>' . PHP_EOL;
            $output .= '<th>Due <br> Date</th>' . PHP_EOL;
            $output .= '<th>Action</th>' . PHP_EOL;
            $link = "view-rto.php?";

            foreach($rto as $row){

                $output .= '<tr>' . PHP_EOL;
                $output .= '<td>' . $row['model_no'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['description'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['serial_no'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['total_no_of_payments'] . '</td>' . PHP_EOL;
                $output .= '<td>$' . number_format($row['amount_of_each_payment'], 2) . '</td>' . PHP_EOL;
                $output .= '<td>$' . number_format($row['sales_tax'], 2) . '</td>' . PHP_EOL;
                $output .= '<td>$' . number_format($row['amount_of_each_payment'] + $row['sales_tax'], 2) . '</td>' . PHP_EOL;
                $output .= '<td>' . date('m/d/Y', strtotime($row['due_date'])) . '</td>' . PHP_EOL;
                $output .= '<td><a href="' . $link .'customer_id=' . $row['customer_id'] . '&rto_id=' . $row['rto_id'] . '"><span class="label label-info "><i class="fa fa-dollar"></i> View RTO</span></a></td>' . PHP_EOL;


                $output .= '</tr>' . PHP_EOL;
            }

            $output .= '</tr>' . PHP_EOL;
            $output .= '</thead>' . PHP_EOL;
            $output .= '<tbody>' . PHP_EOL;
            $output .= '</tbody>' . PHP_EOL;
            $output .= '</table>' . PHP_EOL;

            $output .= '</li>' . PHP_EOL;


            $output .= '<li class="tab-pane fade in" id="purchases">' . PHP_EOL;
            $output .= '<table class="table table-striped table-hover align-center">' . PHP_EOL;
            $output .= '<thead>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<th>Item #</th>' . PHP_EOL;
            $output .= '<th>Desc</th>' . PHP_EOL;
            $output .= '<th>Cost</th>' . PHP_EOL;
            $output .= '<th>Quantity</th>' . PHP_EOL;

            $output .= '<th>Total</th>' . PHP_EOL;


            foreach($pos as $row){

                $output .= '<tr>' . PHP_EOL;
                $output .= '<td>' . $row['item_no'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['description'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['cost'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['qty'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['cost'] * $row['qty'] . '</td>' . PHP_EOL;
                $output .= '</tr>' . PHP_EOL;
            }

            $output .= '</tr>' . PHP_EOL;
            $output .= '</thead>' . PHP_EOL;
            $output .= '<tbody>' . PHP_EOL;
            $output .= '</tbody>' . PHP_EOL;
            $output .= '</table>' . PHP_EOL;

            $output .= '</li>' . PHP_EOL;
			
			
			
			$output .= '<li class="tab-pane fade" id="notes">' . PHP_EOL;

            $output .= '<table class="table table-striped table-hover align-center">' . PHP_EOL;
            $output .= '<thead>' . PHP_EOL;
            $output .= '<tr>' . PHP_EOL;
            $output .= '<th>Type</th>' . PHP_EOL;
            $output .= '<th>Note</th>' . PHP_EOL;

            $output .= '<th>Arrange Date</th>' . PHP_EOL;
   
            $output .= '</tr>' . PHP_EOL;
            $output .= '</thead>' . PHP_EOL;
            $output .= '<tbody>' . PHP_EOL;
            foreach($notes as $note) {
           
				if($note['type'] == 'loan_info_tbl'){
					$type = 'General Pawn';
				}
				else if($note['type'] == 'title_pawn_tbl'){
					$type = 'Title Pawn';
				}
                $output .= '<tr class="align-center">' . PHP_EOL;
               
     
                $output .= '<td>' . $type . '</td>' . PHP_EOL;
                $output .= '<td>' . $note['note'] . '</td>' . PHP_EOL;
                $output .= '<td>' . date('m/d/Y', strtotime($note['arranged_date'])) . '</td>' . PHP_EOL;
              

                $output .= '</tr>' . PHP_EOL;
            }
            $output .= '</tbody>' . PHP_EOL;
            $output .= '</table>' . PHP_EOL;

            $output .= '</li>' . PHP_EOL;


            $output .= '</ul>' . PHP_EOL;

            $output .= '</div>' . PHP_EOL;
            $output .= '<div id="tab-edit" class="tab-pane fade in">' . PHP_EOL;
            $output .= '<form action="update-customer-profile.php" method="post" class="form-horizontal"><h3>Personal Information</h3>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">First name</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><input type="text" value="' . $first_name . '" class="form-control" name="first_name"/></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Middle Name</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-2"><input type="text" value="' . $middle_name . '"  class="form-control" name="middle_name"/></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Last name</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><input type="text" value="' . $last_name . '" class="form-control" name="last_name"/></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<hr/>' . PHP_EOL;
            $output .= '<h3>Contact Information</h3>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Address</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><textarea class="form-control" rows="3" value="' . $address . '" name="address">' . $address . '</textarea> </div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">City</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><input type="text" value="' . $city . '"  class="form-control" name="city"/></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">State</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><select class="form-control" name="state">


														' . $this->displayState($state, $state_v) . '
													</select></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Zip Code</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' .  PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-4"><input type="text" value="' . $zip . '" class="form-control" name="zip" /></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Home #</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><input type="text" value="' . $home_no . '" class="form-control" name="home_no"/></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Cell #</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><input type="text" value="' . $cell_no . '" class="form-control" name="cell_no"/></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<hr/>' . PHP_EOL;
            $output .= '<h3>Documents</h3>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Drivers License #</label>' .PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><input type="text" value="' . $dl . '" class="form-control" name="dl_no" /></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Social Security #</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><input type="text" value="' . $sss_no . '" class="form-control" name="security_no"/></div>' .PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<hr/>' . PHP_EOL;
            $output .= '<h3>Characteristics</h3>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Height</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-4"><input type="number" value="' . $height . '" class="form-control" name="height"/></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Weight</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-4"><input type="number" value="' . $weight . '" class="form-control" name="weight"/></div>' .PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<div class="form-group"><label class="col-sm-3 control-label">Eye Color</label>' . PHP_EOL;
            $output .= '<div class="col-sm-9 controls">' . PHP_EOL;
            $output .= '<div class="row">' . PHP_EOL;
            $output .= '<div class="col-xs-9"><input type="text" value="' . $eye_color . '" class="form-control" name="eye_color"/></div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '<hr>' . PHP_EOL;
            $output .= '<td style="display: none;"><input type="hidden" value="' . $cid . '" name="cid"></td>' . PHP_EOL;
            $output .= '<input type="submit" name="submit" class="btn btn-primary btn-block" value="Finish">' . PHP_EOL;
            $output .= '</form>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;

        }

        return $output;

    }

    public function displayPastDuePawns($past_due) {

        $count = 0;
        $output = ' ';
        foreach ($past_due as $row)
        {
            $date1 = date('Y-m-d');

            $alert = '';
            $btn = '';

            $forfiet_days = $this->getForfietDays();
            foreach($forfiet_days as $value){
                $fd = $value['general_pawns'];
            }
            $date2 = date('Y-m-d', strtotime('-' . $fd . ' days'));
            if($row['due_date'] <= $date2){
                $alert = 'danger';
            }
            $output .= '<tr id="row_'.$count.'" class="' . $alert . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td id="loan_id_'.$count.'" style="display:none">' . $row['loan_info_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . $row['loan_amount'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['title'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['terms_of_loan'] . '</td>' . PHP_EOL;
                if($row['due_date'] == $date1 || $row['due_date'] < $date1)
                {
                    $output .= '<td><span class="label label-danger">' . date('m/d/Y', strtotime($row['due_date'])) . '</span></td>' . PHP_EOL;
                    if($row['due_date'] <= $date2){

                        $output .= '<td id="close_'.$count.'" ><span id="close_mark_'.$count.'" class="mark label label-danger pointer" style="cursor:pointer"><i class="fa fa-times"></i> Forfiet Pawn</span></td>' . PHP_EOL;

                    }else{
						$output .= '<td> </td>';
					}
                }
                else{
                    $output .= '<td><span class="label label-warning">' . $row['due_date'] . '</span></td>' . PHP_EOL;
                    
                }




            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;


    }

    public function displayPastDueTitlePawns($past_due_title) {

        $count = 0;
        $output = ' ';
        foreach ($past_due_title as $row)
        {
            $date1 = date('Y-m-d');
            $alert = '';
            $btn = '';

            $forfiet_days = $this->getForfietDays();
            foreach($forfiet_days as $value){
                $fd = $value['title_pawns'];
            }
            $date2 = date('Y-m-d', strtotime('-' . $fd . ' days'));
            if($row['due_date'] <= $date2){
                $alert = 'danger';
            }

            $output .= '<tr id="row_'.$count.'" class="' . $alert . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td style="display:none" id="title_id_'.$count.'">' . $row['tittle_pawn_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . $row['total_loan_amount'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['title'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['terms_of_loan'] . '</td>' . PHP_EOL;
            if($row['due_date'] == $date1 || $row['due_date'] < $date1)
            {

                $output .= '<td><span class="label label-danger">' . date('m/d/Y', strtotime($row['due_date'])) . '</span></td>' . PHP_EOL;
                if($row['due_date'] <= $date2){

                    $output .= '<td id="close_'.$count.'" ><span id="close_mark_'.$count.'" class="mark_title label label-danger pointer" style="cursor:pointer"><i class="fa fa-times"></i> Out for repo</span></td>' . PHP_EOL;

                }else{
					 $output .= '<td> </td>';
				}


            }
            else{
                $output .= '<td><span class="label label-warning">' . date('m/d/Y', strtotime($row['due_date'])) . '</span></td>' . PHP_EOL;
            }


            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;


    }
	
	public function displayPastDueTitlePawnsRepo($past_due_title) {

        $count = 0;
        $output = ' ';
        foreach ($past_due_title as $row)
        {
            $date1 = date('Y-m-d');
            $alert = '';
            $btn = '';

            $forfiet_days = $this->getForfietDays();
            foreach($forfiet_days as $value){
                $fd = $value['title_pawns'];
            }
            $date2 = date('Y-m-d', strtotime('-' . $fd . ' days'));
            if($row['due_date'] <= $date2){
                $alert = 'danger';
            }

            $output .= '<tr id="row_'.$count.'" class="' . $alert . '">' . PHP_EOL;
           $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['vin_no'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['year'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['model'] . '</td>' . PHP_EOL;
            $output .= '<td>'. PHP_EOL;
            $output .= '<div id="gallery">' . PHP_EOL;
            $image = $this->getTitlePawnImages($row['tittle_pawn_id']);
            foreach($image as $row){
                $blob = $row['title_image_name'];
                if( $blob != ''){


                    $output .= '<a  href="data:image/jpeg;base64,'.base64_encode( $blob ).'" rel="gallery" >' . $row['title_image_file'] . '</a><br>' . PHP_EOL;


                    //$output .= '<img width="50" height="50" src="data:image/jpeg;base64,'.base64_encode( $blob ).'"/>' . PHP_EOL;
                }

            }
            $output .= '</div>' . PHP_EOL;
            $output .= '</td>'. PHP_EOL;

 

            $output .= '<td>$' . number_format($row['total_loan_amount'], 2) . '</td>' . PHP_EOL;
            if($row['due_date'] == $date1 || $row['due_date'] < $date1)
            {

                $output .= '<td><span class="label label-danger">' . date('m/d/Y', strtotime($row['due_date'])) . '</span></td>' . PHP_EOL;
                if($row['due_date'] <= $date2){

                    //$output .= '<td id="close_'.$count.'" ><span id="close_mark_'.$count.'" class="mark_title label label-danger pointer" style="cursor:pointer"><i class="fa fa-times"></i> Out for repo</span></td>' . PHP_EOL;
					$output .= '<td><button id="btn_title_' . $count . '" data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '" data-vin="' . $row['vin_no'] . '" data-model="' . $row['model'] . '" data-year="' . $row['year'] . '" data-amount="$' . number_format($row['total_loan_amount'], 2) . '"  class="btn btn-info btn-xs" data-value="' . $row['tittle_pawn_id'] . '" data-toggle="modal" data-target="#title_pawn_modal" data-status="repoed" onClick="pushData(this)" >Out for Repo</button></td>' . PHP_EOL;
                }else{
					 $output .= '<td> </td>'; 
				}


            }
            else{
                $output .= '<td><span class="label label-warning">' . date('m/d/Y', strtotime($row['due_date'])) . '</span></td>' . PHP_EOL;
            }


            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;


    }
	
	public function displayPastDuePawnsCol($past_due) {

        $count = 0;
        $output = ' ';
		
        foreach ($past_due as $row)
        {
            $date1 = date('Y-m-d');

            $alert = '';
            $btn = '';

            $forfiet_days = $this->getForfietDays();
            $item_desc = $this->getCustomerPawnedItems($row['customer_id'], $row['loan_info_id']);
            foreach($forfiet_days as $value){
                $fd = $value['general_pawns'];
            }
            $date2 = date('Y-m-d', strtotime('-' . $fd . ' days'));
            if($row['due_date'] <= $date2){
                $alert = 'danger';
            }



            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }
			
			
			if($row['status'] == 'collection'){
				$attempt_status = $this-> getCollectionAttemptById($row['loan_info_id']);
				if($attempt_status < $date1){
					
            $output .= '<tr id="row_'.$count.'" class="' . $alert . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td id="loan_id_'.$count.'" style="display:none">' . $row['loan_info_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' <span class="label label-danger"><i class="fa fa-thumbs-down"></i></span></td>' . PHP_EOL;

                    $output .= '<td>' . PHP_EOL;
                        foreach($item_desc as $item_description){
                            $output .= $item_description['item_description'] . '<br>' . PHP_EOL;
                        }
                    $output .= '</td>' . PHP_EOL;
			$output .= '<td>$' . number_format($row['loan_amount'], 2) . '</td>' . PHP_EOL;

            $output .= '<td>$' . number_format($row['total_loan'], 2) . '</td>' . PHP_EOL;
			$output .= '<td>' . date('m/d/Y', strtotime($row['due_date'])). '</td>' . PHP_EOL;
			$output .= '<td>' . PHP_EOL;
			
					 $items = $this->getCustomerPawnedItemsPop($row['customer_id'], $row['loan_info_id']);
                     $v = array_map('array_pop' , $items);
                     $x = implode(', ', $v);
                    $output .= '<div class="btn-group">' . PHP_EOL;
                    $output .= '<button type="button" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action' . PHP_EOL;
                    $output .= '&nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
                    $output .= '<ul role="menu" class="dropdown-menu">' . PHP_EOL;
                   
				   
                    if($row['due_date'] == $date1 || $row['due_date'] < $date1)
					{
						if($row['due_date'] <= $date2){

							$output .= '<li><a href="#" 
								data-id="' . $row['loan_info_id'] . '" 
								data-cid="' . $row['customer_id'] . '"
								data-type="general"
								data-action="forfiet"
								data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
								data-home-no="' . $row['home_no'] . '"
								data-cell-no="' . $row['cell_no'] . '"
								data-address="' . $row['address'] . '"
								data-city="' . $row['city'] . '"
								data-state="' . $row['state'] . '"
								data-zip="' . $row['zip'] . '"
								data-customer-photo="'.base64_encode( $row['customer_photo'] ).'"
								data-items="' . $x . '"
								data-due="' . number_format($row['total_loan'], 2) . '"
								data-toggle="modal" 
								data-target="#modalGeneralForfiet"
								onClick="pushData(this)">
								<span class="label label-danger"><i class="fa fa-times"></i></span>&nbsp; Forfiet Pawn</span></a></li>' . PHP_EOL;
						}
					}
					$output .= '</ul>' . PHP_EOL;
                    $output .= '</div>' . PHP_EOL;
            $output .= '</td>' . PHP_EOL;

            $output .= '</tr>' . PHP_EOL;
				}
			}else if($row['status'] == 'active'){
				
				$output .= '<tr id="row_'.$count.'" class="' . $alert . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td id="loan_id_'.$count.'" style="display:none">' . $row['loan_info_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
                $output .= '<td>' . PHP_EOL;
                foreach($item_desc as $item_description){
                    $output .= $item_description['item_description'] . '<br>' . PHP_EOL;
                }
                $output .= '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['loan_amount'], 2) . '</td>' . PHP_EOL;

            $output .= '<td>$' . number_format($row['total_loan'], 2) . '</td>' . PHP_EOL;
			$output .= '<td>' . date('m/d/Y', strtotime($row['due_date'])). '</td>' . PHP_EOL;
			$output .= '<td>' . PHP_EOL;
			
					 $items = $this->getCustomerPawnedItemsPop($row['customer_id'], $row['loan_info_id']);
                     $v = array_map('array_pop' , $items);
                     $x = implode(', ', $v);
                    $output .= '<div class="btn-group">' . PHP_EOL;
                    $output .= '<button type="button" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action' . PHP_EOL;
                    $output .= '&nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
                    $output .= '<ul role="menu" class="dropdown-menu">' . PHP_EOL;
                    $output .= '<li><a href="#" 
								data-id="' . $row['loan_info_id'] . '" 
								data-cid="' . $row['customer_id'] . '"
								data-type="general"
								data-action="attempt"
								data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
								data-home-no="' . $row['home_no'] . '"
								data-cell-no="' . $row['cell_no'] . '"
								data-address="' . $row['address'] . '"
								data-city="' . $row['city'] . '"
								data-state="' . $row['state'] . '"
								data-zip="' . $row['zip'] . '"
								data-customer-photo="'.base64_encode( $row['customer_photo'] ).'"
								data-items="' . $x . '"
								data-due="' . number_format($row['total_loan'], 2) . '"
								data-toggle="modal" 
								data-target="#modalGeneral" 
								onClick="pushData(this)">
								<span class="label label-info"><i class="icon icon-social-dropbox"></i></span>&nbsp; Attempt Collection</span></a></li>' . PHP_EOL;
                     if($row['due_date'] == $date1 || $row['due_date'] < $date1)
					{
						if($row['due_date'] <= $date2){
							$output .= '<li><a href="#" 
								data-id="' . $row['loan_info_id'] . '" 
								
								data-cid="' . $row['customer_id'] . '"
								data-type="general"
								data-action="forfiet"
								data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
								data-home-no="' . $row['home_no'] . '"
								data-cell-no="' . $row['cell_no'] . '"
								data-address="' . $row['address'] . '"
								data-city="' . $row['city'] . '"
								data-state="' . $row['state'] . '"
								data-zip="' . $row['zip'] . '"
								data-customer-photo="'.base64_encode( $row['customer_photo'] ).'"
								data-items="' . $x . '"
								data-due="' . number_format($row['total_loan'], 2) . '"
								data-toggle="modal" 
								data-target="#modalGeneralForfiet"
								onClick="pushData(this)">
								<span class="label label-danger"><i class="fa fa-times"></i></span>&nbsp; Forfiet Pawn</span></a></li>' . PHP_EOL;
						}
					}
					$output .= '</ul>' . PHP_EOL;
                    $output .= '</div>' . PHP_EOL;
            $output .= '</td>' . PHP_EOL;

            $output .= '</tr>' . PHP_EOL;
				
			}
			
			

            $count++;

        }
        return $output;


    }

    public function displayPastDueTitlePawnsCol($past_due_title) {

        $count = 0;
        $output = ' ';
        foreach ($past_due_title as $row)
        {
            $date1 = date('Y-m-d');
            $alert = '';
            $btn = '';

            $forfiet_days = $this->getForfietDays();
            foreach($forfiet_days as $value){
                $fd = $value['title_pawns'];
            }
            $date2 = date('Y-m-d', strtotime('-' . $fd . ' days'));
            if($row['due_date'] <= $date2){
                $alert = 'danger';
            }

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }
			
			if($row['status'] == 'collection'){
			$attempt_status = $this-> getCollectionAttemptById($row['tittle_pawn_id']);
				if($attempt_status < $date1){
					
					 $output .= '<tr id="row_'.$count.'" class="' . $alert . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td style="display:none" id="title_id_'.$count.'">' . $row['tittle_pawn_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' <span class="label label-danger"></span>arrangement break*</span></a></td>' . PHP_EOL;
                    $output .= '<td>' . $row['make'] . ' ' . $row['style'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['total_loan_amount'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['total_loan'], 2) . '</td>' . PHP_EOL;
			$output .= '<td>' . date('m/d/Y', strtotime($row['due_date'])). '</td>' . PHP_EOL;
            $output .= '<td>' . PHP_EOL;

                    $output .= '<div class="btn-group">' . PHP_EOL;
                    $output .= '<button type="button" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action' . PHP_EOL;
                    $output .= '&nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
                    $output .= '<ul role="menu" class="dropdown-menu">' . PHP_EOL;
                  
                     if($row['due_date'] == $date1 || $row['due_date'] < $date1)
					{
						if($row['due_date'] <= $date2){
							$output .= '<li><a href="#" 
								data-id="' . $row['tittle_pawn_id'] . '" 
								data-cid="' . $row['customer_id'] . '"
								data-type="title_pawn"
								data-action="forfiet"
								data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
								data-home-no="' . $row['home_no'] . '"
								data-cell-no="' . $row['cell_no'] . '"
								data-address="' . $row['address'] . '"
								data-city="' . $row['city'] . '"
								data-state="' . $row['state'] . '"
								data-zip="' . $row['zip'] . '"
								data-customer-photo="'.base64_encode( $row['customer_photo'] ).'"
								data-vin="' . $row['vin_no'] . '"
								data-year="' . $row['year'] . '"
								data-model="' . $row['model'] . '"
								data-due="' . number_format($row['total_loan'], 2) . '"
								data-toggle="modal" 
								data-target="#modalTitleForfiet"
								onClick="pushData(this)">
								<span class="label label-danger"><i class="fa fa-times"></i></span>&nbsp; Add to Repo</span></a></li>' . PHP_EOL;
						}
					}
					$output .= '</ul>' . PHP_EOL;
                    $output .= '</div>' . PHP_EOL;
            


            $output .= '</tr>' . PHP_EOL;
					
				}
			}
			else if($row['status'] == 'active'){
				
			
            $output .= '<tr id="row_'.$count.'" class="' . $alert . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td style="display:none" id="title_id_'.$count.'">' . $row['tittle_pawn_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['make'] . ' ' . $row['style'] . '</td>' . PHP_EOL;
                $output .= '<td>$' . number_format($row['total_loan_amount'], 2) . '</td>' . PHP_EOL;
                $output .= '<td>$' . number_format($row['total_loan'], 2) . '</td>' . PHP_EOL;
			$output .= '<td>' . date('m/d/Y', strtotime($row['due_date'])). '</td>' . PHP_EOL;
            $output .= '<td>' . PHP_EOL;

                    $output .= '<div class="btn-group">' . PHP_EOL;
                    $output .= '<button type="button" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action' . PHP_EOL;
                    $output .= '&nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
                    $output .= '<ul role="menu" class="dropdown-menu">' . PHP_EOL;
                    $output .= '<li><a href="#" 
								data-id="' . $row['tittle_pawn_id'] . '" 
								data-cid="' . $row['customer_id'] . '"
								data-type="title_pawn"
								data-action="attempt"
								data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
								data-home-no="' . $row['home_no'] . '"
								data-cell-no="' . $row['cell_no'] . '"
								data-address="' . $row['address'] . '"
								data-city="' . $row['city'] . '"
								data-state="' . $row['state'] . '"
								data-zip="' . $row['zip'] . '"
								data-customer-photo="'.base64_encode( $row['customer_photo'] ).'"
								data-vin="' . $row['vin_no'] . '"
								data-year="' . $row['year'] . '"
								data-model="' . $row['model'] . '"
								data-due="' . number_format($row['total_loan'], 2) . '"
								data-toggle="modal" 
								data-target="#modalTitlePawn" 
								onClick="pushData(this)">
								<span class="label label-info"><i class="icon icon-social-dropbox"></i></span>&nbsp; Attempt Collection</span></a></li>' . PHP_EOL;
                     if($row['due_date'] == $date1 || $row['due_date'] < $date1)
					{
						if($row['due_date'] <= $date2){
							$output .= '<li><a href="#" 
								data-id="' . $row['tittle_pawn_id'] . '" 
								data-cid="' . $row['customer_id'] . '"
								data-type="title_pawn"
								data-action="forfiet"
								data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '"
								data-home-no="' . $row['home_no'] . '"
								data-cell-no="' . $row['cell_no'] . '"
								data-address="' . $row['address'] . '"
								data-city="' . $row['city'] . '"
								data-state="' . $row['state'] . '"
								data-zip="' . $row['zip'] . '"
								data-customer-photo="'.base64_encode( $row['customer_photo'] ).'"
								data-vin="' . $row['vin_no'] . '"
								data-year="' . $row['year'] . '"
								data-model="' . $row['model'] . '"
								data-due="' . number_format($row['total_loan'], 2) . '"
								data-toggle="modal" 
								data-target="#modalTitleForfiet"
								onClick="pushData(this)">
								<span class="label label-danger"><i class="fa fa-times"></i></span>&nbsp; Add to Repo</span></a></li>' . PHP_EOL;
						}
					}
					$output .= '</ul>' . PHP_EOL;
                    $output .= '</div>' . PHP_EOL;
            


            $output .= '</tr>' . PHP_EOL;
			}

            $count++;

        }
        return $output;


    }


    public function displayAddedParts($item) {

        $count = 0;
        $output = ' ';

        foreach ($item as $row)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }
            $output .= '<tr id="row_'.$count.'" class="' . $class . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['description'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['cost'],2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['retail'],2) . '</td>' . PHP_EOL;

            $output .= '<td id="quantity_'.$count.'" class="quantity">' . $row['quantity'] . '</td>' . PHP_EOL;
            $output .= '<td id="hidden" class="amount">' . $row['cost'] * $row['quantity'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['cost'] * $row['quantity'],2) . '</td>' . PHP_EOL;
            $output .= '<td><button id="parts_id_'.$count.'" value="' . $row['parts_id'] . '" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;


    }



    public function displayOpenRepairOrders($openRepairOrders){



    $count = 0;
    $output = ' ';
        $link = "edit-repair-orders.php?";
        $link_pay = "redeem-repair-orders.php?";
    foreach ($openRepairOrders as $row)
    {
        if($row['repair_status'] == 'in_progress') {$s = 'In Progress';}
        if($row['repair_status'] == 'awaiting_parts') {$s = 'Awaiting Parts';}
        if($row['repair_status'] == 'fixed') {$s = 'Fixed A.C.P.';}
        if($row['repair_status'] == 'completed') {$s = 'Completed';}

        if ($count % 2 == 0) {

            $class = 'even';
        }

        else {
            $class = 'odd';
        }
        $output .= '<tr id="row_'.$count.'" class="' . $class . '">' . PHP_EOL;
        $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
        $output .= '<td id="repair_id_'.$count.'" style="display:none">' . $row['repair_invoice_id'] . '</td>' . PHP_EOL;
        $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
        $output .= '<td>' . $row['repair_item_description'] . '</td>' . PHP_EOL;
        $output .= '<td>' . $row['repair_serial_number'] . '</td>' . PHP_EOL;
        $output .= '<td>' . $s . '</td>' . PHP_EOL;


        $output .= '<td>' . PHP_EOL;
        $output .= '<div class="btn-group">' . PHP_EOL;
        $output .= '<button type="button" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true" class="btn btn-primary btn-xs dropdown-toggle">Action &nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
        $output .= '<ul class="dropdown-menu">' . PHP_EOL;
        $output .= '<li><a href="' . $link .'customer_id=' . $row['customer_id'] . '&repair_id=' . $row['repair_invoice_id'] . '"><span class="label label-info"><i class="fa fa-eye"></i></span>&nbsp; View/Edit</span></a></li>' .PHP_EOL;

        $output .= '<li><a href="' . $link_pay .'customer_id=' . $row['customer_id'] . '&repair_id=' . $row['repair_invoice_id'] . '"><span class="label label-success"><i class="fa fa-dollar"></i></span>&nbsp; Redeem</span></a></li>' .PHP_EOL;
        $output .= '</ul>' . PHP_EOL;
        $output .= '</div>' . PHP_EOL;
        $output .= '</td>' . PHP_EOL;
    //    $output .= '<td><a href="' . $link .'customer_id=' . $row['customer_id'] . '&repair_id=' . $row['repair_invoice_id'] . '"><span id="edit_mark_'.$count.'" class="mark_title label label-blue pointer" style="cursor:pointer"><i class="fa fa-eye"></i> View/Edit</span></a></td>' . PHP_EOL;
        $output .= '</tr>' . PHP_EOL;

        $count++;

    }
    return $output;

    }

    public function displayClosedRepairOrders($openRepairOrders){



        $count = 0;
        $output = ' ';
        $link = "view-repair-orders.php?";
        foreach ($openRepairOrders as $row)
        {

            if($row['repair_status'] == 'in_progress') {$s = 'In Progress';}
            if($row['repair_status'] == 'awaiting_parts') {$s = 'Awaiting Parts';}
            if($row['repair_status'] == 'fixed') {$s = 'Fixed A.C.P.';}
            if($row['repair_status'] == 'completed') {$s = 'Completed';}
            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }
            $output .= '<tr id="row_'.$count.'" class="' . $class . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td id="repair_id_'.$count.'" style="display:none">' . $row['repair_invoice_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['repair_item_description'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['repair_serial_number'] . '</td>' . PHP_EOL;
            $output .= '<td><a href="' . $link .'customer_id=' . $row['customer_id'] . '&repair_id=' . $row['repair_invoice_id'] . '"><span class="label label-info "><i class="fa fa-eye"></i>View Repair</span></a></td>' . PHP_EOL;

            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;


    }



    public function displayCustomerRTO($rto){


        $count = 0;
        $output = ' ';
        $link = "view-rto.php?";
        foreach ($rto as $row)
        {

                if ($count % 2 == 0) {

                    $class = 'even';
                }

                else {
                    $class = 'odd';
                }



                $output .= '<tr id="row_'.$count.'" class="sum ' . $class . '">' . PHP_EOL;
                $output .= '<td style="display:none">' . $count . '</td>';




                $output .= '<td>' . $row['model_no'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['description'] . '</td>' . PHP_EOL;
                $output .= '<td>' . $row['serial_no'] . '</td>' . PHP_EOL;

                $output .= '<td>$' .  number_format($row['amount_of_each_payment'], 2) . '</td>' . PHP_EOL;
                $output .= '<td>' . date("m/d/Y", strtotime($row['due_date'])) . '</td>' . PHP_EOL;
                $output .= '<td><a href="' . $link .'customer_id=' . $row['customer_id'] . '&rto_id=' . $row['rto_id'] . '"><span class="label label-info "><i class="fa fa-dollar"></i> View/Take Payment</span></a></td>' . PHP_EOL;

                $output .= '</tr>' . PHP_EOL;



                $count++;


            }
        return $output;
    }



    public function displayGeneralPawns($pawns)
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


            $output .= '<td>' . PHP_EOL;

            $customer_id = $pawn['customer_id'];
            $loan_id = $pawn['loan_info_id'];

            $items = $this->getCustomerPawnedItems($customer_id, $loan_id);
            $arrItems = array();
            foreach($items as $item){
                $arrItems[] = $item['item_description'];
            }
            $itemDisplay = implode(', ', $arrItems);
            $output .= $itemDisplay;
            $output .= '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['title'] . '</td>' . PHP_EOL;

            $output .= '<td>$' . number_format($pawn['loan_amount'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>' . date('m/d/Y', strtotime($pawn['date_added'])) . '</td>' . PHP_EOL;
			$output .= '<td><a href="view-customer-pawns.php?customer_id=' . $pawn['customer_id'] . '&pawn_id=' . $pawn['loan_info_id'] . '"><span class="label label-info "><i class="fa fa-eye"></i>View Pawn</span></a></td>' . PHP_EOL;




            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }




    public function displayTitlePawns($pawns)
    {
        $count = 0;
        $output = ' ';
        foreach ($pawns as $pawn)
        {
            $id = $pawn['tittle_pawn_id'];

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
            $output .= '<td>'. PHP_EOL;
            $output .= '<div id="gallery">' . PHP_EOL;
                $image = $this->getTitlePawnImages($id);
            foreach($image as $row){
                $blob = $row['title_image_name'];
                if( $blob != ''){


                    $output .= '<a  href="data:image/jpeg;base64,'.base64_encode( $blob ).'" rel="gallery" >' . $row['title_image_file'] . '</a><br>' . PHP_EOL;


                        //$output .= '<img width="50" height="50" src="data:image/jpeg;base64,'.base64_encode( $blob ).'"/>' . PHP_EOL;
                }

            }
            $output .= '</div>' . PHP_EOL;
            $output .= '</td>'. PHP_EOL;
            $output .= '<td>' . $pawn['customer_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['title'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($pawn['retail'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($pawn['total_loan_amount'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>' . date('m/d/Y', strtotime($pawn['date_added'])) . '</td>' . PHP_EOL;
			$output .= '<td><a href="view-customer-title-pawns.php?customer_id=' . $pawn['customer_id'] . '&pawn_id=' . $pawn['tittle_pawn_id'] . '"><span class="label label-info "><i class="fa fa-eye"></i>View Pawn</span></a></td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }


    public function displayUnredeemedTitledPawns($pawns)
    {
        $count = 0;
        $output = ' ';
        foreach ($pawns as $pawn)
        {
            $id = $pawn['tittle_pawn_id'];

            if ($pawn['status'] == 'repoed') {

                if(date("Y-m-d" , strtotime($pawn['date_repoed']. "+10 days")) <= date("Y-m-d")){
                    $class = 'danger';
                }
                else{
                    $class = 'warning';
                }

            }


            else {
                $class = '';
            }

            $output .= '<tr class="' . $class . '">' . PHP_EOL;
            $output .= '<td>' . $pawn['first_name'] . ' ' . $pawn['middle_name'] . ' ' . $pawn['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['vin_no'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['year'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $pawn['model'] . '</td>' . PHP_EOL;
            $output .= '<td>'. PHP_EOL;
            $output .= '<div id="gallery">' . PHP_EOL;
            $image = $this->getTitlePawnImages($id);
            foreach($image as $row){
                $blob = $row['title_image_name'];
                if( $blob != ''){


                    $output .= '<a  href="data:image/jpeg;base64,'.base64_encode( $blob ).'" rel="gallery" >' . $row['title_image_file'] . '</a><br>' . PHP_EOL;


                    //$output .= '<img width="50" height="50" src="data:image/jpeg;base64,'.base64_encode( $blob ).'"/>' . PHP_EOL;
                }

            }
            $output .= '</div>' . PHP_EOL;
            $output .= '</td>'. PHP_EOL;

 

            $output .= '<td>$' . number_format($pawn['total_loan_amount'], 2) . '</td>' . PHP_EOL;
            if($pawn['status'] == 'unredeemed'){
                $output .= '<td><button id="btn_title_' . $count . '" data-customer="' . $pawn['first_name'] . ' ' . $pawn['middle_name'] . ' ' . $pawn['last_name'] . '" data-vin="' . $pawn['vin_no'] . '" data-model="' . $pawn['model'] . '" data-year="' . $pawn['year'] . '" data-amount="$' . number_format($pawn['total_loan_amount'], 2) . '"  class="btn btn-info btn-xs" data-value="' . $pawn['tittle_pawn_id'] . '" data-toggle="modal" data-target="#title_pawn_modal" data-status="repoed" onClick="pushData(this)" >Mark as Repoed</button></td>' . PHP_EOL;

            }

            else{
                if(date("Y-m-d" , strtotime($pawn['date_repoed']. "+10 days")) <= date("Y-m-d")){
                    $output .= '<td><button id="btn_title_' . $count . '" data-customer="' . $pawn['first_name'] . ' ' . $pawn['middle_name'] . ' ' . $pawn['last_name'] . '" data-vin="' . $pawn['vin_no'] . '" data-model="' . $pawn['model'] . '" data-year="' . $pawn['year'] . '" data-amount="$' . number_format($pawn['total_loan_amount'], 2) . '"  class="btn btn-info btn-xs" data-value="' . $pawn['tittle_pawn_id'] . '" data-toggle="modal" data-target="#title_pawn_modal" data-status="sell" onClick="pushData(this)" >Move To Inventory</button></td>' . PHP_EOL;

                }
                else{
                    $output .= '<td>On <span class="label label-warning">' . date("m/d/Y" , strtotime($pawn['date_repoed']. "+10 days")) . '</span> this item will be available for selling</td>' . PHP_EOL;

                }
            }
             $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }



    public function displayVehicleInventory($vehicle)
    {
        $count = 1;
        $output = ' ';
        foreach ($vehicle as $row)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }
            $output .= '<tr id="row_'.$count.'" class="' . $class . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>';
            $output .= '<td style="display:none" id="cid_'.$count.'"><input type="hidden" name="customerId[]" value="0"></td>' . PHP_EOL;
            $output .= '<td id="item_no_'.$count.'">' . $row['vin_no'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['year'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['model'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['color'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['mileage'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['no_of_doors'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['vehicle_condition'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['title_no'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['tag_no'] . '</td>' . PHP_EOL;

            $output .= '<td style="display:none" id="cost_'.$count.'">' . $row['cost'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . $row['cost'] . '</td>' . PHP_EOL;

            $output .= '<td id="count_'.$count.'" style="display:none">1</td>' . PHP_EOL;
            $output .= '<td style="display:none" id="checkbox_price_'.$count.'">' . $row['cost'] . '</td>' . PHP_EOL;
            //	$output .= '<td><input id="list" class="amount" data-price="' . $row['cost'] . '" tabindex="5" type="checkbox" name="choice[]" value="' . $row['item_no'] . '" onChange="updateTotal(this);" /></td>' . PHP_EOL;

            $output .= '<td id="checkbox_'.$count.'" class="table-input"><input style="display: inline;" id="list" class="amount" data-count="1" data-price="' . $row['cost'] . '" tabindex="5" type="checkbox" name="choice[]" value="' . $row['vi_id'] . '" data-toggle="tooltip" data-toggle="tooltip" data-placement="left" title="Check to select item"></td>' . PHP_EOL;
            $output .= '<td style="display: none;" id="quantity_'.$count.'"><input style="width: 60px;" class="form-control" type="text" value="1" name="quantity[]"></td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

            $count++;
        }
        return $output;
    }





    public function displayPettyCashLedger($ledger)
    {

        $output = ' ';
        foreach ($ledger as $row)
        {
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td style="display: none;">' . $row['petty_cash_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['description'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['amount']) . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['type'] . '</td>' . PHP_EOL;
            $output .= '<td>' . PHP_EOL;
            $output .= '<div id="gallery">' . PHP_EOL;
                if($row['image'] != ''){
                    $output .= '<a  href="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" rel="gallery" >' . $row['image_name'] . '</a><br>' . PHP_EOL;
                }
            $output .= '</div>' . PHP_EOL;
            $output .= '</td>' . PHP_EOL;

            $output .= '<td>' . date('m/d/Y' ,strtotime($row['date_added'])) . '</td>' . PHP_EOL;

            $output .= '</tr>' . PHP_EOL;


        }
        return $output;
    }



    public function displayScrapAddedItemTmp($item) {

        $count = 0;
        $output = ' ';
        foreach ($item as $row)
        {

            if ($count % 2 == 0) {

                $class = 'even';
            }

            else {
                $class = 'odd';
            }
            $output .= '<tr id="row_'.$count.'" class="' . $class . '">' . PHP_EOL;
            $output .= '<td style="display:none">' . $count . '</td>' . PHP_EOL;
            $output .= '<td id="description_'.$count.'">' . $row['description'] . '</td>' . PHP_EOL;
            $output .= '<td id="serial_'.$count.'">' . $row['weight'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['retail'], 2) . '</td>' . PHP_EOL;

            $output .= '<td style="display:none" id="amount_'.$count.'" class="amount">' . $row['retail'] . '</td>' . PHP_EOL;

            $output .= '<td><button id="item_id_'.$count.'" value="' . $row['si_id'] . '" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;


    }


    public function displayScrapInventory($item, $status) {


        $output = ' ';
        $date = date('Y-m-d');
        $holding_days = $this->getScrapDaysOnHold();
        foreach($holding_days as $days){
            $day = $days['days'];
        }

        foreach ($item as $row)
        {
            $unhold_day = date('Y-m-d', strtotime($row['date_added']. ' + ' . $day . ' days'));

            $output .= '<tr>' . PHP_EOL;

            $output .= '<td>' . $row['description'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['weight'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['retail'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>' . date("m/d/Y", strtotime($row['date_added'])) . '</td>' . PHP_EOL;
            if ($status == 'hold'){

                if($date >= $unhold_day){
                    $output .= '<td>' . PHP_EOL;
                    $output .= '<div class="btn-group">' . PHP_EOL;
                    $output .= '<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs">Move to' . PHP_EOL;
                    $output .= '&nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
                    $output .= '<ul role="menu" class="dropdown-menu">' . PHP_EOL;
                    $output .= '<li><a href="#" data-id="' . $row['si_id'] . '" data-description="' . $row['description'] . '" data-weight="' . $row['weight'] . '" data-amount="' . $row['retail'] . '" data-date="' . date("m/d/Y", strtotime($row['date_added'])) . '" data-status="inventory" data-toggle="modal" data-target="#modal" onClick="pushData(this)"><span class="label label-info"><i class="fa fa-database"></i></span>&nbsp; Inventory</span></a></li>' . PHP_EOL;
                    $output .= '<li><a href="#" data-id="' . $row['si_id'] . '" data-description="' . $row['description'] . '" data-weight="' . $row['weight'] . '" data-amount="' . $row['retail'] . '" data-date="' . date("m/d/Y", strtotime($row['date_added'])) . '" data-status="melting" data-toggle="modal" data-target="#modal" onClick="pushData(this)"><span class="label label-danger"><i class="icon icon-fire"></i></span>&nbsp; Melting</span></a></li>' . PHP_EOL;
                    $output .= '</ul>' . PHP_EOL;
                    $output .= '</div>' . PHP_EOL;
                    $output .= '</td>' . PHP_EOL;
                }
                else{
                    $output .= '<td><i>On Hold...</i></td>' . PHP_EOL;

                }


            }
            $output .= '</tr>' . PHP_EOL;



        }
        return $output;


    }



    public function displayCheckRegister($check_registers){


        $count = 0;
        $output = ' ';

        foreach ($check_registers as $row)
        {


            $output .= '<tr id="row_'.$count.'">' . PHP_EOL;
            $output .= '<td>' . date("m/d/Y", strtotime($row['date_added'])) . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['check_id'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['memo'] . '</td>' . PHP_EOL;

            $output .= '<td>$' .  number_format($row['amount'], 2) . '</td>' . PHP_EOL;

            $output .= '<td>' . PHP_EOL;
            $output .= '<div class="btn-group">' . PHP_EOL;
            $output .= '<button type="button" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action' . PHP_EOL;
            $output .= '&nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
            $output .= '<ul role="menu" class="dropdown-menu">' . PHP_EOL;
            $output .= '<li><a href="FPDM/check-voucher.php?transaction_id=' . $row['check_id'] .'" data-id="' . $row['check_id'] . '" ><span class="label label-info"><i class="fa fa-list-alt fa-fw"></i></span>&nbsp; Reprint Check</span></a></li>' . PHP_EOL;
            $output .= '</ul>' . PHP_EOL;
            $output .= '</div>' . PHP_EOL;
            $output .= '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;



            $count++;


        }
        return $output;
    }



    public function displayRTOAgreements($rto) {


        $output = ' ';
        foreach ($rto as $row)
        {


            $output .= '<tr>' . PHP_EOL;

            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['payment_term'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['model_no'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['description'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['item_condition'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['downpayment'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['total_no_of_payments'] . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['amount_of_each_payment'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['other_charges'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>$' . number_format($row['cash_price'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>' . date('m/d/Y', strtotime($row['due_date'])) . '</td>' . PHP_EOL;
			$output .= '<td>' . PHP_EOL;
				$link = 'print-rto?';
				$link_details = 'view-rto-details?';
                $output .= '<div class="btn-group">' . PHP_EOL;
                $output .= '<button type="button" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true" class="btn btn-primary btn-xs dropdown-toggle">Action &nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
                $output .= '<ul class="dropdown-menu">' . PHP_EOL;
                $output .= '<li><a href="' . $link .'customer_id=' . $row['customer_id'] . '&rto_id=' . $row['rto_id'] . '"><span class="label label-info"><i class="fa fa-eye"></i></span>&nbsp; View Contract</span></a></li>' .PHP_EOL;

                $output .= '<li><a href="' . $link_details .'customer_id=' . $row['customer_id'] . '&rto_id=' . $row['rto_id'] . '"><span class="label label-success"><i class="fa fa-list"></i></span>&nbsp; Details</span></a></li>' .PHP_EOL;
                $output .= '</ul>' . PHP_EOL;
                $output .= '</div>' . PHP_EOL;
                $output .= '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;



        }
        return $output;


    }


    public function displayUserAttendance($attendance) {


        $output = ' ';
        $curDate = time();
        $date = date('Y-m-d');
        foreach ($attendance as $row)
        {
            $time_in = date('H:i', $row['time_in']);
            if($row['time_out'] == '0' || $row['time_out'] == ' '){
                $time_out = '';
                $contest_timeout = $curDate;
            }else{
                $time_out = date('H:i', $row['time_out']);

                $contest_timeout = $row['time_out'];
            }

            $total_hours = $this->convertUnix($contest_timeout - $row['time_in']);
            if($row['date'] == $date){
                $display_date = 'Today';
            }else{
                $display_date = date('m/d/Y' , strtotime($row['date']));
            }


            $output .= '<tr>' . PHP_EOL;

            $output .= '<td>' . $row['aid'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $display_date . '</td>' . PHP_EOL;
            $output .= '<td>' . $time_in . '</td>' . PHP_EOL;
            $output .= '<td>' . $time_out . '</td>' . PHP_EOL;
            $output .= '<td>' . $total_hours . '</td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;



        }
        return $output;


    }
	
	public function displayLayaway($layaway, $status)
    {
       
        $output = ' ';
        foreach ($layaway as $row)
        {

          
            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>' . PHP_EOL;
            $output .= '<td>' . PHP_EOL;
            $customer_id = $row['customer_id'];
            $lid = $row['lid'];
            $items = $this->getCustomerLayawayItems($customer_id, $lid);
            $arrItems = array();
            foreach($items as $item){
                $arrItems[] = $item['description'];
            }
            $itemDisplay = implode(', ', $arrItems);
            $output .= $itemDisplay;
            $output .= '</td>' . PHP_EOL;
     
            $output .= '<td>$' . number_format($row['fixed_total'], 2) . '</td>' . PHP_EOL;
            $output .= '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>' . PHP_EOL;


			 $output .= '<td>' . PHP_EOL;
             $output .= '<div class="btn-group">' . PHP_EOL;
             $output .= '<button type="button" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true" class="btn btn-primary btn-xs dropdown-toggle">Action &nbsp;<i class="fa fa-angle-down"></i></button>' . PHP_EOL;
             $output .= '<ul class="dropdown-menu">' . PHP_EOL;
                if($status == 'active'){
                    $output .= '<li><a href="print-layaway-agreement?customer_id=' . $row['customer_id'] . '&layaway_id=' . $row['lid'] . '"><span class="label label-info"><i class="fa fa-eye"></i></span>&nbsp; View Contract</span></a></li>' .PHP_EOL;

                    $output .= '<li><a href="print-layaway-agreement?customer_id=' . $row['customer_id'] . '&layaway_id=' . $row['lid'] . '"><span class="label label-success"><i class="fa fa-list"></i></span>&nbsp; Details</span></a></li>' .PHP_EOL;
                }else{
                    $output .= '<li><a href="#" style="cursor: pointer;" data-customer="' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '" data-customerId="' . $row['customer_id'] . '" data-lid="' . $row['lid'] . '" onClick="pushData(this)" data-toggle="modal" data-target="#modal"><span class="label label-danger"><i class="fa fa-times"></i></span>&nbsp; Cancel</span></a></li>' .PHP_EOL;
                }

             $output .= '</ul>' . PHP_EOL;
             $output .= '</div>' . PHP_EOL;
             $output .= '</td>' . PHP_EOL;

            $output .= '</tr>' . PHP_EOL;

       

        }
        return $output;
    }
	
	
	public function displayCustomerLayaway($layaway){


        $count = 0;
        $output = ' ';
        $link = "view-layaway?";
        foreach ($layaway as $row)
        {

                $output .= '<tr>' . PHP_EOL;
          
                $output .= '<td>' . PHP_EOL;
				$customer_id = $row['customer_id'];
				$lid = $row['lid'];
				$items = $this->getCustomerLayawayItems($customer_id, $lid);
				$arrItems = array();
				foreach($items as $item){
					$arrItems[] = $item['description'];
				}
				$itemDisplay = implode(', ', $arrItems);
				$output .= $itemDisplay;
				$output .= '</td>' . PHP_EOL;
                $output .= '<td>$' . number_format($row['total'], 2) . '</td>' . PHP_EOL;
                $output .= '<td>' . date('m/d/Y', strtotime($row['date_added'])) . '</td>' . PHP_EOL;


                $output .= '<td><a href="' . $link .'customer_id=' . $row['customer_id'] . '&layaway_id=' . $row['lid'] . '"><span class="label label-info "><i class="fa fa-dollar"></i> View/Take Payment</span></a></td>' . PHP_EOL;

                $output .= '</tr>' . PHP_EOL;



                $count++;


            }
        return $output;
    }





}





?>
<?php

if(isset($_GET['upc'])){
	$upc = $_GET['upc'];
}
else {
	$upc = null;
}
                            $url = 'http://www.searchupc.com/handlers/upcsearch.ashx?request_type=3&access_token=C7C6738E-C172-4390-82DF-10375CF07DBC&upc=' . $upc . '';

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
                            $result = curl_exec($ch);
                            curl_close($ch);
							$r = json_decode($result);

							foreach($r as $key => $obj){
								
								/*
								$s = array('productname' => $obj->productname,
										   'price' => $obj->price,
										   'saleprice' => $obj->saleprice);
										   */
								$s = $obj->productname;
							}
							
							
							echo $result;

                            ?>
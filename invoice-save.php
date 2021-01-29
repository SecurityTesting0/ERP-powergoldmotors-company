<?php
session_start();
include("lib/config.php");
function saveInvoice( array $data){
		if( !empty( $data ) ){ 
			global $con;
			
			$count = 0;
			if( isset($data['data'] )){
				foreach ($data['data'] as $value) {
					if(!empty($value['product_id'] ))$count++;
				}
			}
			
			if($count == 0)throw new Exception( "Please add atleast one product to invoice." );
			
			// escape variables for security
			if( !empty( $data)){
				$client_id = mysqli_real_escape_string( $con, trim( $data['client_id'] ) );
				$invoice_total = mysqli_real_escape_string( $con, trim( $data['invoice_total'] ) );
				$invoice_subtotal = mysqli_real_escape_string( $con, trim( $data['invoice_subtotal'] ) );
				$tax = mysqli_real_escape_string( $con, trim( $data['tax'] ) );
				$amount_paid = mysqli_real_escape_string( $con, trim( $data['amount_paid'] ) );
				$amount_due = mysqli_real_escape_string( $con, trim( $data['amount_due'] ) );
				$notes = mysqli_real_escape_string( $con, trim( $data['notes'] ) );

				

				$id = mysqli_real_escape_string( $con, trim( $data['id'] ) );

				if(empty($id)){
					$uuid = uniqid();
					$query = "INSERT INTO invoices (`id`, `client_id`,  `invoice_total`, `invoice_subtotal`, `tax`,
							`amount_paid`, `amount_due`, `notes`, `created`, `uuid`)
							VALUES (NULL, '$client_id',  '$invoice_total', '$invoice_subtotal', '$tax', '$amount_paid', '$amount_due', '$notes',
							CURRENT_TIMESTAMP, '$uuid')";

				}else{
					$uuid = $data['uuid'];
					$query = "UPDATE `invoices` SET `client_id` = '$client_id', `invoice_total` ='$invoice_total',`invoice_subtotal` = '$invoice_subtotal',
							`tax` = '$tax', `amount_paid` = '$amount_paid', `amount_due` = '$amount_due', `notes` = '$notes', `updated` = CURRENT_TIMESTAMP
							WHERE `id` = $id";
				}
				if(!mysqli_query($con, $query)){
					throw new Exception(  mysqli_error($con) );
				}else{
					if(empty($id))$id = mysqli_insert_id($con);
				}

				if( isset( $data['data']) && !empty( $data['data'] )){
					saveInvoiceDetail( $data['data'], $id );
				}
				return [
					'success' => true,
					'uuid' => $uuid,
					'message' => 'Invoice Saved Successfully.'
				];
			}else{
				throw new Exception( "Please check, some of the required fileds missing" );
			}
		} else{
			throw new Exception( "Please check, some of the required fileds missing" );
		}
	}


function saveInvoiceDetail(array $invoice_details, $invoice_id = ''){ 
	global $con;
    $deleteQuery = "DELETE FROM invoice_details WHERE invoice_id = $invoice_id";
    mysqli_query($con, $deleteQuery);

    foreach ($invoice_details as $invoice_detail){
        $product_id = mysqli_real_escape_string( $con, trim( $invoice_detail['product_id'] ) );
        $productName = mysqli_real_escape_string( $con, trim( $invoice_detail['product_name'] ) );
        $quantity = mysqli_real_escape_string( $con, trim( $invoice_detail['quantity'] ) );
        $price = mysqli_real_escape_string( $con, trim( $invoice_detail['total'] ) );
        

        $query = "INSERT INTO invoice_details (`id`, `invoice_id`, `product_id`, product_name, `quantity`, `price`)
                VALUES (NULL, '$invoice_id', '$product_id', '$productName', '$quantity', '$price')";
        mysqli_query($con, $query);
    }

}


function getInvoices(){
	global $con;
	$data = [];
	$query = "SELECT * FROM invoices";
	if ( $result = mysqli_query($con, $query) ){
		while($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row);
		}
	} 
	return $data;
}


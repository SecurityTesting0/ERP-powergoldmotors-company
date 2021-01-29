
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->

		<section class="add_new_member ">
			 <div class="container">
				<div class="row">
					
					<div class="form-group from_border_3">
						<?php													
								
								if (empty($_GET['id'])){
								}elseif(!isset($_GET['id']) || $_GET['id'] == NULL){
									echo 'Something went to wrong';
								}else{
										$tid= $_GET['id'];
										$id= preg_replace("/[^0-9a-zA-Z]/", "", $tid);
										$return_id =$id;	
								}
											
								//invoice table data 						
								$distributor_id		="";
								$invoice_total		="";
								$invoice_subtotal	="";
								$tax				="";
								$tax_amount			="";
								$amount_paid 		="";
								$amount_due			="";
								$notes				="";
								$created			="";
								$updated 			="";
								$uuid				="";
								$reciept_cat		="";
								
								$queryinvoice	="SELECT *from invoices where invoice_no='$return_id'";
								$queryinvoiceres=$db->select($queryinvoice);
								
								if($queryinvoiceres==true){
									while($qinvres=$queryinvoiceres->fetch_assoc()){
										
										$distributor_id		=$qinvres['distributor_id'];
										$invoice_total		=$qinvres['invoice_total'];
										$invoice_subtotal	=$qinvres['invoice_subtotal'];
										$tax				=$qinvres['tax'];
										$tax_amount			=$qinvres['tax_amount'];
										$amount_paid 		=$qinvres['amount_paid'];
										$amount_due			=$qinvres['amount_due'];
										$notes				=$qinvres['notes'];
										$created			=$qinvres['created'];
										$updated 			=$qinvres['updated'];
										$uuid				=$qinvres['uuid'];
										$reciept_cat		=$qinvres['reciept_cat']; 								
										}
									}
								
								//End invoice table data 								
																		
								$queryinvoicedetails="SELECT *from invoice_details where invoice_id='$return_id'";
								$queryinvoicedetsres=$db->select($queryinvoicedetails);
								if($queryinvoicedetsres==true){
									while($qinvdetres=$queryinvoicedetsres->fetch_assoc()){
										$id				=$qinvdetres['id'];
										$invoice_id		=$qinvdetres['invoice_id'];
										$product_id		=$qinvdetres['product_id'];
										$product_name	=$qinvdetres['product_name'];
										$quantity		=$qinvdetres['quantity'];
										$price			=$qinvdetres['price'];
										$purchase_price	=$qinvdetres['purchase_price']; 
										
										$query2="INSERT INTO return_invoice_details(return_invoice_id,invoice_id, product_id, product_name, 
										quantity, price, purchase_price)
										values('$id','$invoice_id','$product_id','$product_name',
										'$quantity','$price','$purchase_price')";
										$results2=$db->insert($query2); 
											
										$lstpro=$db->select("SELECT `stock_quantity` FROM `stock_product` WHERE `product_code`='$product_id'");
										$lastdata=$lstpro->fetch_assoc()["stock_quantity"];
										$newqty=$lastdata+$quantity; 										
										$db->update("UPDATE `stock_product` SET `stock_quantity`='$newqty' WHERE `product_code`='$product_id'");
										
										$delquryinvoicedel="DELETE FROM invoice_details where invoice_id='$return_id'"; 
										$delres=$db->delete($delquryinvoicedel); 
									}
								
								}			
							
								if ($return_id==true){
								//invoice table 
									$query1="INSERT INTO return_invoices(distributor_id, return_invoice_id, invoice_total, invoice_subtotal, 
									tax,tax_amount,amount_paid, amount_due, notes,created,reciept_cat)
									values('$distributor_id','$return_id','$invoice_total','$invoice_subtotal','$tax',
									'$tax_amount','$amount_paid','$amount_due','$notes','$created','$reciept_cat')";
									$results=$db->insert($query1);

									$delquryinvoice="DELETE FROM invoices where invoice_no='$return_id'"; 
									$delres=$db->delete($delquryinvoice);
											
									//invoice detail table
								}else{
									echo "ID Not Valid "; 
								} 
								
							echo "<script> 
							alert('sales Return Successfully Completed');
							window:location ='invoice_list.php';
							</script>";
							echo "<script>  </script>";
								
								
								
						?>

					</div> 
					
			 </div>
		</section>
			<script src="js/get_invoice.js"></script>
		<!-- End Main Area -->
		<script src="js/jquery.min.js"></script> 
	
		<script src="js/auto.js"></script>
		
<?php include("inc/footer.php"); ?> 
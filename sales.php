
<?php 
include("inc/header.php");

 ?> 
		<!-- Main Area -->
	 
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">
					
					<div class="form-group from_border_3" >
<?php 
if(empty($_SESSION["invoice"])) {
$qryin="SELECT * FROM `invoices`";
$res=$db->select($qryin);
$numrows = mysqli_num_rows($invd);	
if(!empty($numrows)) {
	$inv=1001;
}else{
	////////////////////////////
		$qryin1="SELECT * FROM `invoices` ORDER BY `invoice_no` DESC LIMIT 1";
		$res1=$db->select($qryin1);
		$invd1=$res1->fetch_assoc()["invoice_no"];
		$tmp1=$invd1; 
		$inv=$tmp1+1; 
}

@$_SESSION["invoice"]=$inv;
	
}
$invoice=$_SESSION["invoice"];


?>

<?php
if(isset($_POST["newinvoice"])) {
unset($_SESSION["invoice"]);
echo"<script> 
	window:location ='sales.php';
</script>";
}
?>
						<?php
							// Temporary Product Table Area 
							if(isset($_POST["addProdduct"])) {
								$dis_code 			=$_POST["dis_code"];
								$invoice_id			=$_POST["invoice_no"];
								$product_id 		=$_POST["product_id"];
								$qty	  			=$_POST["qty"];
								$price  			=$_POST["price"];						
								$stock  			=$_POST["stock"]; 
								
								if($product_id==null){
									echo "<script type='text/javascript'>alert('Please Select Product')</script>"; 
							 	}else{							
								$total=$qty*$price;
								
									$querystock="SELECT * FROM stock_product where product_code=$product_id";
									$resultsstock=$db->select($querystock);															
									if ($resultsstock){
										while($stcok=$resultsstock->fetch_assoc()){
											$stock	=$stcok['stock_quantity'];
											$pprice	=$stcok['purches_price'];
											 if ($stock>$qty){
												  $invq="INSERT INTO `temp_invoice_details` 
													(`disCode`,`product_id`,`invoice_id`, `quantity`, `price`,purchase_price,total) 
													VALUES ('$dis_code','$product_id','$invoice_id','$qty', '$price', '$pprice', '$total')";
													$db->insert($invq);
											 }else{
												echo "<script type='text/javascript'>alert('Product Not Available')</script>";  
											 }
										}
									}
								
								/* $invq="INSERT INTO `temp_invoice_details` 
								(`disCode`,`product_id`,`invoice_id`, `quantity`, `price`,purchase_price,total) 
								VALUES ('$dis_code','$product_id','$invoice_id','$qty', '$price', '$pprice', '$total')";
								$db->insert($invq); */
								}
							}
							
							// End Temporary Product Table Area 
								
							if (isset($_POST["submit"])){ 
							
								$dis_code 			=$_POST["dis_code"];
								$invoice_id			=$_POST["invoice_no"];
								$date  				=$_POST["date"];
								
								$invsubtqy="select SUM(total) as qtytotal
								FROM temp_invoice_details where invoice_id='$invoice'";
								$totalRes=$db->select($invsubtqy);						
								if ($totalRes){	
									while($invqtytotal=$totalRes->fetch_assoc()){				
										$invsq=$invqtytotal['qtytotal'];
										$invoice_subtotal  	=$invsq; 
										$tax_percent  		=$_POST["tax_percent"];	
										$amount_paid  		=$_POST["amount_paid"];
										$disc  				=$_POST["discount"];
										$note  				=$_POST["narration"];
										
										$taxAmount  		=($tax_percent/100) * $invoice_subtotal; 
										$discount	  		=($disc/100) * $invoice_subtotal; 
										$grandTotal			=($invoice_subtotal+$taxAmount)-$discount;
																	
										$amount_due  		=$grandTotal-$amount_paid; 
										
										 $query1="INSERT INTO invoices (invoice_no,distributor_id, invoice_total, invoice_subtotal, 
										tax,tax_amount,discount, discount_amount, amount_paid, amount_due, notes,created,reciept_cat,saller_id)
										values('$invoice_id','$dis_code','$grandTotal','$invoice_subtotal','$tax_percent',
										'$taxAmount','$disc','$discount','$amount_paid','$amount_due','$note','$date','1','$userid')";
										$results=$db->insert($query1);  
										
										//select product from temp_invoice_details 
										$product_query="SELECT * FROM temp_invoice_details where invoice_id='$invoice'";
										$pro_r=$db->select($product_query);
										$id=0; 
										if ($pro_r==true){	
											while($pro_res=$pro_r->fetch_assoc()){
												$id++; 
												$disCode		=$pro_res['disCode'];
												$invoice_id		=$pro_res['invoice_id'];
												$product_id		=$pro_res['product_id'];
												$product_name	=$pro_res['product_name'];
												$quantity		=$pro_res['quantity'];
												$price			=$pro_res['price'];
												$purchase_price	=$pro_res['purchase_price']; 
												
												$invq="INSERT INTO `invoice_details` (`id`, `invoice_id`, `product_id`, 
												`product_name`, `quantity`, `price`,purchase_price) 
												VALUES (NULL, '$invoice_id','$product_id',
												'$product_name','$quantity','$price','$purchase_price')";
												$db->insert($invq);
												
												//update product stock
												$lstpro=$db->select("SELECT `stock_quantity` FROM `stock_product` WHERE `product_code`='$product_id'");
												$lastdata=$lstpro->fetch_assoc()["stock_quantity"];
												$newqty=$lastdata-$quantity;
												$db->update("UPDATE `stock_product` SET `stock_quantity`='$newqty' WHERE `product_code`='$product_id'");
											}
											
										}
										
										
										
										if ($results==true){?>  
							
													<p class='bg-success text-center' style='margin:0px auto; color:green;'> 
										
														Invoice Created Successfully Completed 
														
														<?php 
															$queryvou="SELECT *from invoices ORDER BY id DESC LIMIT 1";
															$resultsvou=$db->select($queryvou);
															if($resultsvou==true){
															while($vid=$resultsvou->fetch_assoc()){
															
															?> 
															<a href="print_invoice.php?inv='<?php echo $vid['invoice_no']?>'" target="blank" class="btn btn-success"> Print Invoice </a> 
															
															
															</p>
												<?php 
												} 
											} 
										} 
										$deltemqery="DELETE FROM temp_invoice_details where invoice_id=$invoice";
										$delq=$db->delete($deltemqery);
										
										unset($_SESSION["invoice"]);
										 
										//direct invoicepage showk korba
								
								}
							}	
							
								
							
						}
						?>
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;">Sales Area</span></h4>
						  <form action="" method ="post" enctype="">
							  <div class="col-6 col-sm-6">
								<label>Distributor Code</label>
								  <div class="select2-purple">
									<select class="select2" name="dis_code" multiple="multiple" 
									data-placeholder="Type Member Code" data-dropdown-css-class="select2-purple" style="width: 300px;" required>
									
									<?php		
										$queryin="SELECT * FROM temp_invoice_details where invoice_id='$invoice' order by invoice_id DESC limit 1";
										$results1=$db->select($queryin); 
										if ($results1==true){ 
										while($invoiceid=$results1->fetch_assoc()){
											$in=$invoiceid['invoice_id'];
											$discode=$invoiceid['disCode'];
											
												if($in==true){
														$query="SELECT * FROM distributor where ac='$discode'";
														$results=$db->select($query); 
															if ($results){
																	while($dis=$results->fetch_assoc()){?>
																	  <option value="<?php echo $dis['ac'];?> " selected>
									  
																		<?php echo $dis['ac'].' '.$dis['first_name'].' '.$dis['last_name'];?>
																			
																	</option>
																	
														<?php 
														}
													}
												}
											}
										}else{ 
											$query22="SELECT * FROM distributor";
												$results22=$db->select($query22); 
													if ($results22){
															while($dis22=$results22->fetch_assoc()){?>
															  <option value="<?php echo $dis22['ac'];?> ">
							  
																<?php echo $dis22['ac'].' '.$dis22['first_name'].' '.$dis22['last_name'];?>
																	
															</option> 
												<?php 
												}
											}
										}
										?>  
									  
									</select>
								  </div>
								 
								<!-- /.form-group -->
							  </div> 
							   <div class="col-xs-3 col-md-3 col-sm-3" >
								<label for="ex2">Select Date <span style="color:red">*</span></label>									
								  <div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="date" value="<?php echo date('Y-m-d');?>">
										<div class="input-group-addon" >
										  <span class="glyphicon glyphicon-th"></span>
										</div>
									  </div>										  
									  <script type="text/javascript">										  
									   $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
									  </script>
									</div>    
								  </div>															
							  </div>
							  <div class="col-xs-3 col-md-3 col-sm-3" >
									<label for="ex2">Invoice No: <span style="color:red">*</span></label>									
									<div class="form-group">
										<input type="text" class="form-control" name="invoice_no" value="<?php echo $invoice?>"  READONLY />
									</div>  												
							  </div> 
							 
							 <!-- Product area -->  
							 
								 <table>
								 		 <?php		
											$query="SELECT * FROM product_table";
											$results=$db->select($query);
											$id=0; 
											if ($results){ 
											$oppro="";
												while($dis=$results->fetch_assoc()){
												$id++;  
												$prcode=$dis['product_code']; 
													$querystock="SELECT * FROM stock_product where product_code=$prcode";
													$resultsstock=$db->select($querystock);															
													if ($resultsstock){
													
														while($stcok=$resultsstock->fetch_assoc()){
															$stockproduct=$stcok['stock_quantity'];
															if($stockproduct){
															$oppro.="<option value='".$dis['product_code']."'>".
															 $dis['product_code'].'-'.$dis['product_name'].'-Stock-'.$stcok['stock_quantity']."</option>";
														  	}
														}
													}
												}
											}
											?>
									<tr>
										<td> 
											<select class="select2" name="product_id" multiple="multiple" 
											data-placeholder="Type Product Code" onchange="getprice(this.value)" data-dropdown-css-class="select2-purple" 
											style="width:300px;" > 
												<?php echo $oppro; ?> 
											</select>
									
											
									
										</td>
										<td><input type="number" name="qty" class="form-control" placeholder="Quantity" id="email" ></td>
										<td>
										<select name="price" placeholder="Price" style="width:200px" placeholder="Product Price" id="price" class="form-control form-control-md">
											
										</select>										
										</td>
										<td><input type="submit" name="addProdduct" class="btn btn-success" value="Add" /></td>
									</tr>
								 </table> 
							<br />
							<div class="" style="height:400px;">
							 <table class="table table-bordered " id="invoiceTable">
									<thead>
										<tr class="bg-info">
											
											<th width="15%">Product Code</th>
											<th width="38%">Item Name</th>
											<th width="15%">Qty</th>								
											<th width="15%">Price</th>
											<th width="15%">Total</th>
											<th width="15%">Action</th>
										</tr>
									</thead>
									<tbody>	
										<?php		
										$queryte="SELECT * FROM temp_invoice_details where invoice_id='$invoice'";
										$resultste=$db->select($queryte);
										$id=0; 
										if ($resultste){	
											while($temres=$resultste->fetch_assoc()){
												$id++; 
										?>
										<tr class="bg-warning">
											<td style="text-center" ><?php echo $temres['product_id'];?></td>
											<td><?php 
											
											$pro_id=$temres['product_id'];
											$queryte1="SELECT * FROM product_table WHERE product_code='$pro_id'";
											$resultste1=$db->select($queryte1); 
											if ($resultste1){	
												while($proname=$resultste1->fetch_assoc()){
													$product=$proname['product_name'];
													echo $product;
												}
											}
											
											?>
											<input type="hidden" name="product_name[]" value="<?php 
											
											$pro_id=$temres['product_id'];
											$queryte1="SELECT * FROM product_table WHERE product_code='$pro_id'";
											$resultste1=$db->select($queryte1); 
											if ($resultste1){	
												while($proname=$resultste1->fetch_assoc()){
													$product=$proname['product_name'];
													echo $product;
												}
											}
											
											?>"/>
											</td>
											<td> <?php echo $temres['quantity'];?>	</td>
											<td> <?php echo number_format((float)$temres['price'], 2, '.', ','); ?></td>
											<td>
												<?php 
													$qty =$temres['quantity'];
													$price =$temres['price'];
													$total =$qty*$price; 														
													echo number_format((float)$total, 2, '.', ',');													
												?> 
											</td>
											<td>
											<?php 
												$delqty=$_GET['qtydel']; 
												
												if ($delqty==true) {
													$delqtyq="DELETE FROM temp_invoice_details where id=$delqty";
													$resqtyd=$db->delete($delqtyq);
													if($resqtyd==true){
														echo "<script type='text/javascript'>window.location='sales.php'; </script>"; 
													}
													
												}
											?>
												<a href="sales.php?qtydel='<?php echo $temres['id'];?>'" class=" btn-warning btn-sm"> 
												<i class="fa fas fa-trash" style="color:#fff;"></i></a>
											</td>										
											
										</tr>
										<?php } } ?>
									</tbody>
									<tfoot class="bg-success">
									 <?php		
										$totalquery="select SUM(total) as qtytotal
										FROM temp_invoice_details where invoice_id='$invoice'";
										$totalRes=$db->select($totalquery);						
										if ($totalRes){	
											while($qtytotal=$totalRes->fetch_assoc()){				
												$qtytotalshow=$qtytotal['qtytotal'];
												
										?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td class="text-right">Total=</td>
											<td>
											<?php 
											
											echo number_format((float)$qtytotalshow, 2, '.', ',');?>
											<input type="hidden" name="invoice_subtotal" class="form-control" value="<?php echo $qtytotalshow; ?>" />
											</td>
											<td> </td>
										</tr>
										<?php }} ?> 
									</tfoot>
								</table>
							</div>
								<table class="table-striped table-bordered  " s>
									<tr class="danger">
									<td class="text-right">Tax(%)=</td>
									<td>											
									<input type="text" name="tax_percent" id="tax" class="form-control input-sm" placeholder="Ex. 10" />
									</td>
									<td class="text-right">Discount(%)=</td>
									<td>											
									<input type="text" name="discount" onchange="updatesum();" id="discount" class="form-control input-sm" placeholder="Ex. 10" />
									</td>
									<td class="text-right">Paid Amount=</td>
									<td>											
									<input type="text" name="amount_paid" class="form-control input-sm" placeholder="Ex. 1000" /> 
									</td>
									
									<td class="text-right">Total Payable Amount=</td>
									<td>	
									<?php		
										$totalquery="select SUM(total) as qtytotal
										FROM temp_invoice_details where invoice_id='$invoice'";
										$totalRes=$db->select($totalquery);						
										if ($totalRes){	
											while($qtytotal=$totalRes->fetch_assoc()){				
												$qtytotalshow=$qtytotal['qtytotal'];
									?>
									<input type="text" id="total" class="form-control" value="<?php echo number_format((float)$qtytotalshow, 2, '.', ','); ?>" READONLY/>
									
									
									
									</td>
									</tr>
									<script type="text/javascript">
										function calc() {
										  var discount 	= document.getElementById("discount").value;
										  var amount 	= parseInt(discount, 10);
										  var tax	 	= document.getElementById("tax").value;										
										  var discount 	= parseInt(discount, 10);
										  var total 	= amount * quantity;
										  document.getElementById("total").value = total;
										}


									</script>
								</table>
							
								<?php }}?> 
							
							<div class="col-xs-12 col-md-6 col-sm-6 "> 
									<label for="ex2">Narration: </label>
									<textarea type="text" class="form-control " placeholder="Ex. Sales Represntiv Name" rows="2" id="ex2" name="narration" ></textarea> 
							</div>
							  
							<!-- End Product area --> 							  
							 <div class="col-xs-3 margin_top">
								
								<br />
								<input class="form-control btn btn-success" name="submit" type="submit" value="Save Invoice">
							 </div>  
						 </form>
						 <form action="" method="post">
							 <div class="col-xs-3 margin_top">	
									<br />							 
									<input type="submit"  name="newinvoice" class="form-control btn btn-info" value="Add New Invoice"/>
							</div> 
						</form>
					</div> 
					
			 </div>
		</section>
		 <script type="text/javascript">
		function getprice(str) { 
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			 document.getElementById("price").innerHTML = this.responseText;
			}
		  };
		  xhttp.open("GET", "get_product_price.php?id="+str, true);
		  xhttp.open("GET", "get_product_stock.php?id="+str, true);
		  xhttp.send();
		}


		 
		 </script>
		 
		<!-- End Main Area -->
		<script src="js/jquery.min.js"></script> 
	
		<script src="js/auto.js"></script>
		
<?php include("inc/footer.php"); ?> 
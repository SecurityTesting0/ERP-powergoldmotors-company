
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
	 
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">
					
					<div class="form-group from_border_3">
						<?php
							if (isset($_POST["submit"]) 
								&& is_array($_POST["product_name"])
								&& is_array($_POST["price"])
								&& is_array($_POST["quantity"])
								&& is_array($_POST["total"])
								){  
								
								$dis_code  			=$_POST["dis_code"];
								$invoice_total  	=$_POST["invoice_total"];								
								$invoice_subtotal  	=$_POST["invoice_subtotal"];								
								$tax_percent  		=$_POST["tax_percent"];								
								$taxAmount  		=$_POST["taxAmount"];								
																
								$amount_paid  		=$_POST["amount_paid"];								
								$amount_due  		=$_POST["amount_due"];								
								$note  				=$_POST["narration"];									
								$date  				=$_POST["date"];									
																
								
								
								//array filed 
								$product_code	=$_POST["product_name"];
								$price			=$_POST["price"];
								$qty			=$_POST["quantity"];
								$total			=$_POST["total"];
								$pprice			=$_POST["pprice"];	
								//end Array file 
								
								
								
								//invoice table 
								$query1="INSERT INTO invoices (distributor_id, invoice_total, invoice_subtotal, 
								tax,tax_amount,amount_paid, amount_due, notes,created,reciept_cat)
								values('$dis_code','$invoice_total','$invoice_subtotal','$tax_percent',
								'$taxAmount','$amount_paid','$amount_due','$note','$date','1')";
								$results=$db->insert($query1);
								$inv_id=$db->select("Select `id` FROM `invoices` ORDER BY `id` DESC Limit 1");
								$invoice_ids=$inv_id->fetch_assoc()["id"];
								//end invoice table 
								
								//invoice detail table
								
								$ind=0;
								
								foreach($product_code AS $loop){
									if($loop!=NULL){
									$invq="INSERT INTO `invoice_details` (`id`, `invoice_id`, `product_id`, `product_name`, `quantity`, `price`,purchase_price) 
									VALUES (NULL, '$invoice_ids', '".$product_code[$ind]."', 'Pro Name', '".$qty[$ind]."', '".$price[$ind]."','".$pprice[$ind]."')";
									$db->insert($invq);	
									
									$lstpro=$db->select("SELECT `stock_quantity` FROM `stock_product` WHERE `product_code`='".$product_code[$ind]."'");
									$lastdata=$lstpro->fetch_assoc()["stock_quantity"];
									$newqty=$lastdata-$qty[$ind];
									$db->update("UPDATE `stock_product` SET `stock_quantity`='$newqty' WHERE `product_code`='".$product_code[$ind]."'");
									}
									
									$ind++;
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
													<a href="print_invoice.php?inv='<?php echo $vid['id']?>'" target="blank" class="btn btn-success"> Print Invoice </a> 
													
													
													</p>
										<?php 
										} 
									} 
								}
							}
						?>
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;">Sales Area</span></h4>
						  <form action="" method ="post" enctype="">
							  <div class="col-6 col-sm-6">
								<div class="form-group">
								  <label>Distributor Code</label>
								  <div class="select2-purple">
									<select class="select2" name="dis_code" multiple="multiple" 
									data-placeholder="Type Member Code" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
									  <?php		
										$query="SELECT * FROM distributor";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($dis=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $dis['ac'];?> " >
									  
									<?php echo $dis['ac'].' '.$dis['first_name'].' '.$dis['last_name'];?>
										
									  </option>
										
										<?php } ?>
										<?php } ?>
									  
									  
									</select>
								  </div>
								</div>
								<!-- /.form-group -->
							  </div> 
							   <div class="col-xs-6" >
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
							 <!-- Product area -->  
							 <table class="table table-bordered" id="invoiceTable">
										<thead>
											<tr>
												
												<th width="38%">Item Name</th>
												<th width="15%">Price</th>
												<th width="15%">Quantity</th>
												<th width="15%">Total</th>
											</tr>
										</thead>
										<tbody>
										 <?php		
										 
											
												$query="SELECT * FROM product_table";
												$results=$db->select($query);
												$id=0; 
												if ($results){	
												$options="";
															while($product=$results->fetch_assoc()){
															$id++; 
																$prcode=$product['product_code'];
																
																$querystock="SELECT * FROM stock_product where product_code=$prcode";
																$resultsstock=$db->select($querystock);															
																if ($resultsstock){
																	while($stcok=$resultsstock->fetch_assoc()){
																		$stockproduct=$stcok['stock_quantity'];
																		if($stockproduct>0){
															
																		$options.="<option value='".$product['product_code']."'>".$product['product_code'].'-'.$product['product_name'].
																	
																		'- Price- '.$product['unite_price'].'- Stock- '.$stcok['stock_quantity']."</option>";
																				?>
																	<input type="hidden" name="pprice[]" value="<?php echo $stcok['purches_price'];?>" />
																	<?php 
																			
																	}
																	
																}
															}
															
														}
													}
														
														
														
														?>
												<?php
													for($i=0; $i<5; $i++){  //$i<=10 <-- ai value ta only change hobe; h
 												?>		
														
											<tr>
												
												<td>
												 <select class="select2" name="product_name[]" multiple="multiple" 
													data-placeholder="Type Product Code" style="width:100%;"
													data-dropdown-css-class="select2-purple" >
													  <?php echo $options;?>
													 
													</select>
												 </td> 
												<td>
												<!--<select name="price[]" id="price_1" class="form-control changesNo" >
												</select>-->
												<input type="number" name="price[]" id="price<?php echo $i;?>" class="form-control changesNo" onkeyup="getTotal<?php echo $i;?>();" autocomplete="off" ondrop="return false;" onpaste="return false;">
												</td>
												<td><input type="number" name="quantity[]" id="qty<?php echo $i;?>" class="form-control changesNo" autocomplete="off" onkeyup="getTotal<?php echo $i;?>();" ondrop="return false;" onpaste="return false;"></td>
												<td><input type="number" name="total[]" id="mtotal<?php echo $i;?>" class="form-control totalLinePrice" onkeyup="getTotal<?php echo $i;?>();" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>
											</tr>
											
											<script>
												function getTotal<?php echo $i;?>(){
													var a, b;
													a=document.getElementById('price<?php echo $i;?>').value;
													b=document.getElementById('qty<?php echo $i;?>').value;
													
													document.getElementById('mtotal<?php echo $i;?>').value=parseFloat(parseFloat(a)*parseFloat(b)).toFixed(2);
													
												}
											</script>
											
											<?php
													}
											?>
										</tbody>
									</table> 
						
							 
		
					
							<div class="col-xs-12 col-md-6 col-sm-6">
						 
									<label for="ex2">Narration: </label>
									<textarea class="form-control" rows="2" id="ex2" name="narration" type="text"> </textarea> 
							</div>
							<div class="col-xs-12 col-md-3 col-sm-3">  
									 <div class="form-group">											
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Subtotal:</div>
												<input type="number" class="form-control" name="invoice_subtotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Tax:</div>
												
												<input type="number" class="form-control" name="tax_percent" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">											
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Tax % Tk:</div>
												<input type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
												
											</div>
										</div>
										
							</div>
							<div class="col-xs-12 col-md-3 col-sm-3">  									  
										<div class="form-group input-group-sm mb-3">									
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon ">Total:</div>
												<input type="number" class="form-control" name="invoice_total" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">
										
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Tk Paid:</div>
												<input type="number" class="form-control" name="amount_paid" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">										
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Tk Due:</div>
												<input type="number" class="form-control amountDue" name="amount_due" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
							</div>
							  
							 
							<!-- End Product area --> 
							  
							  
							 <div class="col-xs-3 margin_top">							
								<input class="form-control btn btn-success" name="submit" type="submit" value="Save Entry">
							 </div> 
							 <div class="col-xs-3 margin_top">							
								<a href="sales2.php" class="form-control btn btn-info" id="ex2">Add New </a>
							 </div> 
						 
						 </form>
					</div> 
					
			 </div>
		</section>
			<script src="js/get_invoice.js"></script>
		<!-- End Main Area -->
		<script src="js/jquery.min.js"></script> 
	
		<script src="js/auto.js"></script>
		
<?php include("inc/footer.php"); ?> 
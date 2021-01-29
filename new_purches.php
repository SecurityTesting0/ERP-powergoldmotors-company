
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					
					<div class="form-group from_border_3">					
				<h4 class="well text-center"><i class="fas fa-shopping-cart"></i><span style="color:#fff; font-weight:bold;"> 
						 Purchas Product</span></h4>
					<?php 
						if(isset($_POST["submit"])){ 
						
							$product_id			 =$fm->validation($_POST['product_id']);
							$catagory_id		 =$fm->validation($_POST['catagory_id']);
							$brand_id			 =$fm->validation($_POST['brand_id']);
							$purches_quntity	 =$fm->validation($_POST['purches_quntity']);
							$purches_price		 =$fm->validation($_POST['purches_price']);
							$unite_price		 =$fm->validation($_POST['unite_price']);
							$discount			 =$fm->validation($_POST['discount']);
							$product_description =$fm->validation($_POST['product_description']); 
														
							$product_id			 =mysqli_real_escape_string($db->link,$product_id);
							$catagory_id	 	 =mysqli_real_escape_string($db->link,$catagory_id);
							$brand_id			 =mysqli_real_escape_string($db->link,$brand_id);
							$purches_quntity	 =mysqli_real_escape_string($db->link,$purches_quntity);
							$purches_price		 =mysqli_real_escape_string($db->link,$purches_price);
							$unite_price		 =mysqli_real_escape_string($db->link,$unite_price);
							$discount			 =mysqli_real_escape_string($db->link,$discount);
							$product_description =mysqli_real_escape_string($db->link,$product_description); 
							
							$purchase_total		=$purches_quntity*$purches_price; 
							
							$chekqury="SELECT * From stock_product where product_code='$product_id'"; 
							$res=$db->select($chekqury);
							if($res){
									while($ck=$res->fetch_assoc()){
										$prcode=$ck['product_code'];
										$stqty=$ck['stock_quantity']+$purches_quntity; 
										$stprice=$ck['price'];
										$stdis=$ck['discount'];
										if($prcode==$product_id){
											$query1 ="INSERT INTO purches_product(invoice_no, product_id, catagory_id, brand_id, 
											purches_quntity, purches_price, unite_price, discount, product_description, purchase_total) 
											VALUES ('$invoice_no','$product_id','$catagory_id','$brand_id','$purches_quntity',
											'$purches_price','$unite_price','$discount','$product_description','$purchase_total')";
											
											$query2 ="UPDATE stock_product SET 
											stock_quantity	=$stqty,
											discount		='$discount',
											price			=$unite_price,
											purches_price	=$purches_price,
											saler_id		='$userid'
											where product_code='$product_id'";											
											
											$results=$db->insert($query1);
											$results=$db->insert($query2);						
																	
												if($results==true){
												?>
												<div class="bg-success text-center">
													<h4>Product Purchas Successfullly Completed</h4>
												</div>
												<?php
											}
											
										}else{
											echo "somthing Problem"; 
										}
								}

							}else{
								$query1 ="INSERT INTO purches_product(invoice_no, product_id, catagory_id, brand_id, 
								purches_quntity, purches_price, unite_price, discount, product_description, purchase_total) 
								VALUES ('$invoice_no','$product_id','$catagory_id','$brand_id','$purches_quntity',
								'$purches_price','$unite_price','$discount','$product_description','$purchase_total')";
								
								$query2 ="INSERT INTO stock_product(product_code, catogry_id, 
								brand_id, stock_quantity, discount, price, purches_price, saler_id) 
								VALUES ('$product_id','$catagory_id','$brand_id','$purches_quntity','$discount',
								'$unite_price','$purches_price','$userid')";
								
								
								$results=$db->insert($query1);
								$results=$db->insert($query2);						
														
									if($results==true){
									?>
									<div class="bg-success text-center">
										<h4>Product Purches Successfullly Completed</h4>
									</div>
									<?php
								}  
							}
						}
												
											
					?>
								
						
						  <form action="" method ="post" enctype="">
						  <div class="col-md-6 col-sm-6">
							
						  <!--<div class="col-xs-6">
						   <label for="ex2">Invoice No.<span style="color:red">*</span></label>									
								<?php		
									$invq="SELECT CONCAT( 'PINV-', LPAD(id,7,'0') ) FROM purches_product order by id limit 0,1;";
									$invr=$db->select($invq);
									$idpluse=1; 
									$invpr='PINV # 1';
										if (!empty($invr)){								
											while($invrs=$invr->fetch_assoc()){
												$id=$invrs['id']; 
												$invoice=$idpluse+$id; 
												$invprfix='PINV'.' # '.$invoice;  
										}
									}else{
										$invprfix='PINV # 1';
									} 
								?>
								<input class="form-control" id="ex2" type="text" name="invoice_no" value="<?php echo $invprfix;  ?>" Disabled>
						
							</div>

							<div class="col-xs-6" >
								<label for="ex2">Select Date <span style="color:red">*</span></label>									
								  <div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="date" value="<?php echo date("Y-m-d h:s:i")?>" disabled>
										<div class="input-group-addon" >
										  <span class="glyphicon glyphicon-th"></span>
										</div>
									  </div>										  
									  <script type="text/javascript">										  
									   $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
									  </script>
									</div>    
								  </div>															
							  </div>--> 
							 <div class="col-xs-12 col-sm-12 col-md-12 ">
								<div class="form-group">
								  <label>Select Product.</label>
								  <div class="select2-purple">
									<select class="select2" name="product_id" multiple="multiple" 
									data-placeholder="Type Product Code" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
									  <?php		
										$query="SELECT * FROM product_table";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($product=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $product['product_code'];?> " >
									  
									<?php echo $product['product_code'].'-'.$product['product_name'];?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
									  
									  
									</select>
								  </div>
								</div>
								<!-- /.form-group -->
							  </div> 
							  <div class="col-12 col-sm-12">
								<div class="form-group">
								  <label>Select Catagory.</label>
								  <div class="select2-purple">
									<select class="select2" name="catagory_id" multiple="multiple" 
									data-placeholder="Type Catagory Name" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
									  <?php		
										$query="SELECT * FROM product_catagory";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($cat=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $cat['id'];?> " >
									  
									<?php echo $cat['name'];?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
									  
									  
									</select>
								  </div>
								</div>
								<!-- /.form-group -->
							  </div> 
							  <div class="col-12 col-sm-12">
								<div class="form-group">
								  <label>Brand Name:</label>
								   <div class="select2-purple">
									<select class="select2" name="brand_id" multiple="multiple" 
									data-placeholder="Type Catagory Name" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
									  <?php		
										$query="SELECT * FROM brand_name";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($cat=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $cat['id'];?> " >
									  
									<?php echo $cat['name'];?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
									  
									  
									</select>
								  </div>
								</div>
								<!-- /.form-group -->						
							  </div> 
							</div>
							<div class="col-md-6 col-sm-6">
							
										<div class="col-xs-6">
											<label for="ex2">Quantity: <span style="color:red">*</span></label>
											<input class="form-control" id="ex2" type="number" name="purches_quntity" placeholder="Ex. 500" required>
										</div>	
										<div class="col-xs-6">
											<label for="ex2">Purches Price (Per Unit): <span style="color:red">*</span></label>
											<input class="form-control" id="ex2" type="number" name="purches_price" placeholder="Ex. 500" required>
										</div>
										<div class="col-xs-6">
											<label for="ex2">Sale Price (Per Unit):: <span style="color:red">*</span></label>
											<input class="form-control" id="ex2" type="number" name="unite_price" placeholder="Ex. 500" required>
										</div>
										<div class="col-xs-6">
											<label for="ex2">Discount: <span style="color:red">*</span></label>
											<input class="form-control" id="ex2" type="number" name="discount" placeholder="Ex. 10" required>
										</div>					  
									  <div class="col-xs-12">
										<label for="ex2">Discription: </label>
										<textarea class="form-control" rows="2" id="ex2" name="product_description" type="text"> </textarea> 
									  </div>
									  
							</div> 
							 <div class="col-xs-3 margin_top">							
								<input class="form-control btn btn-info" id="ex2" name="submit" type="submit" value="Save Entry">
							 </div>
							 <div class="col-xs-3 margin_top">							
								<a href="new_purches.php" class="form-control btn btn-success">New Item</a>								
							 </div>						 
						 </form>
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
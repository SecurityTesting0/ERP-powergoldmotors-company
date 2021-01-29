
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					
					<div class="form-group from_border">
					
					<?php 
						if(isset($_POST["submit"])){	
							
							$product_code			=$fm->validation($_POST['product_code']);
							$product_name			=$fm->validation($_POST['product_name']);
							$product_cat_id			=$fm->validation($_POST['catagory']);
							$brand_id				=$fm->validation($_POST['brand_name']);
							$unite_price			=$fm->validation($_POST['unite_price']);
							$discount				=$fm->validation($_POST['discount']);
							$status					=$fm->validation($_POST['status']);
							$discription			=$fm->validation($_POST['discription']);
					
							
							$prodcut_code			=mysqli_real_escape_string($db->link,$prodcut_code);
							$product_name			=mysqli_real_escape_string($db->link,$product_name);
							$catagory				=mysqli_real_escape_string($db->link,$catagory);
							$brand_id				=mysqli_real_escape_string($db->link,$brand_id);
							$unite_price			=mysqli_real_escape_string($db->link,$unite_price);
							$discount				=mysqli_real_escape_string($db->link,$discount);
							$status					=mysqli_real_escape_string($db->link,$status);
							$discription			=mysqli_real_escape_string($db->link,$discription);
					
							
														
							$sql ="INSERT INTO product_table(product_code,product_name,product_cat_id,brand_id,unite_price,discount, status, description)
							values('$product_code','$product_name','$product_cat_id','$brand_id','$unite_price','$discount','$status','$discription'); 
							";
							$results=$db->insert($sql);
							if($results==true){ ?> 
									<div class="alert alert-success">
									  <strong>Product Added Successfully</strong>
									</div>
							<?php 
								 						
							} 							
						} 							
					?>
					
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;"> 
						 Add New Product</span></h4>
						  <form action="" method ="post" enctype="">
						  <div class="col-xs-6">
								<label for="ex2">Product Code. <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="number" name="product_code" Placeholder="Ex. 001" required>
							</div>
							<div class="col-xs-6">
								<label for="ex2">Product Name. <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="product_name" Placeholder="Ex. Motor" required>
							</div>
							 
							 <div class="col-xs-6">
								<div class="form-group">
								  <label>Select Catagory.</label>
								  <div class="select2-purple">
									<select class="select2" name="catagory" multiple="multiple" 
									data-placeholder="Type Product Code" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
									  <?php		
										$query="SELECT * FROM product_catagory";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($catid=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $catid['id'];?> " >
									  
									<?php echo $catid['name']; ?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
									  
									  
									</select>
								  </div>
								</div>
								<!-- /.form-group -->
							  </div> 
							  <div class="col-xs-6">
								<div class="form-group">
								  <label>Brand Name</label>
								  <div class="select2-purple">
									<select class="select2" name="brand_name" multiple="multiple" 
									data-placeholder="Type Brand Name" data-dropdown-css-class="select2-purple" style="width: 100%;" >
									  
									 <?php		
										$query="SELECT * FROM brand_name";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($brid=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $brid['id'];?> " >
									  
									<?php echo $brid['name']; ?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
									  
									  
									</select>
								  </div>
								</div>
								<!-- /.form-group -->
							  </div>  
								 	
								<div class="col-xs-6">
									<label for="ex2">Unit Price: <span style="color:red">*</span></label>
									<input class="form-control" id="ex2" type="number" name="unite_price" placeholder="500" required>
								</div>	
								<div class="col-xs-6">
									<label for="ex2">Discount: </label>
									<input class="form-control" id="ex2" type="number" name="discount" placeholder="500" >
								</div>	
								<div class="col-xs-6">
									<label for="ex2"> Status<span style="color:red">*</span></label>
									<select class="form-control" name="status">
										<option value="">Select</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									
									</select>
								</div>					  
							  <div class="col-xs-12">
								<label for="ex2">Product Discription: </label>
								<textarea class="form-control" rows="2" id="ex2" name="discription" type="text"> </textarea> 
							  </div>
							  
							 <div class="col-xs-3 margin_top">							
								<input class="form-control btn btn-info" id="ex2" name="submit" type="submit" value="Save Entry">
							 </div>
							 <div class="col-xs-3 margin_top">							
								<a href="new_product.php" class="form-control btn btn-success" >Add New</a> 
							 </div>						 
						 </form>
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
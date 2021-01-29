
<?php include("inc/header.php"); ?> 

<?php 
		if (empty($_GET['id'])){
		}elseif(!isset($_GET['id']) || $_GET['id'] == NULL){
			echo 'Something went to wrong';
		}else{
				$tid= $_GET['id'];
				$id= preg_replace("/[^0-9a-zA-Z]/", "", $tid);
				$rid = $id;
		}
?>
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
					
							
														
							$sql ="UPDATE product_table SET 
							product_code 		='$product_code',
							product_name		='$product_name',
							product_cat_id		='$product_cat_id',
							brand_id			='$brand_id',
							unite_price			='$unite_price',
							discount			='$discount',
							status				='$status',
							description			='$discription'
							where id =$rid; 
							";
							$results=$db->insert($sql);
							if($results==true){ ?> 
									<div class="alert alert-success">
									  <strong>Product updated Successfully</strong>
									</div>
							<?php 
								 						
							} 							
						} 							
					?>
					
					<?php 
						$query ="SELECT * from product_table where id=$rid";
						$results=$db->select($query);
						if($results==true){ 
							while ($rs=$results->fetch_assoc()){
								
							
						?> 
						
						
					
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;"> 
						 Add New Product</span></h4>
						  <form action="" method ="post" enctype="">
						  <div class="col-xs-6">
								<label for="ex2">Product Code. <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="number" name="product_code" value="<?php echo $rs['product_code'];?>" required>
							</div>
							<div class="col-xs-6">
								<label for="ex2">Product Name. <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="product_name" value="<?php echo $rs['product_name'];?>" required>
							</div>
							 
							 <div class="col-xs-6">
								<div class="form-group">
								  <label>Select Catagory.</label>
								  <div class="select2-purple">
									<select class="select2" name="catagory" multiple="multiple" 
									data-placeholder="Type Product Code" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
									  
									  <?php		
										$catid=$rs['product_cat_id']; 
										
										$catqu="SELECT * FROM product_catagory where id='$catid'";
										$resultscat=$db->select($catqu);
										$id=0; 
										if ($resultscat){	
										?>
										
										<?php
										while($showcatname=$resultscat->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $showcatname['id'];?>" selected>
									  
									<?php echo $showcatname['name']; ?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
										
										
										
										
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
										$brandid=$rs['brand_id']; 
										
										$brqu="SELECT * FROM brand_name where id='$brandid'";
										$resultsbr=$db->select($brqu);
										$id=0; 
										if ($resultsbr){	
										?>
										
										<?php
										while($showbrname=$resultsbr->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $showbrname['id'];?>" selected>
									  
									<?php echo $showbrname['name']; ?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
										
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
									<input class="form-control" id="ex2" type="number" name="unite_price" value="<?php echo $rs['unite_price'];?>"required>
								</div>	
								<div class="col-xs-6">
									<label for="ex2">Discount: </label>
									<input class="form-control" id="ex2" type="number" name="discount" value="<?php echo $rs['discount'];?>" >
								</div>	
								<div class="col-xs-6">
									<label for="ex2"> Status<span style="color:red">*</span></label>
									<select class="form-control" name="status">
									 <?php		
										$stid=$rs['status'];
										if ($stid==1){	
										?>	
										<option value="1">Active</option>
										<?php }else{ ?>
										<option value="0">Inactive</option>
										<?php } ?>
										
										<option value="">Select</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									
									</select>
								</div>					  
							  <div class="col-xs-12">
								<label for="ex2">Product Discription: </label>
								<textarea class="form-control" rows="2" id="ex2" name="discription" type="text"><?php echo $rs['description'];?></textarea> 
							  </div>
							  
							 <div class="col-xs-3 margin_top">							
								<input class="form-control btn btn-info" id="ex2" name="submit" type="submit" value="Update Product">
							 </div>
							 <div class="col-xs-3 margin_top">							
								<a href="new_product.php" class="form-control btn btn-success" >Add New</a> 
							 </div>						 
						 </form>
						 
						<?php }}else{
							echo "Something Problem"; 
						} ?>
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
<?php include("inc/header.php"); ?> 

		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<?php 
						if(isset($_POST["submit"])){
							
							$ac					=$fm->validation($_POST['ac']);
							$first_name			=$fm->validation($_POST['first_name']);
							$last_name			=$fm->validation($_POST['last_name']);
							$mobile_number		=$fm->validation($_POST['mobile_number']);
							$location_id		=$fm->validation($_POST['location_id']);							
							$store_name			=$fm->validation($_POST['store_name']);
							$Address			=$fm->validation($_POST['Address']);
							$membership_date	=$fm->validation($_POST['membership_date']);					
							$status				=$fm->validation($_POST['status']);
					
							
							
							$member_code		=mysqli_real_escape_string($db->link,$member_code);
							$first_name			=mysqli_real_escape_string($db->link,$first_name);
							$last_name			=mysqli_real_escape_string($db->link,$last_name);
							$mobile_number		=mysqli_real_escape_string($db->link,$mobile_number);
							$location_id		=mysqli_real_escape_string($db->link,$location_id);
							$store_name			=mysqli_real_escape_string($db->link,$store_name);
							$Address			=mysqli_real_escape_string($db->link,$Address);
							$membership_date	=mysqli_real_escape_string($db->link,$membership_date);
							$status				=mysqli_real_escape_string($db->link,$status);
						
							
							$chk="SELECT * FROM `distributor` WHERE `ac` LIKE '%$ac%'";
							$check=$db->select($chk);
							if(($check->num_rows)>0){
								echo "<script type='text/javascript'>alert('Distributor ID Already Exist')</script>";
							}else{
								$query="INSERT INTO distributor(ac, first_name, last_name, mobile_number, 
								location_id, store_name, Address, membership_date, status) values 
								
								('$ac', '$first_name', '$last_name', '$mobile_number', 
								'$location_id', '$store_name', '$Address', '$membership_date', '$status')";
								
								$results=$db->insert($query);
								
								if($results==true){
									echo"<p class='well text-center' style='margin:0px auto; color:#fff;'>Distributor Added Succesfully</p>";
								}else{
									echo"You should be checked again";
								}
							}
						}
					?>
					<div class="form-group from_border_3">
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;">Add New Distributor </span></h4>
						  <form action="" method="post" enctype="">
							  <div class="col-xs-4">
								<label for="ex2">Distributor A/C: <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="ac" placeholder="Example: A001" required >
							  </div>	
							  <div class="col-xs-4">
								<label for="ex2">First Name <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="first_name"placeholder="Mridha Belal" required>
							  </div>
							  <div class="col-xs-4">
								<label for="ex3">Last Name <span style="color:red">*</span></label>
								<input class="form-control" id="ex3" type="text" name="last_name" placeholder="Hasnain" required>
							  </div>
							  <div class="col-xs-3">
								<label for="ex2">Mobile Number <span style="color:red">*</span> </label>
								<input class="form-control" id="ex2" type="text" name="mobile_number" placeholder="01719180080" required>
							  </div>
							    <div class="col-xs-3">
								<label for="ex2">Location: <span style="color:red">*</span></label>							
								  <select class="form-control" id="sel1" name="location_id" required>
									<option>Select</option>
									<?php		
										$query="SELECT * FROM distributor_location";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($location=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $location['id'];?> " >
									  
									<?php echo $location['name'];?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
									
																
								  </select>
							  </div>
							  <div class="col-xs-3" >
							  
								<label for="ex2">Membership Date <span style="color:red">*</span></label>									
								  <div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="membership_date">
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
							    <div class="col-xs-3">
								<label for="ex2">Store Name <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="store_name" placeholder="Aziz Store " required>
							  </div>
							  <div class="col-xs-12">
								<label for="ex2">Address </label>
								<textarea class="form-control" id="ex2" name="Address" type="text"> </textarea> 
							  </div>
							
							 <div class="col-xs-2 margin_top">							
								<input class="form-control btn btn-info" id="ex2" type="submit" name="submit" value="Add Member">
							 </div>
							 <div class="col-xs-2 margin_top">							
								<input class="form-control btn btn-warning" id="ex2" type="reset" value="Reset">
							 </div>
						 
							 
							 <div class="col-xs-3 margin_top">							
								<div class="form-check-inline">
								  <label class="form-check-label"> 
									<input type="radio" class="form-check-input" name="status" value="1" checked> Active 
									<input type="radio" class="form-check-input" name="status" value="0" > Inactive 
								  </label>
								</div>
							 </div>
							
						 </form>
						 
						 
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
	
		
<?php include("inc/footer.php"); ?> 
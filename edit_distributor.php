<?php include("inc/header.php"); 

?> 


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
						
							
							$query="UPDATE distributor SET 
								ac				='$ac', 
								first_name		='$first_name', 
								last_name		='$last_name', 
								mobile_number	='$mobile_number',  
								location_id		='$location_id',
								store_name		='$store_name', 
								Address			='$Address',
								membership_date	='$membership_date',
								status			='$status'					
								where 			id=$rid";								
								$results=$db->update($query);
								
								if($results==true){
									echo"<p class='well text-center' style='margin:0px auto; color:#fff;'>Distributor Info Update Succesfully</p>";
								}else{
									echo"You should be checked again";
								}
							}
					?>
		
					<?php
						$query ="SELECT * FROM distributor where id=$rid";
						   
						$results = $db->select($query);

						if ($results){?>
						<?php while ($rs = $results->fetch_assoc()) {

						?> 	
					<div class="form-group from_border_3">
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;">Add New Distributor </span></h4>
						  <form action="" method="post" enctype="">
							  <div class="col-xs-4">
								<label for="ex2">Distributor A/C: <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="ac" value="<?php echo $rs['ac']; ?>" required >
							  </div>	
							  <div class="col-xs-4">
								<label for="ex2">First Name <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="first_name"value="<?php echo $rs['first_name']; ?>"" required>
							  </div>
							  <div class="col-xs-4">
								<label for="ex3">Last Name <span style="color:red">*</span></label>
								<input class="form-control" id="ex3" type="text" name="last_name" value="<?php echo $rs['last_name']; ?>"" required>
							  </div>
							  <div class="col-xs-3">
								<label for="ex2">Mobile Number <span style="color:red">*</span> </label>
								<input class="form-control" id="ex2" type="text" name="mobile_number" value="<?php echo $rs['mobile_number']; ?>"" required>
							  </div>
							    <div class="col-xs-3">
								<label for="ex2">Location: <span style="color:red">*</span></label>							
								  <select class="form-control" id="sel1" name="location_id" required>
									<option>Select</option>
									<?php	
										$locationid=$rs['location_id'];
										
										$query="SELECT * FROM distributor_location where id=$locationid";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($location=$results->fetch_assoc()){
										$id++; 
										
										?>
										<option value="<?php echo $location['id'];?>" selected> 	<?php echo $location['name'];?></option>
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
										<input  type="text" class="form-control" name="membership_date" value="<?php echo $rs['membership_date'];?>" >
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
								<input class="form-control" id="ex2" type="text" name="store_name" value="<?php echo $rs['store_name'];?> " required>
							  </div>
							  
							  <div class="col-xs-6">
								<label for="ex2">Address </label>
								<textarea class="form-control" id="ex2" name="Address" type="text"><?php echo $rs['Address'];?> </textarea> 
							  </div>
							<div class="col-xs-6 margin_top">							
								<div class="form-check-inline">
								  <label class="form-check-label"> 
									<input type="radio" class="form-check-input" name="status" value="1" checked> Active 
									<input type="radio" class="form-check-input" name="status" value="0" > Inactive 
								  </label>
								</div>
							 </div>
							 <div class="col-xs-6 margin_top">							
								
							 </div>	 
							 <div class="col-xs-6 margin_top">							
								
							 </div>
							 <div class="col-xs-6 margin_top">							
								<input class="form-control btn btn-sm btn-info" id="ex2" type="submit" name="submit" value="Update Info">
							 </div>						 
							 
							
						 </form>
						 
						 
					</div>
					<?php } ?>
					<?php } ?>
			 </div>
		</section>
		<!-- End Main Area -->
	
		
<?php include("inc/footer.php"); ?> 
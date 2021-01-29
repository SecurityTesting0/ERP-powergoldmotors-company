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
					<?php 
						if(isset($_POST["submit"])){
							
							$Employee_id		=$fm->validation($_POST['Employee_id']);
							$First_Name			=$fm->validation($_POST['First_Name']);
							$Last_Name			=$fm->validation($_POST['Last_Name']);						
							$Desigination		=$fm->validation($_POST['Desigination']);
							$DOB				=$fm->validation($_POST['DOB']);
							$Joining_Date		=$fm->validation($_POST['Joining_Date']);
							$Mobile_number		=$fm->validation($_POST['Mobile_number']);
							$edu_qulification	=$fm->validation($_POST['edu_qulification']);
							$Address			=$fm->validation($_POST['Address']);
							$Salary				=$fm->validation($_POST['Salary']);
							$Status_employee	=$fm->validation($_POST['Status_employee']);
							
							$Employee_id		=mysqli_real_escape_string($db->link,$Employee_id);
							$First_Name			=mysqli_real_escape_string($db->link,$First_Name);
							$Last_Name			=mysqli_real_escape_string($db->link,$Last_Name);
							$Desigination		=mysqli_real_escape_string($db->link,$Desigination);
							$DOB				=mysqli_real_escape_string($db->link,$DOB);
							$Joining_Date		=mysqli_real_escape_string($db->link,$Joining_Date);
							$Mobile_number		=mysqli_real_escape_string($db->link,$Mobile_number);
							$edu_qulification	=mysqli_real_escape_string($db->link,$edu_qulification);
							$Address			=mysqli_real_escape_string($db->link,$Address);
							$Salary				=mysqli_real_escape_string($db->link,$Salary);
							$Status_employee	=mysqli_real_escape_string($db->link,$Status_employee);
							
							$query="Update `employee` SET 
							`Employee_id`		='$Employee_id', 
							`First_Name`		='$First_Name', 
							`Last_Name`			='$Last_Name', 
							`Desigination`		='$Desigination', 
							`DOB`				='$DOB', 
							`Joining_Date`		='$Joining_Date', 
							`Mobile_number`		='$Mobile_number', 
							`edu_qulification`	='$edu_qulification',
							`Address`			='$Address', 
							`Salary`			='$Salary', 
							`Status_employee`	='$Status_employee'
							 where id			=$rid"; 
							
							$results=$db->update($query);
							
							if($results==true){
								echo"<div class='bg-success' style='padding:5px; text-align:center; margin-bottom:20px;'>
								<p> Information Successfully Updated</p>
								<p> <a href='employee_list.php'>Click to view</a></p>
			
								</div>";
							}else{
								echo"You should be checked again";
							}
						  }
						
						
					?>
					
					<?php
						$query ="SELECT * FROM employee where id=$rid";
						   
						$results = $db->select($query);

						if ($results){?>
						<?php while ($rs = $results->fetch_assoc()) {

						?> 	
					<div class="form-group from_border_3">
						<h4 class="well text-center"><span style="color:red; font-weight:bold;">Update</span> <span style="color:green; font-weight:bold;"> Employee Information </span></h4>
						  <form action="" method="post" enctype="">
							  <div class="col-xs-2">
								<label for="ex2">Employee ID <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="Employee_id" value="<?php echo $rs['Employee_id']; ?>" required >
							  </div>
							 
							  <div class="col-xs-4">
								<label for="ex2">First Name <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="First_Name"value="<?php echo $rs['First_Name']; ?>" required>
							  </div>
							  <div class="col-xs-4">
								<label for="ex3">Last Name <span style="color:red">*</span></label>
								<input class="form-control" id="ex3" type="text" name="Last_Name" value="<?php echo $rs['Last_Name']; ?>" required>
							  </div>
							   <div class="col-xs-2">
								<label for="ex2">Desigination: <span style="color:red">*</span></label>							
								  <select class="form-control" id="sel1" name="Desigination" required>									
									<option value="<?php echo $rs['Desigination']; ?>" active><?php echo $rs['Desigination']; ?></option>
									<option value="Imam">		Imam</option>
									<option value="Mowazzin">	Mowazzin </option>									
									<option value="Khadem">		Khadem </option>									
								  </select>
							  </div>
							  <div class="col-xs-3" >
								<label for="ex2">DOB<span style="color:red">*</span></label>									
								  <div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="DOB" value="<?php echo $rs['DOB']; ?>" required>
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
							  <div class="col-xs-3" >
								<label for="ex2">Joining Date<span style="color:red">*</span></label>									
								  <div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="Joining_Date" value="<?php echo $rs['Joining_Date']; ?>" required>
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
								<label for="ex2">Mobile Number <span style="color:red">*</span> </label>
								<input class="form-control" id="ex2" type="text" name="Mobile_number" value="<?php echo $rs['Mobile_number']; ?>" required>
							  </div>
							   <div class="col-xs-3">
								<label for="ex2">Edu. Quli.: <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="edu_qulification" value="<?php echo $rs['edu_qulification']; ?>" required>
							  </div>
							  <div class="col-xs-12">
								<label for="ex2">Address </label>
								<textarea class="form-control" id="ex2" name="Address" type="text"><?php echo $rs['Address']; ?></textarea> 
							  </div>
							 <div class="col-xs-4 margin_top">							
								<input class="form-control btn btn-success" id="ex2" type="submit" name="submit" value="Update Information">
							 </div>
							 
							 <div class="col-xs-1">
							
						 	 </div>
							 <div class="col-xs-3">
								<div class="form-check-inline">
								  <label class="form-check-label">
									<br />
									<input type="radio" class="form-check-input" name="Status_employee" value="1" checked> Active 
									<input type="radio" class="form-check-input" name="Status_employee" value="0" > Inactive 
								  </label>
								</div>
						 	 </div>
							  
							  <div class="col-xs-3">
								<label for="ex2">Salary: <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="Salary" Value="<?php echo $rs['Salary']; ?> " required>
							  </div>
						 
						 </form>
						 
						<?php } ?> 	
						<?php } ?> 	
						 
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
	
		
<?php include("inc/footer.php"); ?> 
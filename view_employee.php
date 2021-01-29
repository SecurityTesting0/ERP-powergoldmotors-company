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
						$query ="SELECT * FROM employee where id=$rid";
						   
						$results = $db->select($query);

						if ($results){?>
						<?php while ($rs = $results->fetch_assoc()) {

						?> 	
					<div class="form-group from_border">
						<h4 class="well text-center"><span style="color:red; font-weight:bold;">Employee</span> <span style="color:green; font-weight:bold;"> Details Information </span></h4>
						
								
								<td></td>
								<td></td>
								<td> </td>
								<td> </td>
								<td></td>
						  
						  <form action="" enctype="">
							  <div class="col-xs-6 bg-danger">
								<label for="ex2">Employee ID</label>
								<p><?php echo $rs['Employee_id']; ?></p>
							  </div>
							  <div class="col-xs-6 bg-danger">
								<label for="ex2">Desigination</label>
								<p><?php echo $rs['Desigination']; ?></p>
							  </div>
							  <div class="col-xs-6 bg-success">
								<label for="ex2">First Name</label>
								<p><?php echo $rs['First_Name']; ?><p>
							  </div>
							  <div class="col-xs-6 bg-success">
								<label for="ex3">Last Name</label>
								<p><?php echo $rs['Last_Name']; ?></p>
							  </div>
							  <div class="col-xs-6 bg-danger">
								<label for="ex2">Mobile Number </label>
								<p><?php echo $rs['Mobile_number']; ?></p>
							  </div>
							  <div class="col-xs-6 bg-danger">
								<label for="ex2"> Date of Birth </label>
								<p><?php echo $rs['DOB']; ?></p>
							  </div>
							  <div class="col-xs-6 bg-success">
								<label for="ex2">Joining Date </label>
								<p><?php echo $rs['Joining_Date']; ?></p>
							  </div>
							  <div class="col-xs-6 bg-success">
								<label for="ex2">Address </label>
								<p><?php echo $rs['Address']; ?></p>
							  </div>
							  <div class="col-xs-6 bg-danger">
								<label for="ex2"> Salary </label>
								<p><?php echo $rs['Salary']; ?></p>
							  </div>
							  <div class="col-xs-6 bg-danger">
								<label for="ex2"> Status </label>
								<p><?php 
								
								$status =$rs['Salary'];
									if ($status=1){
										echo "Active";
									}else{
										echo "Inactive";
									}
								
								
								?></p>
							  </div>
							
							 <div class="col-xs-3 margin_top">							
								<a href="delete_employee.php?id='<?php echo $rs['id']; ?>'" class="form-control btn btn-danger" id="ex2" type="submit"> Delete Employee </a> 
							 </div>	
							 <div class="col-xs-3 margin_top">							
								<a href="edit_employee.php?id='<?php echo $rs['id']; ?>'" class="form-control btn btn-success" 
								id="ex2" type="submit">Edit Information </a>
							 </div>						
						 
						 </form>
					</div> 
						<?php } ?> 
						<?php } ?> 
					
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
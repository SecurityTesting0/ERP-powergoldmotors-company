<?php include("inc/header.php");
error_reporting(0); 
 ?> 
		<!-- Main Area -->
		<section class="main_area main_area_text">
			 <div class="container">
				<div class="row">



	
					<?php 
				
				
						if(isset($_POST["submit"])){
								$dm=date("Y-m");
								$chk="SELECT * FROM `salary_payment` WHERE `gn_date` LIKE '$dm%'";
								$check=$db->select($chk);
								if(($check->num_rows)>0){
									echo "<script type='text/javascript'>alert('Already Generated!')</script>";
								}else{
								
								$query ="SELECT Employee_id, Salary from employee where Status_employee=1";
								$results=$db->select($query);
								while($data=$results->fetch_assoc()){
									$salary			=$data['Salary'];
									$em_id			=$data['Employee_id'];
									
									//$chk="";
									$ins="INSERT INTO `salary_payment`(`Employee_id`, `salary_amount`, 
									`advanced_payment`, `gn_date`, `invoice_date`) values 
									('$em_id','$salary','0',current_date(),current_date())";
									$insdata=$db->insert($ins);
									
								}
								if ($insdata) {
										echo "<script type='text/javascript'>alert('Salary Successfully Generated')</script> ";
									}
								
							}
						}
					?>
				
					<div class="col-md-12">
							<div class="generate"> 
								<h3>Generate Employee Salary</h3>
								<form action="" method="post">
									<div class="col-xs-12 margin_top">							
										<input class="form-control btn btn-success" id="ex2" name="submit" type="submit" value="Click to Generate Salary">
									</div>						
								</form>
							</div>
					</div>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		

<?php include("inc/footer.php"); ?> 
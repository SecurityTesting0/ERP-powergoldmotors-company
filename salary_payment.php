<?php include("inc/header.php"); ?>  
	

		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				
				<div class="row">
				<div class="col-sm-12 text-center">
				
					<h4 class="text-center"> <span style="color:green; font-weight:bold;">Payment Employees Salary</h4>  
				
<?php
	/*class salary {
		public function PaymentSalary($em_id, $salary= array()){
				$date =date("Y-m");
				$getdata="SELECT DISTINCT gn_date FROM salary_payment";
				$check=$db->select($getdata);
				if ($check){	
					while($ck=$check->fetch_assoc()){
						$crsdate =$ch['gn_date']; 
						if ($date==$crsdate ){
							$msg="<span class='bg-danger'> Salary Already Generated</span>";
							return $msg; 
						}
					}
				}
			}

		}*/

?> 

					<?php	
						if(isset($_POST["submit"])){
							$em_id		=$fm->validation($_POST['em_id']);	
							$salary		=$fm->validation($_POST['salary']);	
								
							$em_id		=mysqli_real_escape_string($db->link,$em_id);
							$salary		=mysqli_real_escape_string($db->link,$salary);
							$dm=date("Y-m");
							$chk="SELECT * FROM `salary_payment` WHERE `gn_date` LIKE '$dm%' ";
							$check=$db->select($chk);
							if(($check->num_rows)>0){
								echo "Already Generated!";
							}else{		
								
								$query ="INSERT INTO `salary_payment`(`Employee_id`, `salary_amount`, 
								`advanced_payment`, `gn_date`, `invoice_date`) values ('$em_id','$salary','0',current_date(),current_date())";
								
								$results=$db->insert($query);
								if($results==true){
									echo"<p class='well text-center' style='margin:0px auto; color:green;'>Head Successfully Added</p>";
								}else{
									echo"You should be checked again";
								}
							}
						}
					?>
					<form action="" method="post">
					<table id="example" class="display" style="width:95%;">
						<thead>
							<tr>
								<th>S.L </th>
								<th>Em.Id</th>
								<th>Name</th>
								<th>Desigination</th>
								<th>Mobile</th>
								<th>Quilification</th>
								<th>Salary</th>
							</tr>
						</thead>
						<tbody>
							<?php	
							$query="SELECT * FROM `employee` where Status_employee=1";
							$results=$db->select($query);
							$id=0; 
								if ($results){	
								while($rs=$results->fetch_assoc()){
								$id++;
						
							?>
							<tr>
								<td><?php echo $id; ?></td>	
								<td>
								<?php echo $rs['Employee_id']; ?>
								<input type="hidden" name="em_id" value="<?php echo $rs['Employee_id']; ?>" />
								</td>
								<td><?php echo $rs['First_Name'].' '.$rs['Last_Name']; ?></td>
								<td><?php echo $rs['Desigination']; ?> </td>
								<td><?php echo $rs['Mobile_number']; ?> </td>
								<td><?php echo $rs['edu_qulification']; ?></td>
								<td><input type="text" name="salary" value="<?php echo $rs['Salary']; ?>" /></td>
							</tr>
							
							<?php }?>
							<?php }?>	
							
						</tbody>
					</table>
					<input type="submit" class="btn btn-success"  name="submit" value="Generate Salary"/> <br />
					</form> 
							
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
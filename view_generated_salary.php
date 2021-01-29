<?php include("inc/header.php"); ?>  
	

		<!-- Main Area -->
		<section class="add_new_member pading_margn">
			 <div class="container">
				
				<div class="row">
				<div class="col-sm-12">
				
					<h4 class="text-center"> <span style="color:green; font-weight:bold;"> Employees 
					</span><span style="color:red;font-weight:bold;">Genereted Salary </span> </h4>  
					
					
					<table id="example" class="display table table-hover table-bordered table-striped table-responsive" style="width:98%;">
						<thead>
							<tr class="bg-success">
								<th>S.L </th>
								<th>Em.Id</th>
								<th>Name</th>
								<th>Desigination</th> 
								<th>Invoice Date</th> 
								<th>Paymented Salary</th>
								
								<!--<th>Action</th>-->
								
							
								
							</tr>
						</thead>
						<tbody>
						<?php	
						$query="SELECT * FROM `salary_payment`";

						$results=$db->select($query);
						$id=1; 
						if ($results){ 
							while($rs=$results->fetch_assoc()){
							
							$emid=$rs['Employee_id'];
							$id++;
						
							?>
							<tr>
								<td><?php echo $id; ?></td>	
								<td><?php echo $rs['Employee_id']; ?></td>
											
											<?php 
												
												$query="SELECT * FROM `employee`";
												$res=$db->select($query);
												$id=0; 
												if ($res){
												while($emr=$res->fetch_assoc()){
													$emidcx=$emr['Employee_id'];
													if ($emidcx==$emid) {
												
											?>
												<td><?php echo $emr['First_Name'].' '.$emr['Last_Name']; ?></td>								
												<td><?php echo $emr['Desigination']; ?> </td> 
											
											<?php }?> 
											<?php }?> 
											<?php }?> 
								
								
								<td><?php echo $rs['invoice_date']; ?></td>
								<td><?php echo $rs['salary_amount']; ?>.00</td>
								<!--<td> 
								<a href=".php?id='<?php echo $rs['id'];?>'" class="btn btn-warning"> Edit</a>
								</td>-->
									
							</tr>							
							<?php }?>
							<?php }?>	
							
						</tbody>
					</table>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
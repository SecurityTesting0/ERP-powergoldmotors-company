<?php include("inc/header.php"); ?>  
	

		<!-- Main Area -->
		<section class="add_new_member pading_margn">
			 <div class="container">
				
				<div class="row">
				<div class="col-sm-12">
				
					<h4 class="text-center"> <span style="color:green; font-weight:bold;">All Active Employees 
					</span><span style="color:red;font-weight:bold;">Details Information </span> </h4>  
					
					<?php	
						//retrive 3 table data in this query and show by month
						
						$query="SELECT * FROM `employee` where Status_employee=1";

						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
					<table id="example" class="display table-hover table table-bordered table-striped table-reponsive" style="width:98%;">
						<thead>
							<tr class="bg-success">
								<th>S.L </th>
								<th>Em.Id</th>
								<th>Name</th>
								<th>Desigination</th>
								<th>Mobile</th>
								<th>Quilification</th>
								<th>Salary</th>
								<th>Action</th>
								
							
								
							</tr>
						</thead>
						<tbody>
							<?php
							
							while($rs=$results->fetch_assoc()){
							$id++;
						
							?>
							<tr>
								<td><?php echo $id; ?></td>	
								<td><?php echo $rs['Employee_id']; ?></td>
								<td><?php echo $rs['First_Name'].' '.$rs['Last_Name']; ?></td>
								<td><?php echo $rs['Desigination']; ?> </td>
								<td><?php echo $rs['Mobile_number']; ?> </td>
								<td><?php echo $rs['edu_qulification']; ?></td>
								<td><?php echo $rs['Salary']; ?>.00</td>
								<td>
								<a href="view_employee.php?id='<?php echo $rs['id'];?>'" class="btn btn-success"> View</a>
								<a href="edit_employee.php?id='<?php echo $rs['id'];?>'" class="btn btn-warning"> Edit</a>
								</td>
									
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
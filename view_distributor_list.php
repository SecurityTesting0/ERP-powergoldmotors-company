<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member pading_margn">
			 <div class="container">
				<div class="row">
					<div class="col-xs-12">
					<div class="from_border_3">
					<h3 class="well text-center"> All Distributor List</h3>
						<table id="example" class=" table table-hover table-striped table-bordered table-responsive " style="width:98%;">
						
							
							<thead>
								<tr class="bg-info">
									<th>A/C</th>								
									<th>Name</th>								
									<th>Store Name</th>
									<th>Mobile</th> 
									<th>Location</th>
									<th>Status</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
								<?php		
								$query="SELECT * FROM distributor where status=1";
								$results=$db->select($query);
								$id=0; 
								if ($results){	
								?>
								<?php
								while($rs=$results->fetch_assoc()){
								$id++; 						
								?>
								<tr>
									<td><?php echo $rs['ac']; ?></td>							
									<td>
									<?php echo $rs['first_name'].' '.$rs['last_name']; ?></td>
									<td><?php echo $rs['store_name']; ?></td>
									<td><?php echo $rs['mobile_number']; ?></td> 
									
									<td>
									<?php 
										$status=$rs['location_id']; 
										$query2="SELECT * FROM distributor_location where id='$status'";
										$results2=$db->select($query2);
										$id=0; 
										if ($results2==true){
												while($location_res=$results2->fetch_assoc()){
														echo $location_res['name'];; 
												}
										}
									?>  
									</td>	
									<td>
									<?php 
										$status=$rs['status']; 
										if($status==1) {
											echo"<p style='color:green; font-weight:bold;'>Active</p>"; 
										}else{
											echo "<p style='color:red;font-weight:bold;'>Inactive</p>"; 
										}
										?>  
									</td>
									
									<td>
									<?php 
										if($Status==1){
										
									?> 
									<a href="edit_distributor.php?id='<?php echo $rs['id']; ?>'" class="btn btn-warning">Edit</a>|
									<?php }?>
									<a href="view_distributor_details.php?id='<?php echo $rs['id']; ?>" class="btn btn-success">Details</a></td>								
								</tr>	
								
								<?php }?>
								<?php }else{ ?>
								<div class="bg-danger">
									 <p style='text-align:center;'>No Members Data Found!</p>
									 
								</div>
								
								<?php } 
								
								
								?>
								
								
							</tbody>
						
						</table>
					
						</div>
					</div>
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
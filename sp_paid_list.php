<?php include("inc/header.php"); 
error_reporting(0); 
?> 



<?php 

	if (empty($_GET['sppid'])){
		}elseif(!isset($_GET['sppid']) || $_GET['sppid'] == NULL){
			echo 'Something went to wrong';
		}else{
				$tid= $_GET['sppid']; 				
				$id= preg_replace("/[^0-9a-zA-Z]/", "", $tid);
				$rid = $id;
				$year= substr($id, 0, 4);
				$month=substr($id, 4, 6);
				$date=$year.'-'.$month;
		}
?>
 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<h3 class="text-center"> Current Month Shops Paid List</h3>
		
					<table id="example" class="display table-hover table table-striped table-responsive table-bordered" style="width:100%;">
						<thead>
							<tr class="bg-success">
								<th>A/C No.</th>								
								<th>Name</th>								
								 
								<th>Payment Date</th>
								<th>Paid Amount</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody> 
							<?php	  
								$query ="SELECT* from shop_rent where invoice_date like '$date%'"; 
								$results=$db->select($query); 
								$id=0;
								if ($results){
									while($rs=$results->fetch_assoc()){ 
									$mmid=$rs['shop_id']; 
								?>  
								
									<tr>
										<td><?php echo $rs['shop_id'];?> </td>
										<?php 
											$query2 ="SELECT* from masjid_property where Property_id='$mmid'"; 
											$results2=$db->select($query2); 
											$id=0;
											if ($results2){
												while($rs2=$results2->fetch_assoc()){ 
												
										?>
										
										<td> <?php  echo $rs2['rent_t_name']; ?> </td> 
										 
										<?php }}?> 
										
										<td><?php echo $rs['invoice_date'];	?> </td>
										<td><?php echo $rs['credit_amount'];	?> </td>
										<td><span class="bg-success">Paid</span></td>
									</tr>
								
									
					</div>
						<?php }?> 
						<?php }?> 
						
						</tbody>
						 
					</table>
						
					
					
				</div>

		</section>  

		</div>
		
<?php include("inc/footer.php"); ?> 
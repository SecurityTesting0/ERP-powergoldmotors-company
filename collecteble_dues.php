<?php include("inc/header.php"); 
error_reporting(0); 
?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<div class="from_border_3">
						<h3 class="text-center well" style="color:#fff;"> Collectable Distributor Dues List Upto <?php  echo $date=date("Y-m-d"); ?></h3>
			
						<table id="example" class="display table-hover table table-striped table-responsive table-bordered" style=" width:95%;">
							<thead>
								<tr class="bg-info">
									<th>A/C No.</th>								
									<th>Name</th>								
									<th>Address</th>
									<th>Due Amount</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody> 
							<?php	 
								$chk="SELECT * FROM distributor"; 
									$check=$db->select($chk);
									
									if($check){
									while ($chrs=$check->fetch_assoc()){
									$did=$chrs['ac'];
								
									$query ="SELECT SUM(invoice_total) debit,SUM(amount_paid) credit FROM `invoices` WHERE distributor_id='$did'"; 
									$results=$db->select($query); 
									$id=0;
									if ($results){
								
									?> 
									<?php 
										
										while($rs=$results->fetch_assoc()) {
										$id++;
										 $dbt=$rs['debit'];
										 $crt=$rs['credit'];
										 $dbtcrtres =$dbt-$crt;
										 if ($dbtcrtres>1) {  
									?> 
										<tr>
											<td><?php echo $chrs['ac'];?> </td>
											<td> <?php echo $chrs['first_name'].' '.$chrs['last_name'];?> </td>
											<td><?php echo $chrs['Address'];?> </td>
											<td><?php echo number_format((float)$dbtcrtres, 2, '.', ','); ?> </td>
											<td><span class="bg-danger">Unpaid</span></td>
										</tr>
									
										
						</div>
							<?php }?>
									 
							<?php }?> 
							<?php }?> 
							<?php }?> 
							<?php }?> 	
							
							</tbody>
							 
						</table>
						
					</div>	
					
				</div>

		</section> 
<?php include("inc/footer.php"); ?> 
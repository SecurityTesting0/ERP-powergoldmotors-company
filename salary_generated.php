<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<h3 class="text-center"> Staff Salary </h3>
					
					<?php		
						$query="SELECT * FROM members INNER JOIN subscription_fees ON members.member_code=subscription_fees.member_code ";
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
					<table id="example" class="display" style="width:95%;">
						<thead>
							<tr>
								<th>A/C No.</th>								
								<th>Name</th>								
								<th>Members Type</th>
								<th>Payment Amount</th>
								<th>Status</th>
								<th>Action</th>								
							</tr>
						</thead>
						<tbody>
							<?php
							
							
							while($rs=$results->fetch_assoc()){
							$id++; 						
							?>
							<tr>
								<td><?php echo $rs['member_code']; ?></td>							
								<td> <?php echo $rs['First_name'].' '.$rs['Last_name']; ?></td>							
								<td><?php echo $rs['type']; ?></td>
								<td><?php echo $rs['payment_amount']; ?> </td>
								<td><span class="bg-success">Paid</span></td>								
								<td><a href="" class="btn btn-success">Details</a></td>								
							</tr>
							
							<?php }?>
							<?php }?>
						</tbody>
						<tfoot>
						<?php		
						$query="SELECT  SUM(payment_amount) as sum FROM subscription_fees";
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
						<?php
							while($rs=$results->fetch_assoc()){
							$id++; 						
							?>
							<tr>
								<th colspan="3" style="text-align:right;">Total =</th>
								<th><?php echo $rs['sum']; ?> </th>
								<th></th>
							</tr>
							<?php }?>
							<?php }?>
							
						</tfoot>
					</table>
					
					
				</div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
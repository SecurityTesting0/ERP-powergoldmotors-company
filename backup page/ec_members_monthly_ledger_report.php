<?php include("inc/header.php"); ?>  
	

<?php
error_reporting(0);
	if (isset($_POST['submit'])){
		$from 	= $_POST['from'];
		$to 	= $_POST['to'];
	}else{
		echo"No Data Found";
	}

?>
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				
				<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
				
					<h3 class="text-center"> <span style="text-align:center; color:green; font-weight:bold;">All Members Monthly Ledger</span> </h3>
					<br />
					<h4 style="text-align:center; font-weight:bold;">
					<span style="text-align:center; color:red; font-weight:bold;">From:</span> <?php echo $from; ?> 
					<span style="text-align:center; color:red; font-weight:bold;"> To: </span><?php echo $to; ?>
					</h4>
					
					
					<?php	
											
						$query="SELECT * FROM `ecms_fees` where invoice_date>= '$from' and invoice_date<= '$to' ";						
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
					<table id="example" class="display" style="width:95%;">
						<thead>
							<tr>
								<th>S.L</th>
								<th>Member A/C</th>
								<th>Invoice Date</th>
								<th>Narration</th>
								<th>Debit</th>
								<th>Credit</th>
								<th>Balance</th>
							</tr>
						</thead>
						<tbody>
							<?php
							
							
							while($rs=$results->fetch_assoc()){
							$id++;
						
							?>	 			 							
							<tr>
								<td><?php echo $id; ?></td>	
								<td><?php echo $rs['members_id']; ?> </td>
								<td><?php echo $rs['invoice_date']; ?> </td>
								<td><?php echo $rs['narration']; ?> </td>
								<td><?php echo $rs['debit_amount'] ; ?>.00</td> 
								<td><?php echo $rs['credit_amount'] ; ?>.00</td> 								
								<td><?php echo $rs['blance']; ?>.00 </td>
							</tr>
							</form> 
							
							<?php }?>
							<?php } else{?>
							<div class="well text-center"> <h3> No Data Found</h3></div>
							<?php }  ?>							
						
							
							
						</tbody>
						<tfoot>
						<?php		
						$query="SELECT SUM(debit_amount) AS debit,SUM(credit_amount) as credit  from `ecms_fees` where invoice_date>= '$from' and invoice_date<= '$to'";
						
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
						<?php
							while($rs=$results->fetch_assoc()){
							$id++; 	
							
							?>
							<tr>
								<th colspan="4" style="text-align:right;">Total=</th>
								<th><?php echo $rs['debit']; ?>.00 </th>							
								<th><?php echo $rs['credit']; ?>.00 </th>							
								<th><?php
								
								$debit	= $rs['debit']; 
								$credit	= $rs['credit']; 
								$dcrs	= $debit-$credit;
								echo $dcrs; 
								?>.00

								</th>							
							</tr>
							<?php }?>
							<?php }?>
						</tfoot>
					</table>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
<?php include("inc/header.php"); ?>  
	

<?php
error_reporting(0);
	if (isset($_POST['submit'])){
		$member_code	= $_POST['member_code'];
		$from 			= $_POST['from'];
		$to 			= $_POST['to'];
	}

?>

<?php	 				
	function blancsum($db,$member_code,$from,$to){
	$query ="select 
					concat(sum(invoice_total+amount_due-amount_paid)) as opbalance
					from invoices 
					where 
					  month(created)= month(date_sub('$from', interval day('$from')+1 day) ) 
					  and year(created)= year(date_sub('$from', interval day('$from')+1 day) )
					  and distributor_id='$member_code' ";  
					  $results=$db->select($query); 
						if ($results){ 
							while($rs=$results->fetch_assoc()){ 
							$balance	=$rs['opbalance']; 
						}
				}
		return $balance; 
	}
	
	$funbal =blancsum($db,$member_code,$from,$to); 
?>
								 
		<!-- Main Area -->
		<section class="add_new_member ">
			
		<div class="container">
			<div class="row">
				<div class="col-md-12 ">
			<div class="from_border_3">
		<button onclick="history.go(-1);" class="btn btn-info">Back to Search Page </button>
				
					<h4 class="text-center"> <span style="color:green; font-weight:bold;">Distributor Ledger  
					</span> <span style="color:red;font-weight:bold;">
					
					</span> </h4>
					<br>	
					<table class="display table-bordered table-responsive table-striped text-left" style="width:100%;">
					<tbody>
					
					<?php	
						if ($member_code==true){
						//retrive 3 table data in this query and show by month 
						$query="SELECT * FROM distributor WHERE ac='$member_code'";
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
						<?php							
							while($rs=$results->fetch_assoc()){
							$id++;
						?>
						<tr>
							<td><b>Distributor A/C:</b></td>	
							<td><?php echo $rs['ac']; ?></td>
							<td><b>Name:</b></td>
							<td><?php echo $rs['first_name'].' '.$rs['last_name']; ?></td>							
						 
							<td><b>From: </b></td>	
							<td style='text-align:left;'><?php echo $from; ?></td>
							<td><b>To:</b></td>
							<td style='text-align:left;'><?php echo $to; ?></td>
						</tr>						
						<?php }?> 						
						<?php }?> 
						</form> 
					</table>
					<br />
					<br />
					
					<table id="example" class="display table table-striped table-reponsive table-bordered" style="width:90%;">
						<thead>
							<tr class="bg-info">
								<th>S.L</th>
								<th>Invoice No.</th>
								<th>Invoice Date</th>
								<th>Particular</th>
								<th>Debit</th>
								<th>Credit</th>
								<th>Balance</th> 
							</tr>
						</thead>
						<tbody>
						<!--Start Opening Balance-->
					<?php 
					$query ="select 
					concat(sum(invoice_total-amount_paid)) as opbalance
					from invoices 
					where created 
					between '2000-01-01' AND date_sub('$from', INTERVAL 1 DAY) 
					AND distributor_id='$member_code' "; 
					  
					  $results=$db->select($query); 
						if ($results){
							
							while($rs=$results->fetch_assoc()){ 
						 
							 $balance	=$rs['opbalance']; 
						  
					?>
					
						<tr>
								<td>--</td>	
								<td>--</td>
								<td>--</td>
								<td>Opening Balance</td> 
								
								<td>
								<?php 
									 if($balance >=1){
										echo number_format($balance);
									 }else {
										 echo '0';
									 }
								?>.00</td>
								<td> 
								<?php 
									 if($balance <=0){
										echo number_format($balance);
									 }else {
										 echo '0';
									 }
								?>.00 </td>
								<td>
									<?php echo number_format($balance); ?>.00
								</td>													
									
							</tr>
							<?php }?> 
							<?php }?> 
					 
					<!--End Opening balance-->
						<?php	
						//retrive 3 table data in this query and show by month
						
						$query="SELECT * FROM `invoices` where distributor_id='$member_code' and created>= '$from' and created<= '$to' ";
						
						
						
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
							<?php
							
							
							while($rs=$results->fetch_assoc()){
							$id++;
						
							?>	 					
							<tr>
								<td><?php echo $id; ?></td>	
								<td><?php 
								$inv='INV-';
								echo $inv.$rs['id']; 
								
								?> </td>
								<td><?php echo $rs['created']; ?> </td>
								<td><?php echo $rs['notes'] ; ?></td> 
								<td><?php echo number_format($rs['amount_due']); ?>.00 </td>
								<td><?php echo number_format($rs['amount_paid']); ?>.00 </td>
								<td>
								<?php 
								
								$debit		=$rs['invoice_total'];
					
								$credit 	=$rs['amount_paid'];
								
								$balance 	+=$debit-$credit;
								 echo number_format($balance); 

								?>.00
								</td> 
							</tr> 
							<?php }?>
							<?php } else{?>
							<div class="well text-center"> <h3> No Data Found</h3></div>
							<?php }  ?>								
						
							
							
						</tbody>
						<tfoot>
						
						<?php		
						$get_by_month = date("Y-m");
						$query="SELECT SUM(amount_paid) AS paid, SUM(amount_due) as credit_amount, SUM(amount_due) as due FROM `invoices` where distributor_id='$member_code' and created>= '$from' and created<= '$to'";
						
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
						<?php
							while($rs=$results->fetch_assoc()){
							$id++; 	
							
							?>
							<tr class="bg-success">
								<th colspan="4" style="text-align:right;">Total =</th>							
								<th><?php 
								echo number_format($rs['due']); 
								?>.00 </th>
								
								<th><?php 
								echo number_format($rs['paid']); 
								?>.00 </th>
								
								<th>  </th>							
							</tr>
							<?php }?>
							<?php }?>
							<?php }?> 
						</tfoot>
					</table>
				</div>
		</div>
		</section>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
				<br />
					<form action="distributor_ledger.php" method="post" target="blank">
						<input type="hidden" name="member_code" value="<?php echo $member_code; ?> " />
						<input type="hidden" name="from" value="<?php echo $from; ?> " />
						<input type="hidden" name="to" value="<?php echo $to; ?> "/>
						<input type="submit" class="btn btn-danger" name="submit" value="Print Or Download" />
					</form>
					<br />
				</div>
			</div>
		</div>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
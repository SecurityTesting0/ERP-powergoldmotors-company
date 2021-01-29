<?php 

	if (isset($_POST['submit'])){
		$from 	= $_POST['from'];
		$to 	= $_POST['to'];
	}else{
		echo"No Data Found";
	} 

include("inc/header.php");

 ?>  
	  
		<!-- Main Area -->
		<section class="add_new_member ">
			
		<div class="container">
			<div class="row">
				<div class="col-md-12 ">
			<div class="from_border_3"> 
					<h3 class="text-center"> <span style="color:green; font-weight:bold;">Sales Report  
					</span> </h3>
						<h4 style='text-align:center;'>		
						<span style="text-align:center; color:red; font-weight:bold;">From:</span> <?php echo $from; ?> 
						<span style="text-align:center; color:red; font-weight:bold;"> To: </span><?php echo $to; ?> 
					</h4>
					<br>	
					 
					<table id="example" class="display table table-striped table-reponsive table-bordered" style="width:90%;">
						<thead>
							<tr class="bg-info">
								<th class="text-center">INV. No.</th> 
								<th>INV. Date</th>
								<th>Dis. Name</th>						
								<th>Particular</th> 
								<th>Dues Amount</th> 
								<th>Paid Amount</th> 
								<th class="ac_display">action</th>  
							</tr>
						</thead>
						<tbody>
							<?php 
								$query="SELECT * from invoices where created>='$from' and created<='$to' and reciept_cat=1 order by id DESC"; 
								$results=$db->select($query);
								$id=0;
								if($results){
									while($rs=$results->fetch_assoc()){
									$id++; 	
									$distid=$rs['distributor_id'];
								?>
							<tr>
								<td class="text-center"><?php echo $rs['id']; ?></td>
								
								<td><?php echo $rs['created']; ?></td>
								
								<td><?php 
								$query2="SELECT * from distributor where ac=$distid"; 
								$results2=$db->select($query2);
								
								if($results2){
									while($rs2=$results2->fetch_assoc()){
										$name=$rs2['first_name'].' '.$rs2['last_name']; 
										echo $name;
									}
								}

								?></td>
								<td><?php echo $rs['notes']; ?></td>
								<td><?php echo number_format((float)$rs['amount_due'], 2, '.', ',')?></td>
								<td><?php echo number_format((float)$rs['amount_paid'], 2, '.', ',')?></td>
								<td><a href="print_invoice.php?inv='<?php echo $rs['id']?>'" target="blank" class="btn btn-danger btn-sm"> Print Invoice </a> </td>
								 
							</tr>
							<?php 
								}
								}
							?>
						</tbody>
						<tfoot class="bg-info">
							<?php 
								$query="SELECT SUM(amount_due) as due, SUM(amount_paid) as paid from invoices where created>='$from' and created<='$to' and reciept_cat=1
								and reciept_cat=1 order by id DESC"; 
								$results=$db->select($query);
								$id=0;
								if($results){
									while($rs=$results->fetch_assoc()){
									$id++; 	
									$distid=$rs['distributor_id'];
								?>
							
							<tr>
								<td class="text-center"></td>
								<td></td>
								<td></td>
								<td class="text-right">Total=</td>
								<td><?php echo number_format((float)$rs['due'], 2, '.', ',')?> Tk</td>
								<td><?php echo number_format((float)$rs['paid'], 2, '.', ',')?> Tk</td>
								<td> </td>
								 
							</tr>
									<?php 
									}
								}
							?>
						</tfoot>
					</table> 
				</div>
		</div>
		</section>
		
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
					<br />
						<form action="salesreport_pdf.php" target="blank" method="post">
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
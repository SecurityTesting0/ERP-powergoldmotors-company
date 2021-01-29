<?php include("inc/header.php"); ?>  
	  
		<!-- Main Area -->
		<section class="add_new_member ">
			
		<div class="container">
			<div class="row">
				<div class="col-md-12 ">
			<div class="from_border_3"> 
					<h4 class="text-center"> <span style="color:green; font-weight:bold;">Money Receipt List  
					</span> <span style="color:red;font-weight:bold;">
					
					</span> </h4>
					<br>	
					 
					<table id="example" class="display table table-striped table-reponsive table-bordered" style="width:90%;">
						<thead>
							<tr class="bg-info">
								<th>S.L</th>
								<th>Receipt No.</th>
								<th>Payment Date</th>
								<th>Distributor Name</th>
								<th>Particular</th> 
								<th>Amount</th> 
								<th class="ac_display">action</th>  
							</tr>
						</thead>
						<tbody>
							<?php 
								$query="SELECT * from invoices where reciept_cat=2 order by id DESC"; 
								$results=$db->select($query);
								$id=0;
								if($results){
									while($rs=$results->fetch_assoc()){
									$id++; 	
									$distid=$rs['distributor_id'];
								?>
							<tr>
								<td><?php echo $id; ?></td>
								<td>MR # <?php echo $rs['id']; ?></td>
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
								<td><?php echo number_format((float)$rs['amount_paid'], 2, '.', ',')?></td>
								<td>
								<a href="print_money_receipt.php?gmvid='<?php echo $rs['id']?>'" target="blank" class="btn btn-danger btn-sm"> <i class="fas fa-print"></i></a> 
								<a href="edit_money_recipt.php?editmr='<?php echo $rs['id']?>'" target="blank" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> </a> 
								</td>
								 
							</tr>
							<?php 
								}
								}
							?>
						
					</table>
				</div>
		</div>
		</section>
		 
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
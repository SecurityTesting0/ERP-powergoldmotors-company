<?php include("inc/header.php"); ?>  
	

<?php
error_reporting(0);
	if (isset($_POST['submit'])){
		$from 	= $_POST['from'];
	}else{
		echo"No Data Found";
	}

?>
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				
				<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
				
					<h3 class="text-center"> <span style="text-align:center; color:green; font-weight:bold;">Expens Detials <?php echo $dt=date('Y-m-d')?></span> </h3>
					<br />
					
					
					<table id="example" class="display" style="width:95%;">
						<thead>
							<tr>
								<th>S.L</th>
								<th>Invoice Date</th>
								<th>Head</th>
								<th>Narration</th>
								<th>Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 	
						$query="SELECT * FROM `expens` where date='$from'";						
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						
							while($rs=$results->fetch_assoc()){
							$id++;
						
							?>	 					
							<tr>
								<td><?php echo $id; ?></td>	
								<td><?php echo $rs['date']; ?> </td>
								<td><?php echo $rs['head'] ; ?></td> 
								<td><?php echo $rs['narration']; ?> </td>
								<td><?php echo $rs['amount']; ?>.00 </td>
								<td><a href="edit_expnese.php?id='<?php echo $rs['id']; ?>'" class="btn btn-warning">Edit </a></td>
							</tr>
							</form> 
							
							<?php }?>
							<?php } else{?>
							<div class="well text-center"> <h3> No Data Found</h3></div>
							<?php }  ?>							
						
							
							
						</tbody>
						
					</table>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
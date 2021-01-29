
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<?php 
						if(isset($_POST["submit"])){	
							
							$head					=$fm->validation($_POST['head']);	
							$head					=mysqli_real_escape_string($db->link,$head);
							
							$query ="INSERT INTO `expens_head`
							(`expense_head`) value ('$head')";
							$results=$db->insert($query);
							if($results==true){
								echo"<p class='well text-center' style='margin:0px auto; color:green;'>Head Successfully Added</p>";
							}else{
								echo"You should be checked again";
							}
						   }
					?>
					<div class="form-group from_border">
						<h4 class="well text-center">Add New Expense Head </span></h4>
						  <form action="" method="post">
							  <div class="form-group col-xs-10">							
								<input type="text" id="ex2" class="form-control" name="head" placeholder="Enter Head Name" required>
							  </div>
							  <input type="submit" class="btn btn-success" name="submit" value="Add"> 
						</form>
						<br />
					
						<?php		
						$query="SELECT * FROM expens_head";
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
						 <table class="table table-hover table-striped table-responsive table-bordered">
							<thead>
							  <tr class="bg-success">
								<th>Head Name</th>
								<th>Action</th>
							  </tr>
							</thead>
							
							
							<tbody>
							<?php
							while($rs=$results->fetch_assoc()){
							$id++; 						
							?>	
							  <tr>
								<td><?php echo $rs['expense_head']; ?></td>
								<td><a href="delete_exp_head.php?id='<?php echo $rs['id']; ?>'" class="btn btn-danger">Delete</a></td>
							  </tr>
							<?php }?>
							<?php }else{ ?>
							<div class="bg-danger">
							<p style='text-align:center;'>No Data Found!</p>
							</div>
							
							
							</tbody>
					<?php }?>
						</table> 
					
						
					
				</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
			

<?php include("inc/footer.php"); ?> 
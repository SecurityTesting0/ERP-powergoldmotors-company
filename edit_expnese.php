


<?php 
		if (empty($_GET['id'])){
		}elseif(!isset($_GET['id']) || $_GET['id'] == NULL){
			echo 'Something went to wrong';
		}else{
				$tid= $_GET['id'];
				$id= preg_replace("/[^0-9a-zA-Z]/", "", $tid);
				$rid = $id;
		}
?>
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<div class="col-12 col-xs-12 col-sm-12">
					<?php 
						if(isset($_POST["submit"])){	
							
							$head					=$fm->validation($_POST['head']);							
							$narration				=$fm->validation($_POST['narration']);
							$amount					=$fm->validation($_POST['amount']);
							 
							$date 					=date("Y-m-d");
							$head					=mysqli_real_escape_string($db->link,$head);
							$narration				=mysqli_real_escape_string($db->link,$narration);	
							$amount					=mysqli_real_escape_string($db->link,$amount);									
							
							$query ="UPDATE `expens` SET
							`head` 			='$head', 
							`narration`		='$narration', 
							`amount`		='$amount',
							`date`			='$date',
							`salary_date`	='$date', 
							`head_id` 		='$head'
							 where id		='$rid'";
							$results=$db->insert($query);
							if($results==true){
									 ?>
									
									
									
								<p class='bg-success text-center' style='margin:0px auto; color:green;'>
								Update Succesfull
								 
								<a href="ex_voucher_print.php?exvid='<?php echo $rid; ?>'" class="btn btn-success" target="blank"> Print Money Recpit </a> 
								
								
								</p>  
							
							<?php
							}else{
								echo"You should be checked again";
							}
						   }
					?>
					
						<div class="form-group from_border">
							<h4 class="well text-center">
							<span style="color:red; font-weight:bold;">Entry 
							</span> <span style="color:green; font-weight:bold;">  Expens </span></h4>
							  
							  
							  
							  
								<?php		
								$query="SELECT * FROM expens where id=$rid";
									$resultsd=$db->select($query);
									if ($resultsd){	
								?>
								<?php
								while($edtres=$resultsd->fetch_assoc()){
									$hedId=$edtres['head_id'];
								?> 
								
								<form action="" method ="post" enctype="">
								<div class="col-8 col-sm-8">
								<div class="form-group">
								  <label>Select Head</label>
								  <div class="select2-purple">
									<select class="select2" name="head" multiple="multiple" 
									data-placeholder="Type Member Code" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
										<?php
											$query="SELECT * FROM expens_head";
											$results=$db->select($query);
											$id=0;
											if ($results){
												?>

												<?php
												while($edmm=$results->fetch_assoc()){
													$id++;
													$ck=$edmm['id'];
													if($hedId==$ck){
														?>
														<option value="<?php echo $edmm['id'];?> " selected>

															<?php echo $edmm['expense_head'];?>

														</option>

													<?php }?>
												<?php }?>
											<?php }?>

											<?php
											$query="SELECT * FROM expens_head";
											$results=$db->select($query);
											$id=0;
											if ($results){
												?>

												<?php
												while($catid=$results->fetch_assoc()){
													$id++;

													?>
													<option value="<?php echo $catid['id'];?> ">

														<?php echo $catid['expense_head'];?>

													</option> 
											<?php } ?>
											<?php } ?> 
									  
									  
									</select>
								  </div>
								</div>
								<!-- /.form-group -->
							  </div> 
							  <div class="col-xs-4" >
								<label for="ex2">Select Date <span style="color:red">*</span></label>									
								  <div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="date" value="<?php echo $edtres['date'];?>" required>
										<div class="input-group-addon" >
										  <span class="glyphicon glyphicon-th"></span>
										</div>
									  </div>										  
									  <script type="text/javascript">										  
									   $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
									  </script>
									</div>    
								  </div>															
							  </div>
							 
								  
								  <div class="col-xs-12">
									<label for="ex2">Narration </label>
									<textarea class="form-control" rows="5" id="ex2" name="narration" type="text"> <?php echo $edtres['narration']; ?></textarea> 
								  </div>
								  <div class="col-xs-12">
									<label for="ex2">Amount <span style="color:red">*</span></label>
									<input class="form-control" id="ex2" type="number" name="amount" value="<?php echo $edtres['amount']; ?>" placeholder="500" required>
								  </div>
								 <div class="col-xs-6 margin_top">							
									<input class="form-control btn btn-success" id="ex2" name="submit" type="submit" value="Save Entry">
								 </div>
								 <div class="col-xs-6 margin_top">							
									<input class="form-control btn btn-warning" id="ex2" type="reset" value="Reset">
								 </div>
							 
							 </form>
							 <?php } ?>
							<?php } ?>	
						</div> 
					</div> 
				</div> 
			</div>
		</section>
		<!-- End Main Area -->
			

<?php include("inc/footer.php"); ?> 
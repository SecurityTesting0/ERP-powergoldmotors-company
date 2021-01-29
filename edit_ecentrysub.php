
<?php include("inc/header.php"); ?> 

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
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					
					<div class="form-group from_border">
					
					<?php 
						if(isset($_POST["submit"])){	
							
							$member_code			=$fm->validation($_POST['member_code']);
							$invoice_date			=$fm->validation($_POST['date']);
							$debit					=$fm->validation($_POST['debit']);
							$credit					=$fm->validation($_POST['credit']);
							$narration				=$fm->validation($_POST['narration']);
							
							$member_code			=mysqli_real_escape_string($db->link,$member_code);
							$credit					=mysqli_real_escape_string($db->link,$credit);							
							$narration				=mysqli_real_escape_string($db->link,$narration);	
							 
							  
							$query ="Update `ecms_fees` SET 
							`members_id`	='$member_code', 
							`invoice_no`	='0', 
							`invoice_date`	='$invoice_date', 
							`debit_amount`	='$debit', 
							`credit_amount`	='$credit', 
							`blance`		='0', 
							`narration`		='$narration', 
							`paid_id`		='0',
							`dues_id`		='0', 
							`blance_id`		='0',
							`gn_date` 		='0000-00-00'
							 where id =$rid"; 
							 $results=$db->update($query);
								if($results==true){
									 
									 ?>
									
									
									
								<p class='bg-success text-center' style='margin:0px auto; color:green;'>
								Update Succesfull
								 
								<a href="ec_voucher_print.php?ecvid='<?php echo $rid; ?>'" class="btn btn-success" target="blank"> Print Money Recpit </a> 
								
								
								</p>  
							
							<?php
								}else{
									echo"You should be checked again";
								}
						   } 
													
					?>
					
						<h4 class="well text-center"><span style="color:red; font-weight:bold;">Edit Committee Members Collection</span> <span style="color:green; font-weight:bold;"> Fees </span></h4>
						  	
							<?php		
								$query="SELECT * FROM ecms_fees where id=$rid";
								$resultsd=$db->select($query);
								if ($resultsd){	
							?>
							<?php
							while($edtres=$resultsd->fetch_assoc()){
								$mmck=$edtres['members_id'];
							?> 
						  
						  <form action="" method ="post" enctype="">
							  <div class="col-12 col-sm-8">
								<div class="form-group">
								  <label>Members Code</label>
								  <div class="select2-purple">
									<select class="select2" name="member_code" multiple="multiple" 
									data-placeholder="Type Member Code" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
										<?php		
										$query="SELECT * FROM members";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($edmm=$results->fetch_assoc()){
										$id++; 
											$ck=$edmm['member_code'];
											if($mmck==$ck){
										?>
									  <option value="<?php echo $edmm['member_code'];?> " selected>
									  
										<?php echo $edmm['member_code'].'-'. $edmm['First_name'].' 
										'.$edmm['Last_name'] .'('.$edmm['Committee_m_desigination'].')';?>
										  
									  </option>
									  
										<?php }?>
										<?php }?>
										<?php }?>
										
									  <?php		
										$query="SELECT * FROM members where commitee_serial >=1";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($mmcode=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $mmcode['member_code'];?> " >
									  
									<?php echo $mmcode['member_code'].'-'. $mmcode['First_name'].' '.$mmcode['Last_name'] .'('.$mmcode['Committee_m_desigination'].')';?>
									  
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
										<input  type="text" class="form-control" name="date" value="<?php echo $edtres['invoice_date'];?>" required>
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
								<textarea class="form-control" rows="2" id="ex2" name="narration" 
								type="text"><?php echo $edtres['narration'];?> </textarea> 
							  </div>
							  <div class="col-xs-6">
								<label for="ex2">Debit Amount <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="number" name="debit" 
								value="<?php echo $edtres['debit_amount'];?>" required>
							  </div>
							  <div class="col-xs-6">
								<label for="ex2">Credit Amount <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="number" name="credit" 
								value="<?php echo $edtres['credit_amount'];?>" required>
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
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
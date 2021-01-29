
<?php 
		if (empty($_GET['editmr'])){
		}elseif(!isset($_GET['editmr']) || $_GET['editmr'] == NULL){
			echo 'Something went to wrong';
		}else{
				$tid= $_GET['editmr'];
				$id= preg_replace("/[^0-9a-zA-Z]/", "", $tid);
				$rid = $id;
		}
?>
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<div class="form-group from_border">
					<?php 
						if(isset($_POST["submit"])){	
							$member_code			=$fm->validation($_POST['member_code']);
							$date					=$fm->validation($_POST['date']);
							$credit					=$fm->validation($_POST['credit']);
							$narration				=$fm->validation($_POST['narration']);
							
							$member_code			=mysqli_real_escape_string($db->link,$member_code);
							$date					=mysqli_real_escape_string($db->link,$date);
							$credit					=mysqli_real_escape_string($db->link,$credit);							
							$narration				=mysqli_real_escape_string($db->link,$narration);	
							
							$query ="UPDATE invoices SET
							`distributor_id`	='$member_code', 
							`created`			='$date',
							`amount_paid`		='$credit',
							`notes`				='$narration',
							`reciept_cat`		='2'
							 where 			id	='$rid'";
							$results=$db->update($query);
							if($results==true){
								?>
								<p class='bg-success text-center' style='margin:0px auto; color:green;'>
								Updated Successfully Completed. 
								<?php 
									$queryvou="SELECT *from invoices where id='$rid'";
									$resultsvou=$db->select($queryvou);
									if($resultsvou==true){
									while($vid=$resultsvou->fetch_assoc()){
									
									?> 
									<a href="print_money_receipt.php?gmvid='<?php echo $vid['id']?>'" target="_blank" class="btn btn-success"> Print Money Recpit </a> 
									
									</p>
								<?php } }?>  
								
							<?php
							} 
						}								
					?>
					
					<?php 
						$queryr="SELECT *from invoices where id='$rid'";
						$resultr=$db->select($queryr);
						if($resultr==true){
						while($rs=$resultr->fetch_assoc()){
							$dsid=$rs['distributor_id'];
							
					?> 
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;">Money Collection </span></h4>
						  <form action="" method ="post" enctype="">
							  <div class="col-8 col-sm-8">
								<div class="form-group">
								  <label>Distributor Code</label>
								  <div class="select2-purple">
									<select class="select2" name="member_code" multiple="multiple" 
									data-placeholder="Type Member Code" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
									  <?php		
										$disq="SELECT * FROM distributor where ac='$dsid'";
										$disr=$db->select($disq);
										$id=0; 
										if ($disr==true){	
										?>
										
										<?php
										while($disrs=$disr->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $disrs['ac'];?> " selected>
									  
									<?php echo $disrs['ac'].'-'. $disrs['first_name'].' '.$disrs['last_name'];?>
									  
									  </option>
										<?php } ?>
										<?php } ?>

										<?php		
										$disq="SELECT * FROM distributor";
										$disr=$db->select($disq);
										$id=0; 
										if ($disr==true){	
										?>
										
										<?php
										while($disrs=$disr->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $disrs['ac'];?> ">
									  
									<?php echo $disrs['ac'].'-'. $disrs['first_name'].' '.$disrs['last_name'];?>
									  
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
										<input  type="text" class="form-control" name="date" value="<?php echo $rs['created']?>" required>
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
								<label for="ex2">Note: </label>
								<textarea class="form-control" rows="2" id="ex2" name="narration" type="text"><?php echo $rs['notes']?></textarea> 
							  </div>
							  <div class="col-xs-12">
								<label for="ex2">Amount <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="number" name="credit" value="<?php echo $rs['amount_paid']?>" required>
							  </div>
							 <div class="col-xs-3 margin_top">							
								<input class="form-control btn btn-success" id="ex2" name="submit" type="submit" value="Save Entry">
							 </div> 
							 <div class="col-xs-3 margin_top">							
								<a href="collect_mony.php" class="form-control btn btn-info" id="ex2">Add New </a>
							 </div> 
						 
						 </form>
						 
						 <?php } }?>  
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 

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
							   
							$query ="INSERT INTO `invoices`(
							`distributor_id`, `created`,`amount_paid`,`notes`,`reciept_cat`) VALUES (
							'$member_code','$date','$credit','$narration','2')";
							$results=$db->insert($query);
							if($results==true){
								?>
								<p class='bg-success text-center' style='margin:0px auto; color:green;'>
								Money Collect Succesfull 
								<?php 
									$queryvou="SELECT *from invoices ORDER BY id DESC LIMIT 1";
									$resultsvou=$db->select($queryvou);
									if($resultsvou==true){
									while($vid=$resultsvou->fetch_assoc()){
									?> 
									<a href="print_money_receipt.php?gmvid='<?php echo $vid['id']?>'" target="blank" class="btn btn-success"> Print Money Recpit </a> 
									
									</p>
								<?php } }?>  
								
							<?php
							} 
						   /* 
						    
							   if($results==true) {									
									$sql ="Select Mobile_number from members where member_code='$member_code'";
									$sms=$db->select($sql);
									$newnum="";
									if ($sms){											
										while($rs=$sms->fetch_assoc()){
										$newnum.="+88".trim($rs['Mobile_number']); 	
										}
									}
																
									$fields = array(
														'api_key' => urlencode('C20028305f6c6457c62bf2.79069222'),
														'type' => urlencode('text'),
														'contacts' => urlencode($newnum),
														'senderid' => urlencode('8809612446179'),
														'msg' => urldecode('Thank You, Your Contribution of '.$credit.' Taka Fee of '.$narration. ' has been received. Heartfelt Thanks for extending your support to us. -Missionpara Mosque.' )
													);
									$fields_string="";
									foreach($fields as $key=>$value){ 
									$fields_string .= $key.'='.$value.'&'; 
									}
											
									$ch = curl_init();
									curl_setopt($ch,CURLOPT_URL, "http://brandsms.itbd.info/smsapi");
									curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
									curl_setopt($ch, CURLOPT_POST, count($fields));
									curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($ch, CURLOPT_FAILONERROR, true);
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
									$result = curl_exec($ch);
								}
						   
						   //SMS Code  */
						}								
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
										$query="SELECT * FROM distributor";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($mmcode=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $mmcode['ac'];?> " >
									  
									<?php echo $mmcode['ac'].'-'. $mmcode['first_name'].' '.$mmcode['last_name'];?>
									  
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
										<input  type="text" class="form-control" name="date" placeholder="dd-mm-yyyy" required>
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
								<textarea class="form-control" rows="2" id="ex2" name="narration" type="text"> </textarea> 
							  </div>
							  <div class="col-xs-12">
								<label for="ex2">Amount <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="number" name="credit" placeholder="500" required>
							  </div>
							 <div class="col-xs-3 margin_top">							
								<input class="form-control btn btn-success" id="ex2" name="submit" type="submit" value="Save Entry">
							 </div> 
							 <div class="col-xs-3 margin_top">							
								<a href="collect_mony.php" class="form-control btn btn-info" id="ex2">Add New </a>
							 </div> 
						 
						 </form>
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
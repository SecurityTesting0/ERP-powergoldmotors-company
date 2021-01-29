
<?php include("inc/header.php"); 
ob_start(); 

?> 




<!-- Main Area -->
		<section> 
			 <div class="container">
				<div class="row">
					<div class="col-md-12">					
						<div class="bg-danger heading">
						
							<h4> Send SMS || </h4>					
						
						</div>
						<div class="bg-success">
						<?php
												
								 if(isset($_POST["send1"])) { 
										$group_id=$_POST["group_id"];
										
											if ($group_id==01){
												$sql ="Select * from members where commitee_serial >=1 ";
												$results=$db->select($sql);
												$newnum="";
												if ($results){											
													while($rs=$results->fetch_assoc()){
													$newnum.="+88".trim($rs['Mobile_number']); 	
													}
												}
												$txt=$_POST["txt"];										
												$fields = array(
																'api_key' => urlencode('C20028305f6c6457c62bf2.79069222'),
																'type' => urlencode('text'),
																'contacts' => urlencode($newnum),
																'senderid' => urlencode('8809612446179'),
																	'msg' => urldecode($txt)
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
												if(preg_match("/SMS SUBMITTED/", $result)) {
													echo "<h4 class='text-center'><font color=green> SMS Successfully Sent</font></h4>";
												}else{
													echo "<font color=red> Failed</font><br>Error code : ".$result;
												}
											}else{
												$sql ="Select * from members where ";
												$results=$db->select($sql);
												$newnum="";
												if ($results){											
													while($rs=$results->fetch_assoc()){
													$newnum.="+88".trim($rs['Mobile_number']); 	
													}
												}
												$txt=$_POST["txt"];										
												$fields = array(
																'api_key' => urlencode('C20028305f6c6457c62bf2.79069222'),
																'type' => urlencode('text'),
																'contacts' => urlencode($newnum),
																'senderid' => urlencode('8809612446179'),
																	'msg' => urldecode($txt)
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
											if ($result==true){
												echo "<script type='text/javascript'>alert('SMS Successfully Sent All Numbers')</script> ";
											}else{
												echo "<script type='text/javascript'>alert('SMS Not Sent')</script> ";
											}
										}
										
							?>
							
								
						</div>
					</div>
				</div>
			 </div> 		
		</section> 
		<section class="add_new_member_2 ">
			 <div class="container">
				<div class="row">
					<div class="col-md-8">
						<!--div class="form-group from_border_2">
						
							<form action="" method="post">
							 <div class="col-xs-12">
								<label for="ex2">Enter Mobile Number </label>
								<input class="form-control" id="ex2" type="text"  placeholder="Phone Number" name="num">
							  </div>							  
							  <div class="col-xs-12">
								<label for="ex2">Write SMS </label>
								<textarea class="form-control" id="ex2" rows="6" placeholder="Write SMS" name="txt"> </textarea> 
							  </div>
								<div class="col-xs-3 margin_top">							
									<input class="form-control btn btn-success" id="ex2" type="submit" name="send" value="Send SMS" data-toggle="modal" data-target="#myModal">
								</div>
								<div class="col-xs-3 margin_top">							
									<input class="form-control btn btn-danger" id="ex2" type="reset" value="Reset">
								</div>
							</form>
						</div> 	--> 
						
						<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#single_SMS" aria-controls="home" role="tab" data-toggle="tab">Single SMS</a></li>
						<li role="presentation"><a href="#group_sms" aria-controls="profile" role="tab" data-toggle="tab">Group SMS</a></li>					
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="single_SMS">						
							<div class="form-group from_border_2">							
								<form action="" method="post">
								 <div class="col-xs-12">
									<label for="ex2">Enter Mobile Number <span style="color:red;">*</span></label>
									<textarea class="form-control" id="ex2" rows="3" type="text"  placeholder="Phone Number" name="num" required></textarea>
								  </div>							  
								  <div class="col-xs-12">
									<label for="ex2">Write SMS </label>
									<textarea class="form-control" id="ex2" rows="6" placeholder="Write SMS" name="txt"> </textarea> 
								  </div>
									<div class="col-xs-3 margin_top">							
										<input class="form-control btn btn-success" id="ex2" type="submit" name="send" value="Send SMS" data-toggle="modal" data-target="#myModal">
									</div>
									<div class="col-xs-3 margin_top">							
										<input class="form-control btn btn-danger" id="ex2" type="reset" value="Reset">
									</div>
								</form>
							</div> 						
						</div>
						<div role="tabpanel" class="tab-pane" id="group_sms">
							<div class="form-group from_border_2">						
								<form action="" method="post">								 
									<div class="form-group">
										<label for="ex2">Select Group Contact <span style="color:red;">*</span></label>
										 <div class="select2-purple">
											<select class="select2" name="payment_month" rows="1" multiple="multiple" data-placeholder="Type or Click Here"
											data-dropdown-css-class="select2-purple" style="width: 100%;" name="group_id" required>
											  <option value="01"> Committee Members</option>
											  <option value="02">	All Members</option>
											
											</select>
										  </div>
									</div>								  
									  <div class="col-xs-12">
										<label for="ex2">Write SMS </label>
										<textarea class="form-control" id="ex2" rows="6" placeholder="Write SMS" name="txt"> </textarea> 
									  </div>
										<div class="col-xs-3 margin_top">							
											<input class="form-control btn btn-success" id="ex2" type="submit" name="send1" value="Send SMS" data-toggle="modal" data-target="#myModal">
										</div>
										<div class="col-xs-3 margin_top">							
											<input class="form-control btn btn-danger" id="ex2" type="reset" value="Reset">
										</div>
								</form>
							</div> 						
						</div>				
					  </div>

					</div>
					</div> 	
					<div class="col-md-4">
						 <div class="balance_area">
							<h3>SMS Blance Information </h3>
							<br/>
							<?php
								$cURLConnection = curl_init();

								curl_setopt($cURLConnection, CURLOPT_URL, 'http://brandsms.itbd.info/miscapi/C20028305f6c6457c62bf2.79069222/getBalance');
								curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

								$blance = curl_exec($cURLConnection);
								curl_close($cURLConnection);

								echo "$blance";	
							?>	
												
						</div>
					</div> 	
									
				</div>
			 </div>
			
			 
			
		</section>
		
		
			<!-- End Main Area -->
			
			




<?php include("inc/footer.php"); ?> 
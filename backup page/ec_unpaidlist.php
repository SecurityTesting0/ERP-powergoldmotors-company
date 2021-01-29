<?php include("inc/header.php"); 
error_reporting(0); 
?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<div class="from_border_3">
						<h3 class="text-center well"> Collectable Duse Upto <?php  echo $date=date("Y-m-d"); ?></h3>
			
						<table id="example" class="display table-hover table table-striped table-responsive table-bordered" style="width:95%;">
							<thead>
								<tr class="bg-success">
									<th>A/C No.</th>								
									<th>Name</th>								
									<th>Members Type</th>
									<th>Due Amount</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody> 
							<?php	 
								$chk="SELECT member_code FROM members";
									$check=$db->select($chk);
									
									if($check){
									while ($chrs=$check->fetch_assoc()){
									$mid=$chrs['member_code'];
								
									$query ="SELECT members_id as ac, sum(credit_amount) as cr, sum(debit_amount) as dr, 
									First_name as fname, Last_name as Lname, type from 
									accounts_table INNER JOIN members ON members.member_code=accounts_table.members_id
									where members_id='$mid'"; 
									$results=$db->select($query); 
									$id=0;
									if ($results){
								
									?> 
									<?php 
										
										while($rs=$results->fetch_assoc()) {
										$id++;
										 $dbt=$rs['dr'];
										 $crt=$rs['cr'];
										 $dbtcrtres =$dbt-$crt;
										 if ($dbtcrtres>=1) { 
										 
									?>
									
								
									
										<tr>
											<td><?php echo $rs['ac'];?> </td>
											<td><?php echo $rs['fname'].' '.$rs['Lname'];?> </td>
											<td><?php echo $rs['type'];?> </td>
											<td><?php echo 
											number_format((float)$dbtcrtres, 2, '.', ',');
											
											
											?> </td>
											<td><span class="bg-danger">Unpaid</span></td>
										</tr>
									
										
						</div>
							<?php }?> 
							<?php }?> 
							<?php }?> 
							<?php }?> 
							<?php }?> 	
							
							</tbody>
							 
						</table>
						
					</div>	
					
				</div>

		</section>
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center"> 
				
					<?php	 
						$chk="SELECT member_code FROM members";
							$check=$db->select($chk);
							
							if($check){
							while ($chrs=$check->fetch_assoc()){
							$mid=$chrs['member_code'];
						
							$query ="SELECT members_id as ac, sum(credit_amount) as cr, sum(debit_amount) as dr, 
							First_name as fname, Last_name as Lname, type from 
							accounts_table INNER JOIN members ON members.member_code=accounts_table.members_id
							where accounts_table.members_id='$mid'"; 
							$results=$db->select($query); 
							$id=0;
							if ($results){
						
							?> 
							<?php 
								
								while($rs=$results->fetch_assoc()) {
								$id++;
								 $dbt=$rs['dr'];
								 $crt=$rs['cr'];
								 $dbtcrtres =$dbt-$crt;
								 if ($dbtcrtres>=1) { 
								 
							?>
							
					<?php 
								$ac= $rs['ac'];
								
								if(isset($_POST["send1"])) {
										$sql ="Select * from members where member_code='$ac'";
										$results=$db->select($sql);
										$newnum="";
										if ($results){											
											while($rs=$results->fetch_assoc()){
											$newnum.="+88".trim($rs['Mobile_number']); 	
											}
										}
								$text 	='Masjid Dues Alert. ';
								$lpart	='Secretary, M.P.J.M'; 
								$amount	= $dbtcrtres;								
								$fields = array(
													'api_key' => urlencode('C20006965a9be526e9b3e0.41204732'),
													'type' => urlencode('text'),
													'contacts' => urlencode($newnum),
													'senderid' => urlencode('NCL Account'),
													'msg' => urldecode($text.'Your Dues Amount As Committee Members: '.$amount.', '.$lpart)
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
								
						?>
					<?php }?> 
					<?php } ?> 
					<?php }?> 
					<?php }
						if($result) { 
							echo "<script type='text/javascript'>alert('SMS Successfully Sent All Numbers')</script> ";
						 
						}
					?> 
					<?php }?> 
					<!-- <form action="" method="post">
					End Main Area 
					
					<input class="btn btn-danger btn-md" id="ex2" type="submit" name="send1" value="Click to Send SMS All Members"> 
					</form>-->
				</div>
			</div>
		</div>
		
<?php include("inc/footer.php"); ?> 
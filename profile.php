
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<?php 
						if(isset($_POST["submit"])){	
							
							$shop_id				=$fm->validation($_POST['shop_id']);
							$invoice_date			=date("Y-m-d"); 
							$credit					=$fm->validation($_POST['credit']);
							$narration				=$fm->validation($_POST['narration']);
							
							$shop_id				=mysqli_real_escape_string($db->link,$shop_id);
							$credit					=mysqli_real_escape_string($db->link,$credit);							
							$narration				=mysqli_real_escape_string($db->link,$narration);	
							
														
							$sql ="Select id,shop_id,debit_amount, blance from shop_rent where shop_id='$shop_id' order by id DESC LIMIT 0,1";
							$results=$db->select($sql);
							if($results==true){
							while($data=$results->fetch_assoc()){
								$getprvbl 	=$data['blance'];
								$getdb	 	=$data['debit_amount'];
								// check exist entry
							}
							
							//blance entry 
							  $chkdc		= $getprvbl+$getdb; 
							  $balance	 	= $chkdc-$credit; 
							  
							$query ="INSERT INTO `shop_rent`(
							`shop_id`, `invoice_no`,`invoice_date`,`debit_amount`, 
							`credit_amount`, `blance`, `narration`, 
							`paid_id`,`dues_id`, `blance_id`,`gn_date`) VALUES (
							'$shop_id','0','$invoice_date','0','$credit','$balance','$narration',
							'0','0','0','0000-00-00')";
							$results=$db->insert($query);
							if($results==true){
								echo"<p class='well text-center' style='margin:0px auto; color:green;'>Rent Payment Succesfull</p>";
							}else{
								echo"You should be checked again";
							}
							
						   }else{
							    $query ="INSERT INTO `shop_rent`(
								`shop_id`,`invoice_no`,`invoice_date`,`debit_amount`, 
								`credit_amount`, `blance`, `narration`, 
								`paid_id`,`dues_id`, `blance_id`,`gn_date`) VALUES (
								'$shop_id','0','$invoice_date','0','$credit','-$credit','$narration',
								'0','0','0','0000-00-00')";
								$results=$db->insert($query);
								if($results==true){
									echo"<p class='well text-center' style='margin:0px auto; color:green;'>Rent Payment Succesfull</p>";
								}else{
									echo"You should be checked again";
								}
						   }
						}								
					?>
					 <?php
						$query="Select * from admin_user where id=$userid";
						$usres=$db->select($query);
						if ($usres==true) {
							while ($rs=$usres->fetch_assoc()){
					   ?>
					<div class="form-group from_border">
						<h4 class="well text-center"><span style="color:red; font-weight:bold;">Profile </span> <span style="color:green; font-weight:bold;"> Inormation </span></h4>
                        <div class="" style="height: 170px; width:150px;
                         background: #fff; margin:0px auto; border: 2px solid green;">
                            <img src="<?php echo $rs['photo'];?>" class="img-responsive img-thumbnail">
                        </div> <br>
                        <table class="table table-striped table-responsive">
                          
                            <tbody>
                                <tr>
                                    <td>First Name</td>
                                    <td>:</td>
                                    <td><?php echo $rs['first_name'];?></td>
                                </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>:</td>
                                <td><?php echo $rs['last_name'];?></td>

                            </tr>
                             <tr>
                                <td>Super User Role</td>
                                <td>:</td>
                                <td><?php  
									
									$rol=$rs['role_id'];
									if ($rol==1){
										echo"Admin"; 
									}else{
										echo"Saller"; 
									}
								
								?></td>

                            </tr>
                            <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <form>
                            <div class="form-group">
                                <a href="profile_edit.php?id='<?php echo $userid;?>'" class="btn btn-warning"> Edit Profile</a>
                            </div>
                        </form>
			</div>
					
			 </div>
		</section>
		<!-- End Main Area -->
			

<?php include("inc/footer.php"); ?> 
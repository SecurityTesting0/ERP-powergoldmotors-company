
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
					
					<div class="form-group from_border_3">
					<h4 class="well text-center"><span style="color:#fff;">
					<i class="fas fa-bank" aria-hidden="true"></i> Bank Deposit History</span></h4>
						<div class="col-md-4">
						<div class="middle_area_about">
						<div class="wrapper_about text-center">
						<?php 
							if(isset($_POST[submit])){
								$bank_code		=$_POST['bank_code'];
								$bank_name		=$_POST['bank_name'];
								$account		=$_POST['account'];
								$amount_credit	=$_POST['amount_credit'];
								$date			=$_POST['date'];
								$notes			=$_POST['notes'];
								
								$query="INSERT INTO bank_details (account_code, bank_name, account,
								amount_credit, date,notes) values ('$bank_code','$bank_name','$account',
								'$amount_credit','$date','$notes')";
								$results=$db->insert($query);
								if($results==true){
									?> 
									<div class="alert alert-success alert-dismissible">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
									  <strong>New Bank Added Successfully</strong>  
									</div>
									<?php 
								}else{
									?> 
									<div class="alert alert-danger">
									  <strong>Somthing Problem</strong>  
									</div>
									<?php 
								}
							}
						
						?>
						
						<?php 
							if(isset($_POST[submitedit])){
								$bank_code		=$_POST['bank_code'];
								$bank_name		=$_POST['bank_name'];
								$account		=$_POST['account'];
								$amount_credit	=$_POST['amount_credit'];
								$date			=$_POST['date'];
								$notes			=$_POST['notes'];
								
								$query="UPDATE bank_details SET 
								account_code	='$bank_code', 
								bank_name		='$bank_name', 
								account			='$account',
								amount_credit	='$amount_credit',
								date			='$date',
								notes			='$notes'
								
								where id	=$rid";
								
								$results=$db->update($query);
								if($results==true){
									?> 
									<div class="alert alert-success alert-dismissible">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
									  <strong>Bank  Update Successfully</strong>  
									</div>
									<?php 
								}else{
									?> 
									<div class="alert alert-danger">
									  <strong>Somthing Problem</strong>  
									</div>
									<?php 
								}
							}
						
						?>
						<?php
							if($rid==true){
						?>
					
						 <form action="" method="post">
						  <div class="form-row">
							<div class="col-sm-12 col-md-12"> 
							<?php
								$query="SELECT * From bank_details where id=$rid";
								$results=$db->select($query);
								$id=0; 
								if($results==true){
									while($rse=$results->fetch_assoc()){
									$id++; 
							?> 
							 <div class="form-row">
							<div class="col-sm-12 col-md-12 text-left"> 
							<label for="ex2">Select Date <span style="color:red">*</span></label>									
							  <div class="form-group">
								<div id="filterDate2">
									<!-- Datepicker as text field -->         
								  <div class="input-group date" data-date-format="dd.mm.yyyy">
									<input  type="text" class="form-control" name="date" value="<?php echo $rse['date']; ?>" required>
									<div class="input-group-addon" >
									  <span class="glyphicon glyphicon-th"></span>
									</div>
								  </div>										  
								  <script type="text/javascript">										  
								   $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
								  </script>
								</div>    
							  </div>
							<span>Select Bank Name</span>
							<select class="select2" name="bank_code" multiple="0" 
								data-placeholder="Select Bank Name" 
								data-dropdown-css-class="select2-purple" onchange="GetAccount(this.value)" style="width: 100%;" required>
								
								<?php		
								$query="SELECT * FROM bank_info";
								$results=$db->select($query);
								$id=0;
								if ($results==true){	
									while($rs=$results->fetch_assoc()){
								?>
								  <option value="<?php echo $rs['code']?>" ><?php echo $rs['code'].'-'.$rs['name'];?></option>
								  
								<?php }	}?>
							</select>
							<br />
							<span>Account No.</span> <br> 
							<select name="account" id="Account" class="form-control form-control-sm">
							
							</select>
							<span>Amount Deposit.</span>
							<input type="text" class="form-control" id="email" value="<?php echo $rse['amount_credit']; ?>" name="amount_credit" required>
							<span>Notes</span><br />
							<textarea name="notes" id="" cols="40" rows="3"><?php echo $rse['notes']; ?> </textarea><br />
							</div> 
						
						  </div>
							
							 <?php } }?>
							</div> 
							<div class="col-sm-12 col-md-12"> 
							<br />
								<button type="submit" name="submitedit" class="btn btn-success btn-block"><i class="fas fa-edit"></i> Update Info</button> 
							</div>
						  </div>
							<?php } else{?> 
						  <form action="" method="post">
						  <div class="form-row">
							<div class="col-sm-12 col-md-12 text-left"> 
							<label for="ex2">Select Date <span style="color:red">*</span></label>									
							  <div class="form-group">
								<div id="filterDate2">
									<!-- Datepicker as text field -->         
								  <div class="input-group date" data-date-format="dd.mm.yyyy">
									<input  type="text" class="form-control" name="date"  placeholder="2020-01-01" required>
									<div class="input-group-addon" >
									  <span class="glyphicon glyphicon-th"></span>
									</div>
								  </div>										  
								  <script type="text/javascript">										  
								   $('.input-group.date').datepicker({format: "dd.mm.yyyy"}); 
								  </script>
								</div>    
							  </div>
							<span>Select Bank Name</span>
							<select class="select2" name="bank_code" multiple="0" 
								data-placeholder="Select Bank Name" 
								data-dropdown-css-class="select2-purple" onchange="GetAccount(this.value)" style="width: 100%;" required>
								
								<?php		
								$query="SELECT * FROM bank_info where id='$rid'";
								$results=$db->select($query);
								$id=0;
								if ($results==true){	
									while($rs=$results->fetch_assoc()){
								?>
								  <option value="<?php echo $rs['code']?>" selected><?php echo $rs['code'].'-'.$rs['name'];?></option>
								  
								<?php }	}?>
								
								<?php		
								$query="SELECT * FROM bank_info";
								$results=$db->select($query);
								$id=0;
								if ($results==true){	
									while($rs=$results->fetch_assoc()){
								?>
								  <option value="<?php echo $rs['code']?>" ><?php echo $rs['code'].'-'.$rs['name'];?></option>
								<?php }	}?>
							</select>
							<br />
							<span>Account No.</span> <br> 
							<select name="account" id="Account" class="form-control form-control-sm">
							
							</select>
							<span>Amount Deposit.</span>
							<input type="text" class="form-control" id="email" Placeholder="Ex. 500" name="amount_credit" required>
							<span>Notes</span><br />
							<textarea name="notes" id="" cols="40" rows="3"></textarea><br />
							</div> 
							
							<div class="col-sm-12 col-md-12"> 
								<br />
								<button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Save Entry</button> 
							</div>
						  </div>
						</form> 
						<?php } ?> 
						<br /> 
						<hr />
					</div> 
					</div> 
					</div> 
					
					
					<div class="col-md-8 text-center">
						<table id="example" class="table table-striped table-bordered" style="width:95%">
							<thead>
								<tr>
									<th>S.L No</th> 
									<th>Bank Name</th> 
									<th>Account No.</th> 
									<th>Deposit Amount</th> 
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
							<?php
								$query="SELECT * From bank_details";
								$results=$db->select($query);
								$id=0; 
								if($results==true){
									while($rs=$results->fetch_assoc()){
									$id++; 
									$code=$rs['account_code'];
							?> 
								 <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <?php echo $id; ?>
                                  </td>
								  
								  <?php		
									$qr2="SELECT * FROM bank_info where code='$code'";
									$r2=$db->select($qr2); 
									if ($r2==true){	
										while($rs2=$r2->fetch_assoc()){
										 
									?> 
                                  <td class="inbox-small-cells"> <?php echo $rs2['name']; ?></td>  
								  <?php }	}?> 
                                  <td class="inbox-small-cells"> <?php echo$rs['account']; ?></td>  
                                  <td class="inbox-small-cells"> <?php 
								  echo number_format((float)$rs['amount_credit'], 2, '.', ',');
								   ?>  Tk.</td>  
                                  <td ><a href="bank_deposite.php?id='<?php echo $rs['id']; ?>'" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td> 
                              </tr> 
							  <?php } }?>
							</tbody>
							<tfoot> 
							</tfoot>
						</table>
					</div> 
			 </div>
			 </div>
			 </div>
		</section>
		<!-- End Main Area -->
		
		<script>
		function GetAccount(str) {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			 document.getElementById("Account").innerHTML = this.responseText;
			}
		  };
		  xhttp.open("GET", "get_bank_account.php?id="+str, true);
		  xhttp.send();
		}
		
		</script>
<?php include("inc/footer.php"); ?> 
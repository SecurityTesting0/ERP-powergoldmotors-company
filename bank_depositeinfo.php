
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
					<i class="fas fa-bank" aria-hidden="true"></i> Bank Deposit Ledger</span></h4>
						<div class="col-md-12">
						<div class="middle_area_about">
						<div class="wrapper_about text-center"> 
						  
						  <form action="" method="post">
						  <div class="form-row">
							<div class="col-sm-2 col-md-2 text-left"> 
							<label for="ex2">From: <span style="color:red">*</span></label>									
							  <div class="form-group">
								<div id="filterDate2">
									<!-- Datepicker as text field -->         
								  <div class="input-group date" data-date-format="dd.mm.yyyy">
									<input  type="text" class="form-control" name="from"  placeholder="2020-01-01" required>
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
							<div class="col-sm-2 col-md-2 text-left">
							  <label for="ex2">To: <span style="color:red">*</span></label>									
							  <div class="form-group">
								<div id="filterDate2">
									<!-- Datepicker as text field -->         
								  <div class="input-group date" data-date-format="dd.mm.yyyy">
									<input  type="text" class="form-control" name="to"  placeholder="2020-01-01" required>
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
							<div class="col-sm-3 col-md-3 text-left">
							<label>Select Bank Name</label>
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
						   </div>
						   <div class="col-sm-3 col-md-3 text-left">
							<label>Account No.</label>  
							<select name="account" id="Account" class="form-control form-control-sm"> 
							</select> 
							</div>
							<div class="col-sm-2 col-md-2 text-lef">  
							<label > <span style="color:#eee;"> Account No.</span></label> 
							<button type="submit" name="submit" class="btn btn-success"><i class="fas fa-paper-plane"> </i> Submit</button> 
							</div>
						  </div>
						</form> 
						  
						<br /> 
						<hr />
					</div> 
					</div> 
					</div> 
					
					
					<div class="col-md-12 text-center">
						<?php 
							if(isset($_POST[submit])){
								$from	=$_POST['from'];
								$to		=$_POST['to'];
								$account=$_POST['account'];
							
						
						?> 
						<table id="example" class="table table-striped table-bordered" style="width:95%">
							<thead>
								<tr class="bg-info">
									<th>S.L No</th> 
									<th>Deposit Date </th> 
									<th>Bank Name</th> 
									<th>Account No.</th> 
									<th>Notes </th> 
									<th>Deposit Amount</th> 
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
							<?php
								$query="SELECT * From bank_details where date>='$from' and date<='$to'
								and account=$account";
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
                                  <td class="inbox-small-cells"> <?php echo $rs['date']; ?></td> 
                                  <td class="inbox-small-cells"> <?php echo $rs2['name']; ?></td>  
								  <?php }	}?> 
                                  <td class="inbox-small-cells"> <?php echo$rs['account']; ?></td>  
								  <td class="inbox-small-cells"> <?php echo$rs['notes']; ?></td>  
                                  <td class="inbox-small-cells"> <?php 
								  echo number_format((float)$rs['amount_credit'], 2, '.', ',');
								   ?>  Tk.</td>  
                                  <td ><a href="bank_deposite.php?id='<?php echo $rs['id']; ?>'" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td> 
                              </tr> 
							  <?php } }?>
							</tbody>
							<tfoot>
								<tr class="bg-info">
									<td class="text-right" colspan="5">Total=</td>
									<?php
										$query="SELECT SUM(amount_credit) as total From bank_details where date>='$from' and date<='$to'
										and account=$account";
										$results=$db->select($query);
										$id=0; 
										if($results==true){
											while($rs=$results->fetch_assoc()){
										 
									?> 
									<td > <?php echo  number_format((float)$rs['total'], 2, '.', ',');?> Tk.</td>
									 <?php }} ?>
									 <td></td>
								</tr>
							</tfoot>
						</table>
						  <?php } ?>
					</div> 
			 </div>
			 </div>
			 </div>
		</section>
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
					<br />
						<form action="bank_account_ledger.php" target="blank" method="post">
							<input type="hidden" name="account" value="<?php echo $account; ?> " />
							<input type="hidden" name="from" value="<?php echo $from; ?> " />
							<input type="hidden" name="to" value="<?php echo $to; ?> "/>
							<input type="submit" class="btn btn-danger" name="submit" value="Print Or Download" />
						</form>
						<br />
					</div>
				</div>
			</div>
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
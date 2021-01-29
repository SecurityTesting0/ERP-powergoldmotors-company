
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
					<h4 class="well text-center"><span style="color:#fff;"> <i class="fas fa-bank" aria-hidden="true"></i> Bank Information </span></h4>
						<div class="col-md-4">
						<br />
						<br />
						<div class="middle_area_about">
						
						<div class="wrapper_about text-center">
						<?php 
							if(isset($_POST[submit])){
								$code	=$_POST['code'];
								$name	=$_POST['name'];
								$account=$_POST['account'];
								
								$query="INSERT INTO bank_info(code, name,account) values ('$code','$name','$account')";
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
								$code	=$_POST['code'];
								$name	=$_POST['name'];
								$account=$_POST['account'];
								
								$query="UPDATE bank_info SET 
								code		='$code', 
								name		='$name', 
								account		='$account' 
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
								$query="SELECT * From bank_info where id=$rid";
								$results=$db->select($query);
								$id=0; 
								if($results==true){
									while($rse=$results->fetch_assoc()){
									$id++; 
							?> 
							<span>Enter Code</span>
							<input type="text" class="form-control" id="email" value="<?php echo $rse['code']; ?>"name="code" required>
							<span>Enter Bank Name</span>
							<input type="text" class="form-control" id="email" value="<?php echo $rse['name']; ?>"name="name" required>
							<span>Account No.</span>
							<input type="text" class="form-control" id="email" value="<?php echo $rse['account']; ?>"name="account" required>
							 <?php } }?>
							</div> 
							<div class="col-sm-12 col-md-12"> 
							<br />
									<button type="submit" name="submitedit" class="btn btn-success btn-block"><i class="fas fa-edit"></i> Update Bank Info</button> 
							</div>
						  </div>
							<?php } else{?> 
							
						  <form action="" method="post">
						  <div class="form-row">
							<div class="col-sm-12 col-md-12 text-left"> 
							<span>Enter Code</span>
							<input type="text" class="form-control" id="email" Placeholder="Ex. 1001" name="code" required>
							<span>Enter Bank Name</span>
							<input type="text" class="form-control" id="email" Placeholder="Ex. Sonali Bank" name="name" required>
							<span>Account No.</span>
							<input type="text" class="form-control" id="email" Placeholder="Ex. 101.1002.1003" name="account" required>
							</div> 
							
							<div class="col-sm-12 col-md-12"> 
							 
							<br />
									<button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-plus"></i> Add New Bank</button> 
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
									<th>s.L No</th> 
									<th>Code</th> 
									<th>Bank Name</th> 
									<th>Account No.</th> 
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
							<?php
								$query="SELECT * From bank_info";
								$results=$db->select($query);
								$id=0; 
								if($results==true){
									while($rs=$results->fetch_assoc()){
									$id++; 
							?> 
								 <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <?php echo $id; ?>
                                  </td>
                                  <td class="inbox-small-cells"> <?php echo$rs['code']; ?></td>  
                                  <td class="inbox-small-cells"> <?php echo$rs['name']; ?></td>  
                                  <td class="inbox-small-cells"> <?php echo$rs['account']; ?></td>  
                                  <td ><a href="add_bank.php?id='<?php echo $rs['id']; ?>'" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td> 
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
		
<?php include("inc/footer.php"); ?> 
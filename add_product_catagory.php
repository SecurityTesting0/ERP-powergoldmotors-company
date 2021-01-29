
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
						<div class="middle_area_about">
						<h4 class="well text-center"><span style="color:#fff;">All Catagory</span></h4>
						<div class="wrapper_about text-center">
						<?php 
							if(isset($_POST[submit])){
								$cat_name=$_POST['cat_name'];
								
								$query="INSERT INTO product_catagory(name) values ('$cat_name')";
								$results=$db->insert($query);
								if($results==true){
									?> 
									<div class="alert alert-success alert-dismissible">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
									  <strong>Catagory Added Successfully</strong>  
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
								$cat_name=$_POST['cat_name'];
								
								$query="UPDATE product_catagory SET 
								name='$cat_name' 
								where id=$rid";
								$results=$db->update($query);
								if($results==true){
									?> 
									<div class="alert alert-success alert-dismissible">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
									  <strong>Catagory Update Successfully</strong>  
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
							<div class="col-sm-6 col-md-6"> 
							<?php
								$query="SELECT * From product_catagory where id=$rid";
								$results=$db->select($query);
								$id=0; 
								if($results==true){
									while($rse=$results->fetch_assoc()){
									$id++; 
							?> 
							  <input type="text" class="form-control" id="email" value="<?php echo $rse['name']; ?>"name="cat_name" required>
							 <?php } }?>
							</div> 
							<div class="col-sm-6 col-md-6"> 
									<button type="submit" name="submitedit" class="btn btn-success"><i class="fas fa-edit"></i> Update Catagory</button> 
							</div>
						  </div>
							<?php } else{?> 
						  <form action="" method="post">
						  <div class="form-row">
							<div class="col-sm-6 col-md-6"> 
							  <input type="text" class="form-control" id="email" placeholder="Enter Catagory Name" name="cat_name" required>
							</div> 
							<div class="col-sm-6 col-md-6"> 
									<button type="submit" name="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add Catagory</button> 
							</div>
						  </div>
						</form> 
						<?php } ?> 
						<br /> 
						<hr />
						
						<table id="example" class="table table-striped table-bordered" style="width:95%">
							<thead>
								<tr>
									<th>s.L No</th> 
									<th>Name</th> 
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
							<?php
								$query="SELECT * From product_catagory";
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
                                  <td class="inbox-small-cells"> <?php echo$rs['name']; ?></td>  
                                  <td ><a href="add_product_catagory.php?id='<?php echo $rs['id']; ?>'" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td> 
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
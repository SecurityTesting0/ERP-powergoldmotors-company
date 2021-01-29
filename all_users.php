<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="main_area ">
			 <div class="container">
				<div class="row">
					<div class="col-md-12 text-left">
					<a href="add_new_user.php" class="btn btn-sm btn-success">Add New User</a>
						<div class="from_border_user text-center">
                       <h3 class="well" style="color:#fff; width:95%"> All Users List </h3>
					   
					    <table class="table table-striped table-responsive text-left table-condensed table-center table-hover" style="width:95%;">
                            <tr>
                                <th>S.L No</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Role</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            $query="Select * from admin_user";
                            $usres=$db->select($query);
                            $id=0;
                            if ($usres==true) {
                                while ($rs=$usres->fetch_assoc()){
                                    $id++;
                            ?>
                            <tr>
                               <td><?php echo $id;?></td>
                               <td><?php echo $rs['username'];?></td>
                               <td><?php echo $rs['first_name'];?></td>
                               <td><?php echo $rs['last_name'];?></td>
							   
                               <td><?php 
							   
							  $userrole=$rs['role_id'];
							  if($userrole==1){
								  echo "Admin"; 
							  }elseif($userrole==2){
								  echo"Seller";
							  }
							   
							   ?></td>
							   
                               <td>
								<img src="<?php echo $rs['photo'];?>" style="width:50px; height:50px;" alt="" />
							   </td>
                               <td><a href="profile_edit.php?id='<?php echo $rs['id'];?>'" class="btn btn-info"> <i class="fas fa-edit"></i> </a></td>

                            </tr>
                            <?php } ?>
                            <?php } ?>

                        </table>
						</div>
					</div>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		

<?php include("inc/footer.php"); ?> 
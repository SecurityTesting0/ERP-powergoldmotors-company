
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					
					<div class="form-group from_border">
					<?php 
						if(isset($_POST["submit"])){
                            $firstname		=$fm->validation($_POST['first_name']);
                            $last_name		=$fm->validation($_POST['last_name']);
                            $username		=$fm->validation($_POST['username']);
                            $password		=$fm->validation(md5($_POST['password']));
                            $type			=$fm->validation($_POST['type']);
							
							$permited  = array('jpg', 'jpeg', 'png', 'gif');
							$file_name = $_FILES['image']['name'];	
							$file_size = $_FILES['image']['size'];
							$file_temp = $_FILES['image']['tmp_name'];
							$div = explode('.', $file_name);
							$file_ext = strtolower(end($div));
							$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
							$uploaded_image = "img/user/".$unique_image;

							if (empty($file_name)) {
							 echo "<span class='error'>Please Select any Image !</span>";
							}elseif ($file_size >1048567) {
							 echo "<span class='error'>Image Size should be less then 1MB!
							 </span>";
							} elseif (in_array($file_ext, $permited) === false) {
							 echo "<span class='error'>You can upload only:-"
							 .implode(', ', $permited)."</span>";
							} else{
								move_uploaded_file($file_temp, $uploaded_image);
								
								$query="INSERT INTO admin_user(first_name, last_name, username, password, role_id,photo) 
								VALUES('$firstname','$last_name','$username','$password','$type', '$uploaded_image')";
								$results=$db->insert($query);
								if($results==true){
									echo"<script type='text/javascript'>alert('New User Added SuccessFull');</script>";
								}else{
									echo"Checked Again";
								}
							}						
						}
					?>
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;"> Add New User </span></h4>
                      
                        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="text" class="col-sm-4 control-label">First Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="first_name" placeholder="Ex. Azizar " id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text" class="col-sm-4 control-label">Last Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="last_name" placeholder="Ex. Rahman"id="inputEmail3" >
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="text" class="col-sm-4 control-label">Username</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="username" placeholder="Ex. azizar"id="inputEmail3" >
                                </div>
                            </div>
							<div class="form-group">
                                <label for="text" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="password" placeholder="Ex. 123" id="inputEmail3">
                                </div>
                            </div> 
							 <div class="form-group">
							  <label for="text"  class="col-sm-4 control-label">User Type</label>
							  <div class="col-sm-7">
							  <select class="form-control" id="inputEmail3" name="type">
								<option value="1">Admin</option>
								<option value="2">Seller</option>
								
							  </select>
							  </div>
							</div> 							
                            <div class="form-group">
                                <label for="text" class="col-sm-4 control-label">User Photo</label>

                                <div class="col-sm-7">
                                    <img src="" class="img-thumbnail" style="height: 100px; width:100px;">
                                    <br>
                                    <br>

                                    <input type="file" name="image" id="exampleInputFile">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-sm btn-success">Add User Info</button>
                                </div>
                            </div>
                        </form>

			</div>
					
			 </div>
		</section>
		<!-- End Main Area -->
			

<?php include("inc/footer.php"); ?> 
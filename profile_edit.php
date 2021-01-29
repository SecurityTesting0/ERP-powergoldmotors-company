
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
					<?php 
						if(isset($_POST["submit"])){
							$first_name				=$fm->validation($_POST['first_name']);
							$last_name				=$fm->validation($_POST['last_name']);
                            
							
							$permited  = array('jpg', 'jpeg', 'png', 'gif');
							$file_name = $_FILES['image']['name'];	
							$file_size = $_FILES['image']['size'];
							$file_temp = $_FILES['image']['tmp_name'];
							$div = explode('.', $file_name);
							$file_ext = strtolower(end($div));
							$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
							$uploaded_image = "img/user/".$unique_image;

							if (empty($file_name)) {
								 $query="Update admin_user SET 
								`first_name`			='$first_name',
								`last_name`				='$last_name'
								where id				=$rid";
								$results=$db->update($query);
								if($results==true){
									echo "<script type='text/javascript'>alert('Information Successfully Updated')</script>";
								}
							}elseif ($file_size >1048567) {
							 echo "<span class='error'>Image Size should be less then 1MB!
							 </span>";
							} elseif (in_array($file_ext, $permited) === false) {
							 echo "<span class='error'>You can upload only:-"
							 .implode(', ', $permited)."</span>";
							} else{
								move_uploaded_file($file_temp, $uploaded_image);
								
									$query="Update admin_user SET 
									`first_name`			='$first_name',
									`last_name`				='$last_name', 
									`photo`					='$uploaded_image'
									where id				=$rid";
									$results=$db->update($query);
									if($results==true){
										echo "<script type='text/javascript'>alert('Information Successfully Updated')</script>";
									}
							} 
					     }
					?>
					     <?php
							$query="Select * from admin_user where id=$rid";
							$usres=$db->select($query);
							if ($usres==true) {
								while ($rs=$usres->fetch_assoc()){

						   ?>
                    <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group from_border">
                                    <h4 class="well text-center"><span style="color:#fff; font-weight:bold;">Profile </span> <span style="color:#fff; font-weight:bold;"> Inormation </span></h4>
                                    <div class="" style="height: 200px; width:150px;
                                     background: #fff; margin:0px auto; border: 2px solid green;">
                                        <img src="<?php echo $rs['photo'];?>" class="img-responsive img-thumbnail">
										<br />
										<input type="file" name="image" id="exampleInputFile">
                                    </div>
									<br>
                                    <table class="table table-striped table-responsive">
                                  

                                        <tbody>
                                            <tr>
                                                <td>First Name</td>
                                                <td>:</td>
                                                <td><input type="text" name="first_name" value="<?php echo $rs['first_name'];?>"></td>
                                            </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td>:</td>
                                            <td><input type="text" name="last_name" value="<?php echo $rs['last_name'];?>"></td>

                                        </tr>
                                         <tr>
                                            <td>Super User Role</td>
                                            <td>:</td>
                                            <td><?php echo $rs['role'];?></td>

                                        </tr>

                                        </tbody>
                                    </table>

                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-default btn-info">Update Info</button>
                                        </div>
                                    </form>
                                </div>
                        <?php } ?>
                        <?php } ?>

					
			 </div>
		</section>
		<!-- End Main Area -->
			

<?php include("inc/footer.php"); ?> 
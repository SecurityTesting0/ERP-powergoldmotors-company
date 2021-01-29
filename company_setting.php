
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<?php 
						if(isset($_POST["submit"])){
                            $company_name_first_part	=$fm->validation($_POST['company_name_first_part']);
                            $comapnay_name_last_part	=$fm->validation($_POST['comapnay_name_last_part']);
                            $address				    =$fm->validation($_POST['address']);

                           
							
							$permited  = array('jpg', 'jpeg', 'png', 'gif');
							$file_name = $_FILES['image']['name'];	
							$file_size = $_FILES['image']['size'];
							$file_temp = $_FILES['image']['tmp_name'];
							$div = explode('.', $file_name);
							$file_ext = strtolower(end($div));
							$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
							$uploaded_image = "img/logo/".$unique_image;

							if (empty($file_name)) {
								$query="UPDATE company_info SET 
								`company_name_first_part` ='$company_name_first_part',  
								`comapnay_name_last_part` ='$comapnay_name_last_part', 
								`address`                 ='$address'
								where                  id=1";
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
								
									$query="UPDATE company_info SET 
									`company_name_first_part` ='$company_name_first_part',  
									`comapnay_name_last_part` ='$comapnay_name_last_part', 
									`address`                 ='$address',
									`logo`                	  ='$uploaded_image'
									where                  id=1";
										$results=$db->update($query);
										if($results==true){
											echo "<script type='text/javascript'>alert('Information Successfully Updated')</script>";
										}
							}
							
							
							
						}
					?>
					<div class="form-group from_border">
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;"> Company </span> <span style="color:#fff; font-weight:bold;"> Profile Inormation </span></h4>
                        <?php
                            $query="Select * from company_info where id=1";
                            $res=$db->select($query);
                            if ($res==true) {
                                while ($rs=$res->fetch_assoc()){

                           ?>
                        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="text" class="col-sm-4 control-label">Company First Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="company_name_first_part" id="inputEmail3" value="<?php echo $rs['company_name_first_part']; ?> ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text" class="col-sm-4 control-label">Company Last Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="comapnay_name_last_part" id="inputEmail3" value="<?php echo $rs['comapnay_name_last_part']; ?> ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text" class="col-sm-4 control-label">Address</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="address" rows="3"><?php echo $rs['address']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text" class="col-sm-4 control-label">Company Logo</label>

                                <div class="col-sm-7">
                                    <img src="<?php echo $rs['logo']; ?>" class="img-thumbnail" style="height: 100px; width:100px;">
                                    <br>
                                    <br>

                                    <input type="file" name="image" id="exampleInputFile">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-default btn-info">Update Info</button>
                                </div>
                            </div>
                        </form>

                            <?php } ?>
                            <?php } ?>

			</div>
					
			 </div>
		</section>
		<!-- End Main Area -->
			

<?php include("inc/footer.php"); ?> 
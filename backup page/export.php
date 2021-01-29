<?php
ob_start(); 
include("inc/header.php");

?> 

	

		<section class="main_area main_area_text">
			 <div class="container">
				<div class="row">
					<div class="col-md-12">
							<div class="generate2"> 
								
								<h3>Click Download Button To Download All Members List</h3>
								<hr />
								<div>
								<?php
									if(isset($_POST['exp'])) {
										$db->export();
										}
									
									
										?>
										<form  action="" method="post" enctype="multipart/form-data">
											 
												<div class="form-group">
													<div class="col-md-12 col-xl-12">
														<input type="submit" name="exp" class=" form-control btn btn-danger" value="Download Now"/>
													</div>
											   </div>									   
										</form>           
								</div>
							</div>
					</div>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		

<?php
include('inc/footer.php');

?>


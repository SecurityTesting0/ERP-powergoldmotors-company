<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="main_area main_area_text">
			 <div class="container">
				<div class="row">
					<div class="col-md-12">
					<?php
										
											if(isset($_POST["submit"]))	{
															
													  $file = $_FILES['file']['tmp_name'];
													  $handle = fopen($file, "r");
													  $c = 0;
													  while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
																{
													  $member_code 				= $filesop[0];
													  $type 					= $filesop[1];
													  $Committee_m_desigination = $filesop[2];
													  $commitee_serial			= $filesop[3];
													  $fixed 					= $filesop[4];
													  $ec_sub_fees				= $filesop[5];
													  $First_name 				= $filesop[6];
													  $Last_name 				= $filesop[7];
													  $Mobile_number 			= $filesop[8];
													  $Membership_date 			= $filesop[9];
													  $Address		 			= $filesop[10];
													  $Active_status 			= $filesop[11]; 
													  
													  $sql = "insert into members (`member_code`, `type`, `Committee_m_desigination`, 
													  `commitee_serial`, `fixed`, `ec_sub_fees`, `First_name`, 
													  `Last_name`, `Mobile_number`, `Membership_date`, 
													  `Address`, `Active_status`) 
													  values ('$filesop[0]','$filesop[1]','$filesop[2]','$filesop[3]','$filesop[4]','$filesop[5]',
													  '$filesop[6]','$filesop[7]','$filesop[8]','$filesop[9]','$filesop[10]','$filesop[11]')";
													  $results=$db->insert($sql);
														$c = $c + 1;													  
													   }
													   if($results){
														   echo "<div class='well'> <span style='color:green; font-weight: bold;'>Members Successfully Imported </span></div>   ";
														 } 
													 else
													 {
														echo "Sorry! Unable to impo.";
													  }


											}
											?>

							<div class="generate2"> 
										
								<h3>Select Members Data Excel/Csv files</h3>
								<form action="" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<div class="col-md-4 ">
											<input type="file" name="file" class="custom-file-input" id="customFile" value="Import List">
											<label class="custom-file-label" for="customFile">Choose file</label>
										</div>
											<script>
											// Add the following code if you want the name of the file appear on select
											$(".custom-file-input").on("change", function() {
											  var fileName = $(this).val().split("\\").pop();
											  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
											});
											</script>
										<div class="col-xs-12 margin_top">							
											<input class="form-control btn btn-success" id="ex2" name="submit" type="submit" value="Upload Members Information">
										</div>						
									</div>						
								</form>
							</div>
							
							

					</div>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		

<?php include("inc/footer.php"); ?> 
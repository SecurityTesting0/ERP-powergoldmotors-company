<?php include("inc/header.php"); ?> 

		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				
				<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<br />
					<h4 class="text-center"> <span style="color:green; font-weight:bold;">Select Month To Download
					<span style="color:red; font-weight:bold;">Salary Sheet</span></h4>
					<br />
					
						<form action="salary_pdf.php" target="blank" method="post">
							<div class="col-xs-12">
								<label for="ex2">Enter month<span style="color:red">*</span></label>
								<div class="form-group">
									<input type="text" Placeholder="Ex. 2020-01" class="form-control" name="date"/ required>
								 </div>
							 </div>
							 
							<div class="col-xs-12 margin_top">							
								<input class="form-control btn btn-success" id="ex2" type="submit" name="submit" value="Download Salary Sheet">
							 </div>
							
						</form>
					
				</div>
				
				</div>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
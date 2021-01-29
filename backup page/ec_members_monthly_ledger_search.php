<?php include("inc/header.php"); ?> 

		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				
				<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<br />
					<h4 class="text-center"> <span style="color:green; font-weight:bold;">All EC Members Monthly Ledger  </span></h4>
					<br />
					
					
					
				
						<form action="ec_members_monthly_ledger_report.php" method="post">
							
							<div class="input-group col-12 col-sm-12">
							
							</div>
							<div class="col-xs-12">
								<label for="ex2">From:<span style="color:red">*</span></label>
								<div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="from" placeholder="Example: 2020-01-01" required>
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
							 
							 
							 <div class="col-xs-12">
								<label for="ex2">To:<span style="color:red">*</span></label>
								<div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="to" placeholder="Example: 2020-01-01" required>
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
							 <div class="col-xs-12 margin_top">							
								<input class="form-control btn btn-success" id="ex2" type="submit" name="submit" value="Submit Query">
							 </div>
						</form>
					
				</div>
				
				</div>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
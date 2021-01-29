
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					<?php 
						if(isset($_POST["submit"])){	
							
							$head					=$fm->validation($_POST['head']);							
							$narration				=$fm->validation($_POST['narration']);
							$amount					=$fm->validation($_POST['amount']);
							$date					=$fm->validation($_POST['date']);
							$invoice_date 			=date('Y-m-d');
							$head					=mysqli_real_escape_string($db->link,$head);
							$narration				=mysqli_real_escape_string($db->link,$narration);	
							$amount					=mysqli_real_escape_string($db->link,$amount);									
							
							$query ="INSERT INTO `income`(`head`, `narration`, `amount`, `invoice_date`, `date`) 
							VALUES ('$head','$narration','$amount','$invoice_date ','$date')";
							$results=$db->insert($query);
							if($results==true){
								?> 
								<p class='bg-success text-center' style='margin:0px auto; color:green;'>
								
								
								Donation Successfully Entry 
								
								<?php 
									$queryvou="SELECT *from income ORDER BY id DESC LIMIT 1";
									$resultsvou=$db->select($queryvou);
									if($resultsvou==true){
									while($vid=$resultsvou->fetch_assoc()){
									
									?> 
									<a href="donation_voucher_print.php?donvid='<?php echo $vid['id']?>'" target="blank" class="btn btn-success"> Print Money Recpit </a> 
									
									
									</p>
								<?php } }?>
								
								<?php
								
								
							}else{
								echo"You should be checked again";
							}
						   }
					?>
					<div class="form-group from_border">
						<h4 class="well text-center"><span style="color:red; font-weight:bold;">Entry </span> <span style="color:green; font-weight:bold;"> Others Donation</span></h4>
						  <form action="" method="post" enctype="">
							  <div class="col-12 col-sm-12">
								<div class="form-group">
								  <label>Select Head <span style="color:red">*</span></label>
								  <div class="select2-purple">
									<select class="select2" multiple="multiple" data-placeholder="Type Head Name" 
									data-dropdown-css-class="select2-purple" name="head" style="width: 100%;" required>
									 	
									  <option value="Friday"> Friday </option>  
									  <option value="Inner Donation Box"> Inner Donaton Box </option>  
									  <option value="Outer Donation Box"> Outer Donaton Box </option>  
									  <option value="Others Donaton"> Others Donaton </option>  
									 								
									</select>

								  </div>
								</div>
								<!-- /.form-group -->
							  </div>
							  <div class="col-xs-6" >
								<label for="ex2">Collection Date <span style="color:red">*</span></label>									
								  <div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="date" placeholder="dd-mm-yyyy" required>
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
							   <div class="col-xs-6">
								<label for="ex2">Amount <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="number" name="amount" placeholder="500" required>
							  </div>
							  <div class="col-xs-12">
								<label for="ex2">Narration </label>
								<textarea class="form-control" rows="4" id="ex2" name="narration" type="text"> </textarea> 
							  </div>
							 
							 <div class="col-xs-6 margin_top">							
								<input class="form-control btn btn-success" id="ex2" name="submit" type="submit" value="Save Entry">
							 </div>
							 <div class="col-xs-6 margin_top">							
								<input class="form-control btn btn-warning" id="ex2" type="reset" value="Reset">
							 </div>
						 
						 </form>
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
			

<?php include("inc/footer.php"); ?> 
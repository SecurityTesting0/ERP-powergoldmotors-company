
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		
				<SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[0].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[0].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = "";
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
				}
			}
		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 1) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">
					
					<div class="form-group from_border_3">
					
					<?php 
						if(isset($_POST["submit"])){	
						
						}								
					?>
						<h4 class="well text-center"><span style="color:#fff; font-weight:bold;">Sale Product</span></h4>
						  <form action="" method ="post" enctype="">
							  <div class="col-6 col-sm-6">
								<div class="form-group">
								  <label>Distributor Code</label>
								  <div class="select2-purple">
									<select class="select2" name="dis_code" multiple="multiple" 
									data-placeholder="Type Member Code" data-dropdown-css-class="select2-purple" style="width: 100%;" required>
									  
									  <?php		
										$query="SELECT * FROM distributor";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($dis=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $dis['ac'];?> " >
									  
									<?php echo $dis['ac'].' '.$dis['first_name'].' '.$dis['last_name'];?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
									  
									  
									</select>
								  </div>
								</div>
								<!-- /.form-group -->
							  </div> 
							   <div class="col-xs-3">

	
							<label for="ex2">Invoice Number <span style="color:red">*</span></label>
								<input class="form-control" id="ex2" type="text" name="invoice_number" Value="002" Disabled>
							  </div>
							   <div class="col-xs-3" >
								<label for="ex2">Select Date <span style="color:red">*</span></label>									
								  <div class="form-group">
									<div id="filterDate2">
										<!-- Datepicker as text field -->         
									  <div class="input-group date" data-date-format="dd.mm.yyyy">
										<input  type="text" class="form-control" name="date" value="<?php echo date('Y-m-d h:s:i');?>" disabled>
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
							 <!-- Product area --> 
						<table style="width:100%; text-align:left;">
						
							<th>
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Product</td>
									<td>Quantity</td>
									<td>Unit Price</td>
									<td>Total</td>
								</tr>								
							</th>							
						</table>
							 
						<table class="table" id="dataTable">	
												
							<tr>
								<td><input class="form-control" type="checkbox" name="chk"/></td>
								<td>	
								<select class="select2" name="product_name" multiple="multiple" 
									data-placeholder="Type Product Code" style="width:100%;" data-dropdown-css-class="select2-purple"  required>
									  
									  <?php		
										$query="SELECT * FROM product_table";
										$results=$db->select($query);
										$id=0; 
										if ($results){	
										?>
										
										<?php
										while($product=$results->fetch_assoc()){
										$id++; 
										
										?>
									  <option value="<?php echo $product['product_code'];?> " >
									  
									<?php echo $product['product_name'];;?>
									  
									  </option>
										<?php } ?>
										<?php } ?>
									</select>
									 
								</td>
								 <td>
									 <input class="form-control" type="number" id="quantity" name="quantity[]" oninput="calc();" required>
								</td>
								<!--<td> 
									<input type="number" class="form-control" id="discount" name="discount[]" oninput="calc();" required>
								 </td>--> 
								 <td>
									<select name="amount[]" class="form-control" id="amount" oninput="calc();">
										<option value="2000" >2000 </option>
									</select>
								 </td>
								 <td> 
									<input class="form-control" type="number" id="total" name="total[]" disabled>
								 </td> 
							</tr>	
							 <script src="js/sales.js"></script>
						</table> 
						
							 <div class="col-xs-12">
									<button onclick="addRow('dataTable')"><i class="fas fa-plus"></i></button>
									<button onclick="deleteRow('dataTable')"><i class="fas fa-trash"></i></button>
							</div>
		
					
							<div class="col-xs-12 col-md-6 col-sm-6">
						 
									<label for="ex2">Narration: </label>
									<textarea class="form-control" rows="2" id="ex2" name="narration" type="text"> </textarea> 
							</div>
							<div class="col-xs-12 col-md-offset-2 col-sm-offset-2  col-md-4 col-sm-4">  
									 <div class="form-group">											
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Subtotal:</div>
												<input type="number" class="form-control" name="invoice_subtotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Tax:</div>
												
												<input type="number" class="form-control" name="tax_percent" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">											
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Tax % Tk:</div>
												<input type="number" class="form-control" name="tax" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
												
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">									
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon ">Total:</div>
												<input type="number" class="form-control" name="invoice_total" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">
										
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Tk Paid:</div>
												<input type="number" class="form-control" name="amount_paid" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
										<div class="form-group input-group-sm mb-3">										
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-addon">Tk Due:</div>
												<input type="number" class="form-control amountDue" name="amount_due" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
											</div>
										</div>
							</div>
							  
							 
							<!-- End Product area --> 
							  
							  
							 <div class="col-xs-3 margin_top">							
								<input class="form-control btn btn-success" id="ex2" name="submit" type="submit" value="Save Entry">
							 </div> 
							 <div class="col-xs-3 margin_top">							
								<a href="sales.php" class="form-control btn btn-info" id="ex2">Add New </a>
							 </div> 
						 
						 </form>
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
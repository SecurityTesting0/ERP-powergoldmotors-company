
		<!-- Navbar Area -->

		<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
			  <li><a href="index.php"> <i class="fas fa-home"></i> Home</a></li> 
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"
				  role="button" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-users"></i> Distributer Info <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="new_distributor.php">Add New Distributer</a></li>
					<li><a href="add_distributor_location.php">Add Location</a></li>	 
					<li><a href="view_distributor_list.php">View All Distributer</a></li>	 
					<!-- <li><a href="import_mem.php">Import Distributer List</a></li>		
					<li><a href="export.php">Download Distributer List</a></li>	-->	
				  </ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
				  aria-haspopup="true" aria-expanded="false"> <i class="fas fa-dollar"> </i> Accounts <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="collect_mony.php">Collect Money</a></li>
					<li><a href="money_receipt_list.php">Print Money Recipt</a></li>
					<li><a href="distributor_ledger_search.php">Distributer Ledger</a></li>
					<!--<li><a href="ec_members_monthly_ledger_search.php">Monthly Ledger</a></li>-->
					<li><a href="collecteble_dues.php">Collecteble Dues</a></li>
					<?php 
						$date=date('Y-m')
					?>
					<div class="divider"></div>
						<li><a href="add_bank.php">Add New Bank</a></li>
						<li><a href="bank_deposite.php">Deposite Money To Bank</a></li>
						<li><a href="bank_depositeinfo.php">Bank Account Ledger</a></li>
					<div class="divider"></div>
					<!--<li><a href="ec_paid_list.php?ecpid='<?php echo $date; ?>'">Paymented List</a></li>--> 
					<li><a href="opening_blance.php">Opening Balance</a></li> 
				  </ul>
				 
				</li> 
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
				  aria-haspopup="true" aria-expanded="false"> <i class="fas fa-dollar"> </i> Products Info <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="add_product_catagory.php">Add Product Catagory</a></li>
					<li><a href="add_brand.php">Add Brand Name</a></li>
					<li><a href="new_product.php">Add New Product</a></li>  
					<li><a href="product_list.php">View All Product List</a></li>  
				  </ul> 
				</li>   
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
				  aria-haspopup="true" aria-expanded="false"> <i class="fas fa-dollar"> </i> Purches <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="new_purches.php">New Purches</a></li>
					<li><a href="purches_summery.php">Purches Summery</a></li>  
				  </ul> 
				</li>   
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
				  aria-haspopup="true" aria-expanded="false"> <i class="fas fa-dollar"> </i> Sales <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="sales.php">Create Invoice</a></li>
					<li><a href="salesreport.php">Sales Report</a></li>
					<li><a href="invoice_list.php">Sales Summery</a></li>
					<!--<li><a href="sales_return.php">Sales Return</a></li>--> 
				  </ul> 
				</li>   
				
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
				  aria-haspopup="true" aria-expanded="false"> <i class="fas fa-minus-square"></i> Expens<span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="new_expens.php">New Expens</a></li>
					<li><a href="add_newhead.php">Add New Head</a></li>
					<!--<li><a href="expnes_edit.php">Edit Expnes</a></li>--> 
					<li><a href="expnes_ledger.php">Ledger</a></li>
					
					
				  </ul>
				</li>
				
				<!--<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
				  role="button" aria-haspopup="true" aria-expanded="false"> 
				  <i class="fa fa-users"></i> Employee <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="add_employee.php">Add New Employee </a></li>		
					<li><a href="employee_list.php">View Employee </a></li>
					<li><a href="view_generated_salary.php">View Generated Salary</a></li>
					<li><a href="print_salary.php">Print Salary Sheet</a></li>
					<li><a href="generate_salary.php">Generate Salary</a></li>
				  </ul>
				</li>  -->
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
				  aria-haspopup="true" aria-expanded="false"> <i class="fas fa-file"></i> Report<span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="final_report.php">Monthly Report </a></li>
					<li><a href="stock_report.php">Stock Report </a></li>
				  </ul>
				</li>
				
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
				  aria-haspopup="true" aria-expanded="false"> <i class="fas fa-cog"></i> Setting<span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="backup-database.php">Database Backup </a></li>
					<?php 
					if($Status==1){
					
				?> 
					<li><a href="company_setting.php">Company Setting </a></li>
					<li><a href="all_users.php">All Users </a></li>
					  <?php }?> 
					<li><a href="profile.php">My Profile </a></li>
				  </ul>
				</li>
				
				  <?php
							if(isset($_GET['action']) && $_GET['action'] == "logout"){
								Session::destory();
							}
						 ?>	
				<li><a href="?action=logout" style="color:red;"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
				
				
			  </ul><!--
			  <form class="navbar-form navbar-left">
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Search for...">
				  <span class="input-group-btn">
					<button class="btn btn-default" type="button">Search</button>
				  </span>
				</div>
			  </form>-->
			  <ul class="nav navbar-nav navbar-right">
				
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
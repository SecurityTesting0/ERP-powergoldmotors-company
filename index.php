<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="main_area">
			 <div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="from_border_3" style="color:#fff;">
						<br />
						<br />
						<br />
							<h3 class="text-info">WELCOME TO PGML WEB-ERP MANAGEMENT SYSTEM</h3> 
							<div class="row text-center">
								<div class="col-md-offset-1 col-md-3 col-sm-3">
									<div class="bg-danger well" style="width:100%; margin-left:20px; padding:30px;">
									<h3>Today Sales</h3>
									<?php
										$date=date('Y-m-d'); 
										
										$query1="SELECT SUM(invoice_total) as total from invoices where created='$date'"; 
										$res=$db->select($query1);
										if (!empty($res)){
											while($rs=$res->fetch_assoc()){
												
									?>
									<h4><?php echo number_format((float)$rs['total'], 2, '.', ',')?> Tk</h4>
									<?php
											}
										}else{
											echo "NO Sale Yet"; 
										}
									?>  
									</div>
								</div>								
								<div class="col-md-3 col-sm-3">
									<div class="bg-warning well" style="width:100%; margin-left:20px; padding:30px;">
									<h3>Today Dues</h3>
									<?php 
										$date=date('Y-m-d'); 
										$query3="SELECT SUM(invoice_total) as paid, SUM(amount_paid) as due from invoices where created like '%$date'"; 
										$res3=$db->select($query3);
										if (!empty($res3)){
											while($rs3=$res3->fetch_assoc()){
												
											$paid=$rs3['paid'];
											$due=$rs3['due'];
											$total=$paid-$due;
												
									?>
									
									
									<h4><?php 
									if ($total>0){
									echo number_format((float)$total, 2, '.', ','); 
									
									}else{
										echo "0.00";
									}
									?> Tk</h4>
								 
									<?php
											}
										}else{
											echo "NO Sale Yet"; 
										}
									?> 
									</div>
								</div>
								<div class=" col-md-3 col-sm-3">
									<div class="bg-warning well" style="width:100%; margin-left:20px; padding:30px;">
									<h3>Today Collections</h3>
									<?php
										$date=date('Y-m-d'); 
										
										$query2="SELECT SUM(amount_paid) as collection from invoices where created like '%$date'"; 
										$res2=$db->select($query2);
										if (!empty($res2)){
											while($rs2=$res2->fetch_assoc()){
												
									?>
									<h4><?php echo number_format((float)$rs2['collection'], 2, '.', ',')?> Tk</h4>
									<?php
											}
										}else{
											echo "Not yet collected"; 
										}
									?> 
									</div>
								</div>
								<div class=" col-md-offset-1 col-md-3 col-sm-3">
									<div class="bg-warning well" style="width:100%; margin-left:20px; padding:30px;">
									<h3>Total Dues</h3>
									<?php 
										$date=date('Y-m-d'); 
										$query3="SELECT SUM(invoice_total) as paid, SUM(amount_paid) as due from invoices"; 
										$res3=$db->select($query3);
										if (!empty($res3)){
											while($rs3=$res3->fetch_assoc()){
												
											$paid=$rs3['paid'];
											$due=$rs3['due'];
											$total=$paid-$due;
												
									?>
									
									
									<h4><?php 
									if ($total>0){
									echo number_format((float)$total, 2, '.', ','); 
									
									}else{
										echo "0.00";
									}
									?> Tk</h4>
								 
									<?php
											}
										}else{
											echo "NO Sale Yet"; 
										}
									?> 
									</div>
								</div>
								<div class="col-md-3 col-sm-3">
									<div class="bg-warning well" style="width:100%; margin-left:20px; padding:30px;">
									<h3>Monthly Sales</h3>
									<?php
										$date2=date('Y-m'); 
										
										$query2="SELECT SUM(invoice_total) as total from invoices where created like '$date2%'"; 
										$res2=$db->select($query2);
										if (!empty($res2)){
											while($rs2=$res2->fetch_assoc()){
												
									?>
									<h4><?php echo number_format((float)$rs2['total'], 2, '.', ',')?> Tk</h4>
									<?php
											}
										}else{
											echo "NO Sale Yet"; 
										}
									?> 
									</div>
								</div>
								<div class="col-md-3 col-sm-3">
									<div class="bg-warning well" style="width:100%; margin-left:20px; padding:30px;">
									<h3>Monthly Purchase</h3>
									<?php
										$date6=date('Y-m'); 
										
										$query6="SELECT SUM(purchase_total) as total from purches_product where date like '$date6%'"; 
										$res6=$db->select($query6);
										if (!empty($res6)){
											while($rs6=$res6->fetch_assoc()){											
												$tpurches=$rs6['total']; 
											}
									?>
									<h4><?php echo number_format((float)$tpurches, 2, '.', ',')?> Tk</h4>
									<?php
											
										}else{
											echo "NO Purchase Yet"; 
										}
									?> 
									</div>
								</div>
								
							</div>
							
							
						</div>
					</div>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		

<?php include("inc/footer.php"); ?> 
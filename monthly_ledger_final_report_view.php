<?php

	if (isset($_POST['submit'])){
		$from 	= $_POST['from'];
		$to 	= $_POST['to'];
	}else{
		echo"No Data Found";
	} 
include("inc/header.php");
include("lib/function.php");
 ?>  
	 
	<!-- Main Area -->
		<section class="add_new_member " >
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="from_border_3">
					<button onclick="history.go(-1);" class="btn btn-warning">Previous Page </button>
						 <div class="container">
							<div class="row">
							<div class="col-sm-10 col-sm-offset-1 print_area">
							
								<h3 class="text-center"> <span style="text-align:center; 
								color:#000; font-weight:bold;">Income and Expenditure Accounts Report</span> </h3>
								<br />
								<h4 style="text-align:center; font-weight:bold;">
								<span style="text-align:center; color:red; font-weight:bold;">From:</span> <?php echo $from; ?> 
								<span style="text-align:center; color:red; font-weight:bold;"> To: </span><?php echo $to; ?>
								</h4> 
								<div class="text-center"> 
								<h3> Purchase  & Stock </h3>
								
								</div>
								
								<table class="table table-striped table-bordered table-responsive text-left" style="width:100%; margin:0px auto;;">
									<thead>
										<tr class="bg-info">
											<th style="width:50px;">S.L</th> 
											<th>Particular</th>
											<th style="width:150px;">Amount</th>
										</tr>
									</thead>
									<tbody>
										<!--EC Members Subscription Table --> 
										 
											<tr>
												<td> 1 </td>
												<td> Total Product Purchase </td>
												<?php  
													$query6="SELECT sum(purchase_total) as ptotal from purches_product where date>='$from' and date<='$to'"; 
													$res6=$db->select($query6);
													if (!empty($res6)){
														while($rs6=$res6->fetch_assoc()){
															$ptotal=$rs6['ptotal']; 
														}
												?>
												<td><?php echo number_format((float)$ptotal, 2, '.', ',')?> Tk </td>
												<?php	
													}else{
														echo "0.00"; 
													}
												?> 
												 
											</tr>
											<tr>
												<td>2 </td>
												<td>Total Stock (Purchase Price)</td>
												
													<td><?php
													$stocktotal=Stock($db,$from,$to); 
													echo number_format((float)$stocktotal, 2, '.', ','); 
													
													?> Tk</td>
												
																							
											</tr> 
											<td>3 </td>
												<td>Possiblity Stock Income</td>
													<?php
														
														$querystock="select Sum(price) as Rate, Sum(stock_quantity) as Qty, 
														Sum(price*stock_quantity) as Result from stock_product where date>='$from' and date<='$to'"; 
														$resstock=$db->select($querystock);
														if (!empty($resstock)){
															while($stock=$resstock->fetch_assoc()){
																$results=$stock['Result']; 
																
													?>
													<td><?php echo number_format((float)$results, 2, '.', ',')?> Tk</td>
													<?php
															}
														}else{
															echo "NO Sale Yet"; 
														}
													?> 
																							
											</tr>  
											
											
									</tbody> 
									 
								</table>
								
								
								<div class="text-center"> 
								<h3> Sales </h3>
								
								</div>
								
								<table class="table table-striped table-bordered table-responsive text-left" style="width:100%; margin:0px auto;;">
									<thead>
										<tr class="bg-info">
											
										</tr><th style="width:50px;">S.L</th> 
											<th>Particular</th>
											<th style="width:150px;">Sales Amount</th>
									</thead>
									<tbody>
										<!--EC Members Subscription Table --> 
										  
											<tr>
												<td> 1</td> 
												<td> Total Sales </td> 
													<td>
													<?php 
													$totalsales=TotalSalesSalesPrice($db,$from,$to);
													echo number_format((float)$totalsales, 2, '.', ',')
													
													?> 
													Tk</td>
													 
																							
											</tr>  
											<tr>
												<td> 2 </td>
												<td>Total Paid Amount (With Tax) </td>
												 
												<td>
												<?php  
												$paidfun=PaidAmount($db,$from,$to);
												echo number_format((float)$paidfun, 2, '.', ','); 
												?> Tk
												</td> 									
											</tr>
											<tr>
												<td> 3 </td>
												<td>Total Sales Dues</td> 
												  
													<td><?php 
													
													$duesfun=$collectamount-$Alldues; 
													echo $Alldues; 
													if ($duesfun>0){
													echo number_format((float)$duesfun, 2, '.', ','); 													 
													}else{
														echo "0.00";
													}
													?> Tk</td> 							
											</tr> 
											
											
											<tr>
												<td> 4 </td>
												<td>Dues Collection </td> 
												  
													<td><?php 
													$c=ColectSum($db,$from,$to);
													if ($c>0){
													echo number_format((float)$c, 2, '.', ','); 
													 
													}else{
														echo "0.00";
													}
													?> Tk</td> 							
											</tr> 
											
											
											<tr>
												<td> 5 </td>
												<td>Total Income Tax Amount</td> 
												  
													<td><?php 
													$tax=IncomeTax($db,$from,$to); 
													if ($tax>0){
													echo number_format((float)$tax, 2, '.', ','); 
													 
													}else{
														echo "0.00";
													}
													?> Tk</td> 							
											</tr>  
											<tr>
												<td> 6</td>
												<td>Total Sales Profit</td> 
													<td><?php 
													
													$tpsales=TotalSalesSalesPrice($db,$from,$to); 
													$tppsales=TotalSalesPurchasePrice($db,$from,$to); 
													$totalprofit=$tpsales-$tppsales; 
													if ($totalprofit>0){
													echo number_format((float)$totalprofit, 2, '.', ','); 
													 
													}else{
														echo "0.00";
													}
													?>Tk</td> 							
											</tr>  
									</tbody> 
									 
								</table>
								
								<div class="text-center"> 
								<h3> Bank Deposit </h3> 
								</div>
								
								<table class="table table-striped table-bordered table-responsive text-left" style="width:100%; margin:0px auto;;">
									<thead>
										<tr class="bg-info">
											<th style="width:50px;">S.L</th> 
											<th>Particular</th>
											<th style="width:150px;">Deposit Amount</th>
										</tr>
									</thead>
									<tbody>
										<!--EC Members Subscription Table -->  
									 
											<tr>
												<td> 1</td> 
												<td>All Bank Deposit Amount </td>
									 
												<td><?php 
												
												$bankdeposit=bankdeposit($db,$from,$to);
												echo number_format((float)$bankdeposit, 2, '.', ',') 
												
												?> </td> 		
											</tr>   
									 
									</tbody> 
									 
								</table>
								
								
								<!-- Start Expens -->
								
								<div class="text-center"> 
								<h3> Expendetures </h3>
								
								</div> 
									 <!--Expens Rent Table --> 
												
										
									
								
								<table class="table table-striped table-bordered table-responsive text-left" style="width:100%; margin:0px auto;;">
									<thead>
										<tr class="bg-info">
											<th style="width:50px;">S.L</th> 
											<th>Particular</th>
											<th style="width:150px;">Amount</th>
										</tr>
									</thead>
									<tbody>  
										
										<?php
											$chk="SELECT * FROM expens_head";
											$check=$db->select($chk);
											$id=0; 
											if($check){
											while ($chrs=$check->fetch_assoc()){
											$id++;
											$head_id=$chrs['id'];
												
											$query="SELECT SUM(amount) as amount FROM `expens` where head_id=$head_id 
											and date>= '$from' and date<= '$to' ";						
											$results=$db->select($query);
											
											if ($results){	
											?>
											<?php
											while($rs=$results->fetch_assoc()){
											
											?>	 					
										<tr>
											<td><?php echo $id; ?></td>	 
											<td><?php echo $chrs['expense_head'] ; ?></td> 
											<td><?php echo number_format($rs['amount']); ?>.00 </td>
										</tr>
											
											<?php }?>
											<?php } else{?>
											<div class="well text-center"> <h3> No Data Found</h3></div>
											<?php }  ?>	
											<?php }?>
											<?php }?>
									</tbody>
									<tfoot>
								
										
								<!-- End Expens -->
										
										<tr>
											<td></td>											
											<td class="text-right">Total Expense=</td>
											<td>
												<?php 
													$ex=expnes($db,$from,$to);
													echo number_format($ex).".00<br />\n";
												?> 
											</td>
										</tr>
										<tr>
											<td></td>											
											<td class="text-right">Total Sales Profit=</td>
																					
											<td><?php 
												echo number_format((float)$totalprofit, 2, '.', ',')?> Tk
											</td>
										</tr>
										<tr>
											<td></td>											
											<td class="text-right">Lose or Profit This Preiod=</td>
											<td>
											<?php 
											//retirve data from function
											$loseprofit	= $totalprofit-$ex;
											echo number_format((float)$loseprofit, 2, '.', ',')?> 
											</td>
										</tr>

										<tr>
											<td></td>											
											<td class="text-right">Hard Cash=</td>
											<td>
											<?php 
											//retirve data from function 
											$loseprofit	= $totalprofit-$ex;
											$bankdeposit=bankdeposit($db,$from,$to);											
											$hardcash=$loseprofit-$bankdeposit+$tax; 
											if($hardcash>0){
											echo number_format((float)$hardcash, 2, '.', ',');
											}else{
												echo"0.00"; 
											}
											?> 
											
											</td>
										</tr>
										
									 <!--End Expens Rent Table --> 
									</tbody> 
									
									
								</table> 
										
								
							</div>
						 </div>
					</div>
				</div>
			</div>
		</div>
		</section>
		
		<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
					<br />
						<form action="final_summery_pdf.php" target="blank" method="post">
							<input type="hidden" name="from" value="<?php echo $from; ?> " />
							<input type="hidden" name="to" value="<?php echo $to; ?> "/>
							<input type="submit" class="btn btn-danger" name="submit" value="Print Or Download" />
						</form>
						<br />
					</div>
				</div>
		</div>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
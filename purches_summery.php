
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					
					<div class="form-group from_border_3">
						<h4 class="well text-center"> <span style="color:#fff;">Purchas History</span></h4>
							<div class="wrapper_about">
							<table id="example" class="table table-striped table-bordered" style="width:95%">
								<thead>
									<tr>
										<th>Invoice No</th>
										<th>Purches Date</th>
										<th>Product Name</th>
										<th>Catagory</th>										
										<th>Brand</th>										
										<th>Quantity</th> 									
										<th>Purches Price</th> 
										<th>Sale Price</th> 
										<th>Discount</th> 
										<th>Action</th> 
										
									</tr>
								</thead>
								<tbody>
										<?php
											$query="SELECT * FROM purches_product order by id DESC";
											$results=$db->select($query);
											$id=0; 
											if($results==true){
												while($rs=$results->fetch_assoc()){
												$id++; 
										?> 							
									 <tr class="unread">								
										<td><?php echo 'PINV-'.' '.$rs['id']; ?></td>
										<td><?php echo $rs['date']; ?></td>																	
										<td>
										<?php 
										
												$proid= $rs['product_id'];
												$query2="SELECT * From product_table where product_code=$proid";
												$results2=$db->select($query2);
												if($results2==true){
													while($rs2=$results2->fetch_assoc()){
															echo $rs2['product_name']; 
														} 
												}
										?>
										</td>																	
										<td>
										<?php 
										
												$cat= $rs['catagory_id'];
												$query2="SELECT * From product_catagory where id=$cat";
												$results2=$db->select($query2);
												if($results2==true){
													while($rs2=$results2->fetch_assoc()){
															echo $rs2['name']; 
														} 
												}
										?>
										</td>
										<td>
										<?php 
										
												$br= $rs['brand_id'];
												$query2="SELECT * From brand_name where id=$br";
												$results2=$db->select($query2);
												if($results2==true){
													while($rs2=$results2->fetch_assoc()){
															echo $rs2['name']; 
														} 
												}
										?>
										
										</td>
										<td><?php echo $rs['purches_quntity'];  ?></td>
										<td><?php echo number_format((float)$rs['purches_price'], 2, '.', ',') ; ?></td>
										<td><?php echo number_format((float)$rs['unite_price'], 2, '.', ',') ; ?></td>
										<td><?php echo $rs['discount'];  ?></td>
										<td>
										<a href="edit_product.php?id='<?php echo $rs['id']; ?>'" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a> 
										<a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
										</td>
										
									</tr> 
									<?php } }?>
							  
								</tbody>
								<tfoot>
									
								</tfoot>
							</table>
					
					
					</div> 
					
			 </div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
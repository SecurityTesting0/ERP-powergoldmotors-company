
<?php include("inc/header.php"); ?> 
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				<div class="row">	
					
					<div class="form-group from_border_3">
						<h4 class="well text-center"> <span style="color:#fff;">All Product List</span></h4>
							<div class="wrapper_about">
							<table id="example" class="table table-striped table-bordered" style="width:95%">
								<thead>
									<tr>
										<th>Product Code</th>
										<th>Product Name</th>
										<th>Catagory</th>										
										<th>Price</th> 									
										<th>Description</th> 
										<th>Discount</th> 
										<th>Action</th> 
										
									</tr>
								</thead>
								<tbody>
										<?php
											$query="SELECT * From product_table";
											$results=$db->select($query);
											$id=0; 
											if($results==true){
												while($rs=$results->fetch_assoc()){
												$id++; 
										?> 
										
									 <tr class="unread">								
										<td><?php echo $rs['product_code']; ?></td>
										<td><?php echo $rs['product_name']; ?></td>
										
										<td><?php 
										
												$cat_id= $rs['product_cat_id'];
												$query2="SELECT * From product_catagory where id=$cat_id";
												$results2=$db->select($query2);
												if($results2==true){
													while($rs2=$results2->fetch_assoc()){
															echo $rs2['name']; 
														} 
												}
										?></td>										
										<td><?php echo $rs['unite_price']; ?></td>
										<td><?php echo $rs['description']; ?></td>
										<td><?php echo $rs['discount']; ?></td>
										<td><a href="edit_product.php?id='<?php echo $rs['id']; ?>'" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a> <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
										
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
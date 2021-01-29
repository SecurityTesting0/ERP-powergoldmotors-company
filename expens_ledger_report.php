<?php include("inc/header.php"); ?>  
	

<?php
error_reporting(0);
	if (isset($_POST['submit'])){
		$from 	= $_POST['from'];
		$to 	= $_POST['to'];
	}else{
		echo"No Data Found";
	}

?>
		<!-- Main Area -->
		<section class="add_new_member ">
			 <div class="container">
				
				<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="from_border_3">
					<h3 class="text-center"> <span style="text-align:center; color:green; font-weight:bold;">Expens Ledger</span> </h3>
					<br />
					<h4 style="text-align:center; font-weight:bold;">
					<span style="text-align:center; color:red; font-weight:bold;">From:</span> <?php echo $from; ?> 
					<span style="text-align:center; color:red; font-weight:bold;"> To: </span><?php echo $to; ?>
					</h4>
					
					
					<?php	
											
						$query="SELECT * FROM `expens` where date>= '$from' and date<= '$to' ";						
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
					<table id="example" class="display table-hover table table-bordered table-striped table-reponsive" style="width:95%;">
						<thead>
							<tr class="bg-success">
								<th>S.L</th>
								<th>Invoice Date</th>
								<th>Head</th>
								<th>Narration</th>
								<th>Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while($rs=$results->fetch_assoc()){
							$id++;
							?>	 					
							<tr>
								<td><?php echo $id; ?></td>	
								<td><?php echo $rs['date']; ?> </td>


								<td>
                                    <?php
                                        $cxid=$rs['head_id'];



                                        $query="SELECT * FROM expens_head where id='$cxid'";
                                        $ctres=$db->select($query);
                                        if ($ctres==true){
                                            while($catres=$ctres->fetch_assoc()){
                                                echo $catres['expense_head'];
                                            }
                                        }else{
                                            echo "Not found";
                                        }

                                    ?>
                                </td>


								<td><?php echo $rs['narration']; ?> </td>
								<td><?php echo number_format((float)$rs['amount'], 2, '.', ','); ?></td>
								<td>
								<a href="edit_expnese.php?id='<?php echo $rs['id']; ?>'" class="btn btn-warning">Edit </a>
								<a href="ex_voucher_print.php?exvid='<?php echo $rs['id']; ?>'" target="blank" class="btn btn-success">Recipt </a>
								</td>
							</tr>
							</form> 
							
							<?php }?>
							<?php } else{?>
							<div class="well text-center"><h3> No Data Found</h3></div>
							<?php }  ?>
						
							
							
						</tbody>
						<tfoot>
						<?php		
						$get_by_month = date("Y-m");
						$query="SELECT SUM(amount) AS amount from `expens` where date>= '$from' and date<= '$to'";
						
						$results=$db->select($query);
						$id=0; 
						if ($results){	
						?>
						<?php
							while($rs=$results->fetch_assoc()){
							$id++; 	
							
							?>
							<tr class="bg-success">
								<th colspan="4" style="text-align:right;">Total=</th>
								<th><?php echo number_format((float)$rs['amount'], 2, '.', ',');?></th>							
							</tr>
							<?php }?>
							<?php }?>
						</tfoot>
					</table>
					</div>
				</div>
			 </div>
		</section>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<form action="expens_summery_pdf.php" target="blank" method="post">
							<input type="hidden" name="from" value="<?php echo $from; ?> " />
							<input type="hidden" name="to" value="<?php echo $to; ?> "/>
							<input type="submit" class="btn btn-danger" name="submit" value="Download Report" />
						</form>
					</div>
				</div>
			</div>
		</section>
		<!-- End Main Area -->
		
<?php include("inc/footer.php"); ?> 
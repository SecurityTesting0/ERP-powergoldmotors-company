<?php
ob_start(); 
include("inc/header.php");

?> 

	

		<section class="main_area main_area_text">
			 <div class="container">
				<div class="row">
					<div class="col-md-12">
							<div class="generate2"> 
								
								<h3>Click to Backup Database <i class="fa fa-database"></i> </h3>
								<hr />
								<div>						
									<?php
										if(isset($_POST["backup"])) {
										$dbhost ='localhost';
										$dbuser = 'root';
										$dbpass = '';
										$dbname = 'powergoldmotors';
										$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
										$backupAlert = '';
										$tables = array();
										$result = mysqli_query($connection, "SHOW TABLES");
										if (!$result) {
											$backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
										} else {
											while ($row = mysqli_fetch_row($result)) {
												$tables[] = $row[0];
											}
											mysqli_free_result($result);

											$return = '';
											foreach ($tables as $table) {

												$result = mysqli_query($connection, "SELECT * FROM " . $table);
												if (!$result) {
													$backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
												} else {
													$num_fields = mysqli_num_fields($result);
													if (!$num_fields) {
														$backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
													} else {
														$return .= 'DROP TABLE ' . $table . ';';
														$row2 = mysqli_fetch_row(mysqli_query($connection, 'SHOW CREATE TABLE ' . $table));
														if (!$row2) {
															$backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($connection) . 'ERROR NO :' . mysqli_errno($connection);
														} else {
															$return .= "\n\n" . $row2[1] . ";\n\n";
															for ($i = 0; $i < $num_fields; $i++) {
																while ($row = mysqli_fetch_row($result)) {
																	$return .= 'INSERT INTO ' . $table . ' VALUES(';
																	for ($j = 0; $j < $num_fields; $j++) {
																		$row[$j] = addslashes($row[$j]);
																		if (isset($row[$j])) {
																			$return .= '"' . $row[$j] . '"';
																		} else {
																			$return .= '""';
																		}
																		if ($j < $num_fields - 1) {
																			$return .= ',';
																		}
																	}
																	$return .= ");\n";
																}
															}
															$return .= "\n\n\n";
														}

														$backup_file = $dbname . date("Y-m-d-H-i-s") . '.sql';
														$handle = fopen("{$backup_file}", 'w+');
														$location=fwrite($handle, $return);
														$location="D:\backups".$location; 
														fclose($handle);
														$backupAlert = 'Succesfully got the backup!';
													}
												}
											}
										}
										echo $backupAlert;
										}
										
									
										?>
										<form  action="" method="post" enctype="multipart/form-data">
											 
												<div class="form-group">
													<div class="col-md-12 col-xl-12">
														<input type="submit" name="backup" class=" form-control btn btn-success" value=" Backup Now"/>
													</div>
											   </div>									   
										</form>           
								</div>
							</div>
					</div>
				</div>
			 </div>
		</section>
		<!-- End Main Area -->
		

<?php
include('inc/footer.php');

?>


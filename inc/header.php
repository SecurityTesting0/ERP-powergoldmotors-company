<?php
ob_start();
include("lib/session.php");
Session::checkSession();
error_reporting(0);
?> 
<?php
 $userid	=Session::get('userID');
 $Status	=Session::get('role_id');

?>

<?php
include("lib/config.php");
include("lib/database.php");
include("lib/helper.php");
$db = new Database();
$fm = new Formate();
?> 

<!doctype html>
<html lang="en">
  <head>
 <!--<meta http-equiv="refresh" content="30"/>-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Power Motors ltd.</title>

    <!-- Bootstrap -->
	<link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
	
	 <!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css'>
	<link href="css/jquery-ui.min.css" rel="stylesheet">
	<link href="css/datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="css/select2.min.css" >	
	<link rel="stylesheet" href="css/style.css">
	<style type="text/css">
		ai .fa{
			color:#f0ad4e; font-size:20px;"
		}
	</style>

  </head>
 <body>
 
 
 <div class="main_border_area">
		 <!-- Header Area
		<section class="header_area">
			  <div class="container ">
				<div class="row text-wrap">
					<div class="col-xs-6 col-md-6 col-lg-6 text-left">
					
					<?php 
						$query="SELECT * From company_info"; 
						$results=$db->select($query);
						if($results==true) {
							while ($rs=$results->fetch_assoc()){					
					?>
						<h3> <span style="color:red; font-weight:bold;"><?php echo $rs['company_name_first_part'];?></span> 
						<span style="color:green; font-weight:bold;"><?php echo $rs['comapnay_name_last_part'];?></span></h2>
						<h4> Address: <?php echo $rs['address'];?></h4>
					<?php } ?>
					<?php } ?>
					</div>
					<div class="col-xs-6 col-md-6 col-lg-6   ">
						<p> Welcome Admin</p>
						<?php
							if(isset($_GET['action']) && $_GET['action'] == "logout"){
								Session::destory();
							}
						 ?>	 
						<p><a href="?action=logout" class="btn btn-default btn-small btn-danger">Logout</a></p>
					</div>
				</div>
			</div>
		</section>  -->
		
		<section class="print_header text-center">
			  <div class="container">
				<div class="row">
					<div class="col-xs-12">
					<?php 
						$query="SELECT * From company_info"; 
						$results=$db->select($query);
						if($results==true) {
							while ($rs=$results->fetch_assoc()){					
					?>
						<h3><?php echo $rs['company_name_first_part'].' '.$rs['comapnay_name_last_part'];?></h3>
						<p>Address: <?php echo $rs['address'];?></p>
					<?php } ?>
					<?php } ?>
					</div>
				</div>
			</div>
		</section>
		
		<!--End Header Area -->


		<!-- Navbar Area -->

			<?php 
				if($Status==1){
					include("inc/menu_admin.php"); 
				}else{
					include("inc/menu_saller.php"); 
				}
			
			?> 
		<!-- End Navbar Area -->

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Power Motors Limited </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	
	 <!-- font awesome -->
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/style.css">

  </head>
 <body>
 
 <?php

include("lib/session.php");
Session::init(); 

?> 

<?php
include("lib/config.php");
include("lib/database.php");
include("lib/helper.php");

$db = new Database();
$fm = new Formate();

?> 
 
 <div class="main_border_area"> 
		
		<?php
		if($_SERVER['REQUEST_METHOD'] =='POST'){
			$username =$fm->validation($_POST['username']);
			$password =$fm->validation(md5($_POST['password']));
			
			$username = mysqli_real_escape_string($db->link,$username);
			$password = mysqli_real_escape_string($db->link,$password);
			
			$query ="SELECT * FROM admin_user WHERE username = '$username' AND password = '$password'" ; 
			$results =$db->select($query); 
			if($results != false){
					$value 	= mysqli_fetch_array($results);
					$rows 	= mysqli_num_rows($results); 
					if($rows > 0){
						Session::set("login", true);			
						Session::set("username", $value['username']);			
						Session::set("userID", $value['id']);	
						Session::set("role_id", $value['role_id']);	
						header("Location:index.php");
					}else{
						echo"No Reuslts Found";
					}								
				
			}else{
				echo"<spna style='color:red; font-size:18px;'> <script> alert('You are not valid user'); </script></span>"; 
			}
			
		}
	
	
	?>

		<!-- Header Area -->
		
		<section class="login_area text-center">
				<img src="img/logosingle.png" alt="" style="width:100px; "/>
				<p style="font-weight:bold; font-size:20px; text-align:center;"> Login Panel</p>
			  <form action="" method="post" class="form-horizontal">
				  <div class="form-group">
					<label for="inputEmail3" class="col-sm-1 control-label"><i class="fas fa-user"></i> </label>
					<div class="col-sm-11">
					  <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="UserName">
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputPassword3" class="col-sm-1 control-label"><i class="fas fa-lock"></i> </label>
					<div class="col-sm-11">
					  <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
					</div>
				  </div> 
				  <div class="form-group">
					<div class="col-sm-offset-1 col-sm-11">
					  <button type="submit" name="submit" class="btn btn-info btn-block">Login</button>
					</div>
				  </div>
				</form>
				
				<img src="img/copyright.png" alt="" style="width:120px; margin-top:20px;" />
		</section>
		<!--End Header Area -->
	</div>

<!--End Main Border Area -->

<!-- Blank Area -->
<section class="copy_right_area text-center">
     <div class="container">
     	<div class="row">
     		<div class="col-md-12">
				<p> Design & Devloped by: <a href="https://facebook.com/ibrahimaliwd" target="blank">Ibrahim Ali</a></p>
			</div>
     	</div>
     </div>
</section>

<!-- Blank Main Area -->

<!--End Main Border Area --> 


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.12.4.min.js"></script>
    
<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
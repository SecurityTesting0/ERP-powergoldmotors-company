<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '0');
?>
<?php include("inc/header.php"); ?> 
		
		<?php
		if(isset($_GET['id'])){
				$delteach =$_GET['id'];		
		}else{
			echo"Wrong Command";
		}
		
		?>


		<?php
			if ($delteach==true){
				$query ="DELETE FROM employee WHERE id=$delteach";
				$del =$db->delete($query);

				if($del){
					echo "<script> alert ('Employee delete Successfully') </script>";
					echo "<script> window:location ='employee_list.php'; </script>";
				} else {
					echo "Data not Delete";
				}
			}

		?>

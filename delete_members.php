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
				$query ="DELETE FROM members WHERE id=$delteach";
				$del =$db->delete($query);

				if($del){
					echo "<script> alert ('Members delete Successfully') </script>";
					echo "<script> window:location ='viewmembers_active.php'; </script>";
				} else {
					echo "Data not Delete";
				}
			}

		?>

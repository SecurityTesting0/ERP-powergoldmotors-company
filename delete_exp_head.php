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
				$query ="DELETE FROM expens_head WHERE id=$delteach";
				$del =$db->delete($query);

				if($del){
					echo "<script> alert ('Head delete Successfully') </script>";
					echo "<script> window:location ='add_newhead.php'; </script>";
				} else {
					echo "Data not Delete";
				}
			}

		?>

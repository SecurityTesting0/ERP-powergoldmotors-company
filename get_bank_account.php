<?php
include("lib/config.php");
include("lib/database.php");
include("lib/helper.php");
$db = new Database();
$fm = new Formate();
if(isset($_GET["id"])){
?>  		
<?php
$query ="SELECT * FROM bank_info WHERE code='".$_GET["id"]."'";	
		$results =$db->select($query);
			if ($results){ while ($sho= $results->fetch_assoc()) {
				?>
				<option value="<?php echo $sho['account']; ?>" selected><?php echo $sho['account']; ?></option>
				<input type="hidden" name="bank_name" value="<?php echo $sho['name'];?>" />
				
				<?php 
				 
			}
		}
}
?> 
		
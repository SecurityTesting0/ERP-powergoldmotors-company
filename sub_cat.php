<?php
include("lib/config.php");
include("lib/database.php");
include("lib/helper.php");
$db = new Database();
$fm = new Formate();
if(isset($_GET["Property_id"])){
?> 

		
			   <?php
					$query ="SELECT * FROM `masjid_property` WHERE `Property_id`='".$_GET["Property_id"]."'";	
					$results = $db->select($query);
					if ($results){?>
					<?php while ($showpprogramname = $results->fetch_assoc()) {
				?> 						
				<option value="<?php echo $showpprogramname['Rent'];?> "> <?php echo $showpprogramname['Rent'];?> </option>						  
				<?php } ?> 
				<?php } 
}		
?> 
		
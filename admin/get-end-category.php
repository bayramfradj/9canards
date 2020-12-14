<?php

include_once('../model/EndCategory.php');
$EndCategory =new EndCategory();
if($_POST['id'])
{
	$id = $_POST['id']; 
	
	$statement = $EndCategory->ListWithMCat($id);
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	?><option value="">Select End Level Category</option><?php						
	foreach ($result as $row) {
		?>
        <option value="<?php echo $row['ecat_id']; ?>"><?php echo $row['ecat_name']; ?></option>
        <?php
	}
}
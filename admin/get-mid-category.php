<?php

include_once('../model/MidCategory.php');
$MidCategory =new MidCategory();
if($_POST['id'])
{
	$id = $_POST['id']; 
	
	$statement = $MidCategory->ListWithTCat($id);
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	?><option value="">Select Mid Level Category</option><?php						
	foreach ($result as $row) {
		?>
        <option value="<?php echo $row['mcat_id']; ?>"><?php echo $row['mcat_name']; ?></option>
        <?php
	}
}
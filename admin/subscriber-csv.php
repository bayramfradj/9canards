<?php

include_once('../model/Subscriber.php');
$Subscriber = new Subscriber();
$now = gmdate("D, d M Y H:i:s");
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=subscriber_list.csv');  
$output = fopen("php://output", "w");  
fputcsv($output, array('SL', 'Subscriber Email'));  
$statement = $Subscriber->GetAllActive();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	fputcsv($output, array($row['subs_id'],$row['subs_email']));
} 
fclose($output);
?> 
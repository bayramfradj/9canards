<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="device" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>


<?php
include_once('google/get-data.php');
$ga= new GA;
/*echo "<pre>";
print_r($ga->Browser('2018-01-01','2018-03-18'));
echo "</pre>";

echo date('Y-M-d',strtotime('-1 year'));
echo date('Y-M-d');*/
$ga->outputdevice();


?>

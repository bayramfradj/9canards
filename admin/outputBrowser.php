<?php


if (isset($_POST['name'])) {
	include_once('google/get-data.php');
	$ga= new GA;

	if ($_POST['name']=='browser') {
		echo $ga->outputBrowser(); 

	}
	if ($_POST['name']=='Month') {
		echo $ga->outputMonth(); 

	}
	if ($_POST['name']=='Day') {
		echo $ga->outputDay(); 

		echo "<script type='text/javascript'>

				Highcharts.chart('days', {
			    data: {
			        table: 'datatable'
			    },
			    chart: {
			        type: 'column'
			    },
			    title: {
			        text: 'Last 7 Days Traffic'
			    },
			    yAxis: {
			        allowDecimals: true,
			        title: {
			            text: ''
			        }
			    },
			    tooltip: {
			        formatter: function () {
			            return '<b>' + this.series.name + '</b><br/>' +
			                this.point.y;
			        }
			    }
			});

			</script>";

	}
	if ($_POST['name']=='device') {
		echo $ga->outputdevice();

	}

}


?>
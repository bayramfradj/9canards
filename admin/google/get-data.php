<?php
/**
* analytics class
*/
// Load the Google API PHP Client Library.
require_once __DIR__ . '/vendor/autoload.php';
class GA
{	
	protected $analytics;
	protected $profileId;
	function __construct()
	{
		$this->analytics = $this->initializeAnalytics();
		$this->profileId = $this->getFirstProfileId($this->analytics);
	}
		

	function initializeAnalytics()
		{
		  
		  $KEY_FILE_LOCATION = __DIR__ .'/My Project 40878-a6b3e31b70c1.json';

		  $client = new Google_Client();
		  $client->setApplicationName("Hello Analytics Reporting");
		  $client->setAuthConfig($KEY_FILE_LOCATION);
		  $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
		  $analytics = new Google_Service_Analytics($client);

		  return $analytics;
		}

	function getFirstProfileId($analytics)
	{
 		 // Get the user's first view (profile) ID.

  		// Get the list of accounts for the authorized user.
		  $accounts = $analytics->management_accounts->listManagementAccounts();

		  if (count($accounts->getItems()) > 0) {
		    $items = $accounts->getItems();
		    $firstAccountId = $items[0]->getId();

		    // Get the list of properties for the authorized user.
		    $properties = $analytics->management_webproperties
		        ->listManagementWebproperties($firstAccountId);

		    if (count($properties->getItems()) > 0) {
		      $items = $properties->getItems();
		      $firstPropertyId = $items[0]->getId();

		      // Get the list of views (profiles) for the authorized user.
		      $profiles = $analytics->management_profiles
		          ->listManagementProfiles($firstAccountId, $firstPropertyId);

		      if (count($profiles->getItems()) > 0) {
		        $items = $profiles->getItems();

		        // Return the first view (profile) ID.
		        return $items[0]->getId();

		      } else {
		        throw new Exception('No views (profiles) found for this user.');
		      }
		    } else {
		      throw new Exception('No properties found for this user.');
		    }
		  } else {
		    throw new Exception('No accounts found for this user.');
		  }
	}

	function OrganicTraffic($start_date,$end_date)
	{
		
		$params = array(
			'dimensions' => 'ga:source' ,
			'filters' => 'ga:medium==organic',
			'metrics' => 'ga:sessions'
			 );
		return $this->analytics->data_ga->get(
			'ga:'.$this->profileId ,
			$start_date,
			$end_date,
			'ga:sessions',
			$params
		);
	}

	function NonOrganicTraffic($start_date,$end_date)
	{
		
		$params = array(
			'dimensions' => 'ga:source' ,
			'filters' => 'ga:medium!=organic',
			'metrics' => 'ga:sessions'
			 );
		return $this->analytics->data_ga->get(
			'ga:'.$this->profileId ,
			$start_date,
			$end_date,
			'ga:sessions',
			$params
		);
	}

	function Traffic($start_date,$end_date)
	{
		return $this->analytics->data_ga->get(
			'ga:'.$this->profileId ,
			$start_date,
			$end_date,
			'ga:sessions'
		);
	}

	function pageview($start_date,$end_date)
	{
		return $this->analytics->data_ga->get(
			'ga:'.$this->profileId ,
			$start_date,
			$end_date,
			'ga:pageviews'
		);
	}

	function Browser($start_date,$end_date)
	{
		
		$params = array(
			'dimensions' => 'ga:browser' ,
			'metrics' => 'ga:sessions',
			'sort'=>'-ga:sessions'
			 );
		return $this->analytics->data_ga->get(
			'ga:'.$this->profileId ,
			$start_date,
			$end_date,
			'ga:sessions',
			$params
		);
	}

	function deviceCategory($start_date,$end_date)
	{
		
		$params = array(
			'dimensions' => 'ga:deviceCategory' ,
			'metrics' => 'ga:sessions',
			'sort'=>'-ga:sessions'
			 );
		return $this->analytics->data_ga->get(
			'ga:'.$this->profileId ,
			$start_date,
			$end_date,
			'ga:sessions',
			$params
		);
	} 


	function outputdevice()
	{	$start_date= date('Y-m-d',strtotime('-1 year'));
		$end_date=date('Y-m-d');
		$data =$this->deviceCategory($start_date,$end_date);
		$total=$data['totalsForAllResults']['ga:sessions'];
		$browser=$data['rows'];

		?>
		<script type="text/javascript">
					Highcharts.setOptions({
			    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
			        return {
			            radialGradient: {
			                cx: 0.5,
			                cy: 0.3,
			                r: 0.7
			            },
			            stops: [
			                [0, color],
			                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
			            ]
			        };
			    })
			});

			// Build the chart
			Highcharts.chart('device', {
			    chart: {
			        plotBackgroundColor: null,
			        plotBorderWidth: null,
			        plotShadow: false,
			        type: 'pie'
			    },
			    title: {
			        text: 'Device, '+<?= date('Y'); ?>
			    },
			    tooltip: {
			        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			    },
			    plotOptions: {
			        pie: {
			            allowPointSelect: true,
			            cursor: 'pointer',
			            dataLabels: {
			                enabled: true,
			                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                style: {
			                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                },
			                connectorColor: 'silver'
			            }
			        }
			    },
			    series: [{
			        name: 'Share',
			        data: [
   
			            
			           <?php
			           	foreach ($browser as $key => $value) {
			           		
			           		echo "{ name: '".$value[0]."', y: ".number_format($value[1]/$total, 2, '.', '')." },";
			           	}



			           ?>
			        ]
			    }]
			});
			
		</script>
		<?php
	}




	function outputBrowser()
	{	$start_date= date('Y-m-d',strtotime('-1 year'));
		$end_date=date('Y-m-d');
		$data =$this->Browser($start_date,$end_date);
		$total=$data['totalsForAllResults']['ga:sessions'];
		$browser=$data['rows'];

		?>
		<script type="text/javascript">
			var pieColors = (function () {
   			 var colors = [],
			  base = Highcharts.getOptions().colors[0],i;

			    for (i = 0; i < 10; i += 1) {
			        // Start out with a darkened base color (negative brighten), and end
			        // up with a much brighter color
			        colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
			    }
			    return colors;
			}());

			// Build the chart
			Highcharts.chart('browsers', {
			    chart: {
			        plotBackgroundColor: null,
			        plotBorderWidth: null,
			        plotShadow: false,
			        type: 'pie'
			    },
			    title: {
			        text: 'Browsers, '+<?= date('Y'); ?>
			    },
			    tooltip: {
			        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			    },
			    plotOptions: {
			        pie: {
			            allowPointSelect: true,
			            cursor: 'pointer',
			            colors: pieColors,
			            dataLabels: {
			                enabled: true,
			                format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
			                distance: -50,
			                filter: {
			                    property: 'percentage',
			                    operator: '>',
			                    value: 4
			                }
			            }
			        }
			    },
			    series: [{
			        name: 'Share',
			        data: [
			            
			           <?php
			           	foreach ($browser as $key => $value) {
			           		
			           		echo "{ name: '".$value[0]."', y: ".number_format($value[1]/$total, 2, '.', '')." },";
			           	}



			           ?>
			        ]
			    }]
			});
			
		</script>
		<?php
	}




	function printResultMonth($organic,$nonorganic,$mon)
	{
			//$this->NonOrganicTraffic('2018-03-11','2018-03-16')['totalsForAllResults']['ga:sessions'];
		$strorg="[";
		foreach ($organic as $key => $value)
		{
			$strorg=$strorg.$value['totalsForAllResults']['ga:sessions'].',';
		}
		$strorg=$strorg."]";

		$strnorg="[";
		foreach ($nonorganic as $key => $value)
		{
			$strnorg=$strnorg.$value['totalsForAllResults']['ga:sessions'].',';
		}
		$strnorg=$strnorg."]";

		/*$first = strtotime('first day this month');
		$mon = array();
		for ($j=5 ; $j >=0  ; $j--)
		{	$mon[$j]="'".date('m/Y',strtotime('-$j month',$first))."'"; }*/
		

		$strmon="[";
		foreach ($mon as $key => $value)
		{
			$strmon=$strmon.$value.',';
		}
		$strmon=$strmon."]";



		echo "<script type='text/javascript'>
				Highcharts.chart('Monthly', {
			    chart: {
			        type: 'line'
			    },
			    title: {
			        text: 'Monthly traffic'
			    },
			    subtitle: {
			        text: ''
			    },
			    xAxis: {
			        categories: ".$strmon."
			    },
			    yAxis: {
			        title: {
			            text: 'sessions'
			        }
			    },
			    plotOptions: {
			        line: {
			            dataLabels: {
			                enabled: true
			            },
			            enableMouseTracking: true
			        }
			    },
			    series: [{
			        name: 'Organic Traffic',
			        data: ".$strorg."
			    }, {
			        name: 'No Organic Traffic',
			        data: ".$strnorg."
			    }]
			});
			</script>";
		

	}


	function outputMonth()
	{	
		$mon = array();
		$organic = array();
		$nonorganic = array();
		for ($j=12 ; $j>= 0 ; $j--) { 
			$start_date= date('Y-m',strtotime("-$j month")) .'-01';
			$d = new DateTime($start_date);
			$end_date = $d->format('Y-m-t');
			$mon[$j]="'".$d->format('M/Y')."'";
			$organic[$j]= $this->OrganicTraffic($start_date,$end_date);
			$nonorganic[$j]= $this->NonOrganicTraffic($start_date,$end_date);
		}

		$this->printResultMonth($organic,$nonorganic,$mon);
	}


	function printResultDays($days,$sessions,$pageviews)
	{

			?>
				<table id="datatable">
			    <thead>
			        <tr>
			            <th></th>
			            <th>Sessions</th>
			            <th>Page Views</th>
			        </tr>
			    </thead>
			    <tbody>



			<?php
			for ($i=0; $i <=7; $i++) { 


				?>
				<tr>
		            <th><?= $days[$i] ?></th>
		            <td><?= $sessions[$i]['totalsForAllResults']['ga:sessions']?></td>
		            <td><?= $pageviews[$i]['totalsForAllResults']['ga:pageviews']?></td>
        		</tr>



				<?php
				


			}

			?>
			 </tbody>
			</table>


			<?php
	}

	function outputDay()
	{
		$days=array();
		$sessions=array();
		$pageviews = array();
		for ($i=7; $i>=0; $i--)
		{ 
			$day=date('Y-m-d',strtotime("-$i day"));
			$d= new DateTime($day);	 
			$days[$i]= $d->format('d/M/Y');
			$sessions[$i]=$this->traffic($day,$day);
			$pageviews[$i]=$this->pageview($day,$day);

		}

		$this->printResultDays($days,$sessions,$pageviews);


	}



}



?>
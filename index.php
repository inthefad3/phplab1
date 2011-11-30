<?php

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
  <script>
  $(document).ready(function() {
    $("#sortable").sortable();
  });
  </script>

<link rel="stylesheet" type="text/css" href="style.css" />
<title>Conforming XHTML 1.1 Template</title></head><body>';


$states = new states();
/*
if(!$_GET) {

	foreach($states->state_list as $abv => $state) {
	
		echo '<a href="index.php?q=' . strtolower($abv) . '">' . $state . "</a> </br> \n";

	}
} else {
	
	$state = new sdjson($_GET['q']);

	foreach($state->data as $city) 
	{
		echo '<div id="sortable">';
		foreach($city as $key => $value) {		
			echo '<span class="city field ' . $key . '">' .$key . ': ' . $value . "</span><br> \n";
		
		}
		echo '</div>';
		echo '</p>';
	}
}*/

if(!$_GET) 
{
	foreach($states->state_list as $abv => $state) 
	{
		echo '<a href="index.php?q=' . strtolower($abv) . '">' . $state . "</a> </br> \n";

	}
} 
else 
{	
	$state = new statedata($_GET['q']);
	//print_r($state);
	//echo $state->sites;
	foreach($state->data as $city) 
	{	
		//echo $city;
		echo '<div id="sortable">';
		foreach($city as $key => $value) 
		{
		
			echo '<span class="city field ' . $key . '">' .$key . ': ' . $value . "</span><br> \n";
		
		}
		echo '</div>';
		echo '</p>';
	}
}
echo '</body> </html>';



class states 
{
	public $state_list = array
	(
		'AL'=>"Alabama",  
		'AK'=>"Alaska",  
		'AZ'=>"Arizona",  
		'AR'=>"Arkansas",  
		'CA'=>"California",  
		'CO'=>"Colorado",  
		'CT'=>"Connecticut",  
		'DE'=>"Delaware",  
		'DC'=>"District Of Columbia",  
		'FL'=>"Florida",  
		'GA'=>"Georgia",  
		'HI'=>"Hawaii",  
		'ID'=>"Idaho",  
		'IL'=>"Illinois",  
		'IN'=>"Indiana",  
		'IA'=>"Iowa",  
		'KS'=>"Kansas",  
		'KY'=>"Kentucky",  
		'LA'=>"Louisiana",  
		'ME'=>"Maine",  
		'MD'=>"Maryland",  
		'MA'=>"Massachusetts",  
		'MI'=>"Michigan",  
		'MN'=>"Minnesota",  
		'MS'=>"Mississippi",  
		'MO'=>"Missouri",  
		'MT'=>"Montana",
		'NE'=>"Nebraska",
		'NV'=>"Nevada",
		'NH'=>"New Hampshire",
		'NJ'=>"New Jersey",
		'NM'=>"New Mexico",
		'NY'=>"New York",
		'NC'=>"North Carolina",
		'ND'=>"North Dakota",
		'OH'=>"Ohio",  
		'OK'=>"Oklahoma",  
		'OR'=>"Oregon",  
		'PA'=>"Pennsylvania",  
		'RI'=>"Rhode Island",  
		'SC'=>"South Carolina",  
		'SD'=>"South Dakota",
		'TN'=>"Tennessee",  
		'TX'=>"Texas",  
		'UT'=>"Utah",  
		'VT'=>"Vermont",  
		'VA'=>"Virginia",  
		'WA'=>"Washington",  
		'WV'=>"West Virginia",  
		'WI'=>"Wisconsin",  
		'WY'=>"Wyoming"
	);
}
	


class	service  
{
	public $data;
	public $results;
				
	protected function request($url) 
	{
		$ch  = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$this->results = curl_exec($ch);
		curl_close($ch);
		if (json_decode($this->results) == true)
		{
			echo 'yes';
			$this->data = json_decode($this->results);
		}
		else 
		{
			echo 'no';
			$this->data = new SimpleXMLElement($this->results);
		}
	}
}
	
class statedata extends service 
{
		
	private $url = "http://api.sba.gov/geodata/city_county_links_for_state_of/";
				
	function __construct($state) 
	{
		$this->url .= $state;
		$this->url .= '.xml';
		$this->request($this->url);
	}
}



/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://api.sba.gov/geodata/city_county_links_for_state_of/nj.xml');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);

$xml = new SimpleXMLElement($data);
print_r($xml);
foreach($xml->site as $post) 
{
	echo $post->name . '</br>';
	echo $post->url . '</br>';
}
*/
	
?>
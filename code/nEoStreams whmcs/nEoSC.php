<?php

function nEoSC_ConfigOptions() {
	# Should return an array of the module options for each product - maximum of 24
	$configarray = array(
	 "Listeners" => array( "Type" => "dropdown", "Options" => "20,50,75,100"),
	 "Region" => array( "Type" => "dropdown", "Options" => "US,EU"),
	 "Type" => array( "Type" => "dropdown", "Options" => "SC,ICE,AUTO"),
	 "Product" => array( "Type" => "dropdown", "Options" => "daily,weekly,monthly"),
	 "Cost" => array( "Type" => "text", "Size" => "10", ),
	);
	return $configarray;
}

function nEoSC_CreateAccount($params) {
$date_format = "Y-m-d H:i:s";
	$myFile = "/var/www/vhosts/neostreams.info/httpdocs/neoshop/nEoSC.log";
	$fh = fopen($myFile, 'a') or die("Could not open log file for writing");
$stringData = date($date_format)." - \nCreating Account\n";
fwrite($fh, $stringData);

$stringData = date($date_format)." - \nParams: ".var_export($params,1)."\n";
fwrite($fh, $stringData);
    # ** The variables listed below are passed into all module functions **
$stringData = date($date_format)." - \nParsing Data\n";
fwrite($fh, $stringData);

    $serviceid = $params["serviceid"]; # Unique ID of the product/service in the WHMCS Database
    $pid = $params["pid"]; # Product/Service ID
	$username = $params["username"];
	$password = $params["password"];
    $clientsdetails = $params["clientsdetails"]; # Array of clients details - firstname, lastname, email, country, etc...
#    $customfields = $params["customfields"]; # Array of custom field values for the product
    $configoptions = $params; # Array of configurable option values for the product

#$stringData = date($date_format)." - \nConfig Options: ".var_export($configoptions,1)."\n";
#fwrite($fh, $stringData);
	$SECRET_NUMBER = "4829528";
	$kObjOwnerKey = "fce98332-0afd-4c82-83e7-a4dff01e0c10";
	$hashstring = $kObjOwnerKey.":"."fce98332-0afd-4c82-83e7-a4dff01e0c10";
$stringData = date($date_format)." - \nHashstring: ".$hashstring."\n";
fwrite($fh, $stringData);
	$MD5 = md5($hashstring.":".$SECRET_NUMBER);

$stringData = date($date_format)." - \nPre MD5 Hash Data: ".$hashstring.":".$SECRET_NUMBER."\n";
fwrite($fh, $stringData);

$stringData = date($date_format)." - \nMD5 Hash: ".$MD5."\n";
fwrite($fh, $stringData);

    # Product module option settings from ConfigOptions array above
    $Listeners = $params["configoption1"];
    $Region = $params["configoption2"];
	$Type = $params["configoption3"];
	$Product = $params["configoption4"];		
	$Cost = $params["configoption5"];
	if ($Product == "daily") { $Days = "1"; }
	else if ($Product == "weekly") { $Days = "7"; }
	else if ($Product == "monthly") { $Days = "30"; }
	$data = array(
		'avkey' => 'fce98332-0afd-4c82-83e7-a4dff01e0c10',
		'name' => $clientsdetails['firstname']." ".$clientsdetails['lastname'],
		'type' => $Type,
		'region' => $Region,
		'product' => $Product,
		'cost' => $Cost,
		'bitrate' => '192',
		'listeners' => $Listeners,
		'days' => $Days,
		'vendor_id' => '9999',
		'slstarttime' => time(),
		'hash' => $MD5,
	);

$stringData = date($date_format)." - \nPosting Data: ".var_export($data,1)."\n";
fwrite($fh, $stringData);
	list($header, $content) = PostRequest(
	    "http://red.neostreams.info/neostream/purchase.php",
		"http://www.neostreams.info/neoshop/",
    	$data
	);
$stringData = date($date_format)." - \nResponse Received: ".$content."\n";
fwrite($fh, $stringData);	
	$pos = strpos($content,"SUCCESS");

	if ($pos !== false) {
		$result = "success";
	}
	else {
		$result = "Error Creating Stream Please Contact Administrator...";
	}
$stringData = date($date_format)." - Done: \n".$result."\n";
fwrite($fh, $stringData);
fclose($fh);

	return $result;
}

function PostRequest($url, $referer, $_data) {
 
    // convert variables array to string:
    $data = array();    
    while(list($n,$v) = each($_data)){
        $data[] = "$n=$v";
    }    
    $data = implode('&', $data);
    // format --> test1=a&test2=b etc.
 
    // parse the given URL
    $url = parse_url($url);
    if ($url['scheme'] != 'http') { 
        die('Only HTTP request are supported !');
    }
 
    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];
 
    // open a socket connection on port 80
    $fp = fsockopen($host, 80);
 
    // send the request headers:
    fputs($fp, "POST $path HTTP/1.1\r\n");
    fputs($fp, "Host: $host\r\n");
    fputs($fp, "Referer: $referer\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: ". strlen($data) ."\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $data);
 
    $result = ''; 
    while(!feof($fp)) {
        // receive the results of the request
        $result .= fgets($fp, 128);
    }
 
    // close the socket connection:
    fclose($fp);
 
    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);
 
    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';
 
    // return as array:
    return array($header, $content);
}

?>
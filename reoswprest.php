<?php


	/* Use API key to connect to service 
	----------------------------------------- */
	$externalContent = file_get_contents('http://checkip.dyndns.com/');
	preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
	print_r('CheckIp Response: ' . $m[1] . '<br>');
	
	# if(isset($_GET['sandbox']))
	if(True)
	{
		$url = 'https://sandbox.forte.net/api';
		$AccountID  = 'act_338275';
		$LocationID = 'loc_181159';
		$APIKey = 'bc5b84eb491f67ee8c7dc11b8a0aa3c3';
		$SecureTransactionKey = '040674fde083aad0e5cdabc3c1a32ba9';	
	}
	else
	{
		$url = 'https://api.forte.net';
		$AccountID  = 'act_**********';
		$LocationID = 'loc_**********';
		$APIKey = '**********';
		$SecureTransactionKey = '**********';	
	}

	$auth_token = base64_encode($APIKey.':'.$SecureTransactionKey);
	$service_url = $url.'/v2/accounts/'.$AccountID.'/locations/'.$LocationID.'/customers/';
	
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$auth_token,
					             'X-Forte-Auth-Account-Id: '.$AccountID,
						     'Content-Type: application/json'));
   	curl_setopt($curl, CURLOPT_NOBODY, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($curl, CURLOPT_FAILONERROR, false);
	
	$curl_response = curl_exec($curl);

	/* If the CURL is successful */

	//Use this to look for bad HTTP status codes
	$info = curl_getinfo($curl);
	print_r('HttpStatus Code: ' . $info['http_code'] . '<br>');

	//if using CURLOPT_FAILONERROR = true:
	//(Will not contain the information found in the response body.)
	if($curl_response === false)
	{
	    print_r('Curl error: ' . curl_error($curl) . '<br>');
	}
	
	curl_close($curl);




	/* Print the CURL Response here 
	-----------------------------------------------------*/
	print_r($curl_response);

	$decoded = json_decode($curl_response);
	print_r($decoded);

	echo '<br> end here';
?>
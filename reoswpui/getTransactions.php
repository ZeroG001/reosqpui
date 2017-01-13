<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $params = $_POST;
  $method = 'get';
  $action = '';
  $json_datat = '';


  switch ( $params['type'] ) {


    # ------------------- Schedule Actions ---------------------------

    case "schedules":
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/schedules";
      $method = 'get';
      break;



    case "scheduleItems":
      if ( isset( $params['scheduleId'] ) ) {
        $curl_url = "https://sandbox.forte.net/API/v3/schedules/".$params['scheduleId']."/scheduleitems"; 
        $method = "get";
      } else {
        // Do something. maybe add error
      }
      break;



    case "suspendScheduleItem": 
      $method = "put";
      $action = "suspend";
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/scheduleitems/". $params['scheduleItemId']; 
      $json_data = "{ \"schedule_item_status\" : \"suspended\" }";
      break;



    case "activateScheduleItem": 
      $method = "put";
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/scheduleitems/". $params['scheduleItemId']; 
      $json_data = "{ \"schedule_item_status\" : \"scheduled\" }";
      break;



    case "activateSchedule": 
      $method = "put";
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/schedules/". $params['scheduleId']; 
      $json_data = "{ \"schedule_status\" : \"active\" }";
      break;


    case "suspendSchedule": 
      $method = "put";
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/schedules/". $params['scheduleId']; 
      $json_data = "{ \"schedule_status\" : \"suspended\" }";
      break;


    case "deleteScheduleItem": 
      $method = "delete";
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/scheduleitems/". $params['scheduleItemId']; 
      break;



    case "deleteSchedule": 
      $method = "delete";
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/schedules/". $params['scheduleId']; 
      break;


    # ------------------- Transaction Actions ---------------------------

    case "transactions":
    $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/transactions";
    $method = 'get';
    break;



    # ------------------- Customer Actions ---------------------------

    case "customers":
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/customers";
      $method = 'get';
      break;



    case "customer":
      if (isset ($params['customerId'])) {
        $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/customers/" . $params['customerId'];
        $method = 'get';
      } else {
        // Do something else. maybe add error message
      }
      break;



    case "customerSchedules":
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/schedules?filter=customer_token+eq+".$params['customerId'];
      $method = 'get';
      break;


    case "customerTransactions":
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/locations/loc_181159/transactions?filter=customer_token+eq+".$params['customerId'];
      $method = 'get';
      break;



    default:
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/schedules";
      $method = "get";
      break;
      

  }



# ------------------- CURL Methods -------------------

if($method == "get") {

  $curl = curl_init();

  // ------ GET Curl Request ------
  curl_setopt_array($curl, array(
    CURLOPT_URL => $curl_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "accept: application/json",
      "authorization: Basic YmM1Yjg0ZWI0OTFmNjdlZThjN2RjMTFiOGEwYWEzYzM6MDQwNjc0ZmRlMDgzYWFkMGU1Y2RhYmMzYzFhMzJiYTk=",
      "cache-control: no-cache",
      "content-type: application/x-www-form-urlencoded",
      "x-forte-auth-organization-id: org_338275"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }


} 
elseif ( $method == "put" ) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL =>  $curl_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => $json_data,
    CURLOPT_HTTPHEADER => array(
      "accept: application/json",
      "authorization: Basic YmM1Yjg0ZWI0OTFmNjdlZThjN2RjMTFiOGEwYWEzYzM6MDQwNjc0ZmRlMDgzYWFkMGU1Y2RhYmMzYzFhMzJiYTk=",
      "cache-control: no-cache",
      "content-type: application/json",
      "x-forte-auth-organization-id: org_338275"
    ),
  ));


  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }

}
elseif ($method == "delete") {

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $curl_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HTTPHEADER => array(
      "accept: application/json",
      "authorization: Basic YmM1Yjg0ZWI0OTFmNjdlZThjN2RjMTFiOGEwYWEzYzM6MDQwNjc0ZmRlMDgzYWFkMGU1Y2RhYmMzYzFhMzJiYTk=",
      "cache-control: no-cache",
      "content-type: application/json",
      "x-forte-auth-organization-id: org_338275"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }

}
else {
  die("there was an error performing the action");
}
   

}

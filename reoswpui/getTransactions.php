<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $params = $_POST;


  switch ( $params['type'] ) {

    case 'schedules':
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/schedules";
      break;

    case 'customers':
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/customers";
      break;



    case 'customer':
      if (isset ($params['customerId'])) {
        $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/customers/".$params['customerId'];
      } else {

      }
      
      break;

    case 'scheduleItems':
      if ( isset( $params['scheduleId'] ) ) {
        $curl_url = "https://sandbox.forte.net/API/v3/schedules/".$params['scheduleId']."/scheduleitems"; 
      } else {

      }
      break;

    default:
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/schedules";
      break;

  }


  // PUT - Suspend Schedules : https://sandbox.forte.net/API/v3/schedules/sch_e0ae928b-9054-4d43-8913-892e323ac101//scheduleitems/sci_7bd2a151-76a7-4d31-beb8-d11c26abb6a0
  
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


  // ------ PUT Curl Request ------
  //   curl_setopt_array($curl, array(
  //   CURLOPT_URL => $curl_url,
  //   CURLOPT_RETURNTRANSFER => true,
  //   CURLOPT_ENCODING => "",
  //   CURLOPT_MAXREDIRS => 10,
  //   CURLOPT_TIMEOUT => 30,
  //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //   CURLOPT_CUSTOMREQUEST => "GET",
  //   CURLOPT_HTTPHEADER => array(
  //     "accept: application/json",
  //     "authorization: Basic YmM1Yjg0ZWI0OTFmNjdlZThjN2RjMTFiOGEwYWEzYzM6MDQwNjc0ZmRlMDgzYWFkMGU1Y2RhYmMzYzFhMzJiYTk=",
  //     "cache-control: no-cache",
  //     "content-type: application/x-www-form-urlencoded",
  //     "x-forte-auth-organization-id: org_338275"
  //   ),
  // ));


  // ------ Delete Curl Request ------
  //   curl_setopt_array($curl, array(
  //   CURLOPT_URL => $curl_url,
  //   CURLOPT_RETURNTRANSFER => true,
  //   CURLOPT_ENCODING => "",
  //   CURLOPT_MAXREDIRS => 10,
  //   CURLOPT_TIMEOUT => 30,
  //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //   CURLOPT_CUSTOMREQUEST => "GET",
  //   CURLOPT_HTTPHEADER => array(
  //     "accept: application/json",
  //     "authorization: Basic YmM1Yjg0ZWI0OTFmNjdlZThjN2RjMTFiOGEwYWEzYzM6MDQwNjc0ZmRlMDgzYWFkMGU1Y2RhYmMzYzFhMzJiYTk=",
  //     "cache-control: no-cache",
  //     "content-type: application/x-www-form-urlencoded",
  //     "x-forte-auth-organization-id: org_338275"
  //   ),
  // ));




}


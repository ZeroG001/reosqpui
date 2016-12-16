<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['type'])) {

//   if($_POST['type'] == "schedules") {
//     $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/schedules";
//   } else if($_POST['type'] == "customers") {
//     $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/customers";
//   } else if($_POST['type'] == "scheduleitems") {
//     $curl_url = "https://sandbox.forte.net/API/v3/schedules/".scheduleId."/scheduleitems";
//   } else {
//     $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/schedules";
//   }
  
// }

  switch ($_POST['type']) {

    case 'schedules':
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/schedules";
      break;

    case 'customers':
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/customers";
      break;

    case 'scheduleItems':
      if ( isset( $_POST['scheduleId'] ) ) {
        $curl_url = "https://sandbox.forte.net/API/v3/schedules/".scheduleId."/scheduleitems"; 
      } else {

      }
      break;

    default:
      $curl_url = "https://sandbox.forte.net/API/v3/organizations/org_338275/schedules";
      break;

  }

  $curl = curl_init();

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
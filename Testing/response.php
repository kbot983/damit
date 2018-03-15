<?php

// NOTE: Only fetches the first 300 devices.
//       Will need to add looping with offset to get all devices.
function getDevices(){ 
  $app_id = "75f0c0b1-2034-4259-886a-919b602bc756";
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players?app_id=" . $app_id); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 
                                             'Authorization: Basic ZDIwNTgzNzctOTI2Yy00MjYzLWFkZWUtZTFiYmNiYWUyOWZk')); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  $response = curl_exec($ch); 
  curl_close($ch); 
  return $response; 
}

$response = getDevices(); 
$return["allresponses"] = $response; 
$return = json_encode( $return); 
print("\n\nJSON received:\n"); 
print($return); 
print("\n") 
?>
<?php
	header("Access-Control-Allow-Origin: *");
	include "https://www.occasionz.in/connection.php";
	$dam_id = 1;
	$player_id = array();
	$query = "SELECT onesignalid FROM `usermaster` WHERE `dam_id` = $dam_id";
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($res = mysqli_fetch_assoc($result)){
		$player_id[$i] = array($res["onesignalid"]);
		$i = $i + 1;		
	}
	function sendMessage(){
		$content = array(
			"en" => 'Evacuate Immediately!'
			);
		
		$fields = array(
			'app_id' => "75f0c0b1-2034-4259-886a-919b602bc756",
			'include_player_ids' => $player_id,
			'data' => array("foo" => "bar"),
			'contents' => $content
		);
	
		$fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic ZDIwNTgzNzctOTI2Yy00MjYzLWFkZWUtZTFiYmNiYWUyOWZk'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
  print("\n\nJSON received:\n");
	print($return);
  print("\n");


?>
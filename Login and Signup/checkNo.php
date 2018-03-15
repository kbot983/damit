<?php
include "../connection.php";
date_default_timezone_set('Asia/Kolkata');
$mobile_no = $_POST['number'];
$otp = rand(1000,9999);
$query = "SELECT * FROM `user` where mobile_no = '$mobile_no'";

if($result = mysqli_query($conn, $query)){
    $res = mysqli_num_rows($result);
    if($res > 0){
        echo "Exists";
    }else if(mysqli_query($conn, "INSERT INTO `otp`(`mobile_no`, `otp`, `time`, `is_expired`) VALUES ('$mobile_no','$otp','" . date("h:i:s"). "','0')")){
            echo $mobile_no;
            echo "Added";
            // SEND OTP 
            $apiKey = urlencode('GwdEObV9VZA-qVJt6nGaqBp8qPjFiVoeHpjR3z8alF');
    	
            // Message details
            $numbers = array($mobile_no);
            $sender = urlencode('TXTLCL');
            $message = rawurlencode("Your One Time Password for Dam IT is ".$otp.". This OTP is valid for 5 minutes.");
            echo $numbers = implode(',', $numbers);
            // Prepare data for POST request
            $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        
            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            echo $response;
        }else{
            echo mysqli_error($conn);
        }
}
?>
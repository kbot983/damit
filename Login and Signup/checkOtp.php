<?php

include "../connection.php";
date_default_timezone_set('Asia/Kolkata');
$mobile_no = $_POST['mobile_no'];
$entered_otp = $_POST['otp_no'];

// OTP -> TIME
$query = "SELECT time from `otp` WHERE mobile_no = '$mobile_no' AND otp = '$entered_otp'";
if($result = mysqli_query($conn, $query)){
    $count = mysqli_num_rows($result);
    if($count > 0){
        while($res = mysqli_fetch_assoc($result)){
            $saved_time = $res["time"];
        }
    // Check time here
    $current_time = date("h:i:s");
    echo $diff = round((strtotime("1/1/1980 $current_time")- strtotime("1/1/1980 $saved_time")) / 60);
    echo "    ";
    if($diff > 5){
        echo "The OTP you entered has expired. Request for an OTP again!";
        $delquery = "DELETE FROM `otp` WHERE mobile_no = '$mobile_no'";
        $result = mysqli_query($conn, $delquery);
        echo "Deleted.";
    }else{
        echo "Successful!";
        $delquery = "DELETE FROM `otp` WHERE mobile_no = '$mobile_no'";
        $result = mysqli_query($conn, $delquery);
        echo "Deleted.";
    }
    }else{
        echo "The OTP you entered is incorrect.";
    }
}else{
    echo "ERROR";
    echo mysqli_error($conn);
}




// $query = "SELECT time FROM `otp` where otp = '$entered_otp' AND mobile_no = '$mobile_no'";
// $result = mysqli_query($conn, $query);
// while($res= mysqli_fetch_assoc($result)){
//     $time = $res["time"];
// }
// $now = date("h:i:s");
// echo $diff = (strtotime("1/1/2018 $now") - strtotime("1/1/2018 $time"))/60;


?>



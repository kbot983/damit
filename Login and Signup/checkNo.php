<?php
include "../connection.php";
date_default_timezone_set('Asia/Kolkata');
echo "HERE";
$mobile_no = $_POST['number'];
$otp = rand(1000,9999);
$query = "SELECT * FROM `user` where mobile_no = '$mobile_no'";

// if($result = mysqli_query($conn, $query)){
//     $res = mysqli_num_rows($result);
//     if($res > 0){
//         echo "Exists";
//     }else{
//         if(mysqli_query($conn, "INSERT INTO `otp`(`mobile_no`, `otp`, `minutes`, `is_expired`) VALUES ('$mobile_no','$otp','" . date("i"). "','0')")){
//             echo "Added";
//             echo(date("i"));
//         }else{
//             echo mysqli_error($conn);
//         }

//     }
// }



// echo $date1 = date('i') . "<br>";

// //sleep for 5 seconds
// sleep(5);

// //start again
// echo $date2 = date('i');

// echo (int)$date2 - (int)$date1;
?>
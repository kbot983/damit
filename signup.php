<?php
include "connection.php";

$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$email= $_POST['uemail'];
$password= $_POST['pass'];
$confpass = $_POST['confpass'];
$zip_code = $_POST['zipcode'];
$contact = $_POST['contact'];
$query1 = "SELECT * FROM `user` where email = '$email'";
$query2 = "INSERT INTO `user`(`email`, `password`, `first_name`, `last_name`, `mobile_no`, `zipcode`) VALUES ('$email',$password,'$first_name','$last_name','$contact','$zip_code')";

$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
if($result1 = mysqli_query($conn, $query1)){
    $res1 = mysqli_num_rows($result1);
    if($res1 > 0){
        echo "Exists";
    }else{
        if($result2 = mysqli_query($conn, $query2)){
            $res2 = mysqli_affected_rows($conn);
            if($res2 > 0){
                echo "Success";
            }
        }else{
            echo "Fail";
        }
        

    }
}



?>
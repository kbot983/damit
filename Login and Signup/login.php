<?php

include "../connection.php";

$username = $_POST['uemail'];
$password = $_POST['pass'];
$hashed_password = hash('sha256',$password);
$query1 = "SELECT * FROM `nodal_officer` where user_id = '$username' and password = '$hashed_password'";
$query2 = "SELECT * FROM `regional_officer` where user_id = '$username' and password = '$hashed_password'";
$query3 = "SELECT * FROM `user` where email = '$username' and password = '$hashed_password'";


if($result1 = mysqli_query($conn, $query1)){
    $res1 = mysqli_num_rows($result1);
    if($res1 > 0){
        echo "Nodal";
    }else{
        $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        $res2 = mysqli_num_rows($result2);
        if($res2 > 0){
            echo "Regional";
        }else{
            $result3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
            $res3 = mysqli_num_rows($result3);
            if($res3 > 0){
                echo "User";
            }else{
                echo "Unknown Value.";
            }
        }
    }
}
mysqli_close($conn);
?>
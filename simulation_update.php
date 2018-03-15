<?php

include "connection.php";
$per = $_POST["per"];
$dam_name = $_POST["dam_name"];


$query1 = "SELECT dam_id, storage_capacity FROM `dam` WHERE `name` = '$dam_name'";
$result1 = mysqli_query($conn, $query1);
while($res1 = mysqli_fetch_assoc($result1)){
    $dam_id = $res1["dam_id"];
    $storage_capacity = $res1["storage_capacity"];
}
$value = ($storage_capacity * $per) / 100;
$time = date("l-F-Y H:i:s");
$query2 = "UPDATE `current_status` SET `level`= '$value',`last_upd`='$time' WHERE `dam_id` = $dam_id";
$result2 = mysqli_query($conn, $query2);
if($result2){
    echo "Successful!";
}else{
    echo mysqli_error($conn);
}
?>
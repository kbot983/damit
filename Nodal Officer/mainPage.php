<?php
include "../connection.php";

$user_id = $_POST['user_id'];
//Get from nodal
$query = "SELECT dam_id FROM `nodal_officer` where user_id = '$user_id'";
$result = mysqli_query($conn, $query);
while($res= mysqli_fetch_assoc($result))
    $id = $res["dam_id"];

//Get from dam
$query = "SELECT water_level FROM `dam` where dam_id = '$id'";
$result = mysqli_query($conn, $query);
while($res = mysqli_fetch_assoc($result))
    echo $res["water_level"];   


?>
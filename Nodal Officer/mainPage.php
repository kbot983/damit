<?php

include "connection.php";

// $email_id = $_POST['email_id'];
$email_id = 1;
//Get from nodal
$query = "SELECT dam_id FROM `incharge` where email = '$email_id'";
$result = mysqli_query($conn, $query);
while($res= mysqli_fetch_assoc($result))
    $id = $res["dam_id"];

//Get from dam
$query = "SELECT level FROM `current_status` where dam_id = '$id'";
$result = mysqli_query($conn, $query);
while($res = mysqli_fetch_assoc($result))
    echo $res["level"];   

?>
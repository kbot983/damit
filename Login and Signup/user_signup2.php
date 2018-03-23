<?php
header("Access-Control-Allow-Origin: *");
include "connection.php";

$email_id = $_POST['email'];

$language = $_POST['language'];
$emergency = $_POST['emergency'];
$dam_name = $_POST['dam_name'];

// GET THE DAM ID
$query = "SELECT * FROM `incharge` WHERE `email` = '$email_id'";
$result = mysqli_query($conn, $query);
while($res = mysqli_fetch_assoc($result)){
    $dam_id = $res["dam_id"];
}

// UPDATE THE VALUES
$query = "UPDATE `usermaster` SET `dam_id`=$dam_id, `language`= $language,`emergency`= $emergency WHERE `email` = '$email_id'";
$result = mysqli_query($conn, $query);
if($result){
    echo "Success";
}else{
    echo mysqli_error($conn);
}
?>
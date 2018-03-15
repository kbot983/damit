<?php
    include "connection.php";
    $state_name = $_POST['state_name'];
    $query1 = "SELECT state_id FROM `states` WHERE `state_name` = '$state_name'";
    $result1 = mysqli_query($conn, $query1);
    while($res1 = mysqli_fetch_assoc($result1)){
        $state_id = $res1["state_id"];
    }
    $i = 0;
    $query = "SELECT name  FROM `dam` where `state` = $state_id";
    $result = mysqli_query($conn, $query);     
    while($res = mysqli_fetch_assoc($result)){
        $data[$i] = array($res["name"]);
        $i += 1;
    }
    echo json_encode($data);
?>
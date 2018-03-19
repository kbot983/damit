<?php
    header("Access-Control-Allow-Origin: *");
    include "connection.php";
    // $dam_id = $_POST['dam_id'];
    // $month = $_POST['month'];

    $dam_id = 1;
    $month = 'February';
    $data = array();

    $query = "SELECT * FROM `notification` WHERE `dam_id` = $dam_id AND `month` = '$month'";
    $result = mysqli_query($conn, $query);
    while($res = mysqli_fetch_assoc($result)){
        $data["date"] = $res['date_time'];
        $data["sent_count"] = $res['sent_count'];
        $data["engage"] = $res["engage_count"];
        $sr = $res['sent_by'];
    }
    $query2 = "SELECT * FROM `incharge` WHERE `sr_no` = $sr";
    $result2 = mysqli_query($conn, $query2);
    while($res2 = mysqli_fetch_assoc($result2)){
        $data["name"] = $res2['name'];
    }
    echo json_encode($data);
?>
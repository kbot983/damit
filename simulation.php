<?php
    // header("Access-Control-Allow-Origin: *");
    // $conn = mysqli_connect("localhost", "i4030102_wp1", "M(d6]bURC0nw(ro71x^18]#8", "i4030102_wp1");
    // if(!$conn){
    //     echo "Error: " . mysqli_error($conn);
    // }
    include "connection.php";
    $data = array();
    $i = 0;
    $query = "SELECT state_name from `states`";
    $result = mysqli_query($conn, $query);
    while($res = mysqli_fetch_assoc($result)){
        $data[$i] = array($res["state_name"]);
        $i += 1;
    }
    echo json_encode($data);

?>
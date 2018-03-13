<?php
    
    include "connection.php";

    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $time = date("H:i:s");
    
    $query = "INSERT INTO `test`(`lat`, `lon`, `time`) VALUES ($lat, $lng, $time)";

    $result = mysqli_query($conn, $query);
    if($result){
        echo "Success!";
    }else{
        echo mysqli_error($conn);
    }
?>

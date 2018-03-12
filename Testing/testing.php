<?php
    $conn = mysqli_connect("localhost", "i4030102_wp1", "ucoe123", "i4030102_wp1");
    if(!$conn){
        die("Error: " . mysql_error());
    } 
    $query = "SELECT * from "
?>
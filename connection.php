<?php
    $conn = mysqli_connect("localhost", "root", "", "damit");

    if(!$conn){
        die("Error: " . mysql_error());
    }
?>
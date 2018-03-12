<?php
    include "../connection.php";

    // $damId = $_POST[''];
    // $date = $_POST[''];
    // $time = $_POST[''];
    
    $damId = 1;
    $date = date("j F, Y");
    $time = date("G");
    $msg = "This is a test";
    $sent_by = "Shashank";
    $sr_no = 1;

    $query = "INSERT INTO `scheduler`(`dam_id`, `sent_by`, `date`, `time`, `msg`, `sr_no`) VALUES ($damId, '$sent_by', '$date', '$time', '$msg', $sr_no)";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $res = mysqli_num_rows($result);
    if($res > 0){
        echo "Success";
    }else{
        echo mysqli_error($conn);
    }
    
?>

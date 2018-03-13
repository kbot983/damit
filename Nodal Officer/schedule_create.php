<?php
    include "../connection.php";
    
    $damId = $_POST['time'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    
    $sun = $_POST['sun']; 
    $mon = $_POST['mon'];
    $tue = $_POST['tue'];
    $wed = $_POST['wed'];
    $thu = $_POST['thu'];
    $fri = $_POST['fri'];
    $sat = $_POST['sat'];
    
    
    // *** HARDCODED ***
    $damId = 2; 
    $sent_by = "Shashank"; 
    $sr_no = 1; 
    $msg = "This is a test message";
    $everyday_checker = 0;
    $days = array("Sunday" => $sun, "Monday" => $mon, "Tuesday" => $tue, "Wednesday" => $wed, "Thursday" => $thu, "Friday" => $fri, "Saturday" => $sat);
    // $damId = 1;
    // $date = date("j F, Y"); // Date Month, Year
    // $time = date("G"); // Hour (24 Hour format)
    // $msg = "This is a test";
    // $sent_by = "Shashank";
    // $sr_no = 1;
    
    foreach($days as $key => $value){
        if($value == 1){
            $query = "INSERT INTO `scheduler`(`dam_id`, `sent_by`, `date`, `time`, `msg`, `sr_no`, `day`) VALUES ($damId, '$sent_by', '$date', '$time', '$msg', $sr_no, '$key')";
            if($result = mysqli_query($conn, $query)){
                echo "Success!";
            }else{
                echo mysqli_error($conn);
            }
            $everyday_checker = 1;
        }
    }
    if($everyday_checker == 0){
        $query = "INSERT INTO `scheduler`(`dam_id`, `sent_by`, `date`, `time`, `msg`, `sr_no`, `day`) VALUES ($damId, '$sent_by', '$date', '$time', '$msg', $sr_no, 'once')";
        if($result = mysqli_query($conn, $query)){
            echo "Success!";
        }else{
            echo mysqli_error($conn);
        }
    }       
?>

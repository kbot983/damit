<?php
header("Access-Control-Allow-Origin: *");
    include "connection.php";
    date_default_timezone_set("Asia/Kolkata");
    echo $current_time = date("G");
    echo $current_day = date("l");
echo "<br>";
    // Get day from the table
    $query = "SELECT * FROM `scheduler` WHERE `day` = '$current_day' and `date` = ''";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $query1 = "SELECT * FROM `scheduler` WHERE `day` = '$current_day'";
    $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
    if(mysqli_num_rows($result) > 0){
        while($res = mysqli_fetch_assoc($result)){
            $time = $res['time']; // STRING
            $mtime = DateTime::createFromFormat("G:i", $time);
            echo $mod_time = $mtime->format('G');
            
            
            // ADDED
            $dam_id = $res["dam_id"];
            $sr_no = $res["sr_no"];
            echo "<br>";
            echo $name = $res["sent_by"];
            echo "<br>";
            // GET LEVEL FROM DAM TABLE
            $query1 = "SELECT * FROM `dam` WHERE `sr_no` = $dam_id";
            $result1 = mysqli_query($conn, $query1);
            while($res1 = mysqli_fetch_assoc($result1)){
            	$storage = $res1['storage_capacity'];
            	$level = $res1['dam_level'];
            }
            
            
            if($mod_time == $current_time){
    
                // *** SEND NOTIFICATION ***
                function sendMessage(){
                    $content = array(
                        "en" => 'Evacuate Immediately!'
                        );
                    
                    $fields = array(
                        'app_id' => "75f0c0b1-2034-4259-886a-919b602bc756",
                        'included_segments' => array('Location'),
                  'data' => array("foo" => "bar"),
                        'contents' => $content
                    );
                    
                    $fields = json_encode($fields);
                print("\nJSON sent:\n");
                print($fields);
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                               'Authorization: Basic ZDIwNTgzNzctOTI2Yy00MjYzLWFkZWUtZTFiYmNiYWUyOWZk'));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_POST, TRUE);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
                    $response = curl_exec($ch);
                    curl_close($ch);
                    
                    return $response;
                }
                
                $response = sendMessage();
                $return["allresponses"] = $response;
                $return = json_encode( $return);
                echo "Notification sent!";
                
                
                    
                
                
                
                
                $time_current = date("d-m-Y");
                $month_current = date("F");
                 // SAVE TO CURRENT_STATUS TABLE
                $query2 = "INSERT INTO `current_status`(`dam_id`, `sent_by`, `capacity`, `level`, `last_upd`, `Month`) VALUES ($dam_id, '$sr_no', '$storage', '$level', '$time_current','$month_current')";
                $result2 = mysqli_query($conn, $query2);
                if($result2){
                	echo "Success";
                }else{
                	echo mysqli_error($conn);
                }
                
                
                // SAVE TO NOTIFICATION TABLE
                $query3 = "INSERT INTO `notification`(`date_time`, `sent_count`, `engage_count`, `sent_by`, `dam_id`, `month`) VALUES ('$time_current', 0, 0, $sr_no, $dam_id, '$month_current')";
                $result3 = mysqli_query($conn, $query3);
                if($result3){
                	echo "Success";
                }else{
                	echo mysqli_error($conn);
                }
            
                
                
                
            }else{
                echo "Not yet";
            }
        }
        
        
        
        
        
        
    }else if(mysqli_num_rows($result1) > 0){
        while($res1 = mysqli_fetch_assoc($result1)){
            $time = $res1['time']; // STRING
            $mtime = DateTime::createFromFormat("G:i", $time);
            echo $mod_time = $mtime->format('G');
            
            
            // ADDED
            $dam_id = $res1["dam_id"];
            $sr_no = $res1["sr_no"];
            $name = $res1["sent_by"];
            // ADD DATE HERE
            
            $check_date = $res1["date"];
            $date2 = DateTime::createFromFormat("d F, Y", $check_date);
            $year = $date2->format("Y");
            $month = $date2->format("m");
            $day = $date2->format('d');
            echo $date1 = "".$day2."-".$month."-".$year."";

            $current_date = date("d-m-Y")
            if($current_date == $date1){

                // GET LEVEL FROM DAM TABLE
                $query1 = "SELECT * FROM `dam` WHERE `sr_no` = $dam_id";
                $result1 = mysqli_query($conn, $query1);
                while($res1 = mysqli_fetch_assoc($result1)){
                    $storage = $res1['storage_capacity'];
                    $level = $res1['dam_level'];
                }
                
                if($mod_time == $current_time){
        
                    // *** SEND NOTIFICATION ***
                    function sendMessage(){
                        $content = array(
                            "en" => 'Evacuate Immediately!'
                            );
                        
                        $fields = array(
                            'app_id' => "75f0c0b1-2034-4259-886a-919b602bc756",
                            'included_segments' => array('Location'),
                    'data' => array("foo" => "bar"),
                            'contents' => $content
                        );
                        
                        $fields = json_encode($fields);
                    print("\nJSON sent:\n");
                    print($fields);
                        
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                                'Authorization: Basic ZDIwNTgzNzctOTI2Yy00MjYzLWFkZWUtZTFiYmNiYWUyOWZk'));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                        curl_setopt($ch, CURLOPT_HEADER, FALSE);
                        curl_setopt($ch, CURLOPT_POST, TRUE);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                
                        $response = curl_exec($ch);
                        curl_close($ch);
                        
                        return $response;
                    }
                    
                    $response = sendMessage();
                    $return["allresponses"] = $response;
                    $return = json_encode( $return);
                    echo "Notification sent!";
                    
                    echo "<br>";
                    echo $response[1];
                    echo "<br>";
                    
                    $time_current = date("d-m-Y");
                    $month_current = date("F");
                    // SAVE TO CURRENT_STATUS TABLE
                    $query2 = "INSERT INTO `current_status`(`dam_id`, `sent_by`, `capacity`, `level`, `last_upd`, `Month`) VALUES ($dam_id, '$sr_no', '$storage', '$level', '$time_current','$month_current')";
                    $result2 = mysqli_query($conn, $query2);
                    if($result2){
                        echo "Success";
                    }else{
                        echo mysqli_error($conn);
                    }
                    
                    // SAVE TO NOTIFICATION TABLE
                    $query3 = "INSERT INTO `notification`(`date_time`, `sent_count`, `engage_count`, `sent_by`, `dam_id`, `month`) VALUES ('$time_current', 0, 0, $sr_no, $dam_id, '$month_current')";
                    $result3 = mysqli_query($conn, $query3);
                    if($result3){
                        echo "Success";
                    }else{
                        echo mysqli_error($conn);
                    }
                    
                }
            }
            }
            }else{
                echo "Not yet";
            }
        
?>
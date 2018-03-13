<?php
    include "../connection.php";
    
    echo $current_time = date("G");
    $current_day = date("l");

    // Get day from the table
    $query = "SELECT time FROM `scheduler` WHERE day = 'Monday'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if(mysqli_num_rows($result) > 0){
        while($res = mysqli_fetch_assoc($result)){
            $time = $res['time']; // STRING
            $mtime = DateTime::createFromFormat("G:i", $time);
            echo $mod_time = $mtime->format('G');
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
            }else{
                echo "Not yet";
            }
        }
    }else{
        echo "OTHER PART";
    }
?>
<?php
header("Access-Control-Allow-Origin: *");
//$state_id = $_POST['state_id'];
// dam id, dam name, storage percentage, statename
include "../connection.php";
$state_id = 1;

$query1 = "SELECT * FROM `states` WHERE `state_id` = $state_id";
$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
while($res1 = mysqli_fetch_assoc($result1)){
    $statename = $res1["state_name"];
}

$query = "SELECT * FROM `dam` WHERE `state` = '$state_id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$i = 0;
$data = array();
if(mysqli_num_rows($result) > 0){
        while($res = mysqli_fetch_assoc($result)){
            $dam_id = $res["sr_no"];
            $name = $res["name"];
            $storage_capacity = $res["storage_capacity"];
            $effective = $res["effective"];
            $percentage = ($effective * 100) / $storage_capacity;
            $description = $res["description"];
            
            $data[$i] = array("dam_id"=>$dam_id, "name" => $name, "percentage" => $percentage, "statename" => $statename);
            $i = $i + 1;
        }
    }
    echo $data1 =  json_encode($data);

?>
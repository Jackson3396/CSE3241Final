<?php
if(isset($_POST["event_id"]) &&isset($_POST["venue_id"]) &&isset($_POST["d"]) && isset($_POST["zone_id"]) && isset($_POST["rate"])){
 $date= $_POST['d'];
 $zone_id = $_POST['zone_id'];
 $rate = $_POST['rate'];
 $venue_id  = $_POST['venue_id'];
 $event_id  = $_POST['event_id'];
}
if($_SERVER["REQUEST_METHOD"] == "POST" ){   
    if (isset($_POST["Name"]) && isset($_POST["Phone"])){
        if($_POST["Name"] != "" && $_POST["Phone"] != "") {
                include "sql.php";
                $sql1 = "SELECT cellphone_number,user_id From users where cellphone_number='{$_POST["Phone"]}'";
                $result = $conn->query($sql1);
                $user_num = NULL;
                if (!$result) die($conn->error);
                if ($result) {
                    if ($result->num_rows ==0){
                        $sql1 = "INSERT INTO users values(0,'{$_POST["Name"]}','{$_POST["Phone"]}')";
                        $result = $conn->query($sql1);
                        $sql1 = "SELECT cellphone_number,user_id From users where cellphone_number='{$_POST["Phone"]}'";
                        $result = $conn->query($sql1);
                        while($row = $result->fetch_array()) {
                            $user_num = $row['user_id'];
                            
                        }
                    }
                    else{
                        while($row = $result->fetch_array()) {
                            $user_num = $row['user_id'];
                        }
                    }
                }   
                $sql = "INSERT INTO reservations values(0,'{$_POST["Name"]}','{$_POST["Phone"]}',($user_num),($zone_id),($event_id),'$date',($rate),False)";
                $result = $conn->query($sql);
                if (!$result) die($conn->error);
                else{
                    echo "Success!\n";
                }
                $sql = "SELECT confirmation_number FROM reservations where phone_number=($cellphone_number) order by confirmation_number DESC LIMIT 1";
                $result = $conn->query($sql);
                $con_num = NULL;
                if ($result) {
                    if ($result->num_rows >=0){
                        while($row = $result->fetch_array()) {
                            $con_num = $row['confirmation_number'];
                        }
                    }
                }
                echo "Your Confirmation Number is ", $con_num;
        }
        else{
            echo "Please enter both fields";
        }
    }
   
}
?>

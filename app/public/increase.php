<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <?php include "header.php"; ?>
  </head>
  <h1>Increase Parking Spots</h1>
  <body>
    <?php 
        
        include "sql.php";
        ?>
        <form action="" method="post">
        Enter:<input type ="text" name="spots" placeholder="Number of Spots">
        Enter:<input type = "text" name="name" placeholder="Zone Name">
        
        <input type="submit">
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") { 
            $sql3 = "SELECT zones.zone_id FROM zones where zones.zone_name='{$_POST["name"]}'";
            $result = $conn->query($sql3);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_array()) {
                $zoneID  = $row['zone_id'];
              }
            }
            $sql2 = "SELECT count(zone_id) as num FROM reservations WHERE zone_id=$zoneID and is_cancelled = False";
            $result = $conn->query($sql2);
            if ($result->num_rows > 0) {
              $row = $result->fetch_array();
              if($row['num'] <= $_POST["spots"]){
                $sql = "UPDATE zones SET max_spots='{$_POST["spots"]}' WHERE zone_name='{$_POST["name"]}' ";
                $result = $conn->query($sql);
                if ($result !== false) {
                     echo "Record updated successfully" ;
                } 
               if(($result !== true)){
                     echo "Error updating record: " , $conn->error;
                }
              }
              else{
                echo "spots must be higher or equal than: ",$row['num'];
              }
            }

        }


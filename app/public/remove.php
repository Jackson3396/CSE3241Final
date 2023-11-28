
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
  <h1>Remove Zone</h1>
  <body>

    <form action="" method="post">
        ZoneID: <input type="text" name="zone"><br>
        <input type="submit">
    </form>
    <?php 
        
        include "sql.php";
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {  
            $sql3 = "SELECT zones.zone_name FROM zones where zones.zone_id={$_POST["zone"]}";
            $sql2 = "SELECT count(zone_id) as num FROM reservations WHERE zone_id={$_POST["zone"]} and is_cancelled = False";
            $result = $conn->query($sql3);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_array()) {
                $zoneName  = $row['zone_name'];
              }
            }
              $result = $conn->query($sql2);
              if ($result->num_rows > 0) {
                $row = $result->fetch_array();
                if($row['num'] == 0){
                  $sql = "DELETE FROM reservations WHERE zone_id = {$_POST["zone"]};";
                  $result = $conn->query($sql);
                //i cannot figure out how to make it so the foreign keys can delete
                $sql1 = "DELETE FROM distances WHERE distances.zone_name = '$zoneName' ";
                $result = $conn->query($sql1);
                $sql = "DELETE FROM zones WHERE zone_id= '{$_POST["zone"]}'";
                if ($conn->query($sql) === TRUE) {
                  echo "Zone deleted successfully";
                } else {
                  echo "Error deleting Zone: " . $conn->error;
                }
                }   
                else {
                  ?>
                  <body>Unable to remove, it will interfer with a reservation</body>
                  <?php
              }
           
              }
         
            
        }
        ?>
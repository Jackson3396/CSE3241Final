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
  <body>
  <div>
  <h1>Reserve</h1>
</div>
<form action="" method="post">
  Enter Date: <input type="date" name="Selectdate"><br>
  <input type="submit">
</form>
<?php   
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      if(isset($_POST["Selectdate"]) && $_POST["Selectdate"] != "") { 
        $date = $_POST["Selectdate"];
        include "sql.php";
        $isevent = "SELECT event_id,venue_id,event_name from events where event_date = '{$_POST["Selectdate"]}'";
        $result = $conn->query($isevent);
        if ($result->num_rows >0) {
          while($row = $result->fetch_array()) {
            $venue_id  = $row['venue_id'];
            $event_id  = $row['event_id'];
            $event_name  = $row['event_name'];
          }
          
          if($_POST["Selectdate"] > date('Y-m-d')) {
            $sql1 = "SELECT zone_id,count(zone_id)as numOfZones FROM reservations WHERE reservation_date = '{$_POST["Selectdate"]}'and is_cancelled = False Group By zone_id";
            $sql = "SELECT zones.zone_id,rate,numOfZones,max_spots,miles from zones left join  ($sql1) as num on zones.zone_id=num.zone_id  join venues on venues.venue_id = ($venue_id) left join distances on 
            zones.zone_name = distances.zone_name and distances.venue_name=venues.venue_name
            where (max_spots>num.numOfZones and max_spots>0) or (num.numOfZones is NULL and max_spots>0) order by miles asc;";
            $result = $conn->query($sql);
            if (!$result) die($conn->error);
            if ($result) {
            if ($result->num_rows >0) {
              echo "Event: ",$event_name," Date: ",$date;
              ?>
              <table>
              <thead>
                <tr>
                  <th scope="col">Zone ID</th>
                  <th scope="col">Available Spots</th>
                  <th scope="col">Rate($)</th>
                  <th scope="col">Distance(mi)</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                
            <?php
            while($row = $result->fetch_array()) {
              ?>
              <tr>
              <td><?php echo $row['zone_id'];?></td>
              <td><?php echo $row['max_spots']-$row['numOfZones'];?></td>
              <td><?php echo $row['rate'];?></td>
              <td><?php echo $row['miles'];?></td>
              <td> <form method="post">  <input type="hidden" name="zone_id" value="<?php echo $row['zone_id']; ?>">
                <input type="hidden" name="venue_id" value="<?php echo $venue_id; ?>">
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <input type="hidden" name="rate" value="<?php echo $row['rate']; ?>">
                <input type="hidden" name="d" value="<?php echo $date; ?>">
                <button type="submit" name="Reserve">Reserve</button></form>
              </td>
              </tr>
             
                
           
              <?php  
          }
          }
            Else {
              echo "No records found";
            } 
          }
          ?>
              </tbody>
            </table>
          <?php
          }
        Else {
          echo "Must be a day in advance";
        } 
        }
      Else{
        echo "No Event This Day";
      } 
  }
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['Reserve'])) { 
   ?><strong>Enter information below to reserve</strong>
   <form action="" method="post">
        <input type="hidden" name="zone_id" value="<?php echo $_POST['zone_id']; ?>">
        <input type="hidden" name="event_id" value="<?php echo $_POST['event_id']; ?>">
        <input type="hidden" name="venue_id" value="<?php echo $venue_id; ?>">
        <input type="hidden" name="rate" value="<?php echo $_POST['rate']; ?>">
        <input type="hidden" name="d" value="<?php echo $_POST['d']; ?>">
       Name: <input type="text" name="Name"><br>
       Phone Number: <input type="text" name="Phone"><br>
     <input type="submit">
   </form>
<?php   
  
  }
  }
 include "reservemaker.php";

?>
</body>
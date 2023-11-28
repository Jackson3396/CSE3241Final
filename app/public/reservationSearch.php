
<form action="welcome.php" method="post">
        Phone Number: <input type="text" name="PhoneNum"><br>
        Confirmation #: <input type="text" name="ConNum"><br>
        <input type="submit">
</form>
<?php   
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        if((isset($_POST["PhoneNum"]) && $_POST["PhoneNum"] != "") || (isset($_POST["ConNum"]) && $_POST["ConNum"] != "")) {
          include "sql.php";
          $isreservation = "SELECT user_name, event_id, reservation_date, fee from reservations where phone_number = '{$_POST["PhoneNum"]}' or confirmation_number = '{$_POST["ConNum"]}';
          $result = $conn->query($isreservation);
          if ($result->num_rows >0) {
            while($row = $result->fetch_array()) {
              $user_name = $row['user_name'];
              $venue_id  = $row['venue_id'];
              $event_id  = $row['event_id'];
              $date = $row['reservation_date'];
              $fee = $row['fee'];
              $cancelled = $row['is_cancelled'];
            }
            
            if (!$result) die($conn->error);
            if ($result) {
              if ($result->num_rows >0) {
                ?>
                <table>
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Event</th>
                    <th scope="col">Date</th>
                    <th scope="col">fee</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>   
                <?php
                while($row = $result->fetch_array()) {
                  if ($cancelled == false) {
                    ?>
                    <tr>
                    <td><?php echo $row['user_name'];?></td>
                    <td><?php echo $row['venue_id']-$row['numOfZones'];?></td>
                    <td><?php echo $row['event_id'];?></td>
                    <td><?php echo $row['reservation_date'];?></td>
                    <td><?php echo $row['fee'];?></td>
                    <td> <form method="post">  <input type="hidden" name="zone_id" value="<?php echo $row['zone_id']; ?>">
                    <input type="hidden" name="venue_id" value="<?php echo $venue_id; ?>">
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                    <input type="hidden" name="rate" value="<?php echo $row['rate']; ?>">
                    <input type="hidden" name="d" value="<?php echo $date; ?>">
                    <button type="submit" name="Cancel">Reserve</button></form>
                    </td>
                    </tr>
               
                  
             
                    <?php  
                    }
                }
              }
              Else {
                echo "No reservations found";
              } 
            }
            ?>
                </tbody>
              </table>
            <?php
          }
        }
        Else{
          echo "No reservations for this criteria";
        } 
    }
  }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['Cancel'])) { 
     ?><strong>Are you sure you want to cancel your reservation?</strong>
     <form action="" method="post">
        <button type="submit" name="Yes">Reserve</button></form>
        <button type="submit" name="No">Reserve</button></form>
     </form>
  <?php   
    
    }
    }
?>

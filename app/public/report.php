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
  <h1>Administrator Report</h1>
  <body>
    <form action="" method="post">
        Enter Date: <input type="date" name="Selectdate"><br>
        <input type="submit">
    </form>
    <?php 
        echo $_POST["Selectdate"];
        include "sql.php";
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {  
           
            $sql1 = "SELECT zone_id,count(zone_id)as numOfZones,sum(fee)as Rev FROM reservations WHERE reservation_date = '{$_POST["Selectdate"]}' Group By zone_id";
            $sql = "SELECT zones.zone_id,zone_name,rate,numOfZones,max_spots,Rev from zones left join  ($sql1) as num on zones.zone_id=num.zone_id;";
           
            $result = $conn->query($sql);

            if ($result->num_rows >0) {
              ?>
              <table>
              <thead>
                <tr>
                  <th>Zone ID</th>
                  <th>Zone Name</th>
                  <th>Number of Possible Spots</th>
                  <th>Reservations</th>
                  <th>Rate($)</th>
                  <th>Rev($)</th>
                </tr>
              </thead>
              
              <tbody>
                
            <?php
            while($row = $result->fetch_array()) {
              ?>
              <tr>
              <td><?php echo $row['zone_id'];?></td>
              <td><?php echo $row['zone_name'];?></td>
              <td><?php echo $row['max_spots'];?></td>
              <td><?php echo $row['numOfZones'];?></td>
              <td><?php echo $row['rate'];?></td>
              <td><?php echo $row['Rev'];?></td>
              </tr>
              <?php
            }

            }
            Else {
              echo "No records found";
            } 
        }
          ?>
          
         
          
            
          
        
          
         
        
        
</body>
</html>
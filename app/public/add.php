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
  <h1>Add Zone</h1>
  <body>
   <?php
    
        
        include "sql.php";
        ?>

<form action="" method="post">
        Enter:<input type ="text" name="name" placeholder="Zone Name">
        Enter:<input type ="number" name="spots" placeholder="Number of Spots">
        Enter:<input type ="number" name="rate" placeholder="Rate">
        <input type="submit">
        </form>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {  
            $sql = "INSERT INTO zones (zone_name,max_spots,rate) VALUES ('{$_POST["name"]}','{$_POST["spots"]}','{$_POST["rate"]}')";
            $result = $conn->query($sql);
            if ($result) {
              echo "Zone added successfully";
            } else {
              echo "Error adding Zone: " . $conn->error;
            }
            header("location: admin.php");
                 }
        ?>
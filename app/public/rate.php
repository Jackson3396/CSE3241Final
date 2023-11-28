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
  <h1>Change Rate</h1>
  <body>
    
    <?php 
        
        include "sql.php";
        ?>
        <form action="" method="post">
        Enter:<input type ="text" name="rate" placeholder="Rate">
        Enter:<input type = "text" name="name" placeholder="Zone Name">
        
        <input type="submit">
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") { 
            $sql = "UPDATE zones SET rate='{$_POST["rate"]}' WHERE zone_name='{$_POST["name"]}' ";

        if ($conn->query($sql) === TRUE) {
             echo "Record updated successfully";
        } else {
             echo "Error updating record: " . $conn->error;
        }
        }


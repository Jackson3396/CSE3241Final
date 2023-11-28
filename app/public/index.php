<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"
    />
    <title>Wonderland</title>
  </head>
  <body>
    <?php include "header.php"; ?>
    <main class="container">
      <article class="grid">
        <div>
          <h1>Find Reservations</h1>
          <?php include "reservationSearch.php"; ?>
        </div>
      </article> 
      <article class="grid">  
      <h1><a href="reservepage.php">Reserve</a></h1>
      </article>
      <article class="grid">
        <div>
          <h1>Admin Login</h1>
          <?php include "adminLogin.php"; ?>
        </div>
      </article>
      <?php
        include "sql.php";
        $date = date('Y-m-d');
        $sql = "UPDATE reservations set is_cancelled=TRUE WHERE reservation_date < '$date'";
        $result = $conn->query($sql);
      ?>
    </main>
  </body>
</html>

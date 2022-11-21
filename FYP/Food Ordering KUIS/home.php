<?php
session_start();
include "connection.php";

if (!isset($_SESSION['username'])) {
  include "includes/header.php";
}
if(isset($_SESSION['username'])) {
  $role = $_SESSION['role'];
  if($role == 'admin'){
    include "includes/headeradmin.php";
  }
  if($role == 'cafe_owner'){
    include "includes/headerseller.php";
  }
  if($role == 'customer'){
    include "includes/headerlog.php";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col mb-4">
      <img src="image/alazhar-03.jpg" alt="masjid al-azhar" width="400">
      </div>
      <div class="col mb-4">
          <p>This project is about making an online ordering system for café in KUIS to make it easier for the customer to order food and beverage and make it easier for owners to organize the order. 
          In addition, this project will help customer and owners greatly with their time because customer doesn’t need to queue to order food. 
          Now days the rapid growth in the use of internet and the technologies associated with it, the several opportunities are coming up on the web or mobile application.</p>
      </div>
    </div>
    <div class="row">
      <div class="col mb-4">
        <img src="image/fahmi-fakhrudin-nzyzAUsbV0M-unsplash.jpg" alt="" width="400">
      </div>
      <div class="col mb-4">
      <p>The objective developing Food Ordering KUIS project is to provide a friendly, 
          easy to use website that can provide the customer with service. 
          Nowadays, many restaurants in Malaysia still use manually, paper-based in food ordering system. 
          The problem using manually are probability of paper lost is high and misinterpret the handwriting of order. 
          Food Ordering KUIS is created to solved this problem. </p>
      </div>
    </div>
  </div>
</body>
</html>
<?php
include "includes/footer.php";
?>
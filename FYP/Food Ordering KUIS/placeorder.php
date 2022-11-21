<?php
session_start();
include "connection.php";
include "includes/headerlog.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

$username = $_SESSION['username'];
$test = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
$fetch = mysqli_fetch_assoc($test);
$user_id = $fetch['user_id'];
$status = "pending";
$cur_time = date("h:i");
$cur_date = date("Y-m-d");

if(isset($_GET['placeorder'])) {
    $query = "SELECT * FROM cart";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $cart_id = $row['id'];
           $name = $row['name'];
           $image = $row['image'];
           $quantity = $row['quantity'];
           $price = $row['price'];
           $date = $row['date'];
           $time = $row['time'];
           $user = $row['user'];
           $subtotal = sprintf("%.2f",$row['price'] * $row['quantity']);

           $insert = mysqli_query($conn, "INSERT INTO orderlist (user_id,name,image,quantity,price,total,date,time,order_date,order_time,status,user) 
           VALUES('$user_id','$name','$image','$quantity','$price','$subtotal','$date','$time','$cur_date','$cur_time','$status','$user')");

           if($insert == true) {
            mysqli_query($conn, "DELETE FROM cart WHERE id = $cart_id");
           }
        }
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
</head>
<body>
    <div class="container">
    <?php
    $dis = mysqli_query($conn,"SELECT * FROM orderlist WHERE user_id = '$user_id' ORDER BY order_id DESC");
    $cap = mysqli_fetch_assoc($dis);
    ?>
    <center>
        <p>Thank you for ordering with us.</p>
        <p>Kindly show your order number to the counter when pickup your order</p>
        <p>Your order number is: no <?php echo $cap['order_id'] ?></p>
        <a href="orderstatus.php" class="btn btn-danger">View Order</a>
    </center>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>
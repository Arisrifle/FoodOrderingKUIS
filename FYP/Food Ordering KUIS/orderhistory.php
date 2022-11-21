<?php
session_start();
include "includes/headerlog.php";
include "connection.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date("Y-m-d");

$username = $_SESSION['username'];
$test = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
$fetch = mysqli_fetch_assoc($test);
$user_id = $fetch['user_id'];

$sql = "SELECT * FROM orderlist WHERE user_id = '$user_id'";

$results = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
</head>
<body>
    <div class="container">
    <h3>Order History</h3><br>
    <div class="table-responsive-md">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order Time</th>
                <th colspan="2">Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Pickup time</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php
    if(mysqli_num_rows($results) > 0) {
        while($row = mysqli_fetch_assoc($results)){
            if($row['date'] <= $date) {
                if($row['status'] == 'completed' || $row['status'] == 'rejected') {
    ?>
        <tr>
            <td>
                <?php
                echo $row['order_date'];
                echo "<br>";
                echo $row['order_time'];
                ?>
            </td>
            <td><img src="image/<?php echo $row['image']?>" alt="" width="80" height="80"></td>
            <td><?php echo $row['name'] ?></td>
            <td>RM <?php echo $row['price'] ?></td>
            <td><?php echo $row['quantity'] ?></td>
            <td>RM <?php echo $row['total'] ?></td>
            <td>
                <?php
                echo $row['date'];
                echo "<br>";
                echo $row['time'];
                ?>
            </td>
            <td><?php echo $row['status'] ?></td>
        </tr>
        <?php
                }
            }
        }
    }
    else{
        echo "<h3>There is no order history</h3>";
    }
    ?>
    </table>
    </div>
    </div>
</body>
</html>
<?php
include "includes/footer.php";
?>
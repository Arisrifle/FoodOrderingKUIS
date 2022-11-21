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

$query = "SELECT * FROM orderlist WHERE user_id = $user_id";

$result = mysqli_query($conn,$query);

if(isset($_GET['cancel'])) {
    $order_id = $_GET['cancel'];
    mysqli_query($conn, "DELETE FROM orderlist WHERE order_id = $order_id");
    echo "<script> location.href='orderstatus.php'; </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
</head>
<body>
    <div class="container">
    <h3>Your Order</h3><br>
    <div class="table-responsive-md">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order No</th>
                <th>Order time</th>
                <th colspan="2">Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Pickup time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            if($row['status'] == 'pending' || $row['status'] == 'accepted') {
    ?>
        <tr>
            <td><?php echo $row['order_id'] ?></td>
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
            <?php
            if($row['status'] == 'pending'){
            ?>
            <td><a href="orderstatus.php?cancel=<?php echo $row['order_id']; ?>" class="btn btn-danger" onclick="return confirm('are you sure?')">Cancel</a></td>
            <?php
            }
            else {
             ?>
            <td><button class="btn btn-danger" disabled>Cancel</button></td>
            <?php
            }
            ?>
        </tr>
        <?php
            }
        }
    }
    else{
        echo "<h3>Your order list is empty</h3>";
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
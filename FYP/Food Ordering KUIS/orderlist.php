<?php
session_start();
include "includes/headerseller.php";
include "connection.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date("Y-m-d");

$user = $_SESSION['username'];

$query = "SELECT orderlist.*, user.username FROM orderlist
INNER JOIN user ON orderlist.user_id = user.user_id WHERE user = '$user'";

$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
</head>
<body>
    <div class="container">
    <h3>Order Management</h3><br>
    <div class="table-responsive-md">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order number</th>
                <th>Name</th>
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
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['username'] ?></td>
            <td>
                <?php echo $row['order_date']; ?><br>
                <?php echo $row['order_time']; ?>
            </td>
            <td><img src="image/<?php echo $row['image']?>" alt="" width="80" height="80"></td>
            <td><?php echo $row['name']; ?></td>
            <td>RM <?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>RM <?php echo $row['total']; ?></td>
            <td>
                <?php 
                echo $row['date'];
                echo "<br>";
                echo $row['time'];
                ?>
            </td>
            <td><?php echo $row['status']; ?></td>
            <td><a href="changestatus.php?change=<?php echo $row['order_id'] ?>" class="btn btn-danger">change</a></td>
        </tr>
            <?php
                }
            }
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
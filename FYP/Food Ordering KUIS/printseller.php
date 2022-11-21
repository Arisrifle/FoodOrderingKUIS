<?php
session_start();
include "connection.php";

if(isset($_POST['print'])){
    $date1 = $_POST['export1'];
    $date2 = $_POST['export2'];
    $sql = "SELECT orderlist.*,user.username FROM orderlist 
            INNER JOIN user ON orderlist.user_id = user.user_id WHERE date BETWEEN '$date1' AND '$date2'";
    $results = mysqli_query($conn,$sql);

    echo "<h4>Result: " . $date1 . " - ". $date2 . "</h4><br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print sales history</title>
</head>
<body>
    <div class="container">
        <table class="table table-borderless">
            <tr>
                <th>Order ID</th>
                <th>Order time</th>
                <th>Name</th>
                <th colspan="2">Products</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Pickup time</th>
                <th>Status</th>
            </tr>
            <?php
            if(mysqli_num_rows($results) > 0) {
                while($row = mysqli_fetch_assoc($results)){
            ?>
            <tr>
                <td><?php echo $row['order_id'] ?></td>
                <td>
                    <?php echo $row['order_date']; ?><br>
                    <?php echo $row['order_time']; ?>
                </td>
                <td><?php echo $row['username'] ?></td>
                <td><img src="image/<?php echo $row['image']?>" alt="" width="80" height="80"></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['quantity'] ?></td>
                <td>RM <?php echo $row['total'] ?></td>
                <td>
                    <?php echo $row['date']; ?><br>
                    <?php echo $row['time']; ?>
                </td>
                <td><?php echo $row['status'] ?></td>
            </tr>
            <?php
                    }
                }
            }
            ?>
        </table>
        <script type="text/javascript">
            window.print();
        </script>
        <a href="reportseller.php">back</a>
    </div>
</body>
</html>

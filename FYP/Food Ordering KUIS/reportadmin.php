<?php
session_start();
include "includes/headeradmin.php";
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body>
    <div class="container">
        <h3>Order History</h3><br>
    <form action="" method="post">
        <div class="row">
        <div class="col-5">
            <label for="date1">From</label>
            <input type="date" name="date1" class="form-control">
        </div>
        <div class="col-5">
            <label for="date2">To</label>
            <input type="date" name="date2" class="form-control">
        </div>
        <div class="col-2">
            <br>
            <input type="submit" name="check" class="btn btn-danger" value="Check">
        </div>
        </div>
    </form><br>
        <?php
        if(isset($_POST['check'])) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        
            $sql = "SELECT orderlist.*,user.username FROM orderlist 
            INNER JOIN user ON orderlist.user_id = user.user_id WHERE date BETWEEN '$date1' AND '$date2'";
            $results = mysqli_query($conn,$sql);
            
            echo "<h6>Result: " . $date1 . " - ". $date2 . "</h6><br>";
        ?>
        <div class="table-responsive-md">
        <table class="table table-striped">
            <tr>
                <th>Order ID</th>
                <th>Order time</th>
                <th>Name</th>
                <th colspan="2">Products</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Pickup time</th>
                <th>Status</th>
                <th>Cafe Owner</th>
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
                <td><?php echo $row['user'] ?></td>
            </tr>
            <?php
                }
            }
            else {
                echo "<td>There is no record found</td>";
            }
        }
            ?>
        </table>
        </div>
        <form action="printadmin.php" method="post">
            <input type="hidden" name="export1" value="<?php  echo $date1; ?>">
            <input type="hidden" name="export2" value="<?php  echo $date2; ?>">
            <input type="submit" name="print" class="btn btn-danger" value="Print">
        </form>
    </div>
</body>
</html>
<?php
include "includes/footer.php";
?>
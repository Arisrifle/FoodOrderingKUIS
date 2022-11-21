<?php
session_start();
include "includes/headerseller.php";
include "connection.php";

$id = $_GET['change'];
if(isset($_POST['submit'])) {
$status = $_POST['status'];

mysqli_query($conn, "UPDATE orderlist SET status = '$status' WHERE order_id = '$id'");
echo "<script> location.href='orderlist.php'; </script>";
}

$result = mysqli_query($conn,"SELECT orderlist.*,user.username FROM orderlist 
INNER JOIN user ON orderlist.user_id = user.user_id WHERE order_id = '$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Status</title>
</head>
<body>
    <div class="container">
        <?php
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        ?>
        <form action="" method="post" class="form-control">
            <label for="order_id"> Order ID</label>
            <input type="text" name="order_id" class="form-control" value="<?php echo $row['order_id']; ?>" readonly>
            <label for="cusname">Customer Name</label>
            <input type="text" name="cusname" class="form-control" value="<?php echo $row['username']; ?>" readonly>
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="rejected">Rejected</option>
                <option value="completed">Completed</option>
            </select>
            <input type="submit" name="submit" class="btn btn-danger">
        </form>
        <?php
        }
        ?>
    </div>
</body>
</html>
<?php
include "includes/footer.php";
?>
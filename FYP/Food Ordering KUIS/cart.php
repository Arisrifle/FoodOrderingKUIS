<?php
session_start();
include "connection.php";

if (!isset($_SESSION['username'])) {
    include "includes/header.php";
    $_SESSION['msg'] = "You must log in first";
    echo '<script>alert("Please login first")</script>';
    echo "<script> location.href='login.php'; </script>";
    exit;
}
else {
    include "includes/headerlog.php";
}

$query = "SELECT * FROM cart";
$results = mysqli_query($conn,$query);
$check = mysqli_num_rows($results);
$grandtotal = 0;
$pickup_date = "";
$pickup_time = "";

if(isset($_POST['update'])) {
    $quantity = $_POST['quantity'];
    $id = $_POST['qtyid'];
    $sql = "UPDATE cart set quantity = '$quantity' WHERE id = '$id'";
    mysqli_query($conn, $sql);
    echo "<script> location.href='cart.php'; </script>";
}
if(isset($_GET['remove'])) {
    $id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = $id");
    echo "<script> location.href='cart.php'; </script>";
}
if(isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM cart");
    echo "<script> location.href='cart.php'; </script>";
}
if(isset($_POST['change'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    mysqli_query($conn, "UPDATE cart SET date = '$date', time = '$time'");
    echo "<script> location.href='cart.php'; </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <div class="container">
    <form action="" method="post">
        <strong><label for="date">Pickup date</label><br></strong>
        <input type="date" name="date" class="form-control" style="width: 20%;"><br>
        <strong><label for="time">Pickup time</label><br></strong>
        <input type="time" name="time" class="form-control" style="width: 20%;"><br>
        <input type="submit" name="change" class="btn btn-danger" value="change">
    </form>
    <div class="table-responsive-md">
    <?php
        if($check > 0) {
        ?>
    <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2">Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <th>Total</th>
                </tr>
            </thead>
    <?php
        while($row = mysqli_fetch_assoc($results)){
    ?>
    <br>
        <?php $pickup_date = $row['date'];
         $pickup_time = $row['time'];
     ?>
    
    <tr>
      <td><img src="image/<?php echo $row['image']?>" alt="" width="80" height="80"></td>
      <td><?php echo $row['name']?></td>
      <td><?php echo $row['price']?></td>
      <td>
        <form action="" method="post">
          <input type="hidden" name="qtyid" min="1" value="<?php echo $row['id']; ?>">
          <input type="number" name="quantity" min="1" value="<?php echo $row['quantity']; ?>" style="width: 40px">
          <input type="submit" name="update" class="btn btn-danger" value="Update">
        </form>
      </td>
      <td><a href="cart.php?remove=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('are you sure?')">Remove</a></td>
      <td><?php echo $subtotal = sprintf("%.2f",$row['price'] * $row['quantity']); ?></td>
    </tr>
    <?php
    $grandtotal += $subtotal;
        }
        ?>
    </table><br>
    </div>
    
    <?php
    }
    else {
        echo "<br><h4> Your cart is empty</h4><br>";
    }
    ?>
    <span>Grand Total: RM <?= $grandtotal; ?></span><br><br>
    <h5>Pickup time :</h5>
    <?php
    echo $pickup_date."<br>";
    echo $pickup_time."<br><br>";
    if($check > 0) {
    ?>
    <tr>
        <td><a href="menu.php" class="btn btn-danger">Continue Shopping</a></td>
        <td><a href="placeorder.php?placeorder" class="btn btn-danger">Place Order</a></td>
        <td><a href="cart.php?delete_all" class="btn btn-danger" onclick="return confirm('are you sure?')">Delete all</a></td>
    </tr>
    <?php
    }
    ?>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>
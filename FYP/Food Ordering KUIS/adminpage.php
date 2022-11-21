<?php
session_start();
include "connection.php";
include "includes/headeradmin.php";

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo "<script> location.href='login.php'; </script>";
    exit;
}

$query1 = mysqli_query($conn, "SELECT count(*) as total FROM user WHERE role = 'customer'");
$query2 = mysqli_query($conn, "SELECT count(*) as total FROM user WHERE role = 'cafe_owner'");
$query3 = mysqli_query($conn, "SELECT count(*) as total FROM products");
$query4 = mysqli_query($conn, "SELECT count(*) as total FROM cafe");

$data1 = mysqli_fetch_assoc($query1);
$data2 = mysqli_fetch_assoc($query2);
$data3 = mysqli_fetch_assoc($query3);
$data4 = mysqli_fetch_assoc($query4);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="containter">
        <div class="row">
            <div class="col mb-4">
             <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Customer</h5>
                    <p class="card-text"><strong>total : <?php echo $data1['total']; ?></strong></p>
                    <a href="manageclient.php" class="card-link">Manage Customer</a>
                </div>
             </div>
            </div>
            <div class="col mb-4">
             <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Cafe Owner</h5>
                    <p class="card-text"><strong>total : <?php echo $data2['total']; ?></strong></p>
                    <a href="managevendor.php" class="card-link">Manage Cafe Owner</a>
                </div>
             </div>
            </div>
            <div class="col mb-4">
             <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Product</h5>
                    <p class="card-text"><strong>total : <?php echo $data3['total']; ?></strong></p>
                    <a href="product.php" class="card-link">Manage Product</a>
                </div>
             </div>
            </div>
        </div>
        <div class="row">
        <div class="col mb-4">
             <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Cafe</h5>
                    <p class="card-text"><strong>total : <?php echo $data4['total']; ?></strong></p>
                    <a href="managevendor.php" class="card-link">Manage Cafe</a>
                </div>
             </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include "includes/footer.php";
?>
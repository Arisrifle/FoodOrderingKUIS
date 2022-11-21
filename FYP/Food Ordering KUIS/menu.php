<?php
session_start();
include "connection.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

if (!isset($_SESSION['username'])) {
    include "includes/header.php";
}
else {
    include "includes/headerlog.php";
}

if(isset($_POST['add_to_cart'])){
    if(!$_SESSION['username']) {
        echo '<script>alert("Please login first")</script>';
        echo "<script> location.href='login.php'; </script>";
        exit;
    }
    $image = $_POST['image'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = 1;
    $user = $_POST['user'];
    $time = date("h:i", strtotime('+10 minutes'));
    $date = date("Y-m-d");

    $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$name'");

    if(mysqli_num_rows($select_cart) > 0) {
        while($fetch = mysqli_fetch_assoc($select_cart)) {
            $qty = $fetch['quantity'];
            $qty += 1;
           echo '<script>alert("Product added to cart successfully")</script>';
          $update = mysqli_query($conn, "UPDATE cart SET quantity = '$qty' WHERE name = '$name'");
          echo "<script> location.href='cart.php'; </script>"; 
        }
    }
    else {
        $insert = mysqli_query($conn, "INSERT INTO cart(name,price,image,quantity,date,time,user) 
        VALUES('$name','$price','$image','$quantity','$date','$time','$user') ");
        echo '<script>alert("Product added to cart successfully")</script>';
        echo "<script> location.href='cart.php'; </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <div class="container">
    <?php
    $sql = "SELECT * FROM cafe";
    $result = mysqli_query($conn, $sql);
    
    ?>
    <h3>Select Cafe</h3><br>
    <form action="" method="post">
        <select name="selectcafe" class="form-control" style="width: 20%;">
            <option value="">Select Cafe</option>
        <?php
        while($fetch = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $fetch['user'] ?>"><?php echo $fetch['cafename'] ?></option>
        <?php } ?>
        </select><br>
        <input type="submit" name="select" value="Select" class="btn btn-danger">
    </form><br>

    <?php
    
    if(isset($_POST['select'])) {
        $select = $_POST['selectcafe'];
    ?>
    
    <center>
    <div class="container">
        <div class="row">
    <?php
    $query = mysqli_query($conn,"SELECT * FROM products WHERE user = '$select'");
    if(mysqli_num_rows($query) > 0) {
        while($fetch = mysqli_fetch_assoc($query)) {
    ?>
        <div class="col mb-4">
    <div class="card" style="width: 18rem;">
        <form action="" method="post" class="container text-center">
            <br>
                <img src="image/<?php echo $fetch['image'] ?>" class="card-img-top" alt="" width="200">
                <div class="card-body">
                    <div class="card-title">
                        <h5><?php echo $fetch['name'] ?></h5>
                    </div>
                    <div class="card-text">
                        <p><strong>RM <?php echo $fetch['price'] ?></strong></p>
                    </div>
                </div>
            <input type="hidden" name="image" value="<?php echo $fetch['image']; ?>">
            <input type="hidden" name="name" value="<?php echo $fetch['name']; ?>">
            <input type="hidden" name="price" value="<?php echo $fetch['price']; ?>">
            <input type="hidden" name="user" value=<?php echo $fetch['user'] ?>>
            <input type="submit" class="btn btn-danger" value="add to cart" name="add_to_cart">
        </form><br>
    </div>
        </div>
    <?php
        }
    }
}
    ?>
    </div>
    </div>
</center>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>
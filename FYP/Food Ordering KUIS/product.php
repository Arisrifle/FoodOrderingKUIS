<?php
session_start();
include "includes/headeradmin.php";
include "connection.php";

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE product_id = $id");
    echo "<script> location.href='product.php'; </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <div class="container">
    <h3>Product Management</h3><br>
    <form action="" method="get">
        <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" name="search">
            </div>
            <div class="col-3">
                <input type="submit" name="submit" value="search" class="btn btn-danger">
            </div>
            <div class="col-3">
                <a href="addproduct.php" class="btn btn-danger">Add Product</a>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th>image</th>
            <th>seller</th>
            <th>manage</th>
        </thead>
<?php
if(isset($_GET['submit'])) {
    $search = $_GET['search'];
    echo "<h5>Search result: ".$search."</h5>";
}
else{
    $search = "";
}
$res = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$search%' OR user LIKE '%$search%'");
if(mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)){

?>
        <tr>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><img src="image/<?php echo $row['image']?>" alt="" width="80" height="80"></td>
            <td><?php echo $row['user']; ?></td>
            <td>
                <a href="product.php?delete=<?php echo $row['product_id'];?>" class="btn btn-danger" 
                onclick="return confirm('are you sure?')">delete</a>
            </td>
        </tr>
        <?php
    }
}
?>
    </table>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>
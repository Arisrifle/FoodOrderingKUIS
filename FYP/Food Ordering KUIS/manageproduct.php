<?php
session_start();
include "includes/headerseller.php";
include "connection.php";

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo "<script> location.href='login.php'; </script>";
    exit;
}

$username = $_SESSION['username'];

if(isset($_POST['submit'])) {
    $name=$_POST['name'];
    $price=$_POST['price'];
    $image = $_FILES['image']['name'];
    $tmpname =$_FILES['image']['tmp_name'];
    $folder = 'image/'.$image;

    $sql = "INSERT INTO products (name, price, image, user) 
        VALUES ('$name', '$price', '$image', '$username')";

    $result = mysqli_query($conn, $sql);

    if ($result == true) {
           move_uploaded_file($tmpname, $folder);
           echo "$name successfully added";
    }
    else {
        echo "error : ".mysqli_error($conn);
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>
<body>
    <div class="container">
    <h3>Add to menu</h3><br>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" placeholder="enter product name" required>
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="price" class="form-control" placeholder="enter product price" required>
                <label for="price">Price</label>
            </div>
                <label for="image">Image</label><br>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="form-control" required><br>
                <input type="submit" name="submit" class="btn btn-danger" value="add product">
        </form>
    <?php

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE product_id = $id");
    echo "<script> location.href='manageproduct.php'; </script>";
}

$select = mysqli_query($conn, "SELECT * FROM products WHERE user = '$username'");

?>
    <table class="table table-striped">
        <thead>
            <th> image </th><br>
            <th> name </th><br>
            <th> price </th><br>
            <th> action </th><br>
        </thead>
    

<?php

while($row = mysqli_fetch_assoc($select)) {

?>

<tr>
    <td><img src="image/<?php echo $row['image']?>" alt="" width="80" height="80"></td>
    <td><?php echo $row['name']?></td>
    <td><?php echo $row['price']?></td>
    <td>
        <a href="update.php?edit=<?php echo $row['product_id'];?>" class="btn btn-danger" 
        onclick="return confirm('are you sure?')">edit</a>
        <a href="manageproduct.php?delete=<?php echo $row['product_id'];?>" class="btn btn-danger" 
        onclick="return confirm('are you sure?')">delete</a>
    </td>
</tr>

<?php
};
?>
    </table>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>
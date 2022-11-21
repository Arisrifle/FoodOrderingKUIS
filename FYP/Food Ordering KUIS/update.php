<?php
session_start();
include "includes/headerseller.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <div class="container">
    <?php

    include "connection.php";
    
    $id = $_GET['edit'];

    if(isset($_POST['update'])) {
        $name=$_POST['name'];
        $price=$_POST['price'];
        $image = $_FILES['image']['name'];
        $tmpname =$_FILES['image']['tmp_name'];
        $folder = 'image/'.$image;
    
        $update = "UPDATE products SET name='$name', price='$price', image='$image' 
        WHERE product_id='$id'";
    
        $result = mysqli_query($conn, $update);
    
        if ($result == true) {
            move_uploaded_file($tmpname, $folder);
            echo "$name successfully added";
        }
        else {
            echo "error : ".mysqli_error($conn);
        }
    
        
    }
    
    ?>

    <div>
        <?php
        
        $select = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$id'");
        while($row = mysqli_fetch_assoc($select)) {
        
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <h3>Add to menu</h3>
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" placeholder="enter product name" value="<?php echo $row['name']; ?>">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="price" class="form-control" placeholder="enter product price" value="<?php echo $row['price']; ?>">
                <label for="price">Price</label>
            </div>
                <label for="image">Image</label><br>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="form-control"><br>
                <input type="submit" name="update" class="btn btn-danger" value="update product">
                <a href="manageproduct.php" class="btn btn-danger">Back</a>
        </form>

        <?php
        }
        ?>

    </div>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>

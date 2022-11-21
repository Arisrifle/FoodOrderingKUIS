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
    <title>Add Product</title>
</head>
<body>
    <div class="container">
    <?php
    if(isset($_POST['add'])) {
        $name=$_POST['name'];
        $price=$_POST['price'];
        $image = $_FILES['image']['name'];
        $tmpname =$_FILES['image']['tmp_name'];
        $folder = 'image/'.$image;
        $user = $_POST['cafe'];
    
        $add = "INSERT INTO products (name,price,image,user) 
        VALUES ('$name','$price','$image','$user')";
    
        $result = mysqli_query($conn, $add);
    
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
        <form method="post" action="" enctype="multipart/form-data">
            <h3>Add to menu</h3><br>
            <label for="cafe">Cafe</label>
            <select name="cafe" class="form-control">
                <option value="">Select cafe</option>
                <?php
                $select = mysqli_query($conn,"SELECT * FROM cafe");
                if(mysqli_num_rows($select) > 0) {
                    while($cafe = mysqli_fetch_assoc($select)) {
                ?>
                <option value="<?php echo $cafe['user']; ?>"><?php echo $cafe['cafename']; ?></option>
                <?php
                    }
                }
                ?>
            </select><br>
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="price" class="form-control">
                <label for="price">Price</label>
            </div>
                <label for="image">Image</label><br>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="form-control"><br>
                <input type="submit" name="add" class="btn btn-danger" value="Add Product">
                <a href="product.php" class="btn btn-danger">go back</a>
        </form>
    </div>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>
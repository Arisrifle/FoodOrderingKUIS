<?php
session_start();
include "includes/headerseller.php";
include "connection.php";
$user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3>List of products</h3><br>
    <div class="row">
    <?php
    $query = mysqli_query($conn,"SELECT * FROM products WHERE user = '$user'");
    if(mysqli_num_rows($query) > 0) {
        while($fetch = mysqli_fetch_assoc($query)) {
    ?>
        <div class="col  mb-4">
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
        <a href="update.php?edit=<?php echo $fetch['product_id'];?>" class="btn btn-danger" 
        onclick="return confirm('are you sure?')">edit</a>
    </form><br>
    </div>
        </div>
    <?php
        }
    }
    ?>
    </div>
</body>
</html>
<?php
include "includes/footer.php";
?>
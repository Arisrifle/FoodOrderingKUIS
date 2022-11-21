<?php
session_start();
include "connection.php";
include "includes/headeradmin.php";

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    mysqli_query($conn, "DELETE FROM user WHERE user_id = $id");
    echo "<script> location.href='manageclient.php'; </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
</head>
<body>
    <div class="container">
    <h3>Customer Management</h3><br>
    <form action="" method="get">
        <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" name="search">
            </div>
            <div class="col-3">
                <input type="submit" name="submit" value="search" class="btn btn-danger">
            </div>
            <div class="col-3">
                <a href="addcus.php" class="btn btn-danger">Add Customer</a>
            </div>
        </div>
    </form><br>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Email</th>
            <th>Username</th>
            <th>Action</th>
        </thead>
    <?php
    if(isset($_GET['submit'])) {
        $search = $_GET['search'];
        echo "<h5>Search result: ".$search."</h5>";
    }
    else{
        $search = "";
    }
        $res = mysqli_query($conn, "SELECT * FROM user WHERE role ='customer' AND username LIKE '%$search%'");
        while($cus = mysqli_fetch_assoc($res)) {
    ?>
    
    <tbody>
            <td><?php echo $cus['user_id']; ?></td>
            <td><?php echo $cus['email']; ?></td>
            <td><?php echo $cus['username']; ?></td>
            <td>
                <a href="manageclient.php?delete=<?php echo $cus['user_id'];?>" class="btn btn-danger" 
                onclick="return confirm('are you sure?')">delete</a>
            </td>
        </tbody>
        <?php
        }
        ?>
        </table>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>
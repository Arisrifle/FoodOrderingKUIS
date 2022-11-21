<?php
session_start();
include "includes/headeradmin.php";
include "connection.php";

$user_id = $_GET['change'];

$select = mysqli_query($conn,"SELECT cafe.cafename, user.* FROM cafe 
INNER JOIN user ON cafe.user = user.username WHERE user_id = '$user_id'");
$show = mysqli_fetch_assoc($select);
$user = $show['username'];

if(isset($_POST['changecn'])) {
    $newcafename = $_POST['cafename'];
    mysqli_query($conn,"UPDATE cafe set cafename = '$newcafename' WHERE user = '$user'");
    echo "<script> location.href='managevendor.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Cafe Name</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" name="oldcafename" class="form-control" value="<?php echo $show['cafename']; ?>" readonly>
                <label for="oldcafename">Old Cafe Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="cafename" class="form-control">
                <label for="cafename">New Cafe Name</label>
            </div>
            <input type="submit" name="changecn" class="btn btn-danger" value="Change">
            <a href="managevendor.php" class="btn btn-danger">Back</a>
        </form>
    </div>
</body>
</html>
<?php
include "includes/footer.php";
?>
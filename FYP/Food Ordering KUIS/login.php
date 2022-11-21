<?php
session_start();
include "connection.php";
include "includes/header.php";
$errors = array();

if(isset($_SESSION['username'])) {
    $role = $_SESSION['role'];
    if($role == 'admin'){
        echo "<script> location.href='adminpage.php'; </script>";
      }
      if($role == 'cafe_owner'){
        echo "<script> location.href='cafeownerpage.php'; </script>";
      }
      if($role == 'customer'){
        echo "<script> location.href='home.php'; </script>";
      }
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
            $row = mysqli_fetch_assoc($results);
            $role = $row['role'];
            if($role == 'admin') {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['success'] = "You are now logged in";
                echo "<script> location.href='adminpage.php'; </script>";
                exit;
            }
            if($role == 'cafe_owner') {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['success'] = "You are now logged in";
                echo "<script> location.href='cafeownerpage.php'; </script>";
                exit;
            }
            if($role == 'customer') {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['success'] = "You are now logged in";
                echo "<script> location.href='home.php'; </script>";
                exit;
            }
          
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrindersCafe-login</title>
</head>
<body>
    <div class="container">
    <h3>Login</h3><br>
    <form action="" method="POST">
    <?php include('errors.php'); ?>
    <br>
    <div class="form-floating mb-3">
        <input type="text" name="username" class="form-control" placeholder="Your username" required>
        <label for="username">Username</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control" placeholder="Your password" required>
        <label for="password">Password</label>
    </div>
        <input type="submit" name="login" class="btn btn-danger" value="Login">
    </form><br>
    <a href="register.php">Create account</a>
    </div>
</body>
</html>
<?php
include "includes/footer.php";
?>
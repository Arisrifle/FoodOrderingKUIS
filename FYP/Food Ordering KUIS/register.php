<?php
session_start();
$errors = array();
include "includes/header.php";
include "connection.php";

if(isset($_POST['register'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $role = 'customer';

    if (empty($username)) { 
        array_push($errors, "Username is required"); 
    }
    if (empty($email)) { 
        array_push($errors, "Email is required");
    }
    if (empty($password)) { 
        array_push($errors, "Password is required"); 
    }
    if($password != $confirm_password) {
        array_push($errors, "The two passwords do not match");
    }
    $user_check = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
          array_push($errors, "Username already exists");
        }
    
        if ($user['email'] === $email) {
          array_push($errors, "email already exists");
        }
      }
      if (count($errors) == 0) {
        $password = md5($password);//encrypt the password before saving in the database
  
        $query = "INSERT INTO user (email, username, password, role) 
                  VALUES('$email', '$username', '$password', '$role')";
        mysqli_query($conn, $query);
        echo '<script>alert("Your registration is completed")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container">
    <h3>Create Account</h3><br>
    <form action="" method="post">
    <?php include "errors.php"; ?>
    <br>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" placeholder="please enter your email">
        <label for="email">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="username" placeholder="please enter your username">
        <label for="username">Username</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="password" placeholder="please enter your password">
        <label for="password">Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="confirm_password" placeholder="please re-write your password">
        <label for="confirm_password">Confirm Password</label>
    </div>
        <input type="submit" class="btn btn-danger" name="register" value="Register"><br><br>
        <p>Already have an account? <a href="login.php">Login</a></p>
        <a href="register_seller.php">Start Selling?</a>
    </form>
</div>
</body>
</html>
<?php
include "includes/footer.php";
?>
<?php 
include "connection.php";

mysqli_query($conn, "DELETE FROM cart");

session_start();
session_unset();
session_destroy();

echo "<script>window.open('home.php','_self')</script>";

?>
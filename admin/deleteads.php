<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('connection.php');
if (!isset($_SESSION["admin_email"])) {
    header("Location: index.php");
    exit();
} else {
    $adminemail = $_SESSION["admin_email"];
} 

if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    $sql = "DELETE from ads where id='$product_id'";
    $productresult = mysqli_query($connection, $sql);

    if ($productresult) {
        header("Location: ads.php");
}
else{
    echo "<script>alert('DATABASE ERROR.');</script>";
}
}
?>
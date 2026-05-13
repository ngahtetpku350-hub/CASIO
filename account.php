<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
include("connection.php");
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();

} else {
    $useremail = $_SESSION["email"];
}

$query = "SELECT * from user where useremail = '$useremail'";
$result = mysqli_query($connection, $query);

if(!$result) {
    echo"<script>alert('Please Login First'); window.location='login.php';</script>";
}


$orderquery = "SELECT * from orders where useremail ='$useremail'";
$orderresult = mysqli_query($connection, $orderquery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
</head>
<body>
    <h1><?php echo $useremail ?></h1> 


    <section>
        <h1>
            <a href="orderhistory.php">Recent Your Order</a>
        </h1>
    </section>
    <?php while ($row = mysqli_fetch_assoc($orderresult)) { ?>
            <h3><?php echo $row['name'] ?></h3>
             <div>
                <h1> <?php echo $row ['time'] ?> </h1>
                <h1> <?php echo $row ['totalprice'] ?> </h1>
                <h1> <?php echo $row ['cusname'] ?> </h1>
                <h1> <?php echo $row ['name'] ?> </h1>
                <h1> <?php echo $row ['qty'] ?> </h1>
             </div>
    <?php } ?>
</body>
</html>
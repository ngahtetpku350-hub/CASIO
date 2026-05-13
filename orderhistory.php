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

$query = "SELECT * From orders where useremail = '$useremail'";
$result = mysqli_query($connection, $query);
$ordercount = mysqli_num_rows($result);
if (!$result) {
    echo "<script>sleart: Database connection error: location:index.php</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History List</title>
</head>

<body>
    <h1><?php echo $ordercount ?></h1>

    <?php while ($row = mysqli_fetch_array($result)) { ?>
         <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Unit Price (Ks)</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Your Name</th>
                    <th scope="col">Your Email</th>
                    <th scope="col">Your Phone</th>
                    <th scope="col">Youe Address</th>
                    <th scope="col">Your Note</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>

                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['unitprice'] ?></td>
                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['totalprice'] ?></td>
                        <td><?php echo $row['cusname'] ?></td>
                        <td><?php echo $row['useremail'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['address'] ?></td>
                        <td><?php echo $row['note'] ?></td>
                        <td><?php echo $row['time'] ?></td>   
                    </tr>
            </tbody>
        </table>
        <?php } ?>


</body>

</html>
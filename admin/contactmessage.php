<?php
session_start();

if (!isset($_SESSION["admin_email"])) {
    header("Location: index.php");
    exit();
} else {
    $adminemail = $_SESSION["admin_email"];
}

include("connection.php");

$query = "SELECT * FROM contact order by id desc";
$result = mysqli_query($connection, $query);
$record_count = mysqli_num_rows($result);
if (!$result) {
    echo "database ERROR" . mysqli_error($connection);
} else {

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyle.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Contact Message Page</title>
</head>

<body>
    <div class="navbar">
        <nav>
            <p> Admin Dashboard</p>
            <ul>
                <li><a href="adminhome.php"> Home</a></li>
                <li><a href="products.php">Product</a></li>
                <li><a href="contactmessage.php">Contact Message</a></li>
                <li><a href="orderlist.php"> Order List</a></li>
                <li><a href="logout.php"> Logout</a></li>
            </ul>
        </nav>
    </div>
    <h1>Contact Message Page</h1>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <h4> <?php echo $row['useremail'] ?> </h4>
            <h4><?php echo $row['message'] ?></h4>
        <?php } ?>

        <h4> <?php echo $record_count ?></h4>
</body>

</html>
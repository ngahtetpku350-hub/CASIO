<?php 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION["admin_email"])) {
    header("Location: index.php");
    exit();
} else {
    $adminemail = $_SESSION["admin_email"];
}

include("connection.php");

 $query = "SELECT * from orders order by orderid desc";
 $result = mysqli_query($connection, $query); 
 if(!$result) {
    echo"<script>alert('DATABASE CONNECTION ERROR');</script>";
 }
 $ordercount = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="adminstyle.css">
    <title>Cus Order</title>
</head>
<style>
    h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 2rem;
}

h2 {
    text-align: center;
    color: #27ae60;
    margin-bottom: 2rem;
    font-size: 1.5rem;
}

.table {
    width: 90%;
    margin: 0 auto 2rem auto;
    background: white;
    border-collapse: collapse;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    overflow-x: auto;
    display: block;
    flex-wrap: wrap;
}

.table thead {
    background: #34495e;
    color: white;
}

.table thead th {
    padding: 12px;
    text-align: left;
    font-weight: bold;
    border: 1px solid #2c3e50;
}

.table tbody td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

</style>
<body>
        <div class="navbar">
        <nav>
            <p> Admin Dashboard</p>
            <ul>
                <li><a href="adminhome.php"> Home</a></li>
                <li><a href="products.php">Product</a></li>
                <li><a href="contactmessage.php">Contact Message</a></li>
                <li><a href="orderlist.php"> Order List</a></li>
                <li><a href="ads.php"> 
                    Ads management
                </a></li>
                <li><a href="logout.php"> Logout</a></li>
            </ul>
        </nav>
    </div>
    <h1>Order list</h1>
    <h2><?php echo $ordercount ?></h2>
    <?php while ($row = mysqli_fetch_array($result)) { ?>
         <table class="table">
            <thead>
                <tr>
                    <th scope="col"> Order ID </th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Unit Price (Ks)</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Note</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                    <tr>
                        <td><?php echo $row['orderid'] ?></td>
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


        <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
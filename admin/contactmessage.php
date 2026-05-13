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
<style>
    .table-section {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    flex-direction: column;
}

section.table {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

section.table > div {
    background: white;
    padding: 1rem 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    display: inline-block;
}

section.table > div h4 {
    margin: 0;
    color: #667eea;
    font-size: 1.3rem;
    font-weight: bold;
}

section.table > div h4 span {
    color: #764ba2;
    font-size: 1.5rem;
}

.table {
    width: 100%;
    /* background: black; */
    border-radius: 20px;
    overflow: hidden;
    border-collapse: separate;
    border-spacing: 0;
    border: 1px solid black;
}

.table thead {
    background:red;
}

.table thead th {
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
    padding: 1.2rem 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: none;
}

.table thead th:first-child {
    border-top-left-radius: 20px;
}

.table thead th:last-child {
    border-top-right-radius: 20px;
}

.table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #e0e0e0;
}

.table tbody tr:hover {
    background: #f8f9ff;
    transform: scale(1.01);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.table tbody td {
    padding: 1rem;
    color: #333;
    font-size: 0.95rem;
    vertical-align: top;
}

.table tbody td:first-child {
    font-weight: 600;
    color: #667eea;
    word-break: break-word;
}

.table tbody td:last-child {
    line-height: 1.5;
    word-break: break-word;
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
    <section class="table">
        <div>
            <h4>Total contact: <?php echo $record_count ?></h4>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User Email</th>
                    <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['useremail'] ?></td>
                        <td><?php echo $row['message'] ?></td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </section>
        

        <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
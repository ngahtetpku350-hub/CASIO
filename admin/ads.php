<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if (!isset($_SESSION["admin_email"])) {
    header("Location: index.php");
    exit();
} else {
    $adminemail = $_SESSION["admin_email"];
}
include("connection.php");

if (isset($_POST["btnsave"])) {
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $qty = $_POST["qty"];
    $price = $_POST["price"];
    $image = $_FILES['image']['name'];
    $tem_location = $_FILES['image']['tmp_name'];
    $upload_location = '../uploads/';
    $final_location = $upload_location . $image;

    $query = "INSERT into ads (img,name,qty,price,des) VALUES ('$image','$name','$qty','$price','$desc')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script>alert('Product add successfully.');</script>";
        move_uploaded_file($tem_location, $final_location);
    } else {
        echo "<script>alert('Ads uploading Fail');</script>";
    }
}

$adsquery = "SELECT * from ads order by id desc";
$adsresult = mysqli_query($connection, $adsquery);

if (!$adsresult) {
    echo "<script>alert('Error Database Connection');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyle.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Ads</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f5f5f5;
    }

    form section {
        background: white;
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    form section>div {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    form section input[type="text"],
    form section input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    form section input[type="text"]:focus {
        outline: none;
        border-color: #2c3e50;
    }

    form section input[type="submit"] {
        background: #2c3e50;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
    }

    form section input[type="submit"]:hover {
        background: #1a252f;
    }

    .ads_list {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .product-search {
        display: flex;
        gap: 10px;
        margin-bottom: 2rem;
        justify-content: center;
    }

    .product-search-box {
        flex: 1;
        max-width: 300px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .btnsearhproduct {
        background: #2c3e50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btnsearhproduct:hover {
        background: #1a252f;
    }

    .table {
        width: 100%;
        background: white;
        border-collapse: collapse;
    }

    .table thead {
        background: #2c3e50;
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
        vertical-align: middle;
    }

    .table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .table tbody tr:hover {
        background: #f0f0f0;
    }

    /* Image in table */
    .table tbody td img {
        border-radius: 5px;
        object-fit: cover;
    }

    /* Action Buttons */
    .btn {
        display: inline-block;
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 12px;
        margin: 0 3px;
    }

    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
    }

    .btn-secondary {
        background: #e74c3c;
        color: white;
    }

    .btn-secondary:hover {
        background: #c0392b;
    }

    /* Responsive */
    @media (max-width: 768px) {
        form section {
            margin: 1rem;
            padding: 1rem;
        }

        .product-search {
            flex-direction: column;
            align-items: center;
        }

        .product-search-box {
            max-width: 100%;
        }

        .table thead th,
        .table tbody td {
            padding: 8px;
            font-size: 12px;
        }

        .btn {
            padding: 4px 8px;
            font-size: 10px;
        }
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
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
    <form action="ads.php" method="post" enctype="multipart/form-data">
        <section>
            <div>
                <div>
                    <input type="text" name="name" placeholder="Product name">
                </div>
                <div>
                    <input type="text" name="qty" placeholder="Product Quantity">
                </div>
                <div>
                    <input type="text" name="price" placeholder="Price">
                </div>
                <div>
                    <input type="text" name="desc" placeholder="Description of ads">
                </div>
                <div>
                    <input type="File" name="image" value="choose file photo" accept="image/*" required>
                </div>
                <div>
                    <input type="submit" name="btnsave" value="Save">
                </div>
            </div>
        </section>
    </form>

    <div class="ads_list">
        <div class="product-search">
            <input class="product-search-box" type="search" name="" id="" placeholder="Search.....">
            <input class="btnsearhproduct" type="submit" name="" id="" value="Search">
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price (Ks)</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($adsrow = mysqli_fetch_array($adsresult)) { ?>
                    <tr>
                        <td>
                            <?php echo $adsrow['name'] ?>
                        </td>
                        <td>
                            <?php echo $adsrow['price'] ?>
                        </td>
                        <td>
                            <?php echo $adsrow['qty'] ?>
                        </td>
                        <td>
                            <?php echo $adsrow['des'] ?>
                        </td>
                        <td><img src="../uploads/<?php echo $adsrow['img'] ?>" width="50px" alt=""></td>
                        <td>
                            <a href="updateads.php?product_id=<?php echo $adsrow['id'] ?>"
                                class="btn btn-primary me-3">Update</a>
                            <a href="deleteads.php?product_id=<?php echo $adsrow['id'] ?>"
                                class="btn btn-secondary">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
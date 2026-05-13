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

if (isset($_POST["btnadd"])) {
    $productname = $_POST["name"];
    $productprice = $_POST["price"];
    $qty = $_POST["qty"];
    $desc = $_POST["des"];
    $image = $_FILES['image']['name'];
    $tem_location = $_FILES['image']['tmp_name'];
    $upload_location = '../uploads/';
    $final_location = $upload_location . $image;

    $query = "INSERT INTO product (name, price, qty, des, productimg) VALUES ('$productname','$productprice','$qty','$desc','$image')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo "<script>alert('Fail to add product.');</script>";

    } else {

        echo "<script>alert('Product add successfully.');</script>";
        move_uploaded_file($tem_location, $final_location);
    }
}
$productlistquery = "SELECT * from product order by productid desc";
$productresult = mysqli_query($connection, $productlistquery);
if (!$productresult) {
    echo "<script>alert('Database connection error');</script>";
} else {

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="adminstyle.css">
    <title>Product Management Page</title>
</head>

<body style="height: 100vh;">
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
    <style>
        .productaddform{
            background: transparent;
            display: flex;
            align-items:center ;
            justify-content: center;
            margin-bottom: 30px;
        }
        .add-product-input-form{
            gap: 10px;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 80%;
            border-radius: 40px 5px 40px 5px;
            padding: 20px;
            border: 1px solid black;
        }
        .outterbox,.innerbox{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }
        .innerbox div input{
            width: 70%;
            padding: 9px;
            border-radius: 2px 20px 2px 20px;
        }
        .innerbox div{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
       .btnaddproduct{
            width: 100%;
            background: blue;
            padding: 9px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 20px;
        }
    </style>
    <form class="productaddform" action="products.php" method="post" enctype="multipart/form-data">
        <div class="add-product-input-form">
            <div>
                <h2 style="color:white;">Add Product</h2>
            </div>
            <div class="outterbox">
                <div class="innerbox">
                    <div>
                        <input type="text" name="name" placeholder="Product Name" required>
                    </div>
                    <div>
                        <input type="text" name="price" placeholder="Price (Ks)" required>
                    </div>
                </div>
                <div class="innerbox">
                    <div>
                        <input type="text" name="qty" placeholder="Product Quantity" required>
                    </div>
                    <div>
                        <input type="text" name="des" placeholder="Description" required>
                    </div>
                    <div>
                        <input type="file" name="image" accept="image/*" required>
                    </div>
                </div>
            </div>
            <div>
                <input class="btnaddproduct" type="submit" name="btnadd" value="Add Product">
            </div>
        </div>
    </form>
    <hr>
    <style>
        .table-section{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            /* background: #000; */
            padding: 20px;
            flex-direction: column;
        }
        .table{
            flex-direction: column;
            width: 80%;
            margin: auto;
            border-radius: 20px;
            background-color: yellowgreen;
        }
        .product-search{
            margin-bottom: 20px;
            display: flex;
            gap: 20px;
            background: white;
            width: 100%;
            align-items: center;
            justify-content: center;
        }
        .btnsearhproduct{
            border-radius: 10px;
            padding: 8px;
            width: 150px;
        }
        .product-search-box{
            width: 100%;
            background: yellow;
            border-radius: 30px;
            /* max-width: 400px; */
            padding: 8px;
            transition: 0.5;
        }
        .product-search-box:hover{
            width:500px ;
        }
    </style>
    <section class="table-section">
        <div>
            <h2>Products List</h2>
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
                    <?php while ($productrow = mysqli_fetch_array($productresult)) { ?>
                    <tr>
                        <td><?php echo $productrow['name'] ?></td>
                        <td><?php echo $productrow['price'] ?></td>
                        <td><?php echo $productrow['qty'] ?></td>
                        <td><?php echo $productrow['des'] ?></td>
                        <td><img src="../uploads/<?php echo $productrow['productimg'] ?>" width="50px" alt=""></td>
                        <td>
                            <a href="updateproduct.php?product_id=<?php echo $productrow['productid'] ?>"
                                class="btn btn-primary me-3">Update</a>
                            <a href="deleteproduct.php?product_id=<?php echo $productrow['productid'] ?>"
                                class="btn btn-secondary">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </section>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
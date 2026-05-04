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

    $query = "SELECT * FROM product where productid='$product_id'";
    $productresult = mysqli_query($connection, $query);

    if ($productresult) {
        $productrow = mysqli_fetch_array($productresult);
        $originalimg = $productrow["productimg"];

    } else {
        echo "<script>alert('DATABASE ERROR.');</script>";
    }

}

if (isset($_POST["btnupdate"])) {
    $product_name = $_POST["name"];
    $product_price = $_POST["price"];
    $product_quantity = $_POST["quantity"];
    $product_description = $_POST["description"];
    $product_image = $_FILES["image"]["name"];

    if ($product_image) {

        $old_image_path = "../uploads/" . $originalimg;
        if (file_exists($old_image_path) && !empty($originalimg)) {
            unlink($old_image_path);
        }
        $tmp_location = $_FILES['image']['tmp_name'];
        $new_location = "../uploads/";
        move_uploaded_file($tmp_location, $new_location . $product_image);
        $sql = "UPDATE product SET name='$product_name', price='$product_price', qty='$product_quantity', des='$product_description', productimg='$product_image' where productid='$product_id'";
    } else {
        $sql = "UPDATE product SET name='$product_name', price='$product_price', qty='$product_quantity', des='$product_description' where productid='$product_id'";
    }

    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo "<script>alert('Product Data Successfully'); window.location.href='products.php';</script>";
        exit();
    } else {
        echo "Error is {$connection->error}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Page</title>
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
    <section class="table-section">
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
                    <?php 
                    // Re-run query for the loop since we already fetched once
                    $query = "SELECT * FROM product where productid='$product_id'";
                    $productresult = mysqli_query($connection, $query);
                    while ($productrow = mysqli_fetch_array($productresult)) { ?>
                    <tr>
                        <td><input type="text" name="name" value="<?php echo $productrow['name'] ?>"></td>
                        <td><input type="text" name="price" value="<?php echo $productrow['price'] ?>"></td>
                        <td><input type="text" name="quantity" value="<?php echo $productrow['qty'] ?>"></td>                        
                        <td><textarea name="description"><?php echo $productrow['des'] ?></textarea></td>
                        <td>
                            <img src="../uploads/<?php echo $productrow['productimg'] ?>" width="50px" alt="">
                            <input type="file" name="image">
                        </td>
                        <td><input type="submit" name="btnupdate" value="Update"></td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </section>
    </form>
</body>

</html>
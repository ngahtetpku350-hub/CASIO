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

    $query = "SELECT * FROM ads where id='$product_id'";
    $productresult = mysqli_query($connection, $query);

    if ($productresult) {
        $productrow = mysqli_fetch_array($productresult);
        $originalimg = $productrow["img"];

    } else {
        echo "<script>alert('DATABASE ERROR.');</script>";
    }

}

if (isset($_POST["btnupdate"])) {
    $product_name = $_POST["name"];
    $product_price = $_POST["price"];
    $product_quantity = $_POST["qty"];
    $product_description = $_POST["des"];
    $product_image = $_FILES["image"]["name"];

    if ($product_image) {

        $old_image_path = "../uploads/" . $originalimg;
        if (file_exists($old_image_path) && !empty($originalimg)) {
            unlink($old_image_path);
        }
        $tmp_location = $_FILES['image']['tmp_name'];
        $new_location = "../uploads/";
        move_uploaded_file($tmp_location, $new_location . $product_image);
        $sql = "UPDATE ads SET img='$product_image', name='$product_name', qty='$product_quantity', price='$product_price', des='$product_description' where id='$product_id'";
    } else {
        $sql = "UPDATE ads SET name='$product_name', qty='$product_quantity', price='$product_price', des='$product_description' where id='$product_id'";
    }

    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo "<script>alert('Ads update successfully'); window.location.href='ads.php';</script>";
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
                    $query = "SELECT * FROM ads where id='$product_id'";
                    $productresult = mysqli_query($connection, $query);
                    while ($productrow = mysqli_fetch_array($productresult)) { ?>
                    <tr>
                        <td><input type="text" name="name" value="<?php echo $productrow['name'] ?>"></td>
                        <td><input type="text" name="price" value="<?php echo $productrow['price'] ?>"></td>
                        <td><input type="text" name="qty" value="<?php echo $productrow['qty'] ?>"></td>                        
                        <td><textarea name="des"><?php echo $productrow['des'] ?></textarea></td>
                        <td>
                            <img src="../uploads/<?php echo $productrow['img'] ?>" width="50px" alt="">
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
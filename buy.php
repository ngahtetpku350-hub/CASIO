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

$userquery = "SELECT * from user where useremail = '$useremail'";
$userresult = mysqli_query($connection, $userquery);

if (mysqli_num_rows($userresult) > 0) {
    $user = mysqli_fetch_array($userresult);
    $userid = $user["userid"];
}

if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    $query = "SELECT * from product where productid = '$product_id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "DATABASE ERROR";
    }
}



if (isset($_POST["btnorder"])) {
    $cusname = $_POST["name"];
    $product_id = $_POST["product_id"];
    // $productname = $_POST["productname"];
    $cusemail = $_POST["email"];
    $qty = $_POST["quantity"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $note = $_POST["note"];

    $query = "SELECT * from product where productid = '$product_id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_array($result);
        $product_name = $row["name"];
        $product_price = $row["price"];
        $product_qty = $row["qty"];
    } else {
        echo "DATABASE ERROR";
    }

    $total_price = $product_price * $qty;

    $orderquery = "INSERT into orders (name,unitprice,qty,totalprice,cusname,useremail,phone,address,note) 
                    VALUES ('$product_name','$product_price','$qty','$total_price','$cusname','$cusemail','$phone','$address','$note')";

    $orderresult = mysqli_query($connection, $orderquery);
    if (!$orderresult) {
        echo "<script>alert('Fail makign Your Order'); window.location='buy.php';</script>";
     }

    $product_qty_update ="UPDATE product set qty = qty - $qty where productid = '$product_id'";
    $product_qty_update = mysqli_query($connection, $product_qty_update);

    echo"<script>alert('Order place successfully'); window.location='shop.php';</script>";
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Page</title>
</head>
<style>
.buyform {
    display: flex;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: white;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background: #F5F5F5;
}
.buy_section{
    border: 2px solid black;
    width: 60%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 30px;
    border-radius: 5px 50px 5px 50px;
    background: white;
}
.product_img img{
    width: 100%;
    max-width: 200px;
    height: auto;
}
.product_img_form{
    display: flex;
}
.product_info{
    display: flex;
    flex-direction: column;
    align-items: center;
    /* background: yellow; */
    justify-content: center;
    gap: 20px;
}
.product_input{
    background: transparent;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 13px;
    width: 90%;
    border: 1px solid black;
}
.product_input .inputbox input{
    padding: 8px;
    border-radius: 8px;
    width: 80%;
    
}
.inputbox{
    width: 80%;
    /* background: green; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.buy-form-box{
    width: 100%;
   margin: auto;
   display: flex;
   align-items: center;
   justify-content: center;
}
.btnorder{
    font-size: 18px;
    font-weight: bold;
}
.btnorder:hover {
    background: blue;
    cursor: pointer;
    color: white;
    font-size: 18px;
    font-weight: bold;
}
</style>
<body class="buyform">
    <form class="buy-form-box" action="buy.php" method="post">
        <div class="buy_section">
            
                <div class="product_img_form">
                    <div>
                        <input type="hidden" name="product_id" value="<?php echo $row['productid'] ?>">
                    </div>

                    <div class="product_img">
                        <img name="image" src="uploads/<?php echo $row['productimg'] ?>">
                    </div>
                    <div class="product_info">
                        <div>
                            <label><?php echo $row['name'] ?></label>
                        </div>

                        <div>
                            <label class="productQty" for="qty">
                                Available Quantity: <?php echo $row['qty']; ?>
                                <?php if ($row['qty'] == 0): ?>
                                    <p class='alert-alert-error'>Product is out of stock.</p>
                                <?php endif; ?>
                            </label>
                        </div>
                        <div>
                            <label for="quantity">Quantity:</label>
                            <input class="quantity-input" type="number" id="quantity" name="quantity" value="1" min="1"
                                max="<?php echo $new_qty = $row['qty']; ?>" <?php echo ($row['qty'] == 0) ? 'disabled' : 'required'; ?>>
                        </div>
                    </div>
                    
                </div>
                <div class="product_input">
                    <div>
                            <h2 name="price"><?php echo $row['price'] ?> Ks</h2>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="name" value="<?php echo $user['username'] ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <input type="show" name="email" value="<?php echo $user['useremail'] ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="address" placeholder="Enter detail your address" required>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="note" placeholder="Delivery note">
                    </div>
                    <div class="inputbox" style="margin-bottom:10px;">
                        <input class="btnorder" type="submit" name="btnorder" value="Make Order">
                    </div>
                </div>
            
        </div>
    </form>
</body>

</html>
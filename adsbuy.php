<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
include("connection.php");
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
else{
    $useremail = $_SESSION["email"];
}

$userquery = "SELECT * from user where useremail = '$useremail'";
$userresult = mysqli_query($connection, $userquery);
if(!$userresult){
    echo"<script>alert('Database connection error'); window.location='index.php';</script>";
} else{
    $userrow = mysqli_fetch_array($userresult);
}

if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    $query = "SELECT * from ads where id = '$product_id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $adsrow = mysqli_fetch_array($result);
    } else {
        echo "DATABASE ERROR";
    }
}

if (isset($_POST["btnorder"])) {
    $product_id = $_POST["product_id"];
    $cusname = $_POST["name"];
    $cusemail = $_POST["email"];
    $qty = $_POST["quantity"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $note = $_POST["note"];

    $query = "SELECT * from ads where id = '$product_id'";
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
        echo "<script>alert('Fail making Your Order'); window.location='buy.php';</script>";
    }

    $product_qty_update = "UPDATE ads set qty = qty - $qty where id = '$product_id'";
    $product_qty_update = mysqli_query($connection, $product_qty_update);

    echo "<script>alert('Order place successfully'); window.location='shop.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Page - <?php echo $adsrow['name']; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .buy-form-box {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .buy_section {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }

        .buy_section:hover {
            transform: translateY(-5px);
        }

        .product_img_form {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .product_img img {
            width: 100%;
            max-width: 200px;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            border: 3px solid white;
        }

        .product_info {
            color: white;
            text-align: center;
        }

        .product_info div:first-child label {
            font-size: 1.8rem;
            font-weight: bold;
            display: block;
            margin-bottom: 1rem;
        }

        .productQty {
            font-size: 1rem;
            margin: 0.5rem 0;
            display: block;
        }

        .alert-alert-error {
            color: #ff6b6b;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem;
            border-radius: 10px;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }

        .quantity-input {
            padding: 0.5rem;
            border-radius: 10px;
            border: none;
            width: 80px;
            text-align: center;
            font-size: 1rem;
            margin-left: 0.5rem;
        }

        .quantity-input:focus {
            outline: none;
            box-shadow: 0 0 5px white;
        }

        .quantity-input:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .product_info div:last-child h2 {
            font-size: 1.5rem;
            margin-top: 1rem;
            color: #ffd700;
        }

        .product_input {
            padding: 2rem;
            background: white;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .inputbox {
            width: 100%;
        }

        .inputbox input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
        }

        .inputbox input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102,126,234,0.3);
        }

        .inputbox input[readonly] {
            background: #f5f5f5;
            cursor: default;
            color: #333;
        }

        .inputbox input[readonly]:focus {
            border-color: #e0e0e0;
            box-shadow: none;
        }

        .btnorder {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btnorder:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }

        .btnorder:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .product_img_form {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
            }
            
            .product_info div:first-child label {
                font-size: 1.4rem;
            }
            
            .product_input {
                padding: 1.5rem;
                gap: 1rem;
            }
            
            .inputbox input {
                padding: 10px 12px;
                font-size: 0.9rem;
            }
            
            .btnorder {
                padding: 12px;
                font-size: 1rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <form class="buy-form-box" action="adsbuy.php?product_id=<?php echo $product_id; ?>" method="post">
        <div class="buy_section">
            <div class="product_img_form">
                <div>
                    <input type="hidden" name="product_id" value="<?php echo $adsrow['id']; ?>">
                </div>
                <div class="product_img">
                    <img name="image" src="uploads/<?php echo $adsrow['img']; ?>" alt="<?php echo $adsrow['name']; ?>">
                </div>
                <div class="product_info">
                    <div>
                        <label><?php echo $adsrow['name']; ?></label>
                    </div>
                    <div>
                        <label class="productQty">
                            Available Quantity: <?php echo $adsrow['qty']; ?>
                            <?php if ($adsrow['qty'] == 0): ?>
                                <p class='alert-alert-error'>⚠ Product is out of stock.</p>
                            <?php endif; ?>
                        </label>
                    </div>
                    <div>
                        <label for="quantity">Quantity:</label>
                        <input class="quantity-input" type="number" id="quantity" name="quantity" value="1" min="1"
                            max="<?php echo $adsrow['qty']; ?>" <?php echo ($adsrow['qty'] == 0) ? 'disabled' : 'required'; ?>>
                    </div>
                    <div>
                        <h2><?php echo number_format($adsrow['price']); ?> Ks</h2>
                    </div>
                </div>
            </div>
            <div class="product_input">
                <div class="inputbox">
                    <input type="text" name="name" value="<?php echo $userrow['username']; ?>" readonly>
                </div>
                <div class="inputbox">
                    <input type="email" name="email" value="<?php echo $userrow['useremail']; ?>" readonly>
                </div>
                <div class="inputbox">
                    <input type="text" name="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="inputbox">
                    <input type="text" name="address" placeholder="Enter your full address" required>
                </div>
                <div class="inputbox">
                    <input type="text" name="note" placeholder="Delivery note (optional)">
                </div>
                <div class="inputbox">
                    <input class="btnorder" type="submit" name="btnorder" value="🛒 Make Order">
                </div>
            </div>
        </div>
    </form>
</body>

</html>
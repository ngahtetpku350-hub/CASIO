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

$query = "SELECT * from user where useremail = '$useremail'";
$result = mysqli_query($connection, $query);

if(!$result) {
    echo"<script>alert('Please Login First'); window.location='login.php';</script>";
}

$orderquery = "SELECT * from orders where useremail ='$useremail' ORDER BY orderid DESC";
$orderresult = mysqli_query($connection, $orderquery);
 include("nav.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #F5F5F7;
            min-height: 100vh;
            padding: 2rem;
        }


        body > h1 {
            background: white;
            display: inline-block;
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 1.2rem;
            color: #667eea;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            width: auto;
        }


        section {
            text-align: center;
            margin-bottom: 2rem;
        }

        section h1 a {
            display: inline-block;
            background: white;
            color:black;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        section h1 a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .orders-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }


        .order-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }


        .order-header {
            background: black;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .order-header h3 {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .order-date {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        
        .order-body {
            padding: 1.2rem;
        }

        .order-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }

        .order-info:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            font-size: 0.9rem;
        }

        .info-value {
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .total-price {
            background: #f0f0f0;
            padding: 8px 12px;
            border-radius: 10px;
            margin-top: 10px;
            text-align: center;
        }

        .total-price .info-value {
            color: #e74c3c;
            font-size: 1.2rem;
            font-weight: bold;
        }


        .no-orders {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            max-width: 500px;
            margin: 2rem auto;
        }

        .no-orders p {
            color: #999;
            font-size: 1.1rem;
        }

        .no-orders a {
            display: inline-block;
            margin-top: 1rem;
            background:black;
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 50px;
            transition: background 0.3s;
        }

        .no-orders a:hover {
            background: #5a67d8;
        }
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            body > h1 {
                font-size: 1rem;
                padding: 8px 20px;
                display: block;
                text-align: center;
            }

            section h1 a {
                padding: 10px 20px;
                font-size: 1rem;
            }

            .orders-container {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .order-header h3 {
                font-size: 1rem;
            }

            .info-label,
            .info-value {
                font-size: 0.85rem;
            }

            .total-price .info-value {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .order-body {
                padding: 1rem;
            }

            .order-info {
                flex-direction: column;
                gap: 5px;
            }

            .info-label {
                font-size: 0.8rem;
            }

            .info-value {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <h1 style="margin-top:30px;">Welcome, <?php echo htmlspecialchars($useremail); ?> 👋</h1>

    <section>
        <h1>
            <a href="orderhistory.php">📋 View Your Order History</a>
        </h1>
    </section>

    <div class="orders-container">
        <?php if (mysqli_num_rows($orderresult) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($orderresult)) { ?>
                <div class="order-card">
                    <div class="order-header">
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                        <div class="order-date">📅 <?php echo htmlspecialchars($row['time']); ?></div>
                    </div>
                    <div class="order-body">
                        <div class="order-info">
                            <span class="info-label">Customer Name:</span>
                            <span class="info-value"><?php echo htmlspecialchars($row['cusname']); ?></span>
                        </div>
                        <div class="order-info">
                            <span class="info-label">Quantity:</span>
                            <span class="info-value"><?php echo htmlspecialchars($row['qty']); ?> pcs</span>
                        </div>
                        <div class="order-info">
                            <span class="info-label">Unit Price:</span>
                            <span class="info-value"><?php echo number_format($row['unitprice']); ?> Ks</span>
                        </div>
                        <div class="total-price">
                            <span class="info-label">Total Price:</span>
                            <span class="info-value"><?php echo number_format($row['totalprice']); ?> Ks</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php else: ?>
            <div class="no-orders">
                <p>🛒 You haven't placed any orders yet.</p>
                <a href="shop.php">Start Shopping →</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
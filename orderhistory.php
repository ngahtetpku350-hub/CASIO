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

$query = "SELECT * From orders where useremail = '$useremail' ORDER BY orderid DESC";
$result = mysqli_query($connection, $query);
$ordercount = mysqli_num_rows($result);
if (!$result) {
    echo "<script>alert('Database connection error'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .order-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .order-count span {
            font-size: 1.5rem;
            font-weight: bold;
        }


        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.3s;
            font-size: 14px;
        }

        .back-btn:hover {
            background: #1a252f;
        }

        .table-container {
            overflow-x: auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 1rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table thead th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
        }

        .table thead th:first-child {
            border-top-left-radius: 10px;
        }

        .table thead th:last-child {
            border-top-right-radius: 10px;
        }

        .table tbody tr {
            border-bottom: 1px solid #e0e0e0;
            transition: background 0.3s;
        }

        .table tbody tr:hover {
            background: #f8f9ff;
        }

        .table tbody td {
            padding: 12px;
            color: #333;
            font-size: 13px;
            white-space: nowrap;
        }

        .table tbody td:nth-child(4) {
            font-weight: bold;
            color: #e74c3c;
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
            margin-bottom: 1rem;
        }

        .no-orders a {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 50px;
            transition: transform 0.3s;
        }

        .no-orders a:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .order-count {
                font-size: 0.9rem;
                padding: 6px 15px;
            }

            .order-count span {
                font-size: 1.2rem;
            }

            .back-btn {
                position: static;
                display: inline-block;
                margin-bottom: 1rem;
            }

            .table-container {
                padding: 0.5rem;
            }

            .table thead th,
            .table tbody td {
                padding: 8px;
                font-size: 11px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .header h1 {
                font-size: 1.2rem;
            }

            .table thead th,
            .table tbody td {
                padding: 6px;
                font-size: 10px;
            }
        }

        ::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #5a67d8;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }
            
            .back-btn,
            .order-count {
                display: none;
            }
            
            .table-container {
                box-shadow: none;
                padding: 0;
            }
            
            .table thead {
                background: #ddd;
                color: black;
            }
        }
    </style>
</head>

<body>
    <a href="account.php" class="back-btn">← Back to Account</a>

    <div class="header">
        <h1>📋 My Order History</h1>
        <div class="order-count">
            📦 Total Orders: <span><?php echo $ordercount; ?></span>
        </div>
    </div>

    <div class="table-container">
        <?php if ($ordercount > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Unit Price (Ks)</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Your Name</th>
                        <th scope="col">Your Email</th>
                        <th scope="col">Your Phone</th>
                        <th scope="col">Your Address</th>
                        <th scope="col">Your Note</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo number_format($row['unitprice']); ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td><?php echo number_format($row['totalprice']); ?> Ks</td>
                            <td><?php echo htmlspecialchars($row['cusname']); ?></td>
                            <td><?php echo htmlspecialchars($row['useremail']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['note']) ?: '-'; ?></td>
                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-orders">
                <p>🛒 You haven't placed any orders yet.</p>
                <a href="shop.php">Start Shopping →</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
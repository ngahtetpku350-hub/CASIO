<?php
include("connection.php");
session_start();

if (!isset($_SESSION["admin_email"])) {
    header("Location: index.php");
    exit();
} else {
    $adminemail = $_SESSION["admin_email"];
}

$query = "SELECT * FROM admin WHERE email = '$adminemail'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Admin query failed: " . mysqli_error($connection));
}
else{

}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $adminname = $row["username"];
} else {
    echo "Admin not found!";
    exit();
}

$userquery = "SELECT * FROM user order by userid desc";
$userresult = mysqli_query($connection, $userquery);

if (!$userresult) {
    die("User query failed: " . mysqli_error($connection));
}

$usercount = mysqli_num_rows($userresult);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="adminstyle.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Admin Home - Watch World</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        nav {
            background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
            width: 90%;
            max-width: 1200px;
            height: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border-radius: 15px;
            padding: 15px 30px;
            margin: 20px auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        nav ul {
            display: flex;
            list-style: none;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        nav ul li a:hover {
            background: rgba(102, 126, 234, 0.3);
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        nav p {
            font-size: 22px;
            font-weight: bold;
            color: #667eea;
        }

        /* Welcome section */
        .welcome-box {
            background: white;
            padding: 20px;
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-box h2 {
            color: #333;
        }

        /* User container */
        .user-container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .user-container h3 {
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        /* User card grid */
        .user-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .user-card {
            background: #f9f9f9;
            border-radius: 10px;
            padding: 15px;
            border-left: 4px solid #667eea;
            transition: transform 0.3s ease;
        }

        .user-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .user-card p {
            margin: 8px 0;
            color: #555;
        }

        .user-card strong {
            color: #333;
        }

        .no-users {
            text-align: center;
            color: #999;
            padding: 40px;
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 15px;
            }
            
            .user-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <nav>
            <p> Admin Dashboard</p>
            <ul>
                <li><a href="adminhome.php"> Home</a></li>
                <li><a href="products.php">Product</a></li>
                <li><a href="contactmessage.php">Contact Message</a></li>
                <li><a href="orderlist.php"> Order List</a></li>
                <li><a href="logout.php"> Logout</a></li>
            </ul>
        </nav>
    </div>

    <div class="welcome-box">
        <h2>Welcome, <?php echo $adminname ?>! 👋</h2>
        <p>You are logged in as: <?php echo $adminemail; ?></p>
        <p>Total registered users: <strong><?php echo $usercount; ?></strong></p>
    </div>

    <div class="user-container">
        <h3> Registered Users List</h3>
        
        <?php if (mysqli_num_rows($userresult) > 0): ?>
            <div class="user-grid">
                <?php while ($userrow = mysqli_fetch_assoc($userresult)): ?>
                    <div class="user-card">
                        <p><strong>ID:</strong> <?php echo htmlspecialchars($userrow['userid']); ?></p>
                        <p><strong>Username:</strong> <?php echo htmlspecialchars($userrow['username']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($userrow['useremail']); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-users">
                <p>No users found in database.</p>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>
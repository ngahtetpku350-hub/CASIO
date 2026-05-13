<?php
session_start();
include("connection.php");

if (isset($_POST["btnlogin"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $query = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $db_email = $row["email"];
        $db_password = $row["password"];
        
        if ($password == $db_password) {
            $_SESSION["admin_email"] = $email;
            header('Location: adminhome.php');
            exit(); 
        } else {
            echo "<script>alert('Password is wrong!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Email is not registered!'); window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyle.css">
    <title>Admin Login Page</title>
    <style>
        .admin-login-form {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-form {
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 20px;
            border: none;
            padding: 40px;
            width: 100%;
            max-width: 350px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .login-form h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-form input[type="submit"] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            cursor: pointer;
            border: none;
            font-weight: bold;
        }

        .login-form input[type="submit"]:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body class="admin-login-form">

    <form action="index.php" method="POST">
        <div class="login-form">
            <h2>Admin Login</h2>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" value="Login" name="btnlogin">
        </div>
    </form>
</body>

</html>
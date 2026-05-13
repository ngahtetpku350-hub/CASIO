<?php

include("connection.php");
session_start();

if (isset($_POST["btnlogin"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user where useremail = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $useremail = $row["useremail"];

        if ($password == $row["password"]) {
            $_SESSION["email"] = $useremail;

            header("location: shop.php");
        } else {
            echo "<script>alert('Incorrect password'); window.location='login.php';</script>";
        }
    }
    else {
        echo "<script>alert('Your email is not registered!!'); window.location='register.php';</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>

<body>
    <section id="body">
        <div class="login-card">

            <div class="login-img">
                <img src="img/login-img.avif" alt="login logo">
            </div>
            <div class="login-input-section">
                <div class="login-title">
                    <h1>Login Here</h1>
                </div>
                <form action="login.php" method="post">
                    <div class="login-input">
                        <input type="email" placeholder="email or phone" name="email">
                        <input type="password" placeholder="Enter your password" name="password">
                        <input type="submit" value="Login" name="btnlogin">
                    </div>
                </form>
                <div id="login-btn">
                    <a href="#">Forget password</a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
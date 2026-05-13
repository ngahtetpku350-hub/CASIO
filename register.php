<?php
include("connection.php");
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $checkquery = "SELECT * from user where useremail = '$email'";
    $checkquery = mysqli_query($connection, $checkquery);


    if (mysqli_num_rows($checkquery) > 0) {
        echo "<script>alert('This email is already registered.'); window.location='register.php';</script>";
    } else {
        $query = "INSERT into user(username, useremail,password) VALUES ('$username','$email','$password')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "<script>alert('Regisytering fail Please try again.'); window.location='register.php';</script>";
        } else {
            echo "<script>alert('Registered!'); window.location='login.php';</script>";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<style>
    .register-body{
        height: 100vh;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
    .register-from{
        display: flex;
        flex-direction: column;
        gap: 30px;
        align-items: center;
        justify-content: center;
        border: 1px solid black;
        border-radius: 5px 30px 5px 30px;
        width: 100%;
        width: 400px;
        padding: 40px;
        margin: 20px;
        background: red;
        
    }
    .register-from input{
        padding: 10px;
        border-radius: 10px;
        border: none;
        border-bottom: 2px solid black;
        width: 90%;
    }
    form {
        width: 100%;
        display: flex;
        justify-content: center;
    }
</style>

<body class="register-body">
    <form action="register.php" method="POST">
        <section class="register-from">
            <h2>Register From</h2>
            <input type="username" placeholder="Username" name="username" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <input class="btn-register" type="submit" name="submit" value="Register" required>
        </section>
    </form>

</body>

</html>
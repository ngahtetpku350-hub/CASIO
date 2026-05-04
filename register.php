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
            echo "Fail";
        } else {
            echo "Register success";
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

<body>
    <form action="register.php" method="POST">
        <section class="register-from">
            <h2>Register From</h2>
            <input type="username" placeholder="Username" name="username">
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Password" name="password">
            <input class="btn-register" type="submit" name="submit" value="Register">
        </section>
    </form>

</body>

</html>
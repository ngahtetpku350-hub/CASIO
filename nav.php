<?php 
include("connection.php");
    // session_start();
if (isset($_SESSION["email"])) {

    $useremail = $_SESSION["email"];

    $query = "SELECT * FROM user where useremail ='$useremail'";
    $userresult = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($userresult);
        $email = $row["useremail"];
        $username = $row["username"];
    }


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Nav</title>
</head>

<style>
    header{
        margin-top: 20px;
        display: flex;
        justify-content: space-evenly;
        background: red;
        height: 60px;
        align-items: center;
        border-radius: 5px 30px 5px 30px;
    }
    header ul li a{
        text-decoration: none;
        color: white;
    }
    header ul{
        list-style-type: none;
        display: flex;
        gap: 50px;
    }
    .group-btn{
        padding: 18px;
    }
    .group-btn a{
        gap: 30px;
    }
    .logoutbtn{
        background: black;
        color: white;
        padding: 5px;
        width: 100px;
        margin-left: 30px;
        border-radius: 20px;
    }
     .loginbtn, .signupbtn{
        background:white;
        color: black;
        padding: 8px;
        width: 100px;
        margin-left: 30px;
        border-radius: 20px;
        cursor: pointer;
    }
    .loginbtn:hover, .signupbtn:hover{
        color: white;
        background: blue;
    }
    .logo{
        color: black;
        text-decoration: none;
    }
</style>

<body>
    <header>
        <div>
            <a class="logo" href="index.php">
                <h2>CASIO</h2>
            </a>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>


        <div class="group-btn">
            <?php
            if (!isset($_SESSION["email"])) {
                echo '<a href="login.php"><button class="loginbtn" type="button">Login</button></a>';
                echo '<a href="register.php"><button class="signupbtn" type="button">Sign-up</button></a>';
            } else {
                echo '<div>';
                echo '<a href="account.php">' . htmlspecialchars($username) . '</a>';

                echo '<a href="logout.php"><button class="logoutbtn" type="button">Logout</button></a>';
                echo '</div>';
            }
            ?>

        </div>
    </header>
</body>

</html>
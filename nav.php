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

    /* ========== RESPONSIVE DESIGN ADDED BELOW ========== */
    
    @media (max-width: 992px) {
        header {
            justify-content: space-between;
            padding: 0 20px;
            gap: 20px;
        }
        
        header ul {
            gap: 25px;
        }
        
        .group-btn {
            padding: 10px;
        }
        
        .logoutbtn, .loginbtn, .signupbtn {
            width: 80px;
            margin-left: 10px;
            padding: 5px;
            font-size: 12px;
        }
    }
    

    @media (max-width: 768px) {
        header {
            flex-direction: column;
            height: auto;
            padding: 15px;
            gap: 15px;
            border-radius: 5px 20px 5px 20px;
        }
        
        .logo h2 {
            font-size: 1.5rem;
        }
        
        header ul {
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        header ul li a {
            font-size: 14px;
        }
        
        .group-btn {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .logoutbtn, .loginbtn, .signupbtn {
            width: 90px;
            margin-left: 0;
            padding: 6px 10px;
            font-size: 13px;
        }
        
        .group-btn a {
            gap: 15px;
        }
        
        .group-btn div {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .group-btn div a:first-child {
            color: white;
            text-decoration: none;
            background: rgba(255,255,255,0.2);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
        }
    }
    

    @media (max-width: 480px) {
        header {
            padding: 12px;
            gap: 12px;
        }
        
        .logo h2 {
            font-size: 1.2rem;
        }
        
        header ul {
            gap: 12px;
        }
        
        header ul li a {
            font-size: 12px;
        }
        
        .logoutbtn, .loginbtn, .signupbtn {
            width: 75px;
            padding: 5px 8px;
            font-size: 11px;
        }
        
        .group-btn div a:first-child {
            font-size: 12px;
            padding: 4px 10px;
        }
    }
    

    @media (max-width: 768px) and (orientation: landscape) {
        header {
            flex-direction: row;
            flex-wrap: wrap;
            height: auto;
            padding: 10px 20px;
        }
        
        .group-btn {
            margin-left: auto;
        }
    }
    

    @media (min-width: 1200px) {
        header {
            max-width: 1400px;
            margin: 20px auto 0 auto;
        }
    }
    
    @media (hover: none) and (pointer: coarse) {
        .loginbtn:hover, .signupbtn:hover {
            background: white;
            color: black;
        }
        
        .loginbtn:active, .signupbtn:active {
            background: blue;
            color: white;
        }
        
        header ul li a:active {
            opacity: 0.7;
        }
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
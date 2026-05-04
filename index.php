<?php

include("connection.php");
session_start();
if (isset($_SESSION["email"])) {

    $useremail = $_SESSION["email"];

    $query = "SELECT * FROM user where useremail ='$useremail'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Home Page</title>
</head>

<body>
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom ">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="index.php" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="shop.php" class="nav-link px-2">Shop</a></li>
            <li><a href="about.php" class="nav-link px-2">About</a></li>
            <li><a href="contact.php" class="nav-link px-2">Contact</a></li>
        </ul>

        <style>
            .flexbox{
                display: flex;
            }
            .username {
                text-align: center;
            }
        </style>

        <div class="col-md-3 text-end" style="text-align: cneter';">
            <?php
            if (!isset($_SESSION["email"])) {
                echo '<a href="login.php"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>';
                echo '<a href="register.php"><button type="button" class="btn btn-primary">Sign-up</button></a>';
            } else {
                echo '<div class="flexbox">';
                echo '<h5 class="username" style = "text-align: center;">' . htmlspecialchars($username) . '</h5>';
                echo '<a href="logout.php"><button type="button" class="btn btn-outline-danger ms-2">Logout</button></a>';
                echo '</div>';
            }
            ?>

        </div>
    </header>

    <!-- body -->
    <div class="ads-card">
        <div class="ads">

        </div>

    </div>

    <!-- footer -->
    <footer>
        <div class="contact">
            <div class="desc">
                <h1>Watch World</h1>
                <p>Enjoy your life with our watch</p>
            </div>
            <div class="phone">
                <h1>+959764931148</h1>
                <p>Email: ngahtetpku350@gmail.com</p>
            </div>
        </div>

        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem fugiat tempora doloremque atque rem
                    totam neque beatae dolorum delectus in?</p>
            </div>
            <div class="footer-section">
                <h3>Open Hours</h3>
                <ul>
                    <li>Monday - Friday: 9:00 AM - 8:00 PM</li>
                    <li>Saturday: 10:00 AM - 6:00 PM</li>
                    <li>Sunday: Closed</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Address</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> No.123, Yangon, Myanmar</li>
                    <li><i class="fas fa-phone"></i> +959764931148</li>
                    <li><i class="fas fa-envelope"></i> ngahtetpku350@gmail.com</li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="copy">
            <div class="copyright">© 2026 Watch World Myanmar. All rights reserved.</div>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
</body>

</html>
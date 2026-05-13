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
$adsquery = "SELECT * from ads order by id desc";
$adsresult = mysqli_query($connection, $adsquery);

if (!$adsresult) {
    echo "<script>alert('DATABASE ERROR.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Home Page</title>
</head>

<body>
     <?php include("nav.php") ?>
     <br><br><br>
    <!-- body -->
    <?php while ($adsrow = mysqli_fetch_assoc($adsresult)) { ?>
        <div class="faterads-box">
            <div class="ads ads1">
                <div>
                    <h2><?php echo $adsrow['name'] ?></h2>
                    <p>
                        <?php echo $adsrow['des'] ?>
                    </p>
                </div>
                <div>
                    <a class="btnbuy" href="adsbuy.php?product_id=<?php echo $adsrow['id'] ?>">Buy Now</a>
                </div>
                <div>
                    <img src="uploads/<?php echo $adsrow['img'] ?>" alt="ads">
                </div>
            </div>
        </div>
    <?php } ?>

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
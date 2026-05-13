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

    $query = "SELECT * From user where useremail = '$useremail'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $useremail = $row["useremail"];
        $username = $row["username"];
    }
}

$query = "SELECT * from product";
$result = mysqli_query($connection, $query);
if (!$result) {
    echo "<script>alert('DATABASE ERROR.');</script>";
    // $row = mysqli_fetch_array($result);
    // $productname = $row['name'];
    // $productprice = $row['price'];
    // $productdesc = $row['des'];
    // $productqty = $row['qty'];
    // $productimg = $row['productimg'];
}

$adsquery = "SELECT * from ads order by id limit 2";
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Shop</title>
</head>

<body>
   <div>
      <?php include("nav.php") ?>
   </div>
     <br><br><br>
    <!-- main body -->
    <div class="slidebox">
        <div> <swiper-container class="mySwiper" space-between="30" pagination="true" pagination-clickable="true">
                <swiper-slide><img src="img/g-shock.avif" alt=""></swiper-slide>
                <swiper-slide><img src="img/g-shock2.avif" alt=""></swiper-slide>
                <swiper-slide><img src="img/g-shock3.avif" alt=""></swiper-slide>
            </swiper-container>
        </div>
    </div>
    <div>
        <h1 style="text-align: center; margin-top:30px ;">Our New Product for you</h1>
    </div>
    <section class="slider-box">
        <div class="carousel">
            <div class="group">
                <div class="card"><img src="img/g2.avif" alt=""></div>
                <div class="card"><img src="img/g2.avif" alt=""></div>
                <div class="card"><img src="img/g3.avif" alt=""></div>
                <div class="card"><img src="img/g4.avif" alt=""></div>
                <div class="card"><img src="img/g5.avif" alt=""></div>
                <div class="card"><img src="img/g6.avif" alt=""></div>
                <div class="card"><img src="img/g7.avif" alt=""></div>
            </div>
            <div aria-hidden class="group">
                <div class="card"><img src="img/g2.avif" alt=""></div>
                <div class="card"><img src="img/g3.avif" alt=""></div>
                <div class="card"><img src="img/g4.avif" alt=""></div>
                <div class="card"><img src="img/g5.avif" alt=""></div>
                <div class="card"><img src="img/g6.avif" alt=""></div>
                <div class="card"><img src="img/g7.avif" alt=""></div>
            </div>
        </div>
    </section>
    <br><br><br>
    <div>
        <h1 style="text-align: center;">Our Product list</h1>
    </div>
    <section class="main_box">
        <?php while ($row = mysqli_fetch_assoc($result)) {
            $qty = $row['qty'];

            
            if ($qty == 0) {
                $stock = "Out of stock";
            } elseif ($qty == 1) {
                $stock = "Lest Product";
            } elseif ($qty > 1) {
                $stock = "Buy Now";
            } else {
                $stock = "Avaiable";
            }
            ?>
            <div class="box">
                <div class="img">
                    <img src="uploads/<?php echo $row['productimg']; ?>">
                </div>
                <div>
                    <p style="font-size:20px; font-weight: bold; color: black; margin-top: 20px;">
                        <?php echo $row['price'] ?>Ks
                    </p>
                </div>
                <div class="product-info">
                    <div class="model">
                        <?php echo $row['name'] ?>
                    </div>
                    <div class="data" style="margin-top: 20px;">
                        <div>
                            <p>Stock:     <?php echo $row['qty'] ?> </p>
                        </div>
                        <div class="des">
                            <p><?php echo $row['des'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="buy-btn">
                    <?php if ($qty > 0) { ?>
                        <a href="buy.php?product_id=<?php echo $row['productid'] ?>">
                            <?php echo $stock ?>
                        </a>
                    <?php } else { ?>
                        <label style="color:red;" for=""> <?php echo $stock ?></label>
                    <?php } ?>
                </div>
            </div>
            </div>
        <?php } ?>
    </section>
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
                    <a href="https://www.facebook.com/CASIO-Calculators-Global-155268021727400/"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/user/CasioGshockOfficial"><i class="fab fa-youtube"></i></a>
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
    <script>
        AOS.init();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-element-bundle.min.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>


</body>

</html>
<?php include("connection.php");
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


} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<title>About Casio</title>
</head>

<body>
    <style>
        @media (max-width: 480px) {

            .person-card h3,
            p {
                font-size: 11px;
            }
        }
    </style>
    <?php include("nav.php"); ?>
    <br><br>

    <section class="about-person">
        <div>
            <h2 style="font-size: 40px;">Our Leater</h2>
        </div>
        <div class="person-box">
            <div class="person-card">
                <a href="chairman.html"><img src="img/leter1.jpeg" alt="Chariman img"></a>
                <h3>Message from the Chairman</h3>
                <p>Creating New Value Through Transformation and Innovation</p>
            </div>
            <div class="person-card">
                <a href="ceo.html"><img src="img/leter2.jpeg" alt="CEO img"></a>
                <br>
                <h3>Message from the President</h3>
                <p>Maximizing Corporate Value and Sustainable Growth</p>
            </div>
        </div>
    </section>
    <section class="company-profile">
        <h2>Company Profile</h2>
        <div class="profile-card">
            <div class="int-profile-card">
                <div>
                    <h2>Company Name</h2>
                </div>
                <div>
                    <p>CASIO COMPUTER CO., LTD.</p>
                </div>
            </div>
            <div class="int-profile-card">
                <div>
                    <h2>Headquarters</h2>
                </div>
                <div>
                    <p>6-2, Hon-machi 1-chome, Shibuya-ku, Tokyo</p>
                </div>
            </div>
            <div class="int-profile-card">
                <div>
                    <h2>Established</h2>
                </div>
                <div>
                    <p>June 1, 1957</p>
                </div>
            </div>
            <div class="int-profile-card">
                <div>
                    <h2>Paid-in Capital*</h2>
                </div>
                <div>
                    <p>48,592 million Yen</p>
                </div>
            </div>
            <div class="int-profile-card">
                <div>
                    <h2>Net Sales*</h2>
                </div>
                <div>
                    <p>261,757 million Yen
                        Number of Employees*
                    </p>
                </div>
            </div>
            <div class="int-profile-card">
                <div>
                    <h2>Number of Employees*</h2>

                </div>
                <div>
                    <p>8,801</p>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>


    <section class="casio-history">
        <h2 class="casio-history-title">Histoer and Development</h2>
        <div class="company-history-img">
            <img src="img/4brother.jpeg" alt="">
            <div class="over-text">
                <a href=https://world.casio.com/corporate/brothers>
                    <h1 style="text-align: center;"> 4 Brother History</h1>
                </a>
            </div>
        </div>
        <div class="company-history-img">
            <img src="img/company-img10.jpeg" alt="">
            <div>
                <a href="https://world.casio.com/corporate/history/">
                    <h1 style="text-align: center;">CASIO History</h1>
                </a>
            </div>
        </div>
        <div class="company-history-img">
            <img src="img/product-history.jpeg" alt="">
            <div>
                <a href="https://world.casio.com/corporate/history/chronology/">
                    <h1 style="text-align: center;">Product History</h1>
                </a>
            </div>
        </div>
    </section>
    <style>
        .casio-social-media {
            width: auto;
            margin-top: 40px;
            background: #F5F5F5;
        }

        .casio-social-media h2 {
            font-size: 40px;
            text-align: center;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .casio-social-media img {
            width: 90%;
            max-width: 90%;
            display: flex;
            justify-content: center;
            margin: auto;
        }

        @media (max-width: 480px) {
            .casio-social-media h2 {
                font-size: 20px;
            }
        }
    </style>
    <section class="casio-social-media">
        <h2>Our Social Media</h2>
        <div>
            <a href="https://www.casio-intl.com/asia/en/socialmedia/"><img src="img/youtube.jpg" alt="social media"></a>
        </div>
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
</body>

</html>
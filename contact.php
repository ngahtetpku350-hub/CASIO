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



if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql = "INSERT INTO contact(useremail, message) VALUES('$email','$message')";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        echo "Error is {$connection->error}";
    } else {
        echo "Send Message.";
        move_uploaded_file($tem_location, $final_location);
    }
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
    <title>Contact Page</title>
</head>

<body>
    <?php include("nav.php"); ?>
    <br><br>

    <section class="main-contact">
        <div class="whoiam">
            <div class="infoletter">
                <div class="developer-letter">
                    <h3 style="color: aqua;margin-bottom:10px;">I am junlar webdeveloper</h3>
                    <h1 style="color: gold;">Hello I'm,</h1>
                    <h1 style="margin-bottom: 10px;">Thue Htet Naing</h1>
                    <p style="color: white; margin-bottom: 10px;">Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Nisi ea ratione explicabo obcaecati officiis nulla corrupti, nemo reiciendis doloremque
                        fugiat dignissimos dolorum magni reprehenderit, minus nam quisquam magnam ullam vitae.</p>
                    <div class="btn btncontact">
                        <button style="background-color:rgba(32, 183, 15, 0.544);color: white;">View my work</button>
                        <button>Contact</button>
                    </div>
                </div>
            </div>
            <div class="developerImg">
                <img src="img/developer.jpeg" alt="">
            </div>
        </div>

        <div class="developer-introduction">
            <div class="developer-face-img">
                <img src="" alt="">
            </div>
            <div>
                <h1 style="color:red ; margin-bottom: 10px;">Thue Htet Naing</h1>
                <h3 style="color: aqua;">Junlor WebDeveloper</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem culpa incidunt quo soluta? Maxime
                    molestiae, eligendi quis obcaecati excepturi itaque assumenda iste praesentium suscipit at a maiores
                    qui saepe dolorem.</p>
            </div>
        </div>

        <div class="ageandexp">
            <div class="info-box">
                <div class="age-box">
                    <h3 style="color:yellow ;">Age</h3>
                    <p>20+</p>
                </div>
                <div class="exp">
                    <h3 style="color: red;">Experiences</h3>
                    <p>Completed 3more web site development</p>
                </div>
                <div class="current-work">
                    <h3 style="color:green ;">Work</h3>
                    <p>student</p>
                </div>
            </div>
            <div class="about">
                <p style="color: yellow; font-size: 50px; margin-bottom: 20px;">About me!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit maxime laborum quidem eaque labore fuga
                    quo soluta esse, aspernatur excepturi ducimus reiciendis corrupti eos molestiae obcaecati fugiat
                    commodi quasi, porro maiores iste asperiores illo. Qui expedita modi non repellendus architecto
                    deleniti dicta vitae dignissimos facere sapiente tempore, incidunt magni voluptatibus fuga dolorem
                    error, porro, vel veniam odio? Fugit vitae asperiores ad perspiciatis, voluptas eius error, id
                    beatae pariatur molestias sed repellat, ratione maxime neque nostrum dolore autem esse ab in
                    laboriosam quas ipsam. Illum quisquam facilis voluptatem explicabo. Ab molestias quas nisi officia
                    et voluptatum perspiciatis deserunt! Recusandae soluta unde inventore ab cupiditate aliquam
                    excepturi. Dolore veniam eos at, dolor maxime illo. Reprehenderit eum, laborum nam ducimus
                    architecto officiis distinctio vero dolore praesentium. Error, doloribus debitis esse repudiandae
                    tempora ipsum aut rem molestias incidunt eligendi vel eos amet eveniet reprehenderit, nemo, tempore
                    quam impedit libero quia odio. Dolor dicta ea consequatur earum expedita veniam nulla, hic odio
                    minima deleniti, animi quae iusto. Commodi aperiam illum excepturi consequuntur officiis
                    perspiciatis dolor voluptate, maxime consequatur aliquid debitis eum corrupti tempore vel id. Eos
                    consectetur officiis vitae atque nostrum aliquid incidunt, aperiam animi magni porro dolores nulla
                    hic a perferendis voluptatibus ex reprehenderit.</p>
            </div>
        </div>

        <div class="myskill">
            <div class="skill-box">
                <h1>My Skills</h1>
                <div class="python">
                    <h3>Python</h3>
                    <p>Learnning and progress+++</p>
                </div>

                <div class="php">
                    <h3>Php</h3>
                    <p>Progress+++</p>
                </div>

                <div class="c-shart">
                    <h3>C#</h3>
                    <p>Learnning+++</p>
                </div>

                <div class="html-css">
                    <h3>Html CSS</h3>
                    <p>Progress+++</p>
                </div>

                <div class="mysqli">
                    <h3>MySQLi</h3>
                    <p>Learnning and progress+++</p>
                </div>

                <div class="kotlin">
                    <h3>Kotlin</h3>
                    <p>Learnning and progress++</p>
                </div>

            </div>
        </div>
        <form action="contact.php" method="POST" enctype="multipart/form-data">
            <div class="contact-me">
                <h1>Send message to me!</h1>
                <input class="message-input" type="text" placeholder="Message here" required name="message">
                <input type="email" placeholder="Your email" required name="email">
                <input type="submit" class="btnsend" value="Send" name="submit">
            </div>
        </form>
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
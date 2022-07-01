<?php 
session_start();

if (!isset($_SESSION["user_full_name"])) {
    header("Location: index.php");
}

echo $_SESSION["user_full_name"];


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="welcome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <title>Welcome</title>
    </head>
    <body>
        <section>
            <header>
                <h2> <a href="#" class="logo">Plant Sitting</a></h2>
                <div class="navigation">
                    <a href="welcome.php">Home</a>
                    <a href="about.php">About</a>
                    <a href="contact.php">Contact</a>
                    <a href="shoppingcart.php">Shopping</a>
                    <a href="logout.php">LogOut</a>
                </div>
            </header>
            <div class="content">
                <div class="info">
                    <h2>Imam biljke<br><span>Kome da ih ostavim?</span></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                        laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <a href="#" class="info-btn">Vise informacija</a>
                </div>
            </div>
            <div class="media-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </section>
    </body>
    <footer>
        <div class="footer_content">
            <h3>Plant Sitting</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
        <div class="footer_bottom">
            <p>copyright &copy;2022 PlantSitting. designed by <span>Stevan Zakula</span></p>
        </div>
    </footer>
</html>
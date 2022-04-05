<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <?php
        include 'connect.php';
        session_start();
    ?>
    <header id="top-navigation" class="navigation">
        <form action="index.php" method="post">
            <ul>
                <li id="menu"><img class="icon" src="img/icon/bars-solid.svg"></li>
                <li id="title"><img id="logo" src="img/logo.PNG"><a href="#">zaldrec shoe store</a></li>
                <li id="search"><input type="search" style="width: 35em; height: 100%; padding-left: 1em;" placeholder="Search" name="search"><button style="height: 100%; width: 5em;" name="submit"><img class="icon" src="img/icon/magnifying-glass-solid.svg"></button></li>
                <?php
                    if(isset($_SESSION['username'])){
                        echo "<li id='sell'><a href='sell.php'>sell</a></li>";
                    }else{
                        echo "<li id='register'><a href='login.php'>Login</a>/<a href='signup.php'>Sign-up</a></li>";
                    }
                ?>
                <li id="home"><a href="index.php">Home</a></li>
            </ul>
        </form>  
    </header>
    <aside id="side-navigation" class="navigation">
        <ul>
            <?php
                if(isset($_SESSION['username'])){
                    echo "<li><img class='icon' src='img/icon/user-solid.svg'><a href='#'>account</a></li>";
                    echo "<li><img class='icon' src='img/icon/bag-shopping-solid.svg'><a href='#'>purchase history</a></li>";
                }
            ?> 
            <li><img class="icon" src="img/icon/hand-holding-solid.svg"><a href="#">services</a></li>
            <li><img class="icon" src="img/icon/circle-info-solid.svg"><a href="about.php">about</a></li>
            <li><img class="icon" src="img/icon/phone-solid.svg"><a href="contact.php">contact</a></li>
            <li><img class="icon" src="img/icon/gear-solid.svg"><a href="#">settings</a></li>
            <?php
                if(isset($_SESSION['username'])){
                    echo "<li><img class='icon' src='img/icon/logout_black_24dp.svg'><a href='logout.php'>logout</a></li>";
                }
            ?>
        </ul>
    </aside>
    <div class="container">
        <div id="contact">
            <h2 style="text-align: center;">Contact us</h2>
            <form id="contact-data-send">
                <img src="img/logo.PNG" style="width: 50%;">
                <div id="contact-input">
                    <input type="text" placeholder="Name:" class="contact-type">
                    <input type="email" placeholder="Email Address:" class="contact-type">
                    <input type="text" placeholder="Contact Number:" class="contact-type">
                    <textarea cols="30" rows="10" placeholder="Send a message..." style="resize: none;" class="contact-type"></textarea>
                    <input type="submit" value="Send">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script src="js/script.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <?php
        include 'connect.php';
        session_start();
        unset($_SESSION['search']);
        if(isset($_POST['submit'])) $_SESSION['search'] = $_POST['search'];
            
    ?>
    <header id="top-navigation" class="navigation">
        <form action="index.php" method="post">
            <ul>
                <li id="menu"><img class="icon" src="img/icon/bars-solid.svg"></li>
                <li id="title"><img id="logo" src="img/logo.PNG"><a href="#" id="top-navigation-website-title">zaldrec shoe store</a></li>
                <li id="search"><input type="search" style="width: 35em; height: 100%; padding-left: 1em;" placeholder="Search" name="search"><button style="height: 100%; width: 5em;" name="submit"><img class="icon" src="img/icon/magnifying-glass-solid.svg"></button></li>
                <?php
                    if(isset($_SESSION['username'])){
                        echo "<li id='sell'><a href='sell.php'>sell</a></li>";
                    }else{
                        echo "<li id='register'><a href='login.php'>Login</a><a>/</a><a href='signup.php'>Sign-up</a></li>";
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
        <div id="buy-page">
            <div id="buy-latest-products">
                <div>
                    <h3>Latest products</h3>
                    <?php

                        if(isset($_SESSION['username'])) $selected = $connect->query("SELECT * FROM products WHERE seller_id != $_SESSION[id] ORDER BY product_id DESC;");
                        else if(!isset($_SESSION['username'])) $selected = $connect->query("SELECT * FROM products ORDER BY product_id DESC;");

                        $data_rows = $selected->num_rows;

                        for($i=0;$i<$data_rows;$i++){
                            $transform = $selected->fetch_assoc();
                            echo "<img src='img/uploaded/$transform[product_image]'>";
                            if($i==4)break;
                        }
                    ?>
                </div>
            </div>
            <div id="buy-recommendation-products">
                <?php                   
                    if(isset($_SESSION['username']) && !isset($_SESSION['search'])) $selected = $connect->query("SELECT * FROM products INNER JOIN seller ON products.seller_id = seller.seller_id INNER JOIN accounts ON accounts.account_id = seller.seller_id AND products.seller_id != $_SESSION[id];");
                    else if(isset($_SESSION['username']) && isset($_SESSION['search'])) $selected = $connect->query("SELECT * FROM products INNER JOIN seller ON products.seller_id = seller.seller_id INNER JOIN accounts ON accounts.account_id = seller.seller_id AND products.seller_id != $_SESSION[id] WHERE products.product_name LIKE '%$_SESSION[search]%';");
                    else if(!isset($_SESSION['username']) && isset($_SESSION['search'])) $selected = $connect->query("SELECT * FROM products INNER JOIN seller ON products.seller_id = seller.seller_id INNER JOIN accounts ON accounts.account_id = seller.seller_id  WHERE products.product_name LIKE '%$_SESSION[search]%';");
                    else $selected = $connect->query("SELECT * FROM products INNER JOIN seller ON products.seller_id = seller.seller_id INNER JOIN accounts ON accounts.account_id = seller.seller_id");

                    for($i=0;$i<$selected->num_rows;$i++){
                        $transform = $selected->fetch_assoc();
                        echo "<form class='buy-products' action='payment.php' method='post'>";
                            echo "<div class='buy-trigger'>";
                                echo "<img src='img/uploaded/$transform[product_image]'>";
                                echo "<div>";
                                    echo "<h2>$transform[product_name]</h2>";
                                    echo "<h3>P$transform[product_price].00</h3>";
                                echo "</div>";
                            echo "</div>";
                            echo "<div class='buy-pop-up'>";
                                echo "<img src='img/uploaded/$transform[product_image]'>";  
                                echo "<h2>$transform[product_name]</h2>";
                                echo "<h3>P$transform[product_price].00</h3>";
                                echo "<pre>$transform[product_description]</pre>";
                                echo "<div class='seller-details'>";
                                    echo "<h3>Seller Details</h3>";
                                    echo "<p>Name: $transform[firstname] $transform[lastname]</p>";
                                    echo "<p>Address: $transform[address]</p>";
                                echo "</div>";
                                echo "<div id='buy-buttons'>";
                                echo "<input type='button' class='buy-cancel' value='Cancel'>";
                                if(isset($_SESSION['username'])) echo "<input type='submit' value='Buy' name='submit'>";
                                else echo "<button><a href='login.php'>Login to continue</a></button>";
                                echo "</div>";
                            echo "</div>";
                            echo "<input type='text' name='payment-product-image' class='buy-hide-visibility' value='$transform[product_image]'>";
                            echo "<input type='text' name='payment-product-title' class='buy-hide-visibility' value='$transform[product_name]'>";
                            echo "<input type='text' name='payment-product-price' class='buy-hide-visibility' value='$transform[product_price]'>";
                            echo "<input type='text' name='payment-product-description' class='buy-hide-visibility' value='$transform[product_description]'>";
                        echo "</form>";
                    }
                ?>
            </div>
        </div> 
    </div>
    <footer id='home-footer' class='footer'>
        <div id="footer-top">
            <span id="footer-about-us">
                <p>Browse The Latest Range Of Zaldrec Shoes In The Online Store. Shop Now. Cash On Delivery. Fast, Free & Easy Returns. Click & Collect. Sign up and Get 10% off. Easy Returns. Types: Originals, Performance, Sport Inspired.</p>
            </span>
            <span id="footer-follow-us">
                <h5 class="footer-title">FOLLOW US</h5>
                <span id="footer-socialmedia-logos">
                    <img src="img/icon/facebook-f-brands.svg" class="footer-icon">
                    <img src="img/icon/instagram-brands.svg" class="footer-icon">
                    <img src="img/icon/twitter-brands.svg" class="footer-icon">
                </span>
            </span>
            <span id="footer-call-us">
                <h5 class="footer-title">CALL US</h5>
                <h4>09243309143</h4>
                <h4>09197449953</h4>
            </span>
        </div>
        <div id="footer-bottom">
            <p>&copy2022 ZaldrecShoes. All Rights Reserved</p>
            <p>PRIVACY POLICY &nbsp&nbsp TERMS AND CONDITIONS</p>
        </div>
    </footer>
</body>
</html>
<script src="js/script.js"></script>
<script>
    let buy_trigger = document.querySelectorAll('.buy-trigger');
    let buy_pop_up = document.querySelectorAll('.buy-pop-up');
    let buy_cancel = document.querySelectorAll('.buy-cancel');
    let hasTriggerPopUp = false;

    buy_trigger.forEach((e,index)=>{
        e.addEventListener('click',()=>{
            if(hasTriggerPopUp)return;
            buy_pop_up[index].classList.add('buy-pop-up-trigger');
            hasTriggerPopUp = true;
        })
    })
    buy_cancel.forEach((e,index)=>{
        e.addEventListener('click',()=>{
            hasTriggerPopUp = false;
            buy_pop_up[index].classList.remove('buy-pop-up-trigger');
        })
    })

</script>
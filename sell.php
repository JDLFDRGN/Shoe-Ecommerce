<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include 'connect.php';
        session_start();

        if(isset($_POST['submit'])){
            $product_name = $_FILES['shoes']['name'];
            $product_tmpname = $_FILES['shoes']['tmp_name'];
            $product_title = $_POST['title'];
            $product_price = $_POST['price'];
            $product_description = $_POST['description'];
            $seller_address = $_POST['address'];

            move_uploaded_file($product_tmpname, "img/uploaded/".$product_name);

            $connect->query("INSERT INTO seller(seller_id, address) VALUES($_SESSION[id], '$seller_address')");
            $connect->query("INSERT INTO products(product_name, product_price, product_image, product_description, seller_id) VALUES('$product_title', $product_price,'$product_name', '$product_description', $_SESSION[id])");
            
        }

    ?>
    <div class="container">
        <div id="sell-page">
            <form method="post" enctype="multipart/form-data">
                <h3>SELL</h3>
                <div id="sell-content">
                    <div id="sell-first-section" class="sell-section">
                       <div>
                            <img src="img/no-image.png" id="sell-image">
                            <input type="file" id="sell-file" name="shoes" accept="image/*">
                       </div>
                       <div>
                            <div id="sell-input-area">
                                <div>
                                    <label for="sell-title">TITLE</label><br>
                                    <textarea id="sell-title" cols="38" rows="2" name="title"></textarea>
                                </div>
                                <div>
                                    <label for="sell-price">PRICE</label><br>
                                    <textarea id="sell-price" cols="38" rows="2" name="price"></textarea>
                                </div>
                                <div>
                                    <label for="sell-description">DESCRIPTION</label>
                                    <textarea id="sell-description" cols="34" rows="4" name="description"></textarea>
                                </div>
                                <div>
                                    <label for="sell-address">ADDRESS</label>
                                    <textarea id="sell-address" cols="34" rows="4" name="address"></textarea>
                                </div>
                                <div id="sell-buttons">
                                   <input type="submit" value="Save" class="sell-button" name="submit">
                                </div>
                            </div>
                       </div>
                    </div>
                    <div id="sell-second-section" class="sell-section">
                        <div id="sell-preview-page">
                            <h3>PREVIEW</h3>
                            <div>
                                <div id="sell-my-account">
                                    <img src="img/no-profile.webp">
                                    <?php
                                        echo "<span style='align-self:center;'>$_SESSION[firstname] $_SESSION[lastname]</span>";
                                    ?>
                                </div>
                                <div id="sell-my-products">
                                    <?php
                                         $selected = $connect->query("SELECT * FROM products WHERE seller_id=$_SESSION[id];");

                                         for($i=0;$i<$selected->num_rows;$i++){
                                            $transform = $selected->fetch_assoc();
                                            echo "<div>";
                                            echo "<img src='img/uploaded/$transform[product_image]'>";
                                            echo "<div id='sell-product-info'>";
                                            echo "<h2 id='sell-product-title'>$transform[product_name]</h2>";
                                            echo "<h3 id='sell-product-price'>P$transform[product_price].00</h3>";
                                            echo "<pre id='sell-product-description'>$transform[product_description]</pre>";
                                            echo "</div>";
                                            echo "</div>";
                                         }
                                    ?>
                                    <input type="button" value="Done" id="sell-done" class="sell-button">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </form>
        </div>
    </div>
</body>
</html>
<script>
    let sell_file = document.querySelector('#sell-file');
    let sell_image = document.querySelector('#sell-image');
    let sell_done = document.querySelector('#sell-done');
    
    sell_file.addEventListener('change',()=>{
        let file = new FileReader();
        file.addEventListener('load',()=>{
            sell_image.src=`${file.result}`;
        })
        file.readAsDataURL(sell_file.files[0]);
    });
    sell_done.addEventListener('click',()=>{
        location.href=sessionStorage.getItem("previous-page");
    })
</script>
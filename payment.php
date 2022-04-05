<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include 'connect.php';
        session_start();

        if(isset($_POST['submit'])){
            $_SESSION['payment_image'] = $_POST['payment-product-image'];
            $_SESSION['payment_title'] = $_POST['payment-product-title'];
            $_SESSION['payment_price'] = $_POST['payment-product-price'];
            $_SESSION['payment_description'] = $_POST['payment-product-description'];
        }
    ?>
    <div class="container">
        <div id="payment-page">
            <form id="payment-submit" method="post">
                <div id='payment-first-section'>
                <?php
                    echo "<img src='img/uploaded/$_SESSION[payment_image]' id='payment-image'>";
                    echo "<h2>$_SESSION[payment_title]</h2>";
                ?>   
                </div>

                <div id='payment-second-section'>
                    <span>
                        <h2 id='payment-address'>Address:</h2>
                        <textarea cols="30" rows="7"></textarea>
                    </span>
                   
                <?php
                    echo "<span><h2>Total: P</h2><h2 id='payment-total'>$_SESSION[payment_price]</h2><h2>.00</h2></span>";
                ?>             
                <span>
                    <div id='payment-quantity'>
                        <h2>Quantity:</h2>
                        <div id='payment-quantity-buttons'><input type='button' value='-' id='payment-subtract-quantity' class='payment-quantity-button'><span><input id='payment-quantity-number' type='text' value='1' readonly></span><input type='button' value='+' id='payment-add-quantity' class='payment-quantity-button'></div>
                    </div>
                </span>
                </div>

                <div id='payment-third-section'>
                <input type='button' value='Return' class='payment-button' id='payment-return'><input type='button' value='Mode of payment' id='payment-mode' class='payment-button'><input type='button' value='Check out' class='payment-button' onclick="location.href='order.html'">
                </div>

                 <div id="payment-method">
                    <div><button type='button' class='payment-method-button payment-method-size'>Cash on Delivery</button></div>
                    <div><button type='button' class='payment-method-button payment-method-size'>Credit/Debit Card</button></div>
                    <div><button type='button' class='payment-method-button payment-method-size'>Over the Counter</button></div>                    
                    <div><button type='button' id='payment-trigger-pop-up' class='payment-method-size'>Digital/Online Payment</button><div id='payment-pop-up'><button type='button' class='payment-method-button payment-method-size'>Payment Center/E-Wallet</button><button type='button' class='payment-method-button payment-method-size'>Google Pay</button></div></div>
                    <div><button type='button' id='payment-confirm' class='payment-footer'>Confirm</button></div>
                </div>

                <input id='payment-method-send' type="text" style="display: none;">

            </form>
        </div>
    </div>
</body>
</html>
<script>
    let add_quantity = document.querySelector('#payment-add-quantity');
    let subtract_quantity = document.querySelector('#payment-subtract-quantity');
    let quantity_number = document.querySelector('#payment-quantity-number');
    let total_payment = document.querySelector('#payment-total'); 
    let return_page = document.querySelector('#payment-return');
    let payment_method = document.querySelector('#payment-method');
    let payment_method_button = document.querySelectorAll('.payment-method-button');
    let payment_method_send = document.querySelector('#payment-method-send');
    let payment_confirm = document.querySelector('#payment-confirm');
    let trigger_pop_up = document.querySelector('#payment-trigger-pop-up');
    let payment_mode = document.querySelector('#payment-mode');
    let number = parseInt(quantity_number.value);
    let product_price = parseInt(total_payment.innerHTML);
    let total, hasChosen = false, last_pick, open_pop_up = true;

    add_quantity.addEventListener('click',()=>{
        number++;
        total = product_price * number;
        quantity_number.value = number;
        total_payment.innerHTML = total;
    });
    subtract_quantity.addEventListener('click',()=>{
        number--;
        if(number < 0){
            number = 0;
            return;
        }
        total = product_price * number;
        quantity_number.value = number;
        total_payment.innerHTML = total;
    });
    payment_method_button.forEach((e,index)=>{
        e.addEventListener('click',()=>{   
            hasChosen?last_pick.style.color='white':"";
            e.style.color='black';    
            payment_method_send.value = e.innerHTML;
            last_pick = e;
            hasChosen=true;
        })
    })
    trigger_pop_up.addEventListener('click',()=>{
        if(open_pop_up){
            document.querySelector('#payment-pop-up').style.display='flex';
            open_pop_up = false;
        }else{
            document.querySelector('#payment-pop-up').style.display='none';
            open_pop_up = true;
        }    
    })
    payment_mode.addEventListener('click',()=>{
        payment_method.style.display='grid';
    })
    payment_confirm.addEventListener('click',()=>{
        payment_method.style.display='none';
    })
    return_page.addEventListener('click',()=>{
        location.href=sessionStorage.getItem("previous-page");
    });
</script>
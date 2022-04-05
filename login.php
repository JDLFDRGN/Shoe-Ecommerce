<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
       <div id="login">
           <form action="validate.php" method="post" id="login-data-send">
                <img src="img/logo.PNG">
                <div id="login-input">
                    <input type="email" placeholder="Enter username" style="height: 2.4em;" name="username"><br>
                    <span>
                        <input type="password" placeholder="Enter password" class="password" name="password">
                        <img src="img/icon/visibility_off_black_24dp.svg" id="login-password-logo">
                    </span>                  
                </div>     
                <div id="login-button">
                    <input type="button" value="Return" id="login-return">
                    <input type="submit" value="Login" name="submit">
                </div>
           </form>
        </div>
    </div>
</body>
</html>
<script>
    let login_password = document.querySelector('.password');
    let login_password_logo = document.querySelector('#login-password-logo');
    let login_show_password = false;
    let login_return = document.querySelector('#login-return');
    login_password.addEventListener('keyup',()=>{
        if(login_password.value != ""){
            login_password_logo.style.display = "inline";
        }else login_password_logo.style.display = "none";
    })
    login_password_logo.addEventListener('click',()=>{
        if(login_show_password == false){
            login_show_password = true;
            login_password_logo.src = "img/icon/visibility_black_24dp.svg";
            login_password.type = "text";
        }else{
            login_show_password = false;
            login_password_logo.src = "img/icon/visibility_off_black_24dp.svg";
            login_password.type = "password";
        }
    })
    login_return.addEventListener('click',()=>{
        location.href=sessionStorage.getItem("previous-page");
    });
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title> 
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include 'connect.php';
        session_start();

        if(isset($_POST['submit'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);    
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            
            $select = $connect->query("SELECT * FROM accounts");

            $_SESSION['id'] = $select->num_rows + 1;
            $_SESSION['username'] = $email;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            
            $query = "INSERT INTO accounts(firstname,lastname,email,password,age,gender)
                      VALUES('$firstname', '$lastname', '$email', '$password', $age, '$gender');";

            if($connect->query($query)){
                echo "<script>";
                echo "let ans = alert('Your account has been successfully created!'); if(!ans) location.href='index.php';";
                echo "</script>";
            }
        }   
    ?>
    <div class="container">
        <div id="signup">
            <form action="signup.php" method="post" id="signup-data-send">
                <h2 style="margin-bottom: 1em;">Create your account</h2>
                <div id="signup-fullname">
                    <input type="text" placeholder="First name" class="signup-input" name="firstname" required>
                    <input type="text" placeholder="Last name" class="signup-input" name="lastname" required>
                </div>    
                <input type="email" placeholder="Email" style="width: 100%;" class="signup-input" name="email" required>
                <div id="signup-passwords">
                    <input type="password" placeholder="Password" id="signup-create-password" class="signup-input" name="password" required>
                    <input type="password" placeholder="Confirm" id="signup-confirm-password" class="signup-input" required>
                </div>
                <p id="passwords-error" style="display:none; color:red;">Passwords do not match!</p>
                <div>
                    <input type="checkbox" id="signup-password">
                    <label for="signup-password">Show password</label>
                </div>
                <div id="signup-age-and-gender">
                    <input type="number" placeholder="Age" id="signup-age" style="width: 30%;" class="signup-input" name="age" required> 
                    <span>
                        <label>Gender:</label>
                        <span>
                            <input type="radio" name="gender" value="Male" checked> 
                            <label>Male</label>
                        </span>
                        <span>
                            <input type="radio" name="gender" value="Female">
                            <label>Female</label>
                        </span>                      
                    </span>
                </div>
                <div id="signup-footer">
                    <a href="login.php">Login instead</a>
                    <input type="submit" value="Sign-up" id="signup-submit" name="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    let signup_password = document.querySelectorAll('input[type=password]');
    let signup_check_password = document.querySelector('input[type=checkbox]');
    let signup_submit = document.querySelector('#signup-data-send');
    let signup_create_password = document.querySelector('#signup-create-password');
    let signup_confirm_password = document.querySelector('#signup-confirm-password');

    signup_check_password.addEventListener('click',()=>{
        if(signup_check_password.checked){
            signup_password.forEach(e=>{
                e.type='text';
            });
        }else{
            signup_password.forEach(e=>{
                e.type='password';
            });
        }
        console.log('huhu');
    });
    
    signup_submit.addEventListener('submit',e=>{
        if(signup_create_password.value !== signup_confirm_password.value){       
            document.querySelectorAll('#signup-passwords>input').forEach(e=>{
                e.style.border='1px solid red';
            });
            document.querySelector('#passwords-error').style.display="inline";
            e.preventDefault();
        }
    });
</script>
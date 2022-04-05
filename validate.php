<?php
    include 'connect.php';
    session_start();

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
            
        $select = $connect->query("SELECT * FROM accounts");

        for($i=0;$i<$select->num_rows;$i++){
            $transform = $select->fetch_assoc();
            if($username == $transform['email'] && password_verify($password, $transform['password'])){
                $_SESSION['id'] = $transform['account_id'];
                $_SESSION['username'] = $username;
                $_SESSION['firstname'] = $transform['firstname'];
                $_SESSION['lastname'] = $transform['lastname'];

                echo "<script>alert('Login Successful!')</script>";
                header('Location: index.php');
            }
        }
        echo "<script>";
        echo "let ans = alert('Invalid username or password!'); if(!ans) location.href='login.php';";
        echo "</script>";
    }
?>

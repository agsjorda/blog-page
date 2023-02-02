<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
<?php   
        if(isset($_SESSION['errors'])) {
            foreach($_SESSION['errors'] as $error) {
                echo "<p class='error'>{$error}</p>";
            }
            unset($_SESSION['errors']); 
        }
        if(isset($_SESSION['success_message'])) {
            echo "<p class='success'>{$_SESSION['success_message']}</p>";
            unset($_SESSION['success_message']);
        }
?>        
        <h1>Register</h1>
        <form action="process.php" method="post">
            <input type="hidden" name="action" value="register">
            <label>name : <input type="text" name="first_name"></label><br> 
            <label>Last name : <input type="text" name="last_name"></label><br>
            <label>email : <input type="text" name="email"></label><br>
            <label>password : <input type="password" name="password"></label><br>
            <label>Confirm Password : <input type="password" name="confirm_password"></label><br>
            <input type="submit" id="register" value="register">
        </form>
        <h1>Login</h1>
        <form action="process.php" method="post">
            <input type="hidden" name="action" value="login">
            <label>email : <input type="text" name="email"></label><br>
            <label>password : <input type="password" name="password"></label><br>
            <input type="submit" id="login" value="login">
        </form>
    </div>
</body>
</html>
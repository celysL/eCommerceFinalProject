<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject login.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

use classes\UserLogin;

include 'include/config.php';
include 'classes/UserLogin.php';
session_start();

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    $user = new UserLogin($name, $password);
    
    if ($user->authenticateUser()) {
        header('Location: index.php');
        exit();
    }
    else {
        $message[] = 'Incorrect username or password';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    
    <link rel="stylesheet" href="css/login.css">

</head>
<body>

<?php

if(isset($message)){
    foreach ($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
}

?>

<div class="form-container">
    <form action="" method="post">
        <h3>Login now</h3>
        <input type="text" name="name" required placeholder="username" class="box" value="<?php echo isset($_COOKIE['user_name']) ? $_COOKIE['user_name'] : ''; ?>">
        <input type="password" name="password" required placeholder="password" class="box" value="<?php echo isset($_COOKIE['user_pass']) ? $_COOKIE['user_pass'] : ''; ?>">
        <input type="checkbox" name="remember_me" id="remember_me" <?php if(isset($_COOKIE['user_name'])) echo "checked"; ?>>
        <label for="remember_me">Remember me</label>
        <input type="submit" name="submit" class="btn" value="login now" >
        
        <p>don't have an account? <a href="register.php">Register now</a> </p>
    
    </form>
</div>
</body>
</html>

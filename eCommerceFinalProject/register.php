<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject register.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

use classes\UserRegistration;

include 'include/config.php';
include 'classes/UserRegistration.php';


if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    if ($password != $cpassword) {
        $message[] = 'Passwords do not match!';
    }
    else {
        $user = new UserRegistration($name, $email, $password);
        $message = $user->registerUser();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    
    <link rel="stylesheet" href="css/register.css">

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
        <h3>Register now</h3>
        <input type="text" name="name" required placeholder="username" class="box">
        <input type="email" name="email" required placeholder="email" class="box">
        <input type="password" name="password" required placeholder="password" class="box">
        <input type="password" name="cpassword" required placeholder="confirm password" class="box"><!--    password confirmation    -->
        <input type="submit" name="submit" class="btn" value="register now" >
        
        <p>already have an account? <a href="login.php">login now</a> </p>
    
    </form>
</div>
</body>
</html>
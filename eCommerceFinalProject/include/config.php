<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject config.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

//configurations to the database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'commerce_final_project';

//PDO connection
try{
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $exception){
    echo "PDO connection failed: " . $exception->getMessage();
}



//mysqli connection
$conn = mysqli_connect('localhost', 'root', '', 'commerce_final_project') or die('connection failed');
$conn->query("SET @@auto_increment_increment=1");
?>
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


//mysqli connection
$conn = mysqli_connect('localhost', 'root', '', 'commerce_final_project') or die('connection failed');
$conn->query("SET @@auto_increment_increment=1");

//PDO connection
try{
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $exception){
    echo "PDO connection failed: " . $exception->getMessage();
}

function getPdoConnection() : PDO {
    static $pdo;
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'commerce_final_project';
    if (!($pdo instanceof PDO)) {
        try{
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception){
            echo "PDO connection failed: " . $exception->getMessage();
        }
    }
    return $pdo;
    
}

function getMysqliConnection() : mysqli {
    static $mysqli;
    if (!($mysqli instanceof mysqli)) {
        $mysqli = mysqli_connect('localhost', 'root', '', 'commerce_final_project') or die('connection failed');
        $mysqli->query("SET @@auto_increment_increment=1");
    }
    return $mysqli;
}


// CLASS AUTOLOADER
$psr4_autoloader = function(string $class) : bool {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    $file_path = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR.$file;
    if (file_exists($file_path)) {
        require_once $file_path;
        return true;
    }
    return false;
};

spl_autoload_register($psr4_autoloader);

?>
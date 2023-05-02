<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject UserRegistration.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

namespace classes;

// TODO: le chemin d'inclusion doit se faire à partir du dossier du fichier en cours
// ici on est dans /classes. /classes/include/config.php n'existe pas
// essayez ceci: include "..".DIRECTORY_SEPARATOR."include/config.php";
//include "..".DIRECTORY_SEPARATOR."include/config.php";
use PDO;

__DIR__."..".DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."config.php";

/**
 * @TODO   Documentation
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
class UserRegistration {
    
    private string $name;
    private string $email;
    private string $password;
    
    /**
     * @param $name
     * @param $email
     * @param $password
     */
    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = md5($password);
    }
    
    /**
     * @return array
     *
     * @author Ying-Shan Liang
     * @since  2023-04-29
     */
    public function registerUser() : array {
//        global $conn;
//
//        $name = mysqli_real_escape_string($conn, $this->name);
//        $email = mysqli_real_escape_string($conn, $this->email);
//        $password = mysqli_real_escape_string($conn, $this->password);
//
//        $select = mysqli_query($conn, "select * from `customer` where email = '$email' and password = '$password'") or die('Query failed');
//
//        if(mysqli_num_rows($select) > 0) {
//            $message[] = 'User already exists';
//            return $message;
//        }
//        else {
//            mysqli_query($conn, "insert into `customer`(username, password, email) values ('$name', '$password', '$email')") or die('Query failed');
//            $message[] = 'Registered successfully!';
//            return $message;
//        }
        $pdo = getPdoConnection();
        
        $sql = "select * from customer where email =:email";
        $db = $pdo->prepare($sql);
        $db->execute([':email' =>$this->email]);
        $user=$db->fetch(PDO::FETCH_ASSOC);
        
        if($user && (count($user)>0)){
            $message[] = 'This user already exists';
            return $message;
            
        }
        else{
            $sql = "insert into customer(username, password, email) values(:username, :password, :email)";
            $db = $pdo->prepare($sql);
            $db->execute([
                ':username' => $this->name,
                ':password' => $this->password,
                ':email' =>$this->email
                         ]);
            $message[] = 'User registered successfully!';
            return $message;
        }
    }
    
}
<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject UserLogin.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

namespace classes;

// TODO: le chemin d'inclusion doit se faire à partir du dossier du fichier en cours
// ici on est dans /classes. /classes/include/config.php n'existe pas
// essayez ceci: include "..".DIRECTORY_SEPARATOR."include/config.php";
//include 'include/config.php';
__DIR__."..".DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."config.php";
use PDO;

//include "..".DIRECTORY_SEPARATOR."include/config.php";
/**
 * @TODO   Documentation
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
class UserLogin {
    
    private string $name;
    private string $password;
//    private PDO $pdo;
    
    /**
     * @param $name
     * @param $password
     */
    public function __construct($name, $password) {
        $this->name = $name;
        $this->password = md5($password);
//        $this->pdo = $pdo;
    }
    
    /**
     * @return bool|void
     *
     * @author Ying-Shan Liang
     * @since  2023-04-29
     */
    public function authenticateUser() {
//        global $conn;
//
//        $name = mysqli_real_escape_string($conn, $this->name);
//        $password = mysqli_real_escape_string($conn, $this->password);
//
//        $select = mysqli_query($conn, "select * from `customer` where username = '$name' and password = '$password'") or die('Query failed');
//
//        if(mysqli_num_rows($select) > 0) {
//            $row = mysqli_fetch_assoc($select);
//            $_SESSION['user_id'] = $row['id'];
//
//            // Set cookies
//            setcookie('user_name', $name, time() + 60 * 60 * 24 * 30); // 30 days
//            setcookie('user_pass', $password, time() + 60 * 60 * 24 * 30); // 30 days
//
//            return true;
//        }
//        else {
//            return false;
//        }
            $pdo = getPdoConnection();
            $sql = "select * from customer where username =:username";
            $db = $pdo->prepare($sql);
            $db->execute([':username' =>$this->name]);
            $user = $db->fetch(PDO::FETCH_ASSOC);
            
            if($user && (count($user) > 0)){
                //Hashed password verification
                if(md5($this->password) == $user['password']){
                    //Setting the session's variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['username'];
                    
                    //setting cookies for remember me
                    if(isset($_POST['remember_me'])){
                        setcookie('user_name', $this->name, time() + (86400 * 30), '/');
                        setcookie('user_pass', $this->name, time() + (86400 * 30), '/');
                    }elseif(isset($_COOKIE['user_name'])){
                        setcookie('user_name', '', time() - 3600, '/');
                    }
                    if(isset($_COOKIE['user_pass'])){
                        setcookie('user_pass', '', time()-3600, '/');
                    }
                }
                return true;
            }
            return false;
            
        }
}
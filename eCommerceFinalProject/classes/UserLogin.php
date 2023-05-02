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
//        $this->password = md5($password);
//        $this->pdo = $pdo;
        $this->password = $password;
    }
    
    /**
     * @return false
     *
     * @author Ying-Shan Liang
     * @since  2023-04-29
     */
//    public function authenticateUser() : bool {
//
//            $pdo = getPdoConnection();
//            $sql = "select * from customer where username =:username";
//            $db = $pdo->prepare($sql);
//            $db->execute([':username' =>$this->name]);
//            $user = $db->fetch(PDO::FETCH_ASSOC);
//
//            if($user && (count($user) > 0)){
//                //Hashed password verification
//                if(md5($this->password) == $user['password']){
//                    //Setting the session's variables
//                    $_SESSION['user_id'] = $user['id'];
//                    $_SESSION['user_name'] = $user['username'];
//
//                    //setting cookies for remember me
//                    if(isset($_POST['remember_me'])){
//                        setcookie('user_name', $this->name, time() + (86400 * 30), '/');
//                        setcookie('user_pass', $this->name, time() + (86400 * 30), '/');
//                    }elseif(isset($_COOKIE['user_name'])){
//                        setcookie('user_name', '', time() - 3600, '/');
//                    }
//                    if(isset($_COOKIE['user_pass'])){
//                        setcookie('user_pass', '', time()-3600, '/');
//                    }
//                }
//                return true;
//            }
//            return false;
//
//        }
    
//    public function authenticateUser() : array {
//
//        $pdo = getPdoConnection();
//        $sql = "select * from customer where username =:username";
//        $db = $pdo->prepare($sql);
//        $db->execute([':username' =>$this->name]);
//        $user = $db->fetch(PDO::FETCH_ASSOC);
////        $result = ['status' => false];
//
//        if($user && (count($user) > 0)){
//            //Hashed password verification
//            if(md5($this->password) == $user['password']){
//                $result = [
//                    'status' => true,
//                    'user_id' => $user['id'],
//                    'username' => $user['username']
//                ];
//
//                //setting cookies for remember me
//                if(isset($_POST['remember_me'])){
//                    setcookie('user_name', $this->name, time() + (86400 * 30), '/');
//                    setcookie('user_pass', $this->name, time() + (86400 * 30), '/');
//                } elseif(isset($_COOKIE['user_name'])) {
//                    setcookie('user_name', '', time() - 3600, '/');
//                }
//                if(isset($_COOKIE['user_pass'])) {
//                    setcookie('user_pass', '', time()-3600, '/');
//                }
//            }
//        }
//        return $result;
//    }
    public function authenticateUser(): array {
        $result = [
            'status' => false,
            'user_id' => null,
            'username' => null,
        ];
        
        $pdo = getPdoConnection();
        $sql = "select * from customer where username = :username";
        $db = $pdo->prepare($sql);
        $db->execute([':username' => $this->name]);
        $user = $db->fetch(PDO::FETCH_ASSOC);
        
        if ($user && (count($user) > 0)) {
            // Hashed password verification
            if (md5($this->password) == $user['password']) {
                // Setting the session's variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];
                
                // setting cookies for remember me
                if (isset($_POST['remember_me'])) {
                    setcookie('user_name', $this->name, time() + (86400 * 30), '/');
                    setcookie('user_pass', $this->name, time() + (86400 * 30), '/');
                } elseif (isset($_COOKIE['user_name'])) {
                    setcookie('user_name', '', time() - 3600, '/');
                }
                if (isset($_COOKIE['user_pass'])) {
                    setcookie('user_pass', '', time() - 3600, '/');
                }
                
                $result['status'] = true;
                $result['user_id'] = $user['id'];
                $result['username'] = $user['username'];
            }
        }
        return $result;
    }
}
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
include "include/config.php";

/**
 * @TODO   Documentation
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
class UserLogin {
    
    private string $name;
    private string $password;
    
    /**
     * @param $name
     * @param $password
     */
    public function __construct($name, $password) {
        $this->name = $name;
        $this->password = md5($password);
    }
    
    /**
     * @return bool|void
     *
     * @author Ying-Shan Liang
     * @since  2023-04-29
     */
    public function authenticateUser() {
        global $conn;
        
        $name = mysqli_real_escape_string($conn, $this->name);
        $password = mysqli_real_escape_string($conn, $this->password);
        
        $select = mysqli_query($conn, "select * from `customer` where username = '$name' and password = '$password'") or die('Query failed');
        
        if(mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
            $_SESSION['user_id'] = $row['id'];
            
            // Set cookies
            setcookie('user_name', $name, time() + 60 * 60 * 24 * 30); // 30 days
            setcookie('user_pass', $password, time() + 60 * 60 * 24 * 30); // 30 days
            
            return true;
        }
        else {
            return false;
        }
    }
    
}
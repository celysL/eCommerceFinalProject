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

include 'include/config.php';

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
     * @return array|void
     *
     * @author Ying-Shan Liang
     * @since  2023-04-29
     */
    public function registerUser() {
        global $conn;
        
        $name = mysqli_real_escape_string($conn, $this->name);
        $email = mysqli_real_escape_string($conn, $this->email);
        $password = mysqli_real_escape_string($conn, $this->password);
        
        $select = mysqli_query($conn, "select * from `customer` where email = '$email' and password = '$password'") or die('Query failed');
        
        if(mysqli_num_rows($select) > 0) {
            $message[] = 'User already exists';
            return $message;
        }
        else {
            mysqli_query($conn, "insert into `customer`(username, password, email) values ('$name', '$password', '$email')") or die('Query failed');
            $message[] = 'Registered successfully!';
            return $message;
        }
    }
    
}
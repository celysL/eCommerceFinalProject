<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject ajax_checkout.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */
session_start();
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $customer_id = $_POST['customer_id'];
    $customer_email = $_POST['customer_email'];
    $billing_address = $_POST['billing_address'];
    $shipping_address = $_POST['shipping_address'];
    
    $customer_id = getCustomerIdByEmail($customer_email);
    
    if (checkout($customer_id, $billing_address, $shipping_address)) {
        echo "Checkout completed successfully!";
    } else {
        echo "An error occurred during the checkout process.";
    }
}
?>
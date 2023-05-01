<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject ajax_add_to_cart.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    addToCart($product_id, $quantity);
    
    echo "Item added to cart!";
}
?>
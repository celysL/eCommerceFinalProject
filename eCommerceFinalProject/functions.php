<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject functions.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

use classes\Order;
use classes\Product;
use classes\ShoppingCart;
use classes\ShoppingCartProduct;

require_once 'include/config.php';
require_once 'classes/Product.php';
require_once 'classes/Order.php';
require_once 'classes/ShoppingCart.php';
require_once 'classes/ShoppingCartProduct.php';

/**
 * @return array
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
/**
 * @return array
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
function getProducts() : array {
    global $conn;

    $sql = "select * from Product";
    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $product = new Product();
            $product->setId($row["id"]);
            $product->setDescription($row["description"]);
            $product->setImageUrl($row["image_url"]);
            $product->setUnitPrice((float) $row["unit_price"]);
            $product->setAvailableQuantity((int)$row["available_quantity"]);
            $product->setDateCreated($row["date_created"]);

            $products[] = $product;
        }
    }

    return $products;
}

/**
 * @param string $email
 *
 * @return int|null
 *
 * @author Ying-Shan Liang
 * @since  2023-04-30
 */
function getCustomerIdByEmail(string $email): ?int {
    global $conn;
    
    $sql = "select id from Customer where email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return (int)$row['id'];
    }
    
    return null;
}


/**
 * @param $product_id
 * @param $quantity
 *
 * @return void
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
function addToCart($product_id, $quantity) : void {
    $cart_items = [];
    
    if (isset($_COOKIE['shopping_cart'])) {
        $cart_items = json_decode($_COOKIE['shopping_cart'], true);
    }
    
    if (isset($cart_items[$product_id])) {
        $cart_items[$product_id] += $quantity;
    } else {
        $cart_items[$product_id] = $quantity;
    }
    
    setcookie('shopping_cart', json_encode($cart_items), time() + (86400 * 30), "/");
}

/**
 * @param $customer_id
 * @param $billing_address
 * @param $shipping_address
 *
 * @return bool
 *
 * @author Ying-Shan Liang
 * @since  2023-04-29
 */
function checkout($customer_id, $billing_address, $shipping_address) : bool {
    global $conn;
    
    if (!isset($_COOKIE['shopping_cart'])) {
        return false;
    }
    
    $cart_items = json_decode($_COOKIE['shopping_cart'], true);
    
    // Create a new shopping cart entry
    $cart_id = $conn->insert_id;
    $new_cart = new ShoppingCart('completed', 0);
    $sql = "insert into `shopping cart` (status, quantity) values ('{$new_cart->getStatus()}', '{$new_cart->getQuantity()}')";
    //echo "SQL: {$sql}<br>";
    if ($conn->query($sql) !== true) {
        return false;
    }
    
    $cart_id = $conn->insert_id;
    $total_quantity = 0;
    
    // Add products to the shoppingcartproduct table
    foreach ($cart_items as $product_id => $quantity) {
        $total_quantity += $quantity;
        $cart_product = new ShoppingCartProduct($cart_id, $product_id, (int)$quantity);
        $sql = "insert into shoppingcartproduct (shopping_cart_id, product_id, quantity) values (NULL, '{$cart_product->getProductId()}', '{$cart_product->getQuantity()}')";
        if ($conn->query($sql) !== true) {
            return false;
        }
    }
    
    // Update the shopping cart quantity
    $new_cart->setQuantity($total_quantity);
    $sql = "update `shopping cart` set quantity = '{$new_cart->getQuantity()}' where id = '$cart_id'";
    if ($conn->query($sql) !== true) {
        return false;
    }
    
    // Create a new order entry
    $date_created = date("Y-m-d H:i:s");
    $date_placed = date("Y-m-d H:i:s");
    $new_order = new Order($conn->insert_id, 'pending', (int)$customer_id, $cart_id, $billing_address, $shipping_address, $date_created, $date_placed, null);
    $sql = "insert into `order` (status, customer_id, shopping_cart_id, billing_address, shipping_address, date_created) values ('{$new_order->getStatus()}', '{$new_order->getCustomerId()}', '{$new_order->getShoppingCartId()}', '{$new_order->getBillingAddress()}', '{$new_order->getShippingAddress()}', '{$new_order->getDateCreated()}')";
    if ($conn->query($sql) !== true) {
        return false;
    }
    
    
    // Clear the cookie
    setcookie('shopping_cart', '', time() - 3600, "/");
    
    return true;
}
